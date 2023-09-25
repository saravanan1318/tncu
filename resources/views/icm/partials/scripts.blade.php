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
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="{{asset('js/buttons_export_config_header.js')}}"></script>
<script type="">
    $("#icmsignin").click(function (e) {
        console.log("Form is trying to submit");
        e.preventDefault();
        if($("#icmloginform").validate()){
            $("#icmloginform").submit();
        }
    });

    $(document).ready(function() {
        $('#applicationlist').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
  
</script>