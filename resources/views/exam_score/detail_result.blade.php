<x-app-layout>
    <div class="bg-gray-100">

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            @foreach ($answered_questions as $question_item)
                <div class="bg-white rounded-t-md p-4 pb-0.5 w-fit flex gap-4">

                    <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-xl lg:text-xl">

                        <span
                            class="underline underline-offset-8 decoration-4 decoration-blue-400 dark:decoration-blue-600">
                            Set: {{ str_replace('set_', ' ', $question_item->set) }}
                        </span>
                    </h1>

                    <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-xl lg:text-xl">

                        <span
                            class="underline underline-offset-8 decoration-4 decoration-blue-400 dark:decoration-blue-600">
                            Exam Date: {{ str_replace($question_item->set, ' ', $question_item->exam_start_time) }}
                        </span>
                    </h1>

                </div>

                <div class="mid-section mb-4 grid gap-4 grid-cols-[2fr_1fr] text-xl p-4 bg-white">

                    <div class="bg-white overflow-auto">

                        <div class="exam_question_description">
                            <p class="font-semibold text-2xl">
                                <span id="question-number">
                                    {{ str_replace($question_item->set . "_", ' ', $question_item->question_num) }}.
                                </span>
                                <span id="heading">
                                    Topic
                                </span>
                            </p>
                        </div>

                        <div class="exam_question py-4">
                            <p id="actual-question" class="font-normal text-2xl text-center">
                                {{ $question_item->examQuestion->question }}
                            </p>
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
                                class="option-div cursor-pointer border text-2xl p-4 
                                {{ $is_correct ? 'bg-blue-600 text-white' : ($is_selected ? 'bg-red-600 text-white' : 'bg-white') }}">
                                <p class="flex items-center">
                                    <span
                                        class="number-data border rounded-full bg-white text-black p-2 w-8 h-8 flex items-center justify-center">
                                        {{ $index + 1 }}
                                    </span>
                                    <span id="{{ $option_id }}" class="option-data ml-2">
                                        {{ $question_item->examQuestion->$option }}
                                    </span>
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
