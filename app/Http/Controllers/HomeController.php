<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Events\VideoCall;
use App\Feedback;
use App\HireRequest;
use App\Message;
use App\OnlineUser;
use App\Tutor;
use Illuminate\Broadcasting\BroadcastException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function userFeedback(Request $request)
    {
        $feedback = new Feedback();
        $feedback->message = $request->message;
        $feedback->user_id = Auth::id();
        $feedback->save();

        return response()->json([
            'message' => "We are very happy, to have your feedback."
        ]);
    }

    public function hireRequest($id)
    {
        $tutor = Tutor::findOrFail($id);
        $subCourses = $tutor->course->subCourses;

        return view('hire-request', compact('tutor', 'subCourses'));
    }

    public function hire($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'Parent' || Auth::user()->role === 'Student') {
                return view('includes.hire-iframe', compact('id'));
            }
        }
        return redirect('/');
    }

    public function requestStore(Request $request, $id)
    {
        $hire = new HireRequest();
        $hire->user_id = Auth::id();
        $hire->tutor_id = $id;
        $hire->start_time = $request->start_time;
        $hire->end_time = $request->end_time;
        $hire->amount_per_hour = $request->amount_per_hour;
        $hire->area_name = $request->area_name;
        $hire->total_hour = $request->total_hour;
        $hire->parent_or_student = 'Parent';
        $hire->save();
        $hire->courses()->sync($request->courses);
        foreach ($request->days as $day) {
            $hire->days()->create([
                'day' => $day
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Request successfully sent.'
        ]);
    }

    public function getMessages($id)
    {
        $auth_id = Auth::id();
        $messages = Message::where(function ($query) use ($id, $auth_id) {
            $query->where('user_id', '=', $auth_id)->where('friend_id', '=', $id);
        })->orWhere(function ($query) use ($id, $auth_id) {
            $query->where('user_id', '=', $id)->where('friend_id', '=', $auth_id);
        })->orderBy('created_at', 'asc')->get();

        Message::where('user_id', $id)
            ->where('friend_id', $auth_id)->where('is_read', false)->update(['is_read' => true]);
        return response()->json(['messages' => $messages], 200);

    }

    // start new conversation
    public function newConversationMessage($message, $id)
    {
        $auth = Auth::user();
        $auth->conversationMine()->sync($id);
        $this->storeMessage($id, $message);

        return response()->json([
            'ok' => true,
            'notify_message' => 'message has been delivered'
        ]);
    }

    public function storeMessage($id, $text)
    {
        $message = new Message();
        $message->user_id = Auth::id();
        $message->friend_id = $id;
        $message->message = $text;
        $message->is_read = false;
        $message->save();

        $message = Message::find($message->id);
        try {
            event(new MessageEvent($message));
        } catch (BroadcastException $e) {
            Log::info('error occurred in pusher message: ' . $e);
        }

        return response()->json([
            'notify_message' => 'message has been delivered',
            'message' => $message
        ]);
    }

    public function videoCall($id)
    {
        if (OnlineUser::where('user_id', $id)->exists()) {
            $friend['user_id'] = $id;
            $friend['friend_id'] = Auth::id();
            $friend['avatar'] = Auth::user()->avatar;
            event(new VideoCall($friend));

            return response()->json(['status' => true, 'message' => 'call is being forwarding...']);
        }
        return response()->json(['status' => false, 'message' => 'call is being forwarding...']);
    }

    public function videoLocalPage($id)
    {
        $room_number = $id . '-' . Auth::id();
        return view('video-call', compact('room_number'));
    }

    public function videoRemotePage($id)
    {
        $room_number = Auth::id() . '-' . $id;
        return view('video-call', compact('room_number'));
    }
}
