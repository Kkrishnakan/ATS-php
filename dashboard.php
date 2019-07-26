


<style>
#totalHires {
  width: 100%;
  height: 300px;
}

#showUpRate {
  width: 100%;
  height: 400px;
}

#endorsementRate {
  width: 100%;
  height: 400px;
}

#hiringRate {
  width: 100%;
  height: 400px;
}

#billingRate {
  width: 100%;
  height: 400px;
}

#statsToday {
  width: 100%;
  height: 400px;
}

#statsForMonth {
  width: 100%;
  height: 400px;
}

</style>

      <?php

      if($_GET['viewAs'] == "selectedDates"){
        $startOfMonth = $_GET['asStartDate'];
        $endOfMonth = $_GET['asEndDate'];
      }else{
        $startOfMonth = date("Y-m-01");
        $endOfMonth   = date("Y-m-31");
      }


      $dateFormatToday = date("Y-m-d");
      $today   = date("F d, o");
    //  echo $startOfMonth;
      //echo $endOfMonth;

      $getTotalHiresCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE hired_date BETWEEN '$startOfMonth' AND '$endOfMonth'");
      $num = mysqli_fetch_array($getTotalHiresCurrentMonth);
      $totalHiresCurrentMonth = $num["id"];
      if ($num["id"] == NULL){ $totalHiresCurrentMonth = "0"; }

      $getTelesysHiresCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE processing_branch LIKE '%telesys%' AND hired_date BETWEEN '$startOfMonth' AND '$endOfMonth' ");
      $num = mysqli_fetch_array($getTelesysHiresCurrentMonth);
      $totalHiresTelesysCurrentMonth = $num["id"];
      if ($num["id"] == NULL){ $totalHiresTelesysCurrentMonth = "0"; }

      $getAspireHiresCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE processing_branch LIKE '%aspire%' AND hired_date BETWEEN '$startOfMonth' AND '$endOfMonth' ");
      $num = mysqli_fetch_array($getAspireHiresCurrentMonth);
      $totalHiresAspireCurrentMonth = $num["id"];
      if ($num["id"] == NULL){ $totalHiresAspireCurrentMonth = "0"; }

      $getLiacomHiresCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE processing_branch LIKE '%liacom%' AND hired_date BETWEEN '$startOfMonth' AND '$endOfMonth' ");
      $num = mysqli_fetch_array($getLiacomHiresCurrentMonth);
      $totalHiresLiacomCurrentMonth = $num["id"];
      if ($num["id"] == NULL){ $totalHiresLiacomCurrentMonth = "0"; }

      $getIntrixHiresCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE processing_branch LIKE '%intrix%' AND hired_date BETWEEN '$startOfMonth' AND '$endOfMonth' ");
      $num = mysqli_fetch_array($getIntrixHiresCurrentMonth);
      $totalHiresIntrixCurrentMonth = $num["id"];
      if ($num["id"] == NULL){ $totalHiresIntrixCurrentMonth = "0"; }

      $getAlturaHiresCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE processing_branch LIKE '%altura%' AND hired_date BETWEEN '$startOfMonth' AND '$endOfMonth' ");
      $num = mysqli_fetch_array($getAlturaHiresCurrentMonth);
      $totalHiresAlturaCurrentMonth = $num["id"];
      if ($num["id"] == NULL){ $totalHiresAlturaCurrentMonth = "0"; }

      $getOrbitCebuHiresCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE processing_branch='Orbit - Cebu' AND hired_date BETWEEN '$startOfMonth' AND '$endOfMonth' ");
      $num = mysqli_fetch_array($getOrbitCebuHiresCurrentMonth);
      $totalHiresOrbitCebuCurrentMonth = $num["id"];
      if ($num["id"] == NULL){ $totalHiresOrbitCebuCurrentMonth = "0"; }

      $getOrbitCubaoHiresCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE processing_branch LIKE '%cubao%' AND hired_date BETWEEN '$startOfMonth' AND '$endOfMonth' ");
      $num = mysqli_fetch_array($getOrbitCubaoHiresCurrentMonth);
      $totalHiresOrbitCubaoCurrentMonth = $num["id"];
      if ($num["id"] == NULL){ $totalHiresOrbitCubaoCurrentMonth = "0"; }

      $getSapientHiresCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE processing_branch LIKE '%sapient%' AND hired_date BETWEEN '$startOfMonth' AND '$endOfMonth' ");
      $num = mysqli_fetch_array($getSapientHiresCurrentMonth);
      $totalHiresSapientCurrentMonth = $num["id"];
      if ($num["id"] == NULL){ $totalHiresSapientCurrentMonth = "0"; }


      $getConfirmsCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE confirmed_date_of_interview BETWEEN '$startOfMonth' AND '$endOfMonth' ");
      $num = mysqli_fetch_array($getConfirmsCurrentMonth);
      $totalConfirmsCurrentMonth = $num["id"];
      if ($num["id"] == NULL){ $totalConfirmsCurrentMonth = "0"; }

      $getAttendeesCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE date_attended BETWEEN '$startOfMonth' AND '$endOfMonth' ");
      $num = mysqli_fetch_array($getAttendeesCurrentMonth);
      $totalAttendeesCurrentMonth = $num["id"];
      if ($num["id"] == NULL){ $totalAttendeesCurrentMonth = "0"; }

      $getEndorsedCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE endorsement_status = 'Endorsed' AND date_attended BETWEEN '$startOfMonth' AND '$endOfMonth' ");
      $num = mysqli_fetch_array($getEndorsedCurrentMonth);
      $totalEndorsedCurrentMonth = $num["id"];
      if ($num["id"] == NULL){ $totalEndorsedCurrentMonth = "0"; }

      $getHiredCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE application_status = 'Hired' AND hired_date BETWEEN '$startOfMonth' AND '$endOfMonth' ");
      $num = mysqli_fetch_array($getHiredCurrentMonth);
      $totalHiredCurrentMonth = $num["id"];
      if ($num["id"] == NULL){ $totalHiredCurrentMonth = "0"; }


      $getBilledCurrentMonth = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE billing_status = 'Billed' AND billing_date BETWEEN '$startOfMonth' AND '$endOfMonth' ");
      $num = mysqli_fetch_array($getBilledCurrentMonth);
      $totalBilledCurrentMonth = $num["id"];
      if ($num["id"] == NULL){ $totalBilledCurrentMonth = "0"; }



      $showUpRatePercent = ($totalAttendeesCurrentMonth/$totalConfirmsCurrentMonth) * 100;
      $endorsedRatePercent = ($totalEndorsedCurrentMonth/$totalAttendeesCurrentMonth) * 100;
      $hiringRatePercent = ($totalHiredCurrentMonth/$totalEndorsedCurrentMonth) * 100;
      $billingRatePercent = ($totalBilledCurrentMonth/$totalHiredCurrentMonth) * 100;


      // for today

      $getConfirmsToday = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE owner='$userID' AND confirmed_date_of_interview = '$dateFormatToday'");
      $num = mysqli_fetch_array($getConfirmsToday);
      $totalConfirmsToday = $num["id"];
      if ($num["id"] == NULL){ $totalConfirmsToday = "0"; }


      $getAttendeesToday = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE owner='$userID' AND date_attended = '$dateFormatToday'");
      $num = mysqli_fetch_array($getAttendeesToday);
      $totalAttendeesToday = $num["id"];
      if ($num["id"] == NULL){ $totalAttendeesToday = "0"; }

      $getHiredToday = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE owner='$userID' AND application_status = 'Hired' AND hired_date= '$dateFormatToday' ");
      $num = mysqli_fetch_array($getHiredToday);
      $totalHiredToday = $num["id"];
      if ($num["id"] == NULL){ $totalHiredToday = "0"; }


      $getEndorsedToday = mysqli_query($dbc, "SELECT COUNT(DISTINCT candidate_id) AS id FROM candidate WHERE owner='$userID' AND endorsement_status = 'Endorsed' AND date_attended = '$dateFormatToday' ");
      $num = mysqli_fetch_array($getEndorsedToday);
      $totalEndorsedToday = $num["id"];
      if ($num["id"] == NULL){ $totalEndorsedToday = "0"; }

      ?>
    <div class="row">

        <!-- seo fact area start -->
        <?php

      if($_GET['viewAs'] == "selectedDates"){
        $date = date_create($_GET['asStartDate']);
        $startOfMonthDisplay = date_format($date,"M. d, o");

        $date = date_create($_GET['asEndDate']);
        $endOfMonthDisplay = date_format($date,"M. d, o");
        $displayStatsToday = 'style="display:none;"';
        $displayStatsMonth = 'style="display:block;"';
        //$startOfMonthDisplay = date("M. 1, o");
        //$endOfMonthDisplay   = date("M. 31, o");
      }else{
        $startOfMonthDisplay = date("M. 1, o");
        $endOfMonthDisplay   = date("M. 31, o");
        $displayStatsToday = 'style="display:block;"';
        $displayStatsMonth = 'style="display:none;"';
      }

      $currentMonth = $startOfMonthDisplay." - ".$endOfMonthDisplay;
         ?>

        <div class="col-lg-12 mt-2">
            <div class="card h-full">
                <div class="card-body">
                    <h4 class="header-title"><?php echo "<span style='color:blue;'>".$totalHiredCurrentMonth." Hires</span>"; ?> as of (<?php echo $currentMonth; ?>) </h4>

                    <div id="totalHires"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <form action="module.php" method="GET">
                                                  <input type="hidden" name="m" value="dashboard">
                                                  <input type="hidden" name="viewAs" value="selectedDates">
                                                    <div class="form-row align-items-center">
                                                      <div class="col-sm-3 my-1">
                                                        <h4 class="header-title">Date Filter<br><small>Input dates to view stats</small></h4>
                                                      </div>

                                                        <div class="col-sm-3 my-1">
                                                            <input type="date" class="form-control" id="inlineFormInputName" placeholder="" name="asStartDate" value="<?php echo $_GET['asStartDate']; ?>">
                                                        </div>
                                                        <div class="col-sm-3 my-1">
                                                              <input type="date" class="form-control" id="inlineFormInputGroupUsername" placeholder="" name="asEndDate" value="<?php echo $_GET['asEndDate']; ?>">
                                                        </div>
                                                        <div class="col-auto my-1">
                                                            <button type="submit" class="btn btn-primary">View</button>
                                                            <a href="module.php?m=dashboard"><button type="button" class="btn btn-light">Clear Dates</button></a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                <div class="col-lg-12 mt-2">
                  <div class="card h-full">
                      <div class="card-body">
                        <div class="row">

                            <div class="col-lg-8" <?php echo $displayStatsToday; ?>>
                              <h4 class="header-title">Stats for Today (<?php echo $today; ?>)</h4>
                              <div id="statsToday"></div>
                            </div>

                            <div class="col-lg-8" <?php echo $displayStatsMonth; ?>>
                              <h4 class="header-title">Stats for (<?php echo $currentMonth; ?>)</h4>
                              <div id="statsForMonth"></div>
                            </div>

                            <div class="col-lg-4">
                              <h4 class="header-title">Show Up Rate: (<?php echo number_format($showUpRatePercent,1); ?>%)</h4>
                              <div id="showUpRate"></div>
                            </div>


                        </div>

                      </div>
                    </div>
                </div>


        <div class="col-lg-12 mt-2">
          <div class="card h-full">
              <div class="card-body">
                <div class="row">



                    <div class="col-lg-4">
                      <h4 class="header-title">Endorsement Rate (<?php echo number_format($endorsedRatePercent,1); ?>%)</h4>
                      <div id="endorsementRate"></div>
                    </div>

                    <div class="col-lg-4">
                      <h4 class="header-title">Hiring Rate (<?php echo number_format($hiringRatePercent,1); ?>%)</h4>
                      <div id="hiringRate"></div>
                    </div>

                    <div class="col-lg-4">
                    <h4 class="header-title">Billing Rate: (<?php echo number_format($billingRatePercent,1); ?>%)</h4>
                    <div id="billingRate"></div>
                    </div>


                </div>

              </div>
            </div>

        </div>




        <!-- Advertising area end -->

    </div>

    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
    <!-- Chart code -->
    <script>

    <?php //data from get
    echo "var totalHires        = ".$totalHiresCurrentMonth.";";
    echo "var totalHiresTelesys = ".$totalHiresTelesysCurrentMonth.";";
    echo "var totalHiresAspire  = ".$totalHiresAspireCurrentMonth.";";
    echo "var totalHiresLiacom = ".$totalHiresLiacomCurrentMonth.";";
    echo "var totalHiresIntrix  = ".$totalHiresIntrixCurrentMonth.";";
    echo "var totalHiresAltura  = ".$totalHiresAlturaCurrentMonth.";";
    echo "var totalHiresOrbitCebu = ".$totalHiresOrbitCebuCurrentMonth.";";
    echo "var totalHiresOrbitCubao = ".$totalHiresOrbitCubaoCurrentMonth.";";
    echo "var totalHiresSapient = ".$totalHiresSapientCurrentMonth.";";
     ?>
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    // Create chart instance
    var chart = am4core.create("totalHires", am4charts.XYChart);


    // Add data
    chart.data = [{
        "name": "Telesys",
        "points": totalHiresTelesys,
        "color": "#ff392e",
        "bullet": "assets/images/companylogos/telesys.png"
    }, {
        "name": "Aspire",
        "points": totalHiresAspire,
        "color": "#3ace3a",
        "bullet": "assets/images/companylogos/aspire.png"
    }, {
        "name": "Liacom",
        "points": totalHiresLiacom,
        "color": "#B629B1",
        "bullet": "assets/images/companylogos/liacom.png"
    }, {
        "name": "Intrix",
        "points": totalHiresIntrix,
        "color": "#ff9e14",
        "bullet": "assets/images/companylogos/intrix.png"
    }, {
        "name": "Altura",
        "points": totalHiresAltura,
        "color": "#4477b2",
        "bullet": "assets/images/companylogos/altura.png"
    }, {
        "name": "O. Cebu",
        "points": totalHiresOrbitCebu,
        "color": "#ffb347",
        "bullet": "assets/images/companylogos/orbit-cebu.png"
    }, {
        "name": "O. Cubao",
        "points": totalHiresOrbitCubao,
        "color": "#ffa82e",
        "bullet": "assets/images/companylogos/orbit-cubao.png"
    }, {
        "name": "Sapient",
        "points": totalHiresSapient,
        "color": "#028e2c",
        "bullet": "assets/images/companylogos/sapient-name.png"
    }];

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "name";
    categoryAxis.renderer.grid.template.disabled = true;
    categoryAxis.renderer.minGridDistance = 30;
    categoryAxis.renderer.inside = true;
    categoryAxis.renderer.labels.template.fill = am4core.color("#fff");
    categoryAxis.renderer.labels.template.fontSize = 20;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.grid.template.strokeDasharray = "4,4";
    valueAxis.renderer.labels.template.disabled = true;
    valueAxis.min = 0;

    // Do not crop bullets
    chart.maskBullets = false;

    // Remove padding
    chart.paddingBottom = 0;

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.dataFields.valueY = "points";
    series.dataFields.categoryX = "name";
    series.columns.template.propertyFields.fill = "color";
    series.columns.template.propertyFields.stroke = "color";
    series.columns.template.column.cornerRadiusTopLeft = 15;
    series.columns.template.column.cornerRadiusTopRight = 15;
    series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/b]";

    // Add bullets
    var bullet = series.bullets.push(new am4charts.Bullet());
    var image = bullet.createChild(am4core.Image);
    image.horizontalCenter = "middle";
    image.verticalCenter = "bottom";
    image.dy = 20;
    image.y = am4core.percent(100);
    image.propertyFields.href = "bullet";
    image.tooltipText = series.columns.template.tooltipText;
    image.propertyFields.fill = "color";
    image.filters.push(new am4core.DropShadowFilter());
    </script>



<script>
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("showUpRate", am4charts.PieChart);

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";

// Let's cut a hole in our Pie chart the size of 30% the radius
chart.innerRadius = am4core.percent(30);

// Put a thick white border around each Slice
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;
pieSeries.slices.template
  // change the cursor on hover to make it apparent the object can be interacted with
  .cursorOverStyle = [
    {
      "property": "cursor",
      "value": "pointer"
    }
  ];

pieSeries.alignLabels = false;
pieSeries.labels.template.bent = true;
pieSeries.labels.template.radius = 3;
pieSeries.labels.template.padding(0,0,0,0);

pieSeries.ticks.template.disabled = true;

// Create a base filter effect (as if it's not there) for the hover to return to
var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
shadow.opacity = 0;

// Create hover state
var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists

// Slightly shift the shadow and make it more prominent on hover
var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
hoverShadow.opacity = 0.7;
hoverShadow.blur = 5;

// Add a legend
chart.legend = new am4charts.Legend();
<?php
    echo "var totalConfirms     = ".$totalConfirmsCurrentMonth.";";
    echo "var totalConfirmsName = 'Confirms (".$totalConfirmsCurrentMonth.")';";

    echo "var totalAttendees     = ".$totalAttendeesCurrentMonth.";";
    echo "var totalAttendeesName = 'Attendees (".$totalAttendeesCurrentMonth.")';";
 ?>

chart.data = [{
  "country": totalConfirmsName,
  "litres": totalConfirms
},{
  "country": totalAttendeesName,
  "litres": totalAttendees
}];
</script>




<script>
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("endorsementRate", am4charts.PieChart);

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";

// Let's cut a hole in our Pie chart the size of 30% the radius
chart.innerRadius = am4core.percent(30);

// Put a thick white border around each Slice
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;
pieSeries.slices.template
  // change the cursor on hover to make it apparent the object can be interacted with
  .cursorOverStyle = [
    {
      "property": "cursor",
      "value": "pointer"
    }
  ];

pieSeries.alignLabels = false;
pieSeries.labels.template.bent = true;
pieSeries.labels.template.radius = 3;
pieSeries.labels.template.padding(0,0,0,0);

pieSeries.ticks.template.disabled = true;

// Create a base filter effect (as if it's not there) for the hover to return to
var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
shadow.opacity = 0;

// Create hover state
var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists

// Slightly shift the shadow and make it more prominent on hover
var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
hoverShadow.opacity = 0.7;
hoverShadow.blur = 5;

// Add a legend
chart.legend = new am4charts.Legend();

<?php

    echo "var totalAttendees     = ".$totalAttendeesCurrentMonth.";";
    echo "var totalAttendeesName = 'Attendees (".$totalAttendeesCurrentMonth.")';";

    echo "var totalEndorsed     = ".$totalEndorsedCurrentMonth.";";
    echo "var totalEndorsedName = 'Endorsed (".$totalEndorsedCurrentMonth.")';";
 ?>


chart.data = [{
  "country": totalAttendeesName,
  "litres": totalAttendees
},{
  "country": totalEndorsedName,
  "litres": totalEndorsed
}];
</script>



<script>
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("hiringRate", am4charts.PieChart);

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";

// Let's cut a hole in our Pie chart the size of 30% the radius
chart.innerRadius = am4core.percent(30);

// Put a thick white border around each Slice
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;
pieSeries.slices.template
  // change the cursor on hover to make it apparent the object can be interacted with
  .cursorOverStyle = [
    {
      "property": "cursor",
      "value": "pointer"
    }
  ];

pieSeries.alignLabels = false;
pieSeries.labels.template.bent = true;
pieSeries.labels.template.radius = 3;
pieSeries.labels.template.padding(0,0,0,0);

pieSeries.ticks.template.disabled = true;

// Create a base filter effect (as if it's not there) for the hover to return to
var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
shadow.opacity = 0;

// Create hover state
var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists

// Slightly shift the shadow and make it more prominent on hover
var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
hoverShadow.opacity = 0.7;
hoverShadow.blur = 5;

// Add a legend
chart.legend = new am4charts.Legend();

<?php

    echo "var totalEndorsed     = ".$totalEndorsedCurrentMonth.";";
    echo "var totalEndorsedName = 'Endorsed (".$totalEndorsedCurrentMonth.")';";

    echo "var totalHired     = ".$totalHiredCurrentMonth.";";
    echo "var totalHiredName = 'Hires (".$totalHiredCurrentMonth.")';";
 ?>


chart.data = [{
  "country": totalEndorsedName,
  "litres": totalEndorsed
},{
  "country": totalHiredName,
  "litres": totalHired
}];
</script>



<script>
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("billingRate", am4charts.PieChart);

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";

// Let's cut a hole in our Pie chart the size of 30% the radius
chart.innerRadius = am4core.percent(30);

// Put a thick white border around each Slice
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;
pieSeries.slices.template
  // change the cursor on hover to make it apparent the object can be interacted with
  .cursorOverStyle = [
    {
      "property": "cursor",
      "value": "pointer"
    }
  ];

pieSeries.alignLabels = false;
pieSeries.labels.template.bent = true;
pieSeries.labels.template.radius = 3;
pieSeries.labels.template.padding(0,0,0,0);

pieSeries.ticks.template.disabled = true;

// Create a base filter effect (as if it's not there) for the hover to return to
var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
shadow.opacity = 0;

// Create hover state
var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists

// Slightly shift the shadow and make it more prominent on hover
var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
hoverShadow.opacity = 0.7;
hoverShadow.blur = 5;

// Add a legend
chart.legend = new am4charts.Legend();

<?php

    echo "var totalHired     = ".$totalHiredCurrentMonth.";";
    echo "var totalHiredName = 'Hires (".$totalHiredCurrentMonth.")';";

    echo "var totalBilled     = ".$totalBilledCurrentMonth.";";
    echo "var totalBilledName = 'Endorsed (".$totalBilledCurrentMonth.")';";
 ?>


chart.data = [{
  "country": totalHiredName,
  "litres": totalHired
},{
  "country": totalBilledName,
  "litres": totalBilled
}];
</script>


<script>
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

<?php

    echo "var confirmsToday     = ".$totalConfirmsToday.";";
    echo "var attendeesToday     = ".$totalAttendeesToday.";";
    echo "var endorsedToday     = ".$totalEndorsedToday.";";
    echo "var hiredToday     = ".$totalHiredToday.";";
 ?>

// Create chart instance
var chart = am4core.create("statsToday", am4charts.XYChart3D);

// Add data
chart.data = [{
  "year": "Confirms",
  "income": confirmsToday,
  "color": chart.colors.next()
}, {
  "year": "Attendees",
  "income": attendeesToday,
  "color": chart.colors.next()
}, {
  "year": "Endorsed",
  "income": endorsedToday,
  "color": chart.colors.next()
}, {
  "year": "Hires",
  "income": hiredToday,
  "color": chart.colors.next()
}];

// Create axes
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.numberFormatter.numberFormat = "#";
categoryAxis.renderer.inversed = true;

var  valueAxis = chart.xAxes.push(new am4charts.ValueAxis());

// Create series
var series = chart.series.push(new am4charts.ColumnSeries3D());
series.dataFields.valueX = "income";
series.dataFields.categoryY = "year";
series.name = "Income";
series.columns.template.propertyFields.fill = "color";
series.columns.template.tooltipText = "{valueX}";
series.columns.template.column3D.stroke = am4core.color("#fff");
series.columns.template.column3D.strokeOpacity = 0.2;
</script>


<script>
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

<?php

    echo "var confirmsToday     = ".$totalConfirmsCurrentMonth.";";
    echo "var attendeesToday    = ".$totalAttendeesCurrentMonth.";";
    echo "var endorsedToday     = ".$totalEndorsedCurrentMonth.";";
    echo "var hiredToday        = ".$totalHiredCurrentMonth.";";
 ?>

// Create chart instance
var chart = am4core.create("statsForMonth", am4charts.XYChart3D);

// Add data
chart.data = [{
  "year": "Confirms",
  "income": confirmsToday,
  "color": chart.colors.next()
}, {
  "year": "Attendees",
  "income": attendeesToday,
  "color": chart.colors.next()
}, {
  "year": "Endorsed",
  "income": endorsedToday,
  "color": chart.colors.next()
}, {
  "year": "Hires",
  "income": hiredToday,
  "color": chart.colors.next()
}];

// Create axes
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.numberFormatter.numberFormat = "#";
categoryAxis.renderer.inversed = true;

var  valueAxis = chart.xAxes.push(new am4charts.ValueAxis());

// Create series
var series = chart.series.push(new am4charts.ColumnSeries3D());
series.dataFields.valueX = "income";
series.dataFields.categoryY = "year";
series.name = "Income";
series.columns.template.propertyFields.fill = "color";
series.columns.template.tooltipText = "{valueX}";
series.columns.template.column3D.stroke = am4core.color("#fff");
series.columns.template.column3D.strokeOpacity = 0.2;
</script>
