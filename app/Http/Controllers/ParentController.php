<?php

namespace App\Http\Controllers;

use App\Children;
use App\City;
use App\HireRequest;
use App\OnlineUser;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Stripe;
use Validator;

class ParentController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        $cities = City::orderBy('name')->get();
        return view('parent.index', compact('auth', 'cities'));
    }

    //user logout
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->city_id = $request->city_id;
        if ($request->has('avatar')) {
            $file = $request->file('avatar');
            $name = str_random(12) . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/user';
            $file->move(public_path($path . '/'), $name);
            $user->avatar = $path . '/' . $name;
        }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated information.'
        ]);
    }

    public function viewPassword()
    {
        return view('parent.password-change');
    }

    public function viewTutor()
    {
        $user = Auth::user();
        $requests = $user->requests()->with('courses')->with('days')->get();
        return view('parent.parent-tutor', compact('requests'));
    }

    public function deleteRequest($id)
    {
        HireRequest::find($id)->delete();

        return redirect()->back()->with([
            'success' => "Request deleted successfully."
        ]);
    }

    public function viewReport()
    {
        $reports = Auth::user()->reports;
        return view('parent.parent-report', compact('reports'));
    }

    public function viewPayments()
    {
        $user = Auth::user();
        $tutors = $user->requests()->where('status', 'accepted')->get();
        $payments = $user->payments()->with('tutor')->get();
        return view('parent.parent-payment', compact('tutors', 'payments'));
    }

    public function storePayment(Request $request)
    {
        $token = $request->stripe_token;
        $payment = new Payment();
        $payment->tutor_id = $request->tutor_id;
        $payment->user_id = Auth::id();
        $payment->amount = $request->amount;
        $payment->status = 'pending';
        $payment->date = Carbon::today()->toDateString();
        $payment->save();

        //payment charge on stripe

        Stripe::setApiKey("sk_test_fZO0IyRdXFnwv5v2yrUZLgfQF");
        $charge = Charge::create([
            'amount' => $payment->amount,
            'currency' => 'usd',
            'description' => Auth::user()->name . ' payments',
            'source' => $token,
        ]);

        return redirect()->back()->with([
            'success' => "Payment charged successfully."
        ]);
    }

    public function viewInbox()
    {
        $conversations = Auth::user()->conversations();
        $onlines = OnlineUser::pluck('user_id');
        $onlines = $onlines->toArray();
        return view('parent.parent-inbox', compact('conversations','onlines'));
    }

    public function viewChildren()
    {
        $childrens = Auth::user()->childrens;
        return view('parent.parent-children', compact('childrens'));
    }

    public function storeChildren(Request $request, $id = null)
    {
        if ($id != null) {
            $child = Children::find($id);
        } else {
            $child = new Children();
            $child->user_id = Auth::id();
        }

        $child->name = $request->name;
        $child->class = $request->class;
        $child->age = $request->age;
        $child->save();

        return redirect()->back()->with([
            'success' => "Information saved successfully."
        ]);
    }
}
