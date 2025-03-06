<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:100',
            'dob' => 'required|date',
            'gender' => 'required|in:M,F,O',
            'address' => 'required|string',
            'contact_number' => 'required|string|max:15',
            'email' => 'required|email|unique:students,email',
            'present_qualification' => 'required|string|max:100',
            'father_name' => 'required|string|max:100',
            'mother_name' => 'required|string|max:100',
            'profession' => 'required|string|max:100',
            'parents_phone_number' => 'required|string|max:15',
            'enrollment_date' => 'required|date',
            'total_amount_to_pay' => 'required|integer|min:1000'
            // 'courses' => 'required|array', // Ensure it's an array
            // 'courses.*' => 'in:programming-computer,office_package-computer,video_editing-computer,graphic_designing-computer,networking-computer,web_designing-computer,account_package-computer,english-language,japanese-language,korean-language,chinese-language,ielts-english_language,pte-english_language', // Validate each selected course

        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $imageName = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->move(public_path('assets/student_profile_pictures'), $imageName);
            $validatedData['profile_picture'] = $imageName;
        }

        $student = Student::create($validatedData);


        // // Extract the selected courses
        // $selectedCourses = $validatedData['courses'] ?? [];

        // foreach ($selectedCourses as $course) {
        //     Course::create([
        //         'student_id' => $student->id,
        //         'course_name' => $course,
        //     ]);
        // }

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified student.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\View\View
     */
    public function show(Student $student)
    {

        // // Eager load the courses associated with the student
        // $student->load('courses');

        $student->load('payments');

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\View\View
     */
    public function edit(Student $student)
    {

        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:100',
            'dob' => 'required|date',
            'gender' => 'required|in:M,F,O',
            'address' => 'required|string',
            'contact_number' => 'required|string|max:15',
            'email' => 'required|email|unique:students,email,' . $student->id, // Email must be unique, excluding the current student's email
            'present_qualification' => 'required|string|max:100',
            'father_name' => 'required|string|max:100',
            'mother_name' => 'required|string|max:100',
            'profession' => 'required|string|max:100',
            'parents_phone_number' => 'required|string|max:15',
            'enrollment_date' => 'required|date',
            'total_amount_to_pay' => 'required|integer|min:1'
            // 'computer_course' => 'required|in:CFB,DCO,DGD,OP,WD,CH,P',
            // 'language_course' => 'required|in:KR,EN,JP,HE,TU'
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Check if the folder exists, if not, create it
            $path = public_path('assets/student_profile_pictures');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            $imageName = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->move(public_path('assets/student_profile_pictures'), $imageName);
            $validatedData['profile_picture'] = $imageName;
        }

        $student->update($validatedData);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified student from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

    public function printStudentDetails(Student $student)
    {
        // Initialize the base64Image variable as an empty string
        $base64Image = '';

        // Check if the profile picture exists
        if ($student->profile_picture && file_exists(public_path('assets/student_profile_pictures/' . $student->profile_picture))) {
            // Fetch the image from the public path
            $imagePath = public_path('assets/student_profile_pictures/' . $student->profile_picture);
            $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
            $imageData = file_get_contents($imagePath);
            $base64Image = 'data:image/' . $imageType . ';base64,' . base64_encode($imageData);
        }

        // Prepare the HTML content with the embedded base64 image and margin CSS
        $html = '
        <div style="margin: 0 0.5in;">
            <div>
                <h1 style="background-color: #f3f4f6; width: 100%; font-size: 1.875rem; padding: 8px; margin-bottom: 16px; text-align: center;">
                    Student Details
                </h1>

                <div style="display: flex; padding-left: 4px; padding-right: 4px;">
                    <!-- Profile Picture -->';

        if ($base64Image) {
            $html .= '
                    <div style="width: 12rem; height: auto; flex-shrink: 0; margin-left: 16px;">
                        <img style="width: 100%; height: auto;" src="' . $base64Image . '" alt="Profile Picture">
                    </div>';
        }

        $html .= '
                    <div style="flex-grow: 1;">
                        <ul style="list-style: none; padding-left: 0;">
                            <li style="font-size: 18px;"><strong style="font-weight: 600; line-height: 3rem; color: black;">Full Name:</strong> ' . $student->name . '</li>
                            <li style="font-size: 18px;"><strong style="font-weight: 600; line-height: 3rem; color: black;">Date of Birth:</strong> ' . $student->dob . '</li>
                            <li style="font-size: 18px;"><strong style="font-weight: 600; line-height: 3rem; color: black;">Gender:</strong> ' . ($student->gender == "M" ? "Male" : ($student->gender == "F" ? "Female" : "Other")) . '</li>
                            <li style="font-size: 18px;"><strong style="font-weight: 600; line-height: 3rem; color: black;">Address:</strong> ' . $student->address . '</li>
                            <li style="font-size: 18px;"><strong style="font-weight: 600; line-height: 3rem; color: black;">Contact Number:</strong> ' . $student->contact_number . '</li>
                            <li style="font-size: 18px;"><strong style="font-weight: 600; line-height: 3rem; color: black;">Email:</strong> ' . $student->email . '</li>
                            <li style="font-size: 18px;"><strong style="font-weight: 600; line-height: 3rem; color: black;">Present Qualification:</strong> ' . $student->present_qualification . '</li>
                            <li style="font-size: 18px;"><strong style="font-weight: 600; line-height: 3rem; color: black;">Father\'s Name:</strong> ' . $student->father_name . '</li>
                            <li style="font-size: 18px;"><strong style="font-weight: 600; line-height: 3rem; color: black;">Mother\'s Name:</strong> ' . $student->mother_name . '</li>
                            <li style="font-size: 18px;"><strong style="font-weight: 600; line-height: 3rem; color: black;">Profession:</strong> ' . $student->profession . '</li>
                            <li style="font-size: 18px;"><strong style="font-weight: 600; line-height: 3rem; color: black;">Parents\' Phone Number:</strong> ' . $student->parents_phone_number . '</li>
                            <li style="font-size: 18px;"><strong style="font-weight: 600; line-height: 3rem; color: black;">Enrollment Date:</strong> ' . $student->enrollment_date . '</li>
                        </ul>
                </div>
            </div>

            </div>
        </div>';

        // Create PDF using dompdf
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $options->set('isRemoteEnabled', true); // Enable remote assets if necessary

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);

        // Set the paper size to A4 and define custom margins
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF (inline in browser)
        $dompdf->stream('student_details.pdf', array('Attachment' => false)); // Set Attachment to true for download
    }

    public function toggleKoreanStatus($id)
    {
        $student = Student::findOrFail($id);
        $student->is_korean = !$student->is_korean;

        $password = null;

        if ($student->is_korean) {
            $password = Str::random(8);
            $student->password = Hash::make($password);
        } else {
            // Clear the password when toggling off Korean
            $student->password = null;
        }

        $student->save();

        return response()->json([
            'success' => true,
            'message' => 'Student Korean status toggled successfully.',
            'is_korean' => $student->is_korean,
            'passwd' => $password
        ]);
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('students.login');
    }

    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Get the credentials from the request
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the student using the 'student' guard
        if (Auth::guard('student')->attempt($credentials)) {
            // Authentication was successful, so regenerate the session ID for security
            session()->regenerate();

            // Redirect the user to the intended route or the dashboard
            return redirect()->intended(route('dashboard'));
        }

        // If authentication fails, return back with error messages
        return back()->withErrors(['email' => 'Invalid credentials. Please try again.']);
    }

    public function logout()
{
    // Log out the student using the 'student' guard
    Auth::guard('student')->logout();

    // Invalidate the session to ensure it's properly cleared
    session()->invalidate();

    // Regenerate the session ID to prevent session fixation attacks
    session()->regenerateToken();

    // Redirect the user to the login page
    return redirect(route('student.loginForm'));
}

}
