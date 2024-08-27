<div id="exam_table_popup" class=" hidden fixed inset-0 bg-gray-100 h-screen">

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        
        @include('exam_question.topbar')

        <div class="mid-section grid gap-4 grid-cols-[1fr_1fr] text-xl mt-2 p-4 bg-white">
            <div class="border">

                <p class="p-4 font-medium text-center">
                    Reading
                </p>

                <div class="right-question-item grid grid-cols-5 gap-4">

                    @for ($i = 1; $i <= 20; $i++)
                        <p data-question-number= "{{ $i }}"
                            class="question-item cursor-pointer hover:font-bold border-2 border-black p-4 text-center">
                            {{ $i }}
                        </p>
                    @endfor
                </div>

            </div>

            <div class="border">
                <p class="p-4 font-medium text-center">
                    Listening
                </p>

                <div class="grid grid-cols-5 gap-4">
                    @for ($i = 21; $i <= 40; $i++)
                        <p data-question-number= "{{ $i }}"
                            class="question-item cursor-pointer hover:font-bold border-2 border-black p-4 text-center">
                            {{ $i }}</p>
                    @endfor
                </div>
            </div>

        </div>

        <div class="lower-section flex justify-around border text-xl p-4 mt-2 bg-white">

            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl px-4 py-2">Submit
                and Finish Exam</button>

        </div>
    </div>
</div>

<script>
    // Retrieve the JSON string from session storage
    let storedArray = sessionStorage.getItem("lst_choosen_option");

    // Convert the JSON string back to an array
    let myArray = JSON.parse(storedArray);

    // Loop through the array and add the 'complete' class to the corresponding question-item
    myArray.forEach(item => {
        // Extract the question number from the item (assuming the format 'set_x_y')
        let parts = item.split('_');
        let questionNumber = parts[2]; // 'y' in 'set_x_y'

        // Find the question item with the matching data-question-number
        let questionElement = document.querySelector(`[data-question-number="${questionNumber}"]`);

        // Add the 'complete' class if the element exists
        if (questionElement) {
            questionElement.classList.add('answered');
        }
    });
</script>
