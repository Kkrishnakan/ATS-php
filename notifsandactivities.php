<?php
$userID = $_SESSION['user'];
$query = "SELECT * FROM user WHERE user_id='$userID'";
$r = mysqli_query($dbc, $query);
$user = mysqli_fetch_array($r);
?>


<div class="row">
<div class="col-lg-6">
  <div class="card mt-2">
  <div class="card-body">
    <h4 class="header-title">Notifications</h4>

    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 500px;">
      <div class="timeline-area" style="overflow: hidden; width: auto; height: 500px;">

        <?php
        $userID = $_SESSION['user'];
        $query = "SELECT * FROM _notifications WHERE owner='$userID' ORDER BY notification_id DESC";
        $r = mysqli_query($dbc, $query);
        while($notification = mysqli_fetch_array($r)){

        $date = date_create($notification['activities_dateTime']);
        $newTime = date_format($date,"h:i a");
        $newDate = date_format($date,"Y-m-d");

        $current_date = date_create('Y-m-d');

        $earlier = new DateTime($newDate);
        $later = new DateTime($current_date);
        $diff = $later->diff($earlier)->format("%a");


        if($diff == 0){
          $day = "Today ";
        }else{
          $day = $diff."d ";
        }

        if($diff == 1){
          $day = "Yesterday ";
        }

        $link = "module.php?m=candidates&a=show&candidateID=".$notification['link']."&notif=".$notification['notification_id'];

        if ($notification['status'] == "Read"){
          $notifItem = '<a href="'.$link.'" class="notify-item">';
        }else{
          $notifItem = '<a href="'.$link.'" class="notify-item bg-light">';
        }


        switch($notification['type']){

          case "candidatereplacement":
          echo $notifItem;
          echo '<div class="timeline-task">
                <div class="icon bg1">
                <i class="ti-face-sad"></i>
                </div>
                <div class="tm-title">';
          echo '<h4>'.$notification['action'].'</h4>
                <span class="time"><i class="ti-time"></i>'.$day.$newTime.'</span>
                </div>
                <p></p>
                </div></a>';

        }



        }
        ?>





                                </div>
                                <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 387.597px;">
                                </div>
                                <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                                </div>
                                </div>


  </div>
  </div>

</div>

<div class="col-lg-6">
  <div class="card mt-2">
  <div class="card-body">
    <h4 class="header-title">Activities</h4>

  </div>
</div>


</div>

</div>
