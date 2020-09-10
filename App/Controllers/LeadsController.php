<?php


namespace App\Controllers;

use App\Models\Leads;
use Core\View;

class LeadsController
{
    public function __construct()
    {
        Auth('admin');
    }
    public function manage(){
        $lead_type = (isset($_GET['lead_type'])) ? $_GET['lead_type']: "";
        $lead_name = (isset($_GET['lead_name'])) ? $_GET['lead_name']: "";
        $lead = new Leads();
        $l = $lead->getLeads($lead_type, $lead_name);
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['leads'=>'active']);
        View::render('backend/management/leads/manage.html',
            ['leads' => $l, 'lead_type' => $lead_type, 'lead_name' => $lead_name]);
        View::render('backend/layouts/script.html');
    }
    public function sendMail(){
        $lead_type = $_POST['lead_type'];
        $lead_name = $_POST['lead_name'];
        $_POST['subject'];
        $_POST['body'];
        $lead = new Leads();
        $leads = $lead->getLeads($lead_type, $lead_name);
        $email = new EmailController();
        foreach ($leads as $l){
            $subject = str_replace('%name%', $l['name'], $_POST['subject']);
            $subject = str_replace('%email%', $l['email'], $subject);
            $body = str_replace('%name%', $l['name'], $_POST['body']);
            $body = str_replace('%email%', $l['email'], $body);
            $email->sendEmail('leadEmail', [
                'email_to' => $l['email'],
                'subject' => $subject,
                'body' => $body
            ]);
        }
        redirectWithMessage(app_url('admin') . '/leads/manage?lead_type='.$lead_type.'&lead_name='.$lead_name, 'Email Sent to the Lead', 'leads');
    }
}