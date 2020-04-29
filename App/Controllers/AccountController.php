<?php


namespace App\Controllers;

use App\Models\Account;

class AccountController
{
    public function __construct($request)
    {
        // Auth middleware
        Auth('student');

        // profile complete and enroll course middleware
        $user = new Account();
        $user = $user->getUser($_SESSION['user_login']);
        $except = array('complete_profile', 'enroll_course');
        if (!in_array($request['action'], $except)) {
            if (is_null($user['father_name']) || is_null($user['cnic'])) {
                redirectWithMessage(app_url() . "/account/complete-profile",
                    "Please Complete your profile first to continue",
                    'complete_profile',
                    'msg');
            }
        }
    }

    public function dashboard()
    {

    }

    public function complete_profile()
    {
        echo "test";
    }
}