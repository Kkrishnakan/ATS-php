<?php
include('db.php');
session_start();

$candidateID = $_POST['candidateid'];
$count = count($candidateID);
$listOfCandidateID = "";
//$minusCount = $count - 1;
for($x = 0; $x <= $count; $x++){

  //echo $candidateID[$x]."<br>";
if($x == 0){
  $listOfCandidateID = $candidateID[$x];
}
if($x == $count){
  $listOfCandidateID = $listOfCandidateID.$candidateID[$x];
}else{
if($x > 0){
  $listOfCandidateID = $listOfCandidateID.", ".$candidateID[$x];
}
}
}

$condition = "WHERE candidate_id IN (".$listOfCandidateID.")";
//echo $condition;

$select = "SELECT date_attended, full_name, last_name, first_name,
                  phone_cell, email1, bpo_experience, source,
                  ad_applied_to, owner, interviewed_by,
                  endorsement_history, shuttled_by_driver, shuttled_by_promodiser,
                  processing_branch, hiring_company, hired_date,
                  start_date, hiring_account, attendance_status,
                  application_status, confirmed_date_of_interview,
                  date_of_input, recruitment_type,
                  recruitment_location, assigned_date_of_interview,
                  replied_to, city, point_assignment_per_hire
                  FROM candidate $condition";


$result = mysqli_query($dbc, $select);
if (!$result) die('Couldn\'t fetch records');
$num_fields = mysqli_num_fields($result);
$headers = array("Date Attended", "Full Name", "Last Name", "First Name", "Mobile Number", "Email",
                 "BPO Experience", "Source", "Ad Applied To", "Owner", "Interviewed By",
                 "Endorsement History", "Shuttled by (Driver)", "Shuttled By (Promodiser)",
                 "Processing Branch", "Hiring Company", "Hired Date", "Start Date", "Hiring Account",
                 "Attendance Status", "Application Status", "Confirmed Date", "Date of Input",
                 "Recruitment Type", "Recruitment Location", "Assigned Date of Interview",
                 "Replied To", "Location", "Point Assignment per Hire");

$fp = fopen('php://output', 'w');
if ($fp && $result)
{
       header('Content-Type: text/csv');
       header('Content-Disposition: attachment; filename="export.csv"');
       header('Pragma: no-cache');
       header('Expires: 0');
       fputcsv($fp, $headers);
       while ($row = mysqli_fetch_row($result))
       {
         $owner = $row[9];
         $getUser = "SELECT first_name, last_name FROM user WHERE user_id='$owner'";
         $query3 = mysqli_query( $dbc, $getUser );
         $user = mysqli_fetch_array($query3);
         $userFullName = $user['first_name']." ".$user['last_name'];
         $row[9] = $userFullName;

          fputcsv($fp, array_values($row));
       }
die;
}
?>
