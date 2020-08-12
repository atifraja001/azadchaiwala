<?php

namespace App\Controllers;


use Core\View;

class BatchesController
{
    public function __construct()
    {
        Auth('admin');
    }

    public function manage(){
        $batches = new \App\Models\Batches();
        $batches = $batches->getBatches();
        $course = new \App\Models\Courses();
        $courses = $course->getCourses();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['batches'=>'active']);
        View::render('backend/academics/batches/manage_batches.html', [
            'batches' => $batches,
            'courses' => $courses
        ]);
        View::render('backend/layouts/script.html');
    }
    public function view_batches($request){
        $batches = new \App\Models\Batches();
        $batch = $batches->getBatchInfo($request['id']);
        $course = new \App\Models\Courses();
        $course = $course->getCourseById($batch['course_id']);
        $total_enrolled = $batches->countEnrolledStudents($batch['id']);
        $pending_enrollments = $batches->getPendingEnrollments($request['id']);
        $approved_enrollments = $batches->getApprovedEnrollments($request['id']);
        $CannedMsg = $batches->getCannedMsg();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['batches'=>'active']);
        View::render('backend/academics/batches/view_batch.html', [
            'batch' => $batch,
            'course' => $course,
            'total_enrolled' => $total_enrolled,
            'pending_enrollments' => $pending_enrollments,
            'approved_enrollments' => $approved_enrollments,
            'CannedMsg' => $CannedMsg
        ]);
        View::render('backend/layouts/script.html');
    }
    public function add_new_batch_post(){
        // preparing data
        $data = [
            ':course_id' => clean_post('course_id'),
            ':batch_name' => clean_post('batch_name'),
            ':start_date' => date('Y-m-d', strtotime(clean_post('start_date'))),
            ':end_date' => date('Y-m-d', strtotime(clean_post('end_date'))),
            ':start_time' => clean_post('start_time').":00",
            ':end_time' => clean_post('end_time').":00",
            ':class_link' => $_POST['class_link'],
            ':total_students' => clean_post('total_students')
        ];
        $batches = new \App\Models\Batches();
        $batches = $batches->add_new_batch($data);
        if($batches){
            redirectWithMessage(app_url('admin').'/batches/manage', 'New Batch Added', 'batches');
        }else{
            redirectWithMessage(app_url('admin').'/batches/manage', 'Something Went\'s Wrong', 'batches', 'error');
        }
    }
    public function show_edit_form($request){
        $batch = new \App\Models\Batches();
        $batch = $batch->getBatchInfo($request['id']);
        $course = new \App\Models\Courses();
        $courses = $course->getCourses();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['batches'=>'active']);
        View::render('backend/academics/batches/edit_batch.html', [
            'batch' => $batch,
            'courses' => $courses
        ]);
        View::render('backend/layouts/script.html');
    }
    public function edit_batch_post(){
        // preparing data
        $data = [
            ':batch_id' => clean_post('batch_id'),
            ':course_id' => clean_post('course_id'),
            ':batch_name' => clean_post('batch_name'),
            ':start_date' => date('Y-m-d', strtotime(clean_post('start_date'))),
            ':end_date' => date('Y-m-d', strtotime(clean_post('end_date'))),
            ':start_time' => clean_post('start_time').":00",
            ':end_time' => clean_post('end_time').":00",
            ':class_link' => $_POST['class_link'],
            ':total_students' => clean_post('total_students')
        ];
        $batches = new \App\Models\Batches();
        $batches = $batches->edit_batch($data);
        if($batches){
            redirectWithMessage(app_url('admin').'/batches/manage', 'Batch information Updated', 'batches');
        }else{
            redirectWithMessage(app_url('admin').'/batches/manage', 'Something Went\'s Wrong', 'batches', 'error');
        }
    }
    public function delete_batch($request){
        $batches = new \App\Models\Batches();
        $batches = $batches->delete_batch($request['id']);
        if($batches){
            redirectWithMessage(app_url('admin').'/batches/manage', 'Batch Deleted', 'batches');
        }else{
            redirectWithMessage(app_url('admin').'/batches/manage', 'Something Went\'s Wrong', 'batches', 'error');
        }
    }
    public function change_status($request){
        $data = [
            ':enroll_id' => $request['eid'],
            ':status' => $request['sid'],
            ':fee_note' => !empty($_POST['fee_note']) ? $_POST['fee_note'] : NULL,
        ];
        if(!empty($_POST['canned'])){
            if($_POST['canned'] == 1){
                $enroll = new \App\Models\Enrollments();
                $std = $enroll->saveCanned($data[':fee_note']);
            }
        }
        $enroll = new \App\Models\Enrollments();
        $std = $enroll->getStudentByEnrollId($data[':enroll_id']);
        $batch = new \App\Models\Batches();
        $batch = $batch->getBatchByEnrollId($data[':enroll_id']);
        $course = new \App\Models\Courses();
        $course = $course->getCourseByBatchId($batch['id']);
        $email = new \App\Controllers\EmailController();
        if($data[':status'] == 1){
            $email->sendEmail('registration_verify', [
                'student_name' => $std['name'],
                'course_name' => $course['course_name'],
                'start_time' => date("h:i a", strtotime($batch['start_time'])),
                'start_date' => date("jS F Y", strtotime($batch['start_date'])),
                'course_fee' => number_format($course['course_fee'])
            ]);
        }else if($data[':status'] == 2){
            $email->sendEmail('registration_rejected', [
                'email_to' => $std['email'],
                'course' => $course['course_name']
            ]);
        }
        $status = new \App\Models\Enrollments();
        $status = $status->change_status($data);
        if($status){
            redirectWithMessage('', 'Status Changed', 'batches');
        }else{
            redirectWithMessage('', 'Something Went\'s Wrongs', 'batches', 'error');
        }
    }
    public function delete_enroll($request){
        $data = [
            ':enroll_id' => $request['eid']
        ];
        $status = new \App\Models\Enrollments();
        $status = $status->delete_enroll($data);
        if($status){
            redirectWithMessage('', 'Enrollment Deleted!', 'batches');
        }else{
            redirectWithMessage('', 'Something Went\'s Wrongs', 'batches', 'error');
        }
    }
    public function get__batches(){
        $course_id = clean_post('course_id');
        $batches = new \App\Models\Batches();
        $batch = $batches->GetBatchByCourseId($course_id);
        foreach ($batch as $b){
            echo '<option value="'.$b['id'].'">'.$b['name'].'</option>';
        }
    }
}