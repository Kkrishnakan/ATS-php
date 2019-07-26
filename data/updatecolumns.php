<?php
include('db.php');
session_start();
$userID = $_SESSION['user'];
//echo $userID;
$query = mysqli_query( $dbc, "SELECT `column` FROM user WHERE user_id='$userID'" );
$user = mysqli_fetch_array($query);
$userColumn = $user['column'];
//echo $userColumn;
$columnPreference = explode(" ",$userColumn);

if(isset($_GET['removeColumn'])){
  $removeColumn = $_GET['removeColumn'];

  $newColumnPreferences = array_merge(array_diff($columnPreference, array($removeColumn)));
  $newColumn = implode(" ",$newColumnPreferences);
  //echo $newColumn;
  //$finalColumn = mysql_real_escape_string($newColumn);
  @mysqli_query($dbc, "UPDATE `user` SET `column` = '$newColumn' WHERE user_id='$userID'");
}

if(isset($_GET['addColumn'])){
  $addColumn = $_GET['addColumn'];
  //echo $addColumn."<br>";
//  echo "here!";
  //echo "<br>";
  $newColumnPreferences = array_push($columnPreference, $addColumn);
  $finalColumnPreferences = implode(" ",$columnPreference);
  //print_r($finalColumnPreferences);
  //echo "<br>";

  //$finalColumn = mysql_real_escape_string($newColumn);
  @mysqli_query($dbc, "UPDATE `user` SET `column` = '$finalColumnPreferences' WHERE user_id='$userID'");
}



//echo mysql_error();
$header = 'Location: ../module.php?m=candidates&a=home';
header($header);

?>
