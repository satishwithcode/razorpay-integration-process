<?php include 'db.php';
// Assuming you have already included necessary files and initialized variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
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
    
    // Retrieve patient data
    $p_name = $_POST["p_name"];
    $contact = $_POST["contact"];
    $p_mail = $_POST["p_mail"];
    $p_age = $_POST["p_age"];
    $gender = $_POST["gender"];

    // Add your database connection code here
    // For example:
    // $conn = new mysqli("your_database_host", "your_database_username", "your_database_password", "your_database_name");
    // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
 //print_r($p_name);
 //exit();
    // Prepare SQL statement to insert data into the table
    $sql = "INSERT INTO appointments (dr_name, designation, src, price, duration, selected_day, selected_date, appointment_time, appointment_type, payment_method, p_name, contact, p_mail, p_age, gender)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssss", $dr_name, $designation, $src, $price, $duration, $selected_day, $selected_date, $appointment_time, $appointment_type, $payment_method, $p_name, $contact, $p_mail, $p_age, $gender);
 
    // Execute the statement
    if ($stmt->execute()) {
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
        $admin_message .= "\nPatient Details:\n";
        $admin_message .= "Name: $p_name\n";
        $admin_message .= "Contact: $contact\n";
        $admin_message .= "Email: $p_mail\n";
        $admin_message .= "Age: $p_age\n";
        $admin_message .= "Gender: $gender\n";
        // Add more information as needed
        mail($admin_email, $admin_subject, $admin_message);

        // Send thank you email to user
        $user_subject = "Thank You for Booking an Appointment";
        $user_message = "Dear $p_name,\n\n";
        $user_message .= "Thank you for booking an appointment with us.\n";
        $user_message .= "Here are the details of your appointment:\n";
        $user_message .= "Doctor Name: $dr_name\n";
        $user_message .= "Appointment Date: $selected_date, $selected_day\n";
        $user_message .= "Appointment Time: $appointment_time\n";
        $user_message .= "Fee: ₹$price\n";
        $user_message .= "Payment Method: $payment_method\n";
        // Add more information as needed
        mail($p_mail, $user_subject, $user_message);

        // Redirect to confirmed-booking.php
        header("Location: confirmed-booking.php?dr_name=$dr_name&designation=$designation&src=$src&price=$price&duration=$duration&selected_day=$selected_day&selected_date=$selected_date&appointment_time=$appointment_time&appointment_type=$appointment_type&payment_method=$payment_method&p_name=$p_name");
        exit; // Make sure to exit after redirecting
    } else {
        // If the execution fails, display an error message or redirect to an error page
        header("Location: error.php");
        exit;
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    // If the request method is not POST, redirect to some other page or display an error message
    header("Location: error.php");
    exit;
}
?>
