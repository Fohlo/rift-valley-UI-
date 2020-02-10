<?php
session_start();
include('../redirect.php'); 
include('../refresh.php'); 
require_once('../models/models.php');
include('../back.php'); 
$msg = "";
$error = "";
$msg = "";
$error = "";
$searchText = (isset($_POST['search-text'])) ? $_POST['search-text'] : '';
$user = $_SESSION['username'][1];
	$data = '{

		"DocEntry":0,
        "U_GrowerId": $grower_id,
        "U_BaleNo": $no_bales,
        "U_SellingDy":$selling_day,
		
	}';

	$url = "Grades/Get/Internal/$user";    
  list($booking_id,$status) = ApiConnect::Get($url);

	if ( $status == 200 ) {
	    $msg = "View Grades Successful!!!";
	   // echo "<script>alert('Zvaita');</script>";

	}else{
        		$tm = $booking_id['Message'];
//		$ti = $booking_id['ExceptionMessage'];
$result = json_encode($booking_id);
		$error = "Error: call to URL $url failed with status $status, response $result";
    //die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    
   // $booking_id = json_decode($booking_id, true);

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
                                    <h2 class="title">View Grades</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">Grades</a></li>
            							<li class="active">View Grades</li>
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
							<?php include('../partials/grades/search.php'); ?>
							<!-- Search Results -->
              <?php include('../partials/grades/gradesTable.php'); ?>
          </div>
        </div>
      </div>
      </section>
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