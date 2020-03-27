<?php
class homeController extends Controller
{
    protected $visiblity = false;   

    public function __construct()
    {
        $this->dataForView["URL"]= loginController::initGoogle();
    }

    public function index($id=null, $value=null)
    {
        $this->dataForView["visiblity"] = $this->visiblity;
        $this -> view('home/index', $this->dataForView);
        $this -> view ->render();
    }

    public function aboutus()
    {
        
        $this -> view('home/aboutus');
        $this -> view ->render();
    }

    

    public function register()
    {
        if (!isset($_POST['passkey']) || !isset($_POST['email']) || !isset($_POST['firstname']) || !isset($_POST['lastname'])) {
            $message = "Enter all the required fields.";
        } elseif (strlen($_POST['passkey'])<8) {
            $message="Too Short Password";
        } elseif ($_POST['passkey'] != $_POST['cpasskey']) {
            $message="Passwords Do Not Match";
        } else {
            $register = new loginController;
            $message = $register->registerUser();
        }
        $this->visiblity=true;
        $this->dataForView['SignupMessage']=$message;
        if($message == "Registration Successfull")
        $this -> view('oops/verify', ['message'=>'Registration successfull. A verification link is sent to your email address.']);
        else
        $this -> view('home/index', $this->dataForView);
        
        $this ->view->render();
    }


    //Check Validity of Entered Details if Valid Verify User.
    public function login()
    {
        $message = "";

        if (!isset($_POST['passkey']) || !isset($_POST['email'])) {
            $message = "Enter all the required fields.";
        }
        else {
            $login = new loginController();
            echo $message;
            $message = $login->authenticateUser();
            
            if ($message != 'Verified') {
                $this->fillForm();
            }
        }
        $this->visiblity = false;
        $this->dataForView['SigninMessage']=$message;
        exit($message);
        
        
        
    }
    public function logout()
    {
        
        $login = new loginController();
        $login->logout();
        //$this -> view('home/index', $this->dataForView);
        //$this-> view -> render();
        
    }

    public function fillForm(){
        if(isset($_POST['firstname']))
        $this->dataForView['firstname']=$_POST['firstname'];
        if(isset($_POST['lastname']))
        $this->dataForView['lastname']=$_POST['lastname'];
        if(isset($_POST['email']))
        $this->dataForView['email']=$_POST['email'];
     
    }

    public function forgotPassword(){
        $this -> view('oops/forgotPasswordOTP');
        $this-> view -> render();
    }
    
}
?>


