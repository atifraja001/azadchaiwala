<?php


namespace App\Models;

use PDO;

class Leads extends \Core\Model
{
    public function AddLead($name, $email, $message, $lead_type, $lead_name)
    {
        $db = static::getDB();
        $q = $db->prepare("INSERT INTO leads (name, email, message, lead_type, lead_name) 
                                VALUES (:name, :email, :message, :lead_type, :lead_name)");
        $q->execute([
            ':name' => $name,
            ':email' => $email,
            ':message' => $message,
            ':lead_type' => $lead_type,
            ':lead_name' => $lead_name
        ]);
        return true;
    }
}