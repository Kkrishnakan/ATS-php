<?php
/*
 * Metacom ATS
 *
 * Copyright (C) 2018 Metacom
 *
 * Open-source project from OPENCATS
 * by Ryan Biton
 */

class checkCandidate{

    function activities($owner, $finalRowCount){

        $action = "You have uploaded ".$finalRowCount." leads.";
        $dateToday = $this->getToday();

        $query = "INSERT INTO _activities(
            action,
            activities_dateTime,
            type,
            owner)
            VALUES(
            '$action',
            '$dateToday',
            'uploadcsv',
            '$owner')";
        mysql_query($query);
    }


    function deleteBlank(){
        $query = "DELETE FROM candidate WHERE phone_cell='' AND first_name='' AND last_name=''";
        mysql_query($query);
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
                   $line10, $line11, $line12, $line13, $line14){
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
                           AND processing_branch='$line13' AND owner='$owner'";
        $r = mysql_query($checkDuplicate);
        $row = mysql_fetch_array($r);

        if($row['candidate_id']!=null){
            if($owner == $row['owner']){
                $this->isUpdate($owner, $newLine0, $line1, $line2, $line3, $line4,
                $line5, $line6, $newLine7, $line8, $line9,
                $line10, $line11, $line12, $line13, $line14, $dateToday);
            }else{
                $this->isNew($owner, $newLine0, $line1, $line2, $line3, $line4,
                $line5, $line6, $newLine7, $line8, $line9,
                $line10, $line11, $line12, $line13, $line14, $dateToday);
            }
        }else{
            $this->isNew($owner, $newLine0, $line1, $line2, $line3, $line4,
                $line5, $line6, $newLine7, $line8, $line9,
                $line10, $line11, $line12, $line13, $line14, $dateToday);
        }
        //echo "duplicate!";

    }

    function isUpdate($owner, $line0, $line1, $line2, $line3, $line4,
                        $line5, $line6, $line7, $line8, $line9,
                        $line10, $line11, $line12, $line13, $line14, $dateToday){

        $query = "UPDATE candidate SET
            assigned_date_of_interview  = '$line0',
      			middle_name				     	= '$line4',
      			phone_cell					    = '$line5',
      			confirmation_status 	  = '$line6',
      			confirmed_date_of_interview = '$line7',
      			source					        = '$line9',
            preferred_communication = '$line10',
            email1					      	= '$line11',
            ad_applied_to			     	= '$line12',
            advertiser_remarks          = '$line14',
            date_modified               = '$dateToday'
			WHERE
			first_name					= '$line3' AND
			last_name					= '$line2' AND
			owner						= '$owner'
			";
	    mysql_query($query);


    }

    function isNew($owner, $line0, $line1, $line2, $line3, $line4,
    $line5, $line6, $line7, $line8, $line9,
    $line10, $line11, $line12, $line13, $line14, $dateToday){


                        $newFullName = $line2.", ".$line3." ".$line4;
                        //echo $newFullName."<br>";
                        //echo $dateToday."<br>";
                        //echo $owner;
                        //echo $line0."<br>";
                        //echo $line1."<br>";
            //$new = "INSERT INTO candidate(full_name)VALUES('Ryan T Biton')";



            $insert = "INSERT INTO candidate (
                            assigned_date_of_interview, /*0*/
                            full_name,   /*1*/
                            last_name,  /*2*/
                            first_name,  /*3*/
                            middle_name,  /*4*/
                            phone_cell,
                            confirmation_status,
                            confirmed_date_of_interview,
                            city,
                            source,
                            preferred_communication,
                            email1,
                            ad_applied_to,
                            processing_branch,
                            advertiser_remarks,
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
                            '$owner',
                            '$owner',
                            '$dateToday',
                            '$dateToday',
                            '1'
                            )";
                        mysql_query($insert);
    }


}


?>
