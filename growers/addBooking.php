<!-- <!doctype html>
<html>
<head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<script type="text/javascript">

function Redirect() {
               window.location="addBooking.php";
            }

		

    function validateForm()
    {

			

        var a=document.forms["Form"]["delivery_date"].value;
				var b=document.forms["Form"]["grower_id"].value;
        var c=document.forms["Form"]["total_bales"].value;
        var d=document.forms["Form"]["selling_date"].value;
				var e=document.forms["Form"]["grower_name"].value;
      

        if (a==""  || c =="" || d == "")
        {
            alert("Fill in All details Please");

            setTimeout('Redirect()', 0);
						Exit();	

            return false;
        }

else {
	swal("Success");
            
}


    }
</script>
</body>
</html> -->




<?php
session_start();
	
		$_SESSION['capnum'] = ((isset($_SESSION['capnum'])) ? $_SESSION['capnum'] : 0);
	$_SESSION['capnums'] = ((isset($_SESSION['capnums'])) ? $_SESSION['capnums'] : 0);
	$_SESSION['capnumsB'] = ((isset($_SESSION['capnumsB'])) ? $_SESSION['capnumsB'] : 0);
	
	
include('../back.php'); 
$gname = $_SESSION['capnum'];
$gno = $_SESSION['capnums'];
$user = $_SESSION['username'];
$gstatus = $_SESSION['capnumsB'];
//echo htmlentities("Hie User:".$user[1]);
//echo htmlentities("Hie Grower No:".$gno);
$tm = "";
$ti = "";

//exit;
if($gno == "")
{
	//$gno = 'G000000';
	//$_SESSION['capnums'] = $gno;
	//echo htmlentities("Default GNo:".$gno);
	//exit;
	if($gno == "")
						{$gno = "G000000";}
	 $url = "http://192.168.8.134:8444/api/Growers/GetGrower/$gno";    
$contenta = "";//json_encode($data1);

$curla = curl_init($url);
curl_setopt($curla, CURLOPT_HEADER, false);
curl_setopt($curla, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curla, CURLOPT_HTTPHEADER,array("Content-type: application/json"));
curl_setopt($curla, CURLOPT_POST, false);
curl_setopt($curla, CURLOPT_ENCODING,  '');
curl_setopt($curla,	CURLOPT_AUTOREFERER,true);
curl_setopt($curla,	CURLOPT_COOKIESESSION,true);
curl_setopt($curla,	CURLOPT_FAILONERROR,false);
curl_setopt($curla,	CURLOPT_FOLLOWLOCATION,false);
curl_setopt($curla,	CURLOPT_FRESH_CONNECT,true);
curl_setopt($curla,	CURLOPT_RETURNTRANSFER,true);
curl_setopt($curla,	CURLOPT_CONNECTTIMEOUT,30);
$growers = curl_exec($curla);

$grower_i2 = json_decode($growers, true);

//echo htmlentities($grower_i);
//exit;

$status = curl_getinfo($curla, CURLINFO_HTTP_CODE);
//echo htmlentities($grower_i2);
//echo htmlentities($name);
//exit;
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

		$error = "Error: call to URL $url failed with status $status, response $result, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl);
		//die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
		$_SESSION['capnum'] = "Enter the correct Grower Number!";
		$_SESSION['capnums'] = "";
		$gname = $_SESSION['capnum'];
$gno = $_SESSION['capnums'];
		//echo htmlentities($error);
	}

	curl_close($curla);
	
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
   $url = "http://192.168.8.134:8444/api/Growers/GetGrower/$grower_id";    
$contenta = "";//json_encode($data1);

$curla = curl_init($url);
curl_setopt($curla, CURLOPT_HEADER, false);
curl_setopt($curla, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curla, CURLOPT_HTTPHEADER,array("Content-type: application/json"));
curl_setopt($curla, CURLOPT_POST, false);
curl_setopt($curla, CURLOPT_ENCODING,  '');
curl_setopt($curla,	CURLOPT_AUTOREFERER,true);
curl_setopt($curla,	CURLOPT_COOKIESESSION,true);
curl_setopt($curla,	CURLOPT_FAILONERROR,false);
curl_setopt($curla,	CURLOPT_FOLLOWLOCATION,false);
curl_setopt($curla,	CURLOPT_FRESH_CONNECT,true);
curl_setopt($curla,	CURLOPT_RETURNTRANSFER,true);
curl_setopt($curla,	CURLOPT_CONNECTTIMEOUT,30);
$growers = curl_exec($curla);

$grower_i2 = json_decode($growers, true);
//echo htmlentities($grower_i);
//exit;

//if($name == null)
//{$_SESSION['capnum'] = "Enter the correct Grower number!";
		//$_SESSION['capnums'] = "";
	//	}
$status = curl_getinfo($curla, CURLINFO_HTTP_CODE);
//echo htmlentities($grower_i2);
//echo htmlentities($name);
//exit;
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

		$error = "Error: call to URL $url failed with status $status curl_error " . curl_error($curla) . ", curl_errno " . curl_errno($curla);
		//die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
		$_SESSION['capnum'] = "Enter the correct Grower Number!";
		$_SESSION['capnums'] = "";
				$gname = $_SESSION['capnum'];
$gno = $_SESSION['capnums'];
		//echo htmlentities($error);
	}

	curl_close($curla);
}
if(isset($_POST['addbooking'])){

	
	if($_POST['total_bales'] === "" || $_POST['total_bales'] === "0" || $_POST['delivery_date'] === "" || $_POST['sell_date'] == "")
	{
		echo '<script type="text/javascript">alert("Enter Correct Details")</script>';
		exit();
		
	}
	$grower_id = $_POST['grower_id'];
	$total_bales = $_POST['total_bales'];
	// $delivery_day =$_POST['delivery_day'];
	// $delivery_month =$_POST['delivery_month'];
	// $delivery_year =$_POST['delivery_year'];
	$delivery_date  =$_POST['delivery_date'];
	// $selling_day =$_POST['selling_day'];
	// $selling_month =$_POST['selling_month'];
	$fcaentitlement =$_POST['fcaentitlement'];
	$selling_date =$_POST['sell_date'];
	
	//$time = strtotime($delivery_month.'/'.$delivery_day.'/'.$delivery_year);

//$delivery_date = date('Y-m-d',$delivery_date);

//echo "Delivery Date: ".$delivery_date;

//$time1 = strtotime($selling_month.'/'.$selling_day.'/'.$selling_year);

//$selling_date = date('Y-m-d',$selling_date);

//echo "Selling Date: ".$selling_date;
	//exit;
	
	{
$error = '';
$url = "http://192.168.8.134:8444/api/Growers/GetGrower/$grower_id";    
$contenta = "";//json_encode($data1);

$curla = curl_init($url);
curl_setopt($curla, CURLOPT_HEADER, false);
curl_setopt($curla, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curla, CURLOPT_HTTPHEADER,array("Content-type: application/json"));
curl_setopt($curla, CURLOPT_POST, false);
curl_setopt($curla, CURLOPT_ENCODING,  '');
curl_setopt($curla,	CURLOPT_AUTOREFERER,true);
curl_setopt($curla,	CURLOPT_COOKIESESSION,true);
curl_setopt($curla,	CURLOPT_FAILONERROR,false);
curl_setopt($curla,	CURLOPT_FOLLOWLOCATION,false);
curl_setopt($curla,	CURLOPT_FRESH_CONNECT,true);
curl_setopt($curla,	CURLOPT_RETURNTRANSFER,true);
curl_setopt($curla,	CURLOPT_CONNECTTIMEOUT,30);
$growers = curl_exec($curla);

$grower_i = json_decode($growers, true);
//echo htmlentities($grower_i);
//exit;
$status = curl_getinfo($curla, CURLINFO_HTTP_CODE);

curl_close($curla);

$grower_size = "Small Scale";//$grower_i['U_GrowerSize'];

//$grower_size =$_POST['grower_size'];
//echo htmlentities($grower_size);
//exit;
}

	
	
	$data = '{
        "U_GrowerId": "'.$grower_id.'",
        "U_TotalBales": '.$total_bales.',
        "U_DeliveryDate": "'.$delivery_date.'",
		 "U_SellingDate": "'.$selling_date.'",
		 "U_GrowerType": "'.$grower_size.'",
		 "U_PayFcaEntitlement": "'.$fcaentitlement.'",
		 "U_User": "'.$user[1].'"
		
	}';

	$url = "http://192.168.8.134:8444/api/bookings";    
	$content = $data;//json_encode($data1);
//echo $data;
//exit;
$partsd = explode('-', $delivery_date);
//echo $partsd[0];
if(substr($delivery_date,0,4) == $partsd[0])
{}
else{	echo '<script type="text/javascript">alert("Enter Delivery Date Correctly i.e. in format YYYY-mm-dd")</script>';
		exit();
	}

$parts = explode('-', $selling_date);
//echo $parts[0];
if(substr($selling_date,0,4) == $parts[0])
{}
else{	echo '<script type="text/javascript">alert("Enter Selling Date Correctly i.e. in format YYYY-mm-dd")</script>';
		exit();
	}
//exit;
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl,CURLOPT_POSTFIELDS, $content);

curl_setopt($curl, CURLOPT_ENCODING,  '');
	curl_setopt($curl,	CURLOPT_AUTOREFERER,true);
	curl_setopt($curl,	CURLOPT_COOKIESESSION,true);
	curl_setopt($curl,	CURLOPT_FAILONERROR,false);
	curl_setopt($curl,	CURLOPT_FOLLOWLOCATION,false);
	curl_setopt($curl,	CURLOPT_FRESH_CONNECT,true);
	curl_setopt($curl,	CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl,	CURLOPT_CONNECTTIMEOUT,30);
	$result = curl_exec($curl);

	$response = json_decode($result, true);
	
	//var_dump($response);
	//echo "\n".$no_bales;
	//echo "\n".$selling_day;
	
//exit;

	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	if ( $status == 200 ) {
	    
	    echo "<script>alert('Booking Done!!');</script>";
	  // echo htmlentities($response);

	}else{

		$error = "Error: call to URL $url failed with status $status, response $result, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl);
		//die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
		echo htmlentities($error);
		$tm = $response['Message'];
		$ti = $response['ExceptionMessage'];
	}

	curl_close($curl);
//header("Location: /rvc_dev/bookings/index.php");
}
//echo htmlentities("Hie again Grower Name:".$gname);
//echo htmlentities("Hie again Grower No:".$gno);
//exit;
?>
<head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title>Rift Valley Corporation</title>
  <!-- Icons-->
  <link href="../public/node_modules/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
  <link href="../public/node_modules/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
  <link href="../public/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../public/node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
  <!-- Main styles for this application-->
  <link href="../public/css/style.css" rel="stylesheet">
  <link href="../public/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
  <!-- Global site tag (gtag.js) - Google Analytics-->
  <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    // Shared ID
    gtag('config', 'UA-118965717-3');
    // Bootstrap ID
    gtag('config', 'UA-118965717-5');
  </script>
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<?php
include('../layouts/navbar.php');
include('../layouts/sidebar.php');
?>

<!--container is supposed to go here-->
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-12">

	


        <form method="post" name = "Form" action="">
          <div class="card">
            <div class="card-header">
              <strong>Add New Booking</strong>
              <a href="/rvc_dev/bookings" class="btn btn-primary btn-sm pull-right"><i style="color:white;" class="fa fa-align-justify"></i> All Bookings</a>
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
				<td width = "1200">
                <div class="form-group">
                  <strong><label for="grower_id">Grower ID#</label></strong>
                 <!-- <select id="grower_id" name="grower_id" class="form-control selectpicker">
					//<?php 
					//foreach($grower_i as $grower)
					//{
					//?>
					//<option value="<?php //echo htmlentities($grower['CardCode']);?>"><?php// echo htmlentities($grower['CardCode']);?></option>
				//	<?php
						
				//	?>
					
<input type="text" id="sometext" onfocusout="myFunction()">
                  </select>-->
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
				<!-- <div class="form-group">
                  <label for="grower_id">Grower Size</label>
                  <select id="grower_size" name="grower_size" class="form-control selectpicker">
					
					<option value="SMALL SCALE">SMALL SCALE</option>
					<option value="COMMERCIAL">COMMERCIAL</option>
					
                  </select>
                </div>-->
                <div class="form-group">
                  <strong><label for="no_bales">Number of Bales</label></strong>
                  <input type="number" class="form-control" name="total_bales" id="total_bales" min="1" placeholder="Enter Bales Here">
                </div>
				</td>
				<td width = "1200">
				</td>
				</tr>
				<tr>
				
                <td>
                  <strong><label for="delivery_day">Delivery Date</label></strong>
                  <!--<input type="text" class="form-control" name="delivery_date" id="datepicker">-->
				    <!--<input type="text" maxlength="10" size="10" name="delivery_date" id="delivery_date" placeholder = "<?php //echo date("Y-m-d") ?>"/>-->
					<input id="delivery_date" type="date" name="delivery_date">
</td>

				 <!--<select id="delivery_day" name="delivery_day" >
				 <option value=""></option>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
				</select>
                
				</td>
				<td>
				 
                  <strong><label for="selling_day">Delivery Month</label></strong>
                  <!--<input type="text" class="form-control" name="delivery_date" id="datepicker">-->
				  <!--<select id="delivery_month" name="delivery_month" >
					<option value=""></option>
					<option value="01">Jan</option>
					<option value="01">Jan</option>
					<option value="02">Feb</option>
					<option value="03">Mar</option>
					<option value="04">Apr</option>
					<option value="05">May</option>
					<option value="06">Jun</option>
					<option value="07">Jul</option>
					<option value="08">Aug</option>
					<option value="09">Sep</option>
					<option value="10">Oct</option>
					<option value="11">Nov</option>
					<option value="12">Dec</option>
					
				</select>
                </td>
				<td>
				
				
                  <strong><label for="selling_day">Delivery Year</label></strong>
                  <!--<input type="text" class="form-control" name="delivery_date" id="datepicker">-->
				 <!-- <select id="delivery_year" name="delivery_year" >
					<option value=""></option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2023</option>
					<option value="2024">2025</option>
					<option value="2025">2026</option>
					<option value="2026">2026</option>
					<option value="2027">2027</option>
					<option value="2028">2028</option>
					<option value="2029">2029</option>
					<option value="2030">2030</option>
					<option value="2031">2031</option>
					<option value="2032">2032</option>
					<option value="2033">2033</option>
					<option value="2034">2034</option>
					<option value="2035">2035</option>
					<option value="2036">2036</option>
					<option value="2037">2037</option>
					<option value="2038">2038</option>
					<option value="2039">2039</option>
					<option value="2040">2040</option>
					
				</select>
                
				</td>
				</table>
				</div>
				
				</td>
				<td  width = "1200">
				<div class="form-group">
				<table>
				<td>-->
				
				<td>
                  <strong><label for="selling_day">Selling Day</label></strong>
                  <!--<input type="text" class="form-control" name="selling_date" id="datepicker1">-->
				  <!--<input type="text" maxlength="10" size="10" name="sell_date" id="sell_date" placeholder = "<?php //echo date("Y-m-d") ?>"/>-->
				  <input id="sell_date" type="date" name="sell_date">
				  </td>
				  </tr>
				  	<!--			 <select id="selling_day" name="selling_day" >
					<option value=""></option>
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
				</select>
                
				</td>
				<td>
				
                  <strong><label for="selling_day">Selling Month</label></strong>
                  <!--<input type="text" class="form-control" name="delivery_date" id="datepicker">-->
				 <!-- <select id="selling_month" name="selling_month" >
					<option value=""></option>
					<option value="01">Jan</option>
					<option value="02">Feb</option>
					<option value="03">Mar</option>
					<option value="04">Apr</option>
					<option value="05">May</option>
					<option value="06">Jun</option>
					<option value="07">Jul</option>
					<option value="08">Aug</option>
					<option value="09">Sep</option>
					<option value="10">Oct</option>
					<option value="11">Nov</option>
					<option value="12">Dec</option>
					
				</select>
                
				</td>
				<td>
				 
                  <strong><label for="selling_day">Selling Year</label></strong>
                  <!--<input type="text" class="form-control" name="delivery_date" id="datepicker">-->
				  <!--<select id="selling_year" name="selling_year" >
					<option value=""></option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2023</option>
					<option value="2024">2025</option>
					<option value="2025">2026</option>
					<option value="2026">2026</option>
					<option value="2027">2027</option>
					<option value="2028">2028</option>
					<option value="2029">2029</option>
					<option value="2030">2030</option>
					<option value="2031">2031</option>
					<option value="2032">2032</option>
					<option value="2033">2033</option>
					<option value="2034">2034</option>
					<option value="2035">2035</option>
					<option value="2036">2036</option>
					<option value="2037">2037</option>
					<option value="2038">2038</option>
					<option value="2039">2039</option>
					<option value="2040">2040</option>
					
				</select>
                
				</td>
				</table>
				</div>
				</td>
				</tr>-->
				<tr>
				<td>
				 
                  <strong><label for="selling_day">FCA Entitlement</label></strong>
                  <!--<input type="text" class="form-control" name="delivery_date" id="datepicker">-->
				 <select id="fcaentitlement" name="fcaentitlement" >
					<option value="YES">YES</option>
					<option value="NO">NO</option>
					
					
				</select>
                </td>
				<td>
				</td>
				</tr>
				<tr>
				<td width = "1200">
              
              <div class="card-footer"  align="left">
							
                <button type="submit"  name="addbooking" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Submit</button>
                <a type="button" class="btn btn-danger" title="Simulate Printing" name = "simulate" href="<?php echo $urlA;?>"><i class="fa fa-crosshairs"></i>Back</a>

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
<?php  
			  if(isset($response))
			  
			  {echo '<table table width="100%" style="border-collapse: collapse; border: 0px;">';
			 // echo htmlentities($raw_response);
			  echo '<tr>
                    <th style="border: 2px solid; padding:1px; font-size:14px; font-weight:normal; text-align: left;" width="20%"><strong>Message</strong></th>
					<th style="border: 2px solid; padding:1px; font-size:14px; font-weight:normal; text-align: left;" width="20%"><strong>Error</strong></th>
				
				
					</tr>';
		
			  //echo htmlentities($res);
			 
					echo '<tr>
                    <th style="border: 2px solid; padding:1px; font-size:14px; font-weight:normal; text-align: left;" width="20%">'.$tm.'</th>
					
				
                    <th style="border: 2px solid; padding:1px; font-size:14px; font-weight:normal; text-align: left;" width="20%">'.$ti.'</th>
					
					</tr>';
					echo '</table>';
					}
					?>
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
  </body>
</html>