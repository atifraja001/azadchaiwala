<?php


namespace App\Models;

use PDO;

class Account extends \Core\Model
{
    public function CreateAccount($data)
    {
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO user_login (name, email, password, email_token, phone_number) 
                                VALUES (:name, :email, :password, :email_token, :phone_number)");
        ($stmt->execute($data)) ? true : false;
    }
}