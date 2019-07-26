<?php
include('db.php');
session_start();

$userID = $_SESSION['user'];
$candidateID = $_POST['candidateid'];
$dateToday = date('Y-m-d G:i:s');

$r = mysqli_query($dbc, "SELECT first_name, last_name FROM user WHERE user_id='$userID'");
$user = mysqli_fetch_array($r);
$userFullName = $user['first_name']." ".$user['last_name'];

$count = count($candidateID);

for($x = 0; $x < $count; $x++){


  $r2 = mysqli_query($dbc, "SELECT candidate_id, first_name, last_name, phone_cell, owner FROM candidate WHERE candidate_id='$candidateID[$x]'");
  $candidate = mysqli_fetch_array($r2);

  $candidateOwner = $candidate['owner'];
  $candidateInfo  = $candidate['first_name']." ".$candidate['last_name'];

if($userID == $candidateOwner){

      $newaction = "You deleted your candidate.";
      $activity2 = "INSERT INTO _activities(
                        action,
                        candidate_info,
                        type,
                        activities_dateTime,
                        owner
                        )VALUES(
                        '$newaction',
                        '$candidateInfo',
                        'candidatedelete',
                        '$dateToday',
                        '$userID'
                        )";
        @mysqli_query($dbc, $activity2);


}else{

      $action = $userFullName." deleted your candidate.";
      $activity = "INSERT INTO _activities(
                    action,
                    candidate_info,
                    type,
                    activities_dateTime,
                    owner
                    )VALUES(
                    '$action',
                    '$candidateInfo',
                    'candidatedelete',
                    '$dateToday',
                    '$candidateOwner'
                    )";
      @mysqli_query($dbc, $activity);

      $action = "You deleted a candidate.";
      $activity = "INSERT INTO _activities(
                          action,
                          candidate_info,
                          type,
                          activities_dateTime,
                          owner
                          )VALUES(
                          '$action',
                          '$candidateInfo',
                          'candidatedelete',
                          '$dateToday',
                          '$userID'
                          )";
            @mysqli_query($dbc, $activity);

}






  //echo $candidateID[$x]."<br>";
  $delete = "DELETE FROM candidate WHERE candidate_id='$candidateID[$x]'";
  @mysqli_query($dbc, $delete);

}



$header = 'Location: ../module.php?m=candidates&a=home';
header($header);

?>
