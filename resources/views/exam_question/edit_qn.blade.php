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

    <form method="POST" action="{{ route('exam_question.update_qn') }}" enctype="multipart/form-data"
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
                    id="edit_set_number" name="set_number" required readonly>
            </div>

            <div class="mb-2">
                <label class="block mb-2 text-base font-medium text-gray-900" for="question_number">Question
                    Number:</label>
                <input type="number"
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="edit_question_number" name="question_number" required readonly>
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
                id="edit_question_type" name="question_type" onchange="edit__handleQuestionTypeChange()">

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
                id="edit_answer_type" name="answer_type" onchange="edit__handleAnswerTypeChange()">
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
                <option class="bg-blue-300" value="option_1">Option 1</option>
                <option class="bg-blue-300" value="option_2">Option 2</option>
                <option class="bg-blue-300" value="option_3">Option 3</option>
                <option class="bg-blue-300" value="option_4">Option 4</option>
            </select>

            </p>
        </div>

        <p id="update-error-msg" class="text-red-500 font-semibold text-base mb-2"></p>

        <div class="flex items-center justify-between">
            <div>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                <button type="button" id="cancel_edit_form"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cancel</button>
            </div>

            <button type="button" id = "delete-warning"
                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Delete</button>
        </div>
    </form>

</div>

<div id="delete-popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center bg-gray-500 bg-opacity-75">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                data-modal-hide="delete-popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to
                    delete this question?</h3>
                <button id="confirm-delete" data-modal-hide="delete-popup-modal" type="button"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="delete-popup-modal" type="button"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No,
                    cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function showModal() {
            $('#delete-popup-modal').removeClass('hidden');
        }

        function hideModal() {
            $('#delete-popup-modal').addClass('hidden');
        }

        $('[data-modal-hide="delete-popup-modal"]').on('click', function() {
            hideModal();
        });

        $('#delete-warning').on('click', function() {
            showModal();
        });

        // Handle the delete confirmation
        $('#confirm-delete').on('click', function() {
            var set_num = $('#edit_set_number').val();
            var questionId = $('#edit_question_number').val();

            let formatted_qnum = "set_" + set_num + "_" + questionId;

            $.ajax({
                url: '/exam_question/delete/' + formatted_qnum,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#delete-popup-modal').addClass('hidden');
                    $('#edit-question-drawer').addClass('-translate-x-full');

                    alert('Question deleted successfully!');
                },
                error: function(xhr) {
                    alert('An error occurred while deleting the question.');
                }
            });
        });
    });
</script>

<script>
    function edit__handleQuestionTypeChange() {
        const edit__questionType = document.getElementById('edit_question_type').value;
        const edit__questionDescriptionContainer = document.getElementById('edit_question_description_container');
        const edit__questionImagePreview = document.getElementById('edit_question_image_preview');
        const edit__questionAudioPreview = document.getElementById('edit_question_audio_preview');

        // Check if the current element is a file input, textarea, or audio element
        const edit__currentElement = document.getElementById('edit_question_description_image') ||
            document.getElementById('edit_question_description_audio') ||
            document.getElementById('edit_question_description');

        if (edit__questionType === 'image') {
            // Create a new file input for the image
            const edit__fileInput = document.createElement('input');
            edit__fileInput.type = 'file';
            edit__fileInput.name = 'question_description_image';
            edit__fileInput.id = 'edit_question_description_image';
            edit__fileInput.className = edit__currentElement.className; // Reuse the class name
            edit__fileInput.accept = 'image/*'; // Accept only image files
            edit__fileInput.onchange = function() {
                edit__previewImage(edit__fileInput, edit__questionImagePreview);
            };

            edit__currentElement.replaceWith(edit__fileInput);
            edit__questionImagePreview.classList.remove('hidden');
            edit__questionAudioPreview.classList.add('hidden');
        } else if (edit__questionType === 'audio') {
            // Create a new file input for the audio
            const edit__fileInput = document.createElement('input');
            edit__fileInput.type = 'file';
            edit__fileInput.name = 'question_description_audio';
            edit__fileInput.id = 'edit_question_description_audio';
            edit__fileInput.className = edit__currentElement.className; // Reuse the class name
            edit__fileInput.accept = 'audio/*'; // Accept only audio files
            edit__fileInput.onchange = function() {
                edit__previewAudio(edit__fileInput, edit__questionAudioPreview);
            };

            edit__currentElement.replaceWith(edit__fileInput);
            edit__questionImagePreview.classList.add('hidden');
            edit__questionAudioPreview.classList.remove('hidden');
        } else {
            // Create a new textarea for the text
            const edit__textarea = document.createElement('textarea');
            edit__textarea.name = 'question_description';
            edit__textarea.id = 'edit_question_description';
            edit__textarea.className = edit__currentElement.className; // Reuse the class name

            edit__currentElement.replaceWith(edit__textarea);
            edit__questionImagePreview.classList.add('hidden');
            edit__questionAudioPreview.classList.add('hidden');
        }
    }

    function edit__handleAnswerTypeChange() {
        const edit__answerType = document.getElementById('edit_answer_type').value;

        for (let i = 1; i <= 4; i++) {
            // Get the current element (either the text input, image input, or audio input)
            const edit__currentElement = document.getElementById('edit_option_' + i + '_image') ||
                document.getElementById('edit_option_' + i + '_audio') ||
                document.getElementById('edit_option_' + i);
            const edit__optionPreview = document.getElementById('edit_option_' + i + '_preview');
            const edit__optionAudioPreview = document.getElementById('edit_option_' + i + '_audio_preview');

            if (edit__currentElement) {
                if (edit__answerType == 'image') {
                    // Create a new file input for the image
                    const edit__fileInput = document.createElement('input');
                    edit__fileInput.type = 'file';
                    edit__fileInput.name = 'option_' + i + '_image';
                    edit__fileInput.id = 'edit_option_' + i + '_image';
                    edit__fileInput.className = edit__currentElement.className;
                    edit__fileInput.accept = 'image/*'; // Accept only image files
                    edit__fileInput.onchange = function() {
                        edit__previewImage(edit__fileInput, edit__optionPreview);
                    };

                    edit__currentElement.replaceWith(edit__fileInput);
                    edit__optionPreview.classList.remove('hidden');
                    edit__optionAudioPreview.classList.add('hidden');

                } else if (edit__answerType == 'audio') {
                    // Create a new file input for the audio
                    const edit__fileInput = document.createElement('input');
                    edit__fileInput.type = 'file';
                    edit__fileInput.name = 'option_' + i + '_audio';
                    edit__fileInput.id = 'edit_option_' + i + '_audio';
                    edit__fileInput.className = edit__currentElement.className;
                    edit__fileInput.accept = 'audio/*'; // Accept only audio files
                    edit__fileInput.onchange = function() {
                        edit__previewAudio(edit__fileInput,
                            edit__optionAudioPreview); // You need to implement this function
                    };

                    edit__currentElement.replaceWith(edit__fileInput);
                    edit__optionPreview.classList.add('hidden');
                    edit__optionAudioPreview.classList.remove('hidden');


                } else {
                    // Create a new text input for the text
                    const edit__textInput = document.createElement('input');
                    edit__textInput.type = 'text';
                    edit__textInput.name = 'option_' + i;
                    edit__textInput.id = 'edit_option_' + i;
                    edit__textInput.className = edit__currentElement.className;

                    edit__currentElement.replaceWith(edit__textInput);
                    edit__optionPreview.classList.add('hidden');
                    edit__optionAudioPreview.classList.add('hidden');
                }
            }
        }
    }



    function edit__previewImage(input, previewElement) {
        const edit__file = input.files[0];
        const edit__reader = new FileReader();

        edit__reader.onload = function(e) {
            previewElement.src = e.target.result;
        };

        if (edit__file) {
            edit__reader.readAsDataURL(edit__file);
        }
    }

    // Function to preview the selected audio
    function edit__previewAudio(fileInput, previewElement) {
        const edit__file = fileInput.files[0];
        const edit__reader = new FileReader();
        edit__reader.onload = function(e) {
            previewElement.src = e.target.result;
            previewElement.classList.remove('hidden');
        };
        edit__reader.readAsDataURL(edit__file);
    }
</script>
