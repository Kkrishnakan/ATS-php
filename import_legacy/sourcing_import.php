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
include('check_candidate.php');
session_start();

$checkCandidate = new checkCandidate;
$uploadDate = $checkCandidate->getToday();
$owner = $_SESSION['user'];


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

	$headerLine[0]  = "assigned date";
	$headerLine[1]  = "full";
	$headerLine[2]  = "last";
	$headerLine[3]  = "first";
	$headerLine[4]  = "middle";
	$headerLine[5]  = "number";
	$headerLine[6]  = "confirmation";
	$headerLine[7]  = "confirmed";
	$headerLine[8]  = "location";
	$headerLine[9]  = "source";
	$headerLine[10] = "mean";
	$headerLine[11] = "email";
	$headerLine[12] = "ad";
	$headerLine[13] = "branch";
	$headerLine[14] = "remark";

for ($x = 0; $x <= 13; $x++){
//echo "<br>".$line[$x];
//echo "<br>".$headerLine[$x];
	if(stristr($line[$x], $headerLine[$x])){
		$approved = "true";
	}else{
		//echo "Wrong!";
		$y = $x + 1;
		//echo $y."<br>";
		$approved = "false";
		break;
	}
}


	//$approved = "true";

if($approved == "false"){
$header = "Location: ../module.php?m=candidates&a=importcsv&wrongColumn=".$y;
header($header);
}else{
while(!feof($file)){
//echo "3";

$line = fgetcsv($file);
$rowCount++;
$line0  = mysql_real_escape_string($line[0]);
$line1  = mysql_real_escape_string($line[1]);
$line2  = mysql_real_escape_string($line[2]);
$line3  = mysql_real_escape_string($line[3]);
$line4  = mysql_real_escape_string($line[4]);
$line5  = mysql_real_escape_string($line[5]);
$line6  = mysql_real_escape_string($line[6]);
$line7  = mysql_real_escape_string($line[7]);
$line8  = mysql_real_escape_string($line[8]);
$line9  = mysql_real_escape_string($line[9]);
$line10 = mysql_real_escape_string($line[10]);
$line11 = mysql_real_escape_string($line[11]);
$line12 = mysql_real_escape_string($line[12]);
$line13 = mysql_real_escape_string($line[13]);
$line14 = mysql_real_escape_string($line[14]);

//echo $line0."<br>";
//echo $line14."<br>";

$checkCandidate->check($owner, $line0, $line1, $line2, $line3, $line4,
					   $line5, $line6, $line7, $line8, $line9,
					   $line10, $line11, $line12, $line13, $line14);
$checkCandidate->deleteBlank();

}

$finalRowCount = $rowCount - 1;
$checkCandidate->activities($owner, $finalRowCount);
fclose($file);

header('Location: ../module.php?m=candidates&a=home');
}

//include('convertDateTime.php');
//echo '<script> location.replace("../../../index.php?m=candidates"); </script>';


}
?>
