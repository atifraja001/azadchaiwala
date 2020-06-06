<?php


namespace App\Models;

use PDO;
class CronJob extends \Core\Model
{

    public function getPendingPaymentEnrollments(){
        $db = static::getDB();
        $stmt = $db->query("SELECT enrollments.*, student_login.name, student_login.email FROM enrollments JOIN student_login ON student_login.id = enrollments.student_id WHERE enrollments.status = 0 AND enrollments.batch_id IS NOT NULL AND enrollments.fee_receipt IS NULL");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getVerifiedEnrollments(){
        $db = static::getDB();
        $stmt = $db->query("SELECT enrollments.*, student_login.name, student_login.email FROM enrollments JOIN student_login ON student_login.id = enrollments.student_id WHERE enrollments.status = 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}