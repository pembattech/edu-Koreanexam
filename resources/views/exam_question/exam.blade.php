<div id="exam" class="hidden fixed inset-0 bg-gray-100 overflow-auto">

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        @include('exam_question.topbar')

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

                <div class="exam_question py-4 flex items-center justify-center">
                    <p id="actual-question" class="font-normal text-2xl text-center">
                        {{-- Auto Generate --}}
                    </p>
                </div>
            </div>

            <div class="option-section overflow-auto bg-white">
                <div class="option-div cursor-pointer w-full border text-2xl p-4">
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
                class="previous-question-btn text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-bg-orange-300 font-medium rounded-lg text-lg sm:text-xl md:text-2xl lg:text-2xl px-4 py-2">Previous
                Question</button>
            <button
                class="question-list-btn text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-bg-slate-300 font-medium rounded-lg text-lg sm:text-xl md:text-2xl lg:text-2xl px-4 py-2">Question
                List</button>
            <button
                class="next-question-btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg sm:text-xl md:text-2xl lg:text-2xl px-4 py-2">Next
                Question</button>
            <button
                class="submit-exam-btn hidden text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-lg sm:text-xl md:text-2xl lg:text-2xl px-4 py-2">Submit
                Exam</button>
        </div>
    </div>

    <div id="exam_finish_confirmation_popup"
        class="fixed inset-0 z-50 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 id="popup-title" class="text-xl font-bold mb-4">Confirmation</h2>
            <p id="popup-content" class="text-base">Are you sure you want to submit the exam?</p>

            <p class="total_answered_0 hidden text-red-500 text-2xl p-2 font-semibold text-center">Submission failed:
                Please answer at least one question before submitting the exam.</p>


            <div class="mt-4 flex justify-end space-x-4">
                <button
                    class="finish_exam-btn bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Confirm
                </button>
                <button id="exam_finish_confirmation_cancel-popup"
                    class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Cancel
                </button>
            </div>
        </div>
    </div>

</div>

{{-- <script>
    $(document).on('click', '.play_qn_audio', function() {
        console.log('audio-click');
        let audioId = $(this).data('qn-audio'); // Get the audio ID from the data attribute
        playAudio(audioId, this); // Pass the button reference
    });
</script> --}}
