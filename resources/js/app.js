import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// exam_question: index
$(document).ready(function () {

    const MAX_QUESTION = 40;
    const MIN_QUESTION = 1;

    $("#navbar").removeClass('hidden');

    $('.attemptButton').on('click', function (e) {
        // Set the time for the countdown (50 minutes in seconds)
        let time = 50 * 60;

        // Function to update the timer every second
        function updateTimer() {
            const minutes = Math.floor(time / 60);
            const seconds = time % 60;

            // Display the timer in MM:SS format
            $('.exam-timer').text(`${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`);

            // Decrease time by 1 second
            if (time > 0) {
                time--;
            } else {
                // Timer reaches 0
                clearInterval(timerInterval);
                $('.exam-timer').text("Time's up!");

                let exam_start_time = sessionStorage.getItem('exam_start_time')
                let exam_set_number = sessionStorage.getItem('currentSetNumber')

                if (exam_start_time && exam_set_number) {

                    $.ajax({
                        url: '/exam_score/store',
                        method: 'POST',
                        data: {
                            "exam_start_time": exam_start_time,
                            "set_number": exam_set_number,
                            _token: $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {

                            console.log(response)

                            if (response.total_answered == 0) {
                                $('.total_answered_0').removeClass('hidden');
                            } else {
                                $('#live_result_popup_overlay').removeClass('hidden')
                                $('#live_result_popup').removeClass('hidden')

                                $("#live_result_total_answered").text(response.total_answered);
                                $("#live_result_total_correct").text(response.total_correct);

                            }

                        },
                        error: function (xhr, status, error) {
                            console.error('Failed to save option:', error);
                        }
                    })
                }
            }
        }

        // Call updateTimer every 1 second
        const timerInterval = setInterval(updateTimer, 1000);

        // Initialize the timer display
        updateTimer();

        const currentDateTime = getFormattedDateTime();

        if (sessionStorage.getItem('exam_start_time')) {

            sessionStorage.removeItem('exam_start_time')

        }
        // Store set number and question number in session storage
        sessionStorage.removeItem('currentSetNumber');
        sessionStorage.removeItem('currentQuestionNumber');
        sessionStorage.removeItem('lst_choosen_option');


        sessionStorage.setItem('exam_start_time', currentDateTime);

        var setNumber = $(this).data('set-number');

        var formattedSetName = setNumber.replace('set_', 'Set ').replace(/(\d+)/,
            function (match) {
                return match.padStart(2, '0');
            });

        $(".modal_set_number").text("UBT " + formattedSetName);

        $("#exam_table_popup").removeClass('hidden');

        $('.question-item').on('click', function (e) {
            let questionNumber = $(this).data('question-number');
            let formated_questionNumber = setNumber + "_" + questionNumber;

            // Store set number and question number in session storage
            sessionStorage.setItem('currentSetNumber', setNumber);
            sessionStorage.setItem('currentQuestionNumber', formated_questionNumber);

            $('.next-question-btn').removeClass('hidden');
            $('.submit-exam-btn').addClass('hidden')

            exam_show(setNumber, formated_questionNumber);

        });

    });


    // Function to update session storage and fetch exam
    function updateQuestion(setNumber, new_q_num_int) {

        let new_q_num = setNumber + "_" + new_q_num_int;
        sessionStorage.setItem('currentSetNumber', setNumber);
        sessionStorage.setItem('currentQuestionNumber', new_q_num);

        const new_currentQuestionNumber = sessionStorage.getItem('currentQuestionNumber');
        const new_setNumber = sessionStorage.getItem('currentSetNumber');

        const new_targetQuestionNumber = `${new_setNumber}_40`;

        if (new_currentQuestionNumber == new_targetQuestionNumber) {

            $('.next-question-btn').addClass('hidden');
            $('.submit-exam-btn').removeClass('hidden')

        } else {

            $('.submit-exam-btn').addClass('hidden')
            $('.next-question-btn').removeClass('hidden');
        }

        fetch_exam(setNumber, new_q_num);
    }

    // Event listener for the next question button
    $('.next-question-btn').on('click', function () {
        // Retrieve the set number and question number from session storage
        let setNumber = sessionStorage.getItem('currentSetNumber');
        let questionNumber = sessionStorage.getItem('currentQuestionNumber');

        // Extract the numeric part of the question number
        let q_num = questionNumber.replace(setNumber + "_", "");
        let q_num_int = parseInt(q_num, 10);

        if (q_num_int < MAX_QUESTION) {
            q_num_int += 1;
            updateQuestion(setNumber, q_num_int);
        }

    });

    // Event listener for the previous question button
    $('.previous-question-btn').on('click', function () {
        // Retrieve the set number and question number from session storage
        let setNumber = sessionStorage.getItem('currentSetNumber');
        let questionNumber = sessionStorage.getItem('currentQuestionNumber');

        // Extract the numeric part of the question number
        let q_num = questionNumber.replace(setNumber + "_", "");
        let q_num_int = parseInt(q_num, 10);

        if (q_num_int > MIN_QUESTION) {
            q_num_int -= 1;
            updateQuestion(setNumber, q_num_int);
        }
    });

    // Show the popup
    function exam_finish_confirmation_showPopup() {
        $('#exam_finish_confirmation_popup').removeClass('hidden');
    }

    // Hide the popup
    function exam_finish_confirmation_hidePopup() {
        $('#exam_finish_confirmation_popup').addClass('hidden');
    }

    $('.submit-exam-btn').on('click', function () {
        $('#exam_finish_confirmation_popup').removeClass('hidden');
    });

    // Handle cancel button click
    $('#exam_finish_confirmation_cancel-popup').on('click', function () {
        exam_finish_confirmation_hidePopup();
    });


    $('.question-list-btn').on('click', function () {

        $("#exam").addClass('hidden');

        // Show the modal
        $("#exam_table_popup").removeClass('hidden');

        if (sessionStorage.getItem("lst_choosen_option")) {

            // Retrieve the JSON string from session storage
            let storedArray = sessionStorage.getItem("lst_choosen_option");

            // Convert the JSON string back to an array
            let myArray = JSON.parse(storedArray);

            // Loop through the array and add the 'complete' class to the corresponding question-item
            myArray.forEach(item => {
                // Extract the question number from the item (assuming the format 'set_x_y')
                let parts = item.split('_');
                let questionNumber = parts[2]; // 'y' in 'set_x_y'

                // Find the question item with the matching data-question-number
                let questionElement = document.querySelector(`[data-question-number="${questionNumber}"]`);

                // Add the 'complete' class if the element exists
                if (questionElement) {
                    questionElement.classList.add('answered');
                }
            });
        }

    });

    // Select all option elements
    $('.option-div').on('click', function () {

        // Remove 'option-active' class from all options
        $('.option-div').removeClass('option-active');

        // Add 'option-active' class to the clicked option
        $(this).addClass('option-active');

        // Adding warning to answer atleast one question before submitting.
        $('.total_answered_0').addClass('hidden');

        let exam_start_time = sessionStorage.getItem('exam_start_time');
        var chosenOption = $(this).find('.option-data').data('value'); // Get the data-value attribute directly from the clicked option's span with the option-data class
        let questionNumber = sessionStorage.getItem('currentQuestionNumber');
        let setNumber = sessionStorage.getItem('currentSetNumber');


        // Make an AJAX request to store the user's choice
        $.ajax({
            url: '/answer/store-user-choice',
            method: 'POST',
            data: {
                'exam_start_time': exam_start_time,
                'chosenOption': chosenOption,
                'question_number': questionNumber,
                'setNumber': setNumber,
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {

                // Initialize an empty array
                let myArray = [];

                // Store the empty array in session storage if it doesn't already exist
                if (!sessionStorage.getItem("lst_choosen_option")) {
                    sessionStorage.setItem("lst_choosen_option", JSON.stringify(
                        myArray));
                }

                // Retrieve the array from session storage
                let storedArray = sessionStorage.getItem("lst_choosen_option");

                // Parse the JSON string back to an array
                myArray = storedArray ? JSON.parse(storedArray) : [];

                // Check if the item already exists in the array
                if (!myArray.includes(questionNumber)) {
                    myArray.push(
                        questionNumber); // Add the item only if it doesn't exist
                }

                // Update the session storage with the modified array
                sessionStorage.setItem("lst_choosen_option", JSON.stringify(myArray));

                count_remaining__attempt();

            },
            error: function (xhr, status, error) {
                console.error('Failed to save option:', error);
            }
        });
    });


    function exam_show(setNumber, questionNumber) {
        $('#exam').removeClass('hidden');

        fetch_exam(setNumber, questionNumber);

    }


    function fetch_exam(setNumber, questionNumber) {

        $.ajax({
            url: '/exam_question/exam',
            method: 'GET',
            data: {
                'setNumber': setNumber,
                'questionNumber': questionNumber,
            },
            success: function (response) {
                if (response.success.length == 0) {

                    var questionNumber = sessionStorage.getItem('currentQuestionNumber').replace(sessionStorage.getItem('currentSetNumber') + "_", "");
                    $("#question-number").text(questionNumber + ".");

                    $("#heading").text("");

                    $("#actual-question").text('No question!');

                    $("#option_1").text("");

                    $("#option_2").text("");

                    $("#option_3").text("");

                    $("#option_4").text("");

                    $('.option-active').removeClass('option-active');

                } else {

                    // Show the modal
                    $("#exam_table_popup").addClass('hidden');

                    // Iterate over each question
                    response.success.forEach(function (question) {
                        // Extract data from each question object
                        var questionNumber = question.question_number
                            .replace(question.set + "_", "");
                        var headingText = question.heading;
                        var questionText = question.question;
                        var option_1 = question.option1;
                        var option_2 = question.option2;
                        var option_3 = question.option3;
                        var option_4 = question.option4;
                        var q_type = question.question_type;
                        var ans_type = question.answer_type;

                        $("#heading").text(headingText);
                        $("#question-number").text(questionNumber +
                            ".");

                        if (q_type == 'audio') {

                            // Create an audio element and set its source
                            const audioElement = `
                                            <audio id="exam-audio-${question.question_number}">
                                    <source src="/exam_assets/audio/question_audio/${questionText}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                </audio>
                                
                                <button class="play_qn_audio" data-qn-audio="${question.question_number}" id="${question.question_number}">
                                <img class="w-20" src="/exam_assets/audio.jpg" alt="Play Audio">
                                </button>
                                `;
                            $("#actual-question").html(audioElement);

                        } else if (q_type == 'image') {
                            $("#actual-question").html(`<img class="h-auto max-w-md w-64 sm:w-64 md:w-80 lg:w-96" src = "/exam_assets/images/question_image/${questionText}" /> `);
                        } else {
                            $("#actual-question").text(questionText);
                        }

                        if (ans_type == 'audio') {
                            const option_1_audioElement = `
                            <audio controls>
                            <source src="/exam_assets/audio/option_audio/${option_1}" type="audio/mpeg">
                            Your browser does not support the audio element.
                            </audio>`;

                            $("#option_1").html(option_1_audioElement);
                            $('#option_1').attr('data-value', option_1);

                            const option_2_audioElement = `
                            <audio controls>
                            <source src="/exam_assets/audio/option_audio/${option_2}" type="audio/mpeg">
                            Your browser does not support the audio element.
                            </audio>`;

                            $("#option_2").html(option_2_audioElement);
                            $('#option_2').attr('data-value', option_2);

                            const option_3_audioElement = `
                            <audio controls>
                            <source src="/exam_assets/audio/option_audio/${option_3}" type="audio/mpeg">
                            Your browser does not support the audio element.
                            </audio>`;

                            $("#option_3").html(option_3_audioElement);
                            $('#option_3').attr('data-value', option_3);

                            const option_4_audioElement = `
                            <audio controls>
                            <source src="/exam_assets/audio/option_audio/${option_4}" type="audio/mpeg">
                            Your browser does not support the audio element.
                            </audio>`;

                            $("#option_4").html(option_4_audioElement);
                            $('#option_4').attr('data-value', option_4);

                        } else if (ans_type == 'image') {

                            $("#option_1").html(`<img class="h-auto max-w-40 w-16 sm:w-20 md:w-24 lg:w-40" src = "/exam_assets/images/option_image/${option_1}" /> `);
                            $('#option_1').attr('data-value', option_1);

                            $("#option_2").html(`<img class="h-auto max-w-40 w-16 sm:w-20 md:w-24 lg:w-40" src = "/exam_assets/images/option_image/${option_2}" /> `);
                            $('#option_2').attr('data-value', option_2);

                            $("#option_3").html(`<img class="h-auto max-w-40 w-16 sm:w-20 md:w-24 lg:w-40" src = "/exam_assets/images/option_image/${option_3}" /> `);
                            $('#option_3').attr('data-value', option_3);

                            $("#option_4").html(`<img class="h-auto max-w-40 w-16 sm:w-20 md:w-24 lg:w-40" src = "/exam_assets/images/option_image/${option_4}" /> `);
                            $('#option_4').attr('data-value', option_4);

                        } else {

                            $("#option_1").text(option_1.replace('_option_1', ''));
                            $('#option_1').attr('data-value', option_1);

                            $("#option_2").text(option_2.replace('_option_2', ''));
                            $('#option_2').attr('data-value', option_2);

                            $("#option_3").text(option_3.replace('_option_3', ''));
                            $('#option_3').attr('data-value', option_3);

                            $("#option_4").text(option_4.replace('_option_4', ''));
                            $('#option_4').attr('data-value', option_4);
                        }

                    });

                    $.ajax({
                        url: '/answer/is-answer',
                        method: 'GET',
                        data: {
                            "exam_start_time": sessionStorage.getItem('exam_start_time'),
                            'setNumber': setNumber,
                            'questionNumber': sessionStorage.getItem('currentQuestionNumber'),
                        },
                        success: function (is_answer_response) {

                            if (is_answer_response) {
                                const answerId = is_answer_response.data.ans.answer;

                                $('.option-active').removeClass('option-active');

                                // Select the element by ID
                                var element = $("#" + answerId);

                                // Add the 'option-active' class to the parent element
                                element.closest('.option-div').addClass('option-active');

                            } else {
                                $('.option-active').removeClass('option-active');

                            }
                        }
                    });
                }

            }

        });
    }

    function getFormattedDateTime() {
        const now = new Date();

        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        return `${year} -${month} -${day} ${hours}:${minutes}:${seconds} `;
    }

    function count_remaining__attempt() {

        if (sessionStorage.getItem("lst_choosen_option")) {

            // Retrieve the JSON string from session storage
            let storedArray = sessionStorage.getItem("lst_choosen_option");

            // Convert the JSON string back to an array
            let myArray = JSON.parse(storedArray);

            // Count the number of elements in the array
            let count = myArray.length;

            $('.attempted-num').text(count);
            $('.remaining-num').text(MAX_QUESTION - count);
        } else {

            $('.attempted-num').text('0');
            $('.remaining-num').text(MAX_QUESTION);

        }

    }

    $('.finish_exam-btn').on('click', function () {
        let exam_start_time = sessionStorage.getItem('exam_start_time')
        let exam_set_number = sessionStorage.getItem('currentSetNumber')

        $.ajax({
            url: '/exam_score/store',
            method: 'POST',
            data: {
                "exam_start_time": exam_start_time,
                "set_number": exam_set_number,
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {

                console.log(response)

                if (response.total_answered == 0) {
                    $('.total_answered_0').removeClass('hidden');
                } else {
                    $('#live_result_popup_overlay').removeClass('hidden')
                    $('#live_result_popup').removeClass('hidden')

                    $("#live_result_total_answered").text(response.total_answered);
                    $("#live_result_total_correct").text(response.total_correct);

                }

            },
            error: function (xhr, status, error) {
                console.error('Failed to save option:', error);
            }
        })
    });

    $('#live_result_close_popup').on('click', function () {
        window.location.href = "/";
    });

    $('#live_result_review_answer').on('click', function () {
        let exam_start_time = sessionStorage.getItem('exam_start_time')
        window.location.href = "/exam_score/detail?exam_start_time=" + exam_start_time;
    });


    // Add Exam
    $('#questionForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the form from submitting normally

        let isValid = true;

        if (!$('#set_number').val()) {
            $('#set_number_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#set_number_error').addClass('hidden');
        }

        if (!$('#question_number').val()) {
            $('#question_number_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#question_number_error').addClass('hidden');

            if ($('#question_number').val() > 40) {
                $('#question_number_l40_error').removeClass('hidden');
                isValid = false;
            } else {
                $('#question_number_l40_error').addClass('hidden');
            }
        }

        if (!$('#question').val()) {
            $('#question_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#question_error').addClass('hidden');
        }

        if (!$('#question_type').val()) {
            $('#question_type_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#question_type_error').addClass('hidden');
        }

        if (!$('#question_description').val()) {
            if (!$('#question_type').val() || $('#question_type').val() == 'text') {
                $('#question_description_error').removeClass('hidden');
                isValid = false;
            }
        } else {
            $('#question_description_error').addClass('hidden');
        }

        if ($('#question_type').val() === 'image' && (!$('#question_description_image').prop('files') || $('#question_description_image').prop('files').length === 0)) {
            $('#question_description_image_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#question_description_image_error').addClass('hidden');
        }

        if ($('#question_type').val() === 'audio' && (!$('#question_description_audio').prop('files') || $('#question_description_audio').prop('files').length === 0)) {
            $('#question_description_audio_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#question_description_audio_error').addClass('hidden');
        }

        if (!$('#answer_type').val()) {
            $('#answer_type_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#answer_type_error').addClass('hidden');
        }

        // QuestionType = Text
        if (!$('#option_1').val()) {
            if (!$('#answer_type').val() || $('#answer_type').val() == 'text') {
                $('#option_1_error').removeClass('hidden');
                isValid = false;
            }
        } else {
            $('#option_1_error').addClass('hidden');
        }

        if (!$('#option_2').val()) {
            if (!$('#answer_type').val() || $('#answer_type').val() == 'text') {
                $('#option_2_error').removeClass('hidden');
                isValid = false;
            }
        } else {
            $('#option_2_error').addClass('hidden');
        }

        if (!$('#option_3').val()) {
            if (!$('#answer_type').val() || $('#answer_type').val() == 'text') {
                $('#option_3_error').removeClass('hidden');
                isValid = false;
            }
        } else {
            $('#option_3_error').addClass('hidden');
        }

        if (!$('#option_4').val()) {
            if (!$('#answer_type').val() || $('#answer_type').val() == 'text') {
                $('#option_4_error').removeClass('hidden');
                isValid = false;
            }
        } else {
            $('#option_4_error').addClass('hidden');
        }

        // Question Type = image
        if ($('#answer_type').val() === 'image' && (!$('#option_1_image').prop('files') || $('#option_1_image').prop('files').length === 0)) {
            $('#option_1_error').addClass('hidden');
            $('#option_1_image_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#option_1_image_error').addClass('hidden');
        }

        if ($('#answer_type').val() === 'image' && (!$('#option_2_image').prop('files') || $('#option_2_image').prop('files').length === 0)) {
            $('#option_2_error').addClass('hidden');
            $('#option_2_image_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#option_2_image_error').addClass('hidden');
        }

        if ($('#answer_type').val() === 'image' && (!$('#option_3_image').prop('files') || $('#option_3_image').prop('files').length === 0)) {
            $('#option_3_error').addClass('hidden');
            $('#option_3_image_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#option_3_image_error').addClass('hidden');
        }

        if ($('#answer_type').val() === 'image' && (!$('#option_4_image').prop('files') || $('#option_4_image').prop('files').length === 0)) {
            $('#option_4_error').addClass('hidden');
            $('#option_4_image_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#option_4_image_error').addClass('hidden');
        }

        // Question Type = audio
        if ($('#answer_type').val() === 'audio' && (!$('#option_1_audio').prop('files') || $('#option_1_audio').prop('files').length === 0)) {
            $('#option_1_error').addClass('hidden');
            $('#option_1_audio_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#option_1_audio_error').addClass('hidden');
        }

        if ($('#answer_type').val() === 'audio' && (!$('#option_2_audio').prop('files') || $('#option_2_audio').prop('files').length === 0)) {
            $('#option_2_error').addClass('hidden');
            $('#option_2_audio_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#option_2_audio_error').addClass('hidden');
        }

        if ($('#answer_type').val() === 'audio' && (!$('#option_3_audio').prop('files') || $('#option_3_audio').prop('files').length === 0)) {
            $('#option_3_error').addClass('hidden');
            $('#option_3_audio_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#option_3_audio_error').addClass('hidden');
        }

        if ($('#answer_type').val() === 'audio' && (!$('#option_4_audio').prop('files') || $('#option_4_audio').prop('files').length === 0)) {
            $('#option_4_error').addClass('hidden');
            $('#option_4_audio_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#option_4_audio_error').addClass('hidden');
        }

        if (!$('#correct_answer').val()) {
            $('#correct_answer_error').removeClass('hidden');
            isValid = false;
        } else {
            $('#correct_answer_error').addClass('hidden');
        }

        if (isValid) {

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                contentType: false, // Important for file uploads
                processData: false, // Important for file uploads
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content') // CSRF token
                },
                success: function (response) {

                    // Display the popup
                    $('#popup').removeClass('hidden');
                },
                error: function (xhr) {
                    // Handle error response
                    console.log('Error:', xhr.responseText);
                }
            });
        }
    });

    // Close the popup
    $('#closePopup').on('click', function () {
        $('#popup').addClass('hidden');

        $('#questionForm')[0].reset();
    });


    // Add another question
    $('#addAnotherQuestion').on('click', function () {
        // Hide the popup
        $('#popup').addClass('hidden');

        // Reset the form fields except for set_number and question_number
        $('#questionForm').find('input[type="text"], textarea, input[type="file"]').val('');
        $('#questionForm').find('select').val('');

        // Reset image previews
        $('#question_image_preview').attr('src', '').addClass('hidden');
        $('#option_1_preview').attr('src', '').addClass('hidden');
        $('#option_2_preview').attr('src', '').addClass('hidden');
        $('#option_3_preview').attr('src', '').addClass('hidden');
        $('#option_4_preview').attr('src', '').addClass('hidden');

        // Preserve set_number and question_number values
        let setNumber = $('#set_number').val();
        $('#set_number').val(setNumber);

        let questionNumberInput = $('#question_number');
        let currentQuestionNumber = parseInt(questionNumberInput.val(), 10);
        if (!isNaN(currentQuestionNumber)) {
            questionNumberInput.val(currentQuestionNumber + 1);
        }

    });

    let editqn_QuestionNumber;

    $('.question-num-item').on('click', function () {
        editqn_QuestionNumber = $(this).data('question-number');
        let editqn_SetNumber = '';

        if (sessionStorage.getItem('edit-qn')) {

            $('#setnum-container').removeClass('hidden');
            $('#setnumber-input').addClass('hidden');

            editqn_SetNumber = JSON.parse(sessionStorage.getItem('edit-qn'))[0];

            $('#Setno').text("Set number: " + editqn_SetNumber)
        } else {

            $('#setnumber-input').val('');
            $('#setnumber-input').removeClass('hidden');

        }

        $('#Qno').text("Question number: " + editqn_QuestionNumber);

        $('#store_set_number_popup').removeClass('hidden');

        $('#invalid-message').addClass('hidden');
    });


    $('#cancel_old_setno').on('click', function () {

        $('#invalid-message').addClass('hidden');

        $('#setnum-container').addClass('hidden');
        $('#setnumber-input').removeClass('hidden');

    });


    $('#submit-setnumber').on('click', function () {
        let setnumber = $('#setnumber-input').val();

        if (setnumber) {
            setnumber = parseInt(setnumber);

            sessionStorage.setItem('edit-qn', JSON.stringify([setnumber, editqn_QuestionNumber]));
        }

        let get_setnum = JSON.parse(sessionStorage.getItem('edit-qn'))[0];
        let get_qnum = editqn_QuestionNumber;

        $.ajax({
            url: '/exam_question/exam',
            method: 'GET',
            data: {
                'setNumber': 'set_' + get_setnum,
                'questionNumber': 'set_' + get_setnum + "_" + get_qnum,
            },
            success: function (response) {

                if (response.success.length <= 0) {

                    $('#invalid-message').removeClass('hidden');

                } else {

                    $('#edit-question-drawer').removeClass('-translate-x-full');
                    $('#editQuestionForm')[0].reset();

                    $('#store_set_number_popup').addClass('hidden');


                    // Iterate over each question
                    response.success.forEach(function (question) {
                        // Extract data from each question object
                        var set_number = get_setnum;
                        var questionNumber = question.question_number.replace(question.set + "_", "");
                        var headingText = question.heading;
                        var q_type = question.question_type;
                        var questionText = question.question;
                        var option_1 = question.option1;
                        var option_2 = question.option2;
                        var option_3 = question.option3;
                        var option_4 = question.option4;
                        var ans_type = question.answer_type;
                        var correct_answer = question.correct_answer;

                        // Set the values of the inputs
                        $("#edit_set_number").val(set_number);
                        $("#edit_question").val(headingText);
                        $("#edit_question_number").val(questionNumber);
                        $("#edit_question_type").val(q_type);

                        const questionType = q_type;
                        const $questionDescriptionContainer = $('#edit_question_description_container');
                        const $questionImagePreview = $('#edit_question_image_preview');
                        const $questionAudioPreview = $('#edit_question_audio_preview');

                        // Check if the current element is a file input, textarea, or audio element
                        const $currentElement = $('#edit_question_description_image, #edit_question_description_audio, #edit_question_description');

                        if (questionType === 'image') {
                            // Create a new file input for the image
                            const $fileInput = $('<input>', {
                                type: 'file',
                                name: 'question_description_image',
                                id: 'edit_question_description_image',
                                class: $currentElement.attr('class'),
                                accept: 'image/*'
                            }).on('change', function () {
                                previewImage($fileInput[0], $questionImagePreview[0]);

                            });

                            $currentElement.replaceWith($fileInput);
                            $questionImagePreview.removeClass('hidden');
                            $questionAudioPreview.addClass('hidden');

                            if (questionText) {

                                const imageUrl = '/exam_assets/images/question_image/' + questionText;
                                $questionImagePreview.attr('src', imageUrl).removeClass('hidden');

                            }
                        } else if (questionType === 'audio') {
                            // Create a new file input for the audio
                            const $fileInput = $('<input>', {
                                type: 'file',
                                name: 'question_description_audio',
                                id: 'edit_question_description_audio',
                                class: $currentElement.attr('class'),
                                accept: 'audio/*'
                            }).on('change', function () {
                                previewAudio($fileInput[0], $questionAudioPreview[0]);
                            });

                            $currentElement.replaceWith($fileInput);
                            $questionImagePreview.addClass('hidden');
                            $questionAudioPreview.removeClass('hidden');

                            if (questionText) {

                                const audioURL = '/exam_assets/audio/question_audio/' + questionText;
                                $questionAudioPreview.attr('src', audioURL).removeClass('hidden');

                            }
                        } else {
                            // Create a new textarea for the text
                            const $textarea = $('<textarea>', {
                                name: 'question_description',
                                id: 'edit_question_description',
                                class: $currentElement.attr('class')
                            });

                            $currentElement.replaceWith($textarea);
                            $questionImagePreview.addClass('hidden');
                            $questionAudioPreview.addClass('hidden');

                            // If it's a text question, set the text
                            $textarea.val(questionText);
                        }

                        $("#edit_answer_type").val(ans_type);


                        const options = [option_1, option_2, option_3, option_4];

                        for (let i = 1; i <= 4; i++) {
                            // Get the current element (either the text input, image input, or audio input)
                            const currentElement = $('#edit_option_' + i + '_image')[0] ||
                                $('#edit_option_' + i + '_audio')[0] ||
                                $('#edit_option_' + i)[0];

                            const optionPreview = $('#edit_option_' + i + '_preview');
                            const optionAudioPreview = $('#edit_option_' + i + '_audio_preview');

                            if (currentElement) {
                                if (ans_type === 'image') {
                                    // Create a new file input for the image
                                    const $fileInput = $('<input>', {
                                        type: 'file',
                                        name: 'option_' + i + '_image',
                                        id: 'edit_option_' + i + '_image',
                                        class: currentElement.className,
                                        accept: 'image/*'
                                    }).on('change', function () {
                                        previewImage(this, optionPreview[0]);
                                    });

                                    $(currentElement).replaceWith($fileInput);
                                    optionPreview.removeClass('hidden');
                                    optionAudioPreview.addClass('hidden');

                                    // Set the existing image if available
                                    if (options[i - 1]) {

                                        const optionImageURL = '/exam_assets/images/option_image/' + options[i - 1];

                                        optionPreview.attr('src', optionImageURL);
                                    }
                                } else if (ans_type === 'audio') {
                                    // Create a new file input for the audio
                                    const $fileInput = $('<input>', {
                                        type: 'file',
                                        name: 'option_' + i + '_audio',
                                        id: 'edit_option_' + i + '_audio',
                                        class: currentElement.className,
                                        accept: 'audio/*'
                                    }).on('change', function () {
                                        previewAudio(this, optionAudioPreview[0]);
                                    });

                                    $(currentElement).replaceWith($fileInput);
                                    optionPreview.addClass('hidden');
                                    optionAudioPreview.removeClass('hidden');

                                    if (options[i - 1]) {

                                        const optionAudioURL = '/exam_assets/audio/option_audio/' + options[i - 1];

                                        optionAudioPreview.attr('src', optionAudioURL);

                                    }
                                } else {
                                    // Create a new text input for the text
                                    const $textInput = $('<input>', {
                                        type: 'text',
                                        name: 'option_' + i,
                                        id: 'edit_option_' + i,
                                        class: currentElement.className
                                    });

                                    $(currentElement).replaceWith($textInput);
                                    optionPreview.addClass('hidden');
                                    optionAudioPreview.addClass('hidden');

                                    // Set the value for the text option
                                    if (options[i - 1]) {
                                        // Remove the "_option_*" suffix from the value
                                        const valueWithoutSuffix = options[i - 1].replace(/_option_\d+$/, '');
                                        $textInput.val(valueWithoutSuffix);
                                    }
                                }
                            }
                        }

                        $("#edit_correct_answer").val(correct_answer);

                    });
                }
            }
        });
    });


    $('#store_set_number-close-popup').on('click', function () {
        $('#store_set_number_popup').addClass('hidden');
    });


    $('#close-edit-question-drawer').on('click', function () {

        $('#edit-question-drawer').addClass('-translate-x-full');
    });

    $('#cancel_edit_form').on('click', function () {

        $('#edit-question-drawer').addClass('-translate-x-full');
    });

    $('#editQuestionForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the form from submitting normally

        // Create a FormData object to handle file uploads
        var formData = new FormData($('#editQuestionForm')[0]);

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            contentType: false, // Important for file uploads
            processData: false, // Important for file uploads
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content') // CSRF token
            },
            success: function (response) {

                if (response.success) {

                    $('#edit-question-drawer').addClass('-translate-x-full');

                }

            },
            error: function (xhr) {
                // Parse the JSON response
                var errorResponse = JSON.parse(xhr.responseText);

                // Display the error message
                if (errorResponse.error) {
                    $('#update-error-msg').text(errorResponse.error);
                } else {
                    $('#update-error-msg').text('An unexpected error occurred.');
                }
            }
        });

    });

    // Function to preview the selected image
    function previewImage(fileInput, previewElement) {
        const file = fileInput.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
            $(previewElement).attr('src', e.target.result).removeClass('hidden');
        };
        reader.readAsDataURL(file);
    }

    // Function to preview the selected audio
    function previewAudio(fileInput, previewElement) {
        const file = fileInput.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
            $(previewElement).attr('src', e.target.result).removeClass('hidden');
        };
        reader.readAsDataURL(file);
    }

    function truncateString(str) {
        if (str.length > 20) {
            return str.substring(0, 20) + '...';
        }
        return str;
    }

    // Handle audio button click and play limit
    $(document).on('click', '.play_qn_audio', function () {
        console.log('audio-click');
        let buttonId = $(this).data('qn-audio');
        let audioId = `exam-audio-${buttonId}`;
        playAudio(audioId, buttonId);
    });

    let audioPlayCount = {};

    function playAudio(audioId, buttonId) {
        if (!audioPlayCount[audioId]) {
            audioPlayCount[audioId] = 0;
        }

        if (audioPlayCount[audioId] < 2) {
            let audioElement = $('#' + audioId)[0];
            audioElement.play();
            audioPlayCount[audioId]++;

            if (audioPlayCount[audioId] == 2) {
                $('#' + buttonId).prop('disabled', true).css('opacity', '0.5');
            }
        } else {
            // alert("You have reached the maximum play limit for this audio.");
        }
    }

});
