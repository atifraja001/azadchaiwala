<?php


namespace App\Models;
use PDO;

class Teachers extends \Core\Model
{
    public function getTeachers()
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM teachers ORDER by id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTeacherImage($id)
    {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT picture FROM teachers WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $pic = $stmt->fetch();
        return $pic['picture'];
    }
    public function InsertTeacher($data)
    {
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO teachers
                            (name, fname, gender, date_of_birth, cnic, email, address, picture, mobile_number, about) 
                            VALUES 
                            (:name, :fname, :gender, :date_of_birth, :cnic, :email, :address, :picture, :mobile_number, :about)");
        if ($stmt->execute($data)) {
            return $db->lastInsertId();
        } else {
            return false;
        }
    }
    public function getTeachersById($id)
    {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM teachers WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    public function UpdateStudent($data, $image = true)
    {
        $db = static::getDB();
        if ($image) {
            $stmt = $db->prepare("UPDATE teachers SET
                                name = :name,
                                fname = :fname,
                                gender = :gender,
                                date_of_birth = :date_of_birth,
                                cnic = :cnic,
                                email = :email,
                                address = :address,
                                picture = :picture,
                                about = :about,
                                mobile_number = :mobile_number
                                WHERE id = :id");
            if ($stmt->execute($data)) {
                return $data[':id'];
            } else {
                return false;
            }
        } else {
            $stmt = $db->prepare("UPDATE teachers SET
                                name = :name,
                                fname = :fname,
                                gender = :gender,
                                date_of_birth = :date_of_birth,
                                cnic = :cnic,
                                email = :email,
                                address = :address,
                                about = :about,
                                mobile_number = :mobile_number
                                WHERE id = :id");
            if ($stmt->execute($data)) {
                return $data[':id'];
            } else {
                return false;
            }
        }
    }
    public function deleteTeacherById($id){
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM teachers WHERE id = :id");
        if($stmt->execute(['id' => $id])){
            return true;
        }else{
            return false;
        }
    }
    public function GetTeacherImageById($teacher_id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT picture FROM teachers WHERE id = :id");
        $stmt->execute([':id'=>$teacher_id]);
        return $stmt->fetch();
    }
}