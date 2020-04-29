<?php


namespace App\Controllers;

use App\Models\Account;
use Core\View;

class AccountController
{
    public function __construct($request)
    {
        // Auth middleware
        Auth('student');
        // profile complete and enroll course middleware
        $user = new Account();
        $user = $user->getUser($_SESSION['user_login']);
        $except = array('complete_profile', 'enroll_course', 'postCompleteProfile');
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
        View::render('student/layouts/head.html');
        View::render('student/layouts/navbar.html');
        View::render('student/complete_profile.html');
        View::render('student/layouts/script.html');
    }

    public function postCompleteProfile()
    {
        if (!empty($_POST['cnic'])) {
            if (trim(strlen($_POST['cnic'])) != 15)
                $error[] = "CNIC must be 13 character long";
        } else {
            $error[] = "CNIC is required";
        }
        if (!empty($_POST['date_of_birth'])) {
            if (trim(strlen($_POST['date_of_birth'])) != 10) {
                $error[] = "Invalid Date of Birth";
            }
        } else {
            $error[] = "Date of Birth is required";
        }
        if (empty($_POST['gender'])) {
            $error[] = "Gender is required";
        }
        if (empty($_POST['father_name'])) {
            $error[] = "Father Name is Required";
        }
        if (!empty($_POST['father_phone'])) {
            if (trim(strlen($_POST['father_phone'])) != 12) {
                $error[] = "Father Phone Must be 11 character long";
            }
        } else {
            $error[] = "Father Phone is required";
        }
        if (empty($_POST['address'])) {
            $error[] = "Address is required";
        }
        $response = uploadfile('picture', '../content/student_images', 5);
        if ($response == "invalid_image"){
            $error[] = "Picture is Invalid";
        }else if ($response == "invalid_size"){
            $error[] = "Size must be less then 5 MB";
        }
        if (isset($error)) {
            $_SESSION['errors'] = $error;
            foreach ($_POST as $key => $form_data){
                $_SESSION[$key] = $form_data;
            }
            redirect(app_url() . '/account/complete-profile');
            die;
        }
        // prepare data
        $data = [
            ":cnic" => $_POST['cnic'],
            ":date_of_birth" => $_POST['date_of_birth'],
            ":gender" => $_POST['gender'],
            ":father_name" => $_POST['father_name'],
            ":father_phone" => $_POST['father_phone'],
            ":picture" => $response,
            ":address" => $_POST['address'],
            ":id" => $_SESSION['user_login']
        ];

        $user = new Account();
        if ($user->CompleteProfile($data)) {
            redirectWithMessage(app_url() . '/account/enroll-new-course',
                'Profile Completed, You can enroll into course now',
                'enroll_course');
        } else {
            foreach ($_POST as $key => $form_data){
                $_SESSION[$key] = $form_data;
            }
            redirectWithMessage(app_url() . '/account/complete-profile',
                'Something Wents Wrong, Please try again or contact us',
                'complete_profile', 'error');
        }


    }
}