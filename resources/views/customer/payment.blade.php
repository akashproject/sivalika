<html>
<head>
    <title>Razorpay Payment</title>
</head>
<body onload="pay()">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        function pay() {
            var options = {
                "key": "{{ get_theme_setting('razorpay_key') }}",
                "amount": "{{$booking->amount}}",
                "currency": "INR",
                "name": "{{ get_hotel_by_id($booking->hotel_id)->name }} Booking",
                "description": "Purchase description",
                "image": "http://localhost/sivalika/assets/img/logo.png",
                "order_id": "{{ $booking->order_id }}",
                "handler": function (response) {
                    window.location.href = '/payment-success/'+response.razorpay_payment_id;
                },
                "modal": {
                    "ondismiss": function () {
                        if (confirm("Are you sure, you want to close the form?")) {
                            txt = "You pressed OK!";
                            window.location.href = '/payment-failed/';
                        }
                    }
                },
                "prefill": {
                    "name": "{{$user->name}}",
                    "email": "{{$user->email}}",
                    "contact": "{{$user->mobile}}"
                },
                "theme": {
                    "color": "#e3b53d"
                },
            };

            var rzp = new Razorpay(options);
            rzp.open();

        }
    </script>
</body>
</html>