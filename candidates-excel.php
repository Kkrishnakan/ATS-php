
<?php
@mysql_set_charset($dbc,"utf8");
$criterion   = $user['criterion'];
$userType    = $user['user_type'];

if (isset($_GET['myCandidatesOnly'])){
  $criterion = "AND entered_by ='".$userID."'";
}

if($_GET['filters'] == "true"){
  $name               = $_GET['name'];
  $mobileNumber       = $_GET['mobileNumber'];
  $adAppliedTo        = $_GET['adAppliedTo'];
  $owner              = $_GET['owner'];
  $dateAttended       = $_GET['dateAttended'];
  $dateAttendedRange1 = $_GET['dateAttendedRange1'];
  $dateAttendedRange2 = $_GET['dateAttendedRange2'];
  $applicationStatus  = $_GET['applicationStatus'];
  $processingBranch   = $_GET['processingBranch'];
  $confirmationStatus = $_GET['confirmationStatus'];
  $confirmedDate      = $_GET['confirmedDate'];
  $confirmedDateRange1= $_GET['confirmedDateRange1'];
  $confirmedDateRange2= $_GET['confirmedDateRange2'];
  $assignedDate       = $_GET['assignedDate'];
  $assignedDateRange1 = $_GET['assignedDateRange1'];
  $assignedDateRange2 = $_GET['assignedDateRange2'];
  $interviewedBy      = $_GET['interviewedBy'];
  $receptionist       = $_GET['receptionist'];
  $shuttledByDriver   = $_GET['shuttledByDriver'];
  $shuttledByPromodiser= $_GET['shuttledByPromodiser'];
  $endorsementHistory = $_GET['endorsementHistory'];
  $shuttleStatus      = $_GET['shuttleStatus'];
  $location           = $_GET['location'];
  $billingStatus1     = $_GET['billingStatus1'];
  $dateClientBilled   = $_GET['dateClientBilled'];
  $billingStatus2     = $_GET['billingStatus2'];
  $datePaid           = $_GET['datePaid'];
  $billingClient      = $_GET['billingClient'];
  $validationDate     = $_GET['validationDate'];
  $validationDateRange1= $_GET['validationDateRange1'];
  $validationDateRange2= $_GET['validationDateRange2'];
  $validationStatus   = $_GET['validationStatus'];
  $hiredDate          = $_GET['hiredDate'];
  $startDate          = $_GET['startDate'];
  $hiringCompany      = $_GET['hiringCompany'];
  $hiringAccount      = $_GET['hiringAccount'];
  $isDuplicate        = $_GET['isDuplicate'];
  $bpoExperience      = $_GET['bpoExperience'];
  $source             = $_GET['source'];
  $dateCreated        = $_GET['dateCreated'];
  $dateModified       = $_GET['dateModified'];
  $callStatus         = $_GET['callStatus'];
  $attendanceStatus   = $_GET['attendanceStatus'];
  $withDateAttended   = $_GET['withDateAttended'];
    $qString = "";

  if($name != ""){ $qString .= " AND full_name LIKE'%$name%'"; }
  if($mobileNumber != ""){ $qString .= " AND phone_cell='$mobileNumber'"; }
  if($adAppliedTo != ""){ $qString .= " AND ad_applied_to LIKE '%$adAppliedTo%'"; }
  if($owner != ""){ $qString .= " AND owner='$owner'"; }

  if($withDateAttended == "None"){
    $qString .= " AND date_attended='00-00-0000'";
  }else{
    if($dateAttended != ""){ $qString .= " AND date_attended='$dateAttended'"; }
  }


  if($dateAttendedRange1 != ""){ $qString .= " AND date_attended BETWEEN '$dateAttendedRange1' AND '$dateAttendedRange2'"; }
  if($applicationStatus != ""){ $qString .= " AND application_status='$applicationStatus'"; }
  if($processingBranch != ""){ $qString .= " AND processing_branch LIKE '%$processingBranch%'"; }
  if($confirmationStatus != ""){ $qString .= " AND confirmation_status LIKE '%$confirmationStatus%'"; }
  if($confirmedDate != ""){ $qString .= " AND confirmed_date_of_interview='$confirmedDate'"; }
  if($confirmedDateRange1 != ""){ $qString .= " AND confirmed_date_of_interview BETWEEN '$confirmedDateRange1' AND '$confirmedDateRange2'"; }
  if($assignedDate != ""){ $qString .= " AND assigned_date_of_interview='$assignedDate'"; }
  if($assignedDateRange1 != ""){ $qString .= " AND assigned_date_of_interview BETWEEN '$assignedDateRange1' AND '$assignedDateRange2'"; }
  if($interviewedBy != ""){ $qString .= " AND interviewed_by='$interviewedBy'"; }
  if($receptionist != ""){ $qString .= " AND receptionist='$receptionist'"; }
  if($shuttledByDriver != ""){ $qString .= " AND shuttled_by_driver='$shuttledByDriver'"; }
  if($shuttledByPromodiser != ""){ $qString .= " AND shuttled_by_promodiser='$shuttledByPromodiser'"; }
  if($endorsementHistory != ""){ $qString .= " AND endorsement_history LIKE '%$endorsementHistory%'"; }
  if($shuttleStatus != ""){ $qString .= " AND shuttle_status='$shuttleStatus'"; }
  if($location != ""){ $qString .= " AND city='$location'"; }
  if($billingStatus1 != ""){ $qString .= " AND billing_status='$billingStatus1'"; }
  if($dateClientBilled != ""){ $qString .= " AND billing_date='$dateClientBilled'"; }
  if($billingStatus2 != ""){ $qString .= " AND billing_status2='$billingStatus2'"; }
  if($datePaid != ""){ $qString .= " AND date_paid='$datePaid'"; }
  if($billingClient != ""){ $qString .= " AND billing_client='$billingClient'"; }
  if($validationDate != ""){ $qString .= " AND validation_date='$validationDate'"; }
  if($validationDateRange1 != ""){ $qString .= " AND validation_date BETWEEN '$validationDateRange1' AND '$validationDateRange2'"; }
  if($validationStatus != ""){ $qString .= " AND validation_status='$validationStatus'"; }
  if($hiredDate != ""){ $qString .= " AND hired_date='$hiredDate'"; }
  if($startDate != ""){ $qString .= " AND start_date='$startDate'"; }
  if($hiringCompany != ""){ $qString .= " AND hiring_company='$hiringCompany'"; }
  if($hiringAccount != ""){ $qString .= " AND hiring_account='$hiringAccount'"; }
  if($isDuplicate != ""){ $qString .= " AND is_duplicate='$isDuplicate'"; }
  if($bpoExperience != ""){ $qString .= " AND bpo_experience='$bpoExperience'"; }
  if($source != ""){ $qString .= " AND source='$source'"; }
  if($dateCreated != ""){ $qString .= " AND date_created='$dateCreated'"; }
  if($dateModified != ""){ $qString .= " AND date_modified='$dateModified'"; }
  if($callStatus != ""){ $qString .= " AND call_status='$callStatus'"; }
  if($attendanceStatus != ""){ $qString .= " AND attendance_status='$attendanceStatus'"; }
  //echo "QString: ".$qString."<br>";

  //echo "Display with filters!";
  if (isset($_GET['myCandidatesOnly'])){
    $criterion = "AND owner ='".$userID."'";
  }


  $sql = "SELECT * FROM candidate WHERE candidate_id != '' $qString $criterion ORDER BY first_name ASC LIMIT ".$rowDisplay;

  $counterSql =  "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE candidate_id != '' $qString ".$criterion;

    $counter = mysql_query($counterSql);
    $num = mysql_fetch_array($counter);
    $leadCount = $num["id"];
    if ($num["id"] == NULL){
      $leadCount = 0;
    }

  //echo "<br> Complete SQL statement: ".$sql;
}else{
$counter = mysql_query("SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE full_name != '' $criterion");
$num = mysql_fetch_array($counter);
$leadCount = $num["id"];
if ($num["id"] == NULL){
  $leadCount = 0;
}


}


if(isset($_GET['page'])){
  $displayPage = '<i class="ti-arrow-circle-right"></i>'." Page ".$_GET['page']." (".$leadCount." leads)";

}else{
  $displayPage = '<i class="ti-arrow-circle-right"></i>'." Page 1 (".$leadCount." leads)";
}
@mysql_query ("set character_set_results='utf8'");
?>


<div class="col-lg-12 mt-2">
  <div class="card">
    <div class="card-body">
      <h4 class="header-title">Candidates: HOME <small><?php echo $displayPage; ?></small></h4>
      <div class="pull-right">
        <div class="btn-group col-lg-4 col-md-6" role="group" aria-label="Button group with nested dropdown">
          <?php
          if(isset($_GET['myCandidatesOnly'])){
            $myCandidatesOnlyClass = 'class="btn btn-primary active"';
            $newLink = "module.php?m=candidates&a=home";
          }else{
            $myCandidatesOnlyClass = 'class="btn btn-primary"';
            $newLink = "module.php?m=candidates&a=home&myCandidatesOnly=true";
          }
           ?>
          <a href="<?php echo $newLink; ?>" <?php echo $myCandidatesOnlyClass; ?>>Show Only My Candidates</a>
        <div class="btn-group" role="group">
        <button id="columnBtnGroup" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Columns <span class="badge badge-light"></span></button>
        <div class="dropdown-menu" aria-labelledby="columnBtnGroup">

          <?php
          include('columns.php');
          $columnPreference = explode(" ",$userColumn);
          $countOfTableHeader = count($tableHeader);
          $countOfColumnPreference = count($columnPreference);

          //print_r($columnPreference);

          include('columnpreferences.php');


           ?>

        </div>
        </div>

        <button id="btnFilter" type="button" class="btn btn-primary">Filter</button>

        <div class="btn-group" role="group">
        <button id="rowsPerPageBtnGroup" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Rows Per Page <span class="badge badge-light"><?php echo $user['rows_per_page']; ?></span></button>
        <div class="dropdown-menu" aria-labelledby="rowsPerPageBtnGroup">
        <a class="dropdown-item" href="data/updaterowsperpage.php?r=15">15</a>
        <a class="dropdown-item" href="data/updaterowsperpage.php?r=50">50</a>
        <a class="dropdown-item" href="data/updaterowsperpage.php?r=100">100</a>
        <a class="dropdown-item" href="data/updaterowsperpage.php?r=1000">1000</a>
        </div>
        </div>

      </div>
      </div>

    </div>
  </div>
</div>


<?php
if(isset($_GET['filters'])){
  $filterRowDisplay = 'style="display:block;"';
}else{
  $filterRowDisplay = 'style="display:none;"';
}
?>

<div id="filterRow" class="col-lg-12 mt-2" <?php echo $filterRowDisplay; ?>>
  <div class="card">
    <div class="card-body">
        <form id="filtersForm" class="filterForm" name="filtersForm" method="GET">
          <div class="form-row align-items-center">
              <input type="hidden" name="m" value="candidates">
              <input type="hidden" name="a" value="home">
              <input type="hidden" name="filters" value="true">
              <?php
              if (isset($_GET['myCandidatesOnly'])){
                echo '<input type="hidden" name="myCandidatesOnly" value="true">';
              }
               ?>


            <?php include('filters.php'); ?>

          </div>

          <br>
          <div class="col-lg-12">
            <div class="btn-group pull-right" role="group" aria-label="Button group with nested dropdown">
              <a href="module.php?m=candidates&a=home" id="btnFilter" class="btn btn-light">Clear Filters</a>
              <div class="btn-group" role="group">
              <button id="columnBtnGroup" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Add Filters <span class="badge badge-light"></span></button>
              <div class="dropdown-menu" aria-labelledby="columnBtnGroup">
              <button type="button" id="nameFilterBtn" class="dropdown-item" href="#">Name</button>
              <button type="button" id="mobileNumberFilterBtn" class="dropdown-item" href="#">Mobile Number</button>
              <button type="button" id="applicationStatusFilterBtn" class="dropdown-item" href="#">Application Status</button>
              <button type="button" id="adAppliedToFilterBtn" class="dropdown-item" href="#">Ad Applied To</button>
              <button type="button" id="ownerFilterBtn" class="dropdown-item" href="#">Owner</button>
              <button type="button" id="processingBranchFilterBtn" class="dropdown-item" href="#">Processing Branch</button>
              <button type="button" id="confirmationStatusFilterBtn" class="dropdown-item" href="#">Confirmation Status</button>
              <button type="button" id="confirmedDateFilterBtn" class="dropdown-item" href="#">Confirmed Date</button>
              <button type="button" id="confirmedDateRangeFilterBtn" class="dropdown-item" href="#">Confirmed Date (Range)</button>
              <button type="button" id="assignedDateFilterBtn" class="dropdown-item" href="#">Assigned Date of Interview</button>
              <button type="button" id="assignedDateRangeFilterBtn" class="dropdown-item" href="#">Assigned Date of Interview (Range)</button>
              <button type="button" id="dateAttendedFilterBtn" class="dropdown-item" href="#">Date Attended</button>
              <button type="button" id="dateAttendedRangeFilterBtn" class="dropdown-item" href="#">Date Attended (Range)</button>
              <button type="button" id="interviewedByFilterBtn" class="dropdown-item" href="#">Interviewed By</button>
              <button type="button" id="receptionistFilterBtn" class="dropdown-item" href="#">Receptionist</button>
              <button type="button" id="shuttledByDriverFilterBtn" class="dropdown-item" href="#">Shuttled By (Driver)</button>
              <button type="button" id="shuttledByPromodiserFilterBtn" class="dropdown-item" href="#">Shuttled By (Promodiser)</button>
              <button type="button" id="endorsementHistoryFilterBtn" class="dropdown-item" href="#">Endorsement History</button>
              <button type="button" id="shuttleStatusFilterBtn" class="dropdown-item" href="#">Shuttle Status</button>
              <button type="button" id="locationFilterBtn" class="dropdown-item" href="#">Location</button>
              <button type="button" id="billingStatus1FilterBtn" class="dropdown-item" href="#">Billing Status 1: (Client)</button>
              <button type="button" id="dateClientBilledFilterBtn" class="dropdown-item" href="#">Date Client Billed the Applicant</button>
              <button type="button" id="billingStatus2FilterBtn" class="dropdown-item" href="#">Billing Status 2: (Employee)</button>
              <button type="button" id="datePaidFilterBtn" class="dropdown-item" href="#">Date Paid to Employee</button>
              <button type="button" id="billingClientFilterBtn" class="dropdown-item" href="#">Billing Client</button>
              <button type="button" id="validationDateFilterBtn" class="dropdown-item" href="#">Validation Date</button>
              <button type="button" id="validationDateRangeFilterBtn" class="dropdown-item" href="#">Validation Date (Range)</button>
              <button type="button" id="validationStatusFilterBtn" class="dropdown-item" href="#">Validation Status</button>
              <button type="button" id="hiredDateFilterBtn" class="dropdown-item" href="#">Hired Date</button>
              <button type="button" id="startDateFilterBtn" class="dropdown-item" href="#">Start Date</button>
              <button type="button" id="hiringCompanyFilterBtn" class="dropdown-item" href="#">Hiring Company</button>
              <button type="button" id="hiringAccountFilterBtn" class="dropdown-item" href="#">Hiring Account</button>
              <button type="button" id="bpoExperienceFilterBtn" class="dropdown-item" href="#">BPO Experience</button>
              <button type="button" id="isDuplicateFilterBtn" class="dropdown-item" href="#">Is Duplicate</button>
              <button type="button" id="callStatusFilterBtn" class="dropdown-item" href="#">Call Status</button>
              <button type="button" id="attendanceStatusFilterBtn" class="dropdown-item" href="#">Attendance Status</button>
              <button type="button" id="sourceFilterBtn" class="dropdown-item" href="#">Source</button>
              <button type="button" id="dateCreatedFilterBtn" class="dropdown-item" href="#">Date Created</button>
              <button type="button" id="dateModifiedFilterBtn" class="dropdown-item" href="#">Date Modified</button>

              </div>
              </div>
            <button type="submit" id="btnFilter" type="button" class="btn btn-primary">Apply Filter</button>



          </div>
          </div>
</form>




    </div>
  </div>
</div>


<div class="col-lg-12 mt-2">
<div class="card">
<div class="card-body">
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark" style="font-size:11px;">
                                            <thead class="text-uppercase bg-primary">
                                                <tr class="table-active text-white">

                                            <?php
                                            include('columns.php');
                                            $columnPreference = explode(" ",$userColumn);
                                            $countOfTableHeader = count($tableHeader);
                                            $countOfColumnPreference = count($columnPreference);

                                            ?>


                                    <?php

                                    $sort = $user['sort_by'];
                                    $sortWith = $user['sort_with'];

                                      for($x = 0; $x <= $countOfTableHeader; $x++){

                                        if($columnPreference[$x] == $sort){
                                          //echo '<th scope="col"><a href="data/changesortby.php?sortby='.$columnPreference[$x].'" style="color:white;">'.$tableHeader[$x].'</a></th>';
                                          echo '<th scope="col">'.$tableHeader[$x].'</th>';
                                        }else{
                                        //  echo '<th scope="col"><a href="data/changesortby.php?sortby='.$columnPreference[$x].'" style="color:white;">'.$tableHeader[$x].'</a></th>';
                                          echo '<th scope="col">'.$tableHeader[$x].'</th>';
                                        }


                                      }
                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>

                                              <?php
                                              include('data/db.php');
                                              $userID      = $_SESSION['user'];
                                              $criterion   = $user['criterion'];
                                              $rowsPerPage = $user['rows_per_page'];
                                              $rowDisplay = $rowsPerPage;

                                              if($userType == "Recruiter"){
                                              $criterion .= " OR (call_status LIKE '%call%' AND processing_branch LIKE '%".$user['company']."%') ";
                                              }
                                              $totalPages = round($leadCount/$rowsPerPage);


                                              if(isset($_GET['page'])){
                                              $page = $_GET['page'];

                                              for($x = 2; $x <= $totalPages; $x++){
                                                  $y = $x - 1;
                                                if($page == $x){
                                                  $compute = $rowsPerPage * $y;
                                                  $rowDisplay = $compute.", ".$rowsPerPage;
                                                }
                                              }
                                              }else{
                                                $rowDisplay = $rowsPerPage;
                                              }


                                              $x = 0;

                                              if($_GET['filters'] == "true"){

                                                //echo "QString: ".$qString."<br>";

                                                //echo "Display with filters!";
                                                if (isset($_GET['myCandidatesOnly'])){
                                                  $criterion = "AND owner ='".$userID."'";
                                                }


                                                $sql = "SELECT * FROM candidate WHERE candidate_id != '' $qString $criterion ORDER BY candidate_id DESC LIMIT ".$rowDisplay;
                                                $currentSQLExportAll = "SELECT date_attended, full_name, last_name, first_name,
                                                                  phone_cell, email1, bpo_experience, source,
                                                                  ad_applied_to, owner, interviewed_by, endorsement_history,
                                                                  shuttled_by_driver, shuttled_by_promodiser,
                                                                  processing_branch, hiring_company, hired_date,
                                                                  start_date, hiring_account, attendance_status,
                                                                  application_status, confirmed_date_of_interview,
                                                                  date_of_input, recruitment_type,
                                                                  recruitment_location, assigned_date_of_interview,
                                                                  replied_to, city
                                                                  FROM candidate WHERE candidate_id != '' $qString $criterion ORDER BY first_name $sortWith";
                                                $counterSql =  "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE candidate_id != '' $qString ".$criterion;

                                                  $counter = mysql_query($counterSql);
                                                  $num = mysql_fetch_array($counter);
                                                  $filterLeadCount = $num["id"];
                                                  if ($num["id"] == NULL){
                                                    $filterLeadCount = 0;
                                                  }

                                                //echo "<br> Complete SQL statement: ".$sql;
                                              }else{
                                                if (isset($_GET['myCandidatesOnly'])){
                                                  $criterion = "AND entered_by ='".$userID."'";
                                                }




                                                $sql = "SELECT * FROM candidate WHERE candidate_id != '' ".$criterion." ORDER BY candidate_id DESC "." LIMIT ".$rowDisplay;
                                                $currentSQLExportAll = "SELECT date_attended, full_name, last_name, first_name,
                                                                  phone_cell, email1, bpo_experience, source,
                                                                  ad_applied_to, owner, interviewed_by, endorsement_history,
                                                                  shuttled_by_driver, shuttled_by_promodiser,
                                                                  processing_branch, hiring_company, hired_date,
                                                                  start_date, hiring_account, attendance_status,
                                                                  application_status, confirmed_date_of_interview,
                                                                  date_of_input, recruitment_type,
                                                                  recruitment_location, assigned_date_of_interview,
                                                                  replied_to, city
                                                                  FROM candidate WHERE candidate_id != '' ".$criterion." ORDER BY candidate_id DESC ";
                                                }
                                                //echo $criterion;
                                              //echo "<br>".$sql;
                                              $query = mysql_query( $sql );

                                              function changeDateFormatWithTime($toChange){
                                                if($toChange == "0000-00-00"){
                                                  $newDate = " ";
                                                }elseif($toChange == ""){
                                                  $newDate = " ";
                                                }else{
                                                      $date = date_create($toChange);
                                                      $newDate = date_format($date,"M. d, o");
                                                    }
                                                      return $newDate;
                                                      }
                                            //  echo "SQL: ".$sql;

                                              echo '<form id="actionForm" action="data/exportcandidates.php" method="POST">';

                                              if (isset($_GET['myCandidatesOnly'])){
                                                echo '<input type="hidden" name="myCandidatesOnly" value="true">';
                                              }

                                              echo '<input type="hidden" name="currentSQL" value="'.$currentSQLExportAll.'">';
                                                //echo $criterion;
                                                //echo "<br>".$counterSql."<br>";
                                                //echo "Filter Lead Count: ".$filterLeadCount;

                                              echo '<form action="data/test.php">';
                                              while($candidate = mysql_fetch_array($query)){
                                                @mysql_set_charset($dbc,"utf8");
                                                if($x % 2 == 0){
                                                  echo '<tr>';
                                                }else{
                                                    echo '<tr class="table-light">';
                                                }
                                                $x++;



                                                for($x = 0; $x <= $countOfColumnPreference; $x++){
                                                  $string = $columnPreference[$x];

                                                  if($string == "owner"){
                                                    $ownerID = $candidate[$string];
                                                    $getUser = "SELECT first_name, last_name FROM user WHERE user_id='$ownerID'";
                                                    $rr = mysql_query( $getUser );
                                                    $user = mysql_fetch_array($rr);
                                                    $qString = $user['first_name']." ".substr($user['last_name'], 0, 1).".";
                                                  }elseif($string == "date_created"){
                                                    $newDate = $candidate[$string];
                                                    $qString = changeDateFormatWithTime($newDate);
                                                  }elseif($string == "date_modified"){
                                                    $newDate = $candidate[$string];
                                                    $qString = changeDateFormatWithTime($newDate);
                                                  }elseif($string == "assigned_date_of_interview"){
                                                    $newDate = $candidate[$string];
                                                    $qString = changeDateFormatWithTime($newDate);
                                                  }elseif($string == "confirmed_date_of_interview"){
                                                    $newDate = $candidate[$string];
                                                    $qString = changeDateFormatWithTime($newDate);
                                                  }elseif($string == "full_name"){
                                                    $qString = $candidate['last_name'].", ".$candidate['first_name'];
                                                  }else{
                                                    $qString = substr($candidate[$string], 0, 20);
                                                  }


                                                  if($x <= 0){
                                                  echo '<td>
                                                  <input type="checkbox" name="candidateid[]" value="'.$candidate['candidate_id'].'" style="width:10px;">
                                                  <span style="padding:5px;"></span>
                                                  <a href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">'.$qString.'</a></td>';
                                                }else{
                                                  echo '<td><input type="text" value="'.$qString.'"></td>';
                                                }
                                                }
                                                //echo '<td><a href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">'.$candidate['full_name'].'</a></td>';
                                                //echo '<td><a href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">'.substr($candidate['phone_cell'],0,13).'</a></td>';
                                                //echo '<td>'.substr($candidate['city'],0,15).'</td>';
                                                //echo '<td>'.$candidate['source'].'</td>';
                                                //echo '<td>'.$candidate['confirmation_status'].'</td>';
                                                //echo '<td>'.$candidate['confirmed_date_of_interview'].'</td>';
                                                echo '<td>';
                                                echo '<button type="submit" class="btn btn-primary">Save</button>';

                                                echo '</td>';
                                                echo '</tr>';
                                              }

                                              echo '</form>';

                                              echo '<tr>';
                                              echo '<td><input type="checkbox" onclick="toggle(this);">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" style="background: transparent; border:0px; color:black;">
                                                        Action
                                                        </button>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                                    <button type="submit" class="dropdown-item"  formaction="data/exportcandidates.php" onclick="toExport()">Export</button>
                                                    <button type="submit" class="dropdown-item"  formaction="data/exportallcandidates.php" onclick="toExportAll()">Export All</button>';
                                                if(($userType == Advertiser) OR ($userType == "Team Leader") OR ($userType == "Senior Team Leader") OR ($userType == "Sourcing Admin")){
                                                  echo  '<button class="deleteCandidate dropdown-item" formaction="data/deletecandidates.php" onclick="toConfirm()">Delete</button>';
                                                  }
                                              echo '</div></td>';

                                                for($x = 2; $x <= $countOfColumnPreference; $x++){
                                                  echo '<td></td>';
                                                }

                                              echo '</tr>';
                                              echo '</form>';
                                               ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="pull-left">


                                </div>

                                <div class="pull-right">
                                        <form method="GET">
                                          <?php
                                          if (isset($_GET['myCandidatesOnly'])){
                                            echo '<input type="hidden" name="myCandidatesOnly" value="true">';
                                          }
                                           ?>
                                          <input type="hidden" name="m" value="candidates">
                                          <input type="hidden" name="a" value="home">
                                            <div class="form-row align-items-center">
                                              <div class="col-sm-2 my-1">
                                                  <p class="pull-right">Page</p>
                                              </div>
                                                <div class="col-sm-2 my-1">
                                                  <?php
                                                  if(isset($_GET['page'])){
                                                  $currentPage = $_GET['page'];
                                                }else{
                                                  $currentPage = 1;
                                                }
                                                   ?>
                                                    <input type="text" class="form-control" id="inlineFormInputName" value="<?php echo $currentPage; ?>" name="page">
                                                </div>

                                                <div class="col-sm-3 my-1">
                                                    <p>of <?php echo $totalPages; ?></p>
                                                </div>

                                                <div class="col-sm-2 my-1">
                                                    <button type="submit" class="btn btn-primary" formaction="module.php?m=candidates&a=home">Go</button>
                                                </div>
                                            </div>
                                        </form>
                                </div>
                            </div>
</div>
</div>
<script>
var myForm = document.getElementById('filtersForm');

myForm.addEventListener('submit', function () {
    var allInputs = myForm.getElementsByTagName('input');

    for (var i = 0; i < allInputs.length; i++) {
        var input = allInputs[i];

        if (input.name && !input.value) {
            input.name = '';
        }
    }
});
</script>

<?php include('candidatescripts.js'); ?>





<script>
  function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}

</script>

<script type="text/javascript">
  function toConfirm(){
  //confirm("Press a button!");
  if( !confirm("Do you want to delete selected candidates?") ){
  $("#actionForm").submit(function(){
    return false;
  });
  }
  }

  function toExport(){
  //confirm("Press a button!");
  if( !confirm("Do you want to export?") ){
  $("#actionForm").submit(function(){
    return false;
  });
  }
  }

    function toExportAll(){
    //confirm("Press a button!");
    if( !confirm("Do you want to export all candidates?") ){
    $("#actionForm").submit(function(){
      return false;
    });
    }
    }
</script>
