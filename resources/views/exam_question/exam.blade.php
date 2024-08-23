<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="topbar flex justify-between border text-xl p-4 bg-white">

            <div>
                <p class="font-medium">{{ auth()->user()->name }}</p>
            </div>

            <div>
                <p class="font-medium">UBT Set 1</p>
            </div>

            <div>
                <p class="font-medium">
                    Remaining: 40
                </p>
            </div>

            <div>
                <p class="font-medium">
                    Attempt: 0
                </p>
            </div>

            <div>
                <p class="font-medium">39:34</p>
            </div>

        </div>

        <div class="mid-section grid gap-4 grid-cols-[2fr_1fr] border text-xl mt-2 p-4 bg-white">

            <div class="bg-white overflow-auto">
                <p class="text-xl py-2">
                    Q. 다음 질문에 답하십시오.
                </p>

                <div class="exam_question_description py-4">
                    <p class="font-semibold text-2xl">
                        <span>
                            3.
                        </span>
                        다음 단어와 관계 있는 것을 무엇입니까?
                    </p>
                </div>

                <div class="exam_question py-4">
                    <p class="font-normal text-2xl text-center">
                        다음 단어와 관계 있는 것을 무엇입니까?
                    </p>
                </div>
            </div>

            <div class="option-section overflow-auto bg-white">
                <div class="border text-2xl p-4">
                    <p class="option-active flex items-center">
                        <span
                            class="border rounded-full bg-white text-black p-2 w-8 h-8 flex items-center justify-center">
                            1
                        </span>
                        <span class="ml-2">option 1</span>
                    </p>
                </div>


                <div class="border text-2xl p-4">
                    <p class="flex items-center">
                        <span
                            class="border rounded-full bg-white text-black p-2 w-8 h-8 flex items-center justify-center">
                            2
                        </span>
                        <span class="ml-2">option 2</span>
                    </p>
                </div>


                <div class="border text-2xl p-4">

                    <p class="flex items-center">
                        <span
                            class="border rounded-full bg-white text-black p-2 w-8 h-8 flex items-center justify-center">
                            3
                        </span>
                        <span class="ml-2">option 3</span>
                    </p>

                </div>

                <div class="border text-2xl p-4">

                    <p class="flex items-center">
                        <span
                            class="border rounded-full bg-white text-black p-2 w-8 h-8 flex items-center justify-center">
                            4
                        </span>
                        <span class="ml-2">option 4</span>
                    </p>

                </div>


            </div>
        </div>

        <div class="lower-section flex justify-around border text-xl p-4 mt-2 bg-white">
            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl px-4 py-2">Previous Question</button>
            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl px-4 py-2">Question List</button>
            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl px-4 py-2">Next Question</button>
        </div>
    </div>
    </div>

</x-app-layout>
