<?php
$userID = $_SESSION['user'];
$query = mysqli_query($dbc, "SELECT * FROM _notifications WHERE owner='$userID' ORDER BY notification_id DESC");
while($notification = mysqli_fetch_array($query)){

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

  case "candidatebilled":
  echo $notifItem;
  echo '<div class="notify-thumb"><i class="ti-money btn-success"></i></div>';
  echo '<div class="notify-text">';
  echo '<p>'.$notification['action'].'</p>';
  echo '<span>'.$day.$newTime.'</span>';
  echo '</div>';
  echo '</a>';
  break;

  case "candidatereplacement":
  echo $notifItem;
  echo '<div class="notify-thumb"><i class="ti-face-sad btn-danger"></i></div>';
  echo '<div class="notify-text">';
  echo '<p>'.$notification['action'].'</p>';
  echo '<span>'.$day.$newTime.'</span>';
  echo '</div>';
  echo '</a>';
  break;

  case "candidatehired":
  echo $notifItem;
  echo '<div class="notify-thumb"><i class="ti-heart btn-primary"></i></div>';
  echo '<div class="notify-text">';
  echo '<p>'.$notification['action'].'</p>';
  echo '<span>'.$day.$newTime.'</span>';
  echo '</div>';
  echo '</a>';
  break;

  case "candidateendorsed":
  echo $notifItem;
  echo '<div class="notify-thumb"><i class="ti-tag btn-info"></i></div>';
  echo '<div class="notify-text">';
  echo '<p>'.$notification['action'].'</p>';
  echo '<span>'.$day.$newTime.'</span>';
  echo '</div>';
  echo '</a>';
  break;

}



}


?>
