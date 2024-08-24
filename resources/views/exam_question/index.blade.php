<x-app-layout>

    <div class="grid grid-cols-3 gap-4">

        @foreach ($exam_sets as $exam_set)
            <div class="flex flex-col items-center p-6 bg-white border border-gray-200 rounded-lg shadow">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">UBT {{ $exam_set }}</h5>

                <p id="attemptButton" data-set-number ="{{ $exam_set }}"
                    class="attemptButton inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Attempt
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </p>

                <p id="reattemptButton" data-set-number ="{{ $exam_set }}"
                    class="reattemptButton inline-flex text-sm font-light items-center py-2 text-red-900 hover:underline">
                    Attempted. Would you like to try again?
                </p>
            </div>
        @endforeach

    </div>


    @include('exam_question.exam_table')
    @include('exam_question.exam')


    <script>
        $(document).ready(function() {
            $('.attemptButton').on('click', function(e) {

                var setNumber = $(this).data('set-number');
                console.log('clicked' + " " + setNumber);

                var formattedSetName = setNumber.replace('set_', 'Set ').replace(/(\d+)/,
                    function(match) {
                        return match.padStart(2, '0');
                    });

                $(".modal_set_number").text("UBT " + formattedSetName);

                $('.question-item').on('click', function(e) {
                    const questionNumber = $(this).data('question-number');
                    console.log('Question item clicked: ' + questionNumber + ' of set: ' +
                        setNumber);


                    $.ajax({
                        url: '/exam_question/exam_table',
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
                                var questionNumber = question.question_number;
                                var questionType = question.question_type;
                                var questionText = question.question;
                                var answerType = question.answer_type;
                                var option_1 = question.option1;
                                var option_2 = question.option2;
                                var option_3 = question.option3;
                                var option_4 = question.option4;

                                var correctAnswer = question.correct_answer;

                                $("#heading").text("Add yourself");
                                $("#question-number").text(questionNumber);
                                $("#actual-question").text(questionText);
                                $("#option_1").text(option_1);
                                $("#option_2").text(option_2);
                                $("#option_3").text(option_3);
                                $("#option_4").text(option_4);
                            });


                        }

                    });
                });

                // Show the modal
                $("#exam_table_popup").removeClass('hidden');



            });

            // Hide the popup on close button click
            $('#closePopup').on('click', function() {
                $('#exam_table_popup').addClass('hidden');

                $('.mid-section').attr('data-set', "");
            });
        });
    </script>
</x-app-layout>
