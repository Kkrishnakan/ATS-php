<div class="col-5">
                                <div class="card mt-2">
                                    <div class="card-body">

                                      <?php

                                      if (isset($_GET['invalid'])){
                                        echo '<div class="alert alert-danger" role="alert">
                                              <strong>Oops!</strong> You have uploaded an invalid file.
                                          </div>';
                                      }

                                      if (isset($_GET['wrongColumn'])){
                                        $wrongColumn = $_GET['wrongColumn'];
                                        echo '<div class="alert alert-warning" role="alert">
                                              <strong>Oops!</strong> Wrong column arrangement! Check column number '.$wrongColumn.'.
                                          </div>';
                                      }

                                       ?>

                                        <h4 class="header-title">Import CSV</h4>

                                        <?php
                                        /*if( ($userID == 1292) OR ($userID == 1318) OR ($userID == 1359) OR ($userID == 1319)
                                            OR ($userID == 1306) OR ($userID == 1363) OR ($userID == 1287) OR ($userID == 1302)
                                            OR ($userID == 1301) OR ($userID == 1293) OR ($userID == 1313) OR ($userID == 1360)
                                            OR ($userID == 1392) OR ($userID == 1398) OR ($userID == 1291)){
                                          echo '<form action="import_newformat/sourcing_import.php" method="POST" enctype="multipart/form-data">';
                                        }else{
                                          echo '<form action="import/sourcing_import.php" method="POST" enctype="multipart/form-data">';
                                        }*/
                                         ?>

                                         <form action="import/sourcing_import.php" method="POST" enctype="multipart/form-data">
                                            <div class="input-group">
                                              <input type="file" id="Filename" name="Filename">
                                              <br><br>
                                                <div class="input-group">
                                                  <button type="submit" class="btn btn-primary btn-block mb-3">Upload</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
