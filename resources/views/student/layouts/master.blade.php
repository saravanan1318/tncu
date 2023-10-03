<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>COOP</title>
  @include('student.partials.styles')
    <script type="module" src="https://uat.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.esm.js"></script>
    <script nomodule="" src="https://uat.billdesk.com/jssdk/v1/dist/billdesksdk.js"></script>
    <link href="https://uat.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.css" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    @include('student.partials.header')
    @yield('content')
    @include('student.partials.footer')
    </div>
    @include('student.partials.scripts')
</body>
<script>
    $(document).ready(function () {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $("#paymentForm").submit(function (e)
        {
            e.preventDefault();
            var selectedCheckboxes = $("input[name='terms[]']:checked");
            if (selectedCheckboxes.length === 0) {
                $("#error-message").show(); // Show the error message
                return; // Stop the form submission
            }

            // If at least one checkbox is selected, hide the error message
            $("#error-message").hide();

            // Process the form data
            var formData = $(this).serialize(); // Serialize the form data

            $.ajax({
                type: "POST",
                url: "/student/payment",
                data: formData,
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    var status = jsonResponse.status;

                    if (status === 'SUCCESS') {
                        var flow_config = {
                            merchantId: jsonResponse.merchantID,
                            bdOrderId: jsonResponse.bdorderid,
                            authToken: jsonResponse.authToken,
                            childWindow: false,
                            returnUrl: jsonResponse.returnUrl,
                            retryCount: 0
                        };
                        var responseHandler = function(txn) {
                            if (txn.response) {
                                alert("callback received status:: ", txn.status);
                                alert("callback received response:: ", txn.response)//response handler to be implemented by the merchant
                            }
                        };
                        var config = {
                            flowConfig: flow_config,
                            flowType: "payments"
                        };
                        setTimeout(function() {
                            window.loadBillDeskSdk(config);
                        }, 0);
                    } else if (status === 'ERROR') {
                        // Show an error popup message
                        alert(jsonResponse.message);
                    } else {
                        // Handle other status values as needed
                        alert('Unknown status: ' + status);
                    }
                },
                error: function(error) {
                    // console.error(error); // Handle any errors that occurred during the request
                }
            });
        });
    });
</script>
</html>
