<?php
session_start();
$error = '';
$url = "creditors";    
$content = "";//json_encode($data1);
include('../back.php'); 
require_once('../models/models.php');
$msg = "";
$msg = "";
$error = "";
$user = $_SESSION['username'][1];
$error = "";
list($grower_i,$status) = ApiConnect::Get($url);



if(isset($_POST['addSeason'])){
	
	$priority = $_POST['priority'];
	$crno = $_POST['crno'];
	$crtype = $_POST['crtype'];
	$isactive = $_POST['isactive'];

	
$data = '{
        "DocNum": 3,
        "U_Priority": "'.$priority.'",
        "U_CreditorNumber": "'.$crno.'",       
        "U_CreditorType": "'.$crtype.'",
		"U_OldCreditorType": "'.$crtype.'",
		"U_IsActive": '.$isactive.'
       
    }';

	$url = "creditors/$user";    
	$content = json_encode($data);
	
  list($response,$status) = ApiConnect::Get($url);

	if ( $status == 200 ) {
	    
	   $msg = "Creditor Added Successfully!!!";

	}else{
          $tm = $response['Message'];
  $ti = $response['ExceptionMessage'];
$result = json_encode($response);
		$error = "Error: call to URL $url failed with status $status, response $result";
		//die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
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
                                    <h2 class="title">Add New Creditor</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">Creditors</a></li>
            							<li class="active">Add New Creditor</li>
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
              <strong>Add New Creditor</strong>
               <a href="/rvc_dev/creditors" class="btn btn-primary btn-sm pull-right"><i style="color:white;" class="fa fa-align-justify"></i>View Creditors</a>
            </div>
              <div class="card-body">
				<?php echo $error; ?>
                <div class="form-group">
                  <label for="name">Priority</label>
                 <select class="form-control" id="priority" name="priority">
				<?php echo (isset($farmervisits)?$farmervisits->farmingstage:'--Please Select--');?></option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					
					
				</select>
                </div>
                <div class="form-group">
                  <label for="sdate">Creditor No</label>
                  <input type="text" class="form-control" name="crno" required>
                </div>
                <div class="form-group">
                  <label for="no_bales">Creditor Type</label>
                 <select class="form-control" id="crtype" name="crtype">
				<?php echo (isset($farmervisits)?$farmervisits->farmingstage:'--Please Select--');?></option>
					<option value="StopOrder">StopOrder</option>
					<option value="Invoice">Invoice</option>
					<option value="Other">Other</option>
					
					
				</select>
				</div>
              <div class="form-group">
                  <label for="name">Is Active?</label>
                 <select class="form-control" id="isactive" name="isactive">
				<?php echo (isset($farmervisits)?$farmervisits->farmingstage:'--Please Select--');?></option>
					<option value="1">True</option>
					<option value="0">False</option>
					
					
					
				</select>
                </div>
              </div>
              <div class="card-footer" align="right">
                <button type="submit" name="addSeason" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
                
<!--<a type="button" class="btn btn-danger" title="Simulate Printing" name = "simulate" href="<?php echo $urlA;?>"><i class="fa fa-crosshairs"></i>Back</a>-->

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