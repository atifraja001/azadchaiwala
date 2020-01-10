<?php


namespace App\Controllers;

use Core\View;

class FaqsController
{

    public function __construct()
    {
        Auth('admin');
    }

    public function manage(){
        $faq = new \App\Models\Faqs();
        $faqs = $faq->getFaqs();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['faqs'=>'active']);
        View::render('backend/management/faqs/manage_faqs.html', [
            'faqs' => $faqs
        ]);
        View::render('backend/layouts/script.html');
    }
    //Delete faqs
    public function faqs_delete($request){
        $faqs = new \App\Models\Faqs();
        $faq = $faqs->DeleteFaqsContent($request['id']);
        if($faq){
            redirectWithMessage(app_url('admin').'/faqs/manage', 'Faqs Deleted Successfully', 'faqs');
        }else{
            redirectWithMessage(app_url('admin').'/faqs/manage', 'Unable to delete Faqs information please contact developers', 'faqs', 'error');
        }
    }

    public function add_new_faqs_post(){

        // preparing data
        $data = [
            ':title' => clean_post('title'),
            ':description' => clean_post('description'),
        ];

        $expense = new \App\Models\Faqs();
        $expense->InsertFaqs($data);
        redirectWithMessage(
            app_url('admin').'/faqs/manage',
            'New Faqs Created Successfully',
            'faqs');
    }

    public function update_faqs(){
        // Preparing data
        $faqs = new \App\Models\Faqs();
            $data = [
                ':title' => clean_post('title'),
                ':description' => clean_post('description'),
                ':id' => clean_post('id')
            ];
            $faq = $faqs->update_faqs($data);

        if($faq){
            redirectWithMessage(app_url('admin').'/faqs/manage', 'FAQS Updated Successfully', 'faqs');
        }else{
            redirectWithMessage(app_url('admin').'/faqs/manage', 'Something Went\'s Wrong!', 'faqs', 'error');
        }
    }

}