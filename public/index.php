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
$router->add('courses', ['controller' => 'HomeController', 'action' => 'courses']);
$router->add('payments', ['controller' => 'HomeController', 'action' => 'payments']);
$router->add('about', ['controller' => 'HomeController', 'action' => 'about']);
$router->add('contact', ['controller' => 'HomeController', 'action' => 'contact']);
$router->add('gallery', ['controller' => 'HomeController', 'action' => 'gallery']);
$router->add('course-registration/{slug}', ['controller' => 'HomeController', 'action' => 'course-registration']);
$router->add('course/{slug}', ['controller' => 'HomeController', 'action' => 'course']);
$router->add('registration-student', ['controller' => 'HomeController', 'action' => 'registercoursestudent']);
$router->add('add-suggestion', ['controller' => 'HomeController', 'action' => 'SuggestionInsert']);
$router->add('add-contact', ['controller' => 'HomeController', 'action' => 'Insert_Contact']);

// courses static pages
$router->add('graphic-design-course', ['controller'=>'HomeController', 'action'=>'graphiccourse']);

 
// admin routes
$admin_dir = \App\Config::ADMIN_PATH;

$router->add($admin_dir, ['controller' => 'AdminController', 'action' => 'index']);
$router->add($admin_dir.'/', ['controller' => 'AdminController', 'action' => 'index']);
$router->add($admin_dir.'/dashboard', ['controller' => 'AdminController', 'action' => 'index']);

// login Routes
$router->add($admin_dir.'/login', ['controller' => 'LoginController', 'action' => 'show']);
$router->add($admin_dir.'/post-login', ['controller' => 'LoginController', 'action' => 'post']);
$router->add($admin_dir.'/logout', ['controller' => 'LoginController', 'action' => 'logout']);

// StudentsController Routes
$router->add($admin_dir.'/students/manage', ['controller' => 'StudentsController', 'action' => 'manage']);
$router->add($admin_dir.'/students/search_student', ['controller' => 'StudentsController', 'action' => 'search_students']);
$router->add($admin_dir.'/students/view-profile/{id:\d+}', ['controller' => 'StudentsController', 'action' => 'view_student']);
$router->add($admin_dir.'/students/add-new-student', ['controller' => 'StudentsController', 'action' => 'add_new_student']);
$router->add($admin_dir.'/students/add_new_student_post', ['controller' => 'StudentsController', 'action' => 'add_new_student_post']);
$router->add($admin_dir.'/students/edit-student/{id:\d+}', ['controller' => 'StudentsController', 'action' => 'edit_student']);
$router->add($admin_dir.'/students/edit_student_post', ['controller' => 'StudentsController', 'action' => 'edit_student_post']);
$router->add($admin_dir.'/students/delete-student/{id:\d+}', ['controller' => 'StudentsController', 'action' => 'delete_student']);
$router->add($admin_dir.'/students/fetch__image', ['controller' => 'StudentsController', 'action' => 'fetch__image']);

// Teacher Routes
$router->add($admin_dir.'/teachers/manage', ['controller' => 'TeachersController', 'action' => 'manage']);
$router->add($admin_dir.'/teachers/add-new-teacher', ['controller' => 'TeachersController', 'action' => 'add_new_teacher']);
$router->add($admin_dir.'/teachers/add_new_teacher_post', ['controller' => 'TeachersController', 'action' => 'add_new_teacher_post']);
$router->add($admin_dir.'/teachers/edit-teacher/{id:\d+}', ['controller' => 'TeachersController', 'action' => 'edit_teacher']);
$router->add($admin_dir.'/teachers/edit_teacher_post', ['controller' => 'TeachersController', 'action' => 'edit_teacher_post']);
$router->add($admin_dir.'/teachers/delete-teacher/{id:\d+}', ['controller' => 'TeachersController', 'action' => 'delete_teacher   ']);
$router->add($admin_dir.'/teachers/fetch__image', ['controller' => 'TeachersController', 'action' => 'fetch__image']);

// Courses Routes
$router->add($admin_dir.'/courses/manage', ['controller' => 'CoursesController', 'action' => 'manage']);
$router->add($admin_dir.'/courses/view-course/{id:\d+}', ['controller' => 'CoursesController', 'action' => 'view_course']);
$router->add($admin_dir.'/courses/add-new-course', ['controller' => 'CoursesController', 'action' => 'add_new_course']);
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
$router->add($admin_dir.'/batches/change_status/{bid:\d+}/{eid:\d+}/{sid:\d+}', ['controller' => 'BatchesController', 'action' => 'change_status']);
$router->add($admin_dir.'/batches/delete_enroll/{bid:\d+}/{eid:\d+}', ['controller' => 'BatchesController', 'action' => 'delete_enroll']);

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
$router->add('getImage', ['controller'=>'FetchDataController', 'action'=>'FetchImage']);
$router->add($admin_dir.'/download-backup', ['controller' => 'FetchDataController', 'action' => 'FetchBackup']);


//gallery
$router->add($admin_dir.'/gallery/manage', ['controller' => 'GalleryController', 'action' => 'manage']);
$router->add($admin_dir.'/gallery/delete/{id:\d+}', ['controller' => 'GalleryController', 'action' => 'delete_gallery']);
$router->add($admin_dir.'/gallery/add-new-gallery', ['controller' => 'GalleryController', 'action' => 'add_new_gallery_post']);

$router->dispatch($_SERVER['QUERY_STRING']);