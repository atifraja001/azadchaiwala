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
        $user1 = new Account();
        $user = $user1->getUser($_SESSION['user_login']);
        if($user['name'] == ""){
            redirect(app_url().'/account/logout');
        }
        $except = array('complete_profile', 'enroll_course', 'make_payment', 'make_payment_post',
            'postCompleteProfile', 'enroll_new_course', 'getBatches', 'enroll_new_course_post', 'getCoursesByType');
        if (!in_array($request['action'], $except)) {
            $have_enrolled = $user1->have_enrolled($_SESSION['user_login']);
            if (!$have_enrolled) {
                redirectWithMessage(app_url() . "/account/enroll-new-course",
                    "Please select a course to enroll into.",
                    'enroll_new_course',
                    'msg');
            }
        }
    }

    public function dashboard()
    {

        $account = new Account();
        $paid_first = $account->have_paid($_SESSION['user_login']);
        $complete_profile = $account->profile_completed($_SESSION['user_login']);

        // get upcoming erollment
        $enroll = new \App\Models\Enrollments();
        $enroll = $enroll->getUpcomingEnroll($_SESSION['user_login']);
        $course = new \App\Models\Courses();
        $course = $course->getCourseByBatchId($enroll['batch_id']);


        $my_courses = new \App\Models\Courses();
        $my_courses = $my_courses->getCoursesByStdId($_SESSION['user_login']);

        View::render('student/layouts/head.html');
        View::render('student/layouts/navbar.html');
        View::render('student/dashboard.html',
            [
                'paid_first' => $paid_first,
                'complete_profile' => $complete_profile,
                'enroll' => $enroll,
                'course' => $course,
                'my_courses' => $my_courses
            ]);
        View::render('student/layouts/script.html');
    }

    public function complete_profile()
    {
        $user = new \App\Models\Account();
        $user = $user->getUser($_SESSION['user_login']);
        if(!is_null($user['father_name'])){
            redirect(app_url()."/account/edit-profile");
        }
        View::render('student/layouts/head.html');
        View::render('student/layouts/navbar.html');
        View::render('student/complete_profile.html',
            [
                'user' => $user
        ]   );
        View::render('student/layouts/script.html');
    }

    public function postCompleteProfile()
    {
        $user = new \App\Models\Account();
        $user = $user->getUser($_SESSION['user_login']);
        $email = (isset($_POST['email'])) ? $_POST['email'] : $user['email'];
        $name = (isset($_POST['name'])) ? $_POST['name'] : $user['name'];
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
        if (empty($_POST['phone_number'])) {
            $error[] = "Phone number is required";
        }

        $response = "";
        if(!empty($_FILES['picture']['name'])){
            $response = uploadfile('picture', '../content/student_images', 5);
            if ($response == "invalid_image"){
                $error[] = "Picture is Invalid";
            }else if ($response == "invalid_size"){
                $error[] = "Size must be less then 5 MB";
            }
            $data = [
                ":name" => $name,
                ":email" => $email,
                ":cnic" => $_POST['cnic'],
                ":phone_number" => $_POST['phone_number'],
                ":date_of_birth" => date("Y-m-d", strtotime($_POST['date_of_birth'])),
                ":gender" => $_POST['gender'],
                ":father_name" => $_POST['father_name'],
                ":father_phone" => $_POST['father_phone'],
                ":picture" => $response,
                ":address" => $_POST['address'],
                ":id" => $_SESSION['user_login']
            ];
        }else{
            $data = [
                ":name" => $name,
                ":email" => $email,
                ":cnic" => $_POST['cnic'],
                ":phone_number" => $_POST['phone_number'],
                ":date_of_birth" => date("Y-m-d", strtotime($_POST['date_of_birth'])),
                ":gender" => $_POST['gender'],
                ":father_name" => $_POST['father_name'],
                ":father_phone" => $_POST['father_phone'],
                ":address" => $_POST['address'],
                ":id" => $_SESSION['user_login']
            ];
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


        $user = new Account();
        if(empty($response)){
            $query = $user->CompleteProfile($data, false);
        }else{
            $query = $user->CompleteProfile($data, true);
        }
        if ($query) {
            redirectWithMessage(app_url() . '/account/my-profile',
                'Profile Completed.',
                'my_profile');
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
        $init_course = new \App\Models\Enrollments();
        $init_course->initCourse($course_id, $_SESSION['user_login']);
        $batches = new \App\Models\Batches();
        $batches = $batches->GetBatchByCourseId($course_id, $_SESSION['user_login']);
        echo json_encode($batches);
    }

    public function getCoursesByType()
    {
        $classType = $_POST['classType'];
        $courses = new \App\Models\Courses();
        $courses = $courses->getCoursesByType($classType);
        echo json_encode($courses);
    }

    public function enroll_new_course_post()
    {
        $batch_id = $_POST['batch_id'];
        $student_id = $_SESSION['user_login'];
        $course_id = $_POST['course_id'];
        $data = [
            ':batch_id' => $batch_id,
            ':student_id' => $student_id,
            ':course_id' => $course_id
        ];
        $enroll = new \App\Models\Enrollments();
        $enroll_id = $enroll->UpdateEnrollmentsByStudent($data);
        if ($enroll_id === false) {
            redirectWithMessage(app_url() . '/account/my-courses',
                'Already Enrolled into the course', 'my_courses',
                'error');

        }
        $enroll = $enroll->getEnrollById($enroll_id);
        $course = new \App\Models\Courses();
        $course = $course->getCourseByBatchId($enroll['batch_id']);
        $batch = new \App\Models\Batches();
        $batch = $batch->getBatchInfo($enroll['batch_id']);
        $data['course_name'] = $course['course_name'];
        $data['course_type'] = ucfirst($course['type']);
        $data['course_fee'] = number_format($course['fee']);
        $data['fee_in_words'] = getPakCurrency($course['fee']);
        $data['duration'] = $course['duration'];
        $data['batch_name'] = $batch['name'];
        $data['start_date'] = date("d-m-Y", strtotime($batch['start_date']));
        $data['start_time'] = $batch['start_time'];
        $data['enroll_id'] = $enroll['id'];
        echo json_encode($data);
    }
    public function make_payment($request){
        $enroll = new \App\Models\Enrollments();
        $enroll = $enroll->getEnrollById($request['id']);
        if($enroll['student_id'] != $_SESSION['user_login']){
            redirect(app_url().'/account/my-courses');
        }
        if($enroll['status'] != 2){
            if($enroll['status'] != 0 || !empty($enroll['fee_receipt'])) {
                redirect(app_url().'/account/my-courses');
            }
        }
        $course = new \App\Models\Courses();
        $course = $course->getCourseByBatchId($enroll['batch_id']);
        $batch = new \App\Models\Batches();
        $batch = $batch->getBatchInfo($enroll['batch_id']);

        View::render('student/layouts/head.html');
        View::render('student/layouts/navbar.html');
        View::render('student/make_course_payment.html',
            ['enroll' => $enroll, 'course' => $course, 'batch' => $batch]);
        View::render('student/layouts/script.html');
    }
    public function make_payment_post(){
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
            redirect(app_url() . '/account/my-courses/make-payment/'.$_POST['enroll_id']);
            die;
        }
        $enroll = new \App\Models\Enrollments();
        $data = [
            ':fee_receipt' => $response,
            ':id' => $_POST['enroll_id']
        ];
        if($enroll->updateFeeReceipt($data)){
            redirect(app_url() . '/account/dashboard');
        }else{
            $error[] = "Something went's wrong, while uploading file. Try again or contact admin";
            $_SESSION['errors'] = $error;
            redirect(app_url() . '/account/my-courses/make-payment/'.$_POST['enroll_id']);
        }
    }
    public function my_courses(){
        $my_courses = new \App\Models\Courses();
        $my_courses = $my_courses->getCoursesByStdId($_SESSION['user_login']);
        View::render('student/layouts/head.html');
        View::render('student/layouts/navbar.html');
        View::render('student/my_courses.html', ['my_courses' => $my_courses]);
        View::render('student/layouts/script.html');
    }
    public function my_profile(){
        $user = new \App\Models\Account();
        $user = $user->getUser($_SESSION['user_login']);
        if(is_null($user['father_name'])){
            redirect(app_url()."/account/complete-profile");
        }
        View::render('student/layouts/head.html');
        View::render('student/layouts/navbar.html');
        View::render('student/my_profile.html', ['user' => $user]);
        View::render('student/layouts/script.html');
    }
    public function change_password(){
        View::render('student/layouts/head.html');
        View::render('student/layouts/navbar.html');
        View::render('student/change_password.html');
        View::render('student/layouts/script.html');
    }
    public function change_password_post(){
        $account = new \App\Models\Account();
        $user = $account->getUser($_SESSION['user_login']);
        if(strlen($_POST['new_password']) >= 8){
            if($_POST['new_password'] == $_POST['confirm_new_password']){
                if(password_verify($_POST['old_password'], $user['password'])){
                    $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                    $account->ChangePassword($password, $user['id']);
                    redirectWithMessage(app_url().'/account/change-password', 'Password Changed', 'change_password');
                }else{
                    $error_msg = "Invalid Old Password";
                }
            }else{
                $error_msg = '<strong>New Password</strong> and <strong>Confirm Password</strong> doesn\'t matched';
            }
        }else{
            $error_msg = "New Password must be 8 character long";
        }
        redirectWithMessage(app_url().'/account/change-password', $error_msg, 'change_password', 'error');
    }
    public function edit_profile(){
        $user = new \App\Models\Account();
        $user = $user->getUser($_SESSION['user_login']);
        if(is_null($user['father_name'])){
            redirect(app_url()."/account/complete-profile");
        }
        View::render('student/layouts/head.html');
        View::render('student/layouts/navbar.html');
        View::render('student/edit_profile.html', ['user' => $user]);
        View::render('student/layouts/script.html');
    }
}