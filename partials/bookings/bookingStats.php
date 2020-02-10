<div class="row mb-15">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a class="dashboard-stat-2 bg-primary" href="#">
            <div class="stat-content">
                <span class="number counter">
                    <?php echo (isset($_POST['balestats'])) ? getBookedToday() : '--'; ?>
                </span>
            </div>
            <span class="stat-footer"><i class="fa fa-dot-circle-o color-success"></i> Booked & Not Delivered</span>
        </a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a class="dashboard-stat-2 bg-danger" href="#">
            <div class="stat-content">
                <span class="number counter">
                    <?php echo (isset($_POST['balestats'])) ? getDeliveredToday() : '--'; ?>
                </span>
            </div>
            <span class="stat-footer"><i class="fa fa-dot-circle-o color-success"></i> Bales Delivered</span>
        </a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a class="dashboard-stat-2 bg-warning" href="#">
            <div class="stat-content">
                <span class="number counter">
                    <?php echo (isset($_POST['balestats'])) ? getSalesTomorrow() : '--'; ?>
                </span>
            </div>
            <span class="stat-footer"><i class="fa fa-dot-circle-o color-success"></i> Bales To Sell Tomorrow</span>
        </a>
    </div>
</div>
