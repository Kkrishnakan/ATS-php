<?php
$userID = $_SESSION['user'];
$r = mysqli_query($dbc, "SELECT * FROM user WHERE user_id='$userID'");
$user = mysqli_fetch_array($r);

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
//echo $startOfMonth;
//echo $endOfMonth

;
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



 ?>


<div class="row">


<div class="col-lg-8">

    <div class="card mt-2">
    <div class="card-body">
      <h4 class="header-title">Feed</h4>
      <form action="data/post.php" method="POST">
      <textarea class="form-control" aria-label="With textarea" style="margin-top: 0px; margin-bottom: 0px; height: 50px;" placeholder="Create a post..." name="post"></textarea>
      <br>
      <button type="submit" class="btn btn-primary mb-3 pull-right">Post</button>
    </form>
    </div>
  </div>

  <div class="card mt-2">
  <div class="card-body">

<div id="feedContent"></div>


  </div>
</div>


</div>



</div>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript">

function loadlink(){
    $('#feedContent').load('feedcontent.php',function () {
    });
}

loadlink(); // This will run on page load

setInterval(function(){
    loadlink() // this will run after every 5 seconds
}, 2000);
</script>
