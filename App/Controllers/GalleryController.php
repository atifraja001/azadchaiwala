<?php


namespace App\Controllers;

use Core\View;

class GalleryController
{
    public function __construct()
    {
        Auth('admin');
    }

    public function manage(){
        $gallery = new \App\Models\Gallery();
        $gallerys = $gallery->getGallery();
        $classes = $gallery->getClass();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['gallery'=>'active']);
        View::render('backend/management/gallery/manage_gallery.html', [
            'gals' => $gallerys,
            'classes' => $classes
        ]);
        View::render('backend/layouts/script.html');
    }

    //Delete faqs
    public function delete_gallery($request){
        $gal = new \App\Models\Gallery();
        $gals= $gal->DeleteGalleryContent($request['id']);
        if($gals){
            redirectWithMessage(app_url('admin').'/gallery/manage', 'Image Deleted Successfully', 'gallery');
        }else{
            redirectWithMessage(app_url('admin').'/gallery/manage', 'Unable to delete Gallery information please contact developers', 'faqs', 'error');
        }
    }

    // add new enrollment post
    public function add_new_gallery_post(){
        // preparing file to upload
        $response = uploadfile('gallery_picture', 'content/gallery_images');
        if($response == "invalid_image"){
            redirectWithMessage(app_url('admin').'/gallery/manage', 'Invalid Image File', 'gallery', 'error');
        }else if($response == "invalid_size"){
            redirectWithMessage(app_url('admin').'/gallery/manage', 'Image is too larger to upload', 'gallery', 'error');
        }else if($response == "not_uploaded"){
            redirectWithMessage(app_url('admin').'/gallery/manage', 'something went\'s wrong!', 'gallery', 'error');
        }else{

            // preparing data
            $data = [
                ':class' => clean_post('class'),
                ':gallery_picture' => $response
            ];

            $gl = new \App\Models\Gallery();
            $gl->InsertGallery($data);

            redirectWithMessage(
                app_url('admin').'/gallery/manage',
                'New Image Created Successfully',
                'gallery');
        }
    }
}