<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    <h5>
                        <i class="fa fa-align-justify"></i>
                        Scales
                    </h5>
                </div>
            </div>
            <div class="panel-body">
                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                        <th>DocNum</th>
                        <th>Name</th>
                        <th>IpAddress</th>
                        <th>SammId</th>
                        <th>ScaleId</th>
                        <th style="width: 100px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($_SESSION['sbnm'] != "") {
                            $booking_id = $_SESSION['sbnm'];
                        }
                        if (isset($bookings)) {
                            foreach ($bookings as $booking) { 
                                viewgrower($booking['U_GrowerId']);

                                $deliveryDate = date("d M Y", strtotime($booking['U_DeliveryDate']));
                                $sellingDate  = date("d M Y", strtotime($booking['U_SellingDate']));
                                $growerSize   = ($_SESSION['gSz'] == "None") ? "Small Scale" : "Commercial";
                                $ref_id 	  = $booking['U_Reference'];
                                $doc_id 	  = $booking['DocNum'];
                                $state   	  = ($booking['U_Status'] == "Booked") ? '' : "disabled";
                                $spanClass	  = ($booking['U_Status'] == "Booked") ? '' : "disabled";
                        ?>
                                <tr>
                                    <td><?php echo htmlentities($booking['U_Reference']); ?></td>
                                    <td>
                                        <em><?php echo htmlentities($booking['U_GrowerId']); ?></em>
                                        <br>
                                        <?php echo htmlentities($_SESSION['capnumsA']); ?>
                                    </td>
                                    <td><?php echo htmlentities($deliveryDate); ?></td>
                                    <td><?php echo htmlentities($booking['U_SellingDay']); ?></td>
                                    <td><?php echo htmlentities($sellingDate); ?></td>
                                    <td><?php echo htmlentities($booking['U_TotalBales']); ?></td>
                                    <td><?php echo htmlentities($growerSize); ?></td>
                                    <td><?php echo htmlentities($booking['U_Status']); ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="editBooking.php?id=<?php echo $ref_id; ?>" class="btn btn-warning btn-xs" tooltip="Edit Booking" title="Edit Booking" placement="top" <?php echo $state; ?>>
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="addDelivery.php?id=<?php echo $ref_id; ?>" class="btn btn-success btn-xs" tooltip="Add Delivery" title="Add Delivery" placement="top" <?php echo $state; ?>>
                                                <i class="fa fa-exchange"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
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
