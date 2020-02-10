<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <h5>
                        <i class="fa fa-search"></i>
                        Search for Creditors
                    </h5>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <form action="" method="post">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search-option">Search Option</label>
                                <select name="search-option" id="search-option" class="form-control" onchange="onOptionChanged();">
                                    <option value="GrowerID" <?php if (isset($_POST['search-option']) && $_POST['search-option'] == 'GrowerID') echo 'selected'; ?>>By Grower ID</option>
                                    <option value="GrowerName" <?php if (isset($_POST['search-option']) && $_POST['search-option'] == 'GrowerName') echo 'selected'; ?>>By Grower Name</option>
                                    <option value="DeliveryDate" <?php if (isset($_POST['search-option']) && $_POST['search-option'] == 'DeliveryDate') echo 'selected'; ?>>By Delivery Date</option>
                                    <option value="SellingDate" <?php if (isset($_POST['search-option']) && $_POST['search-option'] == 'SellingDate') echo 'selected'; ?>>By Selling Date</option>
                                    <option value="Reference" <?php if (isset($_POST['search-option']) && $_POST['search-option'] == 'Reference') echo 'selected'; ?>>By Reference Number</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="search-text" id="search-label">Enter the Grower ID</label>
                                <input type="text" name="search-text" id="search-text" class="form-control" placeholder="Enter the Grower ID" value="<?php echo $searchText; ?>" onfocus="this.select();" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search-option">&nbsp;</label>
                                <button class="btn btn-primary btn-block" name="search">
                                    <i class="fa fa-search"></i>
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>