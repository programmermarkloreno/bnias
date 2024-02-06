<main id="main" class="main">

    <div class="pagetitle">
      <h1>Records</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item">Data</li>
          <li class="breadcrumb-item active">Records</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Records</h5>
              <!-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p> -->
              <?php if($_SESSION['role'] != 'admin') {?>
              <button type="button" class="btn btn-primary" name="btn_add_record" onclick="addRecord()"><i class="bi bi-folder-plus me-1"></i> Add Record</button>
              <?php }?>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>
                      Child <b>N</b>ame
                    </th>
                    <th>
                      Guardian <b>N</b>ame
                    </th>
                    <th>Address.</th>
                    <th>Sex</th>
                    <th data-type="date" data-format="YYYY/DD/MM">Birthdate</th>
                    <th>Age</th>
                    <th>Age in Mo.</th>
                    <!-- <th>Weight</th>
                    <th>Height</th>
                    <th>Weight Stat</th>
                    <th>Height Stat</th>
                    <th>Weight Ltht Stat</th> -->
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                        $isnotadmin = FALSE;
                        if($_SESSION['role'] != 'admin'){
                          $isnotadmin = TRUE;
                        } 

                        foreach($resdata as $key => $element) { 
                          $sex = ($element->sex == 1) ? 'F' : 'M';
                          $tr = "";
                          $tr = "<tr>".
                                   "<td>".$element->id_record."</td>".
                                   "<td>".$element->child_name."</td>".
                                   "<td>".$element->guardian_name."</td>".
                                   "<td>".$element->address."</td>".
                                   "<td>".$sex."</td>".
                                   "<td>".$element->birthdate."</td>".
                                   "<td>".$element->age."</td>". 
                                   "<td>".$element->age_in_months."</td>".
                                   "<td>";
                              if($isnotadmin){
                                $tr .= "<button type='button' class='btn btn-primary' id='edit' onclick='editRecord(".$element->id_record.")'><i class='bi bi-pencil-square'></i></button>";
                                $tr .= "<button type='button' class='btn btn-primary' id='edit' onclick='viewRecord(".$element->id_record.")'><i class='bi bi-info-circle'></i></button>";
                              }else{
                                $tr .= "<button type='button' class='btn btn-primary' id='edit' onclick='viewRecord(".$element->id_record.")'><i class='bi bi-info-circle'></i></button>";
                              }
                                $tr .= "</td></tr>";

                              echo $tr;
                               //  "<td>".$element->weight."</td>".
                               // "<td>".$element->height."</td>".
                               // "<td>".$element->weight_for_age_stat."</td>".
                               // "<td>".$element->height_for_age_stat."</td>".
                               // "<td>".$element->weight_for_ltht_stat."</td>".
                    } ?>
                  <!-- <tr>
                    <td>Kylie Bishop</td>
                    <td>3147</td>
                    <td>Norman</td>
                    <td>2005/09/08</td>
                    <td>63%</td>
                  </tr> -->
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <script type="text/javascript">

      function addRecord() {
        window.location.href = "addrecord";
      }

      function editRecord(id) {
        window.location.href = "editrecord/"+id;
      }

      function viewRecord(id) {
        window.location.href = "viewrecord/"+id;
      }
  </script>