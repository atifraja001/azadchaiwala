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
        $file_names = array();
        $file_names = multiUploadFile('gallery_picture', '../content/gallery_images', 5);
        $gl = new \App\Models\Gallery();

        if(count($file_names) > 0) {
            foreach ($file_names as $key => $value){
                // preparing data
                $data = [
                    ':class' => "none",
                    ':gallery_picture' => $value
                ];
                $gl->InsertGallery($data);
            }
            $upload = true;
        }else {
            $upload = false;
        }
        echo json_encode($upload);
    }
}