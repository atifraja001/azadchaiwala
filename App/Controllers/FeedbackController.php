<?php


namespace App\Controllers;

use Core\View;
use App\Models\Feedbacks;
use App\Controllers\EmailController;
use App\Models\Leads;

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

    public function sendFeedbackAdmin($request)
    {
        $feed = new Feedbacks();
        $feedback = $feed->getFeedback($request['id']);
        $feed->MoveToArchive($request['id']);
        $email = new EmailController();
        $email->sendEmail('messageToAdmin', [
            'name' => $feedback['name'],
            'email' => $feedback['email'],
            'message' => $feedback['feedback_text']
        ]);
        redirectWithMessage(app_url('admin') . '/feedback/manage', 'Email Sent! and Message moved to archive', 'feedback');
    }

    public function moveFeedback($request)
    {
        $feed = new Feedbacks();
        $feed->MoveToArchive($request['id']);
        redirectWithMessage(app_url('admin') . '/feedback/manage', 'Message moved to archive', 'feedback');
    }

    public function moveFeedbackToLeads()
    {
        $feed = new Feedbacks();
        $feedback = $feed->getFeedback($_POST['message_id']);
        $leads = new Leads();
        $leads->AddLead($feedback['name'], $feedback['email'], $feedback['feedback_text'], 'Non Paying List', $_POST['lead_name']);
        $feed->MoveToArchive($_POST['message_id']);
        redirectWithMessage(app_url('admin') . '/feedback/manage', 'Added to Leads and Message moved to archive', 'feedback');
    }

}