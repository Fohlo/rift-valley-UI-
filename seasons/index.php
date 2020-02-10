<?php
include('../redirect.php');
session_start();
require_once('../models/models.php');
include('../refresh.php');
include('../back.php');

$msg = "";
$error = "";
$msg = "";
$error = "";
$user = $_SESSION['username'][1];
$url = "Seasons/GetCurrent/Tobacco";


list($seasons, $status)  = ApiConnect::Get($url);

// var_dump($seasons);
// die();
if ($status == 200) {
  $msg      = "Successful!!!";
} else {
  $tm       = $seasons['Message'];
  $ti       = $seasons['ExceptionMessage'];
  $seasons  = json_encode($seasons, true);
  $error    = "Error: call to URL $url failed with status $status, response $seasons";
  $seasons  = json_decode($seasons, true);
}

//}

?>
<!DOCTYPE html>
<html lang="en">
<?php include('../header_a.php'); ?>

<body class="top-navbar-fixed">
  <div class="main-wrapper">

    <!-- ========== TOP NAVBAR ========== -->
    <?php include('../includes/topbar.php'); ?>
    <!-----End Top bar-->
    <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
    <div class="content-wrapper">
      <div class="content-container">

        <!-- ========== LEFT SIDEBAR ========== -->
        <?php include('../includes/leftbar.php'); ?>
        <!-- /.left-sidebar -->
        <div class="main-page">
          <div class="container-fluid">
            <div class="row page-title-div">
              <div class="col-md-6">
                <h2 class="title">View Seasons</h2>
              </div>
            </div>
            <!-- /.row -->
            <div class="row breadcrumb-div">
              <div class="col-md-6">
                <ul class="breadcrumb">
                  <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                  <li><a href="#">Seasons</a></li>
                  <li class="active">View Seasons</li>
                </ul>
              </div>
            </div>
            <!-- /.row -->
          </div>

          <!--container is supposed to go here-->
          <section class="section">
						<div class="container-fluid">
							<!-- Alerts -->
              <?php include('../alerts.php'); ?>
              
							<!-- Search Results -->
							<?php include('../partials/seasons/seasonsTable.php'); ?>
						</div>
				</div>
          <div class="container-fluid">
            <div class="animated fadeIn">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> Seasons List</div>
                    <div class="card-body">
                      <?php if ($msg) { ?>
                        <div class="alert alert-success left-icon-alert" role="alert">
                          <strong>Status!</strong><?php echo htmlentities($msg); ?>
                        </div><?php } else if ($error) { ?>
                        <div class="alert alert-danger left-icon-alert" role="alert">
                          <strong>Oh snap!</strong> 
                          <?php echo '
                          <tr>
                            <th style="border: 2px solid; padding:1px; font-size:14px; font-weight:normal; text-align: left;" width="20%">' . $tm . '</th>
                            <th style="border: 2px solid; padding:1px; font-size:14px; font-weight:normal; text-align: left;" width="20%">' . $ti . '</th>
                          </tr>'; 
                          ?>
                        </div>
                      <?php } ?>
                      <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Season Name</th>
                            <th>Crop Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          if (isset($seasons)) {
                            // foreach ($seasons as $season) { 
                              ?>
                              <tr>
                                <td>
                                  <a href="<?php echo $seasons['DocNum']; ?>">
                                    <i class="fa fa-circle"></i>
                                    <?php echo $seasons['U_Name']; ?>
                                  </a>
                                </td>
                                <td><?php echo htmlentities($seasons['U_CropType']); ?></td>
                                <td><?php echo date('d M Y', strtotime($seasons['U_SDate'])); ?></td>
                                <td><?php echo date('d M Y', strtotime($seasons['U_EDate'])); ?></td>
                              </tr>
                              <?php
                            // }
                          } 
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                 </section>
                </div>
              </div>
            </div>
          </div>

          <!--end of container-->
          </main>
        </div>
        <?php include('../includes/footer.php'); ?>
        <!-- CoreUI and necessary plugins-->

        <?php include('../scripts_a.php'); ?>
</body>

</html>