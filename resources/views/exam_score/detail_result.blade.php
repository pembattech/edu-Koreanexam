<x-app-layout>
    <div class="bg-gray-100">

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

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

                    <div class="exam_question py-4">
                        <p id="actual-question" class="font-normal text-2xl text-center">
                            {{-- Auto Generate --}}
                        </p>
                    </div>
                </div>

                <div class="option-section overflow-auto bg-white">
                    <div class="option-div cursor-pointer border text-2xl p-4 bg-red-600">
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

                    <div class="option-div cursor-pointer border text-2xl p-4 bg-green-600">
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
            
        </div>
    </div>
</x-app-layout>
