<x-app-layout>

    <div class="p-4 max-w-5xl mx-auto">

            <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight md:text-3xl lg:text-4xl text-gray-600">Add New Student</h1>

            <div class="p-2">
                <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="py-2">
                        <label class="block mb-2 text-base font-medium text-gray-900" for="profile_picture">Profile Picture</label>
                        <input type="file" name="profile_picture" id="profile_picture"
                            class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            onchange="previewImage(event)">
                        @error('profile_picture')
                            <div class="text-base text-red-600">{{ $message }}</div>
                        @enderror

                        <div id="imagePreview" class="mt-2 {{ session('profile_picture') ? '' : 'hidden' }}">
                            <img src="{{ session('profile_picture') ? asset(session('profile_picture')) : '' }}"
                                alt="Profile Picture" class="object-cover w-24 h-24 rounded-full">
                        </div>
                    </div>

                    <div class="py-2">
                        <label class="block mb-2 text-base font-medium text-gray-900" for="name">Full Name</label>
                        <input type="text" name="name" id="name"
                            class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-base text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="py-2">
                        <label class="block mb-2 text-base font-medium text-gray-900" for="email">Email Address</label>
                        <input type="text" name="email" id="email"
                            class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-base text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                        <div class="py-2">
                            <label class="block mb-2 text-base font-medium text-gray-900" for="dob">Date of Birth</label>
                            <input type="date" name="dob" id="dob"
                                class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ old('dob') }}" required>
                            @error('dob')
                                <div class="text-base text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="py-2">
                            <label class="block mb-2 text-base font-medium text-gray-900" for="marital_status">Marital Status</label>
                            <select name="marital_status" id="marital_status"
                                class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required>
                                <option value="S" {{ old('marital_status') == 'S' ? 'selected' : '' }}>Single
                                </option>
                                <option value="M" {{ old('marital_status') == 'M' ? 'selected' : '' }}>Married
                                </option>
                                <option value="D" {{ old('marital_status') == 'D' ? 'selected' : '' }}>Divorced
                                </option>
                                <option value="W" {{ old('marital_status') == 'W' ? 'selected' : '' }}>Widowed
                                </option>
                            </select>
                            @error('marital_status')
                                <div class="text-base text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="py-2">
                            <label class="block mb-2 text-base font-medium text-gray-900" for="gender">Gender</label>
                            <select name="gender" id="gender"
                                class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required>
                                <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Male</option>
                                <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Female</option>
                                <option value="O" {{ old('gender') == 'O' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <div class="text-base text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="py-2">
                        <label class="block mb-2 text-base font-medium text-gray-900" for="address">Address</label>
                        <textarea name="address" id="address"
                            class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            rows="3" required>{{ old('address') }}</textarea>
                        @error('address')
                            <div class="text-base text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                        <div class="py-2">
                            <label class="block mb-2 text-base font-medium text-gray-900" for="contact_number">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number"
                                class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ old('contact_number') }}" required>
                            @error('contact_number')
                                <div class="text-base text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="py-2">
                            <label class="block mb-2 text-base font-medium text-gray-900" for="present_qualification">Present Qualification</label>
                            <input type="text" name="present_qualification" id="present_qualification"
                                class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ old('present_qualification') }}" required>
                            @error('present_qualification')
                                <div class="text-base text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    {{-- <div class="py-2">
                        <p>Select Computer Course</p>
                        <ul
                            class="items-center w-full text-sm font-medium text-gray-900 bg-gray-50 border border-gray-200 rounded-lg sm:flex">
                            <!-- Computer Courses -->
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input id="programming-checkbox" type="checkbox" name="courses[]"
                                        value="programming-computer"
                                        class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500">
                                    <label class="block mb-2 text-base font-medium text-gray-900" for="programming-checkbox"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Programming</label>
                                </div>
                            </li>

                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input id="office_package-checkbox" type="checkbox" name="courses[]"
                                        value="office_package-computer"
                                        class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500">
                                    <label class="block mb-2 text-base font-medium text-gray-900" for="office_package-checkbox"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Office
                                        Package</label>
                                </div>
                            </li>


                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input id="video_editing-checkbox" type="checkbox" name="courses[]"
                                        value="video_editing-computer"
                                        class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500">
                                    <label class="block mb-2 text-base font-medium text-gray-900" for="video_editing-checkbox"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Video
                                        Editing</label>
                                </div>
                            </li>

                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input id="graphic_designing-checkbox" type="checkbox" name="courses[]"
                                        value="graphic_designing-computer"
                                        class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500">
                                    <label class="block mb-2 text-base font-medium text-gray-900" for="graphic_designing-checkbox"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Graphic
                                        Designing</label>
                                </div>
                            </li>

                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input id="networking-checkbox" type="checkbox" name="courses[]"
                                        value="networking-computer"
                                        class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500">
                                    <label class="block mb-2 text-base font-medium text-gray-900" for="networking-checkbox"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Networking</label>
                                </div>
                            </li>

                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input id="web_designing-checkbox" type="checkbox" name="courses[]"
                                        value="web_designing-computer"
                                        class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500">
                                    <label class="block mb-2 text-base font-medium text-gray-900" for="web_designing-checkbox"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Web
                                        Designing</label>
                                </div>
                            </li>

                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input id="account_package-checkbox" type="checkbox" name="courses[]"
                                        value="account_package-computer"
                                        class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500">
                                    <label class="block mb-2 text-base font-medium text-gray-900" for="account_package-checkbox"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Account
                                        Package</label>
                                </div>
                            </li>

                        </ul>
                    </div>

                    <div class="py-2">
                        <p>Select Language Class</p>
                        <ul
                            class="items-center w-full text-sm font-medium text-gray-900 bg-gray-50 border border-gray-200 rounded-lg sm:flex">

                            <!-- Language Courses -->
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input id="english-checkbox" type="checkbox" name="courses[]"
                                        value="english-language"
                                        class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500">
                                    <label class="block mb-2 text-base font-medium text-gray-900" for="english-checkbox"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">English</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input id="japanese-checkbox" type="checkbox" name="courses[]"
                                        value="japanese-language"
                                        class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500">
                                    <label class="block mb-2 text-base font-medium text-gray-900" for="japanese-checkbox"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Japanese</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input id="korean-checkbox" type="checkbox" name="courses[]"
                                        value="korean-language"
                                        class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500">
                                    <label class="block mb-2 text-base font-medium text-gray-900" for="korean-checkbox"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Korean</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input id="chinese-checkbox" type="checkbox" name="courses[]"
                                        value="chinese-language"
                                        class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500">
                                    <label class="block mb-2 text-base font-medium text-gray-900" for="chinese-checkbox"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">Chinese</label>
                                </div>
                            </li>
                        </ul>
                        @error('courses')
                            <!-- Change this to 'courses' -->
                            <div class="text-base text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="py-2">
                        <p>Select English Language Proficiency Test Class</p>
                        <ul
                            class="items-center w-full text-sm font-medium text-gray-900 bg-gray-50 border border-gray-200 rounded-lg sm:flex">

                            <!-- Language Courses -->
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input id="ielts-checkbox" type="checkbox" name="courses[]"
                                        value="ielts-english_language"
                                        class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500">
                                    <label class="block mb-2 text-base font-medium text-gray-900" for="ielts-checkbox"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">IELTS</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input id="pte-checkbox" type="checkbox" name="courses[]"
                                        value="pte-english_language"
                                        class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500">
                                    <label class="block mb-2 text-base font-medium text-gray-900" for="pte-checkbox"
                                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900">PTE</label>
                                </div>
                            </li>
                        </ul>
                    </div> --}}

                    <div class="py-2">
                        <label class="block mb-2 text-base font-medium text-gray-900" for="father_name">Father's Name</label>
                        <input type="text" name="father_name" id="father_name"
                            class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ old('father_name') }}" required>
                        @error('father_name')
                            <div class="text-base text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="py-2">
                        <label class="block mb-2 text-base font-medium text-gray-900" for="mother_name">Mother's Name</label>
                        <input type="text" name="mother_name" id="mother_name"
                            class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ old('mother_name') }}" required>
                        @error('mother_name')
                            <div class="text-base text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="py-2">
                        <label class="block mb-2 text-base font-medium text-gray-900" for="profession">Profession</label>
                        <input type="text" name="profession" id="profession"
                            class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ old('profession') }}" required>
                        @error('profession')
                            <div class="text-base text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                        <div class="py-2">
                            <label class="block mb-2 text-base font-medium text-gray-900" for="parents_phone_number">Parents' Phone Number</label>
                            <input type="text" name="parents_phone_number" id="parents_phone_number"
                                class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ old('parents_phone_number') }}" required>
                            @error('parents_phone_number')
                                <div class="text-base text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="py-2">
                            <label class="block mb-2 text-base font-medium text-gray-900" for="enrollment_date">Enrollment Date</label>
                            <input type="date" name="enrollment_date" id="enrollment_date"
                                class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ old('enrollment_date') }}" required>
                            @error('enrollment_date')
                                <div class="text-base text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="py-2">
                            <label class="block mb-2 text-base font-medium text-gray-900" for="total_amount_to_pay">Total Amount to Pay</label>
                            <input type="number" name="total_amount_to_pay" id="total_amount_to_pay"
                                class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                value="{{ old('total_amount_to_pay') }}" required>
                            @error('total_amount_to_pay')
                                <div class="text-base text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="pt-2">

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Save</button>
                    </div>
                </form>
            </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('imagePreview').style.display = 'block';
                document.getElementById('imagePreview').getElementsByTagName('img')[0].src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

</x-app-layout>
