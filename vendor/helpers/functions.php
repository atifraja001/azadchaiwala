<?php
/*
 * Author: Awais Liaqat (awaisliaqat5@gmail.com)
 * created: 03-2018 (mm-yyyy)
 * updated: 29-01-2020 (dd-mm-yyyy)
 * Description:
 *      these functions are helper functions that can be used in entire project. (views, controllers)
 */
ob_start();
/*
 *
 * uploadfile (PHP 5, 7)
 *
 * uploadfile(string $file, string $path [, int $file_size, array $mime_type, bool $create_path, bool $generate_name)
 *
 * parameters:
 * file
 *      name of the file (not $_FILES['profile_picture']) use 'profile_picture'
 * path
 *      path to store images (path/to)
 *      example: assets/folder_name (not /assets/folder_name/)
 * mime_type
 *      restrict file types to upload
 *      default: array of image types (jpeg, gif, png)
 * create_path
 *      create path if not exists
 *      default: false
 * generate_name
 *      to generate new name for image. true is recommended
 *      default: true
 */
function uploadfile($file, $path,
                    $file_size = 2,
                    $mime_type = array('image/jpeg', 'image/gif', 'image/png'),
                    $create_path = false,
                    $generate_name = true){
    $file_size = $file_size*1000000; // default is 2 MB
    $path = $_SERVER['DOCUMENT_ROOT']."/".$path;
    if (file_exists($path)) {
        if($create_path) {
            mkdir($path, 0750, true);
        }
    }else{
        return "invalid_path";
    }
    if($generate_name){
        $uploadedName = $_FILES[$file]['name'];
        $ext = strtolower(substr($uploadedName, strripos($uploadedName, '.')+1));
        $filename = round(microtime(true)).mt_rand().uniqid().'.'.$ext;
    }else{
        $filename = $_FILES[$file]['name'];
    }
    $mimetype = mime_content_type($_FILES[$file]['tmp_name']);
    if(!in_array($mimetype, $mime_type)) {
        return "invalid_image";
    }
    $size = @getimagesize($_FILES[$file]['tmp_name']);
    if (empty($size) || ($size[0] === 0) || ($size[1] === 0)) {
        return "invalid_image";
    }
    if ($_FILES[$file]['size'] > $file_size) {
        return "invalid_size";
    }
    if(!empty($file)){
        $file = $_FILES[$file];
        $path = $path."/";
        $path = $path . $filename;
        $pe = move_uploaded_file($file['tmp_name'], $path);
        if($pe) {
            return $filename;
        } else{
            return "not_uploaded";
        }
    }
}
/*
 * return
 * number of days between two date
 *
 * required parameters
 * start date (string date) example: 21-01-2020 or 2020/01/21
 * end date (string date) example: 21-01-2020 or 2020/01/21
 *
 */
function daysdiff($start_date, $end_date){
    $timeleft = strtotime($end_date)-strtotime($start_date);
    return round((($timeleft/24)/60)/60);
}
/*
 * return
 * number of Hours between two times
 *
 * required parameters
 * start date (string date) example: 23:59:59
 * end date (string date) example: 23:59:59
 *
 */
function hoursdiff($start_time, $end_time){
    $timeleft = strtotime($end_time)-strtotime($start_time);
    return round(($timeleft/3600));
}

/*
 * return
 * amount in words (Pakistani Format)
 *
 * required parameters
 * int or float
 *
 */

function getPakCurrency($number){
    $number = floatval($number);
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise . '';
}

/*
 * checks users type. if user is not logged
 * redirects to login page
 * required parameters
 * int or float
 */

function Auth($user){
    if(strtolower($user) == "admin"){
        if(!isset($_SESSION['admin_login'])){
            redirectWithMessage(app_url('admin').'/login', 'login required to access this page', 'login', 'error');
        }
    }
}

/*
 * return
 * PATH (SET IN App/Config.php)
 *
 * required parameters
 * base: for public directory (default)
 * admin: for admin directory
 */

function app_url($type = 'base'){
    if(strtolower($type) == "admin"){
        return \App\Config::ADMIN_URL;
    }else{
        return \App\Config::APP_URL;
    }
}
function clean_post($var){
    if(isset($_POST[$var])){
        $var = $_POST[$var];
    }else{
        $var = "";
    }
    return $var;
}
function clean_get($var){
    if(isset($_GET[$var])){
        $var = $_GET[$var];
    }else{
        $var = "";
    }
    return $var;
}
/*
 * use to redirect with header or
 * if headers already sent! it redirects
 * with javascript or noscript (meta)
 *
 * required parameters
 * url: to redirect
 *
 */
function redirect($url){
    if (!headers_sent()){
        exit(header('Location: '.$url));
    }else{
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}
/*
 * @returns
 * string with 3 dots if string is greater then the limit.
 *
 * required parameters
 * string (string)
 * limit (int)
 *
 */
function add3Dots($string, $limit){
    if(strlen($string) > $limit) {
        $string = substr($string, 0, $limit) . "...";
    }
    return $string;
}
/*
 * use to redirect with header or
 * if headers already sent! it redirects
 * with javascript or noscript (meta)
 *
 * required parameters
 * url: to redirect
 * message: to show message (string)
 * where: is used to show message location
 * (if you have multiple positions of showing message)
 * type (accepts two options)
 * msg: to show success message
 * error: to show danger message
 */
function redirectWithMessage($url, $message, $where, $type = "msg"){
    if (!headers_sent()){
        $_SESSION['msg'] = $message;
        $_SESSION['type'] = $type;
        $_SESSION['where'] = $where;
        exit(header('Location: '.$url));
    }else{
        $_SESSION['msg'] = $message;
        $_SESSION['type'] = $type;
        $_SESSION['where'] = $where;
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}
/*
 * showMsg is compatible with redirectWithMessage
 * it shows one time message
 * @return
 * Bootstrap Alert Message
 *
 * @required parameters
 * where: (must be matched with redirectWithMessage where parameter
 *
 */
function showMsg($where){
    // only works with bootstrap 3 and bootstrap 4
    if(isset($_SESSION['msg']) && isset($_SESSION['type']) && isset($_SESSION['where'])){
        if($_SESSION['where'] == $where){
            $type = $_SESSION['type'];
            $msg = "";
            if($type == "msg"){
                $msg = '<div class="alert alert-primary alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                      '.$_SESSION['msg'].'
                    </div>';
            }else if($type == "error"){
                $msg = '<div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                      '.$_SESSION['msg'].'
                    </div>';
            }
            unset($_SESSION['msg']);
            unset($_SESSION['type']);
            unset($_SESSION['where']);
            return $msg;
        }
    }
    return "";
}

/*
 * @returns
 * filesize in user friendly format
 *
 * @required parameters
 * filesize in bytes
 */
function formatSizeUnit($bytes){
    if($bytes >= 1073741824){
        $bytes = number_format($bytes / 1073741824) . ' GB';
    }else if ($bytes >= 1048576){
        $bytes = number_format($bytes / 1048576) . ' MB';
    }else if($bytes >= 1024){
        $bytes = number_format($bytes / 1024) . ' kB';
    }
    else if($bytes > 1){
        $bytes = $bytes . ' bytes';
    }
    else if($bytes == 1){
        $bytes = $bytes . ' byte';
    }else{
        $bytes = '0 bytes';
    }
    return $bytes;
}