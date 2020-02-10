<?php
include('../redirect.php'); 
session_start();
include('../refresh.php'); 
require_once('../models/models.php');
$error = '';
$url = "grades";    
$content = "";//json_encode($data1);
include('../back.php'); 
$msg = "";
$error = "";
$user = $_SESSION['username'][1];
list($grower_i,$status)  = ApiConnect::Get($url); 

if(isset($_POST['addSeason'])){
	
	$position = $_POST['position'];
	$quality = $_POST['quality'];
	$colour =$_POST['colour'];
	$factor =$_POST['factor'];
	$minprice =$_POST['minprice'];
	$maxprice =$_POST['maxprice'];
	$description =$_POST['description'];
	$gradetype =$_POST['gradetype'];
	

	

$data =   '{
        "DocNum": 1,
        "U_Position": "'.$position.'",
        "U_Quality": "'.$quality.'",
        "U_Colour": "'.$colour.'",
        "U_Factor": "'.$factor.'",
        "U_Company": "NT",
        "U_MinPrice": "'.$minprice.'",
        "U_MaxPrice": "'.$maxprice.'",
        "U_Description": "'.$description.'",
        "U_GradeType": "'.$gradetype.'"
    }';

  $url = "grades/$user";  
  $content = json_encode($data);  
	list($response,$status) = ApiConnect::Post($url,$content);
	if ( $status == 200 ) {
	    
	   // echo "<script>alert('Zvaita');</script>";

	}else{
        		$tm = $response['Message'];
		$ti = $response['ExceptionMessage'];
		$booking_id = json_encode($response, true);
$error = "Error: call to URL $url failed with status $status, response $booking_id";
print($error);	}



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
                                    <h2 class="title">Add Grade</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">Grades</a></li>
            							<li class="active">Add Grade</li>
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
              <strong>Add New Grade</strong>
               <a href="/rvc_dev/index.php" class="btn btn-primary btn-sm pull-right"><i style="color:white;" class="fa fa-align-justify"></i>LOG OUT</a>
            </div>
              <div class="card-body">
			  
<a type="button" class="btn btn-outline-primary" title="Simulate Printing" name = "simulate" href="<?php echo $urlA;?>"><i class="fa fa-crosshairs"></i>Back</a>

				<?php echo $error; ?>
                <div class="form-group">
                  <label for="name">Position</label>
                 <select class="form-control" id="position" name="position">
				<?php echo (isset($farmervisits)?$farmervisits->farmingstage:'--Please Select--');?></option>
					<option value="1.0">1.0</option>
					<option value="2.0">2.0</option>
					<option value="3.0">3.0</option>
					
				</select>
                </div>
                <div class="form-group">
                  <label for="squality">Quality</label>
                  <input type="quality" class="form-control" name="quality" required>
                </div>
                <div class="form-group">
                  <label for="colour">Colour</label>
                 <input type="colour" class="form-control" name="colour" required>
                </div>
                <div class="form-group">
                  <label for="factor">Factor</label>
                				<select class="form-control" id="factor" name="factor">
				<?php echo (isset($farmervisits)?$farmervisits->farmingstage:'--Please Select--');?></option>
				<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
				</select>
                </div>
				 <div class="form-group">
                  <label for="factor">Minimum Price</label>
                <input type="minprice" class="form-control" name="minprice" required>
                </div>
				
				 <div class="form-group">
                  <label for="factor">Maximum Price</label>
                				<input type="maxprice" class="form-control" name="maxprice" required>
                </div>
				<div class="form-group">
                  <label for="factor">Description</label>
                				<input type="description" class="form-control" name="description" required>
                </div>
				  <div class="form-group">
                  <label for="factor">Grade Type</label>
                				<select class="form-control" id="gradetype" name="gradetype">
				<?php echo (isset($farmervisits)?$farmervisits->farmingstage:'--Please Select--');?></option>
				<option value="Internal">Internal</option>
					<option value="National">National</option>
					
				</select>
                </div>
              </div>
              <div class="card-footer" align="right">
                <button type="submit" name="addSeason" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
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