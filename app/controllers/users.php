<?php

class UsersController extends Controller{

    private $data = ["Message"=> NULL, "SubscriberData"=> NULL, "EmailCampaignData"=>NULL];
 



    function addSubscriber(){
        $subscriber = new Subscriber ;

        if($subscriber -> emailAlredyExists($_POST['email'])){
            $this->data["Message"] = "Email Entered Already Present In List";
            $this->view("dash/welcome",$this->data);
            $this->view->render();
            $this -> data["Message"] =NULL;
        }
        else
        {
            $subscriber -> addSubscriber($_POST);
            $this -> data["Message"] = "Subscriber Successfully added to List";
            $this->loadWelcome();
            $this -> data["Message"] =NULL;
        }
    }

    public function getSubscriberList(){
        $subscriber = new Subscriber();
        $this -> data["SubscriberData"] = ($subscriber -> getAllSubscribers());
    }

    public function loadWelcome(){

        $this->getSubscriberList();
        $this->view("dash/welcomee",$this->data['SubscriberData']);
        $this->view->render();
    }
}

?>