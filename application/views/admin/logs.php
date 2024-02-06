<main id="main" class="main">

    <div class="pagetitle">
      <h1>Logs</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
          <li class="breadcrumb-item active">Logs</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Logs</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Responsible</th>
                    <th>Role</th>
                    <th>Process</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($logs as $key => $element) { 
                    echo "<tr>".
                             "<td>".$element->user_id."</td>".
                             "<td>".$element->username."</td>".
                             "<td>".$element->role."</td>".
                             "<td>".$element->process."</td>".
                             "<td>".$element->date."</td>".
                          "</tr>";
                    } ?>
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