<?php
include('db.php');
session_start();
$userID = $_SESSION['user'];
$query = "SELECT * FROM user WHERE user_id='$userID'";
$r = mysql_query($query, $dbc);
$user = mysql_fetch_array($r);
$dateToday = date('Y-m-d H:i:s');

$post = $_POST['post'];
//echo $mode;
$query = "INSERT INTO _feed(
          action,
          feed_dateTime,
          owner)
          VALUES(
          '$post',
          '$dateToday',
          '$userID'
          )";
@mysql_query($query, $dbc);


header('Location: ../module.php?m=feed');
?>
