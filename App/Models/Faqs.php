<?php


namespace App\Models;
use PDO;

class Faqs extends \Core\Model
{
    public function getFaqs(){
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM faqs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //    delete the faqs
    public function DeleteFaqsContent($id){
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM faqs WHERE id = :id");
        if($stmt->execute([':id' => $id])){
            return true;
        }else{
            return false;
        }
    }

    // public function InsertExpense
    public function InsertFaqs($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO faqs
                (title, description)
                VALUES
                (:title, :description)");
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }

    public function update_faqs($data){
        $db = static::getDB();

            $stmt = $db->prepare("UPDATE faqs SET
                                title = :title,
                                description = :description
                                WHERE id = :id");
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }

}