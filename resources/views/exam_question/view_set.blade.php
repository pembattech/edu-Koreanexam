<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <div class="mb-2 flex justify-between">

            <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-xl lg:text-xl">

                <span class="bg-white py-2 px-6 rounded-md">

                    Set: {{ str_replace('set_', '', $set) }}

                </span>

            </h1>

            <div>
                <button
                    class="text-black bg-gray-50 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-200 text-xl font-bold leading-none tracking-tight py-2 px-6 rounded-md">
                    Edit
                </button>

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
                            <img class="h-auto max-w-md w-64 sm:w-64 md:w-80 lg:w-96"
                                src="{{ asset('exam_assets/images/question_image/' . $question_item->question) }}"
                                alt="Question Image">
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
    </script>

</x-app-layout>
