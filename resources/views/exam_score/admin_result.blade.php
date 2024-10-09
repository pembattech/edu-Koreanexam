<x-app-layout>
    <div class="relative overflow-x-auto sm:rounded-lg">
        <div class="pb-4">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="table-search"
                    class="block pt-2 pl-10 text-base text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Search for items">
            </div>
        </div>

        <div class="max-h-96 overflow-y-auto">
            <table class="w-full text-base text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 sticky top-0 z-10">
                    <tr>
                        <th scope="col" class="px-6 py-3 bg-gray-50">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50">
                            Korean Score
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50">
                            Set Number
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50">
                            Exam Start Time
                        </th>
                    </tr>
                </thead>

                <!-- Scrollable tbody -->
                <tbody class="bg-white">
                    @foreach ($examScores as $examScore)
                        <tr class="border-b hover:bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $examScore->user->name }}
                            </th>
                            <td class="px-6 py-4">{{ $examScore->korean_score }}</td>
                            <td class="px-6 py-4">
                                Set {{ str_replace('set_', '', $examScore->korean_score) }}
                            </td>
                            <td class="px-6 py-4">{{ $examScore->exam_start_time }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Search functionality
            $("#table-search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
</x-app-layout>
