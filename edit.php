  <?php
  @mysqli_set_charset($dbc,"utf8");
  $candidateID = $_GET['candidateID'];
  $query = mysqli_query( $dbc, "SELECT * FROM candidate WHERE candidate_id='$candidateID'" );
  $candidate = mysqli_fetch_array($query);

  $userID = $_SESSION['user'];
  $query2 = mysqli_query( $dbc, "SELECT * FROM user WHERE user_id='$userID'" );
  $user = mysqli_fetch_array($query2);

  $userType = $user['user_type'];

  switch($userType){
    case "Receptionist":
    $receptionistRequired = "required";
    break;

    case "Recruiter":
    $recruiterRequired = "required";
    break;

    case "Finance":
    $financeRequired = "required";
    break;
  }

  ?>

<div class="row">

<div class="col-lg-12 mt-2">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title">Candidates: Edit as <?php echo $user['user_type']; ?><p class="text-muted font-10 mb-4">Edit Candidate Details</p></h4>

        <form id="mainForm" action="data/editcandidate.php" method="POST">

        <input type="hidden" name="candidateID" value="<?php echo $candidateID; ?>">
        <input type="hidden" name="owner" value="<?php echo $candidate['owner']; ?>">

        <?php
        if ($user['user_type'] != "Recruiter"){ // for Recruiters
          $displayRecruiterRow = 'style="display:none;"';
          $recruiterRequiredFields = 'class="bg-light"';
          $disabledIfRecruiter = "";
        }else{
          $displayRecruiterRow = '';
          $recruiterRequiredFields = 'class="bg-warning"';
          $disabledIfRecruiter = "disabled";
        }

         if ($user['user_type'] != "Receptionist"){ // for Receptionist
           $displayReceptionistRow = 'style="display:none;"';
            $receptionistRequiredFields = 'class="bg-light"';
             $disabledIfReceptionist = "";
         }else{
           $displayReceptionistRow = '';
           $displayAdvertiserExtraRow = 'style="display:none;"';
           $receptionistRequiredFields = 'class="bg-warning"';
           $disabledIfReceptionist = "disabled";
         }

         if ($user['user_type'] != "Finance"){ // for Receptionist
           $displayFinanceRow = 'style="display:none;"';
           $financeRequiredFields = 'class="bg-light"';
           $disabledIfFinance = "";
         }else{
           $displayFinanceRow = '';
           $financeRequiredFields = 'class="bg-warning"';
           $disabledIfFinance = "disabled";
         }

        if($user['user_type'] == "Executive"){ // for Admin/Executive
          $displayReceptionistRow = '';
          $displayRecruiterRow    = '';
          $displayFinanceRow = '';
        }

        if($user['user_type'] == "Advertiser"){ // for Admin/Executive
          $displayReceptionistRow = '';
          $displayReceptionistExtraRow = 'style="display:none;"';
        }

        if($user['user_type'] == "Team Leader"){ // for Admin/Executive
          $displayReceptionistRow = '';
          $displayReceptionistExtraRow = 'style="display:none;"';
        }

        if($user['user_type'] == "Senior Team Leader"){ // for Admin/Executive
          $displayReceptionistRow = '';
          $displayReceptionistExtraRow = 'style="display:none;"';
        }

        ?>



        <div class="row" <?php echo $displayReceptionistRow; ?>> <!-- Row for Receptionists -->

          <div class="col-lg-4">

            <table class="table" style="border:1px #e0e0e0 solid; font-size:11px;">
              <tbody>

                <tr>
                  <input type="hidden" name="candidateID" value="<?php echo $candidateID; ?>">
                </tr>

                <tr>
                  <td class="bg-light">Name:</td>
                  <td><?php echo $candidate['full_name']; ?></td>
                </tr>

                <tr>
                  <td class="bg-light">First Name:</td>
                  <td><input type="text" name="firstName" value="<?php echo $candidate['first_name']; ?>" style="width:100%;"</td>
                </tr>

                <tr>
                  <td class="bg-light">Middle Name:</td>
                  <td><input type="text" name="middleName" value="<?php echo $candidate['middle_name']; ?>" style="width:100%;"</td>
                </tr>

                <tr>
                  <td class="bg-light">Last Name:</td>
                  <td><input type="text" name="lastName" value="<?php echo $candidate['last_name']; ?>" style="width:100%;"</td>
                </tr>


                <tr>
                  <td class="bg-light">Mobile Number:</td>
                  <td><input type="text" name="mobileNumber" value="<?php echo $candidate['phone_cell']; ?>" style="width:100%;"></td>
                </tr>

                <tr>
                  <td class="bg-light">Email:</td>
                  <td><input type="text" name="email" value="<?php echo $candidate['email1']; ?>" style="width:100%;"></td>
                </tr>

                <tr <?php echo $displayReceptionistExtraRow; ?>>
                  <td <?php echo $receptionistRequiredFields; ?> >Gender:</td>
                  <td><select name="gender" style="width:100%;"  <?php echo $receptionistRequired; ?>>
                    <option name="gender" value="<?php echo $candidate['gender']; ?>"><?php echo $candidate['gender']; ?></option>
                    <option>-----</option>
                    <option name="gender" value="Male">Male</option>
                    <option name="gender" value="Female">Female</option>
                    <option name="gender" value="Others">Others</option>
                  </select></td>
                </tr>

                <tr <?php echo $displayReceptionistExtraRow; ?>>
                  <td class="bg-light">Date of Birth:</td>
                  <td><input type="date" name="dateOfBirth" value="<?php echo $candidate['date_of_birth']; ?>" style="width:100%;"></td>
                </tr>

                <tr>
                  <td class="bg-light">Location:</td>
                  <td><input type="text" name="location" value="<?php echo $candidate['city']; ?>" style="width:100%;"></td>
                </tr>

                <tr <?php echo $displayReceptionistExtraRow; ?>>
                  <td <?php echo $receptionistRequiredFields; ?>>Educational Attainment:</td>
                  <td><input type="text" name="educationalAttainment" value="<?php echo $candidate['educational_attainment']; ?>" style="width:100%;"  <?php echo $receptionistRequired; ?>></td>
                </tr>

                <tr <?php echo $displayReceptionistExtraRow; ?>>
                  <td <?php echo $receptionistRequiredFields; ?> >Course/Degree:</td>
                  <td><input type="text" name="course" value="<?php echo $candidate['course']; ?>" style="width:100%;"  <?php echo $receptionistRequired; ?>></td>
                </tr>

                <tr>
                  <td class="bg-light">Means of Communication:</td>
                  <td><input type="text" name="preferredCommunication" value="<?php echo $candidate['preferred_communication']; ?>" style="width:100%;"></td>
                </tr>

                <tr>
                  <td class="bg-light">Type of Lead:</td>
                  <td><input type="text" name="typeOfLead" value="<?php echo $candidate['type_of_lead']; ?>" style="width:100%;"></td>
                </tr>

                  <tr>
                    <td class="bg-light">Replied To:</td>
                    <td><input type="text" name="repliedTo" value="<?php echo $candidate['replied_to']; ?>" style="width:100%;"></td>
                  </tr>




                  <tr>
                    <td class="bg-light">Processing Branch:</td>
                    <td><input type="text" name="processingBranch" value="<?php echo $candidate['processing_branch']; ?>" style="width:100%;"></td>
                  </tr>

                <tr <?php echo $displayAdvertiserExtraRow; ?>>
                  <td class="bg-light">Ad Applied To:</td>
                  <td><input type="text" name="adAppliedTo" value="<?php echo $candidate['ad_applied_to']; ?>" style="width:100%;"></td>
                </tr>

                <tr <?php echo $displayAdvertiserExtraRow; ?>>
                  <td class="bg-light">Confirmation Status:</td>
                  <td>
                      <select id="confirmationStatus" name="confirmationStatus" style="width:100%" >
                        <option name="confirmationStatus" value="<?php echo $candidate['confirmation_status']; ?>"><?php echo $candidate['confirmation_status']; ?></option>
                      <option name="confirmationStatus" value="">------</option>
                      <option name="confirmationStatus" value="Confirmed">Confirmed</option>
                      <option name="confirmationStatus" value="Rescheduled">Rescheduled</option>
                      <option name="confirmationStatus" value="Did Not Confirm">Did Not Confirm</option>
                      </select>
                  </td>
                </tr>


                <tr>
                  <td class="bg-light">Confirmed Date of Interview:</td>
                  <td><input type="date" id="confirmedDate" name="confirmedDate" value="<?php echo $candidate['confirmed_date_of_interview']; ?>" style="width:100%;"></td>
                </tr>

                <tr <?php echo $displayAdvertiserExtraRow; ?>>
                  <td class="bg-light">Assigned Date of Interview:</td>
                  <td><input type="date" name="assignedDate" value="<?php echo $candidate['assigned_date_of_interview']; ?>" style="width:100%;"></td>
                </tr>

                <tr <?php echo $displayAdvertiserExtraRow; ?>>
                  <td class="bg-light">Advertiser Remarks:</td>
                  <td><input type="text" name="advertiserRemarks" value="<?php echo $candidate['advertiser_remarks']; ?>" style="width:100%;"></td>
                </tr>
                <tr <?php echo $displayAdvertiserExtraRow; ?>>
                  <td class="bg-light">Source:</td>
                  <td><input type="text" name="source" value="<?php echo $candidate['source']; ?>" style="width:100%;"></td>
                </tr>
              </tbody>
            </table>

          </div>

          <div class="col-lg-4" <?php echo $displayReceptionistExtraRow; ?>>
            <table class="table" style="border:1px #e0e0e0 solid; font-size:11px;">
              <tbody>

                <tr>
                  <td class="bg-light">Hiring Company:</td>
                  <td>
                    <select id="hiringCompany" name="hiringCompany" style="width:100%;" <?php echo $disabledIfFinance; echo $disabledIfRecruiter; ?>>
                    <option id="hiringCompany" name="hiringCompany" value="<?php echo $candidate['hiring_company']; ?>"><?php echo $candidate['hiring_company']; ?></option>
                    <option id="hiringCompany" name="hiringCompany" value="">-----</option>
                    <?php
                        $query = mysqli_query( $dbc, "SELECT * FROM _partners" );
                        while($row = mysqli_fetch_array($query)){
                            echo '<option id="hiringCompany" name="hiringCompany" value="'.$row['name'].'">'.$row['name'].'</option>';
                        }
                            ?>
                            </select>
                </td>
                </tr>

                <tr>
                  <td <?php echo $receptionistRequiredFields; ?> >Receptionist:</td>
                  <td>
                    <select id="receptionist" name="receptionist" style="width:100%;"  <?php echo $receptionistRequired; ?>>
                    <option id="receptionist" name="receptionist" value="<?php echo $candidate['receptionist']; ?>"><?php echo $candidate['receptionist']; ?></option>
                    <option id="receptionist" name="receptionist" value="">-----</option>
                    <?php
                        $query = mysqli_query( $dbc, "SELECT * FROM _staff WHERE position='Receptionist' GROUP BY first_name ASC" );
                        while($row = mysqli_fetch_array($query)){
                          $receptionist = $row['first_name']." ".$row['last_name'];
                            echo '<option id="receptionist" name="receptionist" value="'.$receptionist.'">'.$receptionist.'</option>';
                        }
                            ?>
                    </select>
                </td>
                </tr>

                <tr>
                  <td <?php echo $receptionistRequiredFields; ?> >Recruitment Type:</td>
                  <td>
                    <select id="recruitmentType" name="recruitmentType" style="width:100%;"  <?php echo $receptionistRequired; ?>>
                    <option id="recruitmentType" name="recruitmentType" value="<?php echo $candidate['recruitment_type']; ?>"><?php echo $candidate['recruitment_type']; ?></option>
                    <option id="recruitmentType" name="recruitmentType" value="">-----</option>
                    <option id="recruitmentType" name="recruitmentType" value="Job Fair">Job Fair</option>
                    <option id="recruitmentType" name="recruitmentType" value="Office Operation">Office Operation</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td <?php echo $receptionistRequiredFields; ?>>Recruitment Location:</td>
                  <td>
                    <select id="recruitmentLocation" name="recruitmentLocation" style="width:100%;" <?php echo $receptionistRequired; ?>>
                    <option id="recruitmentLocation" name="recruitmentLocation" value="<?php echo $candidate['recruitment_location']; ?>"><?php echo $candidate['recruitment_location']; ?></option>
                    <option id="recruitmentLocation" name="recruitmentLocation" value="">-----</option>
                    <?php
                        $query = mysqli_query( $dbc, "SELECT name FROM _recruitment_location GROUP BY name ASC" );
                        while($row = mysqli_fetch_array($query)){
                          $data = $row['name'];
                            echo '<option id="recruitmentLocation" name="recruitmentLocation" value="'.$data.'">'.$data.'</option>';
                        }
                            ?>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td class="bg-light">Current Employer:</td>
                  <td><input type="text" name="currentEmployer" value="<?php echo $candidate['current_employer']; ?>" style="width:100%;"></td>
                </tr>

                <tr>
                  <td class="bg-light">Expected Salary:</td>
                  <td><input type="text" name="expectedSalary" value="<?php echo $candidate['desired_pay']; ?>" style="width:100%;"></td>
                </tr>


                <tr>
                  <td class="bg-light">Time of Arrival:</td>
                  <td><input type="time" name="timeOfArrival" value="<?php echo $candidate['time_of_arrival']; ?>" style="width:100%;"></td>
                </tr>

                <tr>
                  <td class="bg-light">Attendance Status:</td>
                  <td>
                    <select id="attendanceStatus" name="attendanceStatus" style="width: 100%;" <?php if($userType == "Receptionist"){ echo "required";} ?>>
                    <option id="attendanceStatus" name="attendanceStatus" value="<?php echo $candidate['attendance_status']; ?>"><?php echo $candidate['attendance_status']; ?></option>
                    <option id="attendanceStatus" name="attendanceStatus" value="">-----</option>
                    <option id="attendanceStatus" name="attendanceStatus" value="Attended">Attended</option>
                    <option id="attendanceStatus" name="attendanceStatus" value="No Show Up">No Show Up</option>
                    </select>
                </td>
                </tr>

                <tr>
                  <td <?php echo $receptionistRequiredFields; ?> >Date Attended:</td>
                  <td><input type="date" name="dateAttended" value="<?php echo $candidate['date_attended']; ?>" style="width:100%;"  <?php echo $receptionistRequired; ?> <?php if($userType == "Receptionist"){ echo "required"; } ?>></td>
                </tr>

                <tr>
                  <td class="bg-light">Time of Interview:</td>
                  <td><input type="time" name="timeOfInterview" value="<?php echo $candidate['time_of_interview']; ?>" style="width:100%;"></td>
                </tr>

                <tr>
                  <td <?php echo $receptionistRequiredFields; ?> >Interviewed By:</td>
                  <td>
                    <select id="interviewedBy" name="interviewedBy" style="width:100%;"  <?php echo $receptionistRequired; ?>>
                    <option id="interviewedBy" name="interviewedBy" value="<?php echo $candidate['interviewed_by']; ?>"><?php echo $candidate['interviewed_by']; ?></option>
                    <option id="interviewedBy" name="interviewedBy" value="">-----</option>
                      <option id="interviewedBy" name="interviewedBy" value="N/A">N/A</option>
                    <?php
                        $query = mysqli_query( $dbc, "SELECT * FROM _staff WHERE position='Recruiter' GROUP BY first_name ASC" );
                        while($row = mysqli_fetch_array($query)){
                          $recruiter = $row['first_name']." ".$row['last_name'];
                            echo '<option id="interviewedBy" name="interviewedBy" value="'.$recruiter.'">'.$recruiter.'</option>';
                        }
                            ?>
                    </select>
                </td>
                </tr>

                <tr>
                  <td class="bg-light">Shuttle Status:</td>
                  <td>
                    <select id="shuttleStatus" name="shuttleStatus" style="width:100%;"  <?php echo $receptionistRequired; ?>>
                    <option id="shuttleStatus" name="shuttleStatus" value="<?php echo $candidate['shuttle_status']; ?>"><?php echo $candidate['shuttle_status']; ?></option>
                    <option id="shuttleStatus" name="shuttleStatus" value="N/A">-----</option>
                    <option id="shuttleStatus" name="shuttleStatus" value="Shuttled">Shuttled</option>
                    <option id="shuttleStatus" name="shuttleStatus" value="Direct">Direct</option>
                    <option id="shuttleStatus" name="shuttleStatus" value="Wasn't Shuttled">Wasn't Shuttled</option>
                  </select>
                  </td>
                </tr>

                <tr>
                  <td class="bg-light">Time of Shuttle:</td>
                  <td><input type="time" name="timeOfShuttle" value="<?php echo $candidate['time_of_shuttle']; ?>" style="width:100%;"></td>
                </tr>
              </tbody>
            </table>
          </div>



          <div class="col-lg-4" <?php echo $displayReceptionistExtraRow; ?>>

            <table class="table" style="border:1px #e0e0e0 solid; font-size:11px;">
              <tbody>

                <tr>
                  <td <?php echo $receptionistRequiredFields; ?> >Shuttled By (Promodiser):</td>
                  <td>
                    <select id="shuttledByPromodiser" name="shuttledByPromodiser" style="width:100%;"  <?php echo $receptionistRequired; ?>>
                    <option id="shuttledByPromodiser" name="shuttledByPromodiser" value="<?php echo $candidate['shuttled_by_promodiser']; ?>"><?php echo $candidate['shuttled_by_promodiser']; ?></option>
                    <option id="shuttledByPromodiser" name="shuttledByPromodiser" value="N/A">-----</option>
                    <option id="shuttledByPromodiser" name="shuttledByPromodiser" value="N/A">N/A</option>
                    <?php
                        $query = mysqli_query( $dbc, "SELECT * FROM _staff WHERE position='Promodiser' GROUP BY first_name ASC" );
                        while($row = mysqli_fetch_array($query)){
                          $shuttledByPromodiser = $row['first_name']." ".$row['last_name'];
                            echo '<option id="shuttledByPromodiser" name="shuttledByPromodiser" value="'.$shuttledByPromodiser.'">'.$shuttledByPromodiser.'</option>';
                        }
                            ?>
                    </select>
                </td>
                </tr>

                <tr>
                  <td <?php echo $receptionistRequiredFields; ?> >Shuttled By (Driver):</td>
                  <td>
                    <select id="shuttledByDriver" name="shuttledByDriver" style="width:100%;"  <?php echo $receptionistRequired; ?>>
                    <option id="shuttledByDriver" name="shuttledByDriver" value="<?php echo $candidate['shuttled_by_driver']; ?>"><?php echo $candidate['shuttled_by_driver']; ?></option>
                    <option id="shuttledByDriver" name="shuttledByDriver" value="N/A">-----</option>
                    <option id="shuttledByDriver" name="shuttledByDriver" value="N/A">N/A</option>
                    <?php
                        $query = mysqli_query( $dbc, "SELECT * FROM _staff WHERE position='Driver' GROUP BY first_name ASC" );
                        while($row = mysqli_fetch_array($query)){
                          $shuttledByDriver = $row['first_name']." ".$row['last_name'];
                            echo '<option id="shuttledByDriver" name="shuttledByDriver" value="'.$shuttledByDriver.'">'.$shuttledByDriver.'</option>';
                        }
                            ?>
                    </select>
                </td>
                </tr>

                <tr>
                  <td <?php echo $receptionistRequiredFields; ?>>BPO Experience:</td>
                  <td><select style="width:100%;" name="bpoExperience"  <?php echo $receptionistRequired; ?>>
                    <option name="bpoExperience" value="<?php echo $candidate['bpo_experience']; ?>"><?php echo $candidate['bpo_experience']; ?></option>
                    <option name="bpoExperience" value="">------</option>
                    <option name="bpoExperience" value="Fresher">Fresher</option>
                    <option name="bpoExperience" value="Lateral">Lateral</option>
                    <option name="bpoExperience" value="Less than 6 months">Less than 6 months</option>
                    <option name="bpoExperience" value="Less than 12 months">Less than 12 months</option>
                    <option name="bpoExperience" value="More than 1 year">More than 1 year</option>
                    <option name="bpoExperience" value="More than 2 years">More than 2 years</option>
                    <option name="bpoExperience" value="More than 3 years">More than 3 years</option>
                    <option name="bpoExperience" value="More than 4 years">More than 4 years</option>
                    <option name="bpoExperience" value="More than 5 years">More than 5 years</option>
                    <option name="bpoExperience" value="More than 6 years">More than 6 years</option>
                    <option name="bpoExperience" value="More than 7 years">More than 7 years</option>
                    <option name="bpoExperience" value="More than 8 years">More than 8 years</option>
                    <option name="bpoExperience" value="More than 9 years">More than 9 years</option>
                    <option name="bpoExperience" value="More than 10 years">More than 10 years</option>
                    <option name="bpoExperience" value="More than 11 years">More than 11 years</option>
                    <option name="bpoExperience" value="More than 12 years">More than 12 years</option>
                  </select></td>
                </tr>

                <tr>
                  <td <?php echo $receptionistRequiredFields; ?> >Endorsement Status:</td>
                  <td><select name="endorsementStatus" style="width:100%;"  <?php echo $receptionistRequired; ?>>
                    <option name="endorsementStatus" value="<?php echo $candidate['endorsement_status']; ?>"><?php echo $candidate['endorsement_status']; ?></option>
                    <option id="endorsementStatus" name="endorsementStatus" value="">-----</option>
                    <option name="endorsementStatus" value="Endorsed">Endorsed</option>
                    <option name="endorsementStatus" value="Wasn't Endorsed">Wasn't Endorsed</option>
                  </select></td>
                </tr>


                <tr>
                  <td <?php echo $receptionistRequiredFields; ?> >Endorsement History:</td>
                  <td>
                    <select id="firstEndorsement" name="firstEndorsement" style="width:100%;"  <?php echo $receptionistRequired; ?>>
                        <option id="firstEndorsement" name="firstEndorsement" value="<?php echo $candidate['first_endorsement']; ?>"><?php echo $candidate['first_endorsement']; ?></option>
                        <option id="firstEndorsement" name="firstEndorsement" value="">-----</option>
                        <option name="firstEndorsement" value="Not Qualified">Not Qualified</option>
                        <option name="firstEndorsement" value="Reschedule">Reschedule</option>
                        <option name="firstEndorsement" value="Qualified but applicant doesnt want to be endorsed">Qualified but applicant doesn't want to be endorsed</option>
                        <option name="firstEndorsement" value="Qualified but applicant has already applied to client">Qualified but applicant has already applied to client</option>
                        <option name="firstEndorsement" value="Fall Out">Fall Out</option>
                        <option name="firstEndorsement" value="Other Reason for No Endorsement">Other Reason for No Endorsement</option>
                        <?php
                            $query = mysqli_query( $dbc, "SELECT * FROM _partners ORDER BY name ASC" );
                            while($row = mysqli_fetch_array($query)){
                                echo '<option id="firstEndorsement" name="firstEndorsement" value="'.$row['name'].'">'.$row['name'].'</option>';
                            }
                        ?>
                        </select>
                </td>
                </tr>

                <tr>
                  <td <?php echo $receptionistRequiredFields; ?> >Other Endorsement:</td>
                  <td>
                    <select id="secondEndorsement" name="secondEndorsement" style="width:100%;"  <?php echo $receptionistRequired; ?>>
                        <option id="secondEndorsement" name="secondEndorsement" value="<?php echo $candidate['second_endorsement']; ?>"><?php echo $candidate['second_endorsement']; ?></option>
                        <option id="secondEndorsement" name="secondEndorsement" value="N/A">-----</option>
                        <option name="secondEndorsement" value="N/A">N/A</option>
                        <?php
                            $query = mysqli_query( $dbc, "SELECT * FROM _partners ORDER BY name ASC" );
                            while($row = mysqli_fetch_array($query)){
                                echo '<option id="secondEndorsement" name="secondEndorsement" value="'.$row['name'].'">'.$row['name'].'</option>';
                            }
                        ?>
                        </select>
                </td>
                </tr>

                <tr>
                  <td  <?php echo $receptionistRequiredFields; ?> >Other Endorsement:</td>
                  <td>
                    <select id="thirdEndorsement" name="thirdEndorsement" style="width:100%;"  <?php echo $receptionistRequired; ?>>
                    <option id="thirdEndorsement" name="thirdEndorsement" value="<?php echo $candidate['third_endorsement']; ?>"><?php echo $candidate['third_endorsement']; ?></option>
                    <option id="thirdEndorsement" name="thirdEndorsement" value="N/A">-----</option>
                    <option name="secondEndorsement" value="N/A">N/A</option>
                    <?php
                        $query = mysqli_query( $dbc, "SELECT * FROM _partners ORDER BY name ASC" );
                        while($row = mysqli_fetch_array($query)){
                            echo '<option id="thirdEndorsement" name="thirdEndorsement" value="'.$row['name'].'">'.$row['name'].'</option>';
                        }
                    ?>
                    </select>
                </td>
                </tr>



              </tbody>
            </table>

          </div>

        </div>


                <div <?php echo $displayRecruiterRow; ?>> <!-- Row for Recruiter -->

                  <div class="col-lg-4">

                    <table class="table" style="border:1px #e0e0e0 solid; font-size:11px;">
                      <tbody>

                        <tr>
                          <input type="hidden" name="candidateID" value="<?php echo $candidateID; ?>">
                        </tr>

                        <tr>
                          <td class="bg-light">Name:</td>
                          <td><?php echo $candidate['full_name']; ?></td>
                        </tr>

                        <tr>
                          <td class="bg-light">First Name:</td>
                          <td><?php echo $candidate['first_name']; ?></td>
                        </tr>

                        <tr>
                          <td class="bg-light">Middle Name:</td>
                          <td><?php echo $candidate['middle_name']; ?></td>
                        </tr>

                        <tr>
                          <td class="bg-light">Last Name:</td>
                          <td><?php echo $candidate['last_name']; ?></td>
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
                          <td <?php echo $recruiterRequiredFields; ?>>Application Status:</td>
                          <td>
                                <select id="applicationStatus" name="applicationStatus" style="width: 100%;" <?php echo $recruiterRequired; ?>>
                                    <option name="applicationStatus" value="<?php echo $candidate['application_status']; ?>"><?php echo $candidate['application_status']; ?></option>
                                    <option name="applicationStatus" value="">------</option>
                                    <option name="applicationStatus" value="Hired">Hired</option>
                                    <option name="applicationStatus" value="Not Hired">Not Hired</option>
                                    <option name="applicationStatus" value="No Response">No Response</option>
                                    <option name="applicationStatus" value="Pending">Pending</option>
                                </select>
                            </td>
                        </tr>

                        <tr id="hiredDate">
                          <td <?php echo $recruiterRequiredFields; ?>>Hired Date:</td>
                          <td><input type="date"  name="hiredDate" value="<?php echo $candidate['hired_date']; ?>" style="width:100%;" ></td>
                        </tr>

                        <tr style="display:none;">
                          <td class="bg-light">Date of Input:</td>
                          <td><input type="date" name="dateOfInput" value="<?php echo $candidate['date_of_input']; ?>" style="width:100%;"></td>
                        </tr>

                        <tr>
                          <td class="bg-light">Start Date:</td>
                          <td><input type="date" name="startDate" value="<?php echo $candidate['start_date']; ?>" style="width:100%;"</td>
                        </tr>



                        <tr id="hiringCompanyRow">
                          <td <?php echo $recruiterRequiredFields; ?>>Hiring Company:</td>
                          <td>
                            <select id="hiringCompany" name="hiringCompany" style="width:100%;" onchange="document.getElementById('pointAssignment').value = getPointAssignment(this.value);" <?php echo $recruiterRequired; ?> <?php echo $disabledIfReceptionist; echo $disabledIfFinance; ?> >
                                <option id="hiringCompany" name="hiringCompany" value="<?php echo $candidate['hiring_company']; ?>"><?php echo $candidate['hiring_company']; ?></option>
                                <option id="hiringCompany" name="hiringCompany" value="">-----</option>
                                <option id="hiringCompany" name="hiringCompany" value="N/A">N/A</option>
                                <?php
                                    $query = mysqli_query( $dbc, "SELECT * FROM _partners ORDER BY name ASC" );
                                    while($row = mysqli_fetch_array($query)){
                                        echo '<option id="hiringCompany" name="hiringCompany" value="'.$row['name'].'">'.$row['name'].'</option>';
                                    }
                                ?>
                            </select>
                        </td>
                        </tr>

                        <tr id="pointAssignmentRow">
                          <td class="bg-light">Point Assignment per Hire:</td>
                          <td><input type="text" id="pointAssignment" name="pointAssignment" value="<?php echo $candidate['point_assignment_per_hire']; ?>" style="width:100%;" readonly>
                          </td>
                        </tr>

                          <tr>
                            <td <?php echo $recruiterRequiredFields; ?>>Hiring Account:</td>
                            <td><input type="text" id="hiringAccount" name="hiringAccount" value="<?php echo $candidate['hiring_account']; ?>" style="width:100%;" <?php echo $recruiterRequired; ?>>
                            </td>
                          </tr>

                        <tr>
                            <td <?php echo $recruiterRequiredFields; ?>>Reason for Not Getting Hired:</td>
                            <td>
                            <input type="radio" id="reasonForNotGettingHired" name="reasonForNotGettingHired" value="Failed Ops Interview" <?php if ($candidate['reason_for_not_getting_hired'] == "Failed Ops Interview"){echo "checked"; } ?> />
                            Failed Ops Interview
                            <br>
                            <input type="radio" id="reasonForNotGettingHired" name="reasonForNotGettingHired" value="Failed Versant" <?php if ($candidate['reason_for_not_getting_hired'] == "Failed Versant"){echo "checked"; } ?>   />
                            Failed Versant
                            <br>
                            <input type="radio" id="reasonForNotGettingHired" name="reasonForNotGettingHired" value="Failed Behavioral Interview" <?php if ($candidate['reason_for_not_getting_hired'] == "Failed Behavioral Interview"){echo "checked"; } ?>   />
                            Failed Behavioral Interview
                            <br>
                            <input type="radio" id="reasonForNotGettingHired" name="reasonForNotGettingHired" value="Failed Final Interview" <?php if ($candidate['reason_for_not_getting_hired'] == "Failed Final Interview"){echo "checked"; } ?>   />
                            Failed Final Interview
                            <br>
                            <input type="radio" id="reasonForNotGettingHired" name="reasonForNotGettingHired" value="Failed Interview" <?php if ($candidate['reason_for_not_getting_hired'] == "Failed Interview"){echo "checked"; } ?>   />
                            Failed Interview
                            <br>
                            <input type="radio" id="reasonForNotGettingHired" name="reasonForNotGettingHired" value="Failed SVAR" <?php if ($candidate['reason_for_not_getting_hired'] == "Failed SVAR"){echo "checked"; } ?>   />
                            Failed SVAR
                            <br>
                            <input type="radio" id="reasonForNotGettingHired" name="reasonForNotGettingHired" value="Failed Exam" <?php if ($candidate['reason_for_not_getting_hired'] == "Failed Exam"){echo "checked"; } ?>   />
                            Failed Exam
                            <br>
                            <input type="radio" id="reasonForNotGettingHired" name="reasonForNotGettingHired" value="Failed Initial Interview" <?php if ($candidate['reason_for_not_getting_hired'] == "Failed Initial Interview"){echo "checked"; } ?>   />
                            Failed Initial Interview
                            <br>
                            <input type="radio" id="reasonForNotGettingHired" name="reasonForNotGettingHired" value="Failed APTIS" <?php if ($candidate['reason_for_not_getting_hired'] == "Failed APTIS"){echo "checked"; } ?>   />
                            Failed APTIS
                            <br>
                            <input type="radio" id="reasonForNotGettingHired" name="reasonForNotGettingHired" value="Others" <?php if ($candidate['reason_for_not_getting_hired'] == "Others"){echo "checked"; } ?>   />
                            Other Reasons ... Specify below on Other Remarks
                            <br>
                            </td>
                        </tr>

                        <tr>
                          <td class="bg-light">Call Status:</td>
                          <td>
                            <select name="callStatus" style="width:100%" >
                            <option name="callStatus" value="<?php echo $candidate['call_status']; ?>"><?php echo $candidate['call_status']; ?></option>
                            <option name="callStatus" value="">------</option>
                            <option name="callStatus" value="Currently Employed">Currently Employed</option>
                            <option name="callStatus" value="Hired by another BPO Company">Hired by another BPO Company</option>
                            <option name="callStatus" value="No Response">No Response</option>
                            <option name="callStatus" value="Responded">Responded</option>
                            <option name="callStatus" value="Cannot Be Reached">Cannot Be Reached</option>
                            </select>
                          </td>
                        </tr>

                        <tr >
                          <td class="bg-light">Confirmation Status:</td>
                          <td>
                            <select id="confirmationStatus2" name="confirmationStatus" style="width:100%" <?php if ($userType != "Recruiter"){ echo 'disabled'; } ?>>
                              <option name="confirmationStatus" value="<?php echo $candidate['confirmation_status']; ?>"><?php echo $candidate['confirmation_status']; ?></option>
                            <option name="confirmationStatus" value="">------</option>
                            <option name="confirmationStatus" value="Confirmed">Confirmed</option>
                            <option name="confirmationStatus" value="Rescheduled">Rescheduled</option>
                            <option name="confirmationStatus" value="Did Not Confirm">Did Not Confirm</option>
                            </select>
                          </td>
                        </tr>

                        <?php

                        if(!stristr($candidate['confirmation_status'], "confirm")){
                          $hideConfirmedDateOfInterview = 'style="display:none;"';
                        }
                        ?>


                        <tr id="confirmedDate2" <?php echo $hideConfirmedDateOfInterview; ?>>
                          <td class="bg-light">Confirmed Date of Interview:</td>
                          <td><input type="date" name="confirmedDate" value="<?php echo $candidate['confirmed_date_of_interview']; ?>" style="width:100%;" <?php if ($userType != "Recruiter"){ echo 'disabled'; } ?>></td>
                        </tr>

                        <tr>
                          <td <?php echo $recruiterRequiredFields; ?>>Recruiter's Remarks:</td>
                          <td><input type="text" name="recruiterRemarks" value="<?php echo $candidate['recruiter_remarks']; ?>" style="width:100%;" <?php echo $recruiterRequired; ?>></td>
                        </tr>


                      </tbody>
                    </table>

                  </div>
                </div>


                <div <?php echo $displayFinanceRow; ?>> <!-- Row for Finance -->

                  <div class="col-lg-6">

                    <table class="table" style="border:1px #e0e0e0 solid; font-size:11px;">
                      <tbody>

                        <tr>
                          <input type="hidden" name="candidateID" value="<?php echo $candidateID; ?>">
                        </tr>

                        <tr>
                          <td class="bg-light">Name:</td>
                          <td><?php echo $candidate['full_name']; ?></td>
                        </tr>

                        <tr>
                          <td class="bg-light">Processing Branch:</td>
                          <td><?php echo $candidate['processing_branch']; ?></td>
                        </tr>

                        <tr>
                          <td class="bg-light">Endorsement History:</td>
                          <td><?php echo $candidate['endorsement_history']; ?></td>
                        </tr>

                        <tr>
                          <td class="bg-light">Owner:</td>
                          <?php
                          $candidateOwner = $candidate['owner'];
                          $query5 = mysqli_query( $dbc, "SELECT * FROM user WHERE user_id='$candidateOwner'" );
                          $user2 = mysqli_fetch_array($query5);
                          $candidateOwnerName = $user2['first_name']." ".$user2['last_name'];
                           ?>
                          <td><?php echo $candidateOwnerName; ?></td>
                        </tr>

                        <tr>
                          <td class="bg-light">Recruiter:</td>
                          <td><?php echo $candidate['interviewed_by']; ?></td>
                        </tr>

                        <tr>
                          <td class="bg-light">Shuttled by (Driver):</td>
                          <td><?php echo $candidate['shuttled_by_driver']; ?></td>
                        </tr>

                        <tr>
                          <td class="bg-light">Shuttled by (Promodiser):</td>
                          <td><?php echo $candidate['shuttled_by_promodiser']; ?></td>
                        </tr>


                        <tr>
                          <td class="bg-light">Hiring Company:</td>
                          <td>
                            <select id="hiringCompany" name="hiringCompany" style="width:100%;" <?php echo $disabledIfReceptionist; echo $disabledIfRecruiter; ?>>
                                <option id="hiringCompany" name="hiringCompany" value="<?php echo $candidate['hiring_company']; ?>"><?php echo $candidate['hiring_company']; ?></option>
                                <option id="hiringCompany" name="hiringCompany" value="">-----</option>
                                <?php
                                    $query = mysqli_query( $dbc, "SELECT * FROM _partners" );
                                    while($row = mysqli_fetch_array($query)){
                                        echo '<option id="hiringCompany" name="hiringCompany" value="'.$row['name'].'">'.$row['name'].'</option>';
                                    }
                                ?>
                                </select>
                        </td>
                        </tr>


                        <tr>
                          <td class="bg-light">Billing Client:</td>
                          <td>
                            <select id="billingClient" name="billingClient" style="width:100%;" onchange="document.getElementById('correspondingPoint').value = getPoint(this.value);">
                            <option id="billingClient" name="billingClient" value="<?php echo $candidate['billing_client']; ?>"><?php echo $candidate['billing_client']; ?></option>
                            <option id="billingClient" name="billingClient" value="">-----</option>
                            <?php

                                $query = mysqli_query( $dbc, "SELECT * FROM _cpoints ORDER BY partner ASC" );
                                while($row = mysqli_fetch_array($query)){
                                    echo '<option id="billingClient"  name="billingClient" placeholder="'.$row['point'].'" value="'.$row['partner'].'">'.$row['partner'].'</option>';
                                }
                                    ?>
                                    </select>
                          </td>
                        </tr>

                        <tr>
                          <td class="bg-light">Corresponding Point:</td>
                          <td><input type="text" id="correspondingPoint" name="correspondingPoint" value="<?php echo $candidate['corresponding_point']; ?>" style="width:100%;">
                          </td>
                        </tr>

                        <tr>
                        <td class="bg-light">Billing Status 1 (Client):</td>
                        <td>
                        <select id="billingStatus" name="billingStatus" style="width:100%;">
                        <option id="billingClient" name="billingStatus" value="<?php echo $candidate['billing_status']; ?>"><?php echo $candidate['billing_status']; ?></option>
                        <option id="billingStatus" name="billingStatus" value="">-----</option>
                        <option id="billingStatus" name="billingStatus" value="Billed">Billed</option>
                        <option id="billingStatus" name="billingStatus" value="Not Yet Billed" <?php if( $candidate['billing_status']==null){echo "selected";} ?>>Not Yet Billed</option>
                        <option id="billingStatus" name="billingStatus" value="Cancelled Invoice">Cancelled Invoice</option>
                        </select>
                        </td>
                      </tr>

                      <tr>
                        <td class="bg-light">Date Client Billed the Applicant:</td>
                        <td>
                        <input type="date" id="billingDate" name="billingDate" value="<?php echo $candidate['billing_date']; ?>" style="width: 100%;">
                        </td>
                      </tr>

                      <tr>
                        <td class="bg-light">Billing Status 2 (Employee):</label></td>
                        <td>
                        <select id="billingStatus2" name="billingStatus2" style="width:100%;">
                        <option id="billingStatus2" name="billingStatus2" value="<?php echo $candidate['billing_status2']; ?>"><?php echo $candidate['billing_status2']; ?></option>
                        <option id="billingStatus2" name="billingStatus2" value="">-----</option>
                        <option id="billingStatus2" name="billingStatus2" value="Paid to Employee">Paid to Employee</option>
                        <option id="billingStatus2" name="billingStatus2" value="Not Yet Paid to Employee" <?php if( $candidate['billing_status2']==null){echo "selected";} ?>>Not Yet Paid to Employee</option>
                        </select>
                        </td>
                       </tr>

                       <tr>
                           <td class="bg-light">Date Paid to Employee:</td>
                           <td>
                          <input type="date" id="datePaid" name="datePaid" value="<?php echo $candidate['date_paid']; ?>" style="width: 100%;">
                           </td>
                       </tr>

                       <tr>
                         <td class="bg-light">Validation Status:</td>
                        <td>
                       <select id="validationStatus" name="validationStatus" style="width:100%;">
                       <option id="validationStatus" name="validationStatus" value="<?php echo $candidate['validation_status']; ?>"><?php echo $candidate['validation_status'];  ?></option>
                       <option id="validationStatus" name="validationStatus" value="">-----</option>
                       <option id="validationStatus" name="validationStatus" value="For Validation">For Validation</option>
                       <option id="validationStatus" name="validationStatus" value="Validated">Validated</option>
                       <option id="validationStatus" name="validationStatus" value="Not Yet Validated" <?php if( $candidate['validation_status']==null){echo "selected";} ?>>Not Yet Validated</option>
                       </select>
                      </td>
                      </tr>

                      <tr>
                          <td class="bg-light">Validation Date:</td>
                          <td>
                          <input type="date" id="validationDate" name="validationDate" value="<?php echo $candidate['validation_date']; ?>" style="width: 100%;">
                          </td>
                      </tr>

                      <tr>
                        <td class="bg-light">Finance Department's Remarks:</td>
                        <td><input type="text" name="financeRemarks" value="<?php echo $candidate['finance_remarks']; ?>" style="width:100%;"></td>
                      </tr>

                      <tr>
                        <td class="bg-light">For Replacement:</td>
                        <td><input type="checkbox" id="forReplacement" name="forReplacement" <?php if ($candidate['for_replacement'] == "127"){echo "checked";} ?> >
                        </td>
                      </tr>

                      <tr>
                          <td class="bg-light">Replaced By:</label></td>
                              <?php
                              if (isset($_GET['searchReplacedBy'])){
                                $display = "true";
                              }elseif($candidate['replaced_by']!= ""){
                                $display = "true";
                              }

                              if($display == "true"){
                              echo '<td><select name="replacedBy" id="replacedBy" style="width:100%;">';
                                  $y = $candidate['replaced_by'];
                                  $queryx = mysqli_query($dbc, "SELECT * FROM candidate WHERE candidate_id='$y'");
                                  $getFullName = mysqli_fetch_array($queryx);
                                  ?>
                                   <option id="replacedBy" name="replacedBy" value="<?php $candidate['replaced_by']; ?>">
                                       <?php echo $getFullName['full_name']; ?>
                                   </option>
                                  <option>---------</option>

                                   <?php
                                   if (isset($_GET['searchReplacedBy'])){
                                   $replace = $_GET['searchReplacedBy'];
                                   $query = mysqli_query($dbc, "SELECT * FROM candidate WHERE full_name LIKE '%".$replace."%' AND date_attended != '0000-00-00'");
                                   while($row = mysqli_fetch_array($query)){

                                  if ($row['date_attended'] == "0000-00-00"){
                                      $newDate = " N/A ";
                                  }else{
                                   $date = date_create($row['date_attended']);
                                   $newDate = date_format($date,"F d, o");
                                  }

                                  if ($row['endorsement_history'] == ""){
                                      $endorsementHistory = "N/A";
                                  }else{
                                      $endorsementHistory = $row['endorsement_history'];
                                  }


                                  $candidateDisplay = $row['full_name'].' - '.$newDate.' - '.$endorsementHistory;
                                      echo '<option id="replacedBy" name="replacedBy" value="'.$row['candidate_id'].'">'.$candidateDisplay.'</option>';
                                   }
                                   }


                              echo '</select></td>';
                            }else{
                              echo '<td>
                                <button type="button" class="btn btn-dark btn-flat btn-block btn-xs" data-toggle="modal" data-target="#searchCandidateReplacedBy">Search Candidate</button>
                              </td>';
                            }
                              ?>


                      </tr>

                      </tbody>
                    </table>

                  </div>
                </div>





        <?php
        $candidateID = $_GET['candidateID'];
        $backtoDetails = "module.php?m=candidates&a=show&candidateID=".$candidateID;
        ?>

        <div>
          <button form="mainForm" type="submit" class="btn btn-primary mb-3">Save</button>

          <a href="<?php echo $backtoDetails; ?>" class="btn btn-success mb-3">Back to Details</a>

        </div>
      </form>



      </div>


    </div>
  </div>



  </div>


  <div class="modal fade" id="searchCandidateReplacedBy" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                          <form action="module.php" method="GET">
                                            <input type="hidden" name="m" value="candidates">
                                            <input type="hidden" name="a" value="edit">
                                            <input type="hidden" name="candidateID" value="<?php echo $_GET['candidateID']; ?>">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Search Candidate Here</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                            </div>
                                            <div class="modal-body">
                                              <p>Type Name Here:</p>
                                              <input type="text" class="form-control" name="searchReplacedBy">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                          </form>
                                        </div>
                                    </div>
                                </div>



  <script>
function getPoint(x) {
 // alert(x);

   <?php
   $query = mysqli_query( $dbc, "SELECT * FROM _cpoints" );
   while($row = mysqli_fetch_array($query)){
       echo "if(x ==".'"'.$row['partner'].'"'."){"."return ".$row['point'].";}";
   }
   ?>



}

function getPointAssignment(x) {
 // alert(x);

   <?php
   $query = mysqli_query( $dbc, "SELECT * FROM _partners" );
   while($row = mysqli_fetch_array($query)){
        echo "if(x ==".'"'.$row['name'].'"'."){"."return ".$row['point'].";}";


   }
   ?>



}
 </script>
