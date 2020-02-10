<?php
include('../redirect.php'); 
include('../redirect.php'); 
include('../back.php'); 
require_once('../models/models.php');
session_start();
$username = $_SESSION['username'];
$useropts1 = "";
$useropts2 = "";
$useropts3 = "";
$x =0;
$d =0;
$roles = "";
$rl = "";
$rl1 = "";
$rvalues[] = "";
$msg = "";
$error = "";

	
		$_SESSION['capnum'] = ((isset($_SESSION['capnum'])) ? $_SESSION['capnum'] : 0);
	$_SESSION['capnums'] = ((isset($_SESSION['capnums'])) ? $_SESSION['capnums'] : 0);
	

	

if(isset($_POST['addbooking'])){
$d = 0;

	   
	 
	//$username = $_POST['username'];
	$guid = 12345;
	$password = $_POST['password'];
	$roleid = 1;
	$isactive = "YES";
	
	
	

	
	
	$data = '{
	"U_Username": "'.$username[1].'",
	"U_Guid": "'.$guid.'",
	"U_Password": "'.$password.'",
	"U_RoleId": "'.$roleid.'",
	"U_IsActive": "'.$isactive.'"
       
    
        
		
	}';
$url = "Users/ChangePassword";   
	    
	$content = json_encode($data);
  list($response,$status) = ApiConnect::Post($url,$content);
  print_r($status);

//echo "<script>alert('Password Changed Successfully!!!');</script>";
	if ( $status == 200 ) {
	    $msg = "Password Changed Successfully!!!";
	   // echo "<script>alert('Zvaita');</script>";
	  //echo htmlentities($response);

	}else{

    $booking_id = json_encode($response, true);
    $error = "Error: call to URL $url failed with status $status, response $booking_id";
    
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
                                    <h2 class="title">Change Password</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">Profile</a></li>
            							<li class="active">Change Password</li>
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
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
        <form method="post" action="">
          <div class="card">
            <div class="card-header">
              <strong>Change Password</strong>
              <a href="/rvc_dev/index.php" class="btn btn-primary btn-sm pull-right"><i style="color:white;" class="fa fa-align-justify"></i>LOG OUT</a>
            </div>
              <div class="card-body">
		
				<table>
				<tr>
				
				<td width = "1200">
				 <div class="form-group">
                  <strong><label for="roledescription">Enter New Password</label></strong>
                  <strong><input type="text" class="form-control" name="password" id="roledescription"  width = "500"></strong>
                </div>
				</td>
				</tr>
				
				
				

<tr>
				<td width = "1200">
              
              <div class="card-footer"  align="left">
                <button type="submit" name="addbooking" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
               
<a type="button" class="btn btn-danger" title="Simulate Printing" name = "simulate" href="<?php echo $urlA;?>"><i class="fa fa-check"></i>Back</a>

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
	function cool(grower_n){
		alert(grower_n);
		var grower_n1 = document.getElementById(grower_n);
		alert("Grower Number is: " + grower_n1);
  $.ajax({
    url: "http://192.168.8.134:8444/api/Growers/GetGrower/$grower_n1",
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