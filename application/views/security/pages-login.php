<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="<?php echo base_url();?>assets/img/bnias_logo.png" alt="">
                  <span class="d-none d-lg-block">BNIAS</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>
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
                        <div class="spinner-border spinner-border-sm" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <?php echo $success['scsmsg']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      
                      <script type="text/javascript">
                        
                          var time = 2;
                          setInterval(function() {
                            var seconds = time % 60;
                            var minutes = (time - seconds) / 60;
                            if (seconds.toString().length == 1) {
                              seconds = "0" + seconds;
                            }
                            if (minutes.toString().length == 1) {
                              minutes = "0" + minutes;
                            }
                            time--;
                            if (time == 0) {
                              window.location.href = "Admin";
                            }
                          }, 1000);

                      </script>
                  <?php  } ?>

                  <form class="row g-3 needs-validation" novalidate action="<?php echo base_url();?>Security/login" method="post">
                    <div class="col-12">
                      <label for="yourRole" class="form-label">Select Role</label>
                      <div class="input-group has-validation">
                        <select class="form-select form-control" name="yourRole" id="yourRole">
                          <option value="1">Admin</option>
                          <option value="2">User</option>
                        </select>
                      </div>
                      <div class="invalid-feedback">Please select your role.</div>
                    </div>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                     <!--  <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div> -->
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <!-- <p class="small mb-0">Don't have account? <a href="<?php// echo base_url(); ?>Security/register">Create an account</a></p> -->
                    </div>
                  </form>

                </div>
              </div>

              <!-- <div class="credits"> -->
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div> -->

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->