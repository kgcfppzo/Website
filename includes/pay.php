<?php
// include "./backend/includes/db.php";
// $rootPath = $_SERVER['DOCUMENT_ROOT'].'/Rccf-website
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        \Stripe\Stripe::setApiKey($stripeApiKey);
        $description = isset($_POST['description']) ? trim($_POST['description']) : null;
        $full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : null;
        $amount = isset($_POST['amount']) ? trim($_POST['amount']) : null;
        $currency = 'usd';
        $token = isset($_POST['stripeToken']) ? trim($_POST['stripeToken']) : null;
        // Validate required fields
        // if (empty($payment_method)) {
        //     die("Title is required.");
        // }
        // if (empty($payment_type)) {
        //     die("Description is required.");
        // }
        // if (empty($full_name)) {
        //     die("Event image is required.");
        // }
        // if (empty($amount)) {
        //     die("Event image is required.");
        // }
        // if (empty($receipt_url)) {
        //     die("Event image is required.");
        // }

        // Create the event
        try {
            $charge = \Stripe\Charge::create([
                'amount' => $amount * 100,
                'currency' => $currency,
                'description' => $description,
                'source' => $token,
            ]);

            echo 'Payment Successful!';
            include "./includes/payment.php";
            $paymentModel = new Payment($db);
            $paymentModel->create($description, $full_name, $amount, $currency, $charge->id, $token, $charge->status);
            // echo "Payment created successfully.";
            // Optionally, redirect or set session variables as needed
            header('Location: ./success.html');
        } catch (Exception $e) {
            header('Location: ./error_page.html');
            echo "An error occurred while creating the event: " . $e->getMessage();
        }
    }
?>
