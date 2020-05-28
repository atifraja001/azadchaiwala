<?php


namespace App\Models;

use Core\Model;
use PDO;

class Enrollments extends Model
{
    public function getallEnrollAndBatchAvaliable()
    {
        $db = static::getDB();
        $date = date('Y-m-d');
        $stmt = $db->prepare("SELECT COUNT(id) as total_active_enroll 
                            FROM enrollments 
                            WHERE batch_id IN 
                            (SELECT id FROM batches 
                            WHERE end_date > :end_date)");
        $stmt->execute([":end_date" => $date]);
        return $stmt->fetch();
    }

    public function getApprovedEnrollAndBatchAvaliable()
    {
        $db = static::getDB();
        $date = date('Y-m-d');
        $stmt = $db->prepare("SELECT COUNT(id) as total_active_enroll 
                            FROM enrollments 
                            WHERE batch_id IN 
                            (SELECT id FROM batches 
                            WHERE end_date > :end_date) AND status =1");
        $stmt->execute([":end_date" => $date]);
        return $stmt->fetch();
    }

    public function getPendingEnrollAndBatchAvaliable()
    {
        $db = static::getDB();
        $date = date('Y-m-d');
        $stmt = $db->prepare("SELECT COUNT(id) as total_active_enroll 
                            FROM enrollments 
                            WHERE batch_id IN 
                            (SELECT id FROM batches 
                            WHERE end_date > :end_date) AND status=0");
        $stmt->execute([":end_date" => $date]);
        return $stmt->fetch();
    }

    public function getApprovedEnroll()
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT enrollments.*, batches.name as batch_name, batches.id as batch_id FROM enrollments
                            JOIN batches 
                            ON enrollments.batch_id = batches.id 
                            WHERE enrollments.status = 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEnrollImageById($enroll_id)
    {
        // fee receipt
        $db = static::getDB();
        $stmt = $db->prepare("SELECT fee_receipt FROM enrollments WHERE id = :id");
        $stmt->execute([':id' => $enroll_id]);
        return $stmt->fetch();
    }

    public function ChangeEnrollmentStatus($id)
    {
        $db = static::getDB();
        $stmt = $db->prepare("UPDATE enrollments SET status = 0 WHERE id = :id");
        if ($stmt->execute(['id' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    // pending enrollments show
    public function getPendingEnroll()
    {
        $db = static::getDB();
        $stmt = $db->query("SELECT enrollments.*, batches.name as batch_name, batches.id as batch_id FROM enrollments
                            JOIN batches 
                            ON enrollments.batch_id = batches.id 
                            WHERE enrollments.status = 0");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // get all students
    public function ChangeEnrollmentStatusPaid($id)
    {
        $db = static::getDB();
        $stmt = $db->prepare("UPDATE enrollments SET status = 1 WHERE id = :id");
        if ($stmt->execute(['id' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    // public function InsertEnrollments
    public function InsertEnrollments($data)
    {
        $db = static::getDB();
        $stmt = $db->prepare("INSERT INTO enrollments 
                (batch_id, student_id, 
                fee_receipt, status)
                VALUES
                (:batch_id, :student_id, :fee_receipt, 
                1)");
        if ($stmt->execute($data)) {
            return $db->lastInsertId();
        } else {
            return false;
        }
    }

    public function UpdateEnrollmentsByStudent($data)
    {
        $db = static::getDB();
        $stmt = $db->prepare('SELECT * FROM enrollments 
                                        WHERE student_id = :student_id AND course_id = :course_id AND batch_id IS NULL');
        $stmt->execute([
            ':student_id' => $data[':student_id'],
            ':course_id' => $data[':course_id']
        ]);
        if ($stmt->rowCount() > 0) {
            $d = $stmt->fetch();
            $stmt = $db->prepare("UPDATE enrollments SET batch_id = :batch_id 
                                            WHERE student_id = :student_id 
                                            AND course_id = :course_id 
                                            AND batch_id IS NULL");
            $stmt->execute([
                ':student_id' => $data[':student_id'],
                ':course_id' => $data[':course_id'],
                ':batch_id' => $data[':batch_id']
            ]);
            if ($stmt->execute($data)) {
                return $d['id'];
            } else {
                return false;
            }
        } else {
            $stmt = $db->prepare('SELECT * FROM enrollments 
                                        WHERE student_id = :student_id AND course_id = :course_id AND batch_id = :batch_id AND fee_receipt IS NULL');
            $stmt->execute([
                ':student_id' => $data[':student_id'],
                ':course_id' => $data[':course_id'],
                ':batch_id' => $data[':batch_id']
            ]);
            if ($stmt->rowCount() == 0) {
                $d = $stmt->fetch();
                return $d['id'];
            } else {
                $stmt = $db->prepare('SELECT * FROM enrollments 
                                        WHERE student_id = :student_id AND course_id = :course_id 
                                        AND batch_id = :batch_id AND status = 0');
                $stmt->execute([
                    ':student_id' => $data[':student_id'],
                    ':course_id' => $data[':course_id'],
                    ':batch_id' => $data[':batch_id']
                ]);
            }
            if ($stmt->rowCount() == 0) {
                $d = $stmt->fetch();
                return $d['id'];
            } else {
                return false;
            }
        }
    }

    public function change_status($data)
    {
        $db = static::getDB();
        $stmt = $db->prepare("UPDATE enrollments SET status = :status WHERE id = :enroll_id");
        if ($stmt->execute($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_enroll($data)
    {
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM enrollments WHERE id = :enroll_id");
        if ($stmt->execute($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function CheckStudentEnrollment($std_id, $batch_id)
    {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM enrollments WHERE batch_id=:batch_id AND student_id=:student_id");
        $stmt->execute([':batch_id' => $batch_id, ':student_id' => $std_id]);
        return $stmt->fetch();
    }

    public function getStudentByEnrollId($enroll_id)
    {
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM students WHERE id IN (SELECT student_id FROM enrollments WHERE id = :id)");
        $stmt->execute([':id' => $enroll_id]);
        return $stmt->fetch();
    }
    public function getEnrollById($id){
        $db = static::getDB();
        $stmt = $db->prepare("SELECT * FROM enrollments WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    public function deleteEnrollById($id){
        $db = static::getDB();
        $stmt = $db->prepare("DELETE FROM enrollments WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
    public function updateFeeReceipt($data)
    {
        $db = static::getDB();
        $stmt = $db->prepare("UPDATE enrollments SET fee_receipt = :fee_receipt WHERE id = :id");
        if ($stmt->execute($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function initCourse($course_id, $student_id)
    {
        $db = static::getDB();
        $stmt = $db->prepare('SELECT * FROM enrollments 
                                        WHERE student_id = :student_id AND course_id = :course_id AND batch_id IS NULL');
        $stmt->execute([
            ':course_id' => $course_id,
            ':student_id' => $student_id
        ]);
        if ($stmt->rowCount() == 0) {
            $stmt = $db->prepare("INSERT INTO enrollments 
                (course_id, student_id, status)
                VALUES
                (:course_id, :student_id, 0)");
            $stmt->execute([
                ':course_id' => $course_id,
                ':student_id' => $student_id
            ]);
        }
        return true;
    }
    public function getUpcomingEnroll($student_id){
        $db = static::getDB();
        $stmt = $db->prepare('SELECT batches.*, enrollments.* FROM batches 
                    JOIN enrollments WHERE batches.id = enrollments.batch_id 
                    AND batches.start_date > current_date() AND enrollments.student_id = :student_id');
        $stmt->execute([':student_id' => $student_id]);
        return $stmt->fetch();
    }
}