

<?php
include('data/db.php');
session_start();
$userID = $_SESSION['user'];
$r = mysqli_query($dbc, "SELECT * FROM user WHERE user_id='$userID'");
$user = mysqli_fetch_array($r);

$r2 = mysqli_query($dbc, "SELECT * FROM _feed ORDER BY feed_id DESC");

while($feed = mysqli_fetch_array($r2)){


  $feedOwnerID = $feed['owner'];

  $r3 = mysqli_query($dbc, "SELECT * FROM user WHERE user_id='$feedOwnerID'");
  $feedOwner = mysqli_fetch_array($r3);
  $feedOwnerFullname = $feedOwner['first_name']." ".substr($feedOwner['last_name'], 0, 1).".";

  $feedDate = date_create($feed['feed_dateTime']);
  $newDateTime = date_format($feedDate,"M. d h:i a");

  echo '<div class="tst-item">
        <div class="tstu-img">';
        if ($feedOwner['img'] == NULL){
          echo '<img class="d-block ui-w-30 rounded-circle" src="assets/images/profilephoto/default.jpg" alt="author image" style="width:60px;height:60px;">';
        }else{
          echo '<img class="d-block ui-w-30 rounded-circle" src="'.$feedOwner['img'].'" alt="author image" style="width:60px;height:60px;">';
        }
  echo '</div>
        <div class="tstu-content" >';
  echo '<h4 class="tstu-name"style="color:black;">'.$feedOwnerFullname.'<br><span style="color:black;font-size:10px;">'.$feedOwner['user_type']."</span>".'
        <small style="font-size:9px;color:grey;">'.$newDateTime.'</small></h4>';
  echo '<p style="color:black; font-size:12px;">'.$feed['action'].'</p><br>';
  echo '</div>';
  if ($feed['type'] == "eod"){
    echo '<div align="right"><button class="btn btn-primary">Download EOD File</button></div>';
  }
  echo '</div><hr>';

}

 ?>
 <!--
    <div class="tst-item">
    <div class="tstu-img">
    <img src="assets/images/profilephoto/default.jpg" alt="author image">
    </div>
    <div class="tstu-content" >
    <h4 class="tstu-name"style="color:black;">Ryan Biton</h4>
    <span class="profsn"style="color:black;">Web Developer</span>
    <p style="color:black; font-size:13px;">ATS Redesign Updates! Several changes have been made to ATS, including new fields and security measures.</p>
    </div>
    </div>

<hr>
    <div class="tst-item">
    <div class="tstu-img">
    <img src="assets/images/profilephoto/default.jpg" alt="author image">
    </div>
    <div class="tstu-content" >
    <h4 class="tstu-name"style="color:black;">Hannah Bolocon</h4>
    <span class="profsn"style="color:black;">Receptionist</span>
    <p style="color:black; font-size:13px;">Candidate Name (owned by Owner Name) attended today.</p>
    </div>
    </div>

<hr>
    <div class="tst-item">
    <div class="tstu-img">
    <img src="assets/images/profilephoto/default.jpg" alt="author image">
    </div>
    <div class="tstu-content" >
    <h4 class="tstu-name"style="color:black;">Hannah Bolocon</h4>
    <span class="profsn"style="color:black; font-size:11px;">Receptionist</span>
    <p style="color:black; font-size:13px;">Aspire EOD Report Available for Today (February 7, 2018).</p>
    <div align="right">
    <button type="button" class="btn btn-rounded btn-primary mb-3">Download EOD File</button>
   </div>
    </div>
    </div>
-->
