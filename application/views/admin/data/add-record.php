 <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Record</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Data</li>
          <li class="breadcrumb-item active">Add Record</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Record</h5>
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
              <!-- General Form Elements -->
              <form class="row g-3 needs-validation" novalidate action="<?php echo base_url();?>Admin/record/submit" method="post">
                <div class="col-md-6">
                  <label for="inputChildName" class="form-label">Child Full name</label>
                  <input type="text" class="form-control" name="inputChildName" id="inputChildName" required>
                  <div class="invalid-feedback">Please enter child full name</div>
                </div>
                <div class="col-md-6">
                  <label for="inputGuardianName" class="form-label">Guardian Full name</label>
                  <input type="text" class="form-control" name="inputGuardianName" id="inputGuardianName" required>
                  <div class="invalid-feedback">Please enter guardian full name</div>
                </div>
                <div class="col-md-12">
                  <label for="inputAddress" class="form-label">Address</label>
                  <input type="text" class="form-control" name="inputAddress" id="inputAddress" required>
                  <div class="invalid-feedback">Please enter address</div>
                </div>

                <div class="col-md-6">
                  <label for="inputSex" class="form-label">Sex</label>
                  <select class="form-select" aria-label="Default select example" name="inputSex" id="inputSex" required>
                    <option value="1">Female</option>
                    <option value="2" selected>Male</option>
                  </select>
                  <div class="invalid-feedback">Please enter sex</div>
                </div>

                <div class="col-md-6">
                  <label for="inputDate" class="col-sm-2 col-form-label">Birthdate</label>
                  <input type="date" class="form-control" name="inputDate" id="inputDate" onchange="ageCalculator()" required>
                  <div class="invalid-feedback">Please enter birthdate</div>
                </div>
                
                <div class="col-md-4">
                  <label for="inputWeight" class="form-label">Weight (kg)</label>
                  <input type="number" class="form-control" name="inputWeight" id="inputWeight" required>
                  <div class="invalid-feedback">Please enter weight (kg)</div>
                </div>
                <div class="col-md-4">
                  <label for="inputHeight" class="form-label">Height (cm)</label>
                  <input type="number" class="form-control" name="inputHeight" id="inputHeight" required>
                  <div class="invalid-feedback">Please enter height (cm)</div>
                </div>
                <div class="col-md-4">
                  <label for="inputAge" class="form-label">Age</label>
                  <input readonly type="text" class="form-control" name="inputAge" id="inputAge">
                </div>

                <div class="col-md-6">
                  <label for="inputA" class="form-label">Age in Months</label>
                  <input readonly type="number" class="form-control" name="inputA" id="inputA">
                </div>
                <div class="col-md-6">
                  <label for="inputB" class="form-label">Weight for Age Status</label>
                  <input readonly type="text" class="form-control" name="inputB" id="inputB" value="N">
                </div>
                <div class="col-md-6">
                  <label for="inputC" class="form-label">Height for Age Status</label>
                  <input readonly type="text" class="form-control" name="inputC" id="inputC" value="N">
                </div>
                <div class="col-md-6">
                  <label for="inputD" class="form-label">Weight for Lt/Ht Status</label>
                  <input readonly type="text" class="form-control" name="inputD" id="inputD" value="Ob">
                </div>

                <div class="col-md-12">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" onclick="back()">Back</button>
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

    function back() {
        window.location = "./records";
    }
  </script>