<?php

class dashController extends Controller{

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
            header("location: dash&loadSubscriberList");
        }
    }

    public function getSubscriberList(){

        $subscriber = new Subscriber();
        $this -> data["SubscriberData"] = ($subscriber -> getAllSubscribers());
    }

    public function loadWelcome(){

        $this->getSubscriberList();  
        $this->getCampaignList();
        $this->data["SubCount"] =  count($this->data["SubscriberData"]);
        $this->data["CampCount"] =  count($this->data["CampaignData"]);
        $this->view("dash/welcomee",$this->data);
        $this->view->render();

    }

    public function loadSubscriberList(){

        $this->getSubscriberList();
        $this->view("dash/subslist",$this->data['SubscriberData']);
        $this->view->render();

    }

    public function getCampaignList(){

        $campaign = new Campaign();
        $this -> data["CampaignData"] = ($campaign-> getAllCampaigns());
    }

    public function loadCampaignList(){

        $this->getCampaignList();
        $this->view("dash/campaignlist",$this->data['CampaignData']);
        $this->view->render();
    }

    public function launchCampaign(){
            $this->addCampaign();
            $launch = new mailController();
            
    }
   

    function addCampaign(){
       
    }

    public function getCampaignSearchResults(){
        $camp = new Campaign ;
        $results = $camp -> searchDatabaseFor($_POST['element']);
        $this->view("dash/campaignlist",$results);
        $this->view->render();
    }

    public function getSubscriberSearchResults(){
        $subs = new Subscriber ;
        $results = $subs -> searchDatabaseFor($_POST['element']);
        $this->view("dash/subslist",$results);
        $this->view->render();
    }

    public function removeSubscriber(){
        $id = $_GET[id];
        $sub = new Subscriber();
        $sub->removeSubscriberByID($id);
        header("location: dash&loadSubscriberList");
    }
    public function reLaunchCampaign(){
        $id = $_GET[id];
        $sub = new Campaign();
        $sub->removeCampaignByID($id);
        header("location: dash&loadCampaignList");
    }

}

?>