<?php
session_start();
include('controller/controller.php');
include('../back.php'); 

?>
<!DOCTYPE html>
<html lang="en">
<?php include('../header_a.php'); ?>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <?php include('../includes/topbar.php');?>   
          <!-----End Top bar-->
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

<!-- ========== LEFT SIDEBAR ========== -->
<?php include('../includes/leftbar.php');?>                   
 <!-- /.left-sidebar -->
 <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Add Booking</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">Bookings</a></li>
            							<li class="active">Add Booking</li>
            						</ul>
                                </div>
                               
                            </div>
                            <!-- /.row -->
                        </div>

<!--container is supposed to go here-->
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> Edit Booking</div>
          <div class="card-body">

<a type="button" class="btn btn-danger" title="Simulate Printing" name = "simulate" href="<?php echo $urlA;?>"><i class="fa fa-crosshairs"></i>Back</a>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--end of container-->
</main>
</div>
 <?php include('../includes/footer.php');?>
    <!-- CoreUI and necessary plugins-->
    <script src="../public/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../public/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="../public/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../public/node_modules/pace-progress/pace.min.js"></script>
    <script src="../public/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="../public/node_modules/@coreui/coreui/dist/js/coreui.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="../public/node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="../public/node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js"></script>
    <script src="../public/js/main.js"></script>
    <?php include('../scripts_a.php'); ?>
  </body>
</html>