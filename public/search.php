
       <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
               Search Result
              </header>

              <table class="table table-striped table-advance table-hover" id="main">
                <tbody>
                  <tr>
                    <th><i class="icon_profile"></i> Title</th>
                    <th><i class="icon_calendar"></i> Date </th>
                    <th><i class="fa fa-refresh"></i> Launch Again</th>
                  </tr>

                  <?php
        foreach ($this->view_data as $entity) {
        
            $id = $entity['sub_id'];
            echo "<tr id='".$id."'>";
            foreach ($entity as $key=>$element) {
                if($key=="reg_date")
            {$x = str_split($element,10);
              
              echo "<td>".$x[0]."</td>";

            }
                else if($key != "detail"&&$key != "camp_id")
                echo "<td>".$element."</td>";
            }
            echo '<td><div class="btn-group"><a class="btn btn-green" href="#"><i class="fa fa-refresh"></i></a>
            </div></td></tr>';
            
        }
        echo "</table>";
        ?> 
      </div>
      </div>