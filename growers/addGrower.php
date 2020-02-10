<?php
include('../redirect.php'); 
session_start();
include('../refresh.php'); 
require_once('../models/models.php');
$user = $_SESSION['username'][1];
$error = '';
$url = "growers";    

list($grower_i,$status)  = ApiConnect::Get($url); 

curl_close($curl);

if(isset($_POST['addbooking'])){
	
	$grower_id = $_POST['grower_id'];
	$grower_name = $_POST['grower_name'];
	//$delivery_date =$_POST['delivery_date'];
	//$selling_date =$_POST['selling_date'];
	$grower_size =$_POST['grower_size'];
	
	$data = '{
		"CardCode": "'.$grower_id.'",
		"CardName":"'.$grower_name.'",
		"CardForeignName": "'.$grower_id.'",
		"CardType": "C",
		"Address": "'.$address.'",
		"City": "'.$city.'",
		
		"Country": "'.$country.'",
		"MailCity": "'.$mailcity.'",
        "Phone1": "'.$phone1.'",
        "Cellular": "'.$cellular.'",
		"EmailAddress": "'.$emailaddress.'",
            
        "Currency": "'.$currency.'",        
        "U_GrowerId": "'.$grower_id.'",
        "U_GType": "NTGrower",
        
		 "U_GFlag": "None",
		 "U_Scale": "'.$grower_size.'"
		
	}';

	$url = "growers";    
	$content = json_encode($data);
  list($response,$status) = ApiConnect::Post($url,$content);

	if ( $status == 200 ) {
	    
	  echo htmlentities($data);// echo "<script>alert('Zvaita');</script>";

	}else{

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
        <form method="post" action="">
          <div class="card">
            <div class="card-header">
              <strong>Add New Grower</strong>
              <a href="/rvc_dev/index.php" class="btn btn-primary btn-sm pull-right"><i style="color:white;" class="fa fa-align-justify"></i>LOG OUT</a>
            </div>
              <div class="card-body">
			 
<a type="button" class="btn btn-danger" title="Simulate Printing" name = "simulate" href="<?php echo $urlA;?>"><i class="fa fa-crosshairs"></i>Back</a>

				<?php echo $error; ?>
                
                <div class="form-group">
                  <label for="grower_id">Grower ID#</label>
                  <input type="text" class="form-control" name="grower_id" id="grower_id" placeholder="Enter Grower ID" required>
                </div>
				 <div class="form-group">
                  <label for="grower_id">Grower Name</label>
                  <input type="text" class="form-control" name="grower_name" id="grower_name" placeholder="Enter Grower Name" required>
                </div>
				 <div class="form-group">
                  <label for="grower_id">Grower Size</label>
                  <select id="grower_size" name="grower_size" class="form-control selectpicker">
					
					<option value="SMALL SCALE">SMALL SCALE</option>
					<option value="COMMERCIAL">COMMERCIAL</option>
					
                  </select>
                </div>
               
              </div>
              <div class="card-footer" align="right">
                <button type="submit" name="addbooking" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
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