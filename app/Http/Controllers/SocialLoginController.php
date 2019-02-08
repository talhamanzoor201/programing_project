<?php

namespace App\Http\Controllers;


use App\Student;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{


    // google socialite

    /**
     * Redirect the user to the google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProviderGoogle(Request $request)
    {
        session(['login-role' => $request->role]);
        session(['type_login' => 'register']);
        return Socialite::driver('google')->redirect();
    }

    public function loginGoogle(Request $request)
    {
        session(['login-role' => $request->role]);
        session(['type_login' => 'login']);
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallbackGoogle()
    {

        $user = Socialite::driver('google')->user();

        $user = $this->userRegister($user);
        if (!$user) {
            return redirect('/')->with(['user-not-exists' => 'not exists']);
        }
        Auth::login($user);

        return redirect('/');
    }

    public function redirectToProviderTwitter(Request $request)
    {
        session(['login-role' => $request->role]);
        session(['type_login' => 'register']);
        return Socialite::driver('twitter')->redirect();
    }

    public function loginTwitter(Request $request)
    {
        session(['login-role' => $request->role]);
        session(['type_login' => 'login']);
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallbackTwitter()
    {
        $user = Socialite::driver('twitter')->user();
        $user1 = $this->userRegister($user);
        if (!$user1) {
            return redirect('/')->with(['user-not-exists' => 'not exists']);
        }
        Auth::login($user1);
        return redirect('/');
    }


    protected function userRegister($user)
    {
        $email = $user->getEmail();
        $name = $user->getName();
        $avatar = $user->avatar_original;
        $type_login = session('type_login');
        $userExists = User::where('email', $email)->first();
        if (!empty($userExists)) {
            return $userExists;
        }

        if (empty($userExists) && $type_login === 'register') {
            $newUser = new User();
            $newUser->name = $name;
            $newUser->email = $email;
            $newUser->password = bcrypt("secret856");
            $newUser->city_id = 1;
            $newUser->role = session('login-role');
            $newUser->avatar = $avatar;
            $newUser->save();

            if ($newUser->role === 'Student') {
                $student = new Student();
                $student->user_id = $newUser->id;
                $student->save();
            }
            return $newUser;
        }

        if (empty($userExists) && $type_login === 'login') {
            return false;
        }
    }
}
