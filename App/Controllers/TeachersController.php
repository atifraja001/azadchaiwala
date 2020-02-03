<?php


namespace App\Controllers;


use Core\View;

class TeachersController
{
    public function __construct()
    {
        Auth('admin');
    }
    public function manage(){
        $teacher = new \App\Models\Teachers();
        $teach = $teacher->getTeachers();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['teacher'=>'active']);
        View::render('backend/academics/teachers/manage_teachers.html', [
            'teacher' => $teach
        ]);
        View::render('backend/layouts/script.html');
    }
    public function fetch__image(){
        $t_id = clean_post('id');
        $student = new \App\Models\Teachers();
        echo $student->getTeacherImage($t_id);
    }
    public function add_new_teacher(){
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['teacher'=>'active']);
        View::render('backend/academics/teachers/add_new_teacher.html');
        View::render('backend/layouts/script.html');
    }
    public function add_new_teacher_post(){
        // preparing file to upload
        $response = uploadfile('profile_picture', 'content/teacher_images');
        if($response == "invalid_image"){
            redirectWithMessage(app_url('admin').'/teachers/add-new-teacher', 'Invalid Image File', 'teacher', 'error');
        }else if($response == "invalid_size"){
            redirectWithMessage(app_url('admin').'/teachers/add-new-teacher', 'Image is too larger to upload', 'teacher', 'error');
        }else if($response == "not_uploaded"){
            redirectWithMessage(app_url('admin').'/teachers/add-new-teacher', 'something went\'s wrong!', 'teacher', 'error');
        }else{
            // preparing data
            $data = [
                ':name' => clean_post('teacher_name'),
                ':fname' => clean_post('father_name'),
                ':gender' => clean_post('gender'),
                ':date_of_birth' => clean_post('year')."-".clean_post('month')."-".clean_post('day'),
                ':cnic' => clean_post('cnic'),
                ':email' => clean_post('email'),
                ':mobile_number' => clean_post('mobile_number'),
                ':address' => clean_post('address'),
                ':about' => clean_post('about'),
                ':picture' => $response
            ];

            $teacher = new \App\Models\Teachers();
            $teach_id = $teacher->InsertTeacher($data);
            redirectWithMessage(
                app_url('admin').'/teachers/manage',
                'Teacher Profile Created Successfully',
                'teacher');
        }
    }
    public function edit_teacher($request){
        $teacher = new \App\Models\Teachers();
        $teacher = $teacher->getTeachersById($request['id']);
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['teacher'=>'active']);
        View::render('backend/academics/teachers/edit_teacher.html', ['teach' => $teacher]);
        View::render('backend/layouts/script.html');
    }
    public function edit_teacher_post(){
        // preparing file to upload
        if(!empty($_FILES['profile_picture']['name'])){
            $response = uploadfile('profile_picture', 'content/teacher_images');
            if($response == "invalid_image"){
                redirectWithMessage(app_url('admin').'/teachers/edit-teacher/'.clean_post('id'), 'Invalid Image File', 'student', 'error');
            }else if($response == "invalid_size"){
                redirectWithMessage(app_url('admin').'/teachers/edit-teacher/'.clean_post('id'), 'Image is too Larger to upload', 'student', 'error');
            }else if($response == "not_uploaded"){
                redirectWithMessage(app_url('admin').'/teachers/edit-teacher/'.clean_post('id'), 'something went\'s wrong!', 'student', 'error');
            }else{
                // preparing data
                $data = [
                    ':name' => clean_post('teacher_name'),
                    ':fname' => clean_post('father_name'),
                    ':gender' => clean_post('gender'),
                    ':date_of_birth' => clean_post('year')."-".clean_post('month')."-".clean_post('day'),
                    ':cnic' => clean_post('cnic'),
                    ':email' => clean_post('email'),
                    ':mobile_number' => clean_post('mobile_number'),
                    ':address' => clean_post('address'),
                    ':about' => clean_post('about'),
                    ':picture' => $response,
                    ':id' => clean_post('id')
                ];

                $student = new \App\Models\Students();
                $std_id = $student->UpdateStudent($data, true);
                redirectWithMessage(
                    app_url('admin').'/teachers/manage',
                    'Teacher Profile updated Successfully',
                    'student');
            }
        }else{
            // preparing data
            $data = [
                ':name' => clean_post('teacher_name'),
                ':fname' => clean_post('father_name'),
                ':gender' => clean_post('gender'),
                ':date_of_birth' => clean_post('year')."-".clean_post('month')."-".clean_post('day'),
                ':cnic' => clean_post('cnic'),
                ':email' => clean_post('email'),
                ':mobile_number' => clean_post('mobile_number'),
                ':address' => clean_post('address'),
                ':about' => clean_post('about'),
                ':id' => clean_post('id')
            ];
            $student = new \App\Models\Teachers();
            $std_id = $student->UpdateStudent($data, false);
            redirectWithMessage(
                app_url('admin').'/teachers/manage',
                'Teacher Profile updated Successfully',
                'student');
        }
    }
    public function delete_teacher($request){
        $student = new \App\Models\Teachers();
        $std = $student->deleteTeacherById($request['id']);
        if($std){
            redirectWithMessage(app_url('admin').'/teachers/manage', 'Teacher Deleted Successfully', 'teacher');
        }else{
            redirectWithMessage(app_url('admin').'/teachers/manage', 'Unable to delete teacher information please contact developers', 'teacher', 'error');
        }
    }
}