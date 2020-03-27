
<aside>
  <div id="sidebar" class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu">


     
     
      <li class="sub-menu" >
            <a href="javascript:;" class="text-center text-primary" size="10">
                          <p><b><i class="fa  fa-user " style="margin-right:20px"></i>
                        
                        </b></p>
                          <span >Hi, <?php
                  echo $_SESSION['username'];?></span>
                          <span class="menu-arrow arrow_carrot-right"></span><br>
                      </a>
            <ul class="sub">
              <li><a data-toggle="modal" href="#myModal"><i class="icon_key_alt"></i> Log Out</a></li>
            </ul>
            
          </li>
          
      <li class="">
       
        <a class="" href="dash&loadWelcome">
          <i class="icon_house_alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="">
        <a href="dash&loadSubscriberList" class="">
          <i class="icon_document_alt"></i>
          <span>My Subscribers</span>
        </a>
      </li>
      <li class="">
        <a href="dash&loadCampaignList" class="">
          <i class="icon_desktop"></i>
          <span>My Campaigns</span>
        </a>
      </li>

    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>