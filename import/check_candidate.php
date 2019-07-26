<?php


class checkCandidate{

    function activities($owner, $finalRowCount){

        $action = "You have uploaded ".$finalRowCount." leads.";
        $dateToday = $this->getToday();

        $activity = "INSERT INTO _activities(
            action,
            activities_dateTime,
            type,
            owner)
            VALUES(
            '$action',
            '$dateToday',
            'uploadcsv',
            '$owner')";
        mysqli_query($dbc, $activity);
    }


    function deleteBlank(){
        mysqli_query($dbc, "DELETE FROM candidate WHERE phone_cell='' AND first_name='' AND last_name=''");
    }

    function changeDateFormat($toChange){
        $date = date_create($toChange);
        $newDate = date_format($date,"Y-m-d");
        return $newDate;
        }

    function getToday(){
            $now = new DateTime();
            $now->setTimezone(new DateTimeZone('Asia/Manila'));
            $current_date = $now->format('Y-m-d H:i:s');
            //$dateToday = date("Y-m-d H:i:s",strtotime("-240 minutes", strtotime($current_date)));
            return $current_date;
        }

    function check($owner, $line0, $line1, $line2, $line3, $line4,
                   $line5, $line6, $line7, $line8, $line9,
                   $line10, $line11, $line12, $line13, $line14, $line15, $line16, $line17){
      //  echo $line10."<br>";
        //echo $line11."<br>";

        if ($line0!=null){
            $newLine0 = $this->changeDateFormat($line0);
        }else{
            $newLine0 = "";
        }

        if ($line7!=null){
            $newLine7 = $this->changeDateFormat($line7);
        }else{
            $newLine7 = "";
        }

        $dateToday = $this->getToday();


        $checkDuplicate = "SELECT * FROM candidate WHERE first_name='$line3' AND last_name='$line2'
                           AND processing_branch='$line15' AND owner='$owner'";
        $r = mysqli_query($dbc, $checkDuplicate);
        $row = mysqli_fetch_array($r);

        if($row['candidate_id'] != null){
            if($owner == $row['owner']){

              if($line15 != $row['processing_branch']){
                $this->isNew($owner, $newLine0, $line1, $line2, $line3, $line4,
                $line5, $line6, $newLine7, $line8, $line9,
                $line10, $line11, $line12, $line13, $line14, $line15, $line16, $line17, $dateToday);
              }else{
                $this->isUpdate($owner, $newLine0, $line1, $line2, $line3, $line4,
                $line5, $line6, $newLine7, $line8, $line9,
                $line10, $line11, $line12, $line13, $line14, $line15, $line16, $line17, $dateToday);
              }

            }else{
                $this->isNew($owner, $newLine0, $line1, $line2, $line3, $line4,
                $line5, $line6, $newLine7, $line8, $line9,
                $line10, $line11, $line12, $line13, $line14, $line15, $line16, $line17, $dateToday);
            }
        }else{
            $this->isNew($owner, $newLine0, $line1, $line2, $line3, $line4,
                $line5, $line6, $newLine7, $line8, $line9,
                $line10, $line11, $line12, $line13, $line14, $line15, $line16, $line17, $dateToday);
        }
        //echo "duplicate!";

    }

    function isUpdate($owner, $line0, $line1, $line2, $line3, $line4,
                        $line5, $line6, $line7, $line8, $line9,
                        $line10, $line11, $line12, $line13, $line14, $line15, $line16, $line17, $dateToday){

        $update = "UPDATE candidate SET
            assigned_date_of_interview  = '$line0',
			      middle_name					        = '$line4',
			      phone_cell					        = '$line5',
			      confirmation_status 	      = '$line6',
      			confirmed_date_of_interview = '$line7',
            replied_to                  = '$line8',
      			source					           	= '$line10',
            type_of_lead                = '$line11',
            preferred_communication		  = '$line12',
            email1      				        = '$line13',
            ad_applied_to               = '$line14',
            processing_branch           = '$line15',
            advertiser_remarks          = '$line16',
            call_status                 = '$line17',
            date_modified               = '$dateToday'
      			WHERE
      			first_name					= '$line3' AND
      			last_name					  = '$line2' AND
      			owner						    = '$owner'
      			";
	    mysqli_query($dbc, $update);
      //echo mysql_error();


    }

    function isNew($owner, $line0, $line1, $line2, $line3, $line4,
    $line5, $line6, $line7, $line8, $line9,
    $line10, $line11, $line12, $line13, $line14, $line15, $line16, $line17, $dateToday){


                        $newFullName = $line2.", ".$line3." ".$line4;
                        //echo $newFullName."<br>";
                        //echo $dateToday."<br>";
                        //echo $owner;
                        //echo $line0."<br>";
                        //echo $line1."<br>";
                        //$new = "INSERT INTO candidate(full_name)VALUES('Ryan T Biton')";

                        /*if($dbc){
                          echo "Connection Established!"."<br>";
                        }else{
                          echo "Failed to Connect!"."<br>";
                        }*/

            $insert = "INSERT INTO candidate (
                            assigned_date_of_interview,
                            full_name,
                            last_name,
                            first_name,
                            middle_name,
                            phone_cell,
                            confirmation_status,
                            confirmed_date_of_interview,
                            replied_to,
                            city,
                            source,
                            type_of_lead,
                            preferred_communication,
                            email1,
                            ad_applied_to,
                            processing_branch,
                            advertiser_remarks,
                            call_status,
                            owner,
                            entered_by,
                            date_created,
                            date_modified,
                            site_id
                            )
                        VALUES (
                            '$line0',
                            '$line1',
                            '$line2',
                            '$line3',
                            '$line4',
                            '$line5',
                            '$line6',
                            '$line7',
                            '$line8',
                            '$line9',
                            '$line10',
                            '$line11',
                            '$line12',
                            '$line13',
                            '$line14',
                            '$line15',
                            '$line16',
                            '$line17',
                            '$owner',
                            '$owner',
                            '$dateToday',
                            '$dateToday',
                            '1'
                            )";
                        mysqli_query($dbc, $insert);
    }


}


?>
