<x-app-layout>

    @if (session('success'))
        <div id="toast-success"
            class="bg-gray-100 border text-black fixed top-4 left-4 flex items-center w-full max-w-xs p-2 rounded-lg shadow transform -translate-x-full transition-transform duration-500 ease-in-out"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3 text-base font-normal">{{ session('success') }}</div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const toastSuccess = document.getElementById('toast-success');

                // Show the toast by sliding it in
                setTimeout(() => {
                    toastSuccess.classList.remove('-translate-x-full');
                    toastSuccess.classList.add('translate-x-0');
                }, 100); // Small delay to ensure DOM is ready for transition

                // Slide out after 4 seconds
                setTimeout(() => {
                    toastSuccess.classList.remove('translate-x-0');
                    toastSuccess.classList.add('-translate-x-full');
                }, 4000);

                // Hide the toast completely after the slide-out animation
                setTimeout(() => {
                    toastSuccess.style.display = 'none';
                }, 4500); // This should be longer than the slide-out duration
            });
        </script>
    @endif

    <div class="p-4 max-w-5xl mx-auto">
        <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight md:text-3xl lg:text-4xl text-gray-600">Student List</h1>
        <div class="p-2">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('students.create') }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">Add New Student</a>
                
                <div class="relative">
                    <input type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 p-2.5" placeholder="Search for students...">
                </div>
            </div>
    
            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="student-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profile Picture</th>
                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Number</th>
                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($students as $student)
                            <tr>
                                <td class="px-2 py-3 whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-2 py-3 whitespace-nowrap">
                                    @if (!$student->profile_picture)
                                        @php
                                            $words = explode(' ', $student->name);
                                            $initials = '';
                                            foreach ($words as $word) {
                                                $initials .= strtoupper($word[0]);
                                            }
                                        @endphp
                                        <div class="h-20 w-20 flex justify-center items-center bg-gray-300 text-gray-700 text-2xl font-bold rounded-full">
                                            {{ $initials }}
                                        </div>
                                    @else
                                        <img class="h-20 w-20 rounded-full object-cover" src="{{ asset('assets/student_profile_pictures/' . $student->profile_picture) }}" alt="Profile Picture">
                                    @endif
                                </td>
                                <td class="px-2 py-3 whitespace-nowrap">{{ Str::limit($student->name, $limit = 20, $end = ' ...') }}</td>
                                <td class="px-2 py-3 whitespace-nowrap">
                                    @if ($student->gender == 'M')
                                        Male
                                    @elseif($student->gender == 'F')
                                        Female
                                    @else
                                        Other
                                    @endif
                                </td>
                                <td class="px-2 py-3 whitespace-nowrap">{{ Str::limit($student->address, $limit = 30, $end = ' ...') }}</td>
                                <td class="px-2 py-3 whitespace-nowrap">{{ $student->contact_number }}</td>
                                <td class="px-2 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <a href="{{ route('students.show', $student) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">View</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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

</x-app-layout>
