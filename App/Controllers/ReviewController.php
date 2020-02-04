<?php


namespace App\Controllers;

use Core\View;
class ReviewController
{
    public function __construct()
    {
        Auth('admin');
    }

    public function manage(){
        $reviews = new \App\Models\Reviews();
        $reviews = $reviews->getReviews();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['review'=>'active']);
        View::render('backend/management/reviews/manage_reviews.html', [
            'reivews' => $reviews
        ]);
        View::render('backend/layouts/script.html');
    }
    public function add_new_reviews_post(){
        // Preparing data
        $picture = $this->UploadPersonImage();
        $data = [
            ':person_name' => clean_post('person_name'),
            ':person_image' => $picture,
            ':description' => clean_post('description')
        ];
        $reviews = new \App\Models\Reviews();
        $reviews = $reviews->add_new_review($data);
        if($reviews){
            redirectWithMessage(app_url('admin').'/reviews/manage', 'Review Added Successfully', 'review');
        }else{
            redirectWithMessage(app_url('admin').'/reviews/manage', 'Something Went\'s Wrong!', 'review', 'error');
        }
    }
    protected function UploadPersonImage(){
        $response = uploadfile('person_image', '../content/review_images',
            2, array('image/jpeg', 'image/gif', 'image/png'), true);
        if($response == "invalid_image"){
            redirectWithMessage(app_url('admin').'/reviews/manage', 'Invalid Image File', 'enrollment', 'error');
        }else if($response == "invalid_size"){
            redirectWithMessage(app_url('admin').'/reviews/manage', 'Image is too larger to upload', 'enrollment', 'error');
        }else if($response == "not_uploaded"){
            redirectWithMessage(app_url('admin').'/reviews/manage', 'something went\'s wrong!', 'enrollment', 'error');
        }
        return $response;
    }
    public function delete_review($request){
        // preparing data
        $data = [
            ':id' => $request['id']
        ];
        $reviews = new \App\Models\Reviews();
        $reviews = $reviews->delete_review($data);
        if($reviews){
            redirectWithMessage(app_url('admin').'/reviews/manage', 'Review deleted Successfully', 'review');
        }else{
            redirectWithMessage(app_url('admin').'/reviews/manage', 'Something Went\'s Wrong!', 'review', 'error');
        }
    }
    public function update_view_post(){
        // Preparing data
        $reviews = new \App\Models\Reviews();
        if(!empty($_FILES['person_image']['name'])){
            $picture = $this->UploadPersonImage();
            $data = [
                ':person_name' => clean_post('person_name'),
                ':person_image' => $picture,
                ':description' => clean_post('description'),
                ':id' => clean_post('id')
            ];
            $reviews = $reviews->update_review($data, true);
        }else{
            $data = [
                ':person_name' => clean_post('person_name'),
                ':description' => clean_post('description'),
                ':id' => clean_post('id')
            ];
            $reviews = $reviews->update_review($data, false);
        }
        if($reviews){
            redirectWithMessage(app_url('admin').'/reviews/manage', 'Review Updated Successfully', 'review');
        }else{
            redirectWithMessage(app_url('admin').'/reviews/manage', 'Something Went\'s Wrong!', 'review', 'error');
        }
    }
}