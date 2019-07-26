<?php
$searchKeyword = $_GET['k'];
//$searchKeywordNumber = preg_replace('~\D~', '', $searchKeyword);

//echo $searchKeywordNumber;
$userID = $_SESSION['user'];
$query = "SELECT * FROM user WHERE user_id='$userID'";
$r = mysql_query($query, $dbc);
$user = mysql_fetch_array($r);
$criterion = $user['criterion'];
$userType = $user['user_type'];
?>
<div class="row">

    <?php

    $search = "SELECT * FROM candidate WHERE (candidate_id != '' $criterion) AND (phone_cell LIKE '%$searchKeyword%' OR full_name LIKE '%$searchKeyword%') ORDER BY first_name ASC LIMIT 50";
    //echo "Search: ".$search;
    $r2 = mysql_query($search, $dbc);
    while($candidate = mysql_fetch_array($r2)){

      $ownerID = $candidate['owner'];

      $query3 = "SELECT * FROM user WHERE user_id='$ownerID'";
      $r3 = mysql_query($query3, $dbc);
      $owner = mysql_fetch_array($r3);


      $date = date_create($candidate['date_created']);
      $newDate = date_format($date,"M. d, o");

      $assignedDate = date_create($candidate['assigned_date_of_interview']);
      $newAssignedDate = date_format($date,"F d, o");

      $confirmedDate = date_create($candidate['confirmed_date_of_interview']);
      $newConfirmedDate = date_format($date,"F d, o");

      $moreInfo = "";
      if($candidate['assigned_date_of_interview'] != "0000-00-00"){
      $moreInfo .= "Assigned Date:".$newAssignedDate.", ";
      }
      if($candidate['confirmed_date_of_interview'] != "0000-00-00"){
      $moreInfo .= "Confirmed Date:".$newConfirmedDate.", ";
      }
      if($candidate['source'] != ""){
      $moreInfo .= "Source:".$candidate['source'].", ";
      }
      if($candidate['ad_applied_to'] != ""){
      $moreInfo .= "Ad Applied To:".$candidate['ad_applied_to'].", ";
      }
      if($candidate['advertiser_remarks'] != ""){
      $moreInfo .= "Remarks:".$candidate['advertiser_remarks'].", ";
      }

      echo '<div class="col-6">
            <div class="card mt-2">
            <div class="card-body">';
      echo '<div class="invoice-area">
            <div class="invoice-head">
            <div class="row">
            <div class="iv-left col-6">';
      echo '<span>'.$candidate['first_name']." ".$candidate['last_name'].'</span>';
      echo '</div>';
      echo '<div class="iv-right col-6 text-md-right">';
      echo '<span>'.$candidate['processing_branch'].'</span>';
      echo '</div></div></div>';
      echo '<div class="row align-items-center">
            <div class="col-md-6">
            <div class="invoice-address">';
      echo '<p>Mobile Number: '.$candidate['phone_cell'].'</p>';
      echo '<p>Location: '.$candidate['city'].'</p>';
      echo '</div></div>';
      echo '<div class="col-md-6 text-md-right">
            <ul class="invoice-date">';
      echo '<li>'.$owner['first_name']." ".$owner['last_name'].' (Owner)</li>';
      echo '<li>'.$newDate.' (Date Created)</li>';
      echo '</ul>
            </div>
            </div>
            </div>';
      echo '<hr>';
      echo '<form id="actionForm" name="actionForm" method="GET">';
      echo '<div class=" text-right">';
      echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
      echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
      echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';
      if($candidate['is_duplicate'] == "127"){
        echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()">Untag as Duplicate</button><span style="padding:5px;">';
      }else{
        echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()">Tag as Duplicate</button><span style="padding:5px;">';
      }

      echo '<button type="button" class="btn btn-dark"
            data-container="body" data-toggle="popover" data-placement="bottom"
            data-content="'.$moreInfo.'"
            data-original-title="" title="" aria-describedby="popover659819">More Info
            </button><span style="padding:5px;">';
      echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
      echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

      echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
      if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
      echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
      }

      echo '</form>';
      echo '</div>';
      echo '</div>
            </div>
            </div>';
    }
     ?>

</div>



<script type="text/javascript">
  function toConfirm(){
  //confirm("Press a button!");
  if( !confirm("Do you want to delete selected candidate?") ){
  $("#actionForm").submit(function(){
    return false;
  });
  location.reload();
  }
  }

    function toTagAsDuplicate(){
    //confirm("Press a button!");
    if( !confirm("Do you want to tag selected candidate as duplicate?") ){
    $("#actionForm").submit(function(){
      return false;
    });
    location.reload();
    }
    }

        function toUntagAsDuplicate(){
        //confirm("Press a button!");
        if( !confirm("Do you want to untag selected candidate as duplicate?") ){
        $("#actionForm").submit(function(){
          return false;
        });
        location.reload();
        }
        }

</script>
