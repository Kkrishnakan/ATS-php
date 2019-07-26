
<div class="col-lg-12 mt-2">

<div class="card">
<div class="card-body">


  <?php
  @mysqli_set_charset($dbc,"utf8");

  $userID = $_SESSION['user'];
  $query = mysqli_query($dbc, "SELECT * FROM user WHERE user_id='$userID'");
  $currentUser = mysqli_fetch_array($query);

  $userType = $currentUser['user_type'];

  $candidateID = $_GET['candidateID'];
  $query = mysqli_query($dbc, "SELECT * FROM candidate WHERE candidate_id='$candidateID'" );
  $candidate = mysqli_fetch_array($query);



  $entered_by = $candidate['entered_by'];
  $ownerID     = $candidate['owner'];

  $query2 = mysqli_query($dbc, "SELECT * FROM user WHERE user_id='$entered_by'");
  $enteredBy = mysqli_fetch_array($query2);

  $query3 = mysqli_query( $dbc, "SELECT * FROM user WHERE user_id='$ownerID'" );
  $owner = mysqli_fetch_array($query3);




  function changeDateFormat($toChange){
    if($toChange == "0000-00-00"){
      $newDate = "";
    }elseif($toChange == ""){
      $newDate = "";
    }else{
      $date = date_create($toChange);
      $newDate = date_format($date,"F d, o");
      }
      return $newDate;
    }

  function changeDateFormatWithTime($toChange){
    if($toChange == "0000-00-00"){
      $newDate = "";
    }elseif($toChange == ""){
      $newDate = "";
    }else{
          $date = date_create($toChange);
          $newDate = date_format($date,"F d, o (h:i a)");
        }
          return $newDate;
          }

  function changeTimeFormat($toChange){
    if($toChange == ""){
      $newDate = "";
    }elseif($toChange == ""){
      $newDate = "";
    }else{
                  $date = date_create($toChange);
                  $newDate = date_format($date,"h:i a");
                }
                  return $newDate;
                  }

  ?>

  <div class="row">
    <div class="col-lg-3" style="font-size:11px;">
      <div class="">
        <table class="table" style="border:1px #e0e0e0 solid;">
          <thead class="">
          </thead>
          <tbody>

            <?php
            if ($candidate['is_duplicate'] == "127"){
              $isDuplicate = "<span style='color:red;'>(DUPLICATE)</span>";
            }
            ?>
            <tr>
              <td class="bg-light">Name:</td>
              <td><?php echo $candidate['full_name']." ".$isDuplicate; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Mobile Number:</td>
              <td><?php echo $candidate['phone_cell']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Email:</td>
              <td><?php echo $candidate['email1']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Gender:</td>
              <td><?php echo $candidate['gender']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Date of Birth:</td>
              <td><?php echo changeDateFormat($candidate['date_of_birth']); ?></td>
            </tr>

            <tr>
              <td class="bg-light">Location:</td>
              <td><?php echo $candidate['city']; ?></td>
            </tr>


            <tr>
              <td class="bg-light">Educational Attainment:</td>
              <td><?php echo $candidate['educational_attainment']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Course/Degree:</td>
              <td><?php echo $candidate['course']; ?></td>
            </tr>



            <tr>
              <td class="bg-light">BPO Experience:</td>
              <td><?php echo $candidate['bpo_experience']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Confirmation Status:</td>
              <td><?php echo $candidate['confirmation_status']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Confirmed Date:</td>
              <td><?php echo changeDateFormat($candidate['confirmed_date_of_interview']); ?></td>
            </tr>


            <tr>
              <td class="bg-light">Assigned Date:</td>
              <td><?php echo changeDateFormat($candidate['assigned_date_of_interview']); ?></td>
            </tr>

              <tr>
                <td class="bg-light">Advertiser Remarks:</td>
                <td><?php echo $candidate['advertiser_remarks']; ?></td>
              </tr>

          </tbody>
        </table>
        </div>
    </div>

    <div class="col-lg-3" style="font-size:11px;" >
      <div class="">
        <table class="table" style="border:1px #e0e0e0 solid;">
          <thead class="">
          </thead>
          <tbody>

            <tr>
              <td class="bg-light">Processing Branch:</td>
              <td><?php echo $candidate['processing_branch']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Means of Communication:</td>
              <td><?php echo $candidate['preferred_communication']; ?></td>
            </tr>

              <tr>
                <td class="bg-light">Type of Lead:</td>
                <td><?php echo $candidate['type_of_lead']; ?></td>
              </tr>

            <tr>
              <td class="bg-light">Call Status:</td>
              <td><?php echo $candidate['call_status']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Replied To:</td>
              <td><?php echo $candidate['replied_to']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Source:</td>
              <td><?php echo $candidate['source']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Ad Applied To:</td>
              <td><?php echo $candidate['ad_applied_to']; ?></td>
            </tr>


            <tr>
              <td class="bg-light">Date Created:</td>
              <td><?php echo changeDateFormatWithTime($candidate['date_created']); ?></td>
            </tr>

            <tr>
              <td class="bg-light">Last Modified:</td>
              <td><?php echo changeDateFormatWithTime($candidate['date_modified']); ?></td>
            </tr>

            <tr>
              <td class="bg-light">Last Modified By:</td>
              <?php
              $getLastModified = $candidate['last_modified_by'];
              $query = mysqli_query( $dbc, "SELECT * FROM user WHERE user_id='$getLastModified'" );
              $user = mysqli_fetch_array($query);
              ?>
              <td><?php echo $user['first_name']." ".$user['last_name']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Encoded by:</td>
              <td><?php echo $enteredBy['first_name']." ".$enteredBy['last_name']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Owned by:</td>
              <td><?php echo $owner['first_name']." ".$owner['last_name']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Receptionist:</td>
              <td><?php echo $candidate['receptionist']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Interviewed by:</td>
              <td><?php echo $candidate['interviewed_by']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Shuttled by (Promodiser):</td>
              <td><?php echo $candidate['shuttled_by_promodiser']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Shuttled by (Driver):</td>
              <td><?php echo $candidate['shuttled_by_driver']; ?></td>
            </tr>



          </tbody>
        </table>
        </div>
    </div>

    <div class="col-lg-3" style="font-size:11px;" >
      <div class="">
        <table class="table" style="border:1px #e0e0e0 solid;">
          <thead class="">
          </thead>
          <tbody>

              <tr>
                <td class="bg-light">Recruitment Type:</td>
                <td><?php echo $candidate['recruitment_type']; ?></td>
              </tr>

              <tr>
                <td class="bg-light">Recruitment Location:</td>
                <td><?php echo $candidate['recruitment_location']; ?></td>
              </tr>

            <tr>
              <td class="bg-light">Attendance Status:</td>
              <td><?php echo $candidate['attendance_status']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Date Attended:</td>
              <td><?php echo changeDateFormat($candidate['date_attended']); ?></td>
            </tr>

            <tr>
              <td class="bg-light">Time of Arrival:</td>
              <td><?php echo changeTimeFormat($candidate['time_of_arrival']); ?></td>
            </tr>

            <tr>
              <td class="bg-light">Time of Interview:</td>
              <td><?php echo changeTimeFormat($candidate['time_of_interview']); ?></td>
            </tr>

            <tr>
              <td class="bg-light">Shuttle Status:</td>
              <td><?php echo $candidate['shuttle_status']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Time of Shuttle:</td>
              <td><?php echo changeTimeFormat($candidate['time_of_shuttle']); ?></td>
            </tr>

            <tr>
              <td class="bg-light">Endorsement Status:</td>
              <td><?php echo $candidate['endorsement_status']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Endorsement History:</td>
              <td><?php echo $candidate['first_endorsement']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Other Endorsement History:</td>
              <td><?php echo $candidate['second_endorsement']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Other Endorsement History:</td>
              <td><?php echo $candidate['third_endorsement']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Other Endorsements:</td>
              <td><?php echo $candidate['other_endorsement']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">No Endorsement:</td>
              <td><?php echo $candidate['no_endorsement']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Reason for not Getting Hired:</td>
              <td><?php echo $candidate['reason_for_not_getting_hired']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Recruiter Remarks:</td>
              <td><?php echo $candidate['recruiter_remarks']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Other Recruiter Remarks:</td>
              <td><?php echo $candidate['other_recruiter_remarks']; ?></td>
            </tr>
          </tbody>
        </table>
        </div>
    </div>



    <div class="col-lg-3" style="font-size:11px;" >
      <div class="">
        <table class="table" style="border:1px #e0e0e0 solid;">
          <thead class="">
          </thead>
          <tbody>

            <tr>
              <td class="bg-light">Application Status:</td>
              <td><?php echo $candidate['application_status']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Date of Input:</td>
              <td><?php echo changeDateFormat($candidate['date_of_input']); ?></td>
            </tr>

            <tr>
              <td class="bg-light">Hiring Company:</td>
              <td><?php echo $candidate['hiring_company']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Point Assignment Per Hire:</td>
              <td><?php echo $candidate['point_assignment_per_hire']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Hiring Account:</td>
              <td><?php echo $candidate['hiring_account']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Hired Date:</td>
              <td><?php echo changeDateFormat($candidate['hired_date']); ?></td>
            </tr>

            <tr>
              <td class="bg-light">Start Date:</td>
              <td><?php echo changeDateFormat($candidate['start_date']); ?></td>
            </tr>

            <tr>
              <td class="bg-light">Billing Client:</td>
              <td><?php echo $candidate['billing_client']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Billing Status 1:</td>
              <td><?php echo $candidate['billing_status']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Date Paid to Employee:</td>
              <td><?php echo changeDateFormat($candidate['date_paid']); ?></td>
            </tr>

            <tr>
              <td class="bg-light">Billing Status 2:</td>
              <td><?php echo $candidate['billing_status2']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Date Client Billed the Applicant:</td>
              <td><?php echo changeDateFormat($candidate['billing_date']); ?></td>
            </tr>

            <tr>
              <td class="bg-light">Validation Status:</td>
              <td><?php echo $candidate['validation_status']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Validation Date:</td>
              <td><?php echo changeDateFormat($candidate['validation_date']); ?></td>
            </tr>

            <tr>
              <td class="bg-light">Finance Department's Remarks:</td>
              <td><?php echo $candidate['finance_remarks']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">Corresponding Point/s:</td>
              <td><?php echo $candidate['corresponding_point']; ?></td>
            </tr>

            <tr>
              <td class="bg-light">For Replacement:</td>
              <td><?php if($candidate['for_replacement'] == "127"){ echo "<span style='color:red;'>For Replacement</span>"; } ?></td>
            </tr>

            <tr>
              <td class="bg-light">Replaced By:</td>
              <?php
              $candidateIDreplacement = $candidate['replaced_by'];
              $query = mysqli_query( $dbc, "SELECT first_name, last_name FROM candidate WHERE candidate_id='$candidateIDreplacement'" );
              $candidateReplacement = mysqli_fetch_array($query);
               ?>
              <td><?php echo '<a href="module.php?m=candidates&a=show&candidateID='.$candidateIDreplacement.'">'.$candidateReplacement['first_name']." ".$candidateReplacement['last_name']."</a>"; ?></td>
            </tr>
          </tbody>
        </table>
        </div>
    </div>


    <form id="actionForm" name="actionForm" action="" method="GET">
      <input type="hidden" name="candidateID" value="<?php echo $_GET['candidateID']; ?>">
      <?php
      $candidateID = $_GET['candidateID'];

      $editFormAction = "module.php?m=candidates&a=edit&candidateID=".$candidateID;
      $deleteFormAction = "data/deleteonecandidatefromshow.php";
      $tagAsDuplicateFormAction = "module.php?m=candidates&a=tagAsDuplicate&candidateID=".$candidateID;
      ?>

      <div class="card-body">
        <a href="<?php echo $editFormAction; ?>" class="btn btn-primary mb-3">Edit</a>

        <?php
        if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader")){
          echo '<button class="btn btn-danger mb-3" onclick="toConfirm()" formaction="data/deleteonecandidatefromshow.php">Delete</button>';
        }
         ?>

        <?php
        echo '<input type="hidden" name="k" value="'.$_GET['k'].'">';
        echo '<input type="hidden" name="m" value="'.$_GET['m'].'">';
        echo '<input type="hidden" name="a" value="'.$_GET['a'].'">';
        if($candidate['is_duplicate'] == "127"){
          echo '<button class="btn btn-warning mb-3" formaction="data/untagasduplicatefromsearch.php" onclick="toUntagAsDuplicate()">Untag as Duplicate</button>';
        }else{
          echo '<button class="btn btn-dark mb-3" formaction="data/tagasduplicatefromsearch.php" onclick="toTagAsDuplicate()">Tag as Duplicate</button>';
        }

         ?>

      </div>
</form>



  </div>

</div>
</div>
</div>


<script type="text/javascript">
  function toConfirm(){
  //confirm("Press a button!");
  if( !confirm("Do you want to delete selected candidates") ){
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
