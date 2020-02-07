<?php


namespace App\Models;

use PDO;

class Batches extends \Core\Model
{
    public function getBatches()
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT batches.*, courses.course_name FROM batches JOIN courses ON courses.id= batches.course_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBatchInfo($id)
    {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM batches WHERE id = :bid");
        $stmt->execute([':bid' => $id]);
        return $stmt->fetch();
    }

    public function getBatchAvaliable()
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT * FROM batches WHERE end_date > CURRENT_DATE()");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add_new_batch($data)
    {
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO batches 
                                (course_id, name, start_date, end_date, start_time, end_time, total_students)
                                VALUES 
                                (:course_id, :batch_name, :start_date, :end_date, :start_time, :end_time, :total_students)");
        if ($stmt->execute($data))
            return true;
        else
            return false;
    }

    public function countEnrolledStudents($batch_id)
    {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT COUNT(id) as total FROM enrollments WHERE batch_id = :batch_id AND status = 1");
        $stmt->execute([':batch_id' => $batch_id]);
        $total_students = $stmt->fetch();
        return $total_students['total'];
    }

    public function edit_batch($data)
    {
        $db = static::getDB();
        $stmt = $db->prepare("UPDATE batches SET
                        course_id = :course_id,
                        name = :batch_name,
                        start_date = :start_date,
                        end_date = :end_date,
                        start_time = :start_time,
                        end_time = :end_time,
                        total_students = :total_students
                        WHERE id = :batch_id");
        if ($stmt->execute($data))
            return true;
        else
            return false;
    }

    public function delete_batch($batch_id)
    {
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM batches WHERE id = :batch_id");
        $stmt->execute([':batch_id' => $batch_id]);
        $stmt = $db->prepare("DELETE FROM enrollments WHERE batch_id = :batch_id");
        $stmt->execute([':batch_id' => $batch_id]);
        return true;
    }

    public function getPendingEnrollments($batch_id)
    {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT enrollments.*, students.name FROM enrollments JOIN students ON students.id = enrollments.student_id WHERE enrollments.status = 0 AND enrollments.batch_id = :batch_id");
        $stmt->execute([':batch_id' => $batch_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getApprovedEnrollments($batch_id)
    {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT enrollments.*, students.name FROM enrollments JOIN students ON students.id = enrollments.student_id WHERE enrollments.status = 1 AND enrollments.batch_id = :batch_id");
        $stmt->execute([':batch_id' => $batch_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetBatchByCourseId($course_id)
    {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM batches WHERE course_id = :course_id AND start_date >= CURRENT_DATE()");
        $stmt->execute([':course_id' => $course_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBatchByEnrollId($enroll_id)
    {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT batches.* FROM batches JOIN enrollments ON enrollments.batch_id = batches.id WHERE enrollments.id = :id");
        $stmt->execute([':id' => $enroll_id]);
        return $stmt->fetch();
    }
}