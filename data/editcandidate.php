<?php
include('db.php');
session_start();
mysqli_query($dbc, "SET NAMES 'utf8'");
mysqli_query($dbc,"SET CHARACTER SET 'utf8'");
@mysqli_set_charset($dbc,"utf8");
$userID      = $_SESSION['user'];
$candidateID = $_POST['candidateID'];
$owner       = $_POST['owner'];

$dateToday = date('Y-m-d H:i:s');
$dateInput = date('Y-m-d');

$query2 = mysqli_query( $dbc, "SELECT user_id, first_name, last_name FROM user WHERE user_id='$userID'" );
$user = mysqli_fetch_array($query2);
$userFullName = $user['first_name']." ".$user['last_name'];


$firstName              = mysqli_real_escape_string($dbc, $_POST['firstName']);
$middleName             = mysqli_real_escape_string($dbc, $_POST['middleName']);
$lastName               = mysqli_real_escape_string($dbc, $_POST['lastName']);
$fullName               = $lastName.", ".$firstName." ".$middleName;
$mobileNumber           = mysqli_real_escape_string($dbc, $_POST['mobileNumber']);
$email                  = mysqli_real_escape_string($dbc, $_POST['email']);
$gender                 = mysqli_real_escape_string($dbc, $_POST['gender']);
$dateOfBirth            = mysqli_real_escape_string($dbc, $_POST['dateOfBirth']);
$location               = mysqli_real_escape_string($dbc, $_POST['location']);
$educationalAttainment  = mysqli_real_escape_string($dbc, $_POST['educationalAttainment']);
$course                 = mysqli_real_escape_string($dbc, $_POST['course']);
$preferredCommnucation  = mysqli_real_escape_string($dbc, $_POST['preferredCommunication']);

$hiringCompany          = mysqli_real_escape_string($dbc, $_POST['hiringCompany']);
$receptionist           = mysqli_real_escape_string($dbc, $_POST['receptionist']);
$currentEmployer        = mysqli_real_escape_string($dbc, $_POST['currentEmployer']);
$expectedSalary         = mysqli_real_escape_string($dbc, $_POST['expectedSalary']);
$timeOfArrival          = mysqli_real_escape_string($dbc, $_POST['timeOfArrival']);
$attendanceStatus       = mysqli_real_escape_string($dbc, $_POST['attendanceStatus']);
$dateAttended           = mysqli_real_escape_string($dbc, $_POST['dateAttended']);
$timeOfInterview        = mysqli_real_escape_string($dbc, $_POST['timeOfInterview']);
$interviewedBy          = mysqli_real_escape_string($dbc, $_POST['interviewedBy']);
$shuttleStatus          = mysqli_real_escape_string($dbc, $_POST['shuttleStatus']);
$timeOfShuttle          = mysqli_real_escape_string($dbc, $_POST['timeOfShuttle']);

$shuttledByPromodiser   = mysqli_real_escape_string($dbc, $_POST['shuttledByPromodiser']);
$shuttledByDriver       = mysqli_real_escape_string($dbc, $_POST['shuttledByDriver']);
$bpoExperience          = mysqli_real_escape_string($dbc, $_POST['bpoExperience']);
$endorsementStatus      = mysqli_real_escape_string($dbc, $_POST['endorsementStatus']);
$firstEndorsement       = mysqli_real_escape_string($dbc, $_POST['firstEndorsement']);
$secondEndorsement      = mysqli_real_escape_string($dbc, $_POST['secondEndorsement']);
$thirdEndorsement       = mysqli_real_escape_string($dbc, $_POST['thirdEndorsement']);

$applicationStatus      = mysqli_real_escape_string($dbc, $_POST['applicationStatus']);
$hiredDate              = mysqli_real_escape_string($dbc, $_POST['hiredDate']);
$startDate              = mysqli_real_escape_string($dbc, $_POST['startDate']);
$reasonForNotGettingHired = mysqli_real_escape_string($dbc, $_POST['reasonForNotGettingHired']);
$recruiterRemarks       = mysqli_real_escape_string($dbc, $_POST['recruiterRemarks']);

$billingClient          = mysqli_real_escape_string($dbc, $_POST['billingClient']);
$correspondingPoint     = mysqli_real_escape_string($dbc, $_POST['correspondingPoint']);
$billingStatus          = mysqli_real_escape_string($dbc, $_POST['billingStatus']);
$billingDate            = mysqli_real_escape_string($dbc, $_POST['billingDate']);
$billingStatus2         = mysqli_real_escape_string($dbc, $_POST['billingStatus2']);
$datePaid               = mysqli_real_escape_string($dbc, $_POST['datePaid']);
$validationStatus       = mysqli_real_escape_string($dbc, $_POST['validationStatus']);
$validationDate         = mysqli_real_escape_string($dbc, $_POST['validationDate']);
$financeRemarks         = mysqli_real_escape_string($dbc, $_POST['financeRemarks']);
$forReplacement         = mysqli_real_escape_string($dbc, $_POST['forReplacement']);
$replacedBy             = mysqli_real_escape_string($dbc, $_POST['replacedBy']);

$processingBranch       = mysqli_real_escape_string($dbc, $_POST['processingBranch']);
$adAppliedTo            = mysqli_real_escape_string($dbc, $_POST['adAppliedTo']);
$confirmationStatus     = mysqli_real_escape_string($dbc, $_POST['confirmationStatus']);
$confirmedDate          = mysqli_real_escape_string($dbc, $_POST['confirmedDate']);
$assignedDate           = mysqli_real_escape_string($dbc, $_POST['assignedDate']);
$advertiserRemarks      = mysqli_real_escape_string($dbc, $_POST['advertiserRemarks']);
$source                 = mysqli_real_escape_string($dbc, $_POST['source']);
$dateOfInput            = mysqli_real_escape_string($dbc, $_POST['dateOfInput']);
$hiringAccount          = mysqli_real_escape_string($dbc, $_POST['hiringAccount']);

$recruitmentType        = mysqli_real_escape_string($dbc, $_POST['recruitmentType']);
$recruitmentLocation    = mysqli_real_escape_string($dbc, $_POST['recruitmentLocation']);
$repliedTo              = mysqli_real_escape_string($dbc, $_POST['repliedTo']);
$callStatus             = mysqli_real_escape_string($dbc, $_POST['callStatus']);
$typeOfLead             = mysqli_real_escape_string($dbc, $_POST['typeOfLead']);
$pointAssignment        = mysqli_real_escape_string($dbc, $_POST['pointAssignment']);

//echo $dateOfInput;
//echo $dateInput;
if($applicationStatus == "Hired"){

  //echo $applicationStatus;
if($dateOfInput == ""){
  $dateOfInput = $dateInput;
}

}

//echo "Hiring Company1: ".$hiringCompany."<br>";
//echo "Hiring Company2: ".$hiringCompany2."<br>";
//echo "Hiring Company3: ".$hiringCompany3."<br>";


//echo $newHiringCompany;


if($forReplacement == "on"){
  $forReplacement = "127";
}


$endorsementHistory = $firstEndorsement;
if($secondEndorsement != "N/A"){
  $endorsementHistory .= ", ".$secondEndorsement;
}

if($thirdEndorsement != "N/A"){
  $endorsementHistory .= ", ".$thirdEndorsement;
}

if($dateAttended){
  $attendanceStatus = "Attended";
}


if($attendanceStatus == "Attended"){
  $callStatus = "";
}

$edit = "UPDATE candidate SET

        billing_client          = '$billingClient',
        corresponding_point     = '$correspondingPoint',
        billing_status          = '$billingStatus',
        billing_date            = '$billingDate',
        billing_status2         = '$billingStatus2',
        date_paid               = '$datePaid',
        validation_status       = '$validationStatus',
        validation_date         = '$validationDate',
        finance_remarks         = '$financeRemarks',
        for_replacement         = '$forReplacement',
        replaced_by             = '$replacedBy',

        first_name              = '$firstName',
        middle_name             = '$middleName',
        last_name               = '$lastName',
        full_name               = '$fullName',
        phone_cell              = '$mobileNumber',
        email1                  = '$email',
        gender                  = '$gender',
        date_of_birth           = '$dateOfBirth',
        city                    = '$location',
        educational_attainment  = '$educationalAttainment',
        course                  = '$course',
        preferred_communication = '$preferredCommnucation',

        hiring_company          = '$hiringCompany',
        receptionist            = '$receptionist',
        current_employer        = '$currentEmployer',
        desired_pay             = '$expectedSalary',
        time_of_arrival         = '$timeOfArrival',
        attendance_status       = '$attendanceStatus',
        date_attended           = '$dateAttended',
        time_of_interview       = '$timeOfInterview',
        interviewed_by          = '$interviewedBy',
        shuttle_status          = '$shuttleStatus',
        time_of_shuttle         = '$timeOfShuttle',

        shuttled_by_promodiser  = '$shuttledByPromodiser',
        shuttled_by_driver      = '$shuttledByDriver',
        bpo_experience          = '$bpoExperience',
        endorsement_status      = '$endorsementStatus',
        first_endorsement       = '$firstEndorsement',
        second_endorsement      = '$secondEndorsement',
        third_endorsement       = '$thirdEndorsement',
        endorsement_history     = '$endorsementHistory',

        application_status      = '$applicationStatus',
        hired_date              = '$hiredDate',
        start_date              = '$startDate',
        reason_for_not_getting_hired = '$reasonForNotGettingHired',
        recruiter_remarks       = '$recruiterRemarks',
        processing_branch       = '$processingBranch',
        ad_applied_to           = '$adAppliedTo',
        confirmation_status     = '$confirmationStatus',
        confirmed_date_of_interview = '$confirmedDate',
        assigned_date_of_interview  = '$assignedDate',
        advertiser_remarks      = '$advertiserRemarks',
        source                  = '$source',
        date_of_input           = '$dateOfInput',
        hiring_account          = '$hiringAccount',
        recruitment_type        = '$recruitmentType',
        recruitment_location    = '$recruitmentLocation',
        replied_to              = '$repliedTo',
        call_status             = '$callStatus',
        type_of_lead            = '$typeOfLead',
        point_assignment_per_hire = '$pointAssignment',

        date_modified           = '$dateToday',
        last_modified_by        = '$userID'
        WHERE
        candidate_id            = '$candidateID'
        ";

//echo "<br>".$edit;
if(mysqli_query($dbc, $edit)){

if($userID == $owner){
  $action = "You have updated your candidate.";
}else{
  $action = $userFullName." updated your candidate.";
}
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
              'candidateedit',
              '$dateToday',
              '$owner'
              )";
@mysqli_query($dbc, $activity);
//echo mysql_error();

/* Own Activity */
if($userID != $owner){
$ownAction = "You edited a candidate";
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
              'candidateedit',
              '$dateToday',
              '$userID'
              )";
@mysqli_query($dbc, $activity);
}
/* notification area */
if($applicationStatus == "Hired"){

  $query3 = mysqli_query( $dbc, "SELECT * FROM _notifications WHERE link='$candidateID' AND type='candidatehired'" );
  $notif = mysqli_fetch_array($query3);

  if($notif['notification_id'] == null){
    $hiredCandidate = $firstName." ".$lastName;
    $action = $hiredCandidate." tagged as hired!";
    $notification = "INSERT INTO _notifications(
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
                'candidatehired',
                '$dateToday',
                '$owner'
                )";
    @mysqli_query($dbc, $notification);
  }
}

/* replacement status*/
if($forReplacement == "127"){
  $query3 = mysqli_query( $dbc, "SELECT * FROM _notifications WHERE link='$candidateID' AND type='candidatereplacement'" );
  $notif = mysqli_fetch_array($query3);

  if($notif['notification_id'] == null){
    $replacementName = $firstName." ".$lastName;
    $action = $replacementName." tagged as replacement.";
    $notification = "INSERT INTO _notifications(
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
                'candidatereplacement',
                '$dateToday',
                '$owner'
                )";
    @mysqli_query($dbc, $notification);
  }
}

/* billed status */
if($billingStatus == "Billed"){
  $query3 = mysqli_query( $dbc, "SELECT * FROM _notifications WHERE link='$candidateID' AND type='candidatebilled'" );
  $notif = mysqli_fetch_array($query3);

  if($notif['notification_id'] == null){
    $replacementName = $firstName." ".$lastName;
    $action = $replacementName." tagged as billed!";
    $notification = "INSERT INTO _notifications(
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
                'candidatebilled',
                '$dateToday',
                '$owner'
                )";
    @mysqli_query($dbc, $notification);
  }
}

if($endorsementStatus == "Endorsed"){
  $query3 = mysqli_query( $dbc, "SELECT * FROM _notifications WHERE link='$candidateID' AND type='candidateendorsed'" );
  $notif = mysqli_fetch_array($query3);

  if($notif['notification_id'] == null){
    $replacementName = $firstName." ".$lastName;
    $action = $replacementName." was endorsed! (".$endorsementHistory.")";
    $notification = "INSERT INTO _notifications(
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
                'candidateendorsed',
                '$dateToday',
                '$owner'
                )";
    @mysqli_query($dbc, $notification);
  }
}

  $header = "Location: ../module.php?m=candidates&a=show&candidateID=".$candidateID;
  header($header);
}else{
  echo mysqli_error();
}


?>
