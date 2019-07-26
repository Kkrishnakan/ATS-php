<?php
include('db.php');
session_start();
$userID      = $_SESSION['user'];
$candidateID = $_POST['candidateID'];
$owner       = $_POST['owner'];

$dateToday = date('Y-m-d H:i:s');

$query2 = mysqli_query( $dbc,  "SELECT * FROM user WHERE user_id='$userID'" );
$user = mysqli_fetch_array($query2);
$userFullName = $user['first_name']." ".$user['last_name'];


$assignedDateOfInterview  = $_POST['assignedDateOfInterview'];
$firstName                = $_POST['firstName'];
$lastName                 = $_POST['lastName'];
$middleName               = $_POST['middleName'];
$fullname                 = $lastName.", ".$firstName." ".$middleName;
$mobileNumber             = $_POST['mobileNumber'];
$confirmationStatus       = $_POST['confirmationStatus'];
$confirmedDate            = $_POST['confirmedDate'];
$location                 = $_POST['location'];
$source                   = $_POST['source'];
$preferredCommnunication  = $_POST['preferredCommunication'];
$email                    = $_POST['email'];
$adAppliedTo              = $_POST['adAppliedTo'];
$processingBranch         = $_POST['processingBranch'];
$remarks                  = $_POST['remarks'];

$add = "INSERT INTO candidate(
        assigned_date_of_interview,
        first_name,
        last_name,
        middle_name,
        full_name,
        phone_cell,
        confirmation_status,
        confirmed_date_of_interview,
        city,
        source,
        preferred_communication,
        email1,
        ad_applied_to,
        processing_branch,
        advertiser_remarks,
        owner,
        entered_by,
        date_created,
        date_modified
      )VALUES(
        '$assignedDateOfInterview',
        '$firstName',
        '$lastName',
        '$middleName',
        '$fullname',
        '$mobileNumber',
        '$confirmationStatus',
        '$confirmedDate',
        '$location',
        '$source',
        '$preferredCommnunication',
        '$email',
        '$adAppliedTo',
        '$processingBranch',
        '$remarks',
        '$userID',
        '$userID',
        '$dateToday',
        '$dateToday'
      )";

//echo "<br>".$edit;
if(mysqli_query($dbc, $add)){
  $getLastInsert = "SELECT * FROM candidate WHERE assigned_date_of_interview='$assignedDateOfInterview' AND
                   first_name='$firstName' AND last_name='$lastName' AND middle_name='$middleName' AND
                   processing_branch='$processingBranch' AND ad_applied_to='$adAppliedTo' AND owner='$userID'
                   AND entered_by='$userID'";
  $query3 = mysqli_query( $dbc, $getLastInsert );
  $candidate = mysqli_fetch_array($query3);

  $candidateID = $candidate['candidate_id'];

  $action = "You have added a candidate.";
  $candidateInfo = $firstName." ".$lastName." (".$mobileNumber.")";

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
                'candidateadd',
                '$dateToday',
                '$userID'
                )";
  @mysqli_query($dbc, $activity);

  $header = "Location: ../module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id'];
  header($header);
}else{
  echo "<br>Failed!";
  echo mysql_error();
}


?>
