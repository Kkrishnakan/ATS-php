<?php
include('data/db.php');
$userID = $_SESSION['user'];
$query = mysqli_query($dbc, "SELECT * FROM user WHERE user_id='$userID'");
$user = mysqli_fetch_array($query);
$userColumn = $user['column'];
$columnPreference = explode(" ",$userColumn);

//$default = array( '1' => 'full_name', '2'=> 'phone_cell', '3'=>'city', '4'=>'source', '5'=>'confirmation_status', '6'=>'confirmed_date_of_interview',
//'7'=>'shuttled_by_driver');
//print_r($columnPreference);

//$b = serialize($default);
//echo "<br>";
//print_r($b);
$count = count($columnPreference);

for($x = 0; $x <= $count; $x++){

  //echo "<br>".$x."<br>".$columnPreference[$x];

  if($columnPreference[$x] == "full_name"){
    $tableHeader[$x]   = "Full Name";
    }

  if($columnPreference[$x] == "phone_cell"){
      $tableHeader[$x] = "Mobile Number";
    }

  if($columnPreference[$x] == "email1"){
      $tableHeader[$x] = "Email";
    }

  if($columnPreference[$x] == "application_status"){
      $tableHeader[$x] = "Application Status";
    }

  if($columnPreference[$x] == "ad_applied_to"){
      $tableHeader[$x] = "Ad Applied To";
    }

  if($columnPreference[$x] == "owner"){
      $tableHeader[$x] = "Owner";
    }

  if($columnPreference[$x] == "processing_branch"){
      $tableHeader[$x] = "P. Branch";
    }

  if($columnPreference[$x] == "confirmation_status"){
      $tableHeader[$x] = "C. Status";
    }


  if($columnPreference[$x] == "confirmed_date_of_interview"){
      $tableHeader[$x] = "C. Date";
    }

  if($columnPreference[$x] == "assigned_date_of_interview"){
      $tableHeader[$x] = "A. Date";
    }

  if($columnPreference[$x] == "date_attended"){
      $tableHeader[$x] = "D. Attended";
    }

  if($columnPreference[$x] == "interviewed_by"){
      $tableHeader[$x] = "Interviewed By";
    }

  if($columnPreference[$x] == "receptionist"){
      $tableHeader[$x] = "Receptionist";
    }

  if($columnPreference[$x] == "shuttled_by_driver"){
      $tableHeader[$x] = "S. By Driver";
    }

  if($columnPreference[$x] == "shuttled_by_promodiser"){
      $tableHeader[$x] = "S. By Diser";
    }

  if($columnPreference[$x] == "endorsement_history"){
      $tableHeader[$x] = "Endorsement History";
    }

  if($columnPreference[$x] == "reason_for_not_getting_hired"){
      $tableHeader[$x] = "Reason for Not Getting Hired";
    }

  if($columnPreference[$x] == "shuttle_status"){
      $tableHeader[$x] = "Shuttle Status";
    }

  if($columnPreference[$x] == "validation_status"){
      $tableHeader[$x] = "Validation Status";
      }

  if($columnPreference[$x] == "city"){
      $tableHeader[$x] = "Location";
      }

  if($columnPreference[$x] == "billing_date"){
      $tableHeader[$x] = "Date Client Billed the Applicant";
      }

  if($columnPreference[$x] == "date_paid"){
      $tableHeader[$x] = "Date Paid to Employee";
      }

  if($columnPreference[$x] == "billing_client"){
      $tableHeader[$x] = "B. Client";
      }

  if($columnPreference[$x] == "validation_date"){
      $tableHeader[$x] = "V. Date";
      }

  if($columnPreference[$x] == "validation_status"){
      $tableHeader[$x] = "Validation Status";
      }

  if($columnPreference[$x] == "hired_date"){
      $tableHeader[$x] = "Hired Date";
      }

  if($columnPreference[$x] == "start_date"){
      $tableHeader[$x] = "Start Date";
      }

  if($columnPreference[$x] == "hiring_company"){
      $tableHeader[$x] = "Hiring Company";
      }

  if($columnPreference[$x] == "hiring_account"){
      $tableHeader[$x] = "Hiring Account";
      }

  if($columnPreference[$x] == "is_duplicate"){
      $tableHeader[$x] = "Is Duplicate";
      }

  if($columnPreference[$x] == "source"){
      $tableHeader[$x] = "Source";
    }


  if($columnPreference[$x] == "preferred_communication"){
      $tableHeader[$x] = "P. Communication";
    }

  if($columnPreference[$x] == "date_created"){
      $tableHeader[$x] = "Date Created";
    }

  if($columnPreference[$x] == "date_modified"){
      $tableHeader[$x] = "Date Modified";
    }

  if($columnPreference[$x] == "advertiser_remarks"){
      $tableHeader[$x] = "A. Remarks";
    }

  if($columnPreference[$x] == "call_status"){
      $tableHeader[$x] = "Call Status";
    }


  //echo "<br>".$tableHeader[$x]."<br>";

}


 ?>
