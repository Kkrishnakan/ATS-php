<?php

include('db.php');
session_start();

$rowUpdate = $_GET['r'];
$userID = $_SESSION['user'];

@mysqli_query($dbc, "UPDATE user SET rows_per_page='$rowUpdate' WHERE user_id='$userID'");

$header = 'Location: ../module.php?m=candidates&a=home';
header($header);

?>
