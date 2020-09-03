<?php


namespace App\Controllers;

use Core\View;
use App\Models\Feedbacks;
class FeedbackController
{
    public function __construct()
    {
        Auth('admin');
    }

    public function manage()
    {
        $feedback = new Feedbacks();
        $feedbacks = $feedback->getFeedbacks();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['feedback' => 'active']);
        View::render('backend/management/feedback/manage_feedback.html', [
            'feedbacks' => $feedbacks
        ]);
        View::render('backend/layouts/script.html');
    }

    public function delete_Feedback($request)
    {
        $feedback = new Feedbacks();
        $feedback_id = $feedback->DeleteFeedbackContent($request['id']); // course id
        if ($feedback_id) {
            redirectWithMessage(app_url('admin') . '/feedback/manage', 'Feedback Deleted!', 'feedback');
        } else {
            redirectWithMessage(app_url('admin') . '/feedback/manage', 'Something wents Wrong!', 'feedback', 'error');
        }
    }
    public function sendFeedbackAdmin($request){
        $feedback = new Feedbacks();
        $feedback = $feedback->getFeedback($request['id']);

    }

}