<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>COOP</title>
  @include('student.partials.styles')
    <script type="module" src="https://pay.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.esm.js"></script>
    <script nomodule="" src="https://pay.billdesk.com/jssdk/v1/dist/billdesksdk.js"></script>
    <link href="https://pay.billdesk.com/jssdk/v1/dist/billdesksdk/billdesksdk.css" rel="stylesheet">
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
        let globalBase64String;
        const imagePath = '/images/log.png';
        function convertImageToBase64(imagePath, callback) {
            const img = new Image();
            img.crossOrigin = 'Anonymous'; // Allow cross-origin requests (important for loading local images)
            img.onload = function () {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);

                // Convert the image to a Base64 encoded string
                const base64String = canvas.toDataURL('image/png');
                callback(base64String);
            };
            img.src = imagePath;
        }
        convertImageToBase64(imagePath, function (base64String) {
            // console.log(base64String); // Display the Base64 string in the console
            // You can use the base64String as needed (e.g., send it to the server)

            // Access the globalBase64String variable here if needed
            // console.log(globalBase64String); // Access the Base64 string globally
        });

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $("#paymentForm").submit(function (e)
        {
            e.preventDefault();
           

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
                    // console.log(response);
                    if (status === 'SUCCESS') {
                        var flow_config = {
                            logo:globalBase64String,
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
