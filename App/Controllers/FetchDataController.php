<?php


namespace App\Controllers;

/*
 * Parameters
 * Get Method:
 * i for id of the row in table --required
 * t for type of the image which specify from which location it need to pick the image.
 * syntax: app_url()/getImage?i={id}&t={type}
 * Syntax Example: app_url()/getImage?i=1&t=course
 *
 * [
 *    Available Type
 *    {course}
 *    {enroll}
 *    {review}
 *    {student}
 *    {teacher}
 * ]
 * @returns
 * requested image.
 * default image in case of image not found in directory and in database.
 * or the request is invalid
 */

class FetchDataController
{
    public function __construct()
    {

    }
    public function FetchImage(){
        $image_id = clean_get('i');
        $image_type = clean_get('t');
        $filename = "assets/img/no_image.png"; // default filename
        if(!empty($image_id) && !empty($image_type)){
            if($image_type == "course"){
                $course_image = new \App\Models\Courses();
                $course_image = $course_image->getCourseImageById($image_id);
                if($course_image) {
                    $filename = "assets/course_images/".$course_image['course_picture'];
                }
            }else if($image_type == "enroll"){
                $enroll_image = new \App\Models\Enrollments();
                $enroll_image = $enroll_image->getEnrollImageById($image_id);
                if($enroll_image) {
                    $filename = "assets/enrollment_images/" . $enroll_image['fee_receipt'];
                }
            }else if($image_type == "review"){
                $review_image = new \App\Models\Reviews();
                $review_image = $review_image->GetReviewImageById($image_id);
                if($review_image) {
                    $filename = "assets/review_images/" . $review_image['person_image'];
                }
            }else if($image_type == "student"){
                $student_image = new \App\Models\Students();
                $student_image = $student_image->GetStudentImageById($image_id);
                if($student_image) {
                    $filename = "assets/student_images/".$student_image['picture'];
                }
            }else if($image_type == "teacher"){
                $teacher_image = new \App\Models\Teachers();
                $teacher_image = $teacher_image->GetTeacherImageById($image_id);
                if($teacher_image) {
                    $filename = "assets/teacher_images/".$teacher_image['picture'];
                }
            }else if($image_type == "gallery"){
                $gallery_image = new \App\Models\Gallery();
                $gallery_image = $gallery_image->GetGalleryImageById($image_id);
                if($gallery_image) {
                    $filename = "assets/gallery_images/".$gallery_image['image'];
                }
            }
        }
        if(!file_exists($filename)){
            $filename = "assets/img/no_image.png";
        }
        $handle = fopen($filename, "rb");
        $contents = fread($handle, filesize($filename));
        fclose($handle);
        header("content-type: image/jpeg");
        echo $contents;
    }

    public function FetchBackup(){
        Auth('admin');
        $db_id = clean_get('i');
        $dir = '../db_backups/';
        $counter = 1;
        if (is_dir($dir)) {
            $files = scandir($dir);
            rsort($files);
            foreach ($files as $file){
                if ($file == '.' or $file == '..') continue;
                if($counter == 11) break;
                    if(filemtime($dir.$file) == $db_id){
                        $filename = $dir.$file;
                        $file = date("d_m_Y_h_i_s_a", filemtime($dir.$file)).".sql";
                        $handle = fopen($filename, "rb");
                        if(filesize($filename) > 0) {
                            $contents = fread($handle, filesize($filename));
                            fclose($handle);
                            header("Content-disposition: attachment; filename=\"" . basename($file) . "\"");
                            header("content-type: application/sql");
                            echo $contents;
                        }
                        break;
                    }
                    $counter++;
            }
        }

    }
}