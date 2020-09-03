<?php


namespace App\Models;
use PDO;

class ContactMessage extends \Core\Model
{
    public function getContact(){
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM contact_messages ORDER By id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function DeletemessageContent($id){
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM contact_messages WHERE id = :id");
        if($stmt->execute([':id' => $id])){
            return true;
        }else{
            return false;
        }
    }

    // public function InsertContactMessage
    public function InsertContact($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO contact_messages
                (name, email, subject, message_text)
                VALUES
                (:name, :email, :subject, :message_text)");
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }
    public function getContactMessage($id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM contact_messages WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return true;
    }
    public function MoveToArchive($id){
        $db = static::getDB();
        $stmt = $db->prepare("UPDATE contact_messages SET status = 1 WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return true;
    }

}