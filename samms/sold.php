<?php

include('../redirect.php'); 
session_start();
include('../refresh.php'); 
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

	$url = "http://192.168.8.134:8444/api/deliveries/GetPrinted";    
	$content = "";//$data;//json_encode($data1);

	$curl = curl_init($url);
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

	$delivery_id = json_decode($result, true);
//var_dump($result);
//echo htmlentities($booking_id);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	if ( $status == 200 ) {
	    
	    echo "<script>alert('Zvaita');</script>";

	}else{

		$error = "Error: call to URL $url failed with status $status, response $result, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl);
		//die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
	}

	curl_close($curl);

//}

?>
<!DOCTYPE html>
<html lang="en">

<head>
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
<!-- Breadcrumb-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">Home</li>
  <li class="breadcrumb-item active">Bookings</li>
  <!-- Breadcrumb Menu-->
  <li class="breadcrumb-menu d-md-down-none">
    <div class="btn-group" role="group" aria-label="Button group">
      <a class="btn" href="#">
        <i class="icon-speech"></i>
      </a>
      <a class="btn" href="./">
        <i class="icon-graph"></i>  Dashboard</a>
      <a class="btn" href="#">
        <i class="icon-settings"></i>  Settings</a>
    </div>
  </li>
</ol>


<!--container is supposed to go here-->
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
		<h2>Delivery</h2>
		 <div class="card-header">
            <i class="fa fa-align-justify"></i> Deliveries List</div>
          <div class="card-body">

            <table class="table table-bordered table-sm">
          <thead>
              <tr>
                <th>Date Created</th>
                <th>Grower #</th>
                <th>Selling Day</th>
                <th>Reference #</th>
                <th># of Bales</th>
                <th>Delivery Note#</th>
                <th>TransportId</th>
                <th>Season</th>
                <th align="center">Action</th>
              </tr>
          </thead>
          <tbody>
		 
            <?php  
            foreach($delivery_id as $delivery)
              {//echo $booking;
			//  var_dump($result);
			  //var_dump($booking_id);
//echo htmlentities($booking_id);
                ?>
              <tr>
                <td><?php echo htmlentities($delivery['U_DtCreated']);?></td>
                <td><?php echo htmlentities($delivery['U_GrowerId']);?></td>
                <td><?php echo htmlentities($delivery['U_SellingDy']);?></td>
                <td><?php echo htmlentities($delivery['U_BkngRef']);?></td>
                <td><?php echo htmlentities($delivery['U_BaleNo']);?></td>
                <td><?php echo htmlentities($delivery['U_DNoteNum']);?></td>
                <td><?php echo htmlentities($delivery['U_TranspId']);?></td>
                <td><?php echo htmlentities($delivery['U_Season']);?></td>
                <td align="center">
                  <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <?php $delivery_id = $delivery['DocNum'];?>
                        <a href="/rvc_dev/deliveries/details.php?id=<?php echo $delivery_id;?>" class="btn btn-primary" tooltip="View More Details" title="View More Details" placement="top"><i style="color:white;" class="fa fa-align-justify"></i></a>
                        <a href="/rvc_dev/deliveries/edit.php?id=<?php echo $delivery_id;?>" class="btn btn-success"><i class="fa fa-pencil-square-o" tooltip="Edit Delivery" title="Edit Delivery" placement="top"></i></a>
                        <button type="button" class="btn btn-danger" title="Add Delivery"><i class="fa fa-crosshairs"></i></button>
                    </div>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
		<div class="clearfix"></div>
	</div>
	

         

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
  </body>
</html>