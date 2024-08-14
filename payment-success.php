<?php
include 'db.php';

// Check if the required parameters are present in the URL
if (isset($_GET['oid']) && isset($_GET['rp_payment_id']) && isset($_GET['rp_signature'])) {
    // Extract the parameters from the URL
    $orderId = $_GET['oid'];
    $paymentId = $_GET['rp_payment_id'];

    // Update the payment status in the database
    $updateSql = "UPDATE payment SET payment_id = '$paymentId', payment = 'Success' WHERE id = '$orderId'";
    if (mysqli_query($conn, $updateSql)) {
        // Get all data associated with the same id
        $selectSql = "SELECT * FROM payment WHERE id = '$orderId'";
        $result = mysqli_query($conn, $selectSql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            // Extract data from the row
            $dr_name = $row['dr_name'];
            $designation = $row['designation'];
            $selected_date = $row['selected_date'];
            $selected_day = $row['selected_day'];
            $appointment_time = $row['appointment_time'];
            $price = $row['price'];
            $src = $row['src'];
            $payment_method = $row['payment_method'];
            $payment_id = $row['payment_id'];
            $payment = $row['payment'];
            $p_name = $row['p_name'];
            $contact = $row['contact'];
            $p_mail = $row['p_mail'];
            $p_age = $row['p_age'];
            $gender = $row['gender'];
            // Send email notification to admin
            $admin_email = "thakur65091@gmail.com"; // Admin's email address
            $admin_subject = "New Appointment Booking";
            $admin_message = "A new appointment has been booked:\n";
            $admin_message .= "Doctor Name: $dr_name\n";
            $admin_message .= "Designation: $designation\n";
            $admin_message .= "Appointment Date: $selected_date, $selected_day\n";
            $admin_message .= "Appointment Time: $appointment_time\n";
            $admin_message .= "Fee: ₹$price\n";
            $admin_message .= "Payment Method: $payment_method\n";
            $admin_message .= "Payment Status: $payment\n";
            $admin_message .= "Payment ID: $payment_id\n";
            $admin_message .= "\nPatient Details:\n";
            $admin_message .= "Name: $p_name\n";
            $admin_message .= "Contact: $contact\n";
            $admin_message .= "Email: $p_mail\n";
            $admin_message .= "Age: $p_age\n";
            $admin_message .= "Gender: $gender\n";
            // Send email to admin
            mail($admin_email, $admin_subject, $admin_message);

            // Send thank you email to user
            $user_subject = "Thank You for Booking an Appointment";
            $user_message = "Dear $p_name,\n\n";
            $user_message .= "Thank you for booking an appointment with us.\n";
            $user_message .= "Here are the details of your appointment:\n";
            $user_message .= "Doctor Name: $dr_name\n";
            $user_message .= "Doctor Designation: $designation\n";
            $user_message .= "Appointment Date: $selected_date, $selected_day\n";
            $user_message .= "Appointment Time: $appointment_time\n";
            $user_message .= "Fee: ₹$price\n";
            $user_message .= "Payment Method: $payment_method\n";
            $user_message .= "Payment Status: $payment\n";
            $user_message .= "Payment ID: $payment_id\n";
            // Send email to user
            mail($p_mail, $user_subject, $user_message);

            // Redirect to confirmed-booking.php
            header("Location: confirmed-booking.php?dr_name=$dr_name&designation=$designation&selected_date=$selected_date&selected_day=$selected_day&appointment_time=$appointment_time&price=$price&payment_method=$payment_method&p_name=$p_name&src=$src");
            exit; // Make sure to exit after redirecting
        } else {
            echo "Error retrieving data: " . mysqli_error($conn);
        }
        exit; // Make sure to exit after redirecting
        
    } else {
        echo "Error updating payment status: " . mysqli_error($conn);
    }
} else {
    echo "Missing parameters in URL!";
}
?>
