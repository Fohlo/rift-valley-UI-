<?php
include('../redirect.php'); 
session_start();
require_once('../models/models.php');
include('../refresh.php'); 
include('../back.php'); 

$error = '';
	  $msg = "";
$error = "";
$user = $_SESSION['username'][1];

if(isset($_POST['addSeason'])){
	
	$sdate = $_POST['sdate'];
	$edate = $_POST['edate'];
	$sname =$_POST['sname'];
	$croptype =$_POST['croptype'];

	$data = '{
"DocNum": 3,
"U_SDate": "'.$sdate.'",
"U_EDate": "'.$edate.'",
"U_Name": "'.$sname.'",
"U_CropType": "'.$croptype.'"
}';

	//$url = "http://192.168.8.134:8444/api/Seasons";    
	$content = json_encode($data);
	//$content = $data;
	$url = "Seasons/$user";    
    //$content = $data;//

    list($booking_id,$status)  = ApiConnect::Post($url,$content); 


	if ( $status == 200 ) {
	    
	//  echo "<script>alert('Delivery Successfully Added!!!');</script>";

	}else{
        $tm = $booking_id['Message'];
		$ti = $booking_id['ExceptionMessage'];
        $booking_id = json_encode($booking_id, true);
		$error = "Error: call to URL $url failed with status $status, response $booking_id";
		//die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
		//var_dump($error);
        //echo htmlentities($error);
        $booking_id = json_decode($booking_id, true);
		
	}

}
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
                                    <h2 class="title">Add New Season</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">Seasons</a></li>
            							<li class="active">Add New Season</li>
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
            <?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Status!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo '<tr>
                    <th style="border: 2px solid; padding:1px; font-size:14px; font-weight:normal; text-align: left;" width="20%">'.$tm.'</th>
					
				
                    <th style="border: 2px solid; padding:1px; font-size:14px; font-weight:normal; text-align: left;" width="20%">'.$ti.'</th>
					
					</tr>'; ?>
                                        </div>
                                        <?php } ?>
        <form method="post" action="">
          <div class="card">
            <div class="card-header">
              <strong>Add New Season</strong>
              <a href="/rvc_dev/seasons" class="btn btn-primary btn-sm pull-right"><i style="color:white;" class="fa fa-align-justify"></i>View Seasons</a>
            </div>
              <div class="card-body">
			  
<!--<a type="button" class="btn btn-danger" title="Simulate Printing" name = "simulate" href="<?php echo $urlA;?>"><i class="fa fa-crosshairs"></i>Back</a>-->

				<?php echo $error; ?>
                <div class="form-group">
                  <label for="name">Season Name</label>
                 <select class="form-control" id="sname" name="sname">
				<?php echo (isset($farmervisits)?$farmervisits->farmingstage:'--Please Select--');?></option>
					<option value="2016-2017">2016-2017</option>
					<option value="2017-2018">2017-2018</option>
					<option value="2018-2019">2018-2019</option>
					<option value="2019-2020">2019-2020</option>
					<option value="2020-2021">2020-2021</option>
					<option value="2021-2022">2021-2022</option>
					<option value="2022-2023">2022-2023</option>
					<option value="2023-2024">2023-2024</option>
					<option value="2024-2025">2024-2025</option>
					<option value="2025-2026">2025-2026</option>
					<option value="2026-2027">2026-2027</option>
					<option value="2027-2028">2027-2028</option>
					<option value="2028-2029">2028-2029</option>
					<option value="2029-2030">2029-2030</option>
					<option value="2030-2031">2030-2031</option>
					<option value="2031-2032">2031-2032</option>
					<option value="2032-2033">2032-2033</option>
					<option value="2033-2034">2033-2034</option>
					<option value="2034-2035">2034-2035</option>
					<option value="2035-2036">2035-2036</option>
					<option value="2036-2037">2036-2037</option>
					<option value="2037-2038">2037-2038</option>
					<option value="2038-2039">2038-2039</option>
					<option value="2039-2040">2039-2040</option>
					
				</select>
                </div>
                <div class="form-group">
                  <label for="sdate">Start Date</label>
                  <input type="date" class="form-control" name="sdate" required>
                </div>
                <div class="form-group">
                  <label for="no_bales">End Date</label>
                 <input type="date" class="form-control" name="edate" required>
                </div>
                <div class="form-group">
                  <label for="selling_day">Crop Type</label>
                				<select class="form-control" id="croptype" name="croptype">
				<?php echo (isset($farmervisits)?$farmervisits->farmingstage:'--Please Select--');?></option>
				<option value="Maize">Maize</option>
				<option value="Seed Maize">Seed Maize</option>
				
					<option value="Soya Beans">Soya Beans</option>
					
					<option value="Barley">Barley</option>
					
					<option value="Wheat">Wheat</option>
					
					<option value="Paprika">Paprika</option>
					
					<option value="Potatoes">Potatoes</option>
					
					<option value="Tobacco">Tobacco</option>
				</select>
                </div>
              </div>
              <div class="card-footer" align="right">
                <button type="submit" name="addSeason" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
                
              </div>
            </div>
          </form>
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