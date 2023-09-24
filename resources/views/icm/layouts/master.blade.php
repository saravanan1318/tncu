<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>COOP</title>
  @include('icm.partials.styles')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    @include('icm.partials.header')
    @yield('content')
    @include('icm.partials.footer')
    </div>
    @include('icm.partials.scripts')
</body>
<script>
    $(document).ready(function () {
        var table = $('#applicationlist').DataTable();
        $(".actionbutton").change(function (e) {
            var id = $(this).data("id");
            var option = $(this).val();
            var postData = {
                id: id,
                option: option
            };
            $.ajax({
                type: "GET",
                url: "/icm/duplicateaccept", // Replace with the actual URL or Laravel route
                data: postData,
                success: function (response) {
                    // Handle the response from the server
                    console.log(response);

                },
                error: function (xhr, status, error) {
                    // Handle any errors
                    console.error(xhr.responseText);
                }
            });
        });
        $(".applyactionbutton").click(function (e) {

            var selectedCheckboxes = [];

            // Iterate through all checkboxes in the table
            $('#applicationlist tbody input[type="checkbox"]:checked').each(function () {
                selectedCheckboxes.push($(this).val());
            });
            var countSelected = selectedCheckboxes.length;
            if(countSelected>0) {
                var postData = {selectedCheckboxes: selectedCheckboxes};
                $.ajax({
                    type: "GET",
                    url: "/icm/selectedlist", // Replace with the actual URL or Laravel route
                    data: postData,
                    success: function (response) {
                        // Handle the response from the server
                        location.reload();
                        console.log(response);

                    },
                    error: function (xhr, status, error) {
                        // Handle any errors
                        console.error(xhr.responseText);
                    }
                });
                console.log(selectedCheckboxes);
            }
            else{
             alert("please select one of them then you apply");
            }
        });
    });
</script>
</html>
