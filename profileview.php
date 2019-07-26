<?php
$userID = $_GET['userID'];
$r = mysqli_query($dbc, "SELECT * FROM user WHERE user_id='$userID'");
$user = mysqli_fetch_array($r);

$teamLeader = $user['team_leader'];
$myTeamLeader = $user['team_leader'];
$userType = $user['user_type'];

$img = $user['img'];

$startOfMonth = date("M. 1, o");
$endOfMonth   = date("M. 31, o");
$currentMonth = $startOfMonth." - ".$endOfMonth;

$startOfMonth = date("Y-m-01");
$endOfMonth   = date("Y-m-31");

$dateFormatToday = date("Y-m-d");
$today   = date("F d, o");
//echo $startOfMonth;
//echo $endOfMonth


$getAttendeesCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE owner='$userID' AND date_attended BETWEEN '$startOfMonth' AND '$endOfMonth' ");
$num = mysqli_fetch_array($getAttendeesCurrentMonth);
$totalAttendeesCurrentMonth = $num["id"];
if ($num["id"] == NULL){ $totalAttendeesCurrentMonth = "0"; }


$getHiredCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE owner='$userID' AND application_status = 'Hired' AND hired_date BETWEEN '$startOfMonth' AND '$endOfMonth' ");
$num = mysqli_fetch_array($getHiredCurrentMonth);
$totalHiredCurrentMonth = $num["id"];
if ($num["id"] == NULL){ $totalHiredCurrentMonth = "0"; }


$getConfirmsCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE owner='$userID' AND confirmed_date_of_interview BETWEEN '$startOfMonth' AND '$endOfMonth' ");
$num = mysqli_fetch_array($getConfirmsCurrentMonth);
$totalConfirmsCurrentMonth = $num["id"];
if ($num["id"] == NULL){ $totalConfirmsCurrentMonth = "0"; }


$getEndorsedCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE owner='$userID' AND endorsement_status = 'Endorsed' AND date_attended BETWEEN '$startOfMonth' AND '$endOfMonth' ");
$num = mysqli_fetch_array($getEndorsedCurrentMonth);
$totalEndorsedCurrentMonth = $num["id"];
if ($num["id"] == NULL){ $totalEndorsedCurrentMonth = "0"; }

// for today

$getConfirmsToday = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE owner='$userID' AND confirmed_date_of_interview = '$dateFormatToday'");
$num = mysqli_fetch_array($getConfirmsToday);
$totalConfirmsToday = $num["id"];
if ($num["id"] == NULL){ $totalConfirmsToday = "0"; }


$getAttendeesToday = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE owner='$userID' AND date_attended = '$dateFormatToday'");
$num = mysqli_fetch_array($getAttendeesToday);
$totalAttendeesToday = $num["id"];
if ($num["id"] == NULL){ $totalAttendeesToday = "0"; }

$getHiredToday = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE owner='$userID' AND application_status = 'Hired' AND hired_date= '$dateFormatToday' ");
$num = mysqli_fetch_array($getHiredToday);
$totalHiredToday = $num["id"];
if ($num["id"] == NULL){ $totalHiredToday = "0"; }


$getEndorsedToday = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE owner='$userID' AND endorsement_status = 'Endorsed' AND date_attended = '$dateFormatToday' ");
$num = mysqli_fetch_array($getEndorsedToday);
$totalEndorsedToday = $num["id"];
if ($num["id"] == NULL){ $totalEndorsedToday = "0"; }



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

      <?php
      if ($img == NULL){
        echo '<img class="avatar user-thumb" src="assets/images/profilephoto/default.jpg" alt="avatar" style="border-radius: 50%; width:100px; height:100px; box-shadow: 0px 0px 5px 1px #888888; object-fit: cover;">';
      }else{
        echo '<img class="avatar user-thumb" src="'.$img.'" alt="avatar" style="border-radius: 50%; width:100px; height:100px; box-shadow: 0px 0px 5px 1px #888888; object-fit: cover;">';
      }
       ?>

    </div>
<br>
    <div class="invoice-area">
                                      <div class="invoice-head">
                                          <div class="row">
                                              <div class="iv-left col-8">
                                                  <span><?php echo $user['first_name']." ".$user['last_name']; ?></span>
                                              </div>
                                              <div class="iv-right col-4 text-md-right">
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

                                  <hr>


                                <div class="d-sm-flex flex-wrap justify-content-between mb-4 align-items-center">
                                    <h4 class="header-title mb-0">Team Members</h4>
                                </div>
                                <div class="member-box">

                                  <?php
                                if($userType == "Team Leader"){

                                  $r4 = mysqli_query($dbc, "SELECT * FROM user WHERE user_id='$teamLeader'");
                                  $seniorTeamLeader = mysqli_fetch_array($r4);
                                  //get team leader

                                  // get senior team leader

                                  echo '<div class="s-member">
                                        <div class="media align-items-center">';

                                if ($seniorTeamLeader['img'] == NULL){
                                  echo '<img src="assets/images/profilephoto/default.jpg" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover; object-fit: cover; object-fit: cover;">';
                                }else{
                                  echo '<img src="'.$seniorTeamLeader['img'].'" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover; object-fit: cover; object-fit: cover;">';
                                }

                                  echo '<div class="media-body ml-5">';
                                  echo '<p>'.$seniorTeamLeader['first_name']." ".$seniorTeamLeader['last_name'].'</p><span>'.$seniorTeamLeader['company'].' <br> '.$seniorTeamLeader['user_type'].'</span>';
                                  echo '</div>
                                       </div>
                                       </div>';


                                  $r2 = mysqli_query($dbc, "SELECT * FROM user WHERE team_leader='$userID'");


                                  while($teamMember = mysqli_fetch_array($r2)){
                                    echo '<div class="s-member">
                                          <div class="media align-items-center">';
                                    if ($teamMember['img'] == NULL){
                                      echo '<img src="assets/images/profilephoto/default.jpg" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover; object-fit: cover; object-fit: cover;">';
                                    }else{
                                      echo '<img src="'.$teamMember['img'].'" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover; object-fit: cover; object-fit: cover;">';
                                    }
                                    echo '<div class="media-body ml-5">';
                                    echo '<p>'.$teamMember['first_name']." ".$teamMember['last_name'].'</p><span>'.$teamMember['company'].' <br>  '.$teamMember['user_type'].'</span>';
                                    echo '</div>
                                         </div>
                                         </div>';
                                  }



                                }






                                if($userType == "Senior Team Leader"){

                                  // get Team Leader Members

                                  $r6 = mysqli_query($dbc, "SELECT * FROM user WHERE team_leader='$userID'");
                                  while($teamLeader = mysqli_fetch_array($r6)){

                                  $teamLeaderID = $teamLeader['user_id'];
                                    echo '<div class="s-member">
                                          <div class="media align-items-center">';
                                    if ($teamLeader['img'] == NULL){
                                      echo '<img src="assets/images/profilephoto/default.jpg" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover; object-fit: cover; object-fit: cover;">';
                                    }else{
                                      echo '<img src="'.$teamLeader['img'].'" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover; object-fit: cover; object-fit: cover;">';
                                    }
                                    echo '<div class="media-body ml-5">';
                                    echo '<p>'.$teamLeader['first_name']." ".$teamLeader['last_name'].'</p><span>'.$teamLeader['company'].' <br>  '.$teamLeader['user_type'].'</span>';
                                    echo '</div>
                                         </div>
                                         </div>';


                                  //echo $teamLeaderID;

                                  $r7 = mysqli_query($dbc, "SELECT * FROM user WHERE team_leader='$teamLeaderID'");
                                  while($teamMember = mysqli_fetch_array($r7)){
                                  echo '<div class="s-member">
                                        <div class="media align-items-center">';

                                if ($teamMember['img'] == NULL){
                                  echo '<img src="assets/images/profilephoto/default.jpg" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover; object-fit: cover; object-fit: cover;">';
                                }else{
                                  echo '<img src="'.$teamMember['img'].'" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover; object-fit: cover; object-fit: cover;">';
                                }

                                  echo '<div class="media-body ml-5">';
                                  echo '<p>'.$teamMember['first_name']." ".$teamMember['last_name'].'</p><span>'.$teamMember['company'].' <br> '.$teamMember['user_type'].'</span>';
                                  echo '</div>
                                       </div>
                                       </div>';

                                    }
                                  }
                                }



                                if($userType == "Advertiser"){

                                  $r5 = mysqli_query($dbc, "SELECT * FROM user WHERE user_id='$myTeamLeader'");
                                  $getSeniorTeamLeader = mysqli_fetch_array($r5);

                                  $getSeniorTeamLeaderID = $getSeniorTeamLeader['team_leader'];

                                  $r6 = mysqli_query($dbc, "SELECT * FROM user WHERE user_id='$getSeniorTeamLeaderID'");
                                  $seniorTeamLeader = mysqli_fetch_array($r6);

                                  // get senior team leader

                                  echo '<div class="s-member">
                                        <div class="media align-items-center">';

                                if ($seniorTeamLeader['img'] == NULL){
                                  echo '<img src="assets/images/profilephoto/default.jpg" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover; object-fit: cover; object-fit: cover;">';
                                }else{
                                  echo '<img src="'.$seniorTeamLeader['img'].'" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover; object-fit: cover; object-fit: cover;">';
                                }

                                  echo '<div class="media-body ml-5">';
                                  echo '<p>'.$seniorTeamLeader['first_name']." ".$seniorTeamLeader['last_name'].'</p><span>'.$seniorTeamLeader['company'].' <br> '.$seniorTeamLeader['user_type'].'</span>';
                                  echo '</div>
                                       </div>
                                       </div>';

                                  $r2 = mysqli_query($dbc, "SELECT * FROM user WHERE user_id='$myTeamLeader'");
                                  $teamLeader = mysqli_fetch_array($r2);

                                    echo '<div class="s-member">
                                          <div class="media align-items-center">';
                                    if ($teamLeader['img'] == NULL){
                                      echo '<img src="assets/images/profilephoto/default.jpg" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover; object-fit: cover; object-fit: cover;">';
                                    }else{
                                      echo '<img src="'.$teamLeader['img'].'" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover; object-fit: cover; object-fit: cover;">';
                                    }
                                    echo '<div class="media-body ml-5">';
                                    echo '<p>'.$teamLeader['first_name']." ".$teamLeader['last_name'].'</p><span>'.$teamLeader['company'].' <br>  '.$teamLeader['user_type'].'</span>';
                                    echo '</div>
                                         </div>
                                         </div>';

                                  $r2 = mysqli_query($dbc, "SELECT * FROM user WHERE user_id != '$userID' AND team_leader='$myTeamLeader'");

                                  while($teamMember = mysqli_fetch_array($r2)){
                                    echo '<div class="s-member">
                                          <div class="media align-items-center">';
                                    if ($teamMember['img'] == NULL){
                                      echo '<img src="assets/images/profilephoto/default.jpg" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover; object-fit: cover; object-fit: cover;">';
                                    }else{
                                      echo '<img src="'.$teamMember['img'].'" alt="avatar" class="d-block ui-w-30 rounded-circle" alt="" style="width:60px;height:60px; object-fit: cover; object-fit: cover; object-fit: cover;">';
                                    }
                                    echo '<div class="media-body ml-5">';
                                    echo '<p>'.$teamMember['first_name']." ".$teamMember['last_name'].'</p><span>'.$teamMember['company'].' <br>  '.$teamMember['user_type'].'</span>';
                                    echo '</div>
                                         </div>
                                         </div>';
                                  }

                                }


                                  ?>

                                </div>





  </div>
  </div>
        <div class="card mt-2">
        <div class="card-body">
          <h4 class="header-title">Activities</h4>
  <div class="recent-activity">
          <?php
          include('activitiesview.php'); ?>
        </div>
        </div>
        </div>

</div>

<div class="col-lg-8">

      <div class="card mt-2">
      <div class="card-body">
        <h4 class="header-title">User Stats Today (<?php echo $today; ?>)</h4>
        <div class="row">

          <div class="col-lg-12">
            <div id="chartdiv"></div>
          </div>

        </div>
      </div>
    </div>

  <div class="card mt-2">
  <div class="card-body">
    <h4 class="header-title">User Stats as of <?php echo $currentMonth; ?></h4>
                                      <div class="row">

                                        <div class="col-md-6 mb-3 mb-lg-0">
                                        <div class="card">
                                    <div class="seo-fact sbg3">
                                        <div class="p-4 d-flex justify-content-between align-items-center"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                            <div class="seofct-icon"><?php echo $totalConfirmsCurrentMonth; ?> Confirms</div>
                                            <canvas id="seolinechart3" height="43" width="144" class="chartjs-render-monitor" style="display: block; width: 144px; height: 43px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="seo-fact sbg4">
                                        <div class="p-4 d-flex justify-content-between align-items-center"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                            <div class="seofct-icon"><?php echo $totalEndorsedCurrentMonth; ?> Endorsed</div>
                                            <canvas id="seolinechart4" height="43" width="144" class="chartjs-render-monitor" style="display: block; width: 144px; height: 43px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                        <div class="col-md-6 mt-md-2 mb-3">
                                            <div class="card">
                                                <div class="seo-fact sbg2">
                                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                                        <div class="seofct-icon"><i class="ti-user"></i> </div>
                                                        <h2><?php echo $totalAttendeesCurrentMonth; ?> Attendees <br><small>as of date</small></h2>
                                                    </div>
                                                    <canvas id="seolinechart2" height="50"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-2 mb-3">
                                            <div class="card">
                                                <div class="seo-fact sbg1">
                                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                                        <div class="seofct-icon"><i class="ti-heart"></i> </div>
                                                        <h2><?php echo $totalHiredCurrentMonth; ?>  hires <br><small>as of date</small></h2>
                                                    </div>
                                                    <canvas id="seolinechart1" height="50"></canvas>
                                                </div>
                                            </div>
                                        </div>




                                    </div>

  </div>
</div>





</div>

</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>

    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<script>
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

<?php

    echo "var confirmsToday     = ".$totalConfirmsToday.";";
    echo "var attendeesToday     = ".$totalAttendeesToday.";";
    echo "var endorsedToday     = ".$totalEndorsedToday.";";
    echo "var hiredToday     = ".$totalHiredToday.";";
 ?>

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart3D);

// Add data
chart.data = [{
  "year": "Confirms",
  "income": confirmsToday,
  "color": chart.colors.next()
}, {
  "year": "Attendees",
  "income": attendeesToday,
  "color": chart.colors.next()
}, {
  "year": "Endorsed",
  "income": endorsedToday,
  "color": chart.colors.next()
}, {
  "year": "Hires",
  "income": hiredToday,
  "color": chart.colors.next()
}];

// Create axes
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.numberFormatter.numberFormat = "#";
categoryAxis.renderer.inversed = true;

var  valueAxis = chart.xAxes.push(new am4charts.ValueAxis());

// Create series
var series = chart.series.push(new am4charts.ColumnSeries3D());
series.dataFields.valueX = "income";
series.dataFields.categoryY = "year";
series.name = "Income";
series.columns.template.propertyFields.fill = "color";
series.columns.template.tooltipText = "{valueX}";
series.columns.template.column3D.stroke = am4core.color("#fff");
series.columns.template.column3D.strokeOpacity = 0.2;
</script>
