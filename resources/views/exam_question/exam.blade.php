<x-app-layout>

    <div id="exam_popup" class="fixed inset-0 bg-gray-100 h-screen">

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="topbar flex justify-between border text-xl p-4 bg-white">

                <div>
                    <p class="font-medium">{{ auth()->user()->name }}</p>
                </div>

                <div>
                    <p class="font-medium">UBT Set 1</p>
                </div>

                <div>
                    <p class="font-medium">
                        Remaining: 40
                    </p>
                </div>

                <div>
                    <p class="font-medium">
                        Attempt: 0
                    </p>
                </div>

                <div>
                    <p class="font-medium">39:34</p>
                </div>

            </div>

            <div class="mid-section grid gap-4 grid-cols-[2fr_1fr] border text-xl mt-2 p-4 bg-white">

                <div class="bg-white overflow-auto">

                    <div class="exam_question_description py-4">
                        <p class="font-semibold text-2xl">
                            <span id="question-number">
                                {{-- Auto Generate --}}
                            </span>
                            <span id="heading">
                                {{-- Auto Generate --}}
                            </span>
                        </p>
                    </div>

                    <div class="exam_question py-4">
                        <p id="actual-question" class="font-normal text-2xl text-center">
                            {{-- Auto Generate --}}
                        </p>
                    </div>
                </div>

                <div class="option-section overflow-auto bg-white">
                    <div class="option-div cursor-pointer border text-2xl p-4">
                        <p class="flex items-center">
                            <span
                                class="number-data border rounded-full bg-white text-black p-2 w-8 h-8 flex items-center justify-center">
                                1
                            </span>
                            <span id="option_1" class="option-data ml-2">
                                {{-- Auto Generate --}}
                            </span>
                        </p>
                    </div>


                    <div class="option-div cursor-pointer border text-2xl p-4">
                        <p class="flex items-center">
                            <span
                                class="number-data border rounded-full bg-white text-black p-2 w-8 h-8 flex items-center justify-center">
                                2
                            </span>
                            <span id="option_2" class="option-data ml-2">
                                {{-- Auto Generate --}}
                            </span>
                        </p>
                    </div>


                    <div class="option-div cursor-pointer border text-2xl p-4">
                        <p class="flex items-center">
                            <span
                                class="number-data border rounded-full bg-white text-black p-2 w-8 h-8 flex items-center justify-center">
                                3
                            </span>
                            <span id="option_3" class="option-data ml-2">
                                {{-- Auto Generate --}}
                            </span>
                        </p>

                    </div>

                    <div class="option-div cursor-pointer border text-2xl p-4">
                        <p class="flex items-center">
                            <span
                                class="number-data border rounded-full bg-white text-black p-2 w-8 h-8 flex items-center justify-center">
                                4
                            </span>
                            <span id="option_4" class="option-data ml-2">
                                {{-- Auto Generate --}}
                            </span>
                        </p>

                    </div>


                </div>
            </div>

            <div class="lower-section flex justify-around border text-xl p-4 mt-2 bg-white">
                <button
                    class="previous-question-btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl px-4 py-2">Previous
                    Question</button>
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl px-4 py-2">Question
                    List</button>
                <button
                    class="next-question-btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl px-4 py-2">Next
                    Question</button>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                const MAX_QUESTION = 40;
                const MIN_QUESTION = 1;

                // Retrieve the set number and question number
                const setNumber = sessionStorage.getItem('currentSetNumber');
                const questionNumber = sessionStorage.getItem('currentQuestionNumber');

                var q_num = questionNumber.replace(setNumber + "_", "");
                var q_num_int = parseInt(q_num, 10); // Ensure base 10 conversion

                $('.next-question-btn').on('click', function() {
                    q_num_int += 1;

                    console.log(q_num_int);

                    if (q_num_int <= MAX_QUESTION) {


                        // Store set number and question number in session storage
                        sessionStorage.setItem('currentSetNumber', setNumber);
                        sessionStorage.setItem('currentQuestionNumber', setNumber + "_" + q_num_int);

                        let url = "{{ route('exam_question.start_exam') }}"

                        window.location.href = url;
                    }
                });


                $('.previous-question-btn').on('click', function() {
                    q_num_int -= 1;

                    if (q_num_int >= MIN_QUESTION) {

                    // Store set number and question number in session storage
                    sessionStorage.setItem('currentSetNumber', setNumber);
                    sessionStorage.setItem('currentQuestionNumber', setNumber + "_" + q_num_int);

                    let url = "{{ route('exam_question.start_exam') }}"

                    window.location.href = url;

                    }
                });


                $.ajax({
                    url: '/exam_question/exam',
                    method: 'GET',
                    data: {
                        'setNumber': setNumber,
                        'questionNumber': questionNumber,
                    },
                    success: function(response) {

                        console.log(response)

                        // Show the modal
                        $("#exam_table_popup").addClass('hidden');
                        $("#exam_popup").removeClass('hidden');

                        // Iterate over each question
                        response.success.forEach(function(question) {
                            // Extract data from each question object

                            var questionNumber = question.question_number
                                .replace(question.set + "_", "");
                            var questionType = question.question_type;
                            var questionText = question.question;
                            var answerType = question.answer_type;
                            var option_1 = question.option1;
                            var option_2 = question.option2;
                            var option_3 = question.option3;
                            var option_4 = question.option4;
                            var set = question.set;

                            // // Store set number and question number in session storage
                            // sessionStorage.setItem('currentSetNumber', set);
                            // sessionStorage.setItem('currentQuestionNumber',
                            //     questionNumber);

                            $("#heading").text("Add yourself");
                            $("#question-number").text(questionNumber +
                                ".");
                            $("#actual-question").text(questionText);
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
                                'setNumber': setNumber,
                                'questionNumber': questionNumber,
                            },
                            success: function(is_answer_response) {
                                if (is_answer_response) {

                                    const answerId = is_answer_response.data.ans.answer;

                                    // Select the element by ID
                                    var element = $("#" + answerId);

                                    // Add the 'option-active' class to the parent element
                                    element.closest('.option-div').addClass('option-active');

                                }
                            }
                        });



                    }

                });

                // Select all option elements
                $('.option-div').on('click', function() {
                    // Remove 'option-active' class from all options
                    $('.option-div').removeClass('option-active');

                    // Add 'option-active' class to the clicked option
                    $(this).addClass('option-active');

                    // Get the data-value attribute directly from the clicked option's span with the option-data class
                    var chosenOption = $(this).find('.option-data').data('value');

                    // Make an AJAX request to store the user's choice
                    $.ajax({
                        url: '/answer/store-user-choice',
                        method: 'POST',
                        data: {
                            'chosenOption': chosenOption,
                            'question_number': questionNumber,
                            'setNumber': setNumber,
                            '_token': '{{ csrf_token() }}' // Include CSRF token for security
                        },
                        success: function(response) {
                            console.log('Option saved successfully:', response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Failed to save option:', error);
                        }
                    });
                });
            });
        </script>
</x-app-layout>
