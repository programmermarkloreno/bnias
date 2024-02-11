<main id="main" class="main">

    <div class="pagetitle">
      <h1>Ratings</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item">Checklist</li>
          <li class="breadcrumb-item active">Ratings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              <!-- General Form Elements -->
              <?php if($ratings == NULL) {?>
              <h5 class="card-title">Ratings</h5>
              <form class="needs-validation" novalidate action="<?php echo base_url();?>Admin/insertRatings" method="post">
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <input type="hidden" name="docs_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">
                    <input type="hidden" name="user_id" value="<?php echo $this->uri->segment(3); ?>" class="form-control">
                  </div>
                </div>
                
                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">No Ratings Yet?</label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Rate User</button>
                    </div>
                  </div>
                <?php }?>

              </form><!-- End General Form Elements -->

              <h5 class="card-title">User Ratings</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th></th>
                    <th>Description</th>
                    <th>Target Rating</th>
                    <th>Performance Rating</th>
                    <th>Updated At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($ratings != NULL) {

                    $finalscore = 0;
                    foreach($ratings as $key => $element) { 
                      echo "<tr>".
                               "<td>".$element->letter."</td>".
                               "<td>".$element->description."</td>".
                               "<td>100%</td>".
                               "<td>".$element->perf_rating."%</td>".
                               "<td>".$element->updated_at."</td>".
                               "<td><button type='button' class='btn btn-primary' id='edit' onclick='viewRecord(".$element->user_id.",".$element->docs_id.",".$element->rate_id.")'><i class='bi bi-pencil'></i></button></td>".
                            "</tr>";
                            $finalscore = $finalscore + $element->perf_rating;
                      }
                      // $height = round($height / 0.5) * 0.5;
                      $finalscore = round($finalscore / 7) * 1;
                      echo "<tr>".
                               "<td></td>".
                               "<td></td>".
                               "<td><b>Final Score</b></td>".
                               "<td>".$finalscore."%</td>".
                               "<td></td>".
                               "<td></td>".
                            "</tr>";

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
<input type="hidden" value="<?php echo base_url() ?>" id="base">
<script type="text/javascript">
      var baseurl = document.getElementById("base");
      function viewRecord(userid, docsid, rateid) {
        window.location.href = baseurl.value+"Admin/editratings/"+userid+"/"+docsid+"/"+rateid;
      }


  </script>