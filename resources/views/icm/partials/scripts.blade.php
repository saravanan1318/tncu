<!-- jQuery -->
<script src="/panel/plugins/jquery/jquery.min.js"></script>
<script src="{{asset('js/jquery.validate.js')}}"></script>
<!-- Bootstrap -->
<script src="/panel/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="/panel/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="/panel/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/panel/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/panel/dist/js/pages/dashboard3.js"></script>
<script type="">
    $("#icmsignin").click(function (e) {
        console.log("Form is trying to submit");
        e.preventDefault();
        if($("#icmloginform").validate()){
            $("#icmloginform").submit();
        }
    });
</script>