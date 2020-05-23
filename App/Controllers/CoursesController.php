<?php


namespace App\Controllers;


use Core\View;

class CoursesController
{
    public function __construct()
    {
        Auth('admin');
    }
    public function manage(){
        $course = new \App\Models\Courses();
        $course = $course->getCourses();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['course'=>'active']);
        View::render('backend/academics/courses/manage_courses.html', [
            'courses' => $course
        ]);
        View::render('backend/layouts/script.html');
    }
    public function add_new_course(){
        $teachers = new \App\Models\Teachers();
        $teachers = $teachers->getTeachers();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['course'=>'active']);
        View::render('backend/academics/courses/add_new_course.html', [
            'teachers' => $teachers
        ]);
        View::render('backend/layouts/script.html');
    }
    public function add_new_course_post(){
        if(!empty($_FILES['course_picture']['name'])){
            $response = uploadfile('course_picture', '../content/course_images');
        }else{
            $response = true;
        }
        if($response == "invalid_image"){
            redirectWithMessage(app_url('admin').'/students/add-new-course', 'Invalid Image File', 'course', 'error');
        }else if($response == "invalid_size"){
            redirectWithMessage(app_url('admin').'/students/add-new-course', 'Image is too larger to upload', 'course', 'error');
        }else if($response == "not_uploaded"){
            redirectWithMessage(app_url('admin').'/students/add-new-course', 'something went\'s wrong!', 'course', 'error');
        }else {
            // preparing data
            $data = [
                ':order_number' => clean_post('order_number'),
                ':teacher_id' => clean_post('course_teacher'),
                ':course_name' => clean_post('course_name'),
                ':slug' => clean_post('course_slug'),
                ':course_picture' => $response,
                ':youtube_embed' => clean_post('video_id'),
                ':type' => $_POST['type'],
                ':lecture_hours_per_day' => clean_post('daily_hours'),
                ':duration' => clean_post('duration_number')." ".clean_post('duration_option').(clean_post('duration_number') > 1 ? "s": ""),
                ':semester' => clean_post('semester'),
                ':fee' => clean_post('course_fee'),
                ':course_description' => clean_post('course_description'),
            ];
            $course = new \App\Models\Courses();
            $course = $course->InsertNewCourse($data);
            if($course){
                redirectWithMessage(app_url('admin').'/courses/view-course/'.$course, 'New Courses Added Successfully', 'course');
            }else{
                redirectWithMessage(app_url('admin').'/courses/view-course/'.$course, 'New Courses Added Successfully', 'course');
            }
        }
    }
    public function edit_course($request){
        $course = new \App\Models\Courses();
        $course = $course->getCourseById($request['id']);
        $teachers = new \App\Models\Teachers();
        $teachers = $teachers->getTeachers();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['course'=>'active']);
        View::render('backend/academics/courses/edit_course.html', [
            'teachers' => $teachers,
            'course' => $course
        ]);
        View::render('backend/layouts/script.html');
    }
    public function edit_course_post(){
        if(!empty($_FILES['course_picture']['name'])) {
            $response = uploadfile('course_picture', '../content/course_images');
            if ($response == "invalid_image") {
                redirectWithMessage(app_url('admin') . '/students/add-new-course', 'Invalid Image File', 'course', 'error');
            } else if ($response == "invalid_size") {
                redirectWithMessage(app_url('admin') . '/students/add-new-course', 'Image is too larger to upload', 'course', 'error');
            } else if ($response == "not_uploaded") {
                redirectWithMessage(app_url('admin') . '/students/add-new-course', 'something went\'s wrong!', 'course', 'error');
            } else {
                // preparing data
                $data = [
                    ':order_number' => clean_post('order_number'),
                    ':teacher_id' => clean_post('course_teacher'),
                    ':course_name' => clean_post('course_name'),
                    ':slug' => clean_post('course_slug'),
                    ':course_picture' => $response,
                    ':youtube_embed' => clean_post('video_id'),
                    ':lecture_hours_per_day' => clean_post('daily_hours'),
                    ':duration' => clean_post('duration_number') . " " . clean_post('duration_option') . (clean_post('duration_number') > 1 ? "s" : ""),
                    ':semester' => clean_post('semester'),
                    ':fee' => clean_post('course_fee'),
                    ':type' => $_POST['type'],
                    ':course_description' => clean_post('course_description'),
                    ':id' => clean_post('id')
                ];
                $course = new \App\Models\Courses();
                $course = $course->EditCourse($data, true);
            }
        }else{
            $data = [
                ':order_number' => clean_post('order_number'),
                ':teacher_id' => clean_post('course_teacher'),
                ':course_name' => clean_post('course_name'),
                ':slug' => clean_post('course_slug'),
                ':youtube_embed' => clean_post('video_id'),
                ':lecture_hours_per_day' => clean_post('daily_hours'),
                ':duration' => clean_post('duration_number') . " " . clean_post('duration_option') . (clean_post('duration_number') > 1 ? "s" : ""),
                ':semester' => clean_post('semester'),
                ':fee' => clean_post('course_fee'),
                ':type' => $_POST['type'],
                ':course_description' => clean_post('course_description'),
                ':id' => clean_post('id')
            ];
            $course = new \App\Models\Courses();
            $course = $course->EditCourse($data, false);
        }

            if($course){
                redirectWithMessage(app_url('admin').'/courses/view-course/'.$course, 'New Courses Added Successfully', 'course');
            }else{
                redirectWithMessage(app_url('admin').'/courses/view-course/'.$course, 'New Courses Added Successfully', 'course');
            }
    }
    public function view_course($request){
        $course = new \App\Models\Courses();
        $course_data = $course->getCourseById($request['id']);
        $course_content = $course->getCourseContent($request['id']);
        $course_tc = $course->getCourseTC($request['id']);
        $course_learn = $course->getCourseLearn($request['id']);
        //var_dump($course_content); die;
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['course'=>'active']);
        View::render('backend/academics/courses/view_course.html', [
            'c' => $course_data,
            'course_content' => $course_content,
            'course_tc' => $course_tc,
            'course_learn' => $course_learn
        ]);
        View::render('backend/layouts/script.html');
    }
    public function new_content(){
        // preparing data
        $data = [
            ':course_id' => clean_post('course_id'),
            ':content_title' => clean_post('content_title'),
            ':duration' => clean_post('duration_number')." ".clean_post('duration_option').(clean_post('duration_number') > 1 ? "s": ""),
            ':content_description' => clean_post('content_description'),
            ':position' => clean_post('position')
        ];
        $course = new \App\Models\Courses();
        $course_content = $course->InsertCourseContent($data);
        if($course_content){
            redirectWithMessage(app_url('admin').'/courses/view-course/'.$data[':course_id'], 'Content Added!', 'course');
        }else{
            redirectWithMessage(app_url('admin').'/courses/view-course/'.$data[':course_id'], 'Something wents Wrong!', 'course', 'error');
        }
    }
    public function edit_content(){
        // preparing data
        $data = [
            ':course_id' => clean_post('course_id'),
            ':content_title' => clean_post('content_title'),
            ':duration' => clean_post('duration_number')." ".clean_post('duration_option').(clean_post('duration_number') > 1 ? "s": ""),
            ':content_description' => clean_post('content_description'),
            ':position' => clean_post('position'),
            ':id' => clean_post('content_id')
        ];
        $course = new \App\Models\Courses();
        $course_content = $course->UpdateCourseContent($data);
        if($course_content){
            redirectWithMessage(app_url('admin').'/courses/view-course/'.$data[':course_id'], 'Content Updated!', 'course');
        }else{
            redirectWithMessage(app_url('admin').'/courses/view-course/'.$data[':course_id'], 'Something wents Wrong!', 'course', 'error');
        }
    }
    public function delete_content($request){
        $course = new \App\Models\Courses();
        $course_id = $course->DeleteCourseContent($request['id']); // course id
        if($course_id){
            redirectWithMessage(app_url('admin').'/courses/view-course/'.$course_id, 'Content Deleted!', 'course');
        }else{
            redirectWithMessage(app_url('admin').'/courses/view-course/'.$course_id, 'Something wents Wrong!', 'course', 'error');
        }
    }
    public function post_tac(){
        // preparing data
        $data = [
            ':course_id' => clean_post('course_id'),
            ':detail' => clean_post('detail')
        ];
        $course = new \App\Models\Courses();
        $course_tc = $course->InsertCourseTC($data);
        if($course_tc){
            redirectWithMessage(app_url('admin').'/courses/view-course/'.$data[':course_id'], 'Term and Condition Added!', 'course');
        }else{
            redirectWithMessage(app_url('admin').'/courses/view-course/'.$data[':course_id'], 'Something wents Wrong!', 'course', 'error');
        }
    }
    public function delete_tac($request){
        $course = new \App\Models\Courses();
        $course_id = $course->DeleteCourseTC($request['id']); // return course id
        if($course_id){
            redirectWithMessage(app_url('admin').'/courses/view-course/'.$course_id, 'Term and Condition Deleted!', 'course');
        }else{
            redirectWithMessage(app_url('admin').'/courses/view-course/'.$course_id, 'Something wents Wrong!', 'course', 'error');
        }
    }
    public function post_learn(){
        // preparing data
        $data = [
            ':course_id' => clean_post('course_id'),
            ':detail' => clean_post('detail')
        ];
        $course = new \App\Models\Courses();
        $course_tc = $course->InsertCourseLearn($data);
        if($course_tc){
            redirectWithMessage(app_url('admin').'/courses/view-course/'.$data[':course_id'], 'What will you learn added', 'course');
        }else{
            redirectWithMessage(app_url('admin').'/courses/view-course/'.$data[':course_id'], 'Something wents Wrong!', 'course', 'error');
        }
    }
    public function delete_learn($request){
        $course = new \App\Models\Courses();
        $course_id = $course->DeleteCourseLearn($request['id']); // return course id
        if($course_id){
            redirectWithMessage(app_url('admin').'/courses/view-course/'.$course_id, 'Term and Condition Deleted!', 'course');
        }else{
            redirectWithMessage(app_url('admin').'/courses/view-course/'.$course_id, 'Something wents Wrong!', 'course', 'error');
        }
    }
}