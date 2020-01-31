<?php
require dirname(__DIR__) . '/vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Azadchaiwala.pk Database</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        .table, tr, td, th{
            padding: 0px !important;
        }
    </style>
</head>
<body>
<div class="row">
    <div class="col-lg-4 offset-lg-4 mt-3">
        <div class="card">
            <div class="card-body">
                <h4>Upgradation Started...</h4>
                <table class="table table-bordered">
                    <tr>
                        <td colspan="2" class="text-center">
                            <label class="alert alert-danger text-center mt-3" style="width: 100%;"><strong>DO NOT CLOSE THIS PAGE V1.2</strong></label>
                        </td>
                    </tr>
                    <?php
                    $db_host = \App\Config::DB_HOST;
                    $db_user = \App\Config::DB_USER;
                    $db_pass = \App\Config::DB_PASSWORD;
                    $db_name = \App\Config::DB_NAME;
                    try {
                        $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        showSuccess("Database Connected!");
                    }catch(PDOException $e){
                        showError($e->getMessage());
                    }
                    try{
                        $db->beginTransaction();
                        showSuccess('Transaction Started');
                        // for table badges or batches
//                        $db->exec('RENAME TABLE badges TO batches;');
//                        $db->exec('ALTER TABLE `batches` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;');
//                        $db->exec('ALTER TABLE `batches` CHANGE `course_id` `course_id` INT(11) NOT NULL;');
//                        $db->exec('ALTER TABLE `batches` CHANGE `start_time` `start_time` TIME NOT NULL;');
//                        $db->exec('ALTER TABLE `batches` CHANGE `end_time` `end_time` TIME NOT NULL;');
//                        $db->exec('ALTER TABLE `batches` CHANGE `total_students` `total_students` TINYINT(4) NOT NULL;');
//                        showSuccess('Batches Table Updated Successfully');
//
//                        // for table contact mails
//                        $db->exec('RENAME TABLE contact_mails TO contact_messages;');
//                        $db->exec('ALTER TABLE `contact_messages` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;');
//                        $db->exec('ALTER TABLE `contact_messages` CHANGE `name` `name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
//                        $db->exec('ALTER TABLE `contact_messages` CHANGE `message` `message_text` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
//                        $db->exec('ALTER TABLE `contact_messages` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `message_text`;');
//                        showSuccess('Contact Mails Table Updated Successfully');

                        // for table Courses
                        //$db->exec('ALTER TABLE `courses` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;');
                        //$db->exec('ALTER TABLE `courses` CHANGE `order_number` `order_number` SMALLINT(6) NOT NULL;');
                        //$db->exec('ALTER TABLE `courses` CHANGE `teacher_id` `teacher_id` INT(11) NOT NULL;');
                        //$db->exec('ALTER TABLE `courses` CHANGE `slug` `slug` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;');
                        //$db->exec('ALTER TABLE `courses` CHANGE `course_picture` `course_picture` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        //$db->exec('ALTER TABLE `courses` CHANGE `course_video` `youtube_embed` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('UPDATE courses SET lecture_hours_per_day = 0');
                        $db->exec('ALTER TABLE `courses` CHANGE `lecture_hours_per_day` `lecture_hours_per_day` INT(11) NOT NULL;');
                        $db->exec('ALTER TABLE `courses` ADD `duration` VARCHAR(50) NOT NULL AFTER `lecture_hours_per_day`;');
                        $db->exec('ALTER TABLE `courses` CHANGE `semester` `semester` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');

                        $q = $db->query("SELECT * FROM courses");
                        $rows = $q->fetchAll();
                        foreach ($rows as $r){
                            $id = $r['id'];
                            $fee = str_replace(',', '', trim($r['fee']));
                            $q1 = $db->prepare('UPDATE courses SET fee = :fee WHERE id = :id');
                            $q1->execute([':fee'=>$fee, ':id' => $id]);
                        }
                        $db->exec('ALTER TABLE `courses` CHANGE `fee` `fee` INT(11) NOT NULL;');
                        $db->exec('ALTER TABLE `courses` CHANGE `course_description` `course_description` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `courses` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `course_description`;');
                        showSuccess('Courses Table Updated Successfully');

                        // for course sections
                        $db->exec('RENAME TABLE course_sections TO course_content;');
                        $db->exec('ALTER TABLE `course_content` CHANGE `csid` `id` BIGINT(20) NOT NULL AUTO_INCREMENT;');
                        $db->exec('ALTER TABLE `course_content` CHANGE `course_id` `course_id` INT(11) NOT NULL;');
                        $db->exec('ALTER TABLE `course_content` CHANGE `section_name` `content_title` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `course_content` CHANGE `lectures` `duration` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `course_content` CHANGE `description` `content_description` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('UPDATE course_content SET total_time = 0');
                        $db->exec('ALTER TABLE `course_content` CHANGE `total_time` `position` TINYINT(2) NOT NULL;');
                        showSuccess('Course Content Table Updated Successfully');

                        // creating new course learn table
                        $db->exec('CREATE TABLE `'.$db_name.'`.`course_learn` ( `id` INT NOT NULL AUTO_INCREMENT , `course_id` INT NOT NULL , `detail` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;');
                        showSuccess('Course Learn Created Successfully');

                        // for course terms and condition table
                        $db->exec('RENAME TABLE course_tac TO course_tc;');
                        $db->exec('ALTER TABLE `course_tc` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;');
                        $db->exec('ALTER TABLE `course_tc` CHANGE `course_id` `course_id` INT(11) NOT NULL;');
                        $db->exec('ALTER TABLE `course_tc` CHANGE `termconditions` `detail` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `course_tc` DROP `created_at`;');
                        showSuccess('Course terms and condition table Updated Successfully');

                        //  for enrollments
                        $db->exec('ALTER TABLE `enrollments` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;');
                        $db->exec('ALTER TABLE `enrollments` CHANGE `badge_id` `batch_id` INT(11) NOT NULL;');
                        $db->exec('ALTER TABLE `'.$db_name.'`.enrollments DROP FOREIGN KEY enrollments_ibfk_2;');
                        $db->exec('ALTER TABLE `enrollments` DROP `course_id`;');
                        $db->exec('ALTER TABLE `enrollments` DROP INDEX `badge_id`;');
                        $db->exec('ALTER TABLE `enrollments` DROP INDEX `student_id`;');
                        $db->exec('ALTER TABLE `enrollments` DROP `course_fee`;');
                        $db->exec('ALTER TABLE `enrollments` DROP `start_date`;');
                        $db->exec('ALTER TABLE `enrollments` DROP `end_date`;');
                        $q = $db->query("SELECT * FROM enrollments");
                        $rows = $q->fetchAll();
                        foreach ($rows as $r){
                            $id = $r['id'];
                            if(strtolower($r['fee_status']) == "paid"){
                                $q1 = $db->prepare("UPDATE enrollments SET fee_status = 1 WHERE id = :id");
                                $q1->execute([':id' => $id]);
                            }else{
                                $q1 = $db->prepare("UPDATE enrollments SET fee_status = 0 WHERE id = :id");
                                $q1->execute([':id' => $id]);
                            }
                        }
                        $db->exec('ALTER TABLE `enrollments` CHANGE `fee_status` `status` TINYINT(4) NOT NULL;');
                        $db->exec('ALTER TABLE `enrollments` CHANGE `student_id` `student_id` INT(11) NOT NULL;');
                        showSuccess('Enrollments table Updated Successfully');

                        // for expenses table
                        $db->exec('RENAME TABLE expenses TO expense;');
                        $db->exec('ALTER TABLE `expense` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;');
                        $db->exec('ALTER TABLE `expense` CHANGE `expense_name` `expense_title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `expense` CHANGE `amount` `amount` FLOAT NOT NULL;');
                        $db->exec('ALTER TABLE `expense` CHANGE `expense_date` `date` DATE NOT NULL;');
                        $db->exec('ALTER TABLE `expense` ADD `expense_note` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `date`;');
                        $db->exec('ALTER TABLE `expense` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `expense_note`;');
                        showSuccess('Expense table Updated Successfully');

                        // for FAQS
                        $db->exec('ALTER TABLE `faqs` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;');
                        showSuccess('FAQs table Updated Successfully');

                        // for feedback message/course suggestion tables
                        $db->exec('RENAME TABLE course_suggestions TO feedback_messages;');
                        $db->exec('ALTER TABLE `feedback_messages` CHANGE `sid` `id` INT(11) NOT NULL AUTO_INCREMENT;');
                        $db->exec('ALTER TABLE `feedback_messages` CHANGE `course_id` `course_id` INT(11) NOT NULL;');
                        $db->exec('ALTER TABLE `feedback_messages` DROP INDEX `course_id`;');
                        $db->exec('ALTER TABLE `feedback_messages` CHANGE `fname` `name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `feedback_messages` CHANGE `suggestion` `feedback_text` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        showSuccess('Feedback Messages table Updated Successfully');

                        // creating new table gallery
                        $db->exec('CREATE TABLE `'.$db_name.'`.`gallery` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `image` VARCHAR(255) NOT NULL , `class` VARCHAR(255) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;');
                        showSuccess('Gallery Table Created Successfully');
                        // creating new table notification
                        $db->exec('CREATE TABLE `'.$db_name.'`.`notification` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `message` TEXT NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;');
                        showSuccess('Notification Table Created Successfully');

                        // for review table
                        $db->exec('ALTER TABLE `reviews` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;');
                        $db->exec('ALTER TABLE `reviews` CHANGE `student_name` `person_name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `reviews` CHANGE `student_pic` `person_image` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `reviews` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `description`;');
                        showSuccess('Review Table Updated Successfully');

                        // for student table
                        $db->exec('ALTER TABLE `students` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;');
                        $db->exec('ALTER TABLE `students` CHANGE `name` `name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `students` CHANGE `fname` `fname` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `students` CHANGE `gender` `gender` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `students` CHANGE `cnic` `cnic` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `students` CHANGE `picture` `picture` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `students` DROP `classification`;');
                        $db->exec('ALTER TABLE `students` CHANGE `mobile_number` `mobile_number` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `students` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `mobile_number`;');
                        showSuccess('Students Table Updated Successfully');

                        // for teacher table
                        $db->exec('ALTER TABLE `teachers` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;');
                        $db->exec('ALTER TABLE `teachers` CHANGE `name` `name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL');
                        $db->exec('ALTER TABLE `teachers` CHANGE `fname` `fname` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL');
                        $db->exec('ALTER TABLE `teachers` CHANGE `gender` `gender` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `cnic` `cnic` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `picture` `picture` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `teachers` DROP `classification`;');
                        $db->exec('ALTER TABLE `teachers` CHANGE `mobile_number` `mobile_number` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `teachers` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `about`;');
                        showSuccess('Teachers Table Updated Successfully');

                        // for users table
                        $db->exec('ALTER TABLE `users` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;');
                        $db->exec('ALTER TABLE `users` CHANGE `username` `username` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;');
                        $db->exec('ALTER TABLE `users` CHANGE `role` `role` VARCHAR(50) NOT NULL;');
                        $password = password_hash('admin', PASSWORD_DEFAULT);
                        $db->exec("INSERT INTO `users` (`username`, `password`, `role`) VALUES ('admin', '$password', 'admin');");

                        showSuccess('Users Table Updated Successfully');

                        $db->commit();
                    }catch(Exception $e){
                        //showError("Rolling Back!");
                        $db->rollBack();
                        showError($e->getMessage());
                    }
                    ?>
                    <tr>
                        <td colspan="2" class="text-center">
                            <label class="alert alert-success text-center mt-3" style="width: 100%;"><strong>Database Migration Completed.</strong> One more Optional Step.</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <label class="alert alert-danger text-center mt-3" style="width: 100%;">
                                There is no need for <strong><i>"backup_records"</i></strong> in azadchaiwala.pk update. you can DROP this table if you want.
                            </label>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
function showError($msg){
    echo "<tr><td class='text-center'>";
    echo '<label class="alert alert-danger text-center mt-3" style="width: 100%;"><strong>Error: </strong>'.$msg.'</label>';
    echo '<a href="install.php"><button class="btn btn-warning">GO BACK</button></a>';
    echo "</td></tr>";
    die;
}
function showSuccess($msg){
    echo "<tr><td>";
    echo '<label class="alert alert-success text-center mt-3" style="width: 100%;">'.$msg.'</label>';
    echo "</td></tr>";
}
?>
