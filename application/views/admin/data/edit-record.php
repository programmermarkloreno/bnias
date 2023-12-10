 <main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Record</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Data</li>
          <li class="breadcrumb-item active">Edit Record</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Record</h5>
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

              <?php
                if(!$error['err'] != ''){
              ?>
              <!-- General Form Elements -->
              <form class="row g-3 needs-validation" novalidate action="<?php echo base_url();?>Admin/record/submit" method="post">
                <div class="col-md-6">
                  <label for="inputChildName" class="form-label">Child Full name</label>
                  <input type="text" class="form-control" name="inputChildName" id="inputChildName" value="<?php echo $resdata[0]->child_name ?>" required>
                  <div class="invalid-feedback">Please enter child full name</div>
                </div>
                <div class="col-md-6">
                  <label for="inputGuardianName" class="form-label">Guardian Full name</label>
                  <input type="text" class="form-control" name="inputGuardianName" id="inputGuardianName" value="<?php echo $resdata[0]->guardian_name ?>" required>
                  <div class="invalid-feedback">Please enter guardian full name</div>
                </div>
                <div class="col-md-12">
                  <label for="inputAddress" class="form-label">Address</label>
                  <input type="text" class="form-control" name="inputAddress" id="inputAddress" value="<?php echo $resdata[0]->address ?>" required>
                  <div class="invalid-feedback">Please enter address</div>
                </div>

                <div class="col-md-6">
                  <label for="inputSex" class="form-label">Sex</label>
                  <select class="form-select" aria-label="Default select example" name="inputSex" id="inputSex" value="<?php echo $resdata[0]->sex ?>"required>
                    <option value="1">Female</option>
                    <option value="2" selected>Male</option>
                  </select>
                  <div class="invalid-feedback">Please enter sex</div>
                </div>

                <div class="col-md-6">
                  <label for="inputDate" class="col-sm-2 col-form-label">Birthdate</label>
                  <input type="date" class="form-control" name="inputDate" id="inputDate" onchange="ageCalculator()" value="<?php echo $resdata[0]->birthdate ?>"required>
                  <div class="invalid-feedback">Please enter birthdate</div>
                </div>
                
                <div class="col-md-4">
                  <label for="inputWeight" class="form-label">Weight (kg)</label>
                  <input type="number" class="form-control" name="inputWeight" id="inputWeight" value="<?php echo $resdata[0]->weight ?>"required>
                  <div class="invalid-feedback">Please enter weight (kg)</div>
                </div>
                <div class="col-md-4">
                  <label for="inputHeight" class="form-label">Height (cm)</label>
                  <input type="number" class="form-control" name="inputHeight" id="inputHeight" value="<?php echo $resdata[0]->height ?>"required>
                  <div class="invalid-feedback">Please enter height (cm)</div>
                </div>
                <div class="col-md-4">
                  <label for="inputAge" class="form-label">Age</label>
                  <input type="text" class="form-control" name="inputAge" id="inputAge" value="<?php echo $resdata[0]->age ?>">
                </div>

                <div class="col-md-6">
                  <label for="inputA" class="form-label">Age in Months</label>
                  <input type="number" class="form-control" name="inputA" id="inputA" value="<?php echo $resdata[0]->age_in_months ?>">
                </div>
                <div class="col-md-6">
                  <label for="inputB" class="form-label">Weight for Age Status</label>
                  <input type="text" class="form-control" name="inputB" id="inputB" value="<?php echo $resdata[0]->weight_for_age_stat ?>">
                </div>
                <div class="col-md-6">
                  <label for="inputC" class="form-label">Height for Age Status</label>
                  <input type="text" class="form-control" name="inputC" id="inputC" value="<?php echo $resdata[0]->height_for_age_stat ?>">
                </div>
                <div class="col-md-6">
                  <label for="inputD" class="form-label">Weight for Lt/Ht Status</label>
                  <input type="text" class="form-control" name="inputD" id="inputD" value="<?php echo $resdata[0]->weight_for_ltht_stat ?>">
                </div>

                <div class="col-md-12">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->
              <?php  } ?>
              
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <script type="text/javascript">
    function ageCalculator() {

        var userinput = document.getElementById("inputDate").value;
        var dob = new Date(userinput);
        var month_diff = Date.now() - dob.getTime();
        var age_dt = new Date(month_diff); 
        var year = age_dt.getUTCFullYear();
        var age = Math.abs(year - 1970);

        const today = new Date();
        const diffInMonths = (today.getFullYear() - dob.getFullYear()) * 12 + (today.getMonth() - dob.getMonth());

        document.getElementById("inputAge").value =  age;
        document.getElementById("inputA").value =  diffInMonths;
    }
  </script>