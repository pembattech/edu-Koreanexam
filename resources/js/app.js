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
            }
        }

        // Call updateTimer every 1 second
        const timerInterval = setInterval(updateTimer, 1000);

        // Initialize the timer display
        updateTimer();

        const currentDateTime = getFormattedDateTime();
        console.log(currentDateTime);

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

            console.log(setNumber, formated_questionNumber);

            exam_show(setNumber, formated_questionNumber);

        });

    });




    // Function to update session storage and fetch exam
    function updateQuestion(setNumber, new_q_num_int) {

        let new_q_num = setNumber + "_" + new_q_num_int;
        sessionStorage.setItem('currentSetNumber', setNumber);
        sessionStorage.setItem('currentQuestionNumber', new_q_num);
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
                console.log('Option saved successfully:', response);

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

                // Output the updated array to the console
                console.log(myArray);

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
                console.log(response);

                if (response.success.length == 0) {

                    var questionNumber = sessionStorage.getItem('currentQuestionNumber').replace(sessionStorage.getItem('currentSetNumber') + "_", "");
                    $("#question-number").text(questionNumber + ".");

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
                        var questionText = question.question;
                        var option_1 = question.option1;
                        var option_2 = question.option2;
                        var option_3 = question.option3;
                        var option_4 = question.option4;
                        var q_type = question.question_type;

                        $("#heading").text("Add yourself");
                        $("#question-number").text(questionNumber +
                            ".");

                        if (q_type == 'audio') {
                            // 
                        } else if (q_type == 'image') {
                            $("#actual-question").html(`<img src="/exam_images/${questionText}" />`);
                        } else {
                            $("#actual-question").text(questionText);
                        }

                        $("#option_1").text(option_1);
                        $('#option_1').attr('data-value', option_1);

                        $("#option_2").text(option_2);
                        $('#option_2').attr('data-value', option_2);

                        $("#option_3").text(option_3);
                        $('#option_3').attr('data-value', option_3);

                        $("#option_4").text(option_4);
                        $('#option_4').attr('data-value', option_4);

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

        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }

    function count_remaining__attempt() {

        if (sessionStorage.getItem("lst_choosen_option")) {
            console.log('counting!');

            // Retrieve the JSON string from session storage
            let storedArray = sessionStorage.getItem("lst_choosen_option");

            // Convert the JSON string back to an array
            let myArray = JSON.parse(storedArray);

            // Count the number of elements in the array
            let count = myArray.length;

            $('.attempted-num').text(count);
            $('.remaining-num').text(MAX_QUESTION - count);
        } else {
            console.log('erased!');

            $('.attempted-num').text('0');
            $('.remaining-num').text(MAX_QUESTION);

        }

    }

    $('.finish_exam-btn').on('click', function () {
        let exam_start_time = sessionStorage.getItem('exam_start_time')

        $.ajax({
            url: '/exam_score/store',
            method: 'POST',
            data: {
                "exam_start_time": exam_start_time,
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                console.log(response);

                window.location.href = "/";
            },
            error: function (xhr, status, error) {
                console.error('Failed to save option:', error);
            }
        })
    });







});



// // exam_question: exam_table


// // exam_question: exam

// // Wait for the entire page to load
// $(window).on('load', function () {
//     // Show the content
//     $('#exam').fadeIn(700);
// });

