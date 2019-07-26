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

$query2 = mysqli_query( $dbc, "SELECT user_id, first_name, last_name FROM user WHERE user_id='$userID'" );
$user = mysqli_fetch_array($query2);
$userFullName = $user['first_name']." ".$user['last_name'];


if($userID == $owner){
  $action = "You tagged a candidate as duplicate";
}else{
  $action = $userFullName." tagged a candidate as duplicate.";
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
              'candidateduplicate',
              '$dateToday',
              '$owner'
              )";
@mysqli_query($dbc, $activity);

/* Own Activity */

if($userID != $owner){
$ownAction = "You tagged a candidate as duplicate.";
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
              'candidateduplicate',
              '$dateToday',
              '$userID'
              )";
@mysqli_query($dbc, $activity);

}

@mysqli_query($dbc, "UPDATE candidate SET is_duplicate='127' WHERE candidate_id='$candidateID'");

$header = 'Location: ../module.php?&k='.$k."&m=".$m."&a=".$a."&candidateID=".$candidateID;
header($header);

?>
