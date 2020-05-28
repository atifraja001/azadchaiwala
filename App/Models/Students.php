<?php


namespace App\Models;
use PDO;

class Students extends \Core\Model
{
    public function getStudents(){
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM student_login ORDER by id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getStdImage($id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT picture FROM student_login WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $pic = $stmt->fetch();
        return $pic['picture'];
    }
    public function InsertStudent($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO student_login
                            (name, father_name, gender, date_of_birth, cnic, email, address, picture, phone_number) 
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
            $stmt = $db->prepare("UPDATE student_login SET
                                name = :name,
                                father_name = :fname,
                                gender = :gender,
                                date_of_birth = :date_of_birth,
                                cnic = :cnic,
                                email = :email,
                                address = :address,
                                picture = :picture,
                                phone_number = :mobile_number
                                WHERE id = :id");
            if ($stmt->execute($data)) {
                return $data[':id'];
            } else {
                return false;
            }
        }else{
            $stmt = $db->prepare("UPDATE student_login SET
                                name = :name,
                                father_name = :fname,
                                gender = :gender,
                                date_of_birth = :date_of_birth,
                                cnic = :cnic,
                                email = :email,
                                address = :address,
                                phone_number = :mobile_number
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
        $stmt = $db->prepare("SELECT * FROM student_login WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    public function GetStudentEnrollments($std_id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM enrollments WHERE student_id = :student_id ORDER BY id DESC");
        $stmt->execute([':student_id' => $std_id]);
        return $stmt->fetchAll();
    }
    public function deleteStudentsById($id){
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM student_login WHERE id = :id");
        if($stmt->execute(['id' => $id])){
            return true;
        }else{
            return false;
        }
    }
    public function getAvailableStudents(){
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM student_login WHERE id NOT IN (SELECT student_id FROM enrollments)");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getStudentByCNIC($cnic){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM student_login WHERE cnic = :cnic");
        $stmt->execute([':cnic' => $cnic]);
        return $stmt->fetch();
    }
    public function SearchStudent($term){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM student_login 
                            WHERE name LIKE :term
                            OR father_name LIKE :term
                            OR cnic LIKE :term
                            OR email LIKE :term
                            OR phone_number LIKE :term");
        $stmt->execute([':term'=> $term]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function GetStudentImageById($student_id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT picture FROM student_login WHERE id = :id");
        $stmt->execute([':id' => $student_id]);
        return $stmt->fetch();
    }
}
