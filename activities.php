<?php
$userID = $_SESSION['user'];
$r = mysqli_query($dbc, "SELECT * FROM _activities WHERE owner='$userID' ORDER BY activities_id DESC LIMIT 20");
while($activities = mysqli_fetch_array($r)){

$date = date_create($activities['activities_dateTime']);
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

switch($activities['type']){
  case "uploadcsv":
  echo '<div class="timeline-task">
      <div class="icon bg1">
          <i class="ti-upload"></i>
      </div>
      <div class="tm-title">';
  echo '<h4>'.$activities['action'].'</h4>';
  echo '<span class="time"><i class="ti-time"></i>'.$day.$newTime.'</span>
      </div>
      </div>';
  break;

  case "candidateedit":
  echo '<div class="timeline-task">
      <div class="icon bg1">
          <i class="ti-pencil"></i>
      </div>
      <div class="tm-title">';
  echo '<h4>'.$activities['action'].'</h4>';
  echo '<span class="time"><i class="ti-time"></i>'.$day.$newTime.'</span>
      </div>
      <p><a href="module.php?m=candidates&a=show&candidateID='.$activities['link'].'">'.$activities['candidate_info'].'</a> has new changes.</p>
      </div>';
  break;

  case "candidateadd":
  echo '<div class="timeline-task">
      <div class="icon bg2">
          <i class="ti-plus"></i>
      </div>
      <div class="tm-title">';
  echo '<h4>'.$activities['action'].'</h4>';
  echo '<span class="time"><i class="ti-time"></i>'.$day.$newTime.'</span>
      </div>
      <p><a href="module.php?m=candidates&a=show&candidateID='.$activities['link'].'">'.$activities['candidate_info'].'</a> added.</p>
      </div>';
  break;

  case "candidatedelete":
  echo '<div class="timeline-task">
      <div class="icon bg3">
          <i class="ti-eraser"></i>
      </div>
      <div class="tm-title">';
  echo '<h4>'.$activities['action'].'</h4>';
  echo '<span class="time"><i class="ti-time"></i>'.$day.$newTime.'</span>
      </div>
      <p>'.$activities['candidate_info'].' has been deleted!</p>
      </div>';
  break;

    case "candidateduplicate":
    echo '<div class="timeline-task">
        <div class="icon bg1">
            <i class="ti-pencil"></i>
        </div>
        <div class="tm-title">';
    echo '<h4>'.$activities['action'].'</h4>';
    echo '<span class="time"><i class="ti-time"></i>'.$day.$newTime.'</span>
        </div>
        <p><a href="module.php?m=candidates&a=show&candidateID='.$activities['link'].'">'.$activities['candidate_info'].'</a> has new changes!</p>
        </div>';
    break;

}

}


?>
