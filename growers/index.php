<?php
include('../redirect.php'); 
session_start();
include('../refresh.php'); 
require_once('../models/models.php');
//if(isset($_POST['addbooking'])){
  $msg = "";
  $error = "";
  $searchText = (isset($_POST['search-text'])) ? $_POST['search-text'] : '';
  $user = $_SESSION['username'][1];
	//$grower_id = $_POST['grower_id'];
	//$no_bales = $_POST['no_bales'];
	//$selling_day =$_POST['selling_day'];
include('../back.php'); 
if(isset($_POST['seasongrowers'])){
	$data = '{

		"DocEntry":0,
        "U_GrowerId": $grower_id,
        "U_GType": $no_bales,
        "U_Scale":$selling_day,
		
	}';

	//$url = "http://192.168.8.134:8444/api/Bookings/GetTodayBookings";
	//$url = "http://192.168.8.134:8444/api/growers"; 
	$url = "growers/GetGrowers/$user";
//$url = "https://rivdb:50000/b1s/v1/BusinessPartners";	

list($booking_id,$status)  = ApiConnect::Get($url); 

if ( $status == 200 ) {
  $msg = "Successful!!!";
}else{
$tm = $booking_id['Message'];
	$ti = $booking_id['ExceptionMessage'];
		$booking_id = json_encode($booking_id, true);
		$error = "Error: call to URL $url failed with status $status, response $booking_id";
		print($error);	

	

}
}
if(isset($_POST['searchgrname'])){
	

	$data = '{

		"DocEntry":0,
        "U_GrowerId": $grower_id,
        "U_BaleNo": $no_bales,
        "U_SellingDy":$selling_day,
		
	}';

	$growername = $_POST['searchgr1'];
	$growername = strtoupper($growername);
	
$url = "Growers/GetGrowerName/$user/$growername";   
list($booking_id,$status)  = ApiConnect::Get($url); 

	


if ( $status == 200 ) {
  $msg = "Successful!!!";
}
else{
    $tm = $booking_id['Message'];
	$ti = $booking_id['ExceptionMessage'];
$result = json_encode($booking_id);
		$error = "Error: call to URL $url failed with status $status, response $result";



//$i =$i + 1;
}
}
if(isset($_POST['searchgrno'])){

	//$gno = 'G000000';
	//$_SESSION['capnums'] = $gno;
	//echo htmlentities("Default GNo:".$gno);
	//exit;
	//if($gno == "")
		//				{$gno = "G000000";}
		$gno = $_POST['searchgr1'];
	 $url = "Growers/GetGrower/$user/$gno";   
	 list($booking_id,$status)  = ApiConnect::Get($url); 

if ( $status == 200 ) {
	   $msg = "Successful!!!";
	}
  else{
      $tm = $booking_id['Message'];
	$ti = $booking_id['ExceptionMessage'];
    $result = json_encode($booking_id);
        $error = "Error: call to URL $url failed with status $status, response $result";
        //die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        //echo htmlentities($error);
    //exit;
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
                                    <h2 class="title">View Growers</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">Growers</a></li>
            							<li class="active">View Growers</li>
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

							<!-- Search Area -->
							<?php include('../partials/growers/search.php'); ?>

							<!-- Search Results -->
							<?php include('../partials/growers/growersTable.php'); ?>
						</div>
				</div>
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> Growers List</div>
          <div class="card-body">
 <table class="table table-bordered table-sm">
		 
					 <tr>
					 <form method="post" action="">
					 <td>
					  
					 <input type="text" name="searchgr1" value="V" />
					 </td>
					 <td>
					<input type="submit"  class="btn btn-primary btn-sm" name="searchgrno" value="Search By Grower Number" />
					
					
					
					 </td>
					
					 <td><input type="submit" name="searchgrname" class = "btn btn-primary btn-sm"value="Search By Grower Name" /></td>
					 <td><input type="submit" name="seasongrowers" class = "btn btn-primary btn-sm"value="Search All Growers" /></td>
					 
					  </form>
					  <td><a type="button" class="btn btn-outline-primary btn-sm" title="Simulate Printing" name = "simulate" href="<?php echo $urlA;?>"><i class="fa fa-crosshairs"></i>Back</a></td>
					  </tr>
					  </table>


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
<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
              <tr bgcolor = "blue">
			 
              <th>Grower Number</th>
			   <th>Grower Name</th>
			   <th>National ID</th>
			   <th>Bank</th>
			   <th>Account Number</th>
                <th>Grower Size</th>
              
                <th>Address</th>
                <th>Town</th>
				<th>Registration Status</th>
           <th>Grower Status</th>
		   <th>Yield Estimate</th>
                
                <th align="center">Action</th>
              </tr>
          </thead>
          <tbody>
		 
            <?php 
if(isset($booking_id))
{			
            foreach($booking_id as $booking)
              {//echo $booking;
			//  var_dump($result);
			//  var_dump($booking_id);
//echo htmlentities($booking_id);
                ?>
              <tr>
			 <td><?php echo htmlentities($booking_id['CardForeignName']);?></td>
			 <td><?php echo htmlentities($booking_id['CardName']);?></td>
			 <td><?php echo htmlentities($booking_id['Password']);?></td>
			 <td><?php echo htmlentities($booking_id['U_FCABANK']);?></td>
			 <td><?php echo htmlentities($booking_id['U_FCAACCOUNT']);?></td>
			 
                <td><?php echo htmlentities($booking_id['U_GrowerSize']);?></td>
               
                <td><?php echo htmlentities($booking_id['Address']);?></td>
                <td><?php echo htmlentities($booking_id['City']);?></td>
                <td><?php echo htmlentities($booking_id['U_GrowerStatus']);?></td>
				<td><?php echo htmlentities($booking_id['U_GFlag']);?></td>
				<td><?php echo htmlentities($booking_id['U_YieldEstimate']);?></td>
                <td align="center">
                  <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                           <button type="button" class="btn btn-danger" title="View Grower"><i class="fa fa-crosshairs"></i></button>
                    </div>
                </td>
              </tr>
            <?php }} ?>
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
 <?php include('../includes/footer.php');?>
    <!-- CoreUI and necessary plugins-->

    <?php include('../scripts_a.php'); ?>
  </body>
</html>