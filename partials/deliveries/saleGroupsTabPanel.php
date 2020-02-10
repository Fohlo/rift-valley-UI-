<div role="tabpanel" class="tab-pane" id="sale-groups">
    <div class="row">
        <div class="col-md-12">
            <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>DocEntry</th>
                        <th>LineId</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Sale Id</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th align="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($delivery['DELIVERYSALEGROUPSCollection'] as $e) {
                    ?>
                        <tr>
                            <td><?php echo htmlentities($e['DocEntry']); ?></td>
                            <td><?php echo htmlentities($e['LineId']); ?></td>
                            <td><?php echo htmlentities($e['U_From']); ?></td>
                            <td><?php echo htmlentities($e['U_To']); ?></td>
                            <td><?php echo htmlentities($e['U_SaleId']); ?></td>
                            <td><?php echo htmlentities($e['U_Status']); ?></td>
                            <td><?php echo htmlentities($e['U_Comments']); ?></td>
                            <td align="center">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
