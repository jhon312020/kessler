<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\User;

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
    protected $redirectTo = "/dashboard";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // /**
    //  * Get the needed authorization credentials from the request.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return array
    //  */
    // protected function credentials(Request $request)
    // {
    //     $credentials = $request->only($this->username(), 'password');
    //     $credentials['status'] = 1;
    //     return $credentials;
    //     //return ['email' => $request->{$this->username()}, 'password' => $request->password, 'status' => 1];
    // }

    // /**
    //  * Validate the user login request.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return void
    //  *
    //  * @throws \Illuminate\Validation\ValidationException
    //  */
    // protected function validateLogin(Request $request)
    // {
    //     // Get the user details from database and check if user is exist and active.
    //     $user = User::where('email',$request->email)->first();
    //     if($user && !$user->status) {
    //         throw ValidationException::withMessages([$this->username() => __('Inactive Account.  Please Contact Your Administrator')]);
    //     }

    //     // Then, validate input.
    //     return $request->validate([
    //         $this->username() => 'required|string',
    //         'password' => 'required|string',
    //     ]);
    // }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->status == 0) {
        $message = 'Inactive Account.  Please Contact Your Administrator';
        // Log the user out.
        $this->logout($request);
        // Return them to the log in form.
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                // This is where we are providing the error message.
                $this->username() => $message,
            ]);
        }
    }

}
