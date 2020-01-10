<?php


namespace App\Models;

use PDO;
class Reviews extends \Core\Model
{
    public function getReviews(){
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM reviews ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function add_new_review($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO reviews
                            (person_name, person_image, description)
                            VALUES
                            (:person_name, :person_image, :description)");
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }
    public function delete_review($data){
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM reviews WHERE id = :id");
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }
    public function update_review($data, $type){
        $db = static::getDB();
        if($type){
            $stmt = $db->prepare("UPDATE reviews SET
                                person_name = :person_name,
                                person_image = :person_image,
                                description = :description
                                WHERE id = :id");
        }else{
            $stmt = $db->prepare("UPDATE reviews SET
                                person_name = :person_name,
                                description = :description
                                WHERE id = :id");
        }
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }
    public function GetReviewImageById($review_id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT person_image FROM reviews WHERE id = :id");
        $stmt->execute([':id' => $review_id]);
        return $stmt->fetch();
    }
}