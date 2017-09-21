<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Library\Eeyes\Api\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Session;
use phpCAS;

class LoginController extends Controller
{
    protected $redirectTo = '/';

    public function __construct()
    {
        phpCAS::client(CAS_VERSION_2_0, config('cas.host'), config('cas.port'), config('cas.context'));
        if (config('app.debug')) {
            phpCAS::setNoCasServerValidation();
        }
    }

    public function login()
    {
        phpCAS::forceAuthentication();
        $net_id = phpCAS::getUser();
        Session::forget('cas_user');
        /** @var \App\CasUser $user */
        $user = Auth::loginUsingId($net_id);
        if ($user->can('website.admin.login')) {
            return redirect()->intended($this->redirectTo);
        }
        return response($user->getPermissionMsg(), 403);
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        session_unset();
        session_destroy();
        return redirect(phpCAS::getServerLogoutURL() . '?' . http_build_query([
                'service' => url('/'),
            ]));
    }
}
