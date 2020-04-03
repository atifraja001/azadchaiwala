<?php


namespace App\Controllers;
use Core\View;

class AuthController
{
    public function __construct()
    {

    }
    public function index(){
        View::render('frontend/layouts/head.html', ['title' => 'My Account']);
        View::render('frontend/layouts/navbar.html');
        View::render('frontend/auth/account.html');
        View::render('frontend/layouts/script.html');
    }
    public function doLogin(){

    }
    public function showRegistrationForm(){
        View::render('frontend/layouts/head.html', ['title' => 'My Account']);
        View::render('frontend/layouts/navbar.html');
        View::render('frontend/auth/register.html');
        View::render('frontend/layouts/script.html');
    }
    public function doRegister(){
        // preparing data
        $data = [
            ':name' => $_POST['full_name'],
            ':email' => $_POST['email'],
            ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            ':phone_number' => $_POST['phone_number'],
            ':email_token' => random_str()
        ];
        $register = new \App\Models\Account();
        $register->CreateAccount($data);
        $email = new \App\Controllers\EmailController();
        $email->sendEmail('create_account', [
            'email_to' => $data[':email'],
            'name' => $data[':name'],
            'token' => $data[':token']
        ]);
        redirect(app_url('').'/create-account/success');
    }
    public function ShowSuccessPage(){
        View::render('frontend/layouts/head.html', ['title' => 'My Account']);
        View::render('frontend/layouts/navbar.html');
        View::render('frontend/auth/success.html');
        View::render('frontend/layouts/script.html');
    }
}