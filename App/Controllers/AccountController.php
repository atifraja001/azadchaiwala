<?php


namespace App\Controllers;

use App\Models\Account;
use Core\View;
use http\Params;

class AccountController
{
    public function __construct($request)
    {
        // Auth middleware
        Auth('student');
        // profile complete and enroll course middleware
        $user1 = new Account();
        $user = $user1->getUser($_SESSION['user_login']);
        $except = array('complete_profile', 'enroll_course', 'make_payment', 'make_payment_post',
            'postCompleteProfile', 'enroll_new_course', 'getBatches', 'enroll_new_course_post');
        if (!in_array($request['action'], $except)) {
            $have_enrolled = $user1->have_enrolled($_SESSION['user_login']);
            if (!$have_enrolled) {
                redirectWithMessage(app_url() . "/account/enroll-new-course",
                    "Please select a course to enroll into.",
                    'complete_profile',
                    'msg');
            }
        }
    }

    public function dashboard()
    {
        View::render('student/layouts/head.html');
        View::render('student/layouts/navbar.html');
        View::render('student/dashboard.html');
        View::render('student/layouts/script.html');
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
            ":date_of_birth" => date("Y-m-d", strtotime($_POST['date_of_birth'])),
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
            foreach ($_POST as $key => $form_data) {
                $_SESSION[$key] = $form_data;
            }
            redirectWithMessage(app_url() . '/account/complete-profile',
                'Something Wents Wrong, Please try again or contact us',
                'complete_profile', 'error');
        }
    }

    public function enroll_new_course()
    {
        View::render('student/layouts/head.html');
        View::render('student/layouts/navbar.html');
        $course = new \App\Models\Courses();
        $courses = $course->getCourses();
        View::render('student/enroll_new_course.html', ['courses' => $courses]);
        View::render('student/layouts/script.html');
    }

    public function getBatches()
    {
        $course_id = $_POST['course_id'];
        $batches = new \App\Models\Batches();
        $batches = $batches->GetBatchByCourseId($course_id);
        echo json_encode($batches);
    }

    public function enroll_new_course_post()
    {
        $batch_id = $_POST['batch'];
        $student_id = $_SESSION['user_login'];
        $data = [
            ':batch_id' => $batch_id,
            ':student_id' => $student_id,
            ':fee_receipt' => "",
            ':status' => 0
        ];
        $enroll = new \App\Models\Enrollments();
        $enroll = $enroll->InsertEnrollmentsByStudent($data);
        redirect(app_url() . "/account/manage-enroll/make-payment/" . $enroll);
    }
    public function make_payment($request){
        View::render('student/layouts/head.html');
        View::render('student/layouts/navbar.html');
        $enroll = new \App\Models\Enrollments();
        $enroll = $enroll->getEnrollById($request['id']);
        if($enroll['status'] != 0 || !empty($enroll['fee_receipt'])) {
            redirect(app_url().'/account/manage-enroll/');
        }
        $course = new \App\Models\Courses();
        $course = $course->getCourseByBatchId($enroll['batch_id']);
        $batch = new \App\Models\Batches();
        $batch = $batch->getBatchInfo($enroll['batch_id']);
        View::render('student/make_course_payment.html',
            ['enroll' => $enroll, 'course' => $course, 'batch' => $batch]);
        View::render('student/layouts/script.html');
    }
    public function make_payment_post(){
        if(!file_exists('../content')){
            mkdir("../content", 0750, true);
        }
        if(!file_exists('../content/receipt_images')){
            mkdir("../content/receipt_images", 0750, true);
        }
        $response = uploadfile('fee_receipt', '../content/receipt_images', 5);
        if ($response == "invalid_image"){
            $error[] = "Picture is Invalid";
        }else if ($response == "invalid_size"){
            $error[] = "Size must be less then 5 MB";
        }else if($response == "not_uploaded"){
            $error[] = "Something went's wrong, while uploading file. Try again or contact admin";
        }
        if (isset($error)) {
            $_SESSION['errors'] = $error;
            redirect(app_url() . '/account/manage-enroll/make-payment/'.$_POST['enroll_id']);
            die;
        }
        $enroll = new \App\Models\Enrollments();
        $data = [
            ':fee_receipt' => $response,
            ':id' => $_POST['enroll_id']
        ];
        if($enroll->updateFeeReceipt($data)){
            redirect(app_url() . '/account/manage-enroll');
        }else{
            $error[] = "Something went's wrong, while uploading file. Try again or contact admin";
            $_SESSION['errors'] = $error;
            redirect(app_url() . '/account/manage-enroll/make-payment/'.$_POST['enroll_id']);
        }

    }
}