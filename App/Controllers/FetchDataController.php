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

    public function FetchImage()
    {
        $image_id = clean_get('i');
        $image_type = clean_get('t');
        $filename = "assets/img/no_image.png"; // default filename
        if (!empty($image_id) && !empty($image_type)) {
            if ($image_type == "course") {
                $course_image = new \App\Models\Courses();
                $course_image = $course_image->getCourseImageById($image_id);
                if ($course_image) {
                    $filename = $_SERVER['DOCUMENT_ROOT']."../content/course_images/" . $course_image['course_picture'];
                }
            } else if ($image_type == "enroll") {
                $enroll_image = new \App\Models\Enrollments();
                $enroll_image = $enroll_image->getEnrollImageById($image_id);
                if ($enroll_image) {
                    $filename = "../content/receipt_images/" . $enroll_image['fee_receipt'];
                }
            } else if ($image_type == "review") {
                $review_image = new \App\Models\Reviews();
                $review_image = $review_image->GetReviewImageById($image_id);
                if ($review_image) {
                    $filename = "content/review_images/" . $review_image['person_image'];
                }
            } else if ($image_type == "student") {
                $student_image = new \App\Models\Students();
                $student_image = $student_image->GetStudentImageById($image_id);
                if ($student_image) {
                    $filename = "content/student_images/" . $student_image['picture'];
                }
            } else if ($image_type == "teacher") {
                $teacher_image = new \App\Models\Teachers();
                $teacher_image = $teacher_image->GetTeacherImageById($image_id);
                if ($teacher_image) {
                    $filename = "../content/teacher_images/" . $teacher_image['picture'];
                }
            } else if ($image_type == "gallery") {
                $gallery_image = new \App\Models\Gallery();
                $gallery_image = $gallery_image->GetGalleryImageById($image_id);
                if ($gallery_image) {
                    $filename = "content/gallery_images/" . $gallery_image['image'];
                }
            }
        }
        if (!file_exists($filename)) {
            $filename = "assets/img/no_image.png";
        }
        $handle = fopen($filename, "rb");
        $contents = fread($handle, filesize($filename));
        fclose($handle);
        header("content-type: image/jpeg");
        echo $contents;
    }
}