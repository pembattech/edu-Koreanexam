<div id="exam_popup" class=" hidden fixed inset-0 bg-gray-100 h-screen">

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

            <div class="exam_question_description py-4">
                <p class="font-semibold text-2xl">
                    <span id="question-number">
                        3.
                    </span>
                    <span id="heading">
                        다음 단어와 관계 있는 것을 무엇입니까?
                    </span>
                </p>
            </div>

            <div class="exam_question py-4">
                <p id="actual-question" class="font-normal text-2xl text-center">
                    다음 단어와 관계 있는 것을 무엇입니까?
                </p>
            </div>
        </div>

        <div class="option-section overflow-auto bg-white">
            <div class="option-div cursor-pointer border text-2xl p-4">
                <p class="flex items-center">
                    <span
                        class="number-data border rounded-full bg-white text-black p-2 w-8 h-8 flex items-center justify-center">
                        1
                    </span>
                    <span id="option_1" class="option-data ml-2">option 1</span>
                </p>
            </div>


            <div class="option-div cursor-pointer border text-2xl p-4">
                <p class="flex items-center">
                    <span
                        class="number-data border rounded-full bg-white text-black p-2 w-8 h-8 flex items-center justify-center">
                        2
                    </span>
                    <span id="option_2" class="option-data ml-2">option 2</span>
                </p>
            </div>


            <div class="option-div cursor-pointer border text-2xl p-4">
                <p class="flex items-center">
                    <span
                        class="number-data border rounded-full bg-white text-black p-2 w-8 h-8 flex items-center justify-center">
                        3
                    </span>
                    <span id="option_3" class="option-data ml-2">option 3</span>
                </p>

            </div>

            <div class="option-div cursor-pointer border text-2xl p-4">
                <p class="flex items-center">
                    <span
                        class="number-data border rounded-full bg-white text-black p-2 w-8 h-8 flex items-center justify-center">
                        4
                    </span>
                    <span id="option_4" class="option-data ml-2">option 4</span>
                </p>

            </div>


        </div>
    </div>

    <div class="lower-section flex justify-around border text-xl p-4 mt-2 bg-white">
        <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl px-4 py-2">Previous
            Question</button>
        <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl px-4 py-2">Question
            List</button>
        <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl px-4 py-2">Next
            Question</button>
    </div>
</div>

<script>
    // Select all option elements
    const options = document.querySelectorAll('.option-div');

    // Loop through each option and add click event listener
    options.forEach(option => {
        option.addEventListener('click', function() {
            // Remove 'option-active' class from all options
            options.forEach(opt => opt.classList.remove('option-active'));
            // Add 'option-active' class to the clicked option
            this.classList.add('option-active');
        });
    });
</script>
