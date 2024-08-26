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

    <script>
        $(document).ready(function() {
            $("#navbar").removeClass('hidden');

            $('.attemptButton').on('click', function(e) {

                var setNumber = $(this).data('set-number');
                console.log('clicked' + " " + setNumber);

                var formattedSetName = setNumber.replace('set_', 'Set ').replace(/(\d+)/,
                    function(match) {
                        return match.padStart(2, '0');
                    });

                $(".modal_set_number").text("UBT " + formattedSetName);

                // Show the modal
                $("#exam_table_popup").removeClass('hidden');

                $('.question-item').on('click', function(e) {
                    const questionNumber = $(this).data('question-number');

                    formated_questionNumber = setNumber + "_" + questionNumber;

                    // Store set number and question number in session storage
                    sessionStorage.setItem('currentSetNumber', setNumber);
                    sessionStorage.setItem('currentQuestionNumber', formated_questionNumber);

                    let url = "{{ route('exam_question.start_exam') }}"

                    window.location.href = url;

                });

            });

        });
    </script>
</x-app-layout>
