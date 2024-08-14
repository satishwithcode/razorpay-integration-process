<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1); 
include 'db.php'; 

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetching form data
    $dr_name = $_POST["dr_name"];
    $designation = $_POST["designation"];
    $src = $_POST["src"];
    $price = $_POST["price"];
    $duration = $_POST["duration"];
    $selected_day = $_POST["selected_day"];
    $selected_date = $_POST["selected_date"];
    $appointment_time = $_POST["appointment_time"];
    $appointment_type = $_POST["appointment_type"];
    $payment_method = $_POST["payment_method"];
    $p_name = $_POST["p_name"];
    $contact = $_POST["contact"];
    $p_mail = $_POST["p_mail"];
    $p_age = $_POST["p_age"];
    $gender = $_POST["gender"];
    $payment = "Pending";
 
    // Inserting data into the payment table
    $sql = "INSERT INTO payment (dr_name, designation, src, price, duration, selected_day, selected_date, appointment_time, appointment_type, payment_method, p_name, contact, p_mail, p_age, gender, payment, payment_id) 
        VALUES ('$dr_name', '$designation', '$src', '$price', '$duration', '$selected_day', '$selected_date', '$appointment_time', '$appointment_type', '$payment_method', '$p_name', '$contact', '$p_mail', '$p_age', '$gender', '$payment', 'not done')";


    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        $last_inserted_id = mysqli_insert_id($conn);
        $orderId = $last_inserted_id;

        // Pass orderId to JavaScript for Razorpay integration
        echo "<script>var orderId = $orderId;</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} 
?>   
            <!-- Displaying all inserted data -->
            <p>Doctor Name: <?php echo $dr_name; ?></p>
            <p>Designation: <?php echo $designation; ?></p> 
            <p>Duration: <?php echo $duration; ?></p>
            <p>Selected Day: <?php echo $selected_day; ?></p>
            <p>Selected Date: <?php echo $selected_date; ?></p>
            <p>Appointment Time: <?php echo $appointment_time; ?></p>
            <p>Appointment Type: <?php echo $appointment_type; ?></p>
            <p>Payment Method: <?php echo $payment_method; ?></p>
            <p>Patient Name: <?php echo $p_name; ?></p>
            <p>Contact: <?php echo $contact; ?></p>
            <p>Email: <?php echo $p_mail; ?></p>
            <p>Age: <?php echo $p_age; ?></p>
            <p>Gender: <?php echo $gender; ?></p>

            <!-- Submit button -->
            <input type="hidden" name="payAmount" id="payAmount" value="<?php echo $price; ?>" >
            <button id="PayNow" class="btn btn-success btn-lg btn-block">Submit & Pay</button>
         
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    //Pay Amount
    jQuery(document).ready(function($) {
    $('#PayNow').click(function(e) {
        var paymentOption = 'netbanking';
        var p_name = $('#p_name').val();
        var p_mail = $('#p_mail').val();
        var contact = $('#contact').val();
        var payAmount = $('#payAmount').val();
        
        var request_url = "submitpayment.php";
        var formData = {
            p_name: p_name,
            p_mail: p_mail,
            contact: contact,
            paymentOption: paymentOption,
            payAmount: payAmount,
            action: 'payOrder'
        };

        $.ajax({
            type: 'POST',
            url: request_url,
            data: formData,
            dataType: 'json',
            encode: true,
        }).done(function(data) {
            if (data.res == 'success') {
                var orderID = data.order_number;
                var options = {
                    "key": data.razorpay_key,
                    "amount": data.userData.amount,
                    "currency": "INR",
                    "name": "Soilwrap Technologies",
                    "description": data.userData.description,
                    "image": "https://soilwrap.com/img/soilwrap technologies logo - back theme.png",
                    "order_id": data.userData.rpay_order_id,
                    "handler": function(response) {
                        window.location.replace("payment-success.php?oid=" + orderId + "&rp_payment_id=" + response.razorpay_payment_id + "&rp_signature=" + response.razorpay_signature);
                    },
                    "modal": {
                        "ondismiss": function() {
                            window.location.replace("payment-success.php?oid=" + orderId);
                        }
                    },
                    "prefill": {
                        "name": data.userData.name,
                        "email": data.userData.email,
                        "contact": data.userData.mobile
                    },
                    "notes": {
                        "address": "Tutorialswebsite"
                    },
                    "config": {
                        "display": {
                            "blocks": {
                                "banks": {
                                    "name": 'Pay using ' + paymentOption,
                                    "instruments": [{
                                        "method": paymentOption
                                    }],
                                },
                            },
                            "sequence": ['block.banks'],
                            "preferences": {
                                "show_default_blocks": true,
                            },
                        },
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.on('payment.failed', function(response) {
                    window.location.replace("payment-failed.php?oid=" + orderId + "&reason=" + response.error.description + "&paymentid=" + response.error.metadata.payment_id);
                });
                rzp1.open();
                e.preventDefault();
            }
        });
    });
});
</script>
</body>
</html>