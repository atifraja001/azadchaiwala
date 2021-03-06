<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';


/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Routing
 */
$router = new Core\Router(); 

// Add the routes ---- public routes
$router->add('', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('faqs', ['controller' => 'HomeController', 'action' => 'faqs']);
$router->add('courses', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('payments', ['controller' => 'HomeController', 'action' => 'payments']);
$router->add('about', ['controller' => 'HomeController', 'action' => 'about']);
$router->add('contact', ['controller' => 'HomeController', 'action' => 'contact']);
$router->add('gallery', ['controller' => 'HomeController', 'action' => 'gallery']);
$router->add('accommodation', ['controller' => 'HomeController', 'action' => 'accommodation']);
$router->add('course-registration/{slug}', ['controller' => 'HomeController', 'action' => 'courseregistration']);
$router->add('course/online-html-crash-course-in-pakistan', ['controller' => 'HomeController', 'action' => 'html_course']);
$router->add('course/free-online-courses', ['controller' => 'HomeController', 'action' => 'free_courses']);

//Auth Routes
$router->add('account', ['controller' => 'AuthController', 'action' => 'index']);
$router->add('doLogin', ['controller' => 'AuthController', 'action' => 'doLogin']);
$router->add('doRegister', ['controller' => 'AuthController', 'action' => 'doRegister']);
$router->add('create-account', ['controller' => 'AuthController', 'action' => 'showRegistrationForm']);
$router->add('create-account/success', ['controller' => 'AuthController', 'action' => 'ShowSuccessPage']);
$router->add('verify', ['controller' => 'AuthController', 'action' => 'VerifyEmail']);
$router->add('account/logout', ['controller' => 'AuthController', 'action' => 'doLogout']);
$router->add('forgot-password', ['controller' => 'AuthController', 'action' => 'forgot_password']);
$router->add('forgot-password/success', ['controller' => 'AuthController', 'action' => 'forgotPasswordSuccess']);
$router->add('doRecover', ['controller' => 'AuthController', 'action' => 'doRecover']);
$router->add('reset-password', ['controller' => 'AuthController', 'action' => 'doResetPassword']);
$router->add('doResetPassword', ['controller' => 'AuthController', 'action' => 'doResetPasswordPost']);


//Account Routes
$router->add('account/dashboard', ['controller' => 'AccountController', 'action' => 'dashboard']);
$router->add('account/my-courses', ['controller' => 'AccountController', 'action' => 'my_courses']);
$router->add('account/my-class/{id:\d+}', ['controller' => 'AccountController', 'action' => 'my_class']);
$router->add('account/my-class/get-link', ['controller' => 'AccountController', 'action' => 'getBatchLink']);
$router->add('account/my-profile', ['controller' => 'AccountController', 'action' => 'my_profile']);
$router->add('account/edit-profile', ['controller' => 'AccountController', 'action' => 'edit_profile']);
$router->add('account/change-password', ['controller' => 'AccountController', 'action' => 'change_password']);
$router->add('account/change-password-post', ['controller' => 'AccountController', 'action' => 'change_password_post']);
$router->add('account/complete-profile', ['controller' => 'AccountController', 'action' => 'complete_profile']);
$router->add('account/postCompleteProfile', ['controller' => 'AccountController', 'action' => 'postCompleteProfile']);
$router->add('account/enroll-new-course', ['controller' => 'AccountController', 'action' => 'enroll_new_course']);
$router->add('account/enroll-new-course-post', ['controller' => 'AccountController', 'action' => 'enroll_new_course_post']);
$router->add('account/my-courses/make-payment/{id:\d+}', ['controller' => 'AccountController', 'action' => 'make_payment']);
$router->add('account/my-courses/make-payment/post', ['controller' => 'AccountController', 'action' => 'make_payment_post']);
$router->add('account/payment-submitted', ['controller' => 'AccountController', 'action' => 'payment_submitted']);
$router->add('account/my-courses/delete/{id:\d+}', ['controller' => 'AccountController', 'action' => 'delete_enrollment']);
$router->add('getBatches', ['controller' => 'AccountController', 'action' => 'getBatches']);
$router->add('getCoursesByType', ['controller' => 'AccountController', 'action' => 'getCoursesByType']);
$router->add('getTerms', ['controller' => 'AccountController', 'action' => 'getTermsByCourse']);




$router->add('registration-student', ['controller' => 'HomeController', 'action' => 'registercoursestudent']);
$router->add('add-suggestion', ['controller' => 'HomeController', 'action' => 'SuggestionInsert']);
$router->add('add-contact', ['controller' => 'HomeController', 'action' => 'Insert_Contact']);

// courses static pages
$router->add('course/best-graphic-design-course-in-mirpur-azad-kashmir-pakistan', ['controller' => 'HomeController', 'action' => 'graphiccourse']);
$router->add('course/become-video-editing-social-media-star', ['controller' => 'HomeController', 'action' => 'videoCourse']);
$router->add('course/best-game-development-course-in-mirpur-ajk-pakistan', ['controller' => 'HomeController', 'action' => 'gameCourse']);
$router->add('course/basic-computer-course', ['controller' => 'HomeController', 'action' => 'basicComputer']);

$router->add('course/php-programming-course', ['controller' => 'HomeController', 'action' => 'phpCourse']);
$router->add('course/best-web-development-programming-course-in-pakistan', ['controller' => 'HomeController', 'action' => 'phpCourse']);
$router->add('course/best-php-programming-course-in-mirpur-azad-kashmir-pakistan', ['controller' => 'HomeController', 'action' => 'phpCourse']);
$router->add('course/new-course', ['controller' => 'HomeController', 'action' => 'newCourse']);
$router->add('course/{slug}', ['controller' => 'HomeController', 'action' => 'course']);

// admin routes
$admin_dir = \App\Config::ADMIN_PATH;

$router->add($admin_dir, ['controller' => 'AdminController', 'action' => 'index']);
$router->add($admin_dir . '/', ['controller' => 'AdminController', 'action' => 'index']);
$router->add($admin_dir . '/dashboard', ['controller' => 'AdminController', 'action' => 'index']);

// login Routes
$router->add($admin_dir . '/login', ['controller' => 'LoginController', 'action' => 'show']);
$router->add($admin_dir . '/post-login', ['controller' => 'LoginController', 'action' => 'post']);
$router->add($admin_dir . '/logout', ['controller' => 'LoginController', 'action' => 'logout']);

// StudentsController Routes
$router->add($admin_dir . '/students/manage', ['controller' => 'StudentsController', 'action' => 'manage']);
$router->add($admin_dir . '/students/search_student', ['controller' => 'StudentsController', 'action' => 'search_students']);
$router->add($admin_dir . '/students/view-profile/{id:\d+}', ['controller' => 'StudentsController', 'action' => 'view_student']);
$router->add($admin_dir . '/students/add-new-student', ['controller' => 'StudentsController', 'action' => 'add_new_student']);
$router->add($admin_dir . '/students/add_new_student_post', ['controller' => 'StudentsController', 'action' => 'add_new_student_post']);
$router->add($admin_dir . '/students/edit-student/{id:\d+}', ['controller' => 'StudentsController', 'action' => 'edit_student']);
$router->add($admin_dir . '/students/edit_student_post', ['controller' => 'StudentsController', 'action' => 'edit_student_post']);
$router->add($admin_dir . '/students/delete-student/{id:\d+}', ['controller' => 'StudentsController', 'action' => 'delete_student']);
$router->add($admin_dir . '/students/fetch__image', ['controller' => 'StudentsController', 'action' => 'fetch__image']);

// Teacher Routes
$router->add($admin_dir . '/teachers/manage', ['controller' => 'TeachersController', 'action' => 'manage']);
$router->add($admin_dir . '/teachers/add-new-teacher', ['controller' => 'TeachersController', 'action' => 'add_new_teacher']);
$router->add($admin_dir . '/teachers/add_new_teacher_post', ['controller' => 'TeachersController', 'action' => 'add_new_teacher_post']);
$router->add($admin_dir . '/teachers/edit-teacher/{id:\d+}', ['controller' => 'TeachersController', 'action' => 'edit_teacher']);
$router->add($admin_dir . '/teachers/edit_teacher_post', ['controller' => 'TeachersController', 'action' => 'edit_teacher_post']);
$router->add($admin_dir . '/teachers/delete-teacher/{id:\d+}', ['controller' => 'TeachersController', 'action' => 'delete_teacher   ']);
$router->add($admin_dir . '/teachers/fetch__image', ['controller' => 'TeachersController', 'action' => 'fetch__image']);

// Courses Routes
$router->add($admin_dir . '/courses/manage', ['controller' => 'CoursesController', 'action' => 'manage']);
$router->add($admin_dir . '/courses/view-course/{id:\d+}', ['controller' => 'CoursesController', 'action' => 'view_course']);
$router->add($admin_dir . '/courses/add-new-course', ['controller' => 'CoursesController', 'action' => 'add_new_course']);
$router->add($admin_dir.'/courses/add-new-course-post', ['controller' => 'CoursesController', 'action' => 'add_new_course_post']);
$router->add($admin_dir.'/courses/edit-course/{id:\d+}', ['controller' => 'CoursesController', 'action' => 'edit_course']);
$router->add($admin_dir.'/courses/edit-course-post', ['controller' => 'CoursesController', 'action' => 'edit_course_post']);

// Courses content routes
$router->add($admin_dir.'/courses/view-course/post-content', ['controller' => 'CoursesController', 'action' => 'new_content']);
$router->add($admin_dir.'/courses/view-course/edit-content', ['controller' => 'CoursesController', 'action' => 'edit_content']);
$router->add($admin_dir.'/courses/view-course/delete-content/{id:\d+}', ['controller' => 'CoursesController', 'action' => 'delete_content']);

// Courses TAC routes
$router->add($admin_dir.'/courses/view-course/post-tac', ['controller' => 'CoursesController', 'action' => 'post_tac']);
$router->add($admin_dir.'/courses/view-course/delete-tac/{id:\d+}', ['controller' => 'CoursesController', 'action' => 'delete_tac']);

$router->add($admin_dir.'/courses/view-course/post-learn', ['controller' => 'CoursesController', 'action' => 'post_learn']);
$router->add($admin_dir.'/courses/view-course/delete-learn/{id:\d+}', ['controller' => 'CoursesController', 'action' => 'delete_learn']);


// Batches Routes
$router->add($admin_dir.'/batches/manage', ['controller' => 'BatchesController', 'action' => 'manage']);
$router->add($admin_dir.'/batches/getBatches', ['controller' => 'BatchesController', 'action' => 'get__batches']);

$router->add($admin_dir.'/batches/view-batches/{id:\d+}', ['controller' => 'BatchesController', 'action' => 'view_batches']);
$router->add($admin_dir.'/batches/add-new-batch-post', ['controller' => 'BatchesController', 'action' => 'add_new_batch_post']);
$router->add($admin_dir.'/batches/edit-batch/{id:\d+}', ['controller' => 'BatchesController', 'action' => 'show_edit_form']);
$router->add($admin_dir.'/batches/delete-batch/{id:\d+}', ['controller' => 'BatchesController', 'action' => 'delete_batch']);
$router->add($admin_dir.'/batches/edit-batch-post', ['controller' => 'BatchesController', 'action' => 'edit_batch_post']);
$router->add($admin_dir.'/batches/change_status/{eid:\d+}/{sid:\d+}', ['controller' => 'BatchesController', 'action' => 'change_status']);
$router->add($admin_dir.'/batches/delete_enroll/{eid:\d+}', ['controller' => 'BatchesController', 'action' => 'delete_enroll']);

// Enrollments
$router->add($admin_dir.'/enrollments/manage', ['controller' => 'EnrollmentsController', 'action' => 'manage']);
$router->add($admin_dir.'/enrollments/change_status/{id:\d+}', ['controller' => 'EnrollmentsController', 'action' => 'changeStatus']);
// pending enrollments
$router->add($admin_dir.'/enrollments/pending_manage', ['controller' => 'EnrollmentsController', 'action' => 'pending_manage']);
$router->add($admin_dir.'/enrollments/change_status_paid/{id:\d+}', ['controller' => 'EnrollmentsController', 'action' => 'changeStatusPaid']);
// add new enrollments
$router->add($admin_dir.'/enrollments/add_new_enrollments', ['controller' => 'EnrollmentsController', 'action' => 'add_new_enrollments']);
$router->add($admin_dir.'/enrollments/add-new-enrollment-post', ['controller' => 'EnrollmentsController', 'action' => 'add_new_enrollment_post']);

//EXPENSE ROUTES
$router->add($admin_dir.'/expense/manage', ['controller' => 'ExpensesController', 'action' => 'manage']);
$router->add($admin_dir.'/expense/add-new-expense', ['controller' => 'ExpensesController', 'action' => 'add_new_expense_post']);
$router->add($admin_dir.'/expense/delete-expense/{id:\d+}', ['controller' => 'ExpensesController', 'action' => 'delete_expense']);

// Reviews Routes
$router->add($admin_dir.'/reviews/manage', ['controller' => 'ReviewController', 'action' => 'manage']);
$router->add($admin_dir.'/reviews/add-new-review', ['controller' => 'ReviewController', 'action' => 'add_new_reviews_post']);
$router->add($admin_dir.'/reviews/delete-review/{id:\d+}', ['controller' => 'ReviewController', 'action' => 'delete_review']);
$router->add($admin_dir.'/reviews/update-review', ['controller' => 'ReviewController', 'action' => 'update_view_post']);

// FAQS
$router->add($admin_dir.'/faqs/manage', ['controller' => 'FaqsController', 'action' => 'manage']);
$router->add($admin_dir.'/faqs/delete/{id:\d+}', ['controller' => 'FaqsController', 'action' => 'faqs_delete']);
$router->add($admin_dir.'/faqs/add-new-faqs', ['controller' => 'FaqsController', 'action' => 'add_new_faqs_post']);
$router->add($admin_dir.'/faqs/update-faqs', ['controller' => 'FaqsController', 'action' => 'update_faqs']);

//Notification
$router->add($admin_dir.'/notification/manage', ['controller' => 'NotificationController', 'action' => 'manage']);
$router->add($admin_dir.'/notification/delete-notification/{id:\d+}', ['controller' => 'NotificationController', 'action' => 'delete_Notifications']);
$router->add($admin_dir.'/notification/edit-new-notification-post', ['controller' => 'NotificationController', 'action' => 'edit_new_notification_post']);

//Feedback
$router->add($admin_dir.'/feedback/manage', ['controller' => 'FeedbackController', 'action' => 'manage']);
$router->add($admin_dir.'/feedback/delete-feedback/{id:\d+}', ['controller' => 'FeedbackController', 'action' => 'delete_Feedback']);


$router->add($admin_dir.'/change-password', ['controller' => 'AdminController', 'action'=>'change_password']);
$router->add($admin_dir.'/change-password-post', ['controller' => 'AdminController', 'action'=>'change_password_post']);

//contact_Message
$router->add($admin_dir.'/contact/manage', ['controller' => 'ContactController', 'action' => 'manage']);
$router->add($admin_dir.'/contact/delete-contact/{id:\d+}', ['controller' => 'ContactController', 'action' => 'delete_Contact']);

$router->add($admin_dir.'/user-management', ['controller' => 'AdminController', 'action'=>'manage_user']);
$router->add($admin_dir.'/user-management-post', ['controller' => 'AdminController', 'action'=>'manage_user_post']);
$router->add($admin_dir.'/delete-user/{id:\d+}', ['controller' => 'AdminController', 'action'=>'delete_user']);

// backup db route
$router->add($admin_dir.'/backup-db', ['controller' => 'BackupController', 'action' => 'index']);
$router->add($admin_dir.'/create-backup', ['controller' => 'BackupController', 'action' => 'create_backup']);

// secure fetching route
$router->add('getImage', ['controller' => 'FetchDataController', 'action' => 'FetchImage']);
$router->add($admin_dir . '/download-backup', ['controller' => 'FetchDataController', 'action' => 'FetchBackup']);


//gallery
$router->add($admin_dir . '/gallery/manage', ['controller' => 'GalleryController', 'action' => 'manage']);
$router->add($admin_dir . '/gallery/delete/{id:\d+}', ['controller' => 'GalleryController', 'action' => 'delete_gallery']);
$router->add($admin_dir . '/gallery/add-new-gallery', ['controller' => 'GalleryController', 'action' => 'add_new_gallery_post']);

// cron jobs routes
$router->add('cron_job/FeeReminder', ['controller' => 'CronJobController', 'action' => 'sendAfter48Hours']);
$router->add('cron_job/CourseReminder', ['controller' => 'CronJobController', 'action' => 'sendBefore24Hours']);


$router->dispatch($_SERVER['QUERY_STRING']);