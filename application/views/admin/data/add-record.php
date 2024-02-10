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
              <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
                A simple danger alert—check it out!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div> -->

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
                  <select class="form-select" aria-label="Default select example" name="inputSex" id="inputSex" onchange="$.sexChange()" required>
                    <option value="1">Female</option>
                    <option value="2" selected>Male</option>
                  </select>
                  <div class="invalid-feedback">Please enter sex</div>
                </div>

                <div class="col-md-6">
                  <label for="inputDate" class="form-label">Birthdate</label>
                  <input type="date" class="form-control" name="inputDate" id="inputDate" max="<?php echo date("Y-m-d"); ?>" onchange="$.ageCalculator()" required>
                  <div class="invalid-feedback">Please enter birthdate</div>
                </div>

                <div class="col-md-4">
                  <label for="inputAge" class="form-label">Age</label>
                  <input readonly type="text" class="form-control" name="inputAge" id="inputAge">
                </div>
                <div class="col-md-4">
                  <label for="inputA" class="form-label">Age in Months</label>
                  <input readonly type="number" class="form-control" name="inputA" id="inputA">
                </div>
                <div class="col-md-4">
                  <label for="inputD" class="form-label">Weight for Lt/Ht Status</label>
                  <input readonly type="text" class="form-control" name="inputD" id="inputD" required>
                </div>

                <div class="col-md-6">
                  <label for="inputWeight" class="form-label">Weight (kg)</label>
                  <input type="number" step="any" class="form-control" name="inputWeight" id="inputWeight" oninput="$.getWeightStatus()" required>
                  <div class="invalid-feedback">Please enter weight (kg)</div>
                </div>
                <div class="col-md-6">
                  <label for="inputHeight" class="form-label">Height (cm)</label>
                  <input type="number" step="any" class="form-control" name="inputHeight" id="inputHeight" oninput="$.getHeightStatus()" required>
                  <div class="invalid-feedback">Please enter height (cm)</div>
                </div>
                
                
                <div class="col-md-6">
                  <label for="inputB" class="form-label">Weight for Age Status</label>
                  <input readonly type="text" class="form-control" name="inputB" id="inputB" required>
                </div>
                <div class="col-md-6">
                  <label for="inputC" class="form-label">Height for Age Status</label>
                  <input readonly type="text" class="form-control" name="inputC" id="inputC" required>
                </div>
                
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                      Agree to give consent for child's personal information?
                    </label>
                    <div class="invalid-feedback">
                      You must agree before submitting.
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" onclick="$.back()">Back</button>
                  </div>
                </div>

                <!-- <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fas fa-cloud-upload-alt"></i> Upload Photo
                    <input class="form-control" type="file" name="file_upload[]" id="file_upload" accept=".docx, .pdf, .xlsx, .csv" multiple required>
                  </div> -->
                   <!--  <p class="help-block">Max. </p> -->
              </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <script type="text/javascript">

(function ($) {
    'use strict';

    var heightData = "";
    var weightData = "";
    var weightLengthData = "";
    var setMonthAge = "";
    var setSex = "";

    $(".alert").delay(4000).slideUp(300, function() {
        $(this).alert('close');
    });

    $.ageCalculator = function() {

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

        setMonthAge = document.getElementById("inputA").value;
        setSex = document.getElementById("inputSex").value;
        if(setMonthAge){
           $.setHeightStatus(setMonthAge, setSex);
           $.setWeightStatus(setMonthAge, setSex);
        }
    }

    $.back = function() {
        window.location = "./records";
    }

    $.sexChange = function() {

        document.getElementById("inputB").value = "";
        document.getElementById("inputC").value = "";
        document.getElementById("inputD").value = "";
        document.getElementById("inputWeight").value = "";
        document.getElementById("inputHeight").value = "";

        setMonthAge = document.getElementById("inputA").value;
        setSex = document.getElementById("inputSex").value;
        if(setMonthAge){
           $.setHeightStatus(setMonthAge, setSex);
           $.setWeightStatus(setMonthAge, setSex);
        }
    }

    $.getHeightStatus = function (){

        let setHeight = document.getElementById("inputHeight").value;
        var issetDate = document.getElementById("inputDate").value;
        if(issetDate && heightData && setHeight){

          let severelyStunted = heightData[0].severely_stunted;
          let stuntedFrom     = heightData[0].stunted_from;
          let stuntedTo       = heightData[0].stunted_to;
          let normalFrom      = heightData[0].normal_from;
          let normalTo        = heightData[0].normal_to;
          let tall            = heightData[0].tall;
    
          if(setHeight && setHeight >= severelyStunted && setHeight <= tall){

            if(setHeight <= severelyStunted){
              document.getElementById("inputC").value = "Severely Stunted";
            }
            if(setHeight >= stuntedFrom && setHeight <= stuntedTo){
              document.getElementById("inputC").value = "Stunted";
            }
            if(setHeight >= normalFrom && setHeight <= normalTo){
              document.getElementById("inputC").value = "Normal";
            }
            if(setHeight >= tall){
              document.getElementById("inputC").value = "Tall";
            }
          }else{
            document.getElementById("inputC").value = "";
            console.log('Height out of range.');
          }

          $.setWeightLength(setMonthAge, setHeight);
          if(weightLengthData){
            $.getWeightLength();
          }else {
            console.log("A problem on getting weight length.");
          }
    }else{
      console.log('Birthdate or height not set.');
      alert("Birthdate or height not set.");
    }
  }

  $.getWeightStatus = function (){

        let setHeight = document.getElementById("inputHeight").value;
        let setWeight = document.getElementById("inputWeight").value;
        var issetDate = document.getElementById("inputDate").value;
        if(issetDate && weightData && setWeight){

          let severelyUnderweight = weightData[0].sev_underweight;
          let underweight_from    = weightData[0].under_from;
          let underweight_to      = weightData[0].under_to;
          let normalFrom          = weightData[0].normal_from;
          let normalTo            = weightData[0].normal_to;

          if(setWeight && setWeight >= severelyUnderweight && setWeight <= normalTo){
            if(setWeight <= severelyUnderweight){
              document.getElementById("inputB").value = "Severely Under Weight";
            }
            if(setWeight >= underweight_from && setWeight <= underweight_to){
              document.getElementById("inputB").value = "Under Weight";
            }
            if(setWeight >= normalFrom && setWeight <= normalTo){
              document.getElementById("inputB").value = "Normal";
            }
          }else{
            document.getElementById("inputB").value = "";
            console.log('Weight out of range.');
          }
            
        }else{
          document.getElementById("inputB").value = "";
          console.log("Birthdate or weight not set.");
        }

        if(setHeight){
          $.setWeightLength(setMonthAge, setHeight);
          if(weightLengthData){
            $.getWeightLength();
          }else {
            console.log("A problem on getting weight length.");
          }
        }
    }

    $.getWeightLength = function (){

      let setWeight = document.getElementById("inputWeight").value;
      var issetDate = document.getElementById("inputDate").value;
      let setHeight = document.getElementById("inputWeight").value;

      if(issetDate && weightLengthData && setWeight && setHeight){

          let severely_wasted    = weightLengthData[0].severely_wasted;
          let wasted_from        = weightLengthData[0].wasted_from;
          let wasted_to          = weightLengthData[0].wasted_to;
          let normal_from        = weightLengthData[0].normal_from;
          let normal_to          = weightLengthData[0].normal_to;
          let overweight_from    = weightLengthData[0].overweight_from;
          let overweight_to      = weightLengthData[0].overweight_to;
          let obese              = weightLengthData[0].obese;

          if(setWeight && setWeight >= severely_wasted && setWeight <= obese){

            if(setWeight <= severely_wasted){
              document.getElementById("inputD").value = "Severely Wasted";
            }
            if(setWeight >= wasted_from && setWeight <= wasted_to){
              document.getElementById("inputD").value = "Wasted";
            }
            if(setWeight >= normal_from && setWeight <= normal_to){
              document.getElementById("inputD").value = "Normal";
            }
            if(setWeight >= overweight_from && setWeight <= overweight_to){
              document.getElementById("inputD").value = "Overweight";
            }
            if(setWeight >= obese){
              document.getElementById("inputD").value = "Obese";
            }

          }else{
            document.getElementById("inputD").value = "";
            console.log('Weight Length out of range.');
          }

      }else {
          document.getElementById("inputD").value = "";
          console.log("Birth date, Weight, Height not set.");
      }
    }

    $.setHeightStatus = function(monthAge, sex){
      if(monthAge <= 71){
        $.ajax({
            url: '../Admin/heightStatus/'+sex+'/'+monthAge,
            headers: {'X-Requested-With':'XMLHttpRequest'},
            method: 'GET',
            async: true,
            dataType: 'json',
            success: function(response){
              if(response.success){
                heightData = response.data;
                console.log(heightData);
              }      
            },
            error: function(xhr){
              console.log(xhr.status +':'+xhr.statusText);
            }
          });
      }else{
         heightData = "";
      }
    }

      $.setWeightStatus = function(monthAge, sex){
        if(monthAge <= 71){
          $.ajax({
              url: '../Admin/weightStatus/'+sex+'/'+monthAge,
              headers: {'X-Requested-With':'XMLHttpRequest'},
              method: 'GET',
              async: true,
              dataType: 'json',
              success: function(response){
                if(response.success){
                  weightData = response.data;
                  console.log(weightData);
                }      
              },
              error: function(xhr){
                console.log(xhr.status +':'+xhr.statusText);
              }
            });
        }else{
           weightData = "";
        }
      }

      $.setWeightLength = function(monthAge, height){

        if(monthAge <= 71){
          $.ajax({
              url: '../Admin/weightlength/'+monthAge+'/'+height,
              headers: {'X-Requested-With':'XMLHttpRequest'},
              method: 'GET',
              async: true,
              dataType: 'json',
              success: function(response){
                if(response.success){
                  weightLengthData = response.data;
                  console.log(weightLengthData);
                }      
              },
              error: function(xhr){
                console.log(xhr.status +':'+xhr.statusText);
              }
            });
        }else{
           weightLengthData = "";
        }
      }

})(jQuery);
  </script>