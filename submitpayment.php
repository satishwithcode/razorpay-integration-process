<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, PATCH, DELETE');
header("Content-Type: application/json");
header("Accept: application/json");
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Access-Control-Allow-Methods, Content-Type');

if (isset($_POST['action']) && $_POST['action'] == 'payOrder') {

    // Your Razorpay credentials
    $razorpay_mode = 'test'; // Set to 'test' or 'live' as needed
    $razorpay_test_key = 'Your Test Key'; // Your Test Key
    $razorpay_test_secret_key = 'Your Test Secret Key'; // Your Test Secret Key
    $razorpay_live_key = 'Your Live Key'; // Your Live Key
    $razorpay_live_secret_key = 'Your Live Secret Key'; // Your Live Secret Key

    // Set your API key based on mode
    if ($razorpay_mode == 'test') {
        $razorpay_key = $razorpay_test_key;
        $authAPIkey = "Basic " . base64_encode($razorpay_test_key . ":" . $razorpay_test_secret_key);
    } else {
        $razorpay_key = $razorpay_live_key;
        $authAPIkey = "Basic " . base64_encode($razorpay_live_key . ":" . $razorpay_live_secret_key);
    }

    // Set transaction details
    $order_id = uniqid();
    $billing_name = $_POST['p_name']; // Use 'p_name' from JavaScript
    $billing_mobile = $_POST['contact']; // Use 'contact' from JavaScript
    $billing_email = $_POST['p_mail']; // Use 'p_mail' from JavaScript
    $paymentOption = $_POST['paymentOption'];
    $payAmount = $_POST['payAmount'];

    $note = "Payment of amount Rs. " . $payAmount;

    $postdata = array(
        "amount" => $payAmount * 100,
        "currency" => "INR",
        "receipt" => $note,
        "notes" => array(
            "notes_key_1" => $note,
            "notes_key_2" => ""
        )
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($postdata),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: ' . $authAPIkey
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $orderRes = json_decode($response);

    if (isset($orderRes->id)) {

        $rpay_order_id = $orderRes->id;

        $dataArr = array(
            'amount' => $payAmount,
            'description' => "Pay appointment fees of Rs. " . $payAmount,
            'rpay_order_id' => $rpay_order_id,
            'name' => $billing_name,
            'email' => $billing_email,
            'mobile' => $billing_mobile
        );

        echo json_encode(['res' => 'success', 'order_number' => $order_id, 'userData' => $dataArr, 'razorpay_key' => $razorpay_key]);
        exit;
    } else {
        echo json_encode(['res' => 'error', 'order_id' => $order_id, 'info' => 'Error with payment']);
        exit;
    }
} else {
    echo json_encode(['res' => 'error']);
    exit;
}
?>
