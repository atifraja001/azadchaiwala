<?php


namespace App\Controllers;
use Core\View;

class AdminController
{
    public function __construct()
    {
        Auth('admin');
    }

    public function index(){
        $student = new \App\Models\Students();
        $std = $student->getStudents();
        // get teacher
        $teacher = new \App\Models\Teachers();
        $teach = $teacher->getTeachers();

        $course = new \App\Models\Courses();
        $course = $course->getCourses();

        $all = new \App\Models\Enrollments();
        $all = $all->getallEnrollAndBatchAvaliable();

        $enrollments = new \App\Models\Enrollments();
        $approved = $enrollments->getApprovedEnrollAndBatchAvaliable();
        $enrollments = new \App\Models\Enrollments();
        $pending = $enrollments->getPendingEnrollAndBatchAvaliable();

        $user = new \App\Models\User();
        $usr = $user->getAllUser();

        $faq = new \App\Models\Faqs();
        $faqs = $faq->getFaqs();

        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['dashboard'=>'active']);
        View::render('backend/dashboard.html', [
            'std'=>$std, 'teach'=>$teach, 'course'=>$course, 'approved'=>$approved, 'pending'=>$pending,
            'usr'=>$usr, 'faqs'=>$faqs, 'all'=>$all
            ]
        );
        View::render('backend/layouts/script.html');
    }
    public function change_password(){
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['change_password'=>'active']);
        View::render('backend/change_password.html');
        View::render('backend/layouts/script.html');
    }
    public function change_password_post(){
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['c_new_password'];
        if($new_password == $confirm_password){
            if(strlen($new_password) >= 8) {
                $user = new \App\Models\User();
                $user = $user->getUser($_SESSION['admin_login']);
                if (password_verify($old_password, $user['password'])) {
                    $data = [
                        ':password' => password_hash($new_password, PASSWORD_DEFAULT),
                        ':id' => $_SESSION['admin_login']
                    ];
                    $user = new \App\Models\User();
                    $user = $user->change_password($data);
                    if($user){
                        redirectWithMessage(app_url('admin') . '/change-password', 'Password Changed. you have to login with new password next time.', 'password');
                    }else{
                        redirectWithMessage(app_url('admin') . '/change-password', 'Something Went\'s Wrong. Please Try Again Later', 'password', 'error');
                    }
                } else {
                    redirectWithMessage(app_url('admin') . '/change-password', 'Invalid old Password', 'password', 'error');
                }
            }else{
                redirectWithMessage(app_url('admin') . '/change-password', 'Password Length must be greater then 8', 'password', 'error');
            }
        }else {
            redirectWithMessage(app_url('admin').'/change-password', 'New Password doesn\'t matched', 'password', 'error');
        }
    }
    public function manage_user(){
        $users = new \App\Models\User();
        $users = $users->getUsers($_SESSION['admin_login']);
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['users'=>'active']);
        View::render('backend/manage_user.html', [
            'users' => $users
        ]);
        View::render('backend/layouts/script.html');
    }
    public function manage_user_post(){
        if(strlen($_POST['password']) >= 8) {
            $data = [
                ':username' => clean_post('username'),
                ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                ':role' => 'user'
            ];
            $user = new \App\Models\User();
            $check_username = $user->checkUsername($data[':username']);
            if($check_username){
                redirectWithMessage(app_url('admin') . '/user-management', 'Username Already Exists', 'user', 'error');
            }else{
                $user = $user->InsertUser($data);
                if($user){
                    redirectWithMessage(app_url('admin') . '/user-management', 'New user Added Successfully', 'user');
                }else{
                    redirectWithMessage(app_url('admin') . '/user-management', 'Something Went\'s Wrong. Please Try Again Later', 'user', 'error');
                }
            }
        }else{
            redirectWithMessage(app_url('admin') . '/user-management', 'Password Length must be greater then 8', 'user', 'error');
        }
    }
    public function delete_user($request){
        $user = new \App\Models\User();
        $user = $user->deleteUser($request['id']);
        if($user){
            redirectWithMessage(app_url('admin').'/user-management', 'User Deleted Successfully', 'user');
        }else{
            redirectWithMessage(app_url('admin').'/user-management', 'User Deleted Successfully', 'user', 'error');
        }
    }
}