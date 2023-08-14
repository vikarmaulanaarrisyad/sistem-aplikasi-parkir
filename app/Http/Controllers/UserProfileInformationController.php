<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileInformationController extends Controller
{
    public function showPassword()
    {
        return view('profile.update-password-form');
    }
    public function showResetPassword()
    {
        return view('profile.reset-password-form');
    }
}
