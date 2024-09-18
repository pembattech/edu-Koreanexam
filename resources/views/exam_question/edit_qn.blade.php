<!-- Edit Question Drawer Component -->
<div id="edit-question-drawer"
    class="fixed top-0 left-0 z-50 w-full h-full p-4 overflow-y-auto transition-transform duration-700 transform -translate-x-full bg-gradient-to-b from-blue-400 via-blue-300 to-blue-200"
    tabindex="-1" aria-labelledby="edit-question-label">

    <button type="button" id="close-edit-question-drawer" data-drawer-hide="edit-question-drawer"
        aria-controls="edit-question-drawer"
        class="text-gray-900 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close menu</span>
    </button>


    <form method="POST" action="{{ route('exam_question.store') }}" enctype="multipart/form-data"
        id= "editQuestionForm" class="px-4 mx-auto max-w-2xl" novalidate>

        <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight md:text-3xl lg:text-4xl text-gray-600">
            Edit Question</h1>

        @csrf
        <div class="grid gap-4 sm:grid-cols-[1fr_1fr] sm:gap-6">

            <div class="mb-2">
                <label class="block mb-2 text-base font-medium text-gray-900" for="set_number">Set
                    Number:</label>
                <input type="number"
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="edit_set_number" name="set_number" required disabled>


            </div>

            <div class="mb-2">
                <label class="block mb-2 text-base font-medium text-gray-900" for="question_number">Question
                    Number:</label>
                <input type="number"
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="edit_question_number" name="question_number" required disabled>

            </div>

        </div>

        <div class="mb-2">
            <label class="block mb-2 text-base font-medium text-gray-900" for="question">Question:</label>
            <input type="text"
                class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="edit_question" name="heading" required>
        </div>

        <div class="mb-2">
            <label class="block mb-2 text-base font-medium text-gray-900" for="question_type">Question
                Description Type:</label>
            <select
                class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="edit_question_type" name="question_type" onchange="handleQuestionTypeChange()">

                <option class="bg-blue-300" value="">Select Question Type</option>
                <option class="bg-blue-300" value="text">Text</option>
                <option class="bg-blue-300" value="image">Image</option>
                <option class="bg-blue-300" value="audio">Audio</option>
            </select>


        </div>

        <div class="mb-2" id="edit_question_description_container">
            <label class="block mb-2 text-base font-medium text-gray-900" for="question_description">Question
                Description:</label>
            <textarea
                class="question_description bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="edit_question_description" name="question_description"></textarea>
            <img id="edit_question_image_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />

            <audio id="edit_question_audio_preview" class="mt-2 hidden" controls></audio>

        </div>

        <div class="mb-2">
            <label class="block mb-2 text-base font-medium text-gray-900" for="answer_type">Answer Type:</label>
            <select
                class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="edit_answer_type" name="answer_type" onchange="handleAnswerTypeChange()">
                <option class="bg-blue-300" value="">Select Answer Type</option>
                <option class="bg-blue-300" value="text">Text</option>
                <option class="bg-blue-300" value="image">Image</option>
                <option class="bg-blue-300" value="audio">Audio</option>
            </select>


        </div>

        <div class="grid gap-4 sm:grid-cols-[1fr_1fr] sm:gap-4" id="edit_answer_options_container">
            <div class="mb-2">
                <label class="block mb-2 text-base font-medium text-gray-900" for="option_1">Option 1:</label>
                <input type="text"
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="edit_option_1" name="option_1">
                <img id="edit_option_1_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />

                <audio id="edit_option_1_audio_preview" class="hidden" controls></audio>

            </div>

            <div class="mb-2">
                <label class="block mb-2 text-base font-medium text-gray-900" for="option_2">Option 2:</label>
                <input type="text"
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="edit_option_2" name="option_2">
                <img id="edit_option_2_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />

                <audio id="edit_option_2_audio_preview" class="hidden" controls></audio>

            </div>

            <div class="mb-2">
                <label class="block mb-2 text-base font-medium text-gray-900" for="option_3">Option 3:</label>
                <input type="text"
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="edit_option_3" name="option_3">
                <img id="edit_option_3_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />

                <audio id="edit_option_3_audio_preview" class="hidden" controls></audio>


            </div>

            <div class="mb-2">
                <label class="block mb-2 text-base font-medium text-gray-900" for="option_4">Option 4:</label>
                <input type="text"
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="edit_option_4" name="option_4">
                <img id="edit_option_4_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />

                <audio id="edit_option_4_audio_preview" class="hidden" controls></audio>


            </div>
        </div>

        <div class="mb-2">
            <label class="block mb-2 text-base font-medium text-gray-900" for="correct_answer">Correct
                Answer:</label>
            <select
                class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="edit_correct_answer" name="correct_answer">
                <option class="bg-blue-300" value="">Select Correct Option</option>
                <option class="bg-blue-300" value="option_1">Option 1</option>
                <option class="bg-blue-300" value="option_2">Option 2</option>
                <option class="bg-blue-300" value="option_3">Option 3</option>
                <option class="bg-blue-300" value="option_4">Option 4</option>
            </select>

            </p>
        </div>

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-4 py-2 w-full mb-4">Submit</button>
    </form>

</div>
