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
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                        showSuccess("Database Connected!");
                    } catch (PDOException $e) {
                        showError($e->getMessage());
                    }
                    //try{
                    //$db->beginTransaction();
                    showSuccess('Transaction Started');
                    // for table badges or batches
                    $db->exec('ALTER TABLE `batches` ADD `class_link` TEXT NOT NULL AFTER `end_time`;');
                    $db->exec("ALTER TABLE `courses` ADD `type` VARCHAR(20) NOT NULL DEFAULT 'offline' AFTER `course_description`;");
                    $db->exec('DELETE * FROM enrollments');
                    $db->exec('ALTER TABLE `enrollments` ADD `course_id` INT NULL AFTER `id`;');
                    $db->exec("ALTER TABLE `enrollments` CHANGE `batch_id` `batch_id` INT(11) NULL, CHANGE `fee_receipt` `fee_receipt` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `status` `status` TINYINT(4) NOT NULL DEFAULT '0';");
                    $db->exec("CREATE TABLE `student_login` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_phone` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `cnic` varchar(20) DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `address` text,
  `email_token` varchar(255) DEFAULT NULL,
  `token_requested_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(20) NOT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                    $db->exec('ALTER TABLE `student_login` ADD PRIMARY KEY (`id`);');
                    $db->exec('ALTER TABLE `student_login` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');


                    //$db->commit();
                    //}catch(Exception $e){
                    //showError("Rolling Back!");
                    //$db->rollBack();
                    //showError($e->getMessage());
                    //}
                    ?>
                    <tr>
                        <td colspan="2" class="text-center">
                            <label class="alert alert-success text-center mt-3" style="width: 100%;"><strong>Database
                                    Migration Completed.</strong></label>
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
