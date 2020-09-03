<?php


namespace App\Models;
use PDO;

class Feedbacks extends \Core\Model
{
    public function getFeedbacks(){
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM feedback_messages ORDER By id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //    delete the faqs
    public function DeleteFeedbackContent($id){
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM feedback_messages WHERE id = :id");
        if($stmt->execute([':id' => $id])){
            return true;
        }else{
            return false;
        }
    }

    // public function InsertExpense
    public function InsertFeedback($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO feedback_messages
                (course_id, name, email, feedback_text)
                VALUES
                (:course_id, :name, :email, :feedback_text)");
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }

    public function getFeedback($id){
        $db = static::getDB();
        $q = $db->prepare("SELECT * FROM feedback_messages WHERE id = :id");
        $q->execute([':id' => $id]);
        return $q->fetch();
    }
}