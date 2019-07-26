<?php
$userID = $_SESSION['user'];
$query = "SELECT * FROM user WHERE user_id='$userID'";
$r = mysql_query($query, $dbc);
$user = mysql_fetch_array($r);
$teamLeader = $user['team_leader'];
$myTeamLeader = $user['team_leader'];
$userType = $user['user_type'];

$img = $user['img'];

$userType = $user['user_type'];
$startOfMonth = date("M. 1, o");
$endOfMonth   = date("M. 31, o");
$currentMonth = $startOfMonth." - ".$endOfMonth;

$startOfMonth = date("Y-m-01");
$endOfMonth   = date("Y-m-31");
$dateFormatToday = date("Y-m-d");
$today   = date("F d, o");
//echo $startOfMonth;
//echo $endOfMonth

 ?>

 <style>
#chartdiv {
  width: 100%;
  height: 300px;
}
</style>


<div class="row">

<div class="col-lg-4">
  <div class="card mt-2">
  <div class="card-body">
    <div class="col-lg-12 text-center">

    <div class="image-upload">
    <label for="file-input">

      <?php
      if ($img == NULL){
        echo '<img class="avatar user-thumb" src="assets/images/profilephoto/default.jpg" alt="avatar" style="border-radius: 50%; width:100px; height:100px; box-shadow: 0px 0px 5px 1px #888888; object-fit: cover;">';
      }else{
        echo '<img class="avatar user-thumb" src="'.$img.'" alt="avatar" style=" border-radius: 50%; width:100px; height:100px; box-shadow: 0px 0px 5px 1px #888888; object-fit: cover;">';
      }
       ?>

    </label>
      <form id="ppUpload" action="data/profilephotoupload.php" method="POST" enctype="multipart/form-data">
    <div style="display:none;">
    <input id="file-input" type="file" name="Filename"/>
  </form>
  </div>
</div>

<script>
document.getElementById("file-input").onchange = function() {
    document.getElementById("ppUpload").submit();
};
</script>



    </div>
<br>
    <div class="invoice-area">
                                      <div class="invoice-head">
                                          <div class="row">
                                              <div class="col-12" align="center">
                                                  <span><?php echo $user['first_name']." ".$user['last_name']; ?></span>
                                              </div>
                                              <div class="col-12" align="center">
                                                  <span><?php echo $user['company']; ?></span>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row align-items-center">
                                          <div class="col-md-12">
                                              <div class="invoice-address">
                                                <h5><?php echo $user['user_type']; ?></h5>
                                                  <p><?php echo $user['email']; ?></p>
                                              </div>
                                          </div>

                                      </div>
                                  </div>

  </div>
  </div>


</div>

<div class="col-lg-8">
      <div class="card mt-2">
      <div class="card-body">

      </div>
    </div>
</div>

<div class="col-lg-12">

    <div class="card mt-2">
    <div class="card-body">
      <h4 class="header-title">Senior Team Leaders</h4>
          <div class="member-box">
          <div class="row">

          <?php

                                        $query2 = "SELECT * FROM user WHERE user_type='Senior Team Leader'";
                                        $r2 = mysql_query($query2, $dbc);

                                        while($teamMember = mysql_fetch_array($r2)){
                                          echo '<div class="col-lg-6">';
                                          echo '<a href="module.php?m=profile&a=profileView&userID='.$teamMember['user_id'].'">';
                                          echo '<div class="s-member">
                                                <div class="media align-items-center">';
                                          if ($teamMember['img'] == NULL){
                                            echo '<img src="assets/images/profilephoto/default.jpg" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover;">';
                                          }else{
                                            echo '<img src="'.$teamMember['img'].'" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover;">';
                                          }
                                          echo '<div class="media-body ml-5">';
                                          echo '<p>'.$teamMember['first_name']." ".$teamMember['last_name'].'</p><span>'.$teamMember['company'].'</span>';
                                          echo '</div>
                                               </div>
                                               </div></a>';
                                          echo '</div>';
                                        }

           ?>

      </div>
      </div>
    </div>
  </div>

  <div class="card mt-2">
  <div class="card-body">
    <h4 class="header-title">Team Leaders</h4>

        <div class="member-box">
        <div class="row">

        <?php

                                      $query2 = "SELECT * FROM user WHERE user_type='Team Leader'";
                                      $r2 = mysql_query($query2, $dbc);

                                      while($teamMember = mysql_fetch_array($r2)){
                                        echo '<div class="col-lg-4">';
                                        echo '<a href="module.php?m=profile&a=profileView&userID='.$teamMember['user_id'].'">';
                                        echo '<div class="s-member">
                                              <div class="media align-items-center">';
                                        if ($teamMember['img'] == NULL){
                                          echo '<img src="assets/images/profilephoto/default.jpg" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover;">';
                                        }else{
                                          echo '<img src="'.$teamMember['img'].'" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover;">';
                                        }
                                        echo '<div class="media-body ml-5">';
                                        echo '<p>'.$teamMember['first_name']." ".$teamMember['last_name'].'</p><span>'.$teamMember['company'].'</span>';
                                        echo '</div>
                                             </div>
                                             </div></a>';
                                        echo '</div>';
                                      }


         ?>

    </div>
    </div>


  </div>
</div>

  <div class="card mt-2">
  <div class="card-body">
    <h4 class="header-title">Advertisers</h4>

    <div class="member-box">
    <div class="row">

    <?php

                                  $query2 = "SELECT * FROM user WHERE user_type='Advertiser' AND access_level != '0'";
                                  $r2 = mysql_query($query2, $dbc);

                                  while($teamMember = mysql_fetch_array($r2)){
                                    echo '<div class="col-lg-4">';
                                    echo '<a href="module.php?m=profile&a=profileView&userID='.$teamMember['user_id'].'">';
                                    echo '<div class="s-member">
                                          <div class="media align-items-center">';
                                    if ($teamMember['img'] == NULL){
                                      echo '<img src="assets/images/profilephoto/default.jpg" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover;">';
                                    }else{
                                      echo '<img src="'.$teamMember['img'].'" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover;">';
                                    }
                                    echo '<div class="media-body ml-5">';
                                    echo '<p>'.$teamMember['first_name']." ".$teamMember['last_name'].'</p><span>'.$teamMember['company'].'</span>';
                                    echo '</div>
                                         </div>
                                         </div></a>';
                                    echo '</div>';
                                  }


     ?>

</div>
</div>

</div>
</div>







</div>

</div>
