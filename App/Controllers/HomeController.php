<?php

namespace App\Controllers;

use \Core\View;
use PDO;

class HomeController extends \Core\Controller
{
    public function index()
    {
        $courses = new \App\Models\Courses();
        $courses = $courses->getCourses();
        $review = new \App\Models\Reviews();
        $review = $review->getReviews();
         //get courses with batches
        $courses_b = new \App\Models\Courses();
        $courses_b = $courses_b->getCoursesByBatch(); 
        View::render('frontend/layouts/head.html', ['title' => 'Learn Skills']);
        View::render('frontend/layouts/navbar.html', ['home' => 'active']);
        View::render('frontend/index.html', [
            'courses' => $courses,
            'review' => $review,
            'courses_b' => $courses_b
        ]);
        View::render('frontend/layouts/script.html');
    }

    public function faqs()
    {
        $faq = new \App\Models\Faqs();
        $faqs = $faq->getFaqs();
        View::render('frontend/layouts/head.html', ['title' => 'FAQ\'s']);
        View::render('frontend/layouts/navbar.html', ['faq' => 'active']);
        View::render('frontend/faqs.html', [
            'faqs' => $faqs
        ]);
        View::render('frontend/layouts/script.html');
    }

    public function courses()
    {
        $courses = new \App\Models\Courses();
        $courses = $courses->getCourses();
        $courses_b = new \App\Models\Courses();
        $courses_b = $courses_b->getCoursesByBatch();
        View::render('frontend/layouts/head.html', ['title' => 'COURSES']);
        View::render('frontend/layouts/navbar.html', ['courses' => 'active']);
        View::render('frontend/courses.html', [
            'courses' => $courses,
            'courses_b' => $courses_b
        ]);
        View::render('frontend/layouts/script.html');
    }

    public function payments()
    {
        View::render('frontend/layouts/head.html', ['title' => 'PAYMENTS']);
        View::render('frontend/layouts/navbar.html', ['payments' => 'active']);
        View::render('frontend/payments.html');
        View::render('frontend/layouts/script.html');
    }

    public function about()
    {
        View::render('frontend/layouts/head.html', ['title' => 'ABOUT US']);
        View::render('frontend/layouts/navbar.html', ['about' => 'active']);
        View::render('frontend/about.html');
        View::render('frontend/layouts/script.html');
    }

    public function contact()
    {
        View::render('frontend/layouts/head.html', ['title' => 'CONTACT US']);
        View::render('frontend/layouts/navbar.html', ['contact' => 'active']);
        View::render('frontend/contact.html');
        View::render('frontend/layouts/script.html');
    }
    public function gallery()
    {
        $gallery = new \App\Models\Gallery();
        $gallerys = $gallery->getGallery();
        $classes = $gallery->getClass();
        View::render('frontend/layouts/head.html', ['title' => 'Gallery']);
        View::render('frontend/layouts/navbar.html', ['gallery' => 'active']);
        View::render('frontend/gallery.html', [
            'gals' => $gallerys,
            'classes' => $classes
        ]);
        View::render('frontend/layouts/script.html');
    }
    public function accommodation()
    {
        View::render('frontend/layouts/head.html', ['title' => 'Accommodation']);
        View::render('frontend/layouts/navbar.html', ['accommodation' => 'active']);
        View::render('frontend/accommodation.html');
        View::render('frontend/layouts/script.html');
    }

    // static courses page
    // @
    public function graphiccourse($request){
        $slug = basename(parse_url(getUrl(), PHP_URL_PATH));
        $course = new \App\Models\Courses();
        $course = $course->getCourseBySlug($slug);
        $course_id = $course['id'];
        $batches = new \App\Models\Batches();
        $batch = $batches->GetUpComingBatchByCourseId($course_id);
        View::render('frontend/layouts/head.html', ['title' => 'Graphic Design Course']);
        View::render('frontend/layouts/navbar.html');
        View::render('frontend/graphic.html', ['batch' => $batch, 'slug'=>$slug]);
        View::render('frontend/layouts/script.html');
    }
    public function videoCourse(){
        $slug = basename(parse_url(getUrl(), PHP_URL_PATH));
        $course = new \App\Models\Courses();
        $course = $course->getCourseBySlug($slug);
        $course_id = $course['id'];
        $batches = new \App\Models\Batches();
        $batch = $batches->GetUpComingBatchByCourseId($course_id);
        View::render('frontend/layouts/head.html', ['title' => 'VIDEO EDITING, VIDEOGRAPHY Course']);
        View::render('frontend/layouts/navbar.html');
        View::render('frontend/video.html', ['batch' => $batch, 'slug'=>$slug]);
        View::render('frontend/layouts/script.html');
    }
    public function gameCourse(){
        $slug = basename(parse_url(getUrl(), PHP_URL_PATH));
        $course = new \App\Models\Courses();
        $course = $course->getCourseBySlug($slug);
        $course_id = $course['id'];
        $batches = new \App\Models\Batches();
        $batch = $batches->GetUpComingBatchByCourseId($course_id);
        View::render('frontend/layouts/head.html', ['title' => 'Game Development Course']);
        View::render('frontend/layouts/navbar.html');
        View::render('frontend/game.html', ['batch' => $batch, 'slug'=>$slug]);
        View::render('frontend/layouts/script.html');
    }
    public function basicComputer(){
        $slug = basename(parse_url(getUrl(), PHP_URL_PATH));
        $course = new \App\Models\Courses();
        $course = $course->getCourseBySlug($slug);
        $course_id = $course['id'];
        $batches = new \App\Models\Batches();
        $batch = $batches->GetUpComingBatchByCourseId($course_id);
        View::render('frontend/layouts/head.html', ['title' => 'Basic Computer Course']);
        View::render('frontend/layouts/navbar.html');
        View::render('frontend/basic-computer.html', ['batch' => $batch, 'slug'=>$slug]);
        View::render('frontend/layouts/script.html');
    }
    public function phpCourse(){
        $slug = basename(parse_url(getUrl(), PHP_URL_PATH));
        $course = new \App\Models\Courses();
        $course = $course->getCourseBySlug($slug);
        $course_id = $course['id'];
        $batches = new \App\Models\Batches();
        $batch = $batches->GetUpComingBatchByCourseId($course_id);
        View::render('frontend/layouts/head.html', ['title' => 'Web Development in PHP Course']);
        View::render('frontend/layouts/navbar.html');
        View::render('frontend/php_course.html', ['batch' => $batch, 'slug'=>$slug]);
        View::render('frontend/layouts/script.html');
    }

    // new design of the static page
        public function newCourse(){
        $slug = basename(parse_url(getUrl(), PHP_URL_PATH));
        $course = new \App\Models\Courses();
        $course = $course->getCourseBySlug($slug);
        $course_id = $course['id'];
        $batches = new \App\Models\Batches();
        $batch = $batches->GetUpComingBatchByCourseId($course_id);
        View::render('frontend/layouts/head.html', ['title' => 'Web Development in PHP Course']);
        View::render('frontend/layouts/navbar.html');
        View::render('frontend/new_course.html', ['batch' => $batch, 'slug'=>$slug]);
        View::render('frontend/layouts/script.html');
    }
    // end new design
    // @
    // static courses page end

    public function course($request)
    {
        $courses = new \App\Models\Courses();
        $course = $courses->getCourseBySlug($request['slug']);
        // get teacher with course
        $teacher = new \App\Models\Teachers();
        $teacher = $teacher->getTeachersById($course['teacher_id']);
        // get course tc
        $getcoursetc = new \App\Models\Courses();
        $getcoursetc = $getcoursetc->getCourseContent($course['id']);
        $course_learn = $courses->getCourseLearn($course['id']);
        $batch = new \App\Models\Batches();
        $batches = $batch->GetBatchByCourseId($course['id']);

        View::render('frontend/layouts/head.html', ['title' => 'Course']);
        View::render('frontend/layouts/navbar.html');
        View::render('frontend/course.html', [
            'course' => $course, 'teacher' => $teacher, 'course_contect' => $getcoursetc, 'batches' => $batches
            , 'learn' => $course_learn
        ]);
        View::render('frontend/layouts/script.html');
    }

    public function courseregistration($request)
    {
        // get course name
        $courses = new \App\Models\Courses();
        $course = $courses->getCourseBySlug($request['slug']);
        // get batch name
        $getbatch = new \App\Models\Batches();
        $getbatch = $getbatch->GetBatchByCourseId($course['id']);
        // get batch name
        $terms = $courses->GetCourseTerms($course['id']);

        View::render('frontend/layouts/head.html', ['title' => 'Register ' . $course['course_name']]);
        View::render('frontend/layouts/navbar.html');
        View::render('frontend/course-registration.html', [
            'course' => $course, 'batch' => $getbatch, 'terms' => $terms
        ]);
        View::render('frontend/layouts/script.html');
    }

    public function registercoursestudent()
    {
        $students = new \App\Models\Students();
        $std = $students->getStudentByCNIC(clean_post('cnic'));
        if (empty($std)) {
            $picture = $this->UploadStudentImage();
            $fee_receipt = $this->UploadFeeReceipt();
            $student_data = [
                ':name' => clean_post('name'),
                ':fname' => clean_post('fname'),
                ':date_of_birth' => clean_post('year')."-".clean_post('month')."-".clean_post('day'),
                ':gender' => clean_post('gender'),
                ':cnic' => clean_post('cnic'),
                ':mobile_number' => clean_post('mobile_number'),
                ':email' => clean_post('email'),
                ':address' => clean_post('address'),
                ':picture' => $picture,
            ];
            $student = new \App\Models\Students();
            $student = $student->InsertStudent($student_data);
            $enroll_data = [
                ':student_id' => $student,
                ':batch_id' => clean_post('batch_id'),
                ':fee_receipt' => $fee_receipt,
                ':status' => 0
            ];
            $enrollments = new \App\Models\Enrollments();
            $enrollments->InsertEnrollmentsByStudent($enroll_data);
            $course = new \App\Models\Courses();
            $course = $course->getCourseByBatchId($enroll_data[':batch_id']);
            $email = new \App\Controllers\EmailController();
            $email->sendEmail('registration', [
                'email_to' => $student_data[':email'],
                'course' => $course['course_name']
            ]);
            redirectWithMessage(app_url() . '/course-registration/' . clean_post('slug'), 'Thank you joining AzadChaiwala Institute. You will get email for further Information', 'course_registration');
        } else {
            $checkenroll = new \App\Models\Enrollments();
            $checkenroll = $checkenroll->CheckStudentEnrollment($std['id'], clean_post('batch_id'));
            if (empty($checkenroll)) {
                $fee_receipt = $this->UploadFeeReceipt();
                $enroll_data = [
                    ':student_id' => $std['id'],
                    ':batch_id' => clean_post('batch_id'),
                    ':fee_receipt' => $fee_receipt,
                    ':status' => 0
                ];
                $enrollments = new \App\Models\Enrollments();
                $enrollments->InsertEnrollmentsByStudent($enroll_data);
                $course = new \App\Models\Courses();
                $course = $course->getCourseByBatchId($enroll_data[':batch_id']);
                $email = new \App\Controllers\EmailController();
                $email->sendEmail('registration', [
                    'email_to' => $std['email'],
                    'course' => $course['course_name']
                ]);
                redirectWithMessage(app_url() . '/course-registration/' . clean_post('slug'), 'Thank you joining AzadChaiwala Institute. You will get email for further Information', 'course_registration');
            } else {
                redirectWithMessage(app_url() . '/course-registration/' . clean_post('slug'), 'You are already enrolled in this course', 'course_registration', 'error');
            }
        }
    }

    protected function UploadStudentImage()
    {
        $response = uploadfile('picture', '../content/student_images');
        if ($response == "invalid_image") {
            redirectWithMessage(app_url() . '/course-registration/' . clean_post('slug'), 'Invalid Student Image File', 'course_registration', 'error');
        } else if ($response == "invalid_size") {
            redirectWithMessage(app_url() . '/course-registration/' . clean_post('slug'), 'Student Image is too larger to upload', 'course_registration', 'error');
        } else if ($response == "not_uploaded") {
            redirectWithMessage(app_url() . '/course-registration/' . clean_post('slug'), 'something went\'s wrong!', 'course_registration', 'error');
        }
        return $response;
    }

    protected function UploadFeeReceipt()
    {
        $response = uploadfile('fee_receipt', '../content/course_images');
        if ($response == "invalid_image") {
            redirectWithMessage(app_url() . '/course-registration/' . clean_post('slug'), 'Invalid Fee Receipt Image File', 'course_registration', 'error');
        } else if ($response == "invalid_size") {
            redirectWithMessage(app_url() . '/course-registration/' . clean_post('slug'), 'Fee Receipt Image is too larger to upload', 'course_registration', 'error');
        } else if ($response == "not_uploaded") {
            redirectWithMessage(app_url() . '/course-registration/' . clean_post('slug'), 'something went\'s wrong!', 'course_registration', 'error');
        }
        return $response;
    }

    //    Insert Suggestion
    public function SuggestionInsert()
    {
        $course = new \App\Models\Courses();
        $course = $course->getCourseById(clean_post('course_id'));
        $secretKey = \App\Config::CAPTCHA_KEY;
        $captcha = $_POST['g-recaptcha-response'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captcha . "&remoteip=" . $ip);
        $responseKeys = json_decode($response, true);

        if (intval($responseKeys["success"]) !== 1) {
            $data['msg']="Invalid Captcha";
            $data['response']='error';
        } else {
            $data = [
                ':course_id' => clean_post('course_id'),
                ':name' => clean_post('name'),
                ':email' => clean_post('email'),
                ':feedback_text' => clean_post('feedback_text')
            ];
            $enrollments = new \App\Models\Feedbacks();
            $enr = $enrollments->InsertFeedback($data);
            if ($enr) {
                $course = new \App\Models\Courses();
                $course = $course->getCourseById($data[':course_id']);
                $email = new \App\Controllers\EmailController();
                $email = $email->sendEmail('feedback', [
                    'name' => $data[':name'],
                    'email' => $data[':email'],
                    'course' => $course['course_name'],
                    'message' => $data[':message']
                ]);
                $data['msg']="Thank you for your Suggestion";
                $data['response']='success';
            } else {
                $data['msg'] = "something went\'s wrong";
                $data['response']='error';
            }
        }
        echo json_encode($data);
    }

    //insert contact

    public function Insert_Contact($request)
    {
        $data=array();

        $secretKey = \App\Config::CAPTCHA_KEY;
        $captcha = $_POST['g-recaptcha-response'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captcha . "&remoteip=" . $ip);
        $responseKeys = json_decode($response, true);
        if (intval($responseKeys["success"]) !== 1) {
            $data['msg']="Invalid Captcha";
            $data['response']='error';
        } else {
            $data = [
                ':name' => clean_post('name'),
                ':email' => clean_post('email'),
                ':subject' => clean_post('subject'),
                ':message_text' => clean_post('message_text')
            ];
            $contact = new \App\Models\ContactMessage();
            $con = $contact->InsertContact($data);
            if ($con) {
                // sending email
                $email = new \App\Controllers\EmailController();
                $email = $email->sendEmail('contact', [
                    'name' => $data[':name'],
                    'email' => $data[':email'],
                    'subject' => $data[':subject'],
                    'message' => $data[':message_text']
                ]);
                $data['msg']="Thank you for your message. We will shortly contact you";
                $data['response']='success';
            } else {
                $data['msg'] = "something went\'s wrong";
                $data['response']='error';
            }
        }
        echo json_encode($data);
    }

}
