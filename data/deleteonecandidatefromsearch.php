<?php
include('db.php');
session_start();

$userID = $_SESSION['user'];
$dateToday = date('Y-m-d G:i:s');

$candidateID         = $_GET['candidateID'];
$k                   = $_GET['k'];
$m                   = $_GET['m'];
$a                   = $_GET['a'];


  $query3 = mysqli_query( $dbc, "SELECT first_name, last_name, phone_cell, owner FROM candidate WHERE candidate_id='$candidateID'" );
  $candidate = mysqli_fetch_array($query3);
  $candidateInfo = $candidate['first_name']." ".$candidate['last_name']." (".$candidate['phone_cell'].")";
/* activity record */
$owner = $candidate['owner'];

$query2 = mysqli_query( $dbc, "SELECT * FROM user WHERE user_id='$userID'" );
$user = mysqli_fetch_array($query2);
$userFullName = $user['first_name']." ".$user['last_name'];


if($userID == $owner){
  $action = "You deleted your candidate.";
}else{
  $action = $userFullName." deleted your candidate.";
}

/* activity area */
$activity = "INSERT INTO _activities(
              action,
              link,
              candidate_info,
              type,
              activities_dateTime,
              owner
              )
              VALUES(
              '$action',
              '$candidateID',
              '$candidateInfo',
              'candidatedelete',
              '$dateToday',
              '$owner'
              )";
@mysqli_query($dbc, $activity);

/* Own Activity */

if($userID != $owner){
$ownAction = "You deleted a candidate.";
$activity = "INSERT INTO _activities(
              action,
              link,
              candidate_info,
              type,
              activities_dateTime,
              owner
              )
              VALUES(
              '$ownAction',
              '$candidateID',
              '$candidateInfo',
              'candidatedelete',
              '$dateToday',
              '$userID'
              )";
@mysqli_query($dbc, $activity);

}

$delete = "DELETE FROM candidate WHERE candidate_id='$candidateID'";
@mysqli_query($dbc, $delete);

$header = 'Location: ../module.php?&k='.$k."&m=".$m."&a=".$a;
header($header);

?>
