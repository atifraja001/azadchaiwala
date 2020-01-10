<?php


namespace App\Controllers;

use Core\View;

class NotificationController
{

    public function __construct()
    {
        Auth('admin');
    }

    public function manage(){
        $noti = new \App\Models\Notifications();
        $notis = $noti->getNotification();
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['notification'=>'active']);
        View::render('backend/management/notification/manage_notification.html', [
            'notification' => $notis
        ]);
        View::render('backend/layouts/script.html');
    }

    //delete Notification
    public function delete_Notifications($request){
        $notification = new \App\Models\Notifications();
        $not = $notification->delete_notification($request['id']);
        if($not){
            redirectWithMessage(app_url('admin').'/notification/manage', 'Notification Deleted Successfully', 'notification');
        }else{
            redirectWithMessage(app_url('admin').'/notification/manage', 'Unable to delete Notification information please contact developers', 'notification', 'error');
        }
    }
    public function edit_new_notification_post($request){
        // preparing data
        $data = [
            ':message' => clean_post('message'),
        ];

        $notification = new \App\Models\Notifications();
        $notification->edit_notification($data);
        redirectWithMessage(
            app_url('admin').'/notification/manage',
            'Notification Updated Successfully',
            'notification');
    }
}




