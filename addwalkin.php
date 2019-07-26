<div class="col-6">
<div class="card mt-2">
  <div class="card-body">
      <h4 class="header-title">Add Candidate</h4>

      <form action="data/addwalkin.php" method="POST" enctype="multipart/form-data">
        <div class="card-body">

            <table class="table" style="border:1px #e0e0e0 solid; font-size:11px;">
              <tbody>

                <tr>
                  <td class="bg-light">First Name:</td>
                  <td><input type="text"  style="width:100%;" name="firstName" required></td>
                </tr>

                <tr>
                  <td class="bg-light">Middle Name:</td>
                  <td><input type="text"  style="width:100%;" name="middleName" ></td>
                </tr>

                <tr>
                  <td class="bg-light">Last Name:</td>
                  <td><input type="text" style="width:100%;" name="lastName" required></td>
                </tr>


                <tr>
                  <td class="bg-light">Mobile Number:</td>
                  <td><input type="text" style="width:100%;" name="mobileNumber" required></td>
                </tr>

                <tr>
                  <td class="bg-light">Email:</td>
                  <td><input type="text" style="width:100%;" name="email" required></td>
                </tr>

                <tr>
                  <td class="bg-light">Location:</td>
                  <td><input type="text" style="width:100%;" name="location" required></td>
                </tr>

                <tr>
                  <td class="bg-light">Date of Birth:</td>
                  <td><input type="date" style="width:100%;" name="dateOfBirth"></td>
                </tr>

                <tr>
                  <td class="bg-light">Course:</td>
                  <td><input type="text" style="width:100%;" name="course"></td>
                </tr>

                <tr>
                  <td class="bg-light">Educational Attainment:</td>
                  <td><input type="text" style="width:100%;" name="educationalAttainment" required></td>
                </tr>

                <tr>
                  <td class="bg-light">Source of Leads:</td>
                  <td>
                    <select name="source" style="width:100%;" required>
                      <option name="" value="">-----</option>
                      <option name="source" value="Walk In">Walk In</option>
                      <option name="source" value="Promodiser">Promodiser</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td class="bg-light">Processing Branch:</td>
                  <td>
                    <select id="processingBranch" name="processingBranch" style="width:100%;" required>
                        <option id="processingBranch" name="processingBranch" value="">-----</option>
                        <option id="processingBranch" name="processingBranch" value="Altura">Altura</option>
                        <option id="processingBranch" name="processingBranch" value="Aspire">Aspire</option>
                        <option id="processingBranch" name="processingBranch" value="Intrix">Intrix</option>
                        <option id="processingBranch" name="processingBranch" value="Mueller">Mueller</option>
                        <option id="processingBranch" name="processingBranch" value="Orbit - Cubao">Orbit - Cubao</option>
                        <option id="processingBranch" name="processingBranch" value="Orbit - Cebu">Orbit - Cebu</option>
                        <option id="processingBranch" name="processingBranch" value="Sapient">Sapient</option>
                        <option id="processingBranch" name="processingBranch" value="Telesys">Telesys</option>
                        </select>
                  </td>
                </tr>

                <tr>
                  <td class="bg-light">Ownership:</td>
                  <td>
                    <select id="walkInOwnership" name="walkInOwnership" style="width: 100%;" required>
                        <option name="walkInOwnership" value="">-----</option>
                    <?php

                    $sql = "SELECT * FROM user WHERE user_type = 'Promodiser' OR user_type = 'Recruiter' OR user_id = '1361' ORDER BY first_name ASC";
                    $query = mysqli_query( $dbc, $sql );
                    while($row = mysqli_fetch_array($query)){
                        $user = $row['first_name']." ".$row['last_name'];
                        $userID = $row['user_id'];
                        echo '<option name="walkInOwnership" value="'.$userID.'">'.$user.'</option>';
                    }
                    ?>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>


        </div>

      <div class="input-group">
      <button type="submit" class="btn btn-primary btn-block mb-3">Add Candidate</button>
      </div>
      </form>
      </div>
      </div>
      </div>
