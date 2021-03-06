<?php

/**
 * Created by JetBrains PhpStorm.
 * User: long
 * Date: 2/27/14
 * Time: 3:00 PM
 * To change this template use File | Settings | File Templates.
 */
class Utils {

    public static function autoSetValueToObject($model, $array) {//array la cac gia tri post
        $attributes = $model->attributeNames();

        foreach ($array as $key => $value) {// lay moi gia tri trong post vao value
            foreach ($attributes as $key1 => $attribute) {// lay moi attreibute -> $attreibute
                if ($attribute == $key) {// neu atttribute giong key
                    $model->$attribute = $value; //thi gan gia tri cua key cho attreibute do'
                }
            }
        }
        return $model;
    }

    public static function setAllErrorsToArray($getErrors) {// lay cac loi cho vao 1 mang
        $array_errors = array();
        foreach ($getErrors as $key => $errors) {
            foreach ($errors as $key1 => $value2) {
                array_push($array_errors, $value2);
            }
        }
        return $array_errors;
    }

    /**
     * lấy session nếu session chưa được gán thì trả về rỗng
     * @param type $key
     * @return string
     */
    public static function getSession($key) {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION[$key])) {
            $_SESSION[$key] = $_SESSION[$key];
        } else {
            $_SESSION[$key] = "";
        }
        return $_SESSION[$key];
    }

    public static function setSession($key, $value) {
        Yii::app()->session[$key] = $value;
//        if (!isset($_SESSION)) {
//            session_start();
//        }
//        $_SESSION[$key] = $value;
//        return $_SESSION[$key];
    }

    public static function delSession($key) {
//        if (!isset($_SESSION)) {
//            session_start();
//        }
//        if (isset($_SESSION[$key])) {
//            unset($_SESSION[$key]);
//            session_destroy();
//        } else {
//            
//        }
        unset(Yii::app()->session[$key]);
    }

//  Ham: set Cookie
//  param: name: ten cookie, value: gia tri truyen vao
    public static function setCookie($name, $value) {
        $cookie = new CHttpCookie($name, $value);
        Yii::app()->request->cookies[$name] = $cookie;
    }

//  Ham: get Cookie
//  param: name: ten cookie can lay
//  return: gia tri cua cookie     
    public static function getCookie($name) {
        return Yii::app()->request->cookies[$name]->value;
    }

//unset cookie, param:name: ten cookie
    public static function removeCookie($name) {
        unset(Yii::app()->request->cookies[$name]);
    }

    public static function paginate($total, $page = 1, $start = 0, $offset = 3) {
        $start = ($page - 1) * $offset;
        $total_page = ceil($total / $offset);
        return array("page" => $page,
            "start" => $start,
            "total" => $total_page,
            "offset" => $offset);
    }

    public static function removeHtmlString($string) {// bo cac tag HTML trong van ban
        return preg_replace('/([^\pL\.\ ]+)/u', '', strip_tags($string));
    }

    public static function CreateRegisterKey() {
        return substr(md5(rand(0, 10)), 0, 6);
    }

    public static function CreateMailContent($DisplayName, $secretKey, $userId) {
        return $cotent = "<p>Hello " . $DisplayName . ", please enter this <a href='" . $_SERVER['HTTP_HOST'] . Yii::app()->getBaseUrl() . "/index.php?r=user/ActiveUser&userId={$userId}&secretKey={$secretKey}" . "'>link</a> to active your account</p>";
    }

    public static function SendMail($mailContent, $mailAddress, $mailSubject) {
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        $mail = new JPhpMailer;
        $mail->CharSet = "UTF-8";
        $mail->IsSMTP();
        $mail->Host = 'smtp.googlemail.com:465';
        $mail->SMTPSecure = "ssl";
        $mail->SMTPAuth = true;
        $mail->Username = 'duchung3690@gmail.com';
        $mail->Password = 'hungdaica123';
        $mail->SetFrom('duchung3690@gmail.com', 'Lương Đức hùng');
        $mail->Subject = $mailSubject;
        $mail->AltBody = $mailContent;
        $mail->MsgHTML($mailContent);
        $mail->AddAddress($mailAddress);
        if ($mail->Send()) {
            return true;
        } else {
            return false;
        }
    }

    public static function setSecurePassword($pass) {//chuyen password sang dang hash kem theo secureKey
        $secureKey = base64_encode("education-online");
        $pass_encode = base64_encode($pass);
        return $output_encode = base64_encode($pass_encode . $secureKey);
    }

    public static function getSecurePassword($pass_64encoded) {// giai ma password da ma hoa
        $secureKey = base64_encode("education-online");
        $split_securekey = str_replace($secureKey, "", base64_decode($pass_64encoded)); // cat secureKey ra khoi? chuoi~ chua password da ma hoa
        return base64_decode($split_securekey); //decode sang password
    }

    public static function actionGetAllAction() {
        $action_arr = array();
        $webroot = Yii::getPathOfAlias('webroot'); //lay duong dan cua thu muc goc
        $dir = $webroot . '/protected/controllers'; // lay duong dan controllers
        $files = scandir($dir); // lay danh sach cac file ra dang. mang? trong dir
        foreach ($files as $key => $value) {
            if ($key >= 2) {//trong array tra ve tu key thu 3 moi la file
                $class_name = str_replace("Controller", "", substr($value, 0, strlen($value) - 4)); // bo? .php
                $file = $dir . "/" . $value;
                $arr = file($file);
                foreach ($arr as $line) {
                    if (preg_match("/^public function action/", trim($line))) {
                        $action_name = str_replace("public function ", "", substr(trim($line), 0, strpos(trim($line), "(")));
                        $result = $class_name . "|" . $action_name;
                        array_push($action_arr, $result);
                    }
                }
            }
        }
        return $action_arr;
    }

    public static function GetActionName($actionName) {
        return str_replace("action", "", $actionName);
    }

    public static function ArrayToObject($array) {
        $array_of_objects = array();


        if (count($array) > 1) {
            foreach ($array as $key => $value) {
                $object = (object) $value;
                array_push($array_of_objects, $object);
            }
            return (object) $array_of_objects;
        } else {
            foreach ($array as $key => $value) {
                $object = (object) $value;
                return $object;
            }
        }
    }

    public static function ArrayToObject1($array) {// dung cho truong hop can foreach
        $array_of_objects = array();
        foreach ($array as $key => $value) {
            $object = (object) $value;
            array_push($array_of_objects, $object);
        }
        return (object) $array_of_objects;
    }

    public static function UploadImage($img) {
        if (file_exists("upload/" . $_FILES[$img]['name'])) {
            if (move_uploaded_file($_FILES[$img]["tmp_name"], "upload/" . "(1)" . $_FILES[$img]['name'])) {
                return true;
            } else {
                return false;
            }
        } else {
            if (move_uploaded_file($_FILES[$img]["tmp_name"], "upload/" . $_FILES[$img]['name'])) {
                return true;
            } else {
                return false;
            }
        }
    }

    //function convert time vd: 20/3/2014 12h 59ph -> 20/3/2014 ( tat ca dang int )
    public static function TimeConvert($time) {
        return $result = strtotime(date("d-F-Y", $time));
    }

    public static function DateConvert($time) {
        $timezone = +7; //(GMT +7:00) 
        return $new_time = gmdate(" G:i a, d-m", $time + 3600 * ($timezone + date("0")));
//        
//        return $result = date(" G:i a, d-m", $time);
    }

//function to get client IP
    public static function getIP() {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $ip;
    }

//    public static function var_dump($var) {
//        echo "<pre>";
//        var_dump($var);
//        echo "<pre>";
//        exit;
//    }

    
    //function to create readmore limit string
    public static function readMore($string) {
        $string = strip_tags($string);

        if (strlen($string) > 1500) {

            // truncate string
            $stringCut = substr($string, 0, 1500);

            // make sure it ends in a word so assassinate doesn't become ass...
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
        }
        echo $string;
    }
    
    //function used to get createdDate to display in top of an note's post
    //"d-F-Y"
    public static function getCreatedDate($createdDate){
        $createdDate = date(" d-F-Y", $createdDate);
        $array = explode("-", $createdDate);
        $list_of_date = array(array("day"=>$array[0],"month"=>$array[1],"year"=>$array[2]));
        return Utils::ArrayToObject($list_of_date);
    }

    public static function uploadAvarta($img){
        if($_FILES[$img]['name'] != NULL){ // Đã chọn file
            //foreach($_FILES['avatar']['name'] as $key => $value){}
            // Tiến hành code upload file
            if($_FILES[$img]['type'] == "image/jpeg" || $_FILES[$img]['type'] == "image/png" || $_FILES[$img]['type'] == "image/gif"){
                // là file ảnh
                // Tiến hành code upload
                if($_FILES[$img]['size'] > 1048576){
                    echo "File < 1mb";
                }else{
                    // file hợp lệ, tiến hành upload
                    $path = "upload/".date('Ymd',time()).'/'; // file sẽ lưu vào thư mục data
                    $filetmp_name = $_FILES[$img]['tmp_name'];
                    $fileName = time().$_FILES[$img]['name'];
                    $fileType = $_FILES[$img]['type'];
                    $fileSize = $_FILES[$img]['size'];
                    // Upload file
                    if(!file_exists($path)){
                        mkdir($path,0700);
                    }
                    move_uploaded_file($filetmp_name,$path.$fileName);
                    //echo "File uploaded! <br />";
                    //echo "Tên file : ".$value."<br />";
                    //echo "Kiểu file : ".$fileType."<br />";
                    //echo "File size : ".$fileSize;
                    //$count ++;
                }
            }else{
                // không phải file ảnh
//                echo "File not defiend";
            }
        }else{
//            echo "Chon File";
        }
    }
}
