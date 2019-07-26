<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html"><h2 style="color:white;">ATS</h2></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">

          <?php
          $moduleName = $_GET['m'];
          $actionName = $_GET['a'];

          switch($moduleName){
            case "dashboard":
            $dashboardClass = 'class="active"';
            $homeClass='class="active animated bounceIn"';
            $theHubClass    = 'class="active animated bounceIn"';
            break;

            case "feed":
            $dashboardClass = 'class="active"';
            $feedClass    = 'class="active animated bounceIn"';
            break;
          }


          if($moduleName == "candidates"){
            $candidatesClass = 'class="active"';
          switch($actionName){
            case "home":
            $homeClass='class="active animated bounceIn"';
            break;

            case "excel":
            $excelClass ='class="active animated bounceIn"';
            break;

            case "importcsv":
            $importClass='class="active animated bounceIn"';
            break;

            case "add":
            $addClass='class="active animated bounceIn"';
            break;

            case "addwalkin":
            $addwalkinClass='class="active animated bounceIn"';
            break;


          }
          }

          if($moduleName == "profile"){
            $profileClass = 'class="active animated bounceIn"';
          }

          if($moduleName == "notifsandactivities"){
            $notifsAndActivitiesClass = 'class="active animated bounceIn"';
          }
           ?>
            <nav>
                <ul class="metismenu" id="menu">
                    <li <?php echo $dashboardClass; ?>>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li <?php echo $theHubClass; ?>><a href="module.php?m=dashboard">The Hub</a></li>
                              <li <?php echo $feedClass; ?>><a href="module.php?m=feed">Live Feed</a></li>
                        </ul>
                    </li>
                    <li <?php echo $candidatesClass; ?>>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-clip"></i><span>Candidates</span></a>
                        <ul class="active">
                            <li <?php echo $homeClass; ?>><a href="module.php?m=candidates&a=home">My Candidates</a></li>
                            <li <?php echo $excelClass; ?>><a href="module.php?m=candidates&a=excel">My Excel</a></li>
                            <?php
                            if ($user['user_type'] != "Receptionist"){
                              echo '<li '.$addClass.'><a href="module.php?m=candidates&a=add">Add Candidates</a></li>';
                            }else{
                              echo '<li '.$addwalkinClass.'><a href="module.php?m=candidates&a=addwalkin">Add Walk-in Applicant</a></li>';
                            }
                            ?>

                            <li <?php echo $importClass; ?>><a href="module.php?m=candidates&a=importcsv">Import CSV</a></li>
                        </ul>
                    </li>
                    <?php


                      echo '<li '.$profileClass.'>
                          <a href="module.php?m=profile" aria-expanded="true"><i class="ti-user"></i><span>Profile</span></a>
                          </li>';


                     ?>
                    <!--<li <?php echo $notifsAndActivitiesClass; ?>>
                        <a href="module.php?m=notifsandactivities" aria-expanded="true"><i class="ti-bell"></i><span>Notifications & Activities</span></a>
                    </li>-->
                </ul>
            </nav>
        </div>
    </div>
</div>
