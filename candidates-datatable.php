<div class="col-12 mt-2">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Candidates: HOME</h4>
            <div class="data-tables datatable-primary">
                <table id="dataTable2" class="">
                  <thead class="text-uppercase bg-primary">
                      <tr class="table-active text-white">
                         <th></th>

          <?php
          include('columns.php');
          $columnPreference = unserialize($user['column']);
          $countOfTableHeader = count($tableHeader);
          $countOfColumnPreference = count($columnPreference);
          //echo $countOfColumnPreference;

          ?>

          <?php

            for($x = 1; $x <= $countOfTableHeader; $x++){
              echo '<th>'.$tableHeader[$x].'</th>';
            }
          ?>
                      </tr>
                  </thead>
                  <tbody>

                    <?php
                    //include('data/db.php');
                    $userID      = $_SESSION['user'];
                    $criterion   = $user['criterion'];
                    $rowsPerPage = $user['rows_per_page'];


                    //echo $user['first_name']."<br>";
                    $x = 0;
                    mysql_set_charset('utf8');
                    $query2 = "SELECT * FROM candidate WHERE site_id='1' $criterion";
                    $r2 = mysql_query($query2, $dbc);
                    while($candidate = mysql_fetch_array($r2)){
                      //echo $x;
                      if($x % 2 == 0){
                        echo '<tr>';
                      }else{
                          echo '<tr class="table-light">';
                      }
                      $x++;
                      echo '<td><input type="checkbox"></td>';
                      for($x = 1; $x <= $countOfColumnPreference; $x++){
                        $string = $columnPreference[$x];
                        if($x <= 2){
                        echo '<td><a href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">'.substr($candidate[$string], 0, 15).'</a></td>';
                      }else{
                        echo '<td>'.substr($candidate[$string], 0, 15).'</td>';

                      }
                    }
                      //echo '<td><a href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">'.$candidate['full_name'].'</a></td>';
                      //echo '<td><a href="module.php?m=candidates&a=show&candidateID='.$candidate['candidate_id'].'">'.substr($candidate['phone_cell'],0,13).'</a></td>';
                      //echo '<td>'.substr($candidate['city'],0,15).'</td>';
                      //echo '<td>'.$candidate['source'].'</td>';
                      //echo '<td>'.$candidate['confirmation_status'].'</td>';
                      //echo '<td>'.$candidate['confirmed_date_of_interview'].'</td>';
                      //echo '</tr>';
                    }

                    echo '<tr>';
                    echo '<td><input type="checkbox" onclick="toggle(this);">
                              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" style="background: transparent; border:0px; color:black;">
                              Action
                              </button>
                          <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                          <a class="dropdown-item" href="#">Export</a>
                          <a class="dropdown-item" href="#">Delete</a>
                          </div>

                    </td>';

                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '</tr>';
                     ?>

                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
  function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}

</script>
