<?php
include('db.php');
session_start();

$username  = mysqli_real_escape_string($dbc, $_POST['atsusername']);
$pw        = mysqli_real_escape_string($dbc, $_POST['atspw']);
$newpwhash = md5($pw);

//echo $username."<br>";
//echo $newpwhash;

$query = "SELECT * FROM user WHERE user_name='$username'";
$r = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($r);


$userID = $row['user_id'];

//echo "UserID: ".$userID;
if($row['access_level'] == 0){
//  echo "here!";
  $header = 'Location: ../index.php?deactivated=true';
}else{
if($row['password'] == $newpwhash){
    $_SESSION['user'] = $userID;

    if(($row['user_type'] == "Advertiser") OR ($row['user_type'] == "Team Leader") OR ($row['user_type'] == "Senior Team Leader") OR ($row['user_type'] == "Sourcing Admin")){
      $header = 'Location: ../module.php?m=profile';
    }else{
      $header = 'Location: ../module.php?m=candidates&a=home';
    }

}else{
    $header = 'Location: ../index.php?error=true';
}
}
//echo $header;
header($header);

?>
