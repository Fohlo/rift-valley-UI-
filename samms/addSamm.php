<?php
include('../redirect.php'); 
session_start();
include('../refresh.php'); 
require_once('../models/models.php');
include('../back.php'); 

$name = '';
	$moisturefile = '';
	$curl = '';
$error = '';
$msg = "";
$error = "";
$user = $_SESSION['username'][1];

if(isset($_POST['addSamm'])){
	
	$name = $_POST['name'];
	$moisturefile = $_POST['moisturefile'];
	
$moisturefile = str_replace("\\","||",$moisturefile);
	//$data = '{

		//"DocEntry":0,
        //"U_GrowerId": $grower_id,
        //"U_BaleNo": $no_bales,
        //"U_SellingDy":$selling_day,
		
//	}';

$data = '{
        "DocNum":1,
        "U_Name":"'.$name.'",
        "U_MoistureFile":"'.$moisturefile.'",
    }';

//	$url = "http://192.168.8.134:8444/api/Samms";    
	$content = json_encode($data);
  $url = "Samms/$user";    
  //$content = $data;//

  list($delivery_id,$status)  = ApiConnect::Post($url,$content); 


if ( $status == 200 ) {
    
//  echo "<script>alert('Delivery Successfully Added!!!');</script>";

}else{
      $tm = $delivery_id['Message'];
  $ti = $delivery_id['ExceptionMessage'];
      $delivery_id = json_encode($delivery_id, true);
  $error = "Error: call to URL $url failed with status $status, response $delivery_id";
  //die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
  //var_dump($error);
      //echo htmlentities($error);
      $delivery_id = json_decode($delivery_id, true);

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
                                    <h2 class="title">Add New Moisture Content Settings</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">Moisture Content Settings</a></li>
            							<li class="active">Add New Moisture Content Settings</li>
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
              <strong>Add New Moisture Content Settings</strong>
              <a href="/rvc_dev/samms" class="btn btn-primary btn-sm pull-right"><i style="color:white;" class="fa fa-align-justify"></i> All SAMMS</a>
            </div>
              <div class="card-body">
			  
<!--<a type="button" class="btn btn-danger" title="Simulate Printing" name = "simulate" href="<?php echo $urlA;?>"><i class="fa fa-crosshairs"></i>Back</a>-->

				<?php echo $error; ?>
                <div class="form-group">
                  <label for="name">Machine Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                  <label for="moisturefile">Moisture File Path</label>
				  <input type="text" class="form-control" name="moisturefile" id="moisturefile" placeholder="Enter Moisture Content file path" required>
                  
                </div>
              
              </div>
              <div class="card-footer" align="right">
                <button type="submit" name="addSamm" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
                <button type="reset" class="btn btn-sm btn-danger">Reset <i class="fa fa-repeat"></i></button>
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