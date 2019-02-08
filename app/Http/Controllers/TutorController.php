<?php

namespace App\Http\Controllers;

use App\City;
use App\HireRequest;
use App\Http\Requests\TutorContactRequest;
use App\Http\Requests\TutorRequest;
use App\OnlineUser;
use App\StudentProgress;
use App\Tutor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class TutorController extends Controller
{

    public function index()
    {
        $auth = Auth::user();
        $tutor = Auth::user()->tutor;
        $progress = $this->percentage($tutor, $auth);
        $cities = City::orderBy('name')->get();
        return view('tutor.index', compact('auth', 'tutor', 'progress', 'cities'));
    }

    //user logout
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    /**
     * Tutor Personal information update
     * @param TutorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profileUpdate(TutorRequest $request)
    {
        $tutor = Tutor::where('user_id', Auth::id())->first();
        $tutor->age = empty($request->age) ? '' : $request->age;
        $tutor->experience = empty($request->experience) ? '' : $request->experience;
        $tutor->description = $request->description;
        $tutor->allow_in_search = $request->allow_in_search;
        $tutor->min_pay = $request->min_pay;
        $tutor->max_pay = $request->max_pay;
        $tutor->language = $request->language;
        $tutor->institute = $request->institute;
        $tutor->degree_title = $request->degree_title;
        $tutor->save();

        $user = Auth::user();
        $user->name = $request->name;
        if ($request->has('avatar')) {
            $file = $request->file('avatar');
            $name = str_random(12) . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/user';
            $file->move(public_path($path . '/'), $name);
            $user->avatar = $path . '/' . $name;
        }

        $user->save();

        if ($this->percentage($tutor, $user) >= 75) {
            $user->status = 'pending';
            $user->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated information.'
        ]);
    }

    /**
     * @param TutorContactRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profileContactUpdate(TutorContactRequest $request)
    {
        $tutor = Tutor::where('user_id', Auth::id())->first();
        $tutor->phone_number = $request->phone_number;
        $user = Auth::user();
        $user->city_id = $request->city_id;
        $user->save();
        $tutor->save();
        if ($this->percentage($tutor, $user) >= 75) {
            $user->status = 'pending';
            $user->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated Contact information.'
        ]);
    }

    public function viewPassword()
    {
        return view('tutor.password-change');
    }


    /**
     * user profile percentage count
     * @param $tutor
     * @param $user
     * @return int
     */
    protected function percentage($tutor, $user)
    {
        $percentage = 30;

        if ($user->avatar !== 'images/user_default.png' && !empty($user->avatar)) {
            $percentage += 10;
        }
        if (!empty($tutor->age)) {
            $percentage += 5;
        }
        if (!empty($tutor->experience)) {
            $percentage += 5;
        }
        if (!empty($tutor->description)) {
            $percentage += 5;
        }
        if (!empty($tutor->min_pay) && !empty($tutor->max_pay)) {
            $percentage += 5;
        }
        if (!empty($tutor->phone_number)) {
            $percentage += 5;
        }
        if (!empty($tutor->institute)) {
            $percentage += 5;
        }
        if (!empty($tutor->degree_title)) {
            $percentage += 5;
        }
        if (!empty($tutor->course)) {
            $percentage += 5;
        }
        if (!empty($tutor->subCourses)) {
            $percentage += 20;
        }

        return $percentage;
    }


    public function viewSkills()
    {
        $user = Auth::user()->tutor;
        $course = $user->course;
        $subCourses = $course->subCourses;
        $userCourses = $user->subCourses()->pluck('subCourse_id');
        $userCourses = $userCourses->toArray();
        return view('tutor.manage-skill', compact('course', 'subCourses', 'userCourses'));
    }

    public function storeSkills(Request $request)
    {
        $tutor = Auth::user()->tutor;

        $tutor->subCourses()->sync($request->sub_ids);
        return redirect()->back()->with([
            'success' => 'Successfully updated information.'
        ]);
    }

    public function viewRequests()
    {
        $tutor = Auth::user()->tutor;
        $requests = $tutor->requests()->with('courses')->with('days')->where('status', 'pending')->get();
        return view('tutor.tutor-request', compact('requests'));
    }

    public function approveRequest($id, $status)
    {
        $request = HireRequest::find($id);
        if ($status === 'accept') {
            $request->status = 'accepted';
        }
        if ($status === 'reject') {
            $request->status = 'rejected';
        }
        $request->save();
        return redirect()->back()->with([
            'success' => "Successfully $status request."
        ]);
    }

    public function deleteRequest($id)
    {
        HireRequest::find($id)->delete();

        return redirect()->back()->with([
            'success' => "Student detail deleted successfully."
        ]);
    }

    public function viewStudents()
    {
        $tutor = Auth::user()->tutor;
        $requests = $tutor->requests()->with('courses')->with('days')->where('status', 'accepted')->get();
        return view('tutor.tutor-student', compact('requests'));
    }

    public function storeReportStudent(Request $request)
    {
        $report = new StudentProgress();
        $report->user_id = $request->user_id;
        $report->tutor_id = Auth::user()->tutor->id;
        $report->quiz_marks = $request->quiz_marks;
        $report->assignment_marks = $request->assignment_marks;
        $report->course_id = $request->course_id;
        $report->comment = $request->comment;
        $report->month = Carbon::now()->toFormattedDateString();
        if (isset($request->student_id) && !empty($request->student_id)) {
            $report->parent_child_id = $request->student_id;
        }
        $report->save();

        return response()->json([
            'message' => 'saved'
        ]);
    }

    public function viewReport()
    {
        $reports = Auth::user()->tutor->reports;
        return view('tutor.tutor-report', compact('reports'));
    }

    public function viewInbox()
    {
        $conversations = Auth::user()->conversations();
        $onlines = OnlineUser::pluck('user_id');
        $onlines = $onlines->toArray();
        return view('tutor.tutor-inbox', compact('conversations', 'onlines'));
    }


    public function viewPayments()
    {
        $user = Auth::user();
        $payments = $user->tutor->payments()->with('user')->get();
        return view('tutor.tutor-payment', compact('payments'));
    }
}
