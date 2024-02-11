<main id="main" class="main">

    <div class="pagetitle">
      <h1>Ratings</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item">Checklist</li>
          <li class="breadcrumb-item">Ratings</li>
          <li class="breadcrumb-item active">Update Ratings</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $ratings[0]->letter.". ".$ratings[0]->description; ?></h5>

              <!-- General Form Elements -->
              <form class="needs-validation" novalidate action="<?php echo base_url();?>Admin/updateRatings" method="post">
                <div class="row mb-3">
                  <div class="col-sm-10">    
                    <input type="hidden" name="user_id" value="<?php echo $this->uri->segment(3); ?>" class="form-control">
                    <input type="hidden" name="docs_id" value="<?php echo $this->uri->segment(4); ?>" class="form-control">
                    <input type="hidden" name="rate_id" value="<?php echo $this->uri->segment(5); ?>" class="form-control">
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label for="inputRating" class="col-sm-2 col-form-label">Rating</label>
                  <div class="col-sm-10">
                    <input class="form-control" min="0" max="100" type="number" name="inputRating" id="inputRating" required>
                    <div class="invalid-feedback">Please enter rate between 0-100</div>
                  </div>
                </div>

                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </div>
                

              </form><!-- End General Form Elements -->
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
<script type="text/javascript">

  </script>