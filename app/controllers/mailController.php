<?php


class mailController extends Controller{


    public function fire(){
        
        $recipientEmail = "divyansh.code@gmail.com";
        $emailSubject = "PHP Mailing Function";
        $emailContext = "Sending content using PHP mail function";
        
        $emailHeaders = "Cc: divyansh.code@gmail.com" . "\r\n";
        $emailHeaders .= "Bcc: divyansh.code@gmail.com" . "\r\n";
        
        $fromAddress = "Div@localhost";
        $emailStatus = mail($recipientEmail, $emailSubject, $emailContext);
        if($emailStatus) {
        echo "EMail Sent Successfully!";
        } else {
        echo "No Email is sent";
        }
        
    }

}
?>