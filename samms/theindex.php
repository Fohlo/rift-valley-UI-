<?php
include('../redirect.php'); 
session_start();
include('../refresh.php'); 
include('../back.php'); 

//if(isset($_POST['addbooking'])){
	
	//$grower_id = $_POST['grower_id'];
	//$no_bales = $_POST['no_bales'];
	//$selling_day =$_POST['selling_day'];

	$data = '{

		"DocEntry":0,
        "U_GrowerId": $grower_id,
        "U_BaleNo": $no_bales,
        "U_SellingDy":$selling_day,
		
	}';

	$url = "http://192.168.8.134:8444/api/Samms";    
  $url = "Samms";    
  //$content = $data;//

  list($booking_id,$status)  = ApiConnect::Get($url); 


if ( $status == 200 ) {
    
//  echo "<script>alert('Delivery Successfully Added!!!');</script>";

}else{
      $booking_id = json_encode($booking_id, true);
  $error = "Error: call to URL $url failed with status $status, response $booking_id";
  //die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
  //var_dump($error);
      //echo htmlentities($error);
      $booking_id = json_decode($booking_id, true);
  $tm = $booking_id['Message'];
  $ti = $booking_id['ExceptionMessage'];
}

//}

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
            <i class="fa fa-align-justify"></i> Moisture Content Configurations List</div>
          <div class="card-body">

<a type="button" class="btn btn-danger" title="Simulate Printing" name = "simulate" href="<?php echo $urlA;?>"><i class="fa fa-crosshairs"></i>Back</a>

            <table class="table table-bordered table-sm">
          <thead>
              <tr>
			    <th>Doc Num</th>
                <th>Name</th>
                <th>Moisture File Path</th>
               
                
              </tr>
          </thead>
          <tbody>
		 
            <?php  
            foreach($booking_id as $booking)
              {//echo $booking;
			//  var_dump($result);
			  //var_dump($booking_id);
//echo htmlentities($booking_id);
                ?>
              <tr>
			  <td><?php echo htmlentities($booking['DocNum']);?></td>
                <td><?php echo htmlentities($booking['U_Name']);?></td>
                <td><?php echo htmlentities($booking['U_MoistureFile']);?></td>
               
                
              </tr>
            <?php } ?>
          </tbody>
        </table>

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