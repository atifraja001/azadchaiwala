<?php
ob_start();
/*
 * return
 * invalid_image  - if file type is invalid
 * invalid_size   - if file size exceed the limit
 * not_uploaded   - if file not upload
 * [filename]     - if their is no error
 * DEFAULTS:
 * max upload size = 2MB
 * create new path if not exists = false
 * mime_type = image (gif, png, jpg)
 * generate new name = true
 */
function uploadfile($file, $path,
                    $file_size = 2,
                    $mime_type = array('image/jpeg', 'image/gif', 'image/png'),
                    $create_path = false,
                    $generate_name = true){
    $file_size = $file_size*1000000; // default is 2 MB
    if (!file_exists($path)) {
        if($create_path) {
            mkdir($path, 0777, true);
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
function daysdiff($start_date, $end_date){
    $timeleft = strtotime($end_date)-strtotime($start_date);
    return round((($timeleft/24)/60)/60);
}
function hoursdiff($start_time, $end_time){
    $time1 = strtotime($start_time);
    $time2 = strtotime($end_time);
    return round(abs($time2 - $time1) / 3600,2);
}
function getPakCurrency($number)
{
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
function Auth($user){
    if(strtolower($user) == "admin"){
        if(!isset($_SESSION['admin_login'])){
            redirectWithMessage(app_url('admin').'/login', 'login required to access this page', 'login', 'error');
        }
    }
}
function app_url($type = 'base'){
    if (strtolower($type) == "admin"){
        return \App\Config::ADMIN_URL;
    }else {
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
function redirect($url){
    if (!headers_sent())
    {
        header('Location: '.$url);
        exit;
    }
    else
    {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit ;
    }
}
function add3Dots($string, $limit)
{
    $dots = "...";
    if(strlen($string) > $limit)
    {
        // you can also use substr instead of substring
        $string = substr($string, 0, $limit) . $dots;
    }
    return $string;
}
function redirectWithMessage($url, $message, $where, $type = "msg"){
    if (!headers_sent())
    {
        $_SESSION['msg'] = $message;
        $_SESSION['type'] = $type;
        $_SESSION['where'] = $where;
        header('Location: '.$url);
        exit;
    }
    else
    {
        $_SESSION['msg'] = $message;
        $_SESSION['type'] = $type;
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}
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
function formatSizeUnit($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024) . ' kB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}