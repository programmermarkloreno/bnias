<main id="main" class="main">

    <div class="pagetitle">
      <h1>Checklist</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item active">Checklist</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Checklist</h5>
              <!-- List group With Checkboxes and radios -->
              <!-- <ul class="list-group">
                <li class="list-group-item">
                  <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                  First checkbox
                </li>
                <li class="list-group-item">
                  <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                  Second checkbox
                </li>
                <li class="list-group-item">
                  <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                  Third checkbox
                </li>
                <li class="list-group-item">
                  <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                  Fourth checkbox
                </li>
                <li class="list-group-item">
                  <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                  Fifth checkbox
                </li>
              </ul> --><!-- End List Checkboxes and radios -->
              <!-- General Form Elements -->
              <form class="needs-validation" novalidate action="<?php echo base_url();?>Admin/checklist" method="post">
                <!-- <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Text</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control">
                  </div>
                </div> -->

                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Users</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="selectUser" id="selectUser" required>
                      <option selected>Select User</option>
                      <?php
                        if($users != NULL) {
                          foreach($users as $key => $element) { 
                              echo "<option value='".$element->userId."'>".$element->name."</option>";
                           }
                         }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Show Files per User</label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Show</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

              <h5 class="card-title">Files</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Filename</th>
                    <!-- <th>Status</th> -->
                    <th>Ratings</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($files != NULL) {

                    foreach($files as $key => $element) { 
                      $rating =  round((int)$element->ratings / 7) * 1;
                      echo "<tr>".
                               "<td>".$element->filename."</td>".
                               "<td>".$rating."%</td>".
                               "<td>".$element->created_date."</td>".
                               "<td>".$element->update_date."</td>".
                               "<td><button type='button' class='btn btn-primary' id='edit' onclick='viewRecord(".$element->userId.",".$element->id.")'><i class='bi bi-view-stacked'></i></button>
                                  <a type='button' href='".site_url($element->file_path)."' class='btn btn-info'><i class='bi bi-cloud-download'></i></a></td>".
                            "</tr>";
                      } 
                  }
                  ?>
                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
<script type="text/javascript">

      function viewRecord(userid, docsid) {
        window.location.href = "ratings/"+userid+"/"+docsid;
      }
  </script>