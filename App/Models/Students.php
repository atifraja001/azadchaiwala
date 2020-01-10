<?php


namespace App\Models;
use PDO;

class Students extends \Core\Model
{
    public function getStudents(){
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM students ORDER by id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getStdImage($id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT picture FROM students WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $pic = $stmt->fetch();
        return $pic['picture'];
    }
    public function InsertStudent($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO students
                            (name, fname, gender, date_of_birth, cnic, email, address, picture, mobile_number) 
                            VALUES 
                            (:name, :fname, :gender, :date_of_birth, :cnic, :email, :address, :picture, :mobile_number)");
        if($stmt->execute($data)){
            return $db->lastInsertId();
        }else{
            return false;
        }
    }
    public function UpdateStudent($data, $image = true){
        $db = static::getDB();
        if($image) {
            $stmt = $db->prepare("UPDATE students SET
                                name = :name,
                                fname = :fname,
                                gender = :gender,
                                date_of_birth = :date_of_birth,
                                cnic = :cnic,
                                email = :email,
                                address = :address,
                                picture = :picture,
                                mobile_number = :mobile_number
                                WHERE id = :id");
            if ($stmt->execute($data)) {
                return $data[':id'];
            } else {
                return false;
            }
        }else{
            $stmt = $db->prepare("UPDATE students SET
                                name = :name,
                                fname = :fname,
                                gender = :gender,
                                date_of_birth = :date_of_birth,
                                cnic = :cnic,
                                email = :email,
                                address = :address,
                                mobile_number = :mobile_number
                                WHERE id = :id");
            if ($stmt->execute($data)) {
                return $data[':id'];
            } else {
                return false;
            }
        }
    }
    public function getStudentsById($id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM students WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    public function deleteStudentsById($id){
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM students WHERE id = :id");
        if($stmt->execute(['id' => $id])){
            return true;
        }else{
            return false;
        }
    }
    public function getAvailableStudents(){
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM students WHERE id NOT IN (SELECT student_id FROM enrollments)");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getStudentByCNIC($cnic){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM students WHERE cnic = :cnic");
        $stmt->execute([':cnic' => $cnic]);
        return $stmt->fetch();
    }
    public function SearchStudent($term){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM students 
                            WHERE name LIKE :term
                            OR fname LIKE :term
                            OR cnic LIKE :term
                            OR email LIKE :term
                            OR mobile_number LIKE :term");
        $stmt->execute([':term'=> $term]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function GetStudentImageById($student_id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT picture FROM students WHERE id = :id");
        $stmt->execute([':id' => $student_id]);
        return $stmt->fetch();
    }
}