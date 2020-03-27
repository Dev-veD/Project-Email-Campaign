<?php
 use PHPMailer\PHPMailer\PHPMailer;

class SMTP{
public static function mail(){
    require_once "PHPMailer/src/PHPMailer.php";
    require_once "PHPMailer/src/SMTP.php";
    require_once "PHPMailer/src/Exception.php";
    return new PHPMailer();    
}
}

?>













?>
