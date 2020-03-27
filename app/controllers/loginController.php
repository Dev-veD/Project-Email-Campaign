<?php

class loginController extends Controller
{
    protected static $client;

    public static function initGoogle()
    {
        $client = GLogin::getConfiguredClient();
        $loginURL = $client -> createAuthUrl();
        return $loginURL;
    }

    public function g_callback()
    { 
        $gClient = $client;
        
        $gClient = GLogin::getConfiguredClient();
       
        if (isset($_GET['code'])) {
            $token = $gClient -> fetchAccessTokenWithAuthCode($_GET['code']);
            $_SESSION['access_token'] = $token;
           
            if (isset($token['error'])) {
                $error = new oopsController;
                $error->oopsNotFound($token['error']);
            }
        }
        $oAuth = new Google_Service_Oauth2($gClient);
        $userData = $oAuth->userinfo_v2_me->get();
        $user = new User();
        if ($user->emailAlredyExists($userData['email'])) {
            session_start();
            $_SESSION['LoggedIn']=true;
            $_SESSION['username'] = $user->getUsername($userData['email'])['first_name'];
            $_SESSION['email'] = $userData['email'];
            $x = new dashController;
            $x->loadWelcome();
        } else {
            $email = $userData['email'];
            $name = $userData['givenName'];
            $last = $userData['familyName'];
            $user->addUser([$name , $last, $email, "GoogleSignIn"]);
            session_start();
            $_SESSION['LoggedIn']=true;
            $_SESSION['username'] = $user->getUsername($email)['first_name'];
            $_SESSION['email'] = $email;
            header("location : dash&loadWelcome");

           
        }
    }
    public function registerUser(){

        $user = new User();
        if( (bool)$user -> getUserByEmail($_POST['email'])) return "Email Already Exists";
        else{
            $_POST['passkey'] = sha1($_POST['passkey']); 
            try {
                $user -> addUser($_POST);
                $str = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM123456789";
                $token = substr( str_shuffle($str),0,10);
                $link = MYIP."/verification&verify?token={$token}&email={$_POST['email']}";
                $user -> insertToken($_POST['email'],$token);
                $mail = new mailController();
                $mail->sendVerificationLink($_POST['email'],$link);
                return "Registration Successfull";
            }
            catch (Exception $e){
                return "Error in Adding to Database".$e." ";
            }
        }
        
    }

    public function authenticateUser(){
        $user = new User();
        $data = $user -> getUserByEmail($_POST['email']);
        if ((bool)$data){
            if (sha1($_POST['passkey']) == $data['pass_hash']) {
                if ($user -> getStatus($_POST['email'])['status']=='verified') {
                    session_start();
                    $_SESSION['LoggedIn']=true;
                    $_SESSION['username'] = $user->getUsername($_POST['email'])['first_name'];
                    $_SESSION['email'] = $_POST['email'];
                    return 'Verified';
                }
                else
                    return 'Please verify your email.';
            }
            else return 'Wrong password';
        } else return 'User does not exist.';
    }

    public function logout(){
        session_start();
        unset($_SESSION['LoggedIn']);
        header('location: home&index');
        exit();
    }

    public function forgotPassword(){
        $usr = new User();
        $email = $_POST['email'];
        $data = $usr -> getUserByEmail($email);
        if ((bool)$data) {
            $str = $usr->getHash($email);
            if($str == "GoogleSignIn")
            {
                $this -> view('oops/forgotPasswordOTP', ['message'=>'You logged in from Google']);
                $this-> view -> render();
            }
            else{
                $token = substr($str, 0, 10);
                $mail = new mailController();
                $mail->sendPasswordResetOTP($email, $token);
                $this -> view('oops/forgotPassword', ['message'=>'OTP sent to your email']);
                $this-> view -> render();
            }
        }
        else{
            $this -> view('oops/forgotPasswordOTP', ['message'=>'User does not exist in database']);
            $this-> view -> render();
        }
    }
}
