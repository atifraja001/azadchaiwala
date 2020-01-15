<?php


namespace App\Controllers;
use Core\View;
use Coderatio\SimpleBackup\SimpleBackup;
class BackupController
{
    public function __construct()
    {
        Auth('admin');
    }
    public function index(){
        $dir = '../db_backups/';
        $counter = 1;
        if (is_dir($dir)) {
            $files = scandir($dir);
            rsort($files);
            foreach ($files as $file){
                if ($file == '.' or $file == '..') continue;
                if($counter == 11) break;

                $db[$counter]['name'] = $file;
                $db[$counter]['time'] = filemtime($dir.$file);
                $db[$counter]['file_size'] = filesize($dir.$file);
                $counter++;
            }
        }
        usort($db, function($a, $b) {
            return $b['time'] <=> $a['time'];
        });
        View::render('backend/layouts/head.html');
        View::render('backend/layouts/navbar.html', ['dashboard'=>'active']);
        View::render('backend/backup_db.html', ['db_files' => $db]);
        View::render('backend/layouts/script.html');
    }

    public function create_backup(){
        if($_SESSION['admin_role'] != "admin") die;
        $db_name = \App\Config::DB_NAME;
        $db_user = \App\Config::DB_USER;
        $db_password = \App\Config::DB_PASSWORD;
        $db_host = \App\Config::DB_HOST;

        $simpleBackup = SimpleBackup::setDatabase([$db_name, $db_user, $db_password, $db_host])
            ->storeAfterExportTo('../db_backups/', time().'_azadchaiwala_'.uniqid());
    }
}