<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <div class="mb-2 flex justify-between">

            <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-xl lg:text-xl">

                <span class="bg-white py-2 px-6 rounded-md">

                    Set: {{ str_replace('set_', '', $set) }}

                </span>

            </h1>

            <div>

                <button id="setTodayExam" data-set="{{ $set }}"
                    class="text-white ml-2 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 text-xl font-bold leading-none tracking-tight py-2 px-6 rounded-md">
                    Set Today's Exam
                </button>

                <!-- Background overlay -->
                <div id="overlay"
                    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999;">
                </div>

                <!-- Popup modal -->
                <div id="confirmationModal"
                    style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; z-index: 1000; border-radius: 10px; width: fit-content;">
                    <p class="font-bold text-lg text-red-600">An exam is already scheduled for today.</p>
                    <p class="font-bold text-lg">Are you sure you want to proceed?</p>
                    <div class="flex justify-between mt-4">
                        <button id="confirmDeactivate" class="bg-red-500 text-white px-4 py-2 rounded">Sure</button>
                        <button id="cancelDeactivate" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($list_of_qn as $question_item)
            <div class="mid-section rounded-md mb-2 grid gap-4 grid-cols-[2fr_1fr] text-xl p-4 bg-white">

                <div class="bg-white overflow-auto">

                    <button id="edit-question_number"
                        class="edit-question_number text-black bg-gray-50 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-200 text-md font-normal leading-none tracking-tight py-2 px-6 rounded-md"
                        data-set-num="{{ $set }}"
                        data-qn-num="{{ str_replace($set . '_', '', $question_item->question_number) }}">

                        Edit
                    </button>

                    <div class="exam_question_description">
                        <p class="font-semibold sm:text-xl md:text-2xl lg:text-2xl">
                            <span id="question-number">
                                {{ str_replace($question_item->set . '_', ' ', $question_item->question_number) }}.
                            </span>
                            <span id="heading">
                                {{ $question_item->heading }}
                            </span>
                        </p>
                    </div>

                    <div class="exam_question py-4 flex items-center justify-center">

                        @if ($question_item->question_type == 'text')
                            <p id="actual-question"
                                class="font-normal text-black sm:text-xl md:text-2xl lg:text-2xl text-center">
                                {{ $question_item->question }}

                            </p>
                        @elseif ($question_item->question_type == 'image')
                        <div class="flex flex-col gap-2">
                            @if (!is_null($question_item->additional_audio) && $question_item->additional_audio != '')
                                <div>
                                    <audio controls>
                                        <source
                                            src="{{ asset('exam_assets/audio/additional_audio/' . $question_item->additional_audio) }}"
                                            type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                </div>
                            @endif
                            <div>
                                <img class="h-auto max-w-md w-64 sm:w-64 md:w-80 lg:w-96"
                                    src="{{ asset('exam_assets/images/question_image/' . $question_item->question) }}"
                                    alt="Question Image">
                            </div>

                        </div>
                        @elseif ($question_item->question_type == 'audio')
                            <audio controls>
                                <source
                                    src="{{ asset('exam_assets/audio/question_audio/' . $question_item->question) }}"
                                    type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        @endif

                    </div>
                </div>

                <div class="option-section overflow-auto bg-white">
                    @foreach (['option1', 'option2', 'option3', 'option4'] as $index => $option)
                        @php
                            $option_id = 'option_' . ($index + 1);
                            $is_correct = $question_item->correct_answer === $option_id;
                            $is_selected = $question_item->answer === $option_id;
                        @endphp
                        <div
                            class="option-div cursor-pointer border sm:text-xl md:text-2xl lg:text-2xl p-4 
                            {{ $is_correct ? 'bg-blue-600 text-white' : ($is_selected ? 'bg-red-600 text-white' : 'bg-white') }}">
                            <p class="flex items-center">
                                <span
                                    class="number-data border rounded-full bg-white text-black p-2 w-8 h-8 flex items-center justify-center">
                                    {{ $index + 1 }}
                                </span>
                                <span id="{{ $option_id }}" class="option-data ml-2">

                                    @if ($question_item->answer_type == 'text')
                                        <span id="actual-question"
                                            class="font-normal text-black sm:text-xl md:text-2xl lg:text-2xl text-center">
                                            {{ str_replace(['_option_1', '_option_2', '_option_3', '_option_4'], '', $question_item->$option) }}

                                        </span>
                                    @elseif ($question_item->answer_type == 'image')
                                        <img class= "h-auto max-w-40 w-16 sm:w-20 md:w-24 lg:w-40"
                                            src="{{ asset('exam_assets/images/option_image/' . $question_item->$option) }}"
                                            alt="Option Image">
                                    @elseif ($question_item->answer_type == 'audio')
                                        <audio controls>
                                            <source
                                                src="{{ asset('exam_assets/audio/option_audio/' . $question_item->$option) }}"
                                                type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    @endif
                                </span>
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        @include('exam_question.edit_qn')

    </div>

    <script>
        $(document).ready(function() {
            $('#setTodayExam').click(function() {
                var set = $(this).data('set');

                // AJAX request to check if an exam is already scheduled
                $.ajax({
                    url: '{{ route('exam_routine.show_today_exam') }}',
                    method: 'GET',
                    success: function(data) {
                        if (data.length > 0) {
                            $("#overlay").fadeIn();
                            $("#confirmationModal").fadeIn();
                        } else {
                            // If no exam exists, proceed to set the exam
                            setExam(set);
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Error checking for existing exams.');
                    }
                });
            });

            // Confirm deactivation of the previous exam
            $('#confirmDeactivate').click(function() {
                var set = $('#setTodayExam').data('set');
                deactivatePreviousAndSetExam(set);
                $("#overlay").fadeOut();
                $("#confirmationModal").fadeOut();
            });

            // Cancel deactivation
            $('#cancelDeactivate').click(function() {
                $("#overlay").fadeOut();
                $("#confirmationModal").fadeOut();
            });
        });

        // Function to deactivate previous exam and set the new one
        function deactivatePreviousAndSetExam(set) {
            $.ajax({
                url: '/deactivate_previous_and_set_exam/' + set,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.success) {
                        alert('Successfully set the exam for today.');
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Error setting the exam.');
                }
            });
        }

        // Function to set the exam directly
        function setExam(set) {
            $.ajax({
                url: '/set_today_exam/' + set,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token
                },
                success: function(response) {
                    if (response.success) {
                        alert('Successfully set the exam for today.');
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Error setting the exam.');
                }
            });
        }


        $('.edit-question_number').on('click', function() {
            const get_setnum = $(this).data('set-num');
            const get_qnum = $(this).data('qn-num');

            $.ajax({
                url: '/exam_question/exam',
                method: 'GET',
                data: {
                    'setNumber': get_setnum,
                    'questionNumber': get_setnum + "_" + get_qnum,
                },
                success: function(response) {

                    if (response.success.length <= 0) {

                        $('#invalid-message').removeClass('hidden');

                    } else {

                        $('#edit-question-drawer').removeClass('-translate-x-full');
                        $('#editQuestionForm')[0].reset();

                        $('#store_set_number_popup').addClass('hidden');


                        // Iterate over each question
                        response.success.forEach(function(question) {

                            console.log(question)
                            // Extract data from each question object
                            var set_number = get_setnum.replace("set_", "");
                            var questionNumber = question.question_number.replace(question.set +
                                "_", "");
                            var headingText = question.heading;
                            var q_type = question.question_type;
                            var questionText = question.question;
                            var option_1 = question.option1;
                            var option_2 = question.option2;
                            var option_3 = question.option3;
                            var option_4 = question.option4;
                            var ans_type = question.answer_type;
                            var correct_answer = question.correct_answer;

                            // Set the values of the inputs
                            $("#edit_set_number").val(set_number);
                            $("#edit_question").val(headingText);
                            $("#edit_question_number").val(questionNumber);
                            $("#edit_question_type").val(q_type);

                            const questionType = q_type;
                            const $questionDescriptionContainer = $(
                                '#edit_question_description_container');
                            const $questionImagePreview = $('#edit_question_image_preview');
                            const $questionAudioPreview = $('#edit_question_audio_preview');

                            // Check if the current element is a file input, textarea, or audio element
                            const $currentElement = $(
                                '#edit_question_description_image, #edit_question_description_audio, #edit_question_description'
                            );

                            if (questionType === 'image') {
                                // Create a new file input for the image
                                const $fileInput = $('<input>', {
                                    type: 'file',
                                    name: 'question_description_image',
                                    id: 'edit_question_description_image',
                                    class: $currentElement.attr('class'),
                                    accept: 'image/*'
                                }).on('change', function() {
                                    previewImage($fileInput[0], $questionImagePreview[
                                        0]);

                                });

                                $currentElement.replaceWith($fileInput);
                                $questionImagePreview.removeClass('hidden');
                                $questionAudioPreview.addClass('hidden');

                                if (questionText) {

                                    const imageUrl = '/exam_assets/images/question_image/' +
                                        questionText;
                                    $questionImagePreview.attr('src', imageUrl).removeClass(
                                        'hidden');

                                    // document.getElementById('edit__additional_audio_field').style.display = 'block';

                                }
                            } else if (questionType === 'audio') {
                                // Create a new file input for the audio
                                const $fileInput = $('<input>', {
                                    type: 'file',
                                    name: 'question_description_audio',
                                    id: 'edit_question_description_audio',
                                    class: $currentElement.attr('class'),
                                    accept: 'audio/*'
                                }).on('change', function() {
                                    previewAudio($fileInput[0], $questionAudioPreview[
                                        0]);
                                });

                                $currentElement.replaceWith($fileInput);
                                $questionImagePreview.addClass('hidden');
                                $questionAudioPreview.removeClass('hidden');

                                if (questionText) {

                                    const audioURL = '/exam_assets/audio/question_audio/' +
                                        questionText;
                                    $questionAudioPreview.attr('src', audioURL).removeClass(
                                        'hidden');

                                }
                            } else {
                                // Create a new textarea for the text
                                const $textarea = $('<textarea>', {
                                    name: 'question_description',
                                    id: 'edit_question_description',
                                    class: $currentElement.attr('class')
                                });

                                $currentElement.replaceWith($textarea);
                                $questionImagePreview.addClass('hidden');
                                $questionAudioPreview.addClass('hidden');

                                // If it's a text question, set the text
                                $textarea.val(questionText);
                            }

                            $("#edit_answer_type").val(ans_type);


                            const options = [option_1, option_2, option_3, option_4];

                            for (let i = 1; i <= 4; i++) {
                                // Get the current element (either the text input, image input, or audio input)
                                const currentElement = $('#edit_option_' + i + '_image')[0] ||
                                    $('#edit_option_' + i + '_audio')[0] ||
                                    $('#edit_option_' + i)[0];

                                const optionPreview = $('#edit_option_' + i + '_preview');
                                const optionAudioPreview = $('#edit_option_' + i +
                                    '_audio_preview');

                                if (currentElement) {
                                    if (ans_type === 'image') {
                                        // Create a new file input for the image
                                        const $fileInput = $('<input>', {
                                            type: 'file',
                                            name: 'option_' + i + '_image',
                                            id: 'edit_option_' + i + '_image',
                                            class: currentElement.className,
                                            accept: 'image/*'
                                        }).on('change', function() {
                                            previewImage(this, optionPreview[0]);
                                        });

                                        $(currentElement).replaceWith($fileInput);
                                        optionPreview.removeClass('hidden');
                                        optionAudioPreview.addClass('hidden');

                                        // Set the existing image if available
                                        if (options[i - 1]) {

                                            const optionImageURL =
                                                '/exam_assets/images/option_image/' +
                                                options[i - 1];

                                            optionPreview.attr('src', optionImageURL);
                                        }
                                    } else if (ans_type === 'audio') {
                                        // Create a new file input for the audio
                                        const $fileInput = $('<input>', {
                                            type: 'file',
                                            name: 'option_' + i + '_audio',
                                            id: 'edit_option_' + i + '_audio',
                                            class: currentElement.className,
                                            accept: 'audio/*'
                                        }).on('change', function() {
                                            previewAudio(this, optionAudioPreview[0]);
                                        });

                                        $(currentElement).replaceWith($fileInput);
                                        optionPreview.addClass('hidden');
                                        optionAudioPreview.removeClass('hidden');

                                        if (options[i - 1]) {

                                            const optionAudioURL =
                                                '/exam_assets/audio/option_audio/' +
                                                options[i - 1];

                                            optionAudioPreview.attr('src', optionAudioURL);

                                        }
                                    } else {
                                        // Create a new text input for the text
                                        const $textInput = $('<input>', {
                                            type: 'text',
                                            name: 'option_' + i,
                                            id: 'edit_option_' + i,
                                            class: currentElement.className
                                        });

                                        $(currentElement).replaceWith($textInput);
                                        optionPreview.addClass('hidden');
                                        optionAudioPreview.addClass('hidden');

                                        // Set the value for the text option
                                        if (options[i - 1]) {
                                            // Remove the "_option_*" suffix from the value
                                            const valueWithoutSuffix = options[i - 1].replace(
                                                /_option_\d+$/, '');
                                            $textInput.val(valueWithoutSuffix);
                                        }
                                    }
                                }
                            }

                            $("#edit_correct_answer").val(correct_answer);

                        });
                    }
                }
            });
        });
    </script>

</x-app-layout>
