<div role="tabpanel" class="tab-pane active" id="bale-details">
    <div class="row">
        <div class="col=md-12">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Bale</th>
                        <th>Group #</th>
                        <th>Lot #</th>
                        <th>Moisture</th>
                        <th>Mass</th>
                        <th>Variance</th>
                        <th>Wrapper</th>
                        <th>StandardDev</th>
                        <th>Status</th>
                        <th align="center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($delivery['DELIVERYBALESCollection'] as $d) {
                    ?>
                        <tr>
                            <td>
                                <em><?php echo htmlentities($d['U_BaleId']); ?></em>
                                <br>
                                <?php echo htmlentities($d['U_TicketNumber']); ?>
                            </td>
                            <td><?php echo htmlentities($d['U_GroupNumber']); ?></td>
                            <td><?php echo htmlentities($d['U_LotNumber']); ?></td>
                            <td><?php echo htmlentities($d['U_Moisture']); ?></td>
                            <td><?php echo htmlentities($d['U_Mass']); ?></td>
                            <td><?php echo htmlentities($d['U_MassVariance']); ?></td>
                            <td><?php echo htmlentities($d['U_Wrapper']); ?></td>
                            <td><?php echo htmlentities($d['U_MoistureStandardDev']); ?></td>
                            <td><?php echo htmlentities($d['U_Status']); ?></td>
                            <td align="center">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <?php $delivery_id = $d['DocEntry']; ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
