<?php
$userID = $_SESSION['user'];
$query = "SELECT * FROM user WHERE user_id='$userID'";
$r = mysql_query($query, $dbc);
$user = mysql_fetch_array($r);
$criterion = $user['criterion'];
$userType = $user['user_type'];

$searchKeyword = $_GET['k'];
  $qString = "";

  $data = preg_split('/\s+/', $searchKeyword);
  //$searchKeywordNumber = preg_replace('~\D~', '', $searchKeyword);
  $count = count($data);
  //echo $count;

  $y = $count - 1;
  $firstName = str_replace(',', '', $data[0]);
  $lastName  = str_replace(',', '', $data[$y]);;

  $nString  = " first_name LIKE '%".$firstName."%'";
  $nString .= " AND last_name LIKE '%".$lastName."%'";
//echo "<br>".$firstName;
//echo "<br>".$lastName;
  for($x = 0; $x < $count; $x++){
    //$qString .= "AND full_name LIKE '%".$data[$x]."%' ";
    $qString .= ' OR full_name REGEXP "'.$data[$x].'" ';

  }

$qString .= ' OR phone_cell REGEXP "'.$searchKeyword.'" ';


$qString2 = "(candidate_id !='' AND phone_cell='$searchKeyword' $criterion) ";

//$qString .= "OR phone_cell='".$searchKeyword."'";
//echo "<br>QString: ".$qString."<br>";
//echo $searchKeywordNumber;

?>

<div class="col-lg-12 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Search Results</h4>
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="text-uppercase bg-primary">
                                                <tr class="text-white">
                                                    <?php
                                                    if($userType == "Finance"){
                                                      echo '<th scope="col">Full Name</th>
                                                            <th scope="col">P. Branch</th>
                                                            <th scope="col">Date Attended</th>
                                                            <th scope="col">Endorsement History</th>
                                                            <th scope="col"></th>';
                                                    }else{
                                                      echo '<th scope="col">Full Name</th>
                                                            <th scope="col">Mobile Number</th>
                                                            <th scope="col">P. Branch</th>
                                                            <th scope="col">Owner</th>
                                                            <th scope="col"></th>';
                                                    }
                                                     ?>

                                                </tr>
                                            </thead>
                                            <tbody>

                                              <?php



                                              // This is the first name and last name search

                                              //echo "QString: ".$qString."<br>";
                                            //  echo "QString2: ".$qString2."<br>";
                                              $search = "SELECT * FROM candidate WHERE phone_cell LIKE '%$searchKeyword%' $criterion ORDER BY candidate_id DESC LIMIT 10";

                                              //echo "Search: ".$search;
                                              //echo "<br>nString: ".$nString."<br>";
                                              $r2 = mysql_query($search, $dbc);
                                              while($candidate = mysql_fetch_array($r2)){

                                                $candidateID = $candidate['owner'];
                                                $query3 = "SELECT * FROM user WHERE user_id='$candidateID'";
                                                $r3 = mysql_query($query3);
                                                $owner = mysql_fetch_array($r3);

                                                $date = date_create($candidate['date_created']);
                                                $newDate = date_format($date,"M. d, o");

                                                if($candidate['date_attended'] != "0000-00-00"){
                                                $date = date_create($candidate['date_attended']);
                                                $newDateAttended = date_format($date,"M. d, o");
                                                }else{
                                                $newDateAttended = "";
                                                }

                                                $assignedDate = date_create($candidate['assigned_date_of_interview']);
                                                $newAssignedDate = date_format($date,"F d, o");

                                                $confirmedDate = date_create($candidate['confirmed_date_of_interview']);
                                                $newConfirmedDate = date_format($date,"F d, o");

                                                if($userType == "Finance"){
                                                echo "<tr>";
                                                echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";

                                                echo "<td>".$candidate['processing_branch']."</td>";
                                                echo "<td>".$newDateAttended."</td>";
                                                echo "<td>".$candidate['endorsement_history']."</td>";
                                                echo "<td>";
                                                echo '<form id="actionForm" name="actionForm" method="GET">';
                                                echo '<div class=" text-right">';
                                                echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';

                                                if($candidate['is_duplicate'] == "127"){
                                                  echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                }else{
                                                  echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                }

                                                echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                }
                                                echo "</td>";
                                                echo '</form>';
                                                echo "</tr>";
                                              }else{
                                                $ownerID = $candidate['entered_by'];

                                                //if(stristr($user['criterion'],$ownerID)){
                                                    echo "<tr>";
                                                    echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";
                                                    echo "<td>".$candidate['phone_cell']."</td>";
                                                    echo "<td>".$candidate['processing_branch']."</td>";
                                                    echo "<td>".$owner['first_name']." ".substr($owner['last_name'], 0, 1)."."."</td>";
                                                    echo "<td>";
                                                    echo '<form id="actionForm" name="actionForm" method="GET">';
                                                    echo '<div class=" text-right">';
                                                    echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                    echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                    echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';
                                                    if($candidate['is_duplicate'] == "127"){
                                                      echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                    }else{
                                                      echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                    }

                                                    echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                    echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                    echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                    if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                    echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                    }
                                                    echo "</td>";
                                                    echo '</form>';
                                                    echo "</tr>";
                                                //}


                                              }



                                              }
                                               ?>



                                                  <?php

                                                  // This is the first name and last name search

                                                  //echo "QString: ".$qString."<br>";
                                                //  echo "QString2: ".$qString2."<br>";
                                                  $search = "SELECT * FROM candidate WHERE first_name LIKE '%$firstName%' AND last_name LIKE '%$lastName%' $criterion ORDER BY candidate_id DESC LIMIT 10";

                                                  //echo "<br>Search: ".$search;
                                                  //echo "<br>nString: ".$nString;
                                                  $r2 = mysql_query($search, $dbc);

                                                  while($candidate = mysql_fetch_array($r2)){

                                                    $candidateID = $candidate['owner'];
                                                    $query3 = "SELECT * FROM user WHERE user_id='$candidateID'";
                                                    $r3 = mysql_query($query3);
                                                    $owner = mysql_fetch_array($r3);

                                                    $date = date_create($candidate['date_created']);
                                                    $newDate = date_format($date,"M. d, o");

                                                    if($candidate['date_attended'] != "0000-00-00"){
                                                    $date = date_create($candidate['date_attended']);
                                                    $newDateAttended = date_format($date,"M. d, o");
                                                    }else{
                                                    $newDateAttended = "";
                                                    }

                                                    $assignedDate = date_create($candidate['assigned_date_of_interview']);
                                                    $newAssignedDate = date_format($date,"F d, o");

                                                    $confirmedDate = date_create($candidate['confirmed_date_of_interview']);
                                                    $newConfirmedDate = date_format($date,"F d, o");

                                                    if($userType == "Finance"){
                                                    echo "<tr>";
                                                    echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";

                                                    echo "<td>".$candidate['processing_branch']."</td>";
                                                    echo "<td>".$newDateAttended."</td>";
                                                    echo "<td>".$candidate['endorsement_history']."</td>";
                                                    echo "<td>";
                                                    echo '<form id="actionForm" name="actionForm" method="GET">';
                                                    echo '<div class=" text-right">';
                                                    echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                    echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                    echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';

                                                    if($candidate['is_duplicate'] == "127"){
                                                      echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                    }else{
                                                      echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                    }

                                                    echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                    echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                    echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                    if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                    echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                    }
                                                    echo "</td>";
                                                    echo '</form>';
                                                    echo "</tr>";
                                                  }else{
                                                    $ownerID = $candidate['entered_by'];

                                                    //if(stristr($user['criterion'],$ownerID)){
                                                        echo "<tr>";
                                                        echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";
                                                        echo "<td>".$candidate['phone_cell']."</td>";
                                                        echo "<td>".$candidate['processing_branch']."</td>";
                                                        echo "<td>".$owner['first_name']." ".substr($owner['last_name'], 0, 1)."."."</td>";
                                                        echo "<td>";
                                                        echo '<form id="actionForm" name="actionForm" method="GET">';
                                                        echo '<div class=" text-right">';
                                                        echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                        echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                        echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';
                                                        if($candidate['is_duplicate'] == "127"){
                                                          echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                        }else{
                                                          echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                        }

                                                        echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                        echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                        echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                        if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                        echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                        }
                                                        echo "</td>";
                                                        echo '</form>';
                                                        echo "</tr>";
                                                    //}
                                                  }
                                                  }
                                                   ?>

                                                   <?php

                                                   // This is the last name and first name search

                                                   //echo "QString: ".$qString."<br>";
                                                 //  echo "QString2: ".$qString2."<br>";
                                                   $search = "SELECT * FROM candidate WHERE first_name LIKE '%$lastName%' AND last_name LIKE '%$firstName%' $criterion ORDER BY candidate_id DESC LIMIT 10";

                                                   //echo "<br>Search: ".$search;
                                                   //echo "<br>nString: ".$nString;
                                                   $r2 = mysql_query($search, $dbc);

                                                   while($candidate = mysql_fetch_array($r2)){

                                                     $candidateID = $candidate['owner'];
                                                     $query3 = "SELECT * FROM user WHERE user_id='$candidateID'";
                                                     $r3 = mysql_query($query3);
                                                     $owner = mysql_fetch_array($r3);

                                                     $date = date_create($candidate['date_created']);
                                                     $newDate = date_format($date,"M. d, o");

                                                     if($candidate['date_attended'] != "0000-00-00"){
                                                     $date = date_create($candidate['date_attended']);
                                                     $newDateAttended = date_format($date,"M. d, o");
                                                     }else{
                                                     $newDateAttended = "";
                                                     }

                                                     $assignedDate = date_create($candidate['assigned_date_of_interview']);
                                                     $newAssignedDate = date_format($date,"F d, o");

                                                     $confirmedDate = date_create($candidate['confirmed_date_of_interview']);
                                                     $newConfirmedDate = date_format($date,"F d, o");

                                                     if($userType == "Finance"){
                                                     echo "<tr>";
                                                     echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";

                                                     echo "<td>".$candidate['processing_branch']."</td>";
                                                     echo "<td>".$newDateAttended."</td>";
                                                     echo "<td>".$candidate['endorsement_history']."</td>";
                                                     echo "<td>";
                                                     echo '<form id="actionForm" name="actionForm" method="GET">';
                                                     echo '<div class=" text-right">';
                                                     echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                     echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                     echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';

                                                     if($candidate['is_duplicate'] == "127"){
                                                       echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                     }else{
                                                       echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                     }

                                                     echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                     echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                     echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                     if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                     echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                     }
                                                     echo "</td>";
                                                     echo '</form>';
                                                     echo "</tr>";
                                                   }else{
                                                     $ownerID = $candidate['entered_by'];

                                                     //if(stristr($user['criterion'],$ownerID)){
                                                         echo "<tr>";
                                                         echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";
                                                         echo "<td>".$candidate['phone_cell']."</td>";
                                                         echo "<td>".$candidate['processing_branch']."</td>";
                                                         echo "<td>".$owner['first_name']." ".substr($owner['last_name'], 0, 1)."."."</td>";
                                                         echo "<td>";
                                                         echo '<form id="actionForm" name="actionForm" method="GET">';
                                                         echo '<div class=" text-right">';
                                                         echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                         echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                         echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';
                                                         if($candidate['is_duplicate'] == "127"){
                                                           echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                         }else{
                                                           echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                         }

                                                         echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                         echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                         echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                         if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                         echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                         }
                                                         echo "</td>";
                                                         echo '</form>';
                                                         echo "</tr>";
                                                     //}
                                                   }
                                                   }
                                                    ?>



                                                    <?php

                                                    // This is the last name search

                                                    //echo "QString: ".$qString."<br>";
                                                  //  echo "QString2: ".$qString2."<br>";
                                                    $search = "SELECT * FROM candidate WHERE last_name LIKE '%$searchKeyword%' $criterion ORDER BY candidate_id DESC LIMIT 10";

                                                    //echo "<br>Search: ".$search;
                                                    //echo "<br>nString: ".$nString;
                                                    $r2 = mysql_query($search, $dbc);

                                                    while($candidate = mysql_fetch_array($r2)){

                                                      $candidateID = $candidate['owner'];
                                                      $query3 = "SELECT * FROM user WHERE user_id='$candidateID'";
                                                      $r3 = mysql_query($query3);
                                                      $owner = mysql_fetch_array($r3);

                                                      $date = date_create($candidate['date_created']);
                                                      $newDate = date_format($date,"M. d, o");

                                                      if($candidate['date_attended'] != "0000-00-00"){
                                                      $date = date_create($candidate['date_attended']);
                                                      $newDateAttended = date_format($date,"M. d, o");
                                                      }else{
                                                      $newDateAttended = "";
                                                      }

                                                      $assignedDate = date_create($candidate['assigned_date_of_interview']);
                                                      $newAssignedDate = date_format($date,"F d, o");

                                                      $confirmedDate = date_create($candidate['confirmed_date_of_interview']);
                                                      $newConfirmedDate = date_format($date,"F d, o");

                                                      if($userType == "Finance"){
                                                      echo "<tr>";
                                                      echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";

                                                      echo "<td>".$candidate['processing_branch']."</td>";
                                                      echo "<td>".$newDateAttended."</td>";
                                                      echo "<td>".$candidate['endorsement_history']."</td>";
                                                      echo "<td>";
                                                      echo '<form id="actionForm" name="actionForm" method="GET">';
                                                      echo '<div class=" text-right">';
                                                      echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                      echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                      echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';

                                                      if($candidate['is_duplicate'] == "127"){
                                                        echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                      }else{
                                                        echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                      }

                                                      echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                      echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                      echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                      if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                      echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                      }
                                                      echo "</td>";
                                                      echo '</form>';
                                                      echo "</tr>";
                                                    }else{
                                                      $ownerID = $candidate['entered_by'];

                                                      //if(stristr($user['criterion'],$ownerID)){
                                                          echo "<tr>";
                                                          echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";
                                                          echo "<td>".$candidate['phone_cell']."</td>";
                                                          echo "<td>".$candidate['processing_branch']."</td>";
                                                          echo "<td>".$owner['first_name']." ".substr($owner['last_name'], 0, 1)."."."</td>";
                                                          echo "<td>";
                                                          echo '<form id="actionForm" name="actionForm" method="GET">';
                                                          echo '<div class=" text-right">';
                                                          echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                          echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                          echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';
                                                          if($candidate['is_duplicate'] == "127"){
                                                            echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                          }else{
                                                            echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                          }

                                                          echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                          echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                          echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                          if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                          echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                          }
                                                          echo "</td>";
                                                          echo '</form>';
                                                          echo "</tr>";
                                                      //}
                                                    }
                                                    }
                                                     ?>


                                                     <?php

                                                     // This is the first name search

                                                     //echo "QString: ".$qString."<br>";
                                                   //  echo "QString2: ".$qString2."<br>";
                                                     $search = "SELECT * FROM candidate WHERE first_name LIKE '%$searchKeyword%' $criterion ORDER BY candidate_id DESC LIMIT 10";

                                                     //echo "<br>Search: ".$search;
                                                     //echo "<br>nString: ".$nString;
                                                     $r2 = mysql_query($search, $dbc);

                                                     while($candidate = mysql_fetch_array($r2)){

                                                       $candidateID = $candidate['owner'];
                                                       $query3 = "SELECT * FROM user WHERE user_id='$candidateID'";
                                                       $r3 = mysql_query($query3);
                                                       $owner = mysql_fetch_array($r3);

                                                       $date = date_create($candidate['date_created']);
                                                       $newDate = date_format($date,"M. d, o");

                                                       if($candidate['date_attended'] != "0000-00-00"){
                                                       $date = date_create($candidate['date_attended']);
                                                       $newDateAttended = date_format($date,"M. d, o");
                                                       }else{
                                                       $newDateAttended = "";
                                                       }

                                                       $assignedDate = date_create($candidate['assigned_date_of_interview']);
                                                       $newAssignedDate = date_format($date,"F d, o");

                                                       $confirmedDate = date_create($candidate['confirmed_date_of_interview']);
                                                       $newConfirmedDate = date_format($date,"F d, o");

                                                       if($userType == "Finance"){
                                                       echo "<tr>";
                                                       echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";

                                                       echo "<td>".$candidate['processing_branch']."</td>";
                                                       echo "<td>".$newDateAttended."</td>";
                                                       echo "<td>".$candidate['endorsement_history']."</td>";
                                                       echo "<td>";
                                                       echo '<form id="actionForm" name="actionForm" method="GET">';
                                                       echo '<div class=" text-right">';
                                                       echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                       echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                       echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';

                                                       if($candidate['is_duplicate'] == "127"){
                                                         echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                       }else{
                                                         echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                       }

                                                       echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                       echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                       echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                       if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                       echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                       }
                                                       echo "</td>";
                                                       echo '</form>';
                                                       echo "</tr>";
                                                     }else{
                                                       $ownerID = $candidate['entered_by'];

                                                       //if(stristr($user['criterion'],$ownerID)){
                                                           echo "<tr>";
                                                           echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";
                                                           echo "<td>".$candidate['phone_cell']."</td>";
                                                           echo "<td>".$candidate['processing_branch']."</td>";
                                                           echo "<td>".$owner['first_name']." ".substr($owner['last_name'], 0, 1)."."."</td>";
                                                           echo "<td>";
                                                           echo '<form id="actionForm" name="actionForm" method="GET">';
                                                           echo '<div class=" text-right">';
                                                           echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                           echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                           echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';
                                                           if($candidate['is_duplicate'] == "127"){
                                                             echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                           }else{
                                                             echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                           }

                                                           echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                           echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                           echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                           if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                           echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                           }
                                                           echo "</td>";
                                                           echo '</form>';
                                                           echo "</tr>";
                                                       //}
                                                     }
                                                     }
                                                      ?>





                                                         <?php

                                                         // This is the first name search

                                                         //echo "QString: ".$qString."<br>";
                                                       //  echo "QString2: ".$qString2."<br>";
                                                         $search = "SELECT * FROM candidate WHERE first_name LIKE '%$firstName%' $criterion ORDER BY candidate_id DESC LIMIT 10";

                                                         //echo "<br>Search: ".$search;
                                                         //echo "<br>nString: ".$nString;
                                                         $r2 = mysql_query($search, $dbc);

                                                         while($candidate = mysql_fetch_array($r2)){

                                                           $candidateID = $candidate['owner'];
                                                           $query3 = "SELECT * FROM user WHERE user_id='$candidateID'";
                                                           $r3 = mysql_query($query3);
                                                           $owner = mysql_fetch_array($r3);

                                                           $date = date_create($candidate['date_created']);
                                                           $newDate = date_format($date,"M. d, o");

                                                           if($candidate['date_attended'] != "0000-00-00"){
                                                           $date = date_create($candidate['date_attended']);
                                                           $newDateAttended = date_format($date,"M. d, o");
                                                           }else{
                                                           $newDateAttended = "";
                                                           }

                                                           $assignedDate = date_create($candidate['assigned_date_of_interview']);
                                                           $newAssignedDate = date_format($date,"F d, o");

                                                           $confirmedDate = date_create($candidate['confirmed_date_of_interview']);
                                                           $newConfirmedDate = date_format($date,"F d, o");

                                                           if($userType == "Finance"){
                                                           echo "<tr>";
                                                           echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";

                                                           echo "<td>".$candidate['processing_branch']."</td>";
                                                           echo "<td>".$newDateAttended."</td>";
                                                           echo "<td>".$candidate['endorsement_history']."</td>";
                                                           echo "<td>";
                                                           echo '<form id="actionForm" name="actionForm" method="GET">';
                                                           echo '<div class=" text-right">';
                                                           echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                           echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                           echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';

                                                           if($candidate['is_duplicate'] == "127"){
                                                             echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                           }else{
                                                             echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                           }

                                                           echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                           echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                           echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                           if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                           echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                           }
                                                           echo "</td>";
                                                           echo '</form>';
                                                           echo "</tr>";
                                                         }else{
                                                           $ownerID = $candidate['entered_by'];

                                                           //if(stristr($user['criterion'],$ownerID)){
                                                               echo "<tr>";
                                                               echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";
                                                               echo "<td>".$candidate['phone_cell']."</td>";
                                                               echo "<td>".$candidate['processing_branch']."</td>";
                                                               echo "<td>".$owner['first_name']." ".substr($owner['last_name'], 0, 1)."."."</td>";
                                                               echo "<td>";
                                                               echo '<form id="actionForm" name="actionForm" method="GET">';
                                                               echo '<div class=" text-right">';
                                                               echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                               echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                               echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';
                                                               if($candidate['is_duplicate'] == "127"){
                                                                 echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                               }else{
                                                                 echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                               }

                                                               echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                               echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                               echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                               if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                               echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                               }
                                                               echo "</td>";
                                                               echo '</form>';
                                                               echo "</tr>";
                                                           //}
                                                         }
                                                         }
                                                          ?>




                                                           <?php

                                                           // This is the first name search

                                                           //echo "QString: ".$qString."<br>";
                                                         //  echo "QString2: ".$qString2."<br>";
                                                           $search = "SELECT * FROM candidate WHERE first_name LIKE '%$lastName%' $criterion ORDER BY candidate_id DESC LIMIT 10";

                                                           //echo "<br>Search: ".$search;
                                                           //echo "<br>nString: ".$nString;
                                                           $r2 = mysql_query($search, $dbc);

                                                           while($candidate = mysql_fetch_array($r2)){

                                                             $candidateID = $candidate['owner'];
                                                             $query3 = "SELECT * FROM user WHERE user_id='$candidateID'";
                                                             $r3 = mysql_query($query3);
                                                             $owner = mysql_fetch_array($r3);

                                                             $date = date_create($candidate['date_created']);
                                                             $newDate = date_format($date,"M. d, o");

                                                             if($candidate['date_attended'] != "0000-00-00"){
                                                             $date = date_create($candidate['date_attended']);
                                                             $newDateAttended = date_format($date,"M. d, o");
                                                             }else{
                                                             $newDateAttended = "";
                                                             }

                                                             $assignedDate = date_create($candidate['assigned_date_of_interview']);
                                                             $newAssignedDate = date_format($date,"F d, o");

                                                             $confirmedDate = date_create($candidate['confirmed_date_of_interview']);
                                                             $newConfirmedDate = date_format($date,"F d, o");

                                                             if($userType == "Finance"){
                                                             echo "<tr>";
                                                             echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";

                                                             echo "<td>".$candidate['processing_branch']."</td>";
                                                             echo "<td>".$newDateAttended."</td>";
                                                             echo "<td>".$candidate['endorsement_history']."</td>";
                                                             echo "<td>";
                                                             echo '<form id="actionForm" name="actionForm" method="GET">';
                                                             echo '<div class=" text-right">';
                                                             echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                             echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                             echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';

                                                             if($candidate['is_duplicate'] == "127"){
                                                               echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                             }else{
                                                               echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                             }

                                                             echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                             echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                             echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                             if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                             echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                             }
                                                             echo "</td>";
                                                             echo '</form>';
                                                             echo "</tr>";
                                                           }else{
                                                             $ownerID = $candidate['entered_by'];

                                                             //if(stristr($user['criterion'],$ownerID)){
                                                                 echo "<tr>";
                                                                 echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";
                                                                 echo "<td>".$candidate['phone_cell']."</td>";
                                                                 echo "<td>".$candidate['processing_branch']."</td>";
                                                                 echo "<td>".$owner['first_name']." ".substr($owner['last_name'], 0, 1)."."."</td>";
                                                                 echo "<td>";
                                                                 echo '<form id="actionForm" name="actionForm" method="GET">';
                                                                 echo '<div class=" text-right">';
                                                                 echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                                 echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                                 echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';
                                                                 if($candidate['is_duplicate'] == "127"){
                                                                   echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                                 }else{
                                                                   echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                                 }

                                                                 echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                                 echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                                 echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                                 if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                                 echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                                 }
                                                                 echo "</td>";
                                                                 echo '</form>';
                                                                 echo "</tr>";
                                                             //}
                                                           }
                                                           }
                                                            ?>


                                                               <?php

                                                               // This is the first name search

                                                               //echo "QString: ".$qString."<br>";
                                                             //  echo "QString2: ".$qString2."<br>";
                                                               $search = "SELECT * FROM candidate WHERE last_name LIKE '%$lastName%' $criterion ORDER BY candidate_id DESC LIMIT 10";

                                                               //echo "<br>Search: ".$search;
                                                               //echo "<br>nString: ".$nString;
                                                               $r2 = mysql_query($search, $dbc);

                                                               while($candidate = mysql_fetch_array($r2)){

                                                                 $candidateID = $candidate['owner'];
                                                                 $query3 = "SELECT * FROM user WHERE user_id='$candidateID'";
                                                                 $r3 = mysql_query($query3);
                                                                 $owner = mysql_fetch_array($r3);

                                                                 $date = date_create($candidate['date_created']);
                                                                 $newDate = date_format($date,"M. d, o");

                                                                 if($candidate['date_attended'] != "0000-00-00"){
                                                                 $date = date_create($candidate['date_attended']);
                                                                 $newDateAttended = date_format($date,"M. d, o");
                                                                 }else{
                                                                 $newDateAttended = "";
                                                                 }

                                                                 $assignedDate = date_create($candidate['assigned_date_of_interview']);
                                                                 $newAssignedDate = date_format($date,"F d, o");

                                                                 $confirmedDate = date_create($candidate['confirmed_date_of_interview']);
                                                                 $newConfirmedDate = date_format($date,"F d, o");

                                                                 if($userType == "Finance"){
                                                                 echo "<tr>";
                                                                 echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";

                                                                 echo "<td>".$candidate['processing_branch']."</td>";
                                                                 echo "<td>".$newDateAttended."</td>";
                                                                 echo "<td>".$candidate['endorsement_history']."</td>";
                                                                 echo "<td>";
                                                                 echo '<form id="actionForm" name="actionForm" method="GET">';
                                                                 echo '<div class=" text-right">';
                                                                 echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                                 echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                                 echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';

                                                                 if($candidate['is_duplicate'] == "127"){
                                                                   echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                                 }else{
                                                                   echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                                 }

                                                                 echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                                 echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                                 echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                                 if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                                 echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                                 }
                                                                 echo "</td>";
                                                                 echo '</form>';
                                                                 echo "</tr>";
                                                               }else{
                                                                 $ownerID = $candidate['entered_by'];

                                                                 //if(stristr($user['criterion'],$ownerID)){
                                                                     echo "<tr>";
                                                                     echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";
                                                                     echo "<td>".$candidate['phone_cell']."</td>";
                                                                     echo "<td>".$candidate['processing_branch']."</td>";
                                                                     echo "<td>".$owner['first_name']." ".substr($owner['last_name'], 0, 1)."."."</td>";
                                                                     echo "<td>";
                                                                     echo '<form id="actionForm" name="actionForm" method="GET">';
                                                                     echo '<div class=" text-right">';
                                                                     echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                                     echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                                     echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';
                                                                     if($candidate['is_duplicate'] == "127"){
                                                                       echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                                     }else{
                                                                       echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                                     }

                                                                     echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                                     echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                                     echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                                     if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                                     echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                                     }
                                                                     echo "</td>";
                                                                     echo '</form>';
                                                                     echo "</tr>";
                                                                 //}
                                                               }
                                                               }
                                                                ?>


                                                                <?php

                                                                // This is the first name search

                                                                //echo "QString: ".$qString."<br>";
                                                              //  echo "QString2: ".$qString2."<br>";
                                                                $search = "SELECT * FROM candidate WHERE last_name LIKE '%$firstName%' $criterion ORDER BY candidate_id DESC LIMIT 10";

                                                                //echo "<br>Search: ".$search;
                                                                //echo "<br>nString: ".$nString;
                                                                $r2 = mysql_query($search, $dbc);

                                                                while($candidate = mysql_fetch_array($r2)){

                                                                  $candidateID = $candidate['owner'];
                                                                  $query3 = "SELECT * FROM user WHERE user_id='$candidateID'";
                                                                  $r3 = mysql_query($query3);
                                                                  $owner = mysql_fetch_array($r3);

                                                                  $date = date_create($candidate['date_created']);
                                                                  $newDate = date_format($date,"M. d, o");

                                                                  if($candidate['date_attended'] != "0000-00-00"){
                                                                  $date = date_create($candidate['date_attended']);
                                                                  $newDateAttended = date_format($date,"M. d, o");
                                                                  }else{
                                                                  $newDateAttended = "";
                                                                  }

                                                                  $assignedDate = date_create($candidate['assigned_date_of_interview']);
                                                                  $newAssignedDate = date_format($date,"F d, o");

                                                                  $confirmedDate = date_create($candidate['confirmed_date_of_interview']);
                                                                  $newConfirmedDate = date_format($date,"F d, o");

                                                                  if($userType == "Finance"){
                                                                  echo "<tr>";
                                                                  echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";

                                                                  echo "<td>".$candidate['processing_branch']."</td>";
                                                                  echo "<td>".$newDateAttended."</td>";
                                                                  echo "<td>".$candidate['endorsement_history']."</td>";
                                                                  echo "<td>";
                                                                  echo '<form id="actionForm" name="actionForm" method="GET">';
                                                                  echo '<div class=" text-right">';
                                                                  echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                                  echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                                  echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';

                                                                  if($candidate['is_duplicate'] == "127"){
                                                                    echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                                  }else{
                                                                    echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                                  }

                                                                  echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                                  echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                                  echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                                  if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                                  echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                                  }
                                                                  echo "</td>";
                                                                  echo '</form>';
                                                                  echo "</tr>";
                                                                }else{
                                                                  $ownerID = $candidate['entered_by'];

                                                                  //if(stristr($user['criterion'],$ownerID)){
                                                                      echo "<tr>";
                                                                      echo "<td><a href='module.php?m=candidates&a=show&candidateID=".$candidate['candidate_id']."'>".$candidate['first_name']." ".$candidate['last_name']."</a></td>";
                                                                      echo "<td>".$candidate['phone_cell']."</td>";
                                                                      echo "<td>".$candidate['processing_branch']."</td>";
                                                                      echo "<td>".$owner['first_name']." ".substr($owner['last_name'], 0, 1)."."."</td>";
                                                                      echo "<td>";
                                                                      echo '<form id="actionForm" name="actionForm" method="GET">';
                                                                      echo '<div class=" text-right">';
                                                                      echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
                                                                      echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
                                                                      echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';
                                                                      if($candidate['is_duplicate'] == "127"){
                                                                        echo '<button class="btn btn-warning" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()" style="width:150px;">Untag as Duplicate</button><span style="padding:5px; ">';
                                                                      }else{
                                                                        echo '<button class="btn btn-dark" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()" style="width:150px;">Tag as Duplicate</button><span style="padding:5px;">';
                                                                      }

                                                                      echo '<a class="btn btn-info" href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">View</a><span style="padding:5px;">';
                                                                      echo '<a class="btn btn-primary" href="module.php?m=candidates&a=edit&candidateID='.$candidate['candidate_id'].'">Edit</a><span style="padding:5px;">';

                                                                      echo '<input type="hidden" name="candidateID" value="'.$candidate['candidate_id'].'">';
                                                                      if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
                                                                      echo '<button class="btn btn-danger" formaction="data/deleteonecandidatefromsearch.php" onclick="toConfirm()">Delete</button>';
                                                                      }
                                                                      echo "</td>";
                                                                      echo '</form>';
                                                                      echo "</tr>";
                                                                  //}
                                                                }
                                                                }
                                                                 ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>







<?php
    /*echo '<div class="col-6">
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
            </div>';*/

 ?>

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
