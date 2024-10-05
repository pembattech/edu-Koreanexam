<x-app-layout>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-t-md p-4 mb-2 w-fit flex gap-4">

            <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-xl lg:text-xl">
                Set: {{ str_replace('set_', '', $answered_set_num) }}
            </h1>

            <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-xl lg:text-xl">
                Exam Date: {{ $exam_start_time }}
               
            </h1>

        </div>
        @foreach ($answered_questions as $question_item)
            <div
                class="mid-section rounded-md mb-4 grid gap-4 grid-cols-[2fr_1fr] text-xl p-4 bg-white">

                <div class="bg-white overflow-auto">

                    <div class="exam_question_description">
                        <p class="font-semibold sm:text-xl md:text-2xl lg:text-2xl">
                            <span id="question-number">
                                {{ str_replace($question_item->set . '_', ' ', $question_item->question_num) }}.
                            </span>
                            <span id="heading">
                                {{ $question_item->examQuestion->heading }}
                            </span>
                        </p>
                    </div>

                    <div class="exam_question py-4 flex items-center justify-center">

                        @if ($question_item->examQuestion->question_type == 'text')
                            <p id="actual-question"
                                class="font-normal text-black sm:text-xl md:text-2xl lg:text-2xl text-center">
                                {{ $question_item->examQuestion->question }}

                            </p>
                        @elseif ($question_item->examQuestion->question_type == 'image')
                            <img class="h-auto max-w-md w-64 sm:w-64 md:w-80 lg:w-96"
                                src="{{ asset('exam_assets/images/question_image/' . $question_item->examQuestion->question) }}"
                                alt="Question Image">
                        @elseif ($question_item->examQuestion->question_type == 'audio')
                            <audio controls>
                                <source
                                    src="{{ asset('exam_assets/audio/question_audio/' . $question_item->examQuestion->question) }}"
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
                            $is_correct = $question_item->examQuestion->correct_answer === $option_id;
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

                                    @if ($question_item->examQuestion->answer_type == 'text')
                                        <span id="actual-question"
                                            class="font-normal text-black sm:text-xl md:text-2xl lg:text-2xl text-center">
                                            {{ str_replace(['_option_1', '_option_2', '_option_3', '_option_4'], '', $question_item->examQuestion->$option) }}


                                        </span>
                                    @elseif ($question_item->examQuestion->answer_type == 'image')
                                        <img class= "h-auto max-w-40 w-16 sm:w-20 md:w-24 lg:w-40"
                                            src="{{ asset('exam_assets/images/option_image/' . $question_item->examQuestion->$option) }}"
                                            alt="Option Image">
                                    @elseif ($question_item->examQuestion->answer_type == 'audio')
                                        <audio controls>
                                            <source
                                                src="{{ asset('exam_assets/audio/option_audio/' . $question_item->examQuestion->$option) }}"
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
</x-app-layout>
