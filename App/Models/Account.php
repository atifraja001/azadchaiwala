<?php


namespace App\Models;

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
                    $this->touchLogin($email);
                    return 1;
                }else{
                    if (password_verify($password, $user['password'])) {
                        $this->touchLogin($email);
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
    public function touchLogin($email){
        $db = static::getDB();
        $q = $db->prepare("UPDATE student_login SET last_login = CURRENT_TIMESTAMP() WHERE email = :email");
        $q->execute([
            ':email' => $email
        ]);
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
    public function CompleteProfile($data, $picture){
        $db = static::getDB();
        if($picture){
            $q = $db->prepare('UPDATE student_login SET
                name = :name,
                email = :email,
                cnic = :cnic,
                phone_number = :phone_number,
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
        }else{
            $q = $db->prepare('UPDATE student_login SET
                name = :name,
                email = :email,
                cnic = :cnic,
                date_of_birth = :date_of_birth,
                phone_number = :phone_number,
                gender = :gender,
                father_name = :father_name,
                father_phone = :father_phone,
                address = :address WHERE id = :id');
            if($q->execute($data)){
                return true;
            }else{
                return false;
            }
        }
    }
    public function have_enrolled($user_id){
        $db = static::getDB();
        $q = $db->prepare("SELECT * FROM enrollments WHERE student_id = :id AND batch_id IS NOT NULL");
        $q->execute([':id' => $user_id]);
        if($q->rowCount() > 0){
            return true;
        }
        return false;
    }
    public function have_paid($user_id){
        $db = static::getDB();
        $q = $db->prepare("SELECT * FROM enrollments WHERE student_id = :id AND fee_receipt IS NOT NULL");
        $q->execute([':id' => $user_id]);
        if($q->rowCount() > 0){
            return true;
        }
        return false;
    }
    public function profile_completed($user_id){
        $db = static::getDB();
        $q = $db->prepare("SELECT * FROM student_login WHERE id = :id AND father_name IS NOT NULL");
        $q->execute([':id' => $user_id]);
        if($q->rowCount() > 0){
            return true;
        }
        return false;
    }
    public function ChangePassword($password, $user_id){
        $db = static::getDB();
        $q = $db->prepare("UPDATE student_login SET password = :password WHERE id = :id");
        if ($q->execute([
            ':password' => $password,
            ':id' => $user_id
        ])) {
            return true;
        }
        return false;
    }

    public function RecoverPassword($data)
    {
        $db = static::getDB();
        $q = $db->prepare("UPDATE student_login SET email_token = :email_token, 
                                    token_requested_at = :token_requested_at WHERE email = :email");
        if ($q->execute($data)) {
            return true;
        }
        return false;
    }

    public function CheckRecoverToken($email, $token)
    {
        $db = static::getDB();
        $q = $db->prepare("SELECT * FROM student_login WHERE email = :email AND email_token = :token");
        $q->execute([
            ":email" => $email,
            ":token" => $token
        ]);
        if ($q->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function ResetPassword($email, $password)
    {
        $db = static::getDB();
        $q = $db->prepare("UPDATE student_login SET password = :password, email_token = NULL, token_requested_at = NULL WHERE email = :email");
        if ($q->execute([
            ":email" => $email,
            ":password" => password_hash($password, PASSWORD_DEFAULT)
        ])) {
            return true;
        }
        return false;
    }

    public function checkPin($pin)
    {
        $db = static::getDB();
        $q = $db->prepare("SELECT * FROM student_login WHERE email_token = :pin");
        $q->execute([':pin' => $pin]);
        return $q->rowCount();
    }
    public function MailingList($user_id, $course_id, $type){
        $db = static::getDB();
        if($type == 1){
            echo $type;
            $q = $db->prepare("INSERT INTO upcoming_batch_mailing_list (course_id, student_id) VALUES (:course_id, :student_id)");
            $q->execute([':student_id' => $user_id, ':course_id' => $course_id]);
        }else if ($type == 0){
            $q = $db->prepare("DELETE FROM upcoming_batch_mailing_list WHERE course_id = :course_id AND student_id = :student_id");
            $q->execute([':student_id' => $user_id, ':course_id' => $course_id]);
        }
    }
    public function CheckMailingList($course_id){
        $db = static::getDB();
        $student_id = $_SESSION['user_login'];
        $q = $db->prepare("SELECT * FROM upcoming_batch_mailing_list WHERE course_id = :course_id AND student_id = :student_id");
        $q->execute([':student_id' => $student_id, ':course_id' => $course_id]);
        return $q->rowCount();
    }
}