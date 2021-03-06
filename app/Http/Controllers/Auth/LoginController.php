<?php

namespace App\Http\Controllers\Auth;

use App\Hoa;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Determines where user will be sent after authenticating
     *
     * @return string
     */
    protected function redirectTo()
    {
        if (Auth::user()->isBoardMember()) {
            return route('boardmember.index', [], false);
        } elseif (Auth::user()->isComplianceOfficer()) {
            return route('compliance.index', [], false);
        } else { // if (Auth::user()->isOwner()) 
            return route('owner.index', [], false);
        }
    }
}
