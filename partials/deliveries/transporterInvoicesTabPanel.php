<div role="tabpanel" class="tab-pane" id="transporter-invoices">
    <div class="row">
        <div class="col-md-12">
            <table class="display table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Creditor #</th>
                        <th>Transporter Name</th>
                        <th>Status</th>
                        <th>Date Received</th>
                        <th>Amount</th>
                        <th>Balance</th>
                        <th style="width: 80px;"></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($invoices as $invoice) {
                    ?>
                        <tr>
                            <td><?php echo $invoice['U_CreditorNum']; ?></td>
                            <td><?php echo getCreditorName($invoice['U_CreditorNum']); ?></td>
                            <td><?php echo $invoice['U_Status']; ?></td>
                            <td><?php echo date('d M Y', strtotime($invoice['U_DateReceived'])); ?></td>
                            <td>$<?php echo number_format($invoice['U_Amount'], 2); ?></td>
                            <td>$<?php echo number_format($invoice['U_Balance'], 2); ?></td>
                            <td align="center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="#" class="btn btn-dander btn-xs" tooltip="Delete Invoice" title="Delete Invoice" placement="top">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>