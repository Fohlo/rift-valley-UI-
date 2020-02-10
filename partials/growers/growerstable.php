<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    <h5>
                        <i class="fa fa-align-justify"></i>
                        Growers
                    </h5>
                </div>
            </div>
            <div class="panel-body">
                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
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
                <th>Action</th>
                            <th style="width: 90px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($_SESSION['sbnm'] != "") {
                            $delivery_id = $_SESSION['sbnm'];
                        }
                        if (isset($deliveries)) {
                            foreach ($deliveries as $delivery) {
                                viewgrower($delivery['U_GrowerId']);

                                $deliveryDate = date("d M Y", strtotime($delivery['U_DeliveryDate']));
                                $sellingDate  = date("d M Y", strtotime($delivery['U_SellingDate']));
                                $ref_id       = $delivery['U_BookingRef'];
                                $doc_id       = $delivery['DocNum'];
                                $state         = ($delivery['U_Status'] == "Booked") ? '' : "disabled";
                                $spanClass      = ($delivery['U_Status'] == "Booked") ? '' : "disabled";
                                $hasTransporter = ($delivery['U_TransportCost'] > 0);
                                $transporter  = '';
                                $transCost    = '';
                        ?>
                                <tr>
                                    <td><?php echo htmlentities($delivery['U_BookingRef']); ?></td>
                                    <td>
                                        <em><?php echo htmlentities($delivery['U_GrowerId']); ?></em>
                                        <br>
                                        <a href="#" data-toggle="modal" data-target="#grower-<?php echo $delivery['U_BookingRef']; ?>">
                                            <i class="fa fa-circle-o"></i>
                                            <?php echo htmlentities($_SESSION['capnum']); ?>
                                        </a>
                                    </td>
                                    <td><?php echo htmlentities($deliveryDate); ?></td>
                                    <td><?php echo htmlentities($sellingDate); ?></td>
                                    <td>
                                        <?php echo htmlentities($delivery['U_TotalDelivered']); ?> /
                                        <?php echo htmlentities($delivery['U_TotalBales']); ?>
                                    </td>
                                    <td><?php echo $delivery['U_DeliveryNoteNum']; ?></td>
                                    <td><?php echo htmlentities($delivery['U_Status']); ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="details.php?id=<?php echo $doc_id; ?>" class="btn btn-default btn-xs" tooltip="View Delivery Details" title="View Delivery Details" placement="top">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#add-invoice-<?php echo $delivery['U_BookingRef']; ?>" class="btn btn-danger btn-xs" tooltip="Add Transporter Invoice" title="Add Transporter Invoice" placement="top">
                                                <i class="fa fa-file-text"></i>
                                            </a>
                                            <!-- <a href="deliveryconfirmation.php?id=<?php echo $doc_id; ?>" class="btn btn-info btn-xs" tooltip="Delivery Confirmation" title="Delivery Confirmation" placement="top" target="__blank">
                                                <i class="fa fa-truck"></i>
                                            </a>
                                            <a href="transporterinvoices.php?id=<?php echo $doc_id; ?>" class="btn btn-primary btn-xs" tooltip="View Transporter Invoices" title="View Transporter Invoices" placement="top">
                                                <i class="fa fa-align-justify"></i>
                                            </a>
                                            <a href="deliveryconfirmation.php?id=<?php echo $doc_id; ?>" class="btn btn-info btn-xs" tooltip="Delivery Confirmation" title="Delivery Confirmation" placement="top" target="__blank">
                                                <i class="fa fa-truck"></i>
                                            </a>
                                            <a href="laydownschedule.php?id=<?php echo $doc_id; ?>&grower_id=<?php echo $delivery['U_GrowerId']; ?>" class="btn btn-danger btn-xs" tooltip="Laydown Schedule" title="Laydown Schedule" placement="top" target="__blank">
                                                <i class="fa fa-cubes"></i>
                                            </a> -->
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="grower-<?php echo $delivery['U_BookingRef'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">
                                                    Grower Details: <?php echo htmlentities($_SESSION['capnum']); ?>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                            </div>
                                            <div class="modal-footer">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-gray btn-wide btn-rounded" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
                                                </div>
                                                <!-- /.btn-group -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add transporter Invoice Modal -->
                                <?php if (true) include('addInvoiceModal.php'); ?>
                        <?php
                            }
                        }

                        $_SESSION['sbnm'] = "";
                        $_SESSION['gid'] = "";
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>