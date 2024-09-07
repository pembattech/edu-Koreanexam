<x-app-layout>

    <form method="POST" action="{{ route('exam_question.store') }}" enctype="multipart/form-data" id= "questionForm"
        class="py-4 px-4 mx-auto max-w-2xl lg:py-4" novalidate>
        @csrf
        <div class="grid gap-4 sm:grid-cols-[1fr_1fr] sm:gap-6">

        <div class="mb-2">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="set_number">Set Number:</label>
            <input type="number"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="set_number" name="set_number" required>

            <span class="text-red-500 font-medium text-base hidden" id="set_number_error">Set number is required</span>
        </div>

        <div class="mb-2">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="question_number">Question
                Number:</label>
            <input type="number"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="question_number" name="question_number" required>

            <span class="text-red-500 font-medium text-base hidden" id="question_number_error">Question number is
                required</span>
        </div>

        </div>

        <div class="mb-2">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="question">Question:</label>
            <input type="text"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="question" name="question" required>

            <span class="text-red-500 font-medium text-base hidden" id="question_error">Question is required</span>
        </div>


        <div class="mb-2">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="question_type">Question
                Description Type:</label>
            <select
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="question_type" name="question_type" onchange="handleQuestionTypeChange()">

                <option value="">Select Question Type</option>
                <option value="text">Text</option>
                <option value="image">Image</option>
                <option value="audio">Audio</option>
            </select>

            <span class="text-red-500 font-medium text-base hidden" id="question_type_error">Question type is
                required</span>
        </div>

        <div class="mb-2" id="question_description_container">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="question_description">Question
                Description:</label>
            <textarea
                class="question_description shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="question_description" name="question_description"></textarea>
            <img id="question_image_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />

            <p id="question_description_error" class="text-red-500 font-medium text-base hidden">Question description is
                required.</p>
        </div>

        <div class="mb-2">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="answer_type">Answer Type:</label>
            <select
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="answer_type" name="answer_type" onchange="handleAnswerTypeChange()">
                <option value="">Select Answer Type</option>
                <option value="text">Text</option>
                <option value="image">Image</option>
                <option value="audio">Audio</option>
            </select>

            <p id="answer_type_error" class="text-red-500 font-medium text-base hidden">Answer type is required.</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-[1fr_1fr] sm:gap-4" id="answer_options_container">
            <div class="mb-2">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="option_1">Option 1:</label>
                <input type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="option_1" name="option_1">
                <img id="option_1_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />
                <p id="option_1_error" class="text-red-500 font-medium text-base hidden">Option 1 is required.</p>
            </div>

            <div class="mb-2">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="option_2">Option 2:</label>
                <input type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="option_2" name="option_2">
                <img id="option_2_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />
                <p id="option_2_error" class="text-red-500 font-medium text-base hidden">Option 2 is required.</p>
            </div>

            <div class="mb-2">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="option_3">Option 3:</label>
                <input type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="option_3" name="option_3">
                <img id="option_3_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />
                <p id="option_3_error" class="text-red-500 font-medium text-base hidden">Option 3 is required.</p>
            </div>

            <div class="mb-2">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="option_4">Option 4:</label>
                <input type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="option_4" name="option_4">
                <img id="option_4_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />
                <p id="option_4_error" class="text-red-500 font-medium text-base hidden">Option 4 is required.</p>
            </div>
        </div>

        <div class="mb-2">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="correct_answer">Correct Answer:</label>
            <select
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                id="correct_answer" name="correct_answer">
                <option value="">Select Correct Option</option>
                <option value="option_1">Option 1</option>
                <option value="option_2">Option 2</option>
                <option value="option_3">Option 3</option>
                <option value="option_4">Option 4</option>
            </select>
            <p id="correct_answer_error" class="text-red-500 font-medium text-base hidden">Correct answer is required.
            </p>
        </div>

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Submit</button>
    </form>

    <!-- Popup HTML -->
    <div id="popup" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold mb-2">Success!</h2>
            <p>Your question has been added successfully.</p>
            <div class="mt-4">
                <button id="addAnotherQuestion"
                    class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none font-medium rounded-lg text-sm px-4 py-2 mr-2">Add
                    Another Question</button>
                <button id="closePopup"
                    class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none font-medium rounded-lg text-sm px-4 py-2">Close</button>
            </div>
        </div>
    </div>




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

    <script>
        $(document).ready(function() {
            $('#questionForm').on('submit', function(e) {
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

                if (!$('#question_description_error').val()) {
                    $('#question_description_error').removeClass('hidden');
                    isValid = false;
                } else {
                    $('#question_description_error').addClass('hidden');
                }

                if (!$('#answer_type').val()) {
                    $('#answer_type_error').removeClass('hidden');
                    isValid = false;
                } else {
                    $('#answer_type_error').addClass('hidden');
                }

                if (!$('#option_1_error').val()) {
                    $('#option_1_error').removeClass('hidden');
                    isValid = false;
                } else {
                    $('#option_1_error').addClass('hidden');
                }

                if (!$('#option_2_error').val()) {
                    $('#option_2_error').removeClass('hidden');
                    isValid = false;
                } else {
                    $('#option_2_error').addClass('hidden');
                }

                if (!$('#option_3_error').val()) {
                    $('#option_3_error').removeClass('hidden');
                    isValid = false;
                } else {
                    $('#option_3_error').addClass('hidden');
                }

                if (!$('#option_4_error').val()) {
                    $('#option_4_error').removeClass('hidden');
                    isValid = false;
                } else {
                    $('#option_4_error').addClass('hidden');
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
                        success: function(response) {
                            // Handle success response
                            console.log('Success:', response);

                            // Display the popup
                            $('#popup').removeClass('hidden');
                        },
                        error: function(xhr) {
                            // Handle error response
                            console.log('Error:', xhr.responseText);
                        }
                    });
                }
            });

            // Close the popup
            $('#closePopup').on('click', function() {
                $('#popup').addClass('hidden');
            });


            // Add another question
            $('#addAnotherQuestion').on('click', function() {
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

        });
    </script>
</x-app-layout>
