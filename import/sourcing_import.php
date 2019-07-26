<?php
/*
 * Metacom ATS
 *
 * Copyright (C) 2018 Metacom
 *
 * Open-source project from OPENCATS
 * by Ryan Bitoncheck
 */

include('../data/db.php');
//include('check_candidate.php');
session_start();

//$checkCandidate = new checkCandidate;
//$uploadDate = $checkCandidate->getToday();

$now = new DateTime();
$now->setTimezone(new DateTimeZone('Asia/Manila'));
$dateToday = $now->format('Y-m-d H:i:s');
$uploadDate = $now->format('Y-m-d H-i-s');
$owner = $_SESSION['user'];
$insertAction = 0;
$updateAction = 0;

$csv 		 = $_FILES['Filename']['tmp_name'];
$csvFile = $_FILES['Filename']['name'];


$file = fopen($csv, "r");
//$count = fgetcsv($file);
//$linecount = count($count);



$path = 'files/'.$owner.'_'.$uploadDate.'.csv';
move_uploaded_file($csv, $path);

$rowCount = 0;

$info = pathinfo($csvFile);
//echo "Extension: ".$info['extension']."<br>";

if ($info["extension"] != "csv") { //invalid file format

header('Location: ../module.php?m=candidates&a=importcsv&invalid=true');

}else{ // execute upload
	$line = fgetcsv($file);

	$headerLine[0]  = "assigned";
	$headerLine[1]  = "full";
	$headerLine[2]  = "last";
	$headerLine[3]  = "first";
	$headerLine[4]  = "middle";
	$headerLine[5]  = "number";
	$headerLine[6]  = "confirm";
	$headerLine[7]  = "confirm";
	$headerLine[8]  = "rep";
	$headerLine[9]  = "loc";
	$headerLine[10] = "source";
	$headerLine[11] = "mean";
	$headerLine[12] = "email";
	$headerLine[13] = "ad";
	$headerLine[14] = "branch";
	$headerLine[15] = "rem";
	$headerLine[16] = "call";


$approved = "true";

if($approved == "false"){
$header = "Location: ../module.php?m=candidates&a=importcsv&wrongColumn=".$y;
header($header);
}else{
while(!feof($file)){


$line = fgetcsv($file);

$oldLine14 = mysqli_real_escape_string($dbc, $line[14]);
$newLine14 = preg_replace("/[^A-Za-z0-9?!]/",' ',$oldLine14);

$rowCount++;
$line0  = $line[0];
$line1  = mysqli_real_escape_string($dbc, $line[1]);
$line2  = mysqli_real_escape_string($dbc, $line[2]);
$line3  = mysqli_real_escape_string($dbc, $line[3]);
$line4  = mysqli_real_escape_string($dbc, $line[4]);
$line5  = mysqli_real_escape_string($dbc, $line[5]);
$line6  = mysqli_real_escape_string($dbc, $line[6]);
$line7  = $line[7];
$line8  = mysqli_real_escape_string($dbc, $line[8]);
$line9  = mysqli_real_escape_string($dbc, $line[9]);
$line10 = mysqli_real_escape_string($dbc, $line[10]);
$line11 = mysqli_real_escape_string($dbc, $line[11]);
$line12 = mysqli_real_escape_string($dbc, $line[12]);
$line13 = mysqli_real_escape_string($dbc, $line[13]);
$line14 = $newLine14;
$line15 = mysqli_real_escape_string($dbc, $line[15]);
$line16 = mysqli_real_escape_string($dbc, $line[16]);
$line17 = mysqli_real_escape_string($dbc, $line[17]);


if ($line0 != null){
		$oldLine0 = date_create($line0);
		$newLine0 = date_format($oldLine0,"Y-m-d");
}else{
		$newLine0 = "";
}

if ($line7!=null){
		$newDate7 = date_create($line7);
		$newLine7 = date_format($newDate7, "Y-m-d");
}else{
		$newLine7 = "";
}



$checkDuplicate = "SELECT * FROM candidate WHERE first_name='$line3' AND last_name='$line2'
									 AND processing_branch='$line15' AND owner='$owner'";
$r = mysqli_query($dbc, $checkDuplicate);
$row = mysqli_fetch_array($r);

if($row['candidate_id'] != null){
		if($owner == $row['owner']){
			if($line15 != $row['processing_branch']){
				$execute = "insert";
				$insertAction = $insertAction + 1;
			}else{
				$execute = "update";
				$updateAction = $updateAction + 1;
			}
		}else{
			$execute = "insert";
			$insertAction = $insertAction + 1;
		}
}else{
	$execute = "insert";
	$insertAction = $insertAction + 1;
}


if($execute == "insert"){ // To Insert Data
$insert = "INSERT INTO candidate(
					assigned_date_of_interview,
					full_name,
					last_name,
					first_name,
					middle_name,
					phone_cell,
					confirmation_status,
					confirmed_date_of_interview,
					replied_to,
					city,
					source,
					type_of_lead,
					preferred_communication,
					email1,
					ad_applied_to,
					processing_branch,
					advertiser_remarks,
					call_status,
					owner,
					entered_by,
					date_created,
					date_modified,
					site_id
				)VALUES(
					'$newLine0',
					'$line1',
					'$line2',
					'$line3',
					'$line4',
					'$line5',
					'$line6',
					'$newLine7',
					'$line8',
					'$line9',
					'$line10',
					'$line11',
					'$line12',
					'$line13',
					'$line14',
					'$line15',
					'$line16',
					'$line17',
					'$owner',
					'$owner',
					'$dateToday',
					'$dateToday',
					'1'
				)";
mysqli_query($dbc, $insert);


}

if($execute == "update"){ //To Execute Update Here
	$update = "UPDATE candidate SET
			assigned_date_of_interview  = '$newLine0',
			middle_name					        = '$line4',
			phone_cell					        = '$line5',
			confirmation_status 	      = '$line6',
			confirmed_date_of_interview = '$newLine7',
			replied_to                  = '$line8',
			source					           	= '$line10',
			type_of_lead                = '$line11',
			preferred_communication		  = '$line12',
			email1      				        = '$line13',
			ad_applied_to               = '$line14',
			processing_branch           = '$line15',
			advertiser_remarks          = '$line16',
			call_status                 = '$line17',
			date_modified               = '$dateToday'
			WHERE
			first_name					= '$line3' AND
			last_name					  = '$line2' AND
			owner						    = '$owner'
			";
mysqli_query($dbc, $update);

}

$execute = "";
}
mysqli_query($dbc, "DELETE FROM candidate WHERE phone_cell='' AND first_name='' AND last_name=''");
$finalRowCount = $rowCount - 1;
$insertAction = $insertAction - 1;
$action = "You have uploaded ".$finalRowCount." leads. ";
$action .= $insertAction." added, ".$updateAction." updated.";
$activity = "INSERT INTO _activities(
		action,
		activities_dateTime,
		type,
		owner)
		VALUES(
		'$action',
		'$dateToday',
		'uploadcsv',
		'$owner')";
mysqli_query($dbc, $activity);

fclose($file);

//header('Location: ../module.php?m=candidates&a=home');
}

//include('convertDateTime.php');
//echo '<script> location.replace("../../../index.php?m=candidates"); </script>';


}
?>
