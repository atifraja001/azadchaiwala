<?php

namespace App\Controllers;


use Core\View;

class EnrollmentsController
{
    public function __construct()
    {
        Auth('admin');
    }

    public function manage(){
        $enrollments = new \App\Models\Enrollments();
        $enrollments = $enrollments->getApprovedEnroll();
        $batches = new \App\Models\Batches();
        $CannedMsg = $batches->getCannedMsg();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['enrollments'=>'active']);
        View::render('backend/academics/enrollments/manage_enrollments.html', [
            'enrollments' => $enrollments,
            'CannedMsg' => $CannedMsg
        ]);
        View::render('backend/layouts/script.html');
    }

    // change fee status
    public function changeStatus($request){
    	$student = new \App\Models\Enrollments();
        $std = $student->ChangeEnrollmentStatus($request['id']);
        if($std){
            redirectWithMessage(app_url('admin').'/enrollments/manage', 'Enrollments Status Changed', 'pendingstatus');
        }else{
            redirectWithMessage(app_url('admin').'/enrollments/manage', 'Unable to Chnaged student information please contact developers', 'pendingstatus', 'error');
        }
    }

    // pending enrollments manage

    public function pending_manage(){
        $enrollments = new \App\Models\Enrollments();
        if(isset($_GET['type'])){
            switch ($_GET['type']){
                case 'pending_batch':
                    $enrollments = $enrollments->getPendingBatchEnroll();
                    break;
                case 'rejected_enrollments':
                    $enrollments = $enrollments->getRejectedEnroll();
                    break;
                case 'fee_submission':
                    $enrollments = $enrollments->getPendingFeeEnroll();
                    break;
            }
        }else{
            $enrollments = $enrollments->getPendingEnroll();
        }
        $batches = new \App\Models\Batches();
        $CannedMsg = $batches->getCannedMsg();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['enrollments'=>'active']);
        View::render('backend/academics/enrollments/manage_pending_enrollments.html', [
            'enrollments' => $enrollments,
            'CannedMsg' => $CannedMsg
        ]);
        View::render('backend/layouts/script.html');
    }

    public function changeStatusPaid($request){
    	$student = new \App\Models\Enrollments();
        $std = $student->ChangeEnrollmentStatusPaid($request['id']);
        $enroll = new \App\Models\Enrollments();
        $std = $enroll->getStudentByEnrollId($request['id']);
        $batch = new \App\Models\Batches();
        $batch = $batch->getBatchByEnrollId($request['id']);
        $course = new \App\Models\Courses();
        $course = $course->getCourseByBatchId($batch['id']);
        $email = new \App\Controllers\EmailController();
        $email->sendEmail('registration_verify', [
            'student_name' => $std['name'],
            'course_name' => $course['course_name'],
            'start_time' => date("h:i a", strtotime($batch['start_time'])),
            'start_date' => date("jS F Y", strtotime($batch['start_date'])),
            'course_fee' => number_format($course['course_fee'])
        ]);
        if($std){
            redirectWithMessage(app_url('admin').'/enrollments/pending_manage', 'Enrollments Status Changed to Paid', 'pendingstatus');
        }else{
            redirectWithMessage(app_url('admin').'/enrollments/pending_manage', 'Unable to Changed student information please contact developers', 'pendingstatus', 'error');
        }
    }

    // add new enrollments
    public function add_new_enrollments(){
    	$student = new \App\Models\Students();
        $std = $student->getAvailableStudents();
        // get course
        $course = new \App\Models\Courses();
        $course = $course->getAvailableCourses();
        // get batches
        $batches = new \App\Models\Batches();
        $batches = $batches->getBatchAvaliable();

        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html');
        View::render('backend/academics/enrollments/add_new_enrollments.html' , [
            'std' => $std,
            'courses' => $course,
        	'batches'=> $batches
        ]);
        View::render('backend/layouts/script.html');
    }

    // add new enrollment post
    public function add_new_enrollment_post(){
        // preparing file to upload
        $response = uploadfile('fee_receipt', '../content/receipt_images');
        if($response == "invalid_image"){
            redirectWithMessage(app_url('admin').'/enrollments/add_new_enrollments', 'Invalid Image File', 'enrollment', 'error');
        }else if($response == "invalid_size"){
            redirectWithMessage(app_url('admin').'/enrollments/add_new_enrollments', 'Image is too larger to upload', 'enrollment', 'error');
        }else if($response == "not_uploaded"){
            redirectWithMessage(app_url('admin').'/enrollments/add_new_enrollments', 'something went\'s wrong!', 'enrollment', 'error');
        }else{
            // preparing data
            $data = [
                ':batch_id' => clean_post('selectbatchesid'),
                ':student_id' => clean_post('selectstudentsid'),
                ':fee_receipt' => $response
            ];

            $enrollments = new \App\Models\Enrollments();
            $enrollments->InsertEnrollments($data);
            $course = new \App\Models\Courses();
            $course = $course->getCourseByBatchId($data[':batch_id']);
            $email = new \App\Controllers\EmailController();
            $std = new \App\Models\Students();
            $std = $std->getStudentsById($data[':student_id']);
            $email->sendEmail('registration', [
                'email_to' => $std['email'],
                'course' => $course['course_name']
            ]);
            redirectWithMessage(
                app_url('admin').'/enrollments/add_new_enrollments',
                'Student Profile Created Successfully',
                'addedenrollment');
        }
    }

}