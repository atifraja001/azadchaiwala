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

    public function AddNonPayingLeads($data)
    {
        $db = static::getDB();
        $q = $db->prepare("INSERT INTO leads (name, email, message, lead_type, lead_name) 
                                VALUES (:name, :email, :message, :lead_type, :lead_name)");
        foreach ($data as $d) {
            $q1 = $db->prepare("SELECT * FROM leads WHERE email = :email AND lead_type = :lead_type AND lead_name = :lead_name");
            $q1->execute([
                ':email' => $d[':email'],
                ':lead_type' => $d[':lead_type'],
                ':lead_name' => $d[':lead_name']
            ]);
            if ($q1->rowCount() == 0) {
                $q->execute($d);
            }
        }
    }

    public function AddPayingLeads($data)
    {
        $db = static::getDB();
        foreach ($data as $d) {
            $q = $db->prepare("SELECT * FROM leads WHERE email = :email AND lead_name = :lead_name");
            $q->execute([':email' => $d[':email'], ':lead_name' => $d[':lead_name']]);
            if($q->rowCount() != 0){
                $q = $db->prepare("DELETE FROM leads WHERE email = :email AND lead_name = :lead_name");
                $q->execute([':email' => $d[':email'], ':lead_name' => $d[':lead_name']]);
            }
        }
        $q = $db->prepare("INSERT INTO leads (name, email, message, lead_type, lead_name) 
                                VALUES (:name, :email, :message, :lead_type, :lead_name)");
        foreach ($data as $d) {
            $q1 = $db->prepare("SELECT * FROM leads WHERE email = :email AND lead_type = :lead_type AND lead_name = :lead_name");
            $q1->execute([
                ':email' => $d[':email'],
                ':lead_type' => $d[':lead_type'],
                ':lead_name' => $d[':lead_name']
            ]);
            if ($q1->rowCount() == 0) {
                $q->execute($d);
            }
        }
    }
    public function getLeads($type, $name){
        $db = static::getDB();
        $q = $db->prepare("SELECT * FROM leads WHERE lead_type = :lead_type AND lead_name = :lead_name");
        $q->execute([':lead_type' => $type, ':lead_name' => $name]);
        return $q->fetchAll();
    }
}