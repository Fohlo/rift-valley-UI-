<?php
include('../redirect.php'); 
session_start();
include('../refresh.php'); 
include('../back.php'); 
$msg = "";
$error = "";
$user = $_SESSION['username'][1];
if(isset($_POST['upload'])){
//	$datafile = $_POST['fileToUpload'];
/* $target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOK = true ;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); */
 //echo "Hello";
 
 $fp = fopen($_FILES["filestoupload"]["tmp_name"], "rb");
    while ( ($line = fgets($fp)) !== false) {
      echo "$line<br>";
    }
	exit;
// Check if file already exists
if (file_exists($target_file)) {
echo "Sorry, file already exists.";
$uploadOK = false ;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] < 5000000) {
 echo "Sorry, your file is too large.";
 $uploadOK = false ;
}
 
// Allow only image&nbsp; file formats
if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg"
&& $FileType != "gif" ) {
echo "Sorry, only JPG, JPEG, PNG &amp; GIF files are allowed.";
$uploadOK = false;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOK == false) {
echo "Sorry, your file was not uploaded due to the issues listed";
// if everything is ok, try to upload file
} else {
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
} else {
echo "Sorry, there was some issue while uploading your file.";
}
}
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
	$url = "http://192.168.8.134:8444/api/bookings/Active";    
	$content = "";//$data;//json_encode($data1);

		$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($curl, CURLOPT_HTTPHEADER,array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, false);
	//curl_setopt($curl,CURLOPT_POSTFIELDS, $content);

curl_setopt($curl, CURLOPT_ENCODING,  '');
	curl_setopt($curl,	CURLOPT_AUTOREFERER,true);
	curl_setopt($curl,	CURLOPT_COOKIESESSION,true);
	curl_setopt($curl,	CURLOPT_FAILONERROR,false);
	curl_setopt($curl,	CURLOPT_FOLLOWLOCATION,false);
	curl_setopt($curl,	CURLOPT_FRESH_CONNECT,true);
	curl_setopt($curl,	CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl,	CURLOPT_CONNECTTIMEOUT,30);
	$result = curl_exec($curl);

	$booking_id = json_decode($result, true);
//var_dump($result);
//echo htmlentities($booking_id);
//exit;
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	if ( $status == 200 ) {
	    
	   // echo "<script>alert('Zvaita');</script>";

	}else{
$tm = $booking_id['Message'];
		$ti = $booking_id['ExceptionMessage'];
		$error = "Error: call to URL $url failed with status $status, response $result, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl);
		//die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
	}

	curl_close($curl);

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
                                    <h2 class="title">Upload Grade</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">Grades</a></li>
            							<li class="active">Upload Grade</li>
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



<!--container is supposed to go here-->
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i>Grades Files</div>
          <div class="card-body">

<a type="button" class="btn btn-outline-primary" title="Simulate Printing" name = "simulate" href="<?php echo $urlA;?>"><i class="fa fa-crosshairs"></i>Back</a>

            <table class="table table-bordered table-sm">
          <thead>
              <tr>
			 
                			 
                <th>Grades File</th>
                
                
                
               
              </tr>
          </thead>
          <tbody>
		 
           
              <tr>
			<!--  <td><a href="http://192.168.8.134:8444/api/bookings/gettodaysalesfile" class="btn btn-primary" tooltip="View More Details" title="View More Details" placement="top"><i style="color:white;" class="fa fa-align-justify"></i></a></td>-->

			 <td><form action='' method='post' enctype='multipart/form-data'>
Select Grades File To Upload :
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