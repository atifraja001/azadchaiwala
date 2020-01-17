<?php


namespace App\Controllers;
use App\Models\User;
use Core\View;

class LoginController
{
    public function show(){
        // show login form
        return View::render('backend/login.html');
    }
    public function post(){
        // accept parameters and do login
        $username = clean_post('username');
        $password = $_POST['password'];
        $user = new User();
        $result = $user->doLogin($username, $password);
        if($result){
            redirect(app_url('admin').'/dashboard');
        }else{
            redirectWithMessage('./login', 'Invalid Login Details', 'login', 'error');
        }
    }
    public function logout(){
        session_destroy();
        session_start();
        redirectWithMessage('./login', 'Thank you for stopping by', 'login');
    }
}