<?php
include './config.php';
include './includes/db.php';
include './includes/pay.php';
include './includes/event.php';
$eventModel = new Event($db);
$availableEvent = $eventModel->getAvailableEvent();
$pageTitle = 'Testing';
$pageScript = "https://js.stripe.com/v3/";
include './frontend/partials/header.html';
// include './frontend/giving.html';
?>
<form id="payment-form">
    <!-- Google Pay/Payment Request Button will be placed here -->
    <div id="payment-request-button"></div>

    <!-- Card element container -->
    <div id="card-element">
        <!-- Stripe Elements will be inserted here -->
    </div>

    <!-- Display error messages -->
    <div id="card-errors" role="alert"></div>

    <button type="submit">Pay</button>
</form>


<div id="card-errors" role="alert"></div>

<script>
       var stripe = Stripe('pk_test_51PmFiu02eysoiQ0x66ktCGXziza5Mk6wnyte1DU8ExYsoHZjjGKbQ1Kchn3UMiiHOOOcLdqhigurMR1y0KYmBKFZ00rQsZjEIX');
       var elements = stripe.elements();

  var style = {
    base: {
      color: '#32325d',
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: 'antialiased',
      fontSize: '16px',
      '::placeholder': {
        color: '#aab7c4'
      }
    },
    invalid: {
      color: '#fa755a',
      iconColor: '#fa755a'
    }
  };

  var card = elements.create('card', {style: style});
card.mount('#card-element');

// Create a Payment Request for GPay
var paymentRequest = stripe.paymentRequest({
    country: 'US',
    currency: 'usd',
    total: {
        label: 'Total',
        amount: 1000, // Amount in cents
    },
    requestPayerName: true,
    requestPayerEmail: true,
});

var prButton = elements.create('paymentRequestButton', {
    paymentRequest: paymentRequest,
});

// Check if the Payment Request is available
paymentRequest.canMakePayment().then(function(result) {
    if (result) {
        // Mount the Payment Request Button (GPay button)
        prButton.mount('#payment-request-button');
    } else {
        // Hide the Payment Request Button if not available
        document.getElementById('payment-request-button').style.display = 'none';
    }
});

// Handle form submission
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Display error.message in your UI
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Send the token to your server
            stripeTokenHandler(result.token);
        }
    });
});

function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
}
</script>
<?php include './frontend/partials/footer.html' ?>