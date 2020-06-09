<?php


namespace App\Controllers;

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
            $subject = 'Thank You for Registration - Azad Chaiwala Institute';
            $content = $this->NewRegistration($data['course']);
        }else if($type == "contact"){
            /*
             * Required {name, email, subject, message}
             */
            $to = \App\Config::EMAIL; // send to admin
            $subject = 'Contact Message - Azad Chaiwala Institute';
            $content = $this->ContactUs($data['name'], $data['email'], $data['subject'], $data['message']);
        }else if($type == "feedback"){
            /*
             * Required {name, email, course, message}
             */
            $to = \App\Config::EMAIL; // send to admin
            $subject = 'Course Feedback - Azad Chaiwala Institute';
            $content = $this->feedback($data['name'], $data['email'], $data['course'], $data['message']);
        }else if ($type == 'registration_verify') {
            /*
             * Required {email_to, start_date, course}
             */
            $to = $data['email_to']; // send to user
            $subject = 'Your Registration Verified - Azad Chaiwala Institute';
            $content = $this->RegistrationVerified($data['start_date'], $data['course']);
        } else if ($type == "registration_rejected") {
            /*
             * Required {email_to, course}
             */
            $to = $data['email_to']; // send to user
            $subject = 'Your Registration Rejected - AzadChaiwala.pk';
            $content = $this->RegistrationRejected($data['course']);
        } else if ($type == "batch") {
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
        }else if($type == 'create_account'){
            $to = $data['email_to']; // send to user
            $subject = 'Verify Your Email - Azad Chaiwala Institute';
            $content = $this->create_account($data['name'], $data['token']);
        }else if($type == 'fee_reminder'){
            /*
             * Required {email}
             */
            $to = $data['email_to']; // send to user
            $subject = 'Fee Reminder from Azad Chaiwala Institute';
            $content = $this->fee_reminder();
        }else if($type == 'course_reminder'){
            /*
             * Required {course, date, time}
             */
            $to = $data['email_to']; // send to user
            $subject = 'Class Reminder from Azad Chaiwala Institute';
            $content = $this->course_reminder($data['course'], $data['course_date'], $data['course_time']);
        }
        // Email Headers Settings
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Azad Chaiwala Institute <'.$from.">\r\n".
            'Reply-To: Azad Chaiwala Institute <'.$from.">\r\n" .
            'X-Mailer: PHP/' . phpversion();
        if(mail($to, $subject, $content, $headers)){
            return true;
        } else{
            return false;
        }
    }

    protected function create_account($name, $token){
        $content = file_get_contents("../App/Views/email_templates/create_account.html");
        $content = str_replace(":name", $name, $content);
        $content = str_replace(":token", $token, $content);
        $content = str_replace(":year", date('Y'), $content);
        return $content;
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
    protected function RegistrationRejected($course){
        $content = file_get_contents("../App/Views/email_templates/registration_rejected.html");
        $content = str_replace(":course", $course, $content);
        $content = str_replace(":year", date('Y'), $content);
        return $content;
    }
    protected function BatchMail($message){
        $content = file_get_contents("../App/Views/email_templates/batch_mail.html");
        $content = str_replace(":message", $message, $content);
        $content = str_replace(":year", date('Y'), $content);
        return $content;
    }
    protected function fee_reminder(){
        $content = file_get_contents("../App/Views/email_templates/fee_reminder.html");
        $content = str_replace(":year", date('Y'), $content);
        return $content;
    }
    protected function course_reminder($course, $date, $time){
        $content = file_get_contents("../App/Views/email_templates/course_reminder.html");
        $content = str_replace(":course_name", $course, $content);
        $content = str_replace(":course_date", $date, $content);
        $content = str_replace(":course_time", $time, $content);
        $content = str_replace(":year", date('Y'), $content);
        return $content;
    }

}