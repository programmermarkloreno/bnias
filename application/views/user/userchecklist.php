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
              <?php
                    if($error['err'] != ''){
                ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $error['errmsg']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php
                  } elseif ($success['scs'] != '') { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <?php echo $success['scsmsg']; ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php  } ?>
                <div id="alert" class="" role="alert">
                </div>
              <!-- General Form Elements -->
              <form id="userform" class="needs-validation" action="<?php echo base_url();?>Admin/userchecklist" method="post" enctype="multipart/form-data" validate>
                <!-- <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Text</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control">
                  </div>
                </div> -->
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="userfile" id="userfile" accept=".csv, .xlsx">
                    <div class="invalid-feedback">Please enter height (cm)</div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Upload</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->
              <h5 class="card-title">My Files</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Filename</th>
                    <th>Status</th>
                    <th>Ratings</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($files != NULL) {
                    foreach($files as $key => $element) { 
                      echo "<tr>".
                               "<td>".$element->filename."</td>".
                               "<td>".$element->status."</td>".
                               "<td>".$element->ratings."</td>".
                               "<td>".$element->created_date."</td>".
                               "<td>".$element->update_date."</td>".
                            "</tr>";
                      } 
                  }
                  ?>
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
(function ($) {
    'use strict';

    $(".alert").delay(4000).slideUp(300, function() { $(this).alert('close'); });
    // var d = document.getElementById("alert");
    // $('#userform').on('submit', function (e) {
    //       e.preventDefault();

    //       $.ajax({
    //         url: '../Admin/userchecklist',
    //         type: "POST",
    //         data: new FormData(this),
    //         processData: false,
    //         contentType: false,
    //         async: true,
    //         dataType: 'json',
    //         success: function(response){
    //           if(response.success){

    //             d.className += " alert alert-success alert-dismissible fade show";
    //             d.innerHTML += "Successfully upload.";
    //             $(".alert").delay(4000).slideUp(300, function() { $(this).alert('close'); });
    //               // window.top.location = base+'home/maintenance/company-logo/true';
    //           }else{

    //             d.className += " alert alert-info alert-dismissible fade show";
    //             d.innerHTML += response.res;
    //             $(".alert").delay(4000).slideUp(300, function() { $(this).alert('close'); });
    //           }
    //         },
    //          error: function(xhr){
    //             d.className += " alert alert-danger alert-dismissible fade show";
    //             d.innerHTML += xhr.status+': '+xhr.statusText;
    //             $(".alert").delay(4000).slideUp(300, function() { $(this).alert('close'); });
    //         }
   
    //    });
    // });
})(jQuery);
  </script>