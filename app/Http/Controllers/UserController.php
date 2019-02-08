<?php

namespace App\Http\Controllers;

use App\City;
use App\Course;
use App\Feedback;
use App\Http\Requests\UserRequest;
use App\Student;
use App\SubCourse;
use App\Support;
use App\Tutor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{

    public function index()
    {
        $courses = Course::orderBy('name')->with('tutors')->take(8)->get();
        $tutors = Tutor::whereHas('profile', function ($q) {
            $q->where('status', 'active');
        })->take(5)->get();
        $cities = City::orderBy('name')->get();
        $feedbacks = Feedback::latest()->with('user')->get();
        return view('index', compact('courses', 'tutors', 'feedbacks', 'cities'));
    }

    public function login(Request $request)
    {
        //check if email exists
        if (!User::where('email', $request->email)->exists()) {
            return response()->json(['key' => 'email', 'message' => 'This email not found in our records.'], 404);
        }

        // check if account is suspended
        if (User::where('email', $request->email)->first()->status === 'suspended') {
            return response()->json(['key' => 'suspended',
                'message' => 'Your account has been has been suspended.
                  Contact to administrator for further details.'], 404);
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // pass
            $user = Auth::user();
            if (null !== $user) {
                if ($user->role === 'Student') {
                    $redirectURL = url('/student');
                }

                if ($user->role === 'Parent') {
                    $redirectURL = url('/parent');
                }
                if ($user->role === 'Tutor') {
                    $redirectURL = url('/tutor');
                }
            }
            return response()->json(['redirectURL' => $redirectURL]);
        }
        return response()->json(['key' => 'password', 'message' => 'Password does not match.'], 404);
    }

    public function registration(UserRequest $request)
    {
        $user = New User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->city_id = $request->city_id;
        $user->password = bcrypt($request->password);

        if ($request->role === 'Student') {
            $user->role = 'Student';
            $user->status = 'active';
            $user->save();

            $student = new Student();
            $student->user_id = $user->id;
            $student->save();
            $redirectURL = url('/student');
        }

        if ($request->role === 'Parent') {
            $user->role = 'Parent';
            $user->status = 'active';
            $user->save();
            $redirectURL = url('/parent');
        }
        if ($request->role === 'Tutor') {
            $user->role = 'Tutor';
            $user->status = 'initial';
            $user->save();
            $redirectURL = url('/tutor');
            $tutor = new Tutor();
            $tutor->course_id = $request->course_id;
            $tutor->user_id = $user->id;
            $tutor->age = '';
            $tutor->experience = '';
            $tutor->phone_number = '';
            $tutor->save();
        }
        Auth::login($user);
        return response()->json(['redirectURL' => $redirectURL]);
    }

    public function passwordUpdate(Request $request)
    {
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Old password is incorrect.'
            ]);
        }
        Validator::make($request->all(), [
            'password' => ['min:6', 'confirmed',
                'regex:/^.*(?=.{2,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X]).*$/'],
        ], [
            'password.regex' => 'Must contain one digit.'
        ])->validate();

        Auth::user()->update(['password' => bcrypt($request->password)]);
        return response()->json([
            'status' => true,
            'message' => 'Successfully updated password.'
        ]);
    }

    public function allSubjects()
    {
        $courses = Course::orderBy('name')->with('tutors')->get();

        return view('all-subjects', compact('courses'));
    }

    public function allTutors(Request $request, $query = null)
    {
        $tutors = Tutor::paginate(6);
        $courses = Course::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        $course_id = null;
        $experience = [];
        $city_ids = [];
        return view('tutors-show', compact('tutors', 'cities', 'city_ids',
            'courses', 'course_id', 'experience'));
    }

    public function filterTutors(Request $request)
    {
        if (isset($request->course_id)) {
            $course_id = $request->course_id;
        } else {
            $course_id = '0';
        }
        if ($course_id == '0') {
            if (isset($request->experience)) {
                if (isset($request->city_ids)) {
                    $tutors = Tutor::whereIn('experience', $request->experience)
                        ->whereHas('profile', function ($q) use ($request) {
                            $q->whereIn('city_id', $request->city_ids);
                        })->paginate(10);
                } else {
                    $tutors = Tutor::whereIn('experience', $request->experience)->paginate(10);
                }
            } else {
                if (isset($request->city_ids)) {
                    if (isset($request->subCourse_id)) {
                        $tutors = Tutor::whereHas('profile', function ($q) use ($request) {
                            $q->whereIn('city_id', $request->city_ids);
                        })->whereHas('subCourses', function ($q) use ($request) {
                            $q->where('sub_courses.id', $request->subCourse_id);
                        })->paginate(10);
                    } else {
                        $tutors = Tutor::whereHas('profile', function ($q) use ($request) {
                            $q->whereIn('city_id', $request->city_ids);
                        })->paginate(10);
                    }
                } else {
                    $tutors = Tutor::paginate(10);
                }

            }
        } else {
            if (isset($request->experience)) {
                if (isset($request->city_ids)) {
                    $tutors = Tutor::where('course_id', $course_id)->whereIn('experience', $request->experience)
                        ->whereHas('profile', function ($q) use ($request) {
                            $q->whereIn('city_id', $request->city_ids);
                        })->paginate(10);
                } else {
                    $tutors = Tutor::where('course_id', $course_id)->whereIn('experience', $request->experience)->paginate(10);
                }

            } else {
                if (isset($request->city_ids)) {
                    $tutors = Tutor::where('course_id', $course_id)
                        ->whereHas('profile', function ($q) use ($request) {
                            $q->whereIn('city_id', $request->city_ids);
                        })->paginate(10);
                } else {
                    $tutors = Tutor::where('course_id', $course_id)->paginate(10);
                }
            }
        }

        if (isset($request->experience)) {
            $experience = $request->experience;
        } else {
            $experience = [];
        }

        if (isset($request->city_ids)) {
            $city_ids = $request->city_ids;
        } else {
            $city_ids = [];
        }
//        dd($request->all());
        $courses = Course::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        return view('tutors-show', compact('tutors', 'courses', 'cities', 'city_ids',
            'course_id', 'experience'));
    }

    public function aboutUs()
    {
        return view('about-us');
    }

    public function supportMessage(Request $request)
    {
        $support = new Support();
        $support->name = $request->name;
        $support->email = $request->email;
        $support->message = $request->message;
        $support->save();

        return response()->json([
            'message' => 'Your message sent successfully.'
        ]);
    }

    public function tutorProfile($id)
    {
        $tutor = Tutor::where('id', $id)->with('profile')->with('subCourses')->first();
        if (empty($tutor)) {
            abort(404);
        }

        return view('tutor-details', compact('tutor'));
    }

    public function searchCourse($query)
    {
        $data = SubCourse::where('name', 'LIKE', '%' . $query . '%')
            ->get(['name', 'id']);
        return response()->json([
            'empty' => empty($data[0]) ? true : false,
            'data' => $data
        ]);
    }
}
