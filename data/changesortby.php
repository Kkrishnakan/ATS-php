<?php
include('db.php');
session_start();
$userID = $_SESSION['user'];
$query = "SELECT * FROM user WHERE user_id='$userID'";
$r = mysqli_query($dbc, $query);
$user = mysqli_fetch_array($r);

$sortTo = $_GET['sortby'];

$sortby = $user['sort_by'];
$sortWith = $user['sort_with'];
//echo $mode;

if($sortby != $sortTo){
$update = "UPDATE user SET sort_by='$sortTo' WHERE user_id='$userID'";
}
@mysqli_query($dbc, $update);

if($sortby == $sortTo){

  if($sortWith == "ASC"){
    $update = "UPDATE user SET sort_with='ASC' WHERE user_id='$userID'";
  }else{
    $update = "UPDATE user SET sort_with='DESC' WHERE user_id='$userID'";
  }

}
@mysqli_query($dbc, $update);


//




header('Location: ../module.php?m=candidates&a=home');
?>
