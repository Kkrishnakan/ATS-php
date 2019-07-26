<?php
include('db.php');
session_start();
$userID = $_SESSION['user'];
$r = mysqli_query($dbc, "SELECT * FROM user WHERE user_id='$userID'");
$user = mysqli_fetch_array($r);


$mode = $user['night_mode'];
//echo $mode;
if ($mode == "off"){
  $update = "UPDATE user SET night_mode='on' WHERE user_id='$userID'";
}else{
  $update = "UPDATE user SET night_mode='off' WHERE user_id='$userID'";
}
@mysqli_query($dbc, $update);


header('Location: ../module.php?m=candidates&a=home');
?>
