<?php


namespace App\Controllers;


use Core\View;

class StudentsController
{
    public function __construct()
    {
        Auth('admin');
    }
    public function manage(){
        $student = new \App\Models\Students();
        $std = $student->getStudents();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['student'=>'active']);
        View::render('backend/academics/students/manage_students.html', [
            'std' => $std
        ]);
        View::render('backend/layouts/script.html');
    }
    public function add_new_student(){
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['student'=>'active']);
        View::render('backend/academics/students/add_new_student.html');
        View::render('backend/layouts/script.html');
    }
    public function edit_student($request){
        $student = new \App\Models\Students();
        $std = $student->getStudentsById($request['id']);
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['student'=>'active']);
        View::render('backend/academics/students/edit_student.html', ['std' => $std]);
        View::render('backend/layouts/script.html');
    }
    public function delete_student($request){
        $student = new \App\Models\Students();
        $std = $student->deleteStudentsById($request['id']);
        if($std){
            redirectWithMessage(app_url('admin').'/students/manage', 'Student Deleted Successfully', 'student');
        }else{
            redirectWithMessage(app_url('admin').'/students/manage', 'Unable to delete student information please contact developers', 'student', 'error');
        }
    }
    public function fetch__image(){
        $std_id = clean_post('id');
        $student = new \App\Models\Students();
        echo $student->getStdImage($std_id);
    }
    public function add_new_student_post(){
        // preparing file to upload
        $response = uploadfile('profile_picture', '../content/student_images');
        if($response == "invalid_image"){
            redirectWithMessage(app_url('admin').'/students/add-new-student', 'Invalid Image File', 'student', 'error');
        }else if($response == "invalid_size"){
            redirectWithMessage(app_url('admin').'/students/add-new-student', 'Image is too larger to upload', 'student', 'error');
        }else if($response == "not_uploaded"){
            redirectWithMessage(app_url('admin').'/students/add-new-student', 'something went\'s wrong!', 'student', 'error');
        }else{
            // preparing data
            $data = [
                ':name' => clean_post('student_name'),
                ':fname' => clean_post('father_name'),
                ':gender' => clean_post('gender'),
                ':date_of_birth' => clean_post('year')."-".clean_post('month')."-".clean_post('day'),
                ':cnic' => clean_post('cnic'),
                ':email' => clean_post('email'),
                ':mobile_number' => clean_post('mobile_number'),
                ':address' => clean_post('address'),
                ':picture' => $response
            ];

            $student = new \App\Models\Students();
            $std_id = $student->InsertStudent($data);
            redirectWithMessage(
                app_url('admin').'/students/view-profile/'.$std_id,
                'Student Profile Created Successfully',
                'view_student');
        }
    }
    public function view_student($request){
        $student = new \App\Models\Students();
        $std = $student->getStudentsById($request['id']);
        if(!empty($std)) {
            View::render('backend/layouts/head.html');
            View::render('backend/layouts/navbar.html', ['student'=>'active']);
            View::render('backend/academics/students/view_student.html', ['std' => $std]);
            View::render('backend/layouts/script.html');
        }else{
            redirect(app_url('admin').'/students/manage');
        }
    }
    public function edit_student_post(){
        // preparing file to upload
        if(!empty($_FILES['profile_picture']['name'])){
            $response = uploadfile('profile_picture', '../content/student_images');
            if($response == "invalid_image"){
                redirectWithMessage(app_url('admin').'/students/edit-student/'.clean_post('id'), 'Invalid Image File', 'student', 'error');
            }else if($response == "invalid_size"){
                redirectWithMessage(app_url('admin').'/students/edit-student/'.clean_post('id'), 'Image is too Larger to upload', 'student', 'error');
            }else if($response == "not_uploaded"){
                redirectWithMessage(app_url('admin').'/students/edit-student/'.clean_post('id'), 'something went\'s wrong!', 'student', 'error');
            }else{
                // preparing data
                $data = [
                    ':name' => clean_post('student_name'),
                    ':fname' => clean_post('father_name'),
                    ':gender' => clean_post('gender'),
                    ':date_of_birth' => clean_post('year')."-".clean_post('month')."-".clean_post('day'),
                    ':cnic' => clean_post('cnic'),
                    ':email' => clean_post('email'),
                    ':mobile_number' => clean_post('mobile_number'),
                    ':address' => clean_post('address'),
                    ':picture' => $response,
                    ':id' => clean_post('id')
                ];

                $student = new \App\Models\Students();
                $std_id = $student->UpdateStudent($data, true);
                redirectWithMessage(
                    app_url('admin').'/students/view-profile/'.$std_id,
                    'Student Profile Created Successfully',
                    'student');
            }
        }else{
            // preparing data
            $data = [
                ':name' => clean_post('student_name'),
                ':fname' => clean_post('father_name'),
                ':gender' => clean_post('gender'),
                ':date_of_birth' => clean_post('year')."-".clean_post('month')."-".clean_post('day'),
                ':cnic' => clean_post('cnic'),
                ':email' => clean_post('email'),
                ':mobile_number' => clean_post('mobile_number'),
                ':address' => clean_post('address'),
                ':id' => clean_post('id')
            ];
            $student = new \App\Models\Students();
            $std_id = $student->UpdateStudent($data, false);
            redirectWithMessage(
                app_url('admin').'/students/view-profile/'.$std_id,
                'Student Profile Created Successfully',
                'student');
        }
    }
    public function search_students(){
        // search by name, cnic, father name, email, phone
        $search_term = "%".clean_get('q')."%";
        $student = new \App\Models\Students();
        $std = $student->SearchStudent($search_term);
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['student'=>'active']);
        View::render('backend/academics/students/search_student.html', ['std' => $std]);
        View::render('backend/layouts/script.html');
    }
}