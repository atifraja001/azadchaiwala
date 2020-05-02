<?php


namespace App\Models;

use PDO;

class Account extends \Core\Model
{
    public function CreateAccount($data)
    {
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO student_login (name, email, password, email_token, phone_number, token_requested_at) 
                                VALUES (:name, :email, :password, :email_token, :phone_number, :token_requested_at)");
        ($stmt->execute($data)) ? true : false;
    }

    public function CheckEmail($email)
    {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM student_login WHERE email = :email");
        $stmt->execute([':email' => $email]);
        if ($stmt->rowCount() > 0)
            return true;
        return false;
    }

    public function VerifyEmail($token)
    {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM student_login WHERE email_token = :email_token");
        $stmt->execute([
            ':email_token' => $token
        ]);
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch();
            $date = date('Y-m-d H:i:s');
            $stmt = $db->prepare("UPDATE student_login SET 
                                    email_token = null, 
                                    email_verified_at = :date, 
                                    token_requested_at = null 
                                    WHERE 
                                    email_token = :email_token");
            $stmt->execute([
                ':date' => $date,
                ':email_token' => $token
            ]);
            return $user['id'];
        } else {
            return "email_already_verified";
        }
    }

    public function doLogin($email, $password)
    {
        $db = static::getDB();
        $q = $db->prepare("SELECT * FROM student_login WHERE email = :email");
        $q->execute([
            ':email' => $email
        ]);
        if ($q->rowCount() == 1) {
            $user = $q->fetch();
            if (is_null($user['email_verified_at'])) {
                return 0;
            } else {
                if(empty($password)){
                    return 1;
                }else{
                    if (password_verify($password, $user['password'])) {
                        return 1;
                    }else{
                        return 2;
                    }
                }
            }
        } else {
            return 3;
        }
    }
    public function getUser($email_or_id){
        $db = static::getDB();
        if(is_numeric($email_or_id)){
            $id = $email_or_id;
            $q = $db->prepare("SELECT * FROM student_login WHERE id = :id");
            $q->execute([
                ':id' => $id
            ]);
        }else{
            $email = $email_or_id;
            $q = $db->prepare("SELECT * FROM student_login WHERE email = :email");
            $q->execute([
                ':email' => $email
            ]);
        }
        return $q->fetch();
    }
    public function CompleteProfile($data){
        $db = static::getDB();
        $q = $db->prepare('UPDATE student_login SET
            cnic = :cnic,
            date_of_birth = :date_of_birth,
            gender = :gender,
            father_name = :father_name,
            father_phone = :father_phone,
            picture = :picture,
            address = :address WHERE id = :id');
        if($q->execute($data)){
            return true;
        }else{
            return false;
        }
    }
    public function have_enrolled($user_id){
        $db = static::getDB();
        $q = $db->prepare("SELECT * FROM enrollments WHERE id = :id");
        $q->execute([':id' => $user_id]);
        if($q->rowCount() > 0){
            return true;
        }
        return false;
    }
}