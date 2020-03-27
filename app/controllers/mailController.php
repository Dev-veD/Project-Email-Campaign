<?php


class mailController extends Controller{
    protected $username="";
    protected $password="";
    protected $from ="Hu@felmae.com";
    protected $to = "";
    protected $subject = "";
    protected $body = "";
    protected $serviceType = "SMTP";
    protected $campaignName = "";
    protected $fromName ="Project Email Campaign";
    protected $Message=[];


    public function fire(){
        $camp = new Campaign ;
        session_start();
        $camp -> addCampaign($_POST, $_SESSION['email']);
        $this ->subject = $_POST['emailSubject'];
        $this ->body = $_POST['emailBody'];
        if($this->serviceType == "SMTP")
        $this->fireSMTPMail();
        else
        echo "<pre>Amazon SES Not Added Intentionally</pre>";
    }

    public function SMTPMailTo($Subscribername){
        $this->mail =  SMTP::mail();   
        $this->mail->isSMTP();
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "";
        $this->mail->Password = "";
        $this->mail->Port = 465;
        $this->mail->SMTPSecure = "ssl";
        $this->mail->isHTML(true);
        $this->mail->setFrom("djhackker42@gmail.com",$this->fromName);
        $this->mail->addAddress($Subscribername);
        $this->mail->Subject = $this->subject;
        $this->mail->Body =$this->body;
       
        if($this->mail->send())
            $this->Message['Message']="Okay Sent";
        else
            $this->Message['Message']="Not Sent ".$this->mail->ErrorInfo;
           
    }

    public function fireSMTPMail(){
        $subs = new Subscriber();
        $subs = $subs -> getAllEmails();
        foreach($subs as $subscriber){
            $this->SMTPMailTo($subscriber['email_id']);
            sleep(1);
        }
        $message = "Subject : ".$this->subject."<br>Body : ".$this->body."<br>";
        $this->view("oops/success",['message'=>$message]);
        $this->view->render();
    }

    public function switchService(){
        if($this->serviceType == "SMTP"){
            $this->serviceType = "SES";
        }
        else{
            $this->serviceType = "SMTP";
        }
    }
    public function sendVerificationLink($email, $link){
        $this->fromName = "Email Campaign (do not reply)";
        $this->subject = "Verification Link From Campaign";
        $this->body = "Click on the link below <br> Link : {$link}";
        $this->SMTPMailTo($email);
    }
    public function sendPasswordResetOTP($email, $token){
        $this->fromName = "Email Campaign (do not reply)";
        $this->subject = "OTP for your EmailCampaign account password reset";
        $this->body = "
        Your Email : {$email}
        OTP : {$token} ";
        $this->SMTPMailTo($email);
    }
}
?>