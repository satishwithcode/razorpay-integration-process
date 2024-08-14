 
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $user_id = $_POST["user_id"];
    $designation = $_POST["designation"];
    $src = $_POST["src"];
    $price = $_POST["price"];
    $duration = $_POST["duration"];
    $selected_day = $_POST["selected_day"];
    $selected_date = $_POST["selected_date"];
    $appointment_time = $_POST["appointment_time"];
    $appointment_type = $_POST["appointment_type"];
    
    // Now you can use these variables as needed in your PHP code
    // For example, you can save them to a database or perform any other necessary actions.
}
?><?php echo $name; ?><?php echo $designation; ?> Consultation Fee₹<?php echo $price; ?><?php echo $duration; ?>
 
<form id="booking_form" action="" method="POST"> 
<input type="text" class="form-control" placeholder="Patient name" name="p_name" required> 
<input type="text" class="form-control" placeholder="Contact no" name="contact" required> 
<input type="email" class="form-control" placeholder="Official mail" name="p_mail" required> 
<input type="text" class="form-control" placeholder="Age" name="p_age" required> 
<select name="gender" id="gender" required>
  <option value="" disabled="" selected="">Gender</option> 
  <option value="Male">Male</option>
  <option value="Female">Female</option>
  <option value="Others">Others</option>
</select> 
<p>Appointment details</p>
appointment_type <?php echo $appointment_type; ?>
appointment_time <?php echo $appointment_time; ?>
<span>Appointment date</span><?php echo $selected_date; ?> 
<div class="header">Payment Summary</div>
<div class="ps-key col col-8 xs-8">Consultation charges</div>
<div class="ps-value col col-4 xs-4">₹<?php echo $price; ?></div>
<div xs="8" class="ps-key-bold col col-8 xs-8">Payment Total</div>
<div xs="4" class="ps-value-bold col col-4 xs-4">₹<?php echo $price; ?></div>  
<span class="title">Payment Methods</span> 
<div class="payment-options">
<input type="radio" name="payment_method" value="Pay in clinic" checked>
<input type="radio" name="payment_method" value="Razor Pay"><br>
<input type="hidden" value="<?php echo $name; ?>" name="dr_name">
<input type="hidden" value="<?php echo $designation; ?>" name="designation"> 
<input type="hidden" value="<?php echo $price; ?>" name="price">
<input type="hidden" value="<?php echo $duration; ?>" name="duration">
<input type="hidden" value="<?php echo $selected_day; ?>" name="selected_day">
<input type="hidden" value="<?php echo $selected_date; ?>" name="selected_date">
<input type="hidden" value="<?php echo $appointment_time; ?>" name="appointment_time">
<input type="hidden" value="<?php echo $appointment_type; ?>" name="appointment_type">  
<button id="submit_btn" style="padding: 15px 30px;" type="submit">Confirm Booking </button>
</form> 

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('booking_form');
        const submitBtn = document.getElementById('submit_btn');

        // Function to update form action and submit button text based on selected payment method
        function updateFormAction() {
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            if (paymentMethod === "Razor Pay") {
                form.action = "payment-page.php"; // Change this to your Razor Pay payment page URL
                submitBtn.textContent = "Pay Now";
            } else {
                form.action = "handle-booking.php"; // Change this to your default action URL
                submitBtn.textContent = "Confirm Booking";
            }
        }

        // Attach event listener to radio inputs to update form action and submit button text
        document.querySelectorAll('input[name="payment_method"]').forEach(function (radio) {
            radio.addEventListener('change', updateFormAction);
        });

        // Initial update of form action and submit button text
        updateFormAction();
    });
</script>      