<?php session_start(); ?>
<!doctype html>
<?php
include('data/db.php');
//@mysql_query("set character_set_results='utf8'");
mysqli_query($dbc, "SET NAMES 'utf8'");
mysqli_query($dbc, "SET CHARACTER SET 'utf8'");
mysqli_set_charset($dbc,"utf8");
/* validate */
$userID = $_SESSION['user'];
if($userID == NULL){
  echo "<script type='text/javascript'>window.top.location='index.php?notLoggedIn=true';</script>";
}

$query = mysqli_query($dbc, "SELECT * FROM user WHERE user_id='$userID'");
$user  = mysqli_fetch_array($query);
$userType = $user['user_type'];
// update change notif to read
if(isset($_GET['notif'])){
$notifID = $_GET['notif'];
mysqli_query($dbc, "UPDATE _notifications SET status='Read' WHERE notification_id='$notifID'");
}

if(isset($_GET['readAll'])){
  $query = "SELECT * FROM _notifications WHERE owner='$userID'";
  $r = mysqli_query($dbc, $query);
  while($notification = mysqli_fetch_array($r)){
    $notifID = $notification['notification_id'];
    mysqli_query($dbc, "UPDATE _notifications SET status='Read' WHERE notification_id='$notifID'");
  }
}
?>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Metacom ATS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
<!--
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">-->
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">

    <?php
    if ($user['night_mode'] == "on"){
      echo '<link rel="stylesheet" href="assets/css/styles-darkmode.css">';
    }else{
      echo '<link rel="stylesheet" href="assets/css/styles.css">';
    }
    ?>


    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->

        <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">


    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>





<style>
#snackbar {
  visibility: hidden;
  min-width: 300px;
  margin-left: -125px;
  background-color: #007bff;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  right: 1%;
  bottom: 20px;
  font-size: 17px;
  box-shadow: 2px 2px 5px #888888;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 4.5s;
  animation: fadein 0.5s, fadeout 0.5s 4.5s;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 20px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 20px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 20px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 20px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
</style>




<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <!--<div id="preloader">
        <div class="loader"></div>
    </div>-->



    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <?php include('sidebar.php'); ?>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="module.php" method="GET">
                              <?php
                              if (isset($_GET['myCandidatesOnly'])){
                                echo '<input type="hidden" name="myCandidatesOnly" value="true">';
                              }
                               ?>

                              <?php
                              if (isset($_GET['k'])){
                                $keyword = $_GET['k'];
                              }else{
                                $keyword="";
                              }
                              ?>

                                <input type="text" name="k" placeholder="Search..." value="<?php echo $keyword; ?>" required>
                                <input type="hidden" name="m" value="candidates">
                                <input type="hidden" name="a" value="search">
                                <i class="ti-search"></i>
                            </form>


                        </div>

                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                          <?php
                          if ($user['night_mode'] == "on"){
                            echo '<a href="data/changemode.php"><li><i class="fa fa-moon-o"></i></li></a>';
                          }else{
                            echo '<a href="data/changemode.php"><li><i class="fa fa-sun-o"></i></li></a>';
                          }
                          ?>

                          <?php
                          $counter = mysqli_query($dbc, "SELECT COUNT(DISTINCT notification_id) AS id FROM _notifications WHERE owner='$userID' AND status IS NULL");
                          $num = mysqli_fetch_array($counter);
                          $count = $num["id"];
                          if ($num["id"] == NULL){
                            $count = "0";
                          }
                           ?>

                           <?php
                           if($count == 0){
                             $notifBellAnimate = 'class="dropdown"';
                           }else{
                             $notifBellAnimate = 'class="dropdown animated wobble delay-3s"';
                           }
                           ?>

                            <li <?php echo $notifBellAnimate; ?>>

                                <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                                    <span><?php echo $count; ?></span>
                                </i>



                                <div class="dropdown-menu bell-notify-box notify-box">
                                  <?php

                                  if($count == "1"){
                                    $message = "You have 1 new notification!";
                                  }

                                  if($count == "0"){
                                    $message = "You have no new notification!";
                                  }

                                  if($count > 1){
                                    $message = "You have ".$count." new notifications!";
                                  }

                                  ?>

                                    <span class="notify-title"> <?php echo $message; ?> </span>

                                    <div class="nofity-list">
                                        <?php

                                        if($count == "0"){
                                          echo '<a href="module.php?m=candidates&a=home&readAll=true" align="right">
                                          <button class="btn btn-warning btn-flat btn-xs btn-block" disabled>Nothing New Here</button></a>';
                                        }else{
                                          echo '<a href="module.php?m=candidates&a=home&readAll=true" align="right">
                                          <button class="btn btn-warning btn-flat btn-xs btn-block">Mark All as Read</button></a>';
                                        }

                                        include('notifications.php');


                                         ?>
                                        </div>
                                </div>
                            </li>

                            <li class="settings-btn">
                                <i class="ti-layout-list-thumb"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">

                          <?php
                          $moduleName = $_GET['m'];
                          $actionName = $_GET['a'];
                          switch($moduleName){
                            case "candidates":
                            $homeLink = "module.php?m=candidates&a=home";
                            $pageTitle = "Candidates";
                            $breadCrumbs = "Candidates";
                            break;

                            case "profile":
                            $homeLink = "module.php?m=candidates";
                            $pageTitle = "Profile";
                            $breadCrumbs = "Profile";
                            break;

                          }
                          if($actionName == "search"){
                            $pageTitle = "Candidates: Search Result for "."<span style='color:green;'>".$_GET['k']."</span>";
                            $breadCrumbs = "Search";
                          }

                           ?>
                            <h4 class="page-title pull-left"><?php echo $pageTitle; ?></h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="<?php echo $homeLink; ?>">Home</a></li>
                                <li><span><?php echo $breadCrumbs; ?></span></li>

                            </ul>
                        </div>
                    </div>
                    <?php include('currentuser.php'); ?>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- sales report area start -->

                <?php

                $moduleName = $_GET['m'];
                $actionName = $_GET['a'];

                if($moduleName == "dashboard"){
                  include('dashboard.php');
                }

                if($moduleName == "feed"){
                  include('feed.php');
                }

                if($moduleName == "profile"){

                  if($actionName == "profileView"){
                    include('profileview.php');
                  }else{
                    if($userType == "Sourcing Admin"){
                      include('profile-sourcingadmin.php');
                    }else{
                      include('profile.php');
                    }

                  }

                }

                if($moduleName == "notifsandactivities"){
                  include('notifsandactivities.php');
                }

                if($moduleName == "candidates"){

                switch($actionName){
                  case "home":
                  include('candidates.php');
                  break;

                  case "excel":
                  include('candidates-excel.php');
                  break;

                  case "importcsv":
                  include('importcsv.php');
                  break;

                  case "show":
                  include('show.php');
                  break;

                  case "edit":
                  include('edit.php');
                  break;

                  case "add":
                  include('add.php');
                  break;

                  case "addwalkin":
                  include('addwalkin.php');
                  break;

                  case "search":
                  include('search.php');
                  break;
                }

              }

                 ?>
<div style="display:none;">
<button id="snackbutton" onclick="myFunction()" >Show Snackbar</button>
</div>

<?php
$counter = mysqli_query($dbc, "SELECT COUNT(DISTINCT notification_id) AS id FROM _notifications WHERE owner='$userID' AND status IS NULL");
$num = mysqli_fetch_array($counter);
$count = $num["id"];
if ($num["id"] == NULL){
  $count = "0";
}

if($count == 0){
  $snackbarDisplay = 'style="display:none;';
}
if($count == 1){
  $message = "You have ".$count." new notification!";
}else{
  $message = "You have ".$count." new notifications!";
}
?>
<div id="snackbar" <?php echo $snackbarDisplay; ?>>
<?php echo $message; ?>
</div>
            </div>
        </div>


        <!-- main content area end -->
        <!-- footer area start-->
        <?php include('footer.php'); ?>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    <div class="offset-area">
        <div class="offset-close"><i class="ti-close"></i></div>
        <ul class="nav offset-menu-tab">
            <li><a class="active" data-toggle="tab" href="#activity">Recent Activities</a></li>
        </ul>
        <div class="offset-content tab-content">
            <div id="activity" class="tab-pane fade in show active">
                <div class="recent-activity">
                    <?php include('activities.php'); ?>
                </div>
            </div>

        </div>
    </div>
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>


<!--
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
-->




<!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="assets/js/pie-chart.js"></script>
    <script src="assets/js/bar-chart.js"></script>
  -->

    <script src="assets/js/line-chart.js"></script>

    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

<script>
$(document).ready(function(){
    $("#snackbutton").trigger("click");
});

function myFunction() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
}
</script>

  <script>

  $(function() {

      $('#applicationStatus').change(function(){
          if($('#applicationStatus').val() == 'Not Hired') {
              $('#hiredDate').hide();
              $('#hiringCompanyRow').hide();
              $('#pointAssignmentRow').hide();
          }

          if($('#applicationStatus').val() == 'No Response') {
              $('#hiredDate').hide();
              $('#hiringCompanyRow').hide();
              $('#pointAssignmentRow').hide();
          }

          if($('#applicationStatus').val() == 'Pending') {
              $('#hiredDate').hide();
              $('#hiringCompanyRow').hide();
              $('#pointAssignmentRow').hide();
          }

          if($('#applicationStatus').val() == 'Hired') {
              $('#hiredDate').show();
              $('#hiringCompanyRow').show();
              $('#pointAssignmentRow').show();
          }


      });

      $('#confirmationStatus2').change(function(){
          if($('#confirmationStatus2').val() == 'Confirmed') {
              $('#confirmedDate2').show();
          }


      });





  });



  </script>


</body>

</html>
