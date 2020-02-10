<script src="../public/node_modules/jquery/dist/jquery.min.js"></script>
<script src="../public/node_modules/popper.js/dist/umd/popper.min.js"></script>
<script src="../public/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../public/node_modules/pace-progress/pace.min.js"></script>
<script src="../public/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script src="../public/node_modules/@coreui/coreui/dist/js/coreui.min.js"></script>
<!-- Plugins and scripts required by this view-->
<script src="../public/node_modules/chart.js/dist/Chart.min.js"></script>
<script src="../public/node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js"></script>
<script src="../public/js/main.js') }}"></script>
<script src="../public/js/jquery.dataTables.min.js"></script>
<script src="../public/js/bootstrap-select.min.js"></script>
<script src="../public/js/sweetalert2.all.min.js"></script>
<script src="../public/js/sweetalert2.min.js"></script>
<script src="../public/js/sweetalert.min.js"></script>

<!-- Include this after the sweet alert js file -->
@include('sweet::alert')

<script type="text/javascript">
    $(document).ready( function () {
        $('.table').DataTable();
    } );
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $("#s_grower_id").change(function () {
        var val = JSON.parse($(this).val());
        // console.log(val.grower_type);
        if (val.grower_type == "small_scale") {
            $("#s_report_type").html("<option value='f1'>Field Report One</option><option value='f2'>Field Report Two</option><option value='f3'>Field Report Three</option><option value='gr'>General Report</option>");
        } else if (val.grower_type == "Small Scale") {
            $("#s_report_type").html("<option value='f1'>Field Report One</option><option value='f2'>Field Report Two</option><option value='f3'>Field Report Three</option><option value='gr'>General Report</option>");
        } else if (val.grower_type == "commercial") {
            $("#s_report_type").html("<option value='sr'>September Report</option><option value='nr'>November Report</option><option value='jr'>January Report</option><option value='mr'>March Report</option><option value='gr'>General Report</option>");
        } else if (val.grower_type == "Commercial") {
            $("#s_report_type").html("<option value='sr'>September Report</option><option value='nr'>November Report</option><option value='jr'>January Report</option><option value='mr'>March Report</option><option value='gr'>General Report</option>");
        }
    });
});
</script>

