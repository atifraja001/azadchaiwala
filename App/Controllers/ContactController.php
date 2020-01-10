<?php


namespace App\Controllers;

use Core\View;
class ContactController
{
    public function __construct()
    {
        Auth('admin');
    }
    public function manage(){
        $contact = new \App\Models\ContactMessage();
        $contacts = $contact->getContact();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['contact'=>'active']);
        View::render('backend/management/contact_messages/manage_contact_message.html', [
            'contacts' => $contacts,
        ]);
        View::render('backend/layouts/script.html');
    }

    public function delete_Contact($request){
        $contact = new \App\Models\ContactMessage();
        $contacts = $contact->DeletemessageContent($request['id']);
        if($contacts){
            redirectWithMessage(app_url('admin').'/contact/manage', 'Contact Message Deleted!', 'contact');
        }else{
            redirectWithMessage(app_url('admin').'/contact/manage', 'Something wents Wrong!', 'contact', 'error');
        }
    }

}