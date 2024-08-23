<x-app-layout>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="POST" action="{{ route('exam_question.store') }}" enctype="multipart/form-data"
        class="py-4 px-4 mx-auto max-w-2xl lg:py-14">
        @csrf

        <div class="grid gap-4 sm:grid-cols-[1fr_3fr] sm:gap-6">
            <div class="mb-2">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="question_number">Question Number:</label>
                <input type="number"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="question_number" name="question_number" required>
            </div>

            <div class="mb-2">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="question">Question:</label>
                <input type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="question" name="question" required>
            </div>
        </div>

        <div class="mb-2">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="question_type">Question
                Description Type:</label>
            <select
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="question_type" name="question_type" onchange="handleQuestionTypeChange()">
                <option value="text">Text</option>
                <option value="image">Image</option>
                <option value="audio">Audio</option>
            </select>
        </div>

        <div class="mb-2" id="question_description_container">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="question_description">Question
                Description:</label>
            <textarea
                class="question_description shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="question_description" name="question_description"></textarea>
            <img id="question_image_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />
        </div>

        <div class="mb-2">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="answer_type">Answer Type:</label>
            <select
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="answer_type" name="answer_type" onchange="handleAnswerTypeChange()">
                <option value="text">Text</option>
                <option value="image">Image</option>
                <option value="audio">Audio</option>
            </select>
        </div>

        <div class="grid gap-4 sm:grid-cols-[1fr_1fr] sm:gap-4" id="answer_options_container">
            <div class="mb-2">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="option_1">Option 1:</label>
                <input type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="option_1" name="option_1">
                <img id="option_1_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />
            </div>

            <div class="mb-2">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="option_2">Option 2:</label>
                <input type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="option_2" name="option_2">
                <img id="option_2_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />
            </div>

            <div class="mb-2">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="option_3">Option 3:</label>
                <input type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="option_3" name="option_3">
                <img id="option_3_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />
            </div>

            <div class="mb-2">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="option_4">Option 4:</label>
                <input type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="option_4" name="option_4">
                <img id="option_4_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />
            </div>
        </div>

        <div class="mb-2">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="correct_answer">Correct Answer:</label>
            <select
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="correct_answer" name="correct_answer">
                <option value="option_1">Option 1</option>
                <option value="option_2">Option 2</option>
                <option value="option_3">Option 3</option>
                <option value="option_4">Option 4</option>
            </select>
        </div>

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
    </form>



    <script>
        function handleQuestionTypeChange() {
            const questionType = document.getElementById('question_type').value;
            const questionDescriptionContainer = document.getElementById('question_description_container');
            const questionImagePreview = document.getElementById('question_image_preview');

            // Check if the current element is a file input or textarea
            const currentElement = document.getElementById('question_description_image') || document.getElementById(
                'question_description');

            if (questionType === 'image') {
                // Create a new file input for the image
                const fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.name = 'question_description_image';
                fileInput.id = 'question_description_image';
                fileInput.className = currentElement.className; // Reuse the class name
                fileInput.onchange = function() {
                    previewImage(fileInput, questionImagePreview);
                };

                currentElement.replaceWith(fileInput);
                questionImagePreview.classList.remove('hidden');
            } else {
                // Create a new textarea for the text
                const textarea = document.createElement('textarea');
                textarea.name = 'question_description';
                textarea.id = 'question_description';
                textarea.className = currentElement.className; // Reuse the class name

                currentElement.replaceWith(textarea);
                questionImagePreview.classList.add('hidden');
            }
        }

        function handleAnswerTypeChange() {
            const answerType = document.getElementById('answer_type').value;

            for (let i = 1; i <= 4; i++) {
                // Get the current element (either the text input or the file input)
                const currentElement = document.getElementById('option_' + i + '_image') || document.getElementById(
                    'option_' + i);
                const optionPreview = document.getElementById('option_' + i + '_preview');

                if (currentElement) {
                    if (answerType === 'image') {
                        const fileInput = document.createElement('input');
                        fileInput.type = 'file';
                        fileInput.name = 'option_' + i + '_image';
                        fileInput.id = 'option_' + i + '_image';
                        fileInput.className = currentElement.className;
                        fileInput.onchange = function() {
                            previewImage(fileInput, optionPreview);
                        };

                        currentElement.replaceWith(fileInput);
                        optionPreview.classList.remove('hidden');
                    } else {
                        const textInput = document.createElement('input');
                        textInput.type = 'text';
                        textInput.name = 'option_' + i;
                        textInput.id = 'option_' + i;
                        textInput.className = currentElement.className;

                        currentElement.replaceWith(textInput);
                        optionPreview.classList.add('hidden');
                    }
                }
            }
        }


        function previewImage(input, previewElement) {
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                previewElement.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
