<?php
if (in_array("confirmation_status", $columnPreference)){
 echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=confirmation_status"><input type="checkbox" checked> Confirmation Status</a>';
}else{
 echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=confirmation_status"><input type="checkbox"> Confirmation Status</a>';}

if (in_array("email1", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=email1"><input type="checkbox" checked> Email</a>';
 }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=email1"><input type="checkbox"> Email</a>';}

if (in_array("application_status", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=application_status"><input type="checkbox" checked> Application Status</a>';
}else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=application_status"><input type="checkbox"> Application Status</a>';}

if (in_array("ad_applied_to", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=ad_applied_to"><input type="checkbox" checked> Ad Applied To</a>';
}else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=ad_applied_to"><input type="checkbox"> Ad Applied To</a>';}

if (in_array("owner", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=owner"><input type="checkbox" checked> Owner</a>';
}else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=owner"><input type="checkbox"> Owner</a>';}

if (in_array("processing_branch", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=processing_branch"><input type="checkbox" checked> Processing Branch</a>';
}else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=processing_branch"><input type="checkbox"> Processing Branch</a>';}

if (in_array("confirmed_date_of_interview", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=confirmed_date_of_interview"><input type="checkbox" checked> Confirmed Date</a>';
}else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=confirmed_date_of_interview"><input type="checkbox"> Confirmed Date</a>';}

if (in_array("assigned_date_of_interview", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=assigned_date_of_interview"><input type="checkbox" checked> Assigned Date</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=assigned_date_of_interview"><input type="checkbox"> Assigned Date</a>';}

if (in_array("date_attended", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=date_attended"><input type="checkbox" checked> Date Attended</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=date_attended"><input type="checkbox"> Date Attended</a>';}

if (in_array("interviewed_by", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=interviewed_by"><input type="checkbox" checked> Interviewed By</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=interviewed_by"><input type="checkbox"> Interviewed By</a>';}

if (in_array("receptionist", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=receptionist"><input type="checkbox" checked> Receptionist</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=receptionist"><input type="checkbox"> Receptionist</a>';}

if (in_array("shuttled_by_driver", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=shuttled_by_driver"><input type="checkbox" checked> Shuttled By Driver</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=shuttled_by_driver"><input type="checkbox"> Shuttled By Driver</a>';}

if (in_array("shuttled_by_promodiser", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=shuttled_by_promodiser"><input type="checkbox" checked> Shuttled By Promodiser</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=shuttled_by_promodiser"><input type="checkbox"> Shuttled By Promodiser</a>';}

if (in_array("endorsement_history", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=endorsement_history"><input type="checkbox" checked> Endorsement History</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=endorsement_history"><input type="checkbox"> Endorsement History</a>';}

if (in_array("shuttle_status", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=shuttle_status"><input type="checkbox" checked> Shuttle Status</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=shuttle_status"><input type="checkbox"> Shuttle Status</a>';}

if (in_array("city", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=city"><input type="checkbox" checked> Location</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=city"><input type="checkbox"> Location</a>';}

if (in_array("billing_date", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=billing_date"><input type="checkbox" checked> Date Client Billed the Applicant</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=billing_date"><input type="checkbox"> Date Client Billed the Applicant</a>';}

if (in_array("date_paid", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=date_paid"><input type="checkbox" checked> Date Paid to Employee</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=date_paid"><input type="checkbox"> Date Paid to Employee</a>';}


if (in_array("billing_client", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=billing_client"><input type="checkbox" checked> Billing Client</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=billing_client"><input type="checkbox"> Billing Client</a>';}

if (in_array("validation_date", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=validation_date"><input type="checkbox" checked> Validation Date</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=validation_date"><input type="checkbox"> Validation Date</a>';}

if (in_array("validation_status", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=validation_status"><input type="checkbox" checked> Validation Status</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=validation_status"><input type="checkbox"> Validation Status</a>';}

if (in_array("hired_date", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=hired_date"><input type="checkbox" checked> Hired Date</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=hired_date"><input type="checkbox"> Hired Date</a>';}

if (in_array("start_date", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=start_date"><input type="checkbox" checked> Start Date</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=start_date"><input type="checkbox"> Start Date</a>';}

if (in_array("hiring_company", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=hiring_company"><input type="checkbox" checked> Hiring Company</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=hiring_company"><input type="checkbox"> Hiring Company</a>';}

if (in_array("hiring_account", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=hiring_account"><input type="checkbox" checked> Hiring Account</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=hiring_account"><input type="checkbox"> Hiring Account</a>';}

if (in_array("is_duplicate", $columnPreference)){
  echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=is_duplicate"><input type="checkbox" checked> Is Duplicate</a>';
  }else{
  echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=is_duplicate"><input type="checkbox"> Is Duplicate</a>';}

  if (in_array("call_status", $columnPreference)){
      echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=call_status"><input type="checkbox" checked> Call Status</a>';
      }else{
      echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=call_status"><input type="checkbox"> Call Status</a>';}


if (in_array("source", $columnPreference)){
    echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=source"><input type="checkbox" checked> Source</a>';
    }else{
    echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=source"><input type="checkbox"> Source</a>';}

if (in_array("date_created", $columnPreference)){
    echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=date_created"><input type="checkbox" checked> Date Created</a>';
    }else{
    echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=date_created"><input type="checkbox"> Date Created</a>';}

if (in_array("date_modified", $columnPreference)){
    echo '<a class="dropdown-item" href="data/updatecolumns.php?removeColumn=date_modified"><input type="checkbox" checked> Date Modified</a>';
    }else{
    echo '<a class="dropdown-item" href="data/updatecolumns.php?addColumn=date_modified"><input type="checkbox"> Date Modified</a>';}



 ?>
