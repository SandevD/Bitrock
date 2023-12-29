<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Directpay | Bitrock Bulletin</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap4.min.css" />

    <link rel="stylesheet" href="/assets/css/fonts.css" />
</head>


<body class="" style="background-color: #000000;">
    <div class="container-fluid d-flex justify-content-center align-items-center"
        style="min-height: 100vh; min-width: 100vw;">
        <div id="card_container"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.directpay.lk/v3/directpayipg.min.js"></script>
    <br /><br />
    <script type="text/javascript">
        sessionStorage.setItem("dp_msg", null);
        let errMsg = '';
        let trnMsg = '';
        jQuery(function() {
            var dp = new DirectPayIpg.Init({
                signature: '{{ $signature }}',
                dataString: '{{ $dataString }}',
                stage: '{{ $stage }}'
            });

            dp.doInAppCheckout().then((data) => {
                //console.log("client-res", JSON.stringify(data));
                trnMsg = data.transaction
                console.log(data);
                if (data.transaction.status === 'SUCCESS') {
                    sessionStorage.setItem('dp_msg', data.transaction.status)
                } else {
                    sessionStorage.setItem('dp_msg', data.transaction.status + ' - ' + data.transaction
                        .description)
                }

                setLog(JSON.stringify(trnMsg), true)
                iziToast.success({
                    title: 'Success',
                    message: trnMsg
                });
            }).catch(error => {
                //console.log("client-error", JSON.stringify(error));
                if (error.data) {
                    if (error.data.message !== undefined) {
                        errMsg = error.data.message;
                    } else {
                        errMsg = '';
                    }
                    
                    sessionStorage.setItem('dp_msg', 'Failed ' + errMsg)
                    setLog(errMsg, true)

                    iziToast.error({
                        title: 'Error',
                        message: errMsg
                    });
                }

                $.ajax({
                    type: 'POST',
                    url: "{{ route('order.cancel') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        orderId: "{{ $orderId }}"
                    },
                    success: function(data) {

                        if (data.success) {
                            window.location.href = "{{ route('welcome.index') }}";
                        } else {
                            iziToast.error({
                                title: 'Error',
                                message: data.error
                            });
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        iziToast.error({
                            title: 'Error',
                            message: err.responseJSON.message
                        });
                    },
                });
                //alert("An error occured while making the payment. Error:\n" + error.data.message);
            });

            function setLog(note, redirect = true) {

            }
        });
    </script>

    @include('partials.notify')
</body>

</html>
