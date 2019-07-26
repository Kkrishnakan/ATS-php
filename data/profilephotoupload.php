<?php
include('db.php');
session_start();
$userID = $_SESSION['user'];
$r = mysqli_query($dbc, "SELECT * FROM user WHERE user_id='$userID'");
$user = mysqli_fetch_array($r);

$pp 		 = $_FILES['Filename']['tmp_name'];
$ppFile  = $_FILES['Filename']['name'];

$info = pathinfo($ppFile);

//echo "Extension: ".$info["extension"];
$path = '../assets/images/profilephoto/'.$userID.".".$info["extension"];
move_uploaded_file($pp, $path);
$newpath = 'assets/images/profilephoto/'.$userID.".".$info["extension"];

@mysqli_query($dbc, "UPDATE `user` SET img='$newpath' WHERE user_id='$userID'");
header('Location: ../module.php?m=profile');
?>
