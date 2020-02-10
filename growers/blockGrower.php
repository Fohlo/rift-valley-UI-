
<?php
session_start();
require_once('../models/models.php');
		$_SESSION['capnum'] = ((isset($_SESSION['capnum'])) ? $_SESSION['capnum'] : 0);
	$_SESSION['capnums'] = ((isset($_SESSION['capnums'])) ? $_SESSION['capnums'] : 0);
	$_SESSION['capnumsB'] = ((isset($_SESSION['capnumsB'])) ? $_SESSION['capnumsB'] : 0);
	
	$user = $_SESSION['username'][1];	
include('../back.php'); 
$gname = $_SESSION['capnum'];
$gno = $_SESSION['capnums'];
$user = $_SESSION['username'];
$gstatus = $_SESSION['capnumsB'];
	$user = $_SESSION['username'][1];	
$msg = "";
//echo htmlentities("Hie User:".$user[1]);
//echo htmlentities("Hie Grower No:".$gno);

//exit;
if($gno == "")
{
	//$gno = 'G000000';
	//$_SESSION['capnums'] = $gno;
	//echo htmlentities("Default GNo:".$gno);
	//exit;
	if($gno == "")
						{$gno = "G000000";}
	 $url = "Growers/GetGrower/$gno";    
	 list($grower_i2,$status)  = ApiConnect::Get($url); 
if ( $status == 200 ) {
	    $name = $grower_i2['CardName']; 
		if($name == "")
		{$name = "Enter the correct Grower Number!";}
$_SESSION['capnum'] = $name;
	   // echo "<script>alert('Zvaita');</script>";
	  //echo htmlentities($_SESSION['capnum']);
	  //exit;
		$gname = $_SESSION['capnum'];
$gno = $_SESSION['capnums'];
	}else{
$tm = $grower_i2['Message'];
	$ti = $grower_i2['ExceptionMessage'];
		$booking_id = json_encode($grower_i2, true);
		$error = "";//"Error: call to URL $url failed with status $status, response $booking_id";
	//	print($error);		
    $_SESSION['capnum'] = "Enter the correct Grower Number!";
		$_SESSION['capnums'] = "";
		$gname = $_SESSION['capnum'];
$gno = $_SESSION['capnums'];
		//echo htmlentities($error);
	}
	
}
//echo htmlentities($gname);
//echo htmlentities($gno);
if(isset($_POST['verifygrower'])){

// if(substr($_POST['grower_id'],0,1) === "G" || substr($_POST['grower_id'],0,1) === "g")
	// {
		// echo '<script type="text/javascript">alert("Enter Grower Name Correctly!!!")</script>';
		// //header('location:/rvc_dev/bookings/addBooking.php');
		// exit();
		
	// }
						$grower_id = $_POST['grower_id'];
						$_SESSION['capnums'] = $grower_id;
						if($grower_id == "")
						{$grower_id = "G000000";}
						$grower_id = substr($grower_id,1,6);
						$grower_id = "G".$grower_id;
   $url = "Growers/GetGrower/$user/$grower_id";    
   list($grower_i2,$status)  = ApiConnect::Get($url); 
if ( $status == 200 ) {
	    $name = $grower_i2['CardName']; 
		$gstatus = $grower_i2['U_GFlag']; 
		if($name == "")
		{$name = "Enter the correct Grower Number!";}
$_SESSION['capnum'] = $name;
$_SESSION['capnumsB'] = $gstatus;
	   // echo "<script>alert('Zvaita');</script>";
	  //echo htmlentities($_SESSION['capnum']);
	  //exit;
		$gname = $_SESSION['capnum'];
$gno = $_SESSION['capnums'];
	}else{
$tm = $grower_i2['Message'];
	$ti = $grower_i2['ExceptionMessage'];
		$booking_id = json_encode($grower_i2, true);
		$error = "Error: call to URL $url failed with status $status, response $booking_id";
	//	print($error);		
    $_SESSION['capnum'] = "Enter the correct Grower Number!";
		$_SESSION['capnums'] = "";
				$gname = $_SESSION['capnum'];
$gno = $_SESSION['capnums'];
		//echo htmlentities($error);
	}


}
if(isset($_POST['addbooking'])){

	
	
	
	$grower_id =$_POST['grower_id'];
	$comment =$_POST['comments'];
	
	 //public string GrowerID { get; set; }
      //  public string User { get; set; }
      //  public string Comment { get; set; }
	
	
	$data = '{
       		 "GrowerID": "'.$grower_id.'",
			 "User": "'.$user.'",
			 "Comment": "'.$comment.'"
			 
		
	}';

	$url = "Growers/Block/$user";    
	$content = json_encode($data);
	list($response,$status) = ApiConnect::Post($url,$content);
	if ( $status == 200 ) {
	    
		$msg = "Blocking of Grower Successful";

	}else{

$tm = $response['Message'];
	$ti = $response['ExceptionMessage'];
		$booking_id = json_encode($grower_i2, true);
		$error = "Error: call to URL $url failed with status $status, response $booking_id";
		
	}

	
//header("Location: /rvc_dev/bookings/index.php");
}
//echo htmlentities("Hie again Grower Name:".$gname);
//echo htmlentities("Hie again Grower No:".$gno);
//exit;
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
                                    <h2 class="title">Block Grower</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">Growers</a></li>
            							<li class="active">Block Grower</li>
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

        <form method="post" name = "Form" action="">
          <div class="card">
            <div class="card-header">
              <strong>Block Grower</strong>
              <a href="/rvc_dev/growers" class="btn btn-primary btn-sm pull-right"><i style="color:white;" class="fa fa-align-justify"></i>Growers</a>
			   <a href="/rvc_dev/index.php" class="btn btn-primary btn-sm pull-right"><i style="color:white;" class="fa fa-align-justify"></i>LOG OUT</a>
            </div>
              <div class="card-body">
				<?php //echo $error; ?>
               <!-- <div class="form-group">
                  <label for="remark">Remark</label>
                  <input type="text" class="form-control" name="remark" id="remark" placeholder="Enter your remarks" required>
                </div> -->
				<table>
			
				<tr>
				
                <td>
                  <strong><label for="delivery_day">Grower Number</label></strong>
                 
					 <strong><input type="text" class="form-control" name="grower_id" id="grower_id" value = "<?php echo htmlentities($gno);?>"  width = "500" maxlength = "8" required></strong>
                </div>
				</td>
				<td width = "1200">
				 <div class="form-group">
                  <strong><label for="no_bales">Name of Grower</label></strong>
                  <strong><input type="text" class="form-control" name="grower_name" id="grower_name" value ="<?php echo htmlentities($gname);?>" width = "500" maxlength = "32" ></strong>
                </div>
				</td>
				</tr>
				<tr>
				<td width = "1200">
				<div class="card-footer" align="left">
                <button type="submit" name="verifygrower" class="btn btn-sm btn-primary"><i class="fa fa-check"></i>Verify Grower</button>
                </div>
				</td>
			    <td width = "1200">
				<div class="form-group">
                  <strong><label for="no_bales">Grower Status</label></strong>
                  <strong><input type="text" class="form-control" name="gstatus" id="gstatus" value ="<?php echo htmlentities($_SESSION['capnumsB']);?>" width = "500" maxlength = "32" ></strong>
                </div>
				</td>
								</tr>
								<tr>
								<td width = "1200">
								<div class="form-group">
	<strong><label class="control-label col-md-3 col-sm-3 col-xs-12">Comments</label></strong>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<textarea class="form-control" name="comments" id="comments"  placeholder="Add Summary Comments" ></textarea>
	</div>
</div>
								</td>
								</tr>
				<tr>
				<td width = "1200">
              
              <div class="card-footer"  align="left">
							
                <button type="submit"  name="addbooking" class="btn btn-sm btn-primary"><i class="fa fa-check"></i>Block Grower</button>
                <a type="button" class="btn btn-default" title="Simulate Printing" name = "simulate" href="<?php echo $urlA;?>"><i class="fa fa-crosshairs"></i>Back</a>

              </div>
			  </td>
			  <td width = "1200">
			  </td>
			  </tr>
			  </table>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  <script>
  $( function() {
    $( "#datepicker1" ).datepicker();
  } );
  </script>
<script>
  $(document).ready(function(){
	  $("#grower_id").blur(function(){
	  $grower_n1 = $("#grower_id").val();
	  alert("The text has been changed." + $grower_n1);
	  const Url: "http://192.168.8.134:8444/api/Growers/GetGrower/$grower_n1";
	   $.ajax({
    type: "GET",
    url: Url,
    dataType: 'json',
	 async:false,
    success : function(result) {
		console.log(result);
alert(result);
      alert("Grower Name: " + result.CodeName );
    },
    error: function(error) {
		alert("Hie. Error.");
		console.log('Error ${error}');
      
    }
  });      
    
  });
});
</script>
<script type = "text/javascript">
	var dateControl = document.querySelector('input[type="date"]');
	dateControl.value = '2019-03-01';
	</script>
	<script type = "text/javascript">
	function cool(grower_n){
		alert(grower_n);
		var grower_n1 = document.getElementById(grower_n);
		alert("Grower Number is: " + grower_n1);
  $.ajax({
    url: "http://192.168.8.134:8444/api/Growers/GetGrower/$grower_n1",
	
	

	$url        = self::SERVER.$url;
            $curl       = curl_init($url);

    dataType: 'json',
    success: function(data) {
      alert("Grower Name: " + data.CodeName );
    },
    error: function() {
      alert("error");
    }
  });        
});
	
	</script>
	<script>
	function coolies(){
var x = "<?php echo $name; ?>";
};
</script>
<?php include('../scripts_a.php'); ?>
  </body>
</html>