<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    public function redirectTo()
    {
        \Session::flash('flash_message', 'ログインしました！');
        return '/profile';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
    * OAuth認証先にリダイレクト
    *
    * @param str $provider
    * @return \Illuminate\Http\Response
    */

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    /**
    * OAuth認証の結果受け取り
    *
    * @param str $provider
    * @return \Illuminate\Http\Response
    */

    public function handleProviderCallback($provider)
    {
        try {
            $providerUser = \Socialite::driver($provider)->user();
        } catch(\Exception $e) {
            return redirect('/login')->with('oauth_error', '予期せぬエラーが発生しました');
        }

        $user = User::where(['email' => $providerUser->getEmail()])->first();

        if ($user) {
            Auth::login($user);
            return redirect('/profile');
        } else {
            $newUser = User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'role' => 'rider',
            ]);
            $newUser->email_verified_at = Carbon::now();
            
            dd($newUser);
            Auth::login($newUser);
            return redirect('/profile');
        }
    }
}
