<div class="modal fade" id="add-invoice-<?php echo $delivery['U_BookingRef'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form action="" method="post">
        <input type="hidden" name="bookingRef" value="<?php echo $delivery['U_BookingRef']?>">
        <input type="hidden" name="growerId"   value="<?php echo $delivery['U_GrowerId']?>">
        <input type="hidden" name="docNum"     value="<?php echo $delivery['DocNum']?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        Add Transporter Invoice: <?php echo $delivery['U_BookingRef']; ?>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="creditorNum">Creditor Number</label>
                        <input type="number" name="creditorNum" id="creditorNum" class="form-control" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="dNoteNum">Delivery Note Number</label>
                        <input type="number" name="dNoteNum" id="dNoteNum" class="form-control" required>
                    </div> -->
                    <div class="form-group">
                        <label for="invoiceAmount">Invoice Amount</label>
                        <input type="number" name="invoiceAmount" id="invoiceAmount" class="form-control" placeholder="0.00" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-success btn-wide btn-rounded" name="add_invoice">
                            <i class="fa fa-floppy-o"></i>
                            Save Invoice
                        </button>
                        <button type="button" class="btn btn-gray btn-wide btn-rounded" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
