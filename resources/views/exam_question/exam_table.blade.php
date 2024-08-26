<div id="exam_table_popup" class=" hidden fixed inset-0 bg-gray-100 h-screen">

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="topbar flex justify-between border text-xl p-4 bg-white">

            <div>
                <p class="font-medium">{{ auth()->user()->name }}</p>
            </div>

            <div>
                <p class="modal_set_number font-medium">
                    {{-- Auto Gen --}}
                </p>
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

        <div class="mid-section grid gap-4 grid-cols-[1fr_1fr] text-xl mt-2 p-4 bg-white">
            <div class="border">

                <p class="p-4 font-medium text-center">
                    Reading
                </p>

                <div class="right-question-item grid grid-cols-5 gap-4">

                    @for ($i = 1; $i <= 20; $i++)

                            <p data-question-number= "{{ $i }}"
                                class="question-item cursor-pointer hover:font-bold border-2 border-black p-4 text-center">
                                {{ $i }}
                            </p>
                    @endfor
                </div>


            </div>

            <div class="border">
                <p class="p-4 font-medium text-center">
                    Listening
                </p>

                <div class="grid grid-cols-5 gap-4">
                    @for ($i = 21; $i <= 40; $i++)
                        <p data-question-number= "{{ $i }}"
                            class="question-item cursor-pointer hover:font-bold border-2 border-black p-4 text-center">
                            {{ $i }}</p>
                    @endfor
                </div>
            </div>



        </div>

        <div class="lower-section flex justify-around border text-xl p-4 mt-2 bg-white">

            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl px-4 py-2">Submit
                and Finish Exam</button>

        </div>
    </div>

    <div id="closePopup" class="cursor-pointer">Close</div>
</div>



<script>
    // $(document).ready(function() {
    //     // Attach event listener to question items within the modal after data-set is updated
    //     $('.question-item').on('click', function(e) {
    //         const setNumber = $(".mid-section").data('set');
    //         const questionNumber = $(this).data('question-number');
    //         console.log('Clicked question ' + questionNumber + ' of set: ' + setNumber);
    //     });
    // });

    // $.ajax({
    //     url: '/exam_question/exam_table',
    //     method: 'GET',
    //     data: {
    //         'setNumber': setNumber
    //     },
    //     success: function(response) {
    //         // Get the 'success' data from the response
    //         var examSetQuestions = response.success;

    //         var formattedSetName = setNumber.replace('set_', 'Set ').replace(/(\d+)/,
    //             function(match) {
    //                 return match.padStart(2, '0');
    //             });
    //         $(".modal_set_number").text("UBT " + formattedSetName);


    //         // Show the modal
    //         $("#exam_table_popup").removeClass('hidden');


    //         // const right_question_section = $(".right-question-item");

    //         // // Clear any existing content in the right_question_section
    //         // right_question_section.html('');



    //         // // Loop through the array of exam set questions
    //         // examSetQuestions.forEach(function(question, index) {
    //         //     if (question.question_type === 'text') {
    //         //         // Create a new <p> tag for text questions
    //         //         var textQuestionHtml = `<p class="question-item cursor-pointer hover:font-bold border-2 border-black p-4 text-center">
    //     //                 Question ${index + 1}: ${question.question}
    //     //             </p>`;
    //         //         // Append the <p> tag to the right_question_section
    //         //         right_question_section.append(textQuestionHtml);
    //         //     }

    //         //     if (question.question_type === 'image') {
    //         //         // Create a new <p> tag for image questions (you can modify the content as needed)
    //         //         var imageQuestionHtml = `<p class="question-item cursor-pointer hover:font-bold border-2 border-black p-4 text-center">
    //     //                 Question ${index + 1}: <img src="/path/to/images/${question.question}" alt="Question Image">
    //     //             </p>`;
    //         //         // Append the <p> tag to the right_question_section
    //         //         right_question_section.append(imageQuestionHtml);
    //         //     }
    //         // });



    //     }
    // });
</script>
