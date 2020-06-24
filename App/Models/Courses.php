<?php


namespace App\Models;
use PDO;

class Courses extends \Core\Model
{
    public function getCourses(){
        $db = static::getDB();
        $stmt = $db->query("SELECT courses.*, teachers.name FROM courses JOIN teachers ON teachers.id =  courses.teacher_id ORDER BY courses.order_number ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCoursesByBatch(){
        $db = static::getDB();
        $stmt = $db->query("SELECT courses.*, batches.start_date FROM courses JOIN batches ON courses.id =  batches.course_id ORDER BY courses.order_number ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCourseImageById($course_id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT course_picture FROM courses WHERE id = :id");
        $stmt->execute([':id' => $course_id]);
        return $stmt->fetch();
    }
    public function getCourseById($id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT courses.*, teachers.name FROM courses JOIN teachers ON teachers.id =  courses.teacher_id WHERE courses.id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    public function getCourseByBatchId($batch_id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM courses WHERE id = (SELECT course_id FROM batches WHERE id = :batch_id)");
        $stmt->execute([':batch_id' => $batch_id]);
        return $stmt->fetch();
    }
    public function getCourse($id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM courses WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    public function getCourseBySlug($slug){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * From courses WHERE slug = :slug");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }
    public function getCoursesByType($classType){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM courses WHERE type = :type AND id IN 
                                    (SELECT course_id FROM batches WHERE start_date >= CURRENT_DATE())");
        $stmt->execute([':type' => $classType]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCourseContent($course_id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM course_content WHERE course_id = :course_id ORDER BY position ASC");
        $stmt->execute([":course_id" => $course_id]);
        return $stmt->fetchAll();
    }
    public function InsertCourseContent($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO course_content 
                                (course_id, content_title, duration, content_description, position)
                                VALUES
                                (:course_id, :content_title, :duration, :content_description, :position)");
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }
    public function UpdateCourseContent($data){
        $db = static::getDB();
        $stmt = $db->prepare("UPDATE course_content SET
                            course_id = :course_id,
                            content_title = :content_title,
                            duration = :duration,
                            content_description = :content_description,
                            position = :position
                            WHERE id = :id");
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }
    public function DeleteCourseContent($id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT course_id FROM course_content WHERE id = :id");
        $stmt->execute([":id"=>$id]);
        $course = $stmt->fetch();
        $course_id = $course['course_id'];
        $stmt = $db->prepare("DELETE FROM course_content WHERE id = :id");
        $stmt->execute([":id"=>$id]);
        return $course_id;
    }
    public function getCourseTC($course_id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM course_tc WHERE course_id = :course_id");
        $stmt->execute([':course_id'=>$course_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function InsertCourseTC($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO course_tc
                                (course_id, detail)
                                VALUES
                                (:course_id, :detail)");
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }
    public function DeleteCourseTC($id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT course_id FROM course_tc WHERE id = :id");
        $stmt->execute([":id"=>$id]);
        $course = $stmt->fetch();
        $course_id = $course['course_id'];
        $stmt = $db->prepare("DELETE FROM course_tc WHERE id = :id");
        $stmt->execute([":id"=>$id]);
        return $course_id;
    }
    public function InsertNewCourse($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO courses 
                (order_number, teacher_id, course_name, slug, course_picture, 
                youtube_embed, lecture_hours_per_day, duration, semester, fee, course_description, type)
                VALUES
                (:order_number, :teacher_id, :course_name, :slug, :course_picture, 
                :youtube_embed, :lecture_hours_per_day, :duration, :semester, :fee, :course_description, :type)");
        if($stmt->execute($data)){
            return $db->lastInsertId();
        }else{
            return false;
        }
    }
    public function EditCourse($data, $type){
        if($type){
            $db = static::getDB();
            $stmt = $db->prepare("UPDATE courses SET
                                order_number = :order_number,
                                teacher_id = :teacher_id,
                                course_name = :course_name,
                                course_picture = :course_picture,
                                youtube_embed = :youtube_embed,
                                lecture_hours_per_day = :lecture_hours_per_day,
                                duration = :duration,
                                semester = :semester,
                                fee = :fee,
                                type = :type,
                                course_description = :course_description
                                WHERE id = :id");
            if($stmt->execute($data)){
                return $data[':id'];
            }else{
                return false;
            }
        }else{
            $db = static::getDB();
            $stmt = $db->prepare("UPDATE courses SET
                                order_number = :order_number,
                                teacher_id = :teacher_id,
                                course_name = :course_name,
                                youtube_embed = :youtube_embed,
                                lecture_hours_per_day = :lecture_hours_per_day,
                                duration = :duration,
                                semester = :semester,
                                fee = :fee,
                                type = :type,
                                course_description = :course_description
                                WHERE id = :id");
            if($stmt->execute($data)){
                return $data[':id'];
            }else{
                return false;
            }
        }
    }
    public function getAvailableCourses(){
        $db = static::getDB();
        $today = date('Y-m-d');
        $stmt = $db->query("SELECT * FROM courses WHERE id IN (SELECT course_id FROM batches WHERE start_date > '$today')");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getCourseLearn($course_id){
        $db = static::getDB();
        $today = date('Y-m-d');
        $stmt = $db->prepare("SELECT * FROM course_learn WHERE course_id = :course_id");
        $stmt->execute([':course_id' => $course_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function InsertCourseLearn($data){
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO course_learn
                                (course_id, detail)
                                VALUES
                                (:course_id, :detail)");
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }
    public function DeleteCourseLearn($id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT course_id FROM course_learn WHERE id = :id");
        $stmt->execute([":id"=>$id]);
        $course = $stmt->fetch();
        $course_id = $course['course_id'];
        $stmt = $db->prepare("DELETE FROM course_learn WHERE id = :id");
        $stmt->execute([":id" => $id]);
        return $course_id;
    }

    public function GetCourseTerms($id)
    {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM course_tc WHERE course_id = :id");
        $stmt->execute([":id" => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCoursesByStdId($std_id)
    {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT courses.*, batches.*, enrollments.*
            FROM courses 
            JOIN batches on courses.id = batches.course_id
            JOIN enrollments on batches.id = enrollments.batch_id 
            WHERE enrollments.student_id = :student_id 
            ORDER BY enrollments.id DESC
            ");
        $stmt->execute([":student_id" => $std_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}