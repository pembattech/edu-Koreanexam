<x-app-layout>
    <div class="p-4 max-w-5xl mx-auto">

        <h1 class="bg-gray-100 w-full rounded-t-md text-3xl p-4 mb-4 text-center">Student Details</h1>

        <div class="flex flex-wrap justify-center items-center sm:px-48">

            <!-- Profile Picture -->
            <div class="flex flex-col p-4 text-center">
                @if ($student->profile_picture)
                    <img class="w-36 h-36 rounded-full object-cover mb-4"
                        src="{{ asset('assets/student_profile_pictures/' . $student->profile_picture) }}"
                        alt="Profile Picture">
                @endif

                <h3 class="text-xl font-semibold text-black">{{ $student->name }}</h3>
            </div>


            <!-- Student Details -->
            <div class="flex-1 max-w-2xl p-6">
                <ul class="list-none space-y-4">
                    <li><strong class="font-semibold text-black">Full Name:</strong> {{ $student->name }}</li>
                    <li><strong class="font-semibold text-black">Date of Birth:</strong> {{ $student->dob }}</li>
                    <li><strong class="font-semibold text-black">Gender:</strong>
                        @if ($student->gender == 'M')
                            Male
                        @elseif($student->gender == 'F')
                            Female
                        @else
                            Other
                        @endif
                    </li>
                    <li><strong class="font-semibold text-black">Address:</strong> {{ $student->address }}</li>
                    <li><strong class="font-semibold text-black">Contact Number:</strong> {{ $student->contact_number }}
                    </li>
                    <li><strong class="font-semibold text-black">Email:</strong> {{ $student->email }}</li>
                    <li><strong class="font-semibold text-black">Present Qualification:</strong>
                        {{ $student->present_qualification }}</li>
                    <li><strong class="font-semibold text-black">Father's Name:</strong> {{ $student->father_name }}
                    </li>
                    <li><strong class="font-semibold text-black">Mother's Name:</strong> {{ $student->mother_name }}
                    </li>
                    <li><strong class="font-semibold text-black">Profession:</strong> {{ $student->profession }}</li>
                    <li><strong class="font-semibold text-black">Parents' Phone Number:</strong>
                        {{ $student->parents_phone_number }}</li>
                    <li><strong class="font-semibold text-black">Enrollment Date:</strong>
                        {{ $student->enrollment_date }}</li>
                    <li><strong class="font-semibold text-black">Total Amount to Pay:</strong>
                        {{ $student->total_amount_to_pay }}</li>
                    <li>
                        @include('students.toggle_korean')
                    </li>
                </ul>
            </div>
        </div>


        <!-- Payment Table -->
        @include('student_payments.show')

        <!-- Action Buttons -->
        <div class="flex justify-center mt-8 space-x-4">

            <div class="flex justify-center">
                <a href="{{ route('students.edit', $student) }}"
                    class="block py-2.5 px-5 text-sm font-medium text-gray-900 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-400">
                    Edit
                </a>
            </div>

            <div class="flex justify-center">
                <form
                    class="px-5 py-2.5 text-sm font-medium rounded-lg focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300"
                    action="{{ route('students.destroy', $student) }}" method="POST"
                    onsubmit="return confirmDelete()">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        Delete
                    </button>
                </form>
            </div>

            <div class="flex justify-center">
                <a href="{{ route('students.print', $student->id) }}" target="_blank"
                    class="inline-flex px-5 py-2.5 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                    Print
                </a>
            </div>

            <a href="{{ route('student_payments.create', $student->id) }}"
                class="inline-flex px-5 py-2.5 text-sm font-medium bg-sky-50 text-sky-600 hover:bg-sky-100 hover:text-sky-700 focus:ring-sky-600 rounded-lg focus:ring-4 focus:outline-none">
                Add Payment
            </a>



        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="{{ route('students.index') }}"
                class="mt-2 py-2.5 px-5 inline-block text-white font-semibold bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-base focus:outline-none">Back
                to List</a>

        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this student? This action cannot be undone.');
        }
    </script>
</x-app-layout>
