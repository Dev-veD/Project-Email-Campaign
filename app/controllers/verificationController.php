<?php


class verificationController extends Controller{
  


   public function verify(){
    $token = $_GET['token'];
    $email = $_GET['email'];
    $user = new User;
    $status = $user -> getStatus($email)['status'];

    
    
    if($status == 'verified'){
        $this -> view('oops/verify',['message'=>"Email was already Verified"]);
        $this ->view->render();
    }
    else if($status == $token){
        
        $user->updateStatus($email);

        $this -> view('oops/verify',['message'=>"Email verified"]);
        $this ->view->render();
    }
    else{
        $this -> view('oops/verify',['message'=>"Something is wrong!!!"]);
        $this ->view->render();
    }
   }

   public function updatePassword(){
    $email = $_POST['email'];
    $pass = sha1($_POST['passkey']); 
    $otp = trim($_POST['otp']);
        $user = new User();
        $secretKey =  substr( $user -> getHash($email),0,10);
        if($secretKey == $otp)
            {
                $user->updatePassword($pass, $email);
                $this -> view('oops/verify',['message'=>"Successfully Updated Password."]);
                $this ->view->render();
            }
        else{
                $this -> view('oops/verify',['message'=>"Password not updated. OTP is not valid!!!"]);
                $this ->view->render();
        }
            
        }
}
        
    
?>