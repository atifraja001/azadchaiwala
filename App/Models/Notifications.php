<?php


namespace App\Models;
use PDO;

class Notifications extends \Core\Model
{
    public function getNotification(){
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM notification ORDER BY id DESC LIMIT 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function delete_notification($id){
        $db = static::getDB();
        $stmt = $db->prepare("UPDATE notification SET
                message='' Where id=:id");
        if($stmt->execute([':id' => $id])){
            return true;
        }else{
            return false;
        }
    }

    //  InsertNotification
    public function edit_notification($data){
        $db = static::getDB();
        $stmt = $db->prepare("UPDATE notification SET
                message=:message Where id=1");
        if ($stmt->execute($data)) {
            return true;
        } else {
            return false;
        }

    }

}