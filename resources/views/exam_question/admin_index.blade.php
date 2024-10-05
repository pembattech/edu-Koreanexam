<x-app-layout>

    <div class="relative overflow-x-auto sm:rounded-lg">
        <div class="pb-4 flex justify-between items-center">
            <div>

                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                        class="block pt-2 pl-10 text-base text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search for items">
                </div>

            </div>
            <!-- A div to display the results -->
            <div id="todayExamsContainer" class="text-2xl text-gray-950"></div>
        </div>
        <table class="w-full text-base text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Exam Name</th>
                    <th scope="col" class="px-6 py-3">Total Questions</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($exam_sets as $exam_set)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            Set {{ str_replace('set_', '', $exam_set->set) }}
                        </th>
                        <td class="px-6 py-4">{{ $exam_set->total_questions }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('exam_question.view_set', $exam_set->set) }}"
                                class="font-medium text-blue-600 hover:underline">View</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <script>
     $(document).ready(function() {
    // Search functionality
    $("#table-search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        console.log("Search value: " + value); // Log the search input

        $("table tbody tr").filter(function() {
            var rowText = $(this).text().toLowerCase();
            console.log("Row text: " + rowText); // Log each row's text

            var isVisible = rowText.indexOf(value) > -1;
            console.log("Is row visible: " + isVisible); // Log whether the row matches the search value

            $(this).toggle(isVisible); // Toggle visibility of the row
        });
    });
});

    </script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('exam_routine.show_today_exam') }}', // Use the named route
                method: 'GET',
                success: function(data) {
                    // Clear previous results
                    $('#todayExamsContainer').empty();

                    if (data.length === 0) {
                        $('#todayExamsContainer').append(
                            '<p>No exams scheduled for today.</p>');
                    } else {
                        // Loop through the exams and append to the container
                        $.each(data, function(index, exam) {
                            $('#todayExamsContainer').append(
                                '<div class="exam"><p><strong>Today Exam:</strong> Set ' +
                                exam.set.replace("set_", " ") + '</p></div>'
                            );
                        });

                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Error fetching today\'s exams.');
                }
            });

        });
    </script>
</x-app-layout>
