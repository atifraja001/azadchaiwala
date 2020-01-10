<?php


namespace App\Controllers;
use Core\View;

/*
 * Date: 09-01-2020
 * EmailController - Custom Controller to send email using default php mail function. No smtp setting required
 * default email_from and email_to will be set here \App\Config.php
 * email_from is not available in {data} array default will be set.
 * {type} and {data} is required
 * {type} contains following options (this will send the email template located in View\email_templates
 *      - registration
 *      - contact
 *      - feedback
 *      - registration_verify
 *      - batch
 *      - backup
 * {array data} contain multiple options. required are listed with if condition. common list are here.
 *      - {email_from}
 *      - {email_to}
 *
 * @@ RETURNS
 *    sendEmail will return {true} if email sent and {false} if email not sent.
 */



class EmailController
{
    public function sendEmail($type, array $data){
        if(!empty($data['email_from'])){
            $from = $data['email_from'];
        }else{
            $from = \App\Config::EMAIL;
        }
        $subject = $content = $to = "";
        if($type == "registration"){
            /*
             * Required {email_to, course}
             */
            $to = $data['email_to'];
            $subject = 'Thank You for Registration - AzadChaiwala.pk';
            $content = $this->NewRegistration($data['course']);
        }else if($type == "contact"){
            /*
             * Required {name, email, subject, message}
             */
            $to = \App\Config::EMAIL; // send to admin
            $subject = 'New Contact Message from AzadChaiwala.pk';
            $content = $this->ContactUs($data['name'], $data['email'], $data['subject'], $data['message']);
        }else if($type == "feedback"){
            /*
             * Required {name, email, course, message}
             */
            $to = \App\Config::EMAIL; // send to admin
            $subject = 'Course Feedback from AzadChaiwala.pk';
            $content = $this->feedback($data['name'], $data['email'], $data['course'], $data['message']);
        }else if($type == 'registration_verify'){
            /*
             * Required {email_to, start_date, course}
             */
            $to = $data['email_to']; // send to user
            $subject = 'Your Registration Verified - AzadChaiwala.pk';
            $content = $this->RegistrationVerified($data['start_date'], $data['course']);
        }else if($type == "batch"){
            /*
             * Required {message}
             * multiple parameters (OPTIONAL) available in {message}
             * :student_name
             * :email
             * :start_date
             * :end_date
             * :course
             * :start_time
             * :start_time
             * :teacher_name
             */

            $to = $data['email_to']; // send to user
            $subject = 'Notification from AzadChaiwala.pk';
            $content = $this->BatchMail($data['message']);
        }else if($type == 'backup'){
            /*
             * Under development
             */
            $to = \App\Config::EMAIL; // send to admin
            $subject = 'Backup Update from AzadChaiwala.pk';
        }
        // Email Headers Settings
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
        if(mail($to, $subject, $content, $headers)){
            return true;
        } else{
            return false;
        }
    }


    protected function NewRegistration($course){
        $content = file_get_contents("../App/Views/email_templates/new_registration.html");
        $content = str_replace(":course", $course, $content);
        $content = str_replace(":year", date('Y'), $content);
        return $content;
    }
    protected function ContactUs($name, $email, $subject, $message){
        $content = file_get_contents("../App/Views/email_templates/contact_us.html");
        $content = str_replace(":name", $name, $content);
        $content = str_replace(":email", $email, $content);
        $content = str_replace(":subject", $subject, $content);
        $content = str_replace(":message", $message, $content);
        $content = str_replace(":year", date('Y'), $content);
        return $content;
    }

    protected function feedback($name, $email, $course, $message){
        $content = file_get_contents("../App/Views/email_templates/course_feedback.html");
        $content = str_replace(":name", $name, $content);
        $content = str_replace(":email", $email, $content);
        $content = str_replace(":course", $course, $content);
        $content = str_replace(":message", $message, $content);
        $content = str_replace(":year", date('Y'), $content);
        return $content;
    }
    protected function RegistrationVerified($start_date, $course){
        $content = file_get_contents("../App/Views/email_templates/registration_verified.html");
        $content = str_replace(":course", $course, $content);
        $content = str_replace(":start_date", $start_date, $content);
        $content = str_replace(":year", date('Y'), $content);
        return $content;
    }
    protected function BatchMail($message){
        $content = file_get_contents("../App/Views/email_templates/batch_mail.html");
        $content = str_replace(":message", $message, $content);
        $content = str_replace(":year", date('Y'), $content);
        return $content;
    }
}