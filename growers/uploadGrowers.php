<?php
include('../redirect.php'); 
session_start();
include('../refresh.php'); 
require_once('../models/models.php');
include('../back.php'); 

if(isset($_POST['upload'])){
//	$datafile = $_POST['fileToUpload'];
/* $target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOK = true ;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); */
 //echo "Hello";
 //{
 $fp = fopen($_FILES["filestoupload"]["tmp_name"], "rb");
    while ( ($line = fgets($fp)) !== false) {
		list($grower_id,$grower_name,$address,$city,$billtostate,$country,$mailcity,$phone1,$cellular,$emailaddress,$contactperson,$currency,$grower_size) = explode(",", $line);
		/*  echo "1-".$grower_id;
	echo "||";
	echo "2-".$grower_size;
	echo "||";
	echo "3-".$growername;
	echo "||";
	echo "4-".$delivery_date;
	echo "||";
	echo "5-".$selling_date;
	echo "6-".$grower_size; */
     // echo "$line<br>";
   
	
	//exit;
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
 //echo htmlentities($data);
//}
//exit;

list($response,$status)  = ApiConnect::Post($url,$content); 

	if ( $status == 200 ) {
	    
	  echo htmlentities($data);// echo "<script>alert('Zvaita');</script>";

	}else{

		$booking_id = json_encode($response, true);
$error = "Error: call to URL $url failed with status $status, response $booking_id";
print($error);
	}



}//exit;
 }
	
?>

<?php

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

	//$url = "http://192.168.8.134:8444/api/Bookings/GetTodayBookings";
	$url = "bookings/Active";    
	
list($booking_id,$status)  = ApiConnect::Get($url); 

	if ( $status == 200 ) {
	    
	   // echo "<script>alert('Zvaita');</script>";

	}else{

		$booking_id = json_encode($booking_id, true);
$error = "Error: call to URL $url failed with status $status, response $booking_id";
print($error);	}

	

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
            <i class="fa fa-align-justify"></i>Growers Files</div>
          <div class="card-body">

<a type="button" class="btn btn-danger" title="Simulate Printing" name = "simulate" href="<?php echo $urlA;?>"><i class="fa fa-crosshairs"></i>Back</a>

            <table class="table table-bordered table-sm">
          <thead>
              <tr>
			 
               
				 
                <th>Growers File</th>
                
                
                
               
              </tr>
          </thead>
          <tbody>
		 
           
              <tr>
			<!--  <td><a href="http://192.168.8.134:8444/api/Growers/gettodaysalesfile" class="btn btn-primary" tooltip="View More Details" title="View More Details" placement="top"><i style="color:white;" class="fa fa-align-justify"></i></a></td>-->

			 <td><form action='' method='post' enctype='multipart/form-data'>
Select Growers File To Upload :
<input type="file" name='filestoupload' value="Upload Files" />
<!--<input type="hidden" name="filestoupload" value="Upload Files" />-->
<button type="submit" name = "upload"> Upload </button>
</form></td>
                                                                               
               
              </tr>
           
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