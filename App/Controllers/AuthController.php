<?php


namespace App\Controllers;

use App\Models\Account;
use Core\View;

class AuthController
{
    public function __construct()
    {
    }

    public function index()
    {
        View::render('frontend/layouts/head.html', ['title' => 'My Account']);
        View::render('frontend/layouts/navbar.html');
        View::render('frontend/auth/account.html');
        View::render('frontend/layouts/script.html');
    }

    public function doLogin($request, $email = "", $password = "")
    {
        if(empty($email) && empty($password)){
            $email = $_POST['email'];
            $password = $_POST['password'];
        }
        $account = new Account();
        $response = $account->doLogin($email, $password);
        if($response == 1){ // success
            $user = $account->getUser($email);
            $_SESSION['user_login'] = $user['id'];
            redirect(app_url().'/account/dashboard');
        }else if($response == 2){ // invalid email or password
            $msg = "Invalid Email or Password!";
        }else if($response == 3){ // no account associated with this email
            $msg = "Account Not Found!";
        }else if($response == 0){ // pending verification
            $msg = "You email is not verified. We just sent you another email for verification. Check your MailBox";
            $user = $account->getUser($email);
            $email = new EmailController();
            $email->sendEmail('create_account', [
                'email_to' => $user['email'],
                'name' => $user['name'],
                'token' => $user['email_token']
            ]);
        }else{ // Something went's wrong
            $msg = "Something Want's Wrong! Login Again or Contact us";
        }
        redirectWithMessage(app_url().'/account', $msg, 'login', 'error');
    }

    public function showRegistrationForm()
    {
        View::render('frontend/layouts/head.html', ['title' => 'My Account']);
        View::render('frontend/layouts/navbar.html');
        View::render('frontend/auth/register.html');
        View::render('frontend/layouts/script.html');
    }

    public function doRegister()
    {
        // preparing data
        $data = [
            ':name' => $_POST['full_name'],
            ':email' => $_POST['email'],
            ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            ':phone_number' => $_POST['phone_number'],
            ':email_token' => random_str(64, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'),
            ':token_requested_at' => date('Y-m-d H:i:s')
        ];
        $register = new Account();
        if ($register->CheckEmail($_POST['email'])) {
            if ($_POST['type'] == "html") {
                echo "Email Already Exists, Please Login";
                die;
            } else {
                redirectWithMessage(app_url('') . '/create-account', "Account with this email already exists, Please <a href='" . app_url() . "/account'>login</a> to your account.", 'register', 'error');
            }
        }
        $register->CreateAccount($data);
        $email = new EmailController();
                $email->sendEmail('create_account', [
                    'email_to' => $data[':email'],
                    'name' => $data[':name'],
                    'token' => $data[':email_token']
                ]);
        if ($_POST['type'] == "html") {
            echo "A Verification email has been sent to your email address. Please click the link inside the email to proceed.";
        } else {
            //redirect(app_url('').'/create-account/success');
        }
    }

    public function ShowSuccessPage()
    {
        View::render('frontend/layouts/head.html', ['title' => 'My Account']);
        View::render('frontend/layouts/navbar.html');
        View::render('frontend/auth/success.html');
        View::render('frontend/layouts/script.html');
    }

    public function VerifyEmail($request)
    {
        if (!empty($request['slug'])) {
            $register = new Account();
            $response = $register->VerifyEmail($request['slug']);
            if ($response == "email_already_verified") {
                redirectWithMessage(app_url() . '/account', 'Your email is already verified or link is expired. Please login to proceed', 'login');
            } else {
                $user = $register->getUser($response);
                $this->doLogin("", $user['email']);
            }
        }
    }

    public function doLogout()
    {
        session_destroy();
        redirect(app_url() . "/account");
    }
}