<?php
include('db.php');
session_start();
$userID      = $_SESSION['user'];
$candidateID = $_POST['candidateID'];
$owner       = $_POST['owner'];

$dateToday = date('Y-m-d H:i:s');

$query2 = mysqli_query( $dbc, "SELECT * FROM user WHERE user_id='$userID'" );
$user = mysqli_fetch_array($query2);
$userFullName = $user['first_name']." ".$user['last_name'];

$firstName                = $_POST['firstName'];
$lastName                 = $_POST['lastName'];
$middleName               = $_POST['middleName'];
$fullname                 = $lastName.", ".$firstName." ".$middleName;
$mobileNumber             = $_POST['mobileNumber'];
$email                    = $_POST['email'];
$location                 = $_POST['location'];
$dateOfBirth              = $_POST['dateOfBirth'];
$course                   = $_POST['course'];
$educationalAttainment    = $_POST['educationalAttainment'];
$source                   = $_POST['source'];
$processingBranch         = $_POST['processingBranch'];
$walkInOwnership          = $_POST['walkInOwnership'];

$add = "INSERT INTO candidate(
        first_name,
        last_name,
        middle_name,
        full_name,
        phone_cell,
        email1,
        city,
        date_of_birth,
        course,
        educational_attainment,
        source,
        processing_branch,
        owner,
        entered_by,
        date_created,
        date_modified
      )VALUES(
        '$firstName',
        '$lastName',
        '$middleName',
        '$fullname',
        '$mobileNumber',
        '$email',
        '$location',
        '$dateOfBirth',
        '$course',
        '$educationalAttainment',
        '$source',
        '$processingBranch',
        '$walkInOwnership',
        '$userID',
        '$dateToday',
        '$dateToday'
      )";

//echo "<br>".$edit;
if(mysqli_query($dbc, $add)){
  $getLastInsert = "SELECT * FROM candidate WHERE first_name='$firstName' AND last_name='$lastName' AND
                    phone_cell='$mobileNumber' AND owner='$walkInOwnership' AND entered_by='$userID' AND
                    source='$source' AND processing_branch='$processingBranch' ";
  $query3 = mysqli_query( $dbc, $getLastInsert );
  $candidate = mysqli_fetch_array($query3);

  $candidateID = $candidate['candidate_id'];

  $action = "You have added a walk-in applicant.";
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
  echo mysqli_error();
}


?>
