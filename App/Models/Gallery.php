<?php


namespace App\Models;
use PDO;

class Gallery extends \Core\Model
{
    public function getGallery(){
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM gallery");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getClass(){
        $db = static::getDB();
        $stmt = $db->query("SELECT DISTINCT(class) FROM gallery");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //    delete the faqs
    public function DeleteGalleryContent($id){
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM gallery WHERE id = :id");
        if($stmt->execute([':id' => $id])){
            return true;
        }else{
            return false;
        }
    }

    public function InsertGallery($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO gallery 
                                (image, class)
                                VALUES 
                                (:gallery_picture, :class)");
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }

    public function GetGalleryImageById($gallery_id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT image FROM gallery WHERE id = :id");
        $stmt->execute([':id'=>$gallery_id]);
        return $stmt->fetch();
    }
}