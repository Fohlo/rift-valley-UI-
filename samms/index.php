<?php
include('../redirect.php'); 
session_start();
include('../refresh.php'); 
require_once('../models/models.php');
include('../back.php'); 
$msg = "";
$error = "";
$msg = "";
$error = "";
$user = $_SESSION['username'][1];
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

	//$url = "http://192.168.8.134:8444/api/Samms";    
	$url = "Samms/$user";    
    //$content = $data;//

    list($booking_id,$status)  = ApiConnect::Get($url); 


	if ( $status == 200 ) {
	    $msg = "View Moisture Machines Successful!!!";
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
                                    <h2 class="title">View SAMMS</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">SAMMS</a></li>
            							<li class="active">Add SAMMS</li>
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
              
							<!-- Search Results -->
							<?php include('../partials/samms/sammsTable.php'); ?>
						</div>
				</div>
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> Moisture Content Configurations List</div>
          <div class="card-body">

<!--<a type="button" class="btn btn-danger" title="Simulate Printing" name = "simulate" href="<?php echo $urlA;?>"><i class="fa fa-crosshairs"></i>Back</a>-->

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
             
			    <th>Name</th>
                <th>Database</th>
                <th>Username</th>
                <th>Password</th>
				 <th>Server</th>
				  <th>Port</th>
                <!--<th align="center">Action</th>-->
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
			  <td><?php echo htmlentities($booking['U_Name']);?></td>
                <td><?php echo htmlentities($booking['U_Database']);?></td>
                <td><?php echo htmlentities($booking['U_Username']);?></td>
				<td><?php echo htmlentities($booking['U_Password']);?></td>
				<td><?php echo htmlentities($booking['U_Server']);?></td>
				<td><?php echo htmlentities($booking['U_Port']);?></td>
               
                <!--<td align="center">
                  <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <?php $booking_id = $booking['DocNum'];?>
                        <a href="/rvc_dev/bookings/details.php?id=<?php echo $booking_id;?>" class="btn btn-primary" tooltip="View More Details" title="View More Details" placement="top"><i style="color:white;" class="fa fa-align-justify"></i></a>
                        <a href="/rvc_dev/bookings/edit.php?id=<?php echo $booking_id;?>" class="btn btn-success"><i class="fa fa-pencil-square-o" tooltip="Edit Booking" title="Edit Booking" placement="top"></i></a>
                        <button type="button" class="btn btn-danger" title="Add Delivery"><i class="fa fa-crosshairs"></i></button>
                    </div>
                </td>-->
              </tr>
            <?php } ?>
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