<?php

namespace App\Http\Controllers;

use App\Course;
use App\Feedback;
use App\SubCourse;
use App\Support;
use App\Tutor;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AdminController extends Controller
{

    // admin dashboard
    public function create()
    {
        $total_users = User::count();
        $month_users = User::whereMonth('created_at',Carbon::now()->month)->count();
        $total_courses = Course::count();
        $total_tutors = Tutor::count();
        $total_visitors = null;
        $complaints = Support::latest()->get();

        return view('admin.index', compact('complaints', 'total_users',
            'month_users', 'total_courses', 'total_visitors', 'total_tutors'
        ));


    }

    // admin login page
    public function adminLoginView()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('admin/dashboard');
        }

        return view('admin.login');
    }

    // admin login request handle
    public function adminLogin(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('admin')->attempt($credentials)) {
            // auth passed

            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false]);
    }

    // admin logout
    public function logOut()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    // admin profile view
    public function profileUpdate()
    {
        return view('admin.profile', ['admin' => Auth::guard('admin')->user()]);
    }

    // admin profile edit
    public function profileEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'regex:/^[A-Za-z\s-_]+$/'
//            'name' => ['required', 'regex:/^[a-zA-Z\s]+$'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $admin = Auth::guard('admin')->user();
        $admin->email = $request->email;
        $admin->name = $request->name;
        $admin->save();
        return redirect()->back()->with(['success' => 'Information successfully changed']);
    }

    //updating user password
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with(['errorp' => 'New password and confirmed password not matched.']);
        }

        if (!Hash::check($request->old_password, Auth::guard('admin')->user()->password)) {

            return redirect()->back()
                ->with(['errorp' => 'Old password is incorrect.']);

        }

        Auth::guard('admin')->user()->update(['password' => bcrypt($request->new_password)]);
        return redirect()->back()->with(['success' => 'Password successfully changed']);
    }


    public function coursesView()
    {
        $courses = Course::all();
        return view('admin.courses', ['courses' => $courses]);
    }

    //delete course
    public function deleteCourse($id)
    {
        $course = Course::find($id);
        $course->subCourses()->delete();
        $course->delete();
        return redirect()->back()->with(['success' => 'Course deleted successfully.']);
    }

    //add new course
    public function addCourses(Request $request, $id = null)
    {
        if ($id != null) {
            $course = Course::find($id);
            $message = 'Course updated successfully.';
        } else {
            $course = new Course();
            $message = 'Course added successfully.';
        }

        $course->name = $request->name;
        $course->icon = $request->icon;
        $course->save();
        return redirect()->back()->with(['success' => $message]);
    }

    // sub courses
    public function viewSubCourses()
    {
        $courses = Course::orderBy('name')->get();
        $subCourses = SubCourse::all();
        return view('admin.sub-courses', compact('subCourses', 'courses'));
    }

    public function addSubCourses(Request $request, $id = null)
    {
        if ($id != null) {
            $course = SubCourse::find($id);
            $message = 'Course updated successfully.';

        } else {
            $course = new SubCourse();
            $course->course_id = $request->course_id;
            $message = 'Course added successfully.';
        }

        $course->name = $request->name;
        $course->save();
        return redirect()->back()->with(['success' => $message]);
    }

    //delete course
    public function deleteSubCourse($id)
    {
        $course = SubCourse::find($id)->delete();
        return redirect()->back()->with(['success' => 'Course deleted successfully.']);
    }

    //////////////  users manage
    public function viewUser()
    {
        $users = User::orderBy('role')->get();
        return view('admin.user-manage', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user->role === 'Student') {
            $user->student()->delete();
        }
        if ($user->role === 'Tutor') {
            $user->tutor()->delete();
        }
        $user->delete();
        return redirect()->back()->with(['success' => 'User profile deleted successfully.']);
    }

    public function statusUser($id)
    {
        $user = User::find($id);

        if ($user->status === 'active') {
            $user->status = 'suspended';
        } else {
            $user->status = 'active';
        }
        $user->save();
        return redirect()->back()->with(['success' => 'User account status change successfully.']);
    }

    /////////////////// tutor request
    public function viewTutorRequest()
    {
        $users = User::where('status', 'pending')->where('role', 'Tutor')->get();
        return view('admin.tutor-request', compact('users'));
    }

    public function tutorRequestAccount($status, $id)
    {
        $user = User::find($id);
        if ($status === 'accept') {
            $user->status = 'active';
        }
        if ($status === 'reject') {
            $user->status = 'rejected';
        }
        $user->save();
        return redirect()->back()->with(['success' => "User account has been $status ."]);
    }

    public function complainDelete($id)
    {
        Support::find($id)->delete();
        return redirect()->back()->with(['success' => "Complaint Deleted successfully."]);
    }

    public function feedbackView()
    {
        $feedbacks = Feedback::latest()->with('user')->get();
        return view('admin.feedback', compact('feedbacks'));
    }

    public function feedbackDelete($id)
    {
        Feedback::find($id)->delete();
        return redirect()->back()->with(['success' => "Feedback Deleted successfully."]);
    }
}
