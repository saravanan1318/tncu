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
<script src="/panel/plugins/select2/js/select2.full.min.js"></script>
<script src="{{asset('js/buttons_export_config_header.js')}}"></script>
<script type="">
    $('.select2').select2();
    $("#icmsignin").click(function (e) {
        console.log("Form is trying to submit");
        e.preventDefault();
        if($("#icmloginform").validate()){
            $("#icmloginform").submit();
        }
    });

    
    $("#term1").change(function(){

      var id = $(this).attr("data-id");
      var term = $("#term"+id).val();

      if(term == "term1"){
        $("#termamount"+id).val(6750.00);
        $("#termtotal"+id).val(6750.00);
      }else if(term == "term2"){
        $("#termamount"+id).val(6000.00);
        $("#termtotal"+id).val(6000.00);
      }else if(term == "term3"){
        $("#termamount"+id).val(6000.00);
        $("#termtotal"+id).val(6000.00);
      }else{
        $("#termamount"+id).val(0);
        $("#termtotal"+id).val(0);
      }

    });

   
    $("#addnew").click(function(){
        var id = $(this).attr("data-rowid");
        var newrow = parseInt(id)+1;
        var term = $("#term"+id).val();
        $(".deletebtn").hide();
        var html = '<tr class="row'+newrow+'"> <td>'+newrow+'</td> <td> <select class="form-control term" name="term[]" id="term'+newrow+'" data-id="'+newrow+'" required> <option value="">SELECT</option> <option value="term1">Term 1</option> <option value="term2">Term 2</option> <option value="term3">Term 3</option> </select> </td> <td style="text-align: center"> 01 </td> <td style="text-align: center"> <input type="number" name="termamount[]" value="" id="termamount'+newrow+'" data-id="'+newrow+'"  required/> </td> <td style="text-align: center"> <input type="number" name="termtotal[]" value="" id="termtotal'+newrow+'" data-id="'+newrow+'"  required/> </td> <td style="text-align: center"> <a class="deletebtn btn btn-danger" id="deletebtn'+newrow+'" data-id="'+newrow+'">Delete row</a> </td></tr>';
        $("#tablebody").append(html);
        $(this).attr('data-rowid', newrow);

        $("#term"+newrow).change(function(){

            var id = $(this).attr("data-id");
            var term = $("#term"+id).val();
            for(var i=1; i<newrow; i++){
                var loopterm = $("#term"+i).val();
                if(loopterm == term){
                    alert("Selected term already added");
                    $("#term"+id).val("");
                    return false;
                }
            }
            if(term == "term1"){
            $("#termamount"+id).val(6750.00);
            $("#termtotal"+id).val(6750.00);
            }else if(term == "term2"){
            $("#termamount"+id).val(6000.00);
            $("#termtotal"+id).val(6000.00);
            }else if(term == "term3"){
            $("#termamount"+id).val(6000.00);
            $("#termtotal"+id).val(6000.00);
            }else{
            $("#termamount"+id).val(0);
            $("#termtotal"+id).val(0);
            }

        });

        $(".deletebtn").click(function(){
            console.log("deletebtn");
            var id = $(this).attr("data-id");
            $(".row"+id).remove();
            var updatedrow = parseInt(id)-1;
            $("#addnew").attr('data-rowid', updatedrow);
            $("#deletebtn"+updatedrow).show();
        });

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