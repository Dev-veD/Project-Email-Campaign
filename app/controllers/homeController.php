<?php
class homeController extends Controller {
    function __construct(){
      
    }

    public function index($id=NULL, $value=NULL){
        $this -> view('home/index');
        $this -> view ->render();
    }

    public function aboutus(){
        $this -> view('home/aboutus');
        $this -> view -> render();
     }

    public function register(){
       
        if(isset($_POST['email'])){
        $user = new User();
        if( (bool)$user -> getUserByEmail($_POST['email'])){
            $this->view('home/index',['Error'=>"Email Already Exists<br>"]);
            $this -> view ->render();
        }
        else{
            $_POST['passkey'] = sha1($_POST['passkey']); 
            $user -> addUser($_POST);
            $this->view('home/index',['Error'=>"Registration Successfull<br>"]);
            $this -> view ->render();
        }
    }
    else{
        $this->view('home/index',['Error'=>"<pre>Please Fill the Form Properly<br></pre>"]);
        $this -> view ->render();
    }  
}

    public function login(){
    
        $user = new User();
        $data = $user -> getUserByEmail($_POST['email']);
        if ((bool)$data){
            if (sha1($_POST['passkey']) == $data['pass_hash']){
                session_start();
                $_SESSION['name'] = $data['first_name']." ".$data['last_name'];

                $x = new dashController;
                $x->loadWelcome();
               
            }
            else
            {
                $this -> view('home/index',['Error'=>"<pre>Wrong Pass<br></pre>"]);
                $this-> view -> render();
            }
        }
        else {
            $this -> view('home/index',['Error'=>"<pre>User Email Not Present in Database<br></pre>"]);
            $this-> view -> render();
        }
    }

    public function logout(){
        unset($_SESSION);
        $this -> view('home/index',['Error'=>"<pre>You have LoggedOut<br></pre>"]);
            $this-> view -> render();
    }

}
?>


