       var stripe = Stripe('pk_test_51PmFiu02eysoiQ0x66ktCGXziza5Mk6wnyte1DU8ExYsoHZjjGKbQ1Kchn3UMiiHOOOcLdqhigurMR1y0KYmBKFZ00rQsZjEIX');
         var amount = parseInt(document.getElementById('amount').value) * 100; // Convert to cents
        var elements = stripe.elements();
        var paymentRequest = stripe.paymentRequest({
            country: 'US',
            currency: 'usd',
            total: {
                label: 'Total',
                amount: 0, // Amount in cents
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
        var card = elements.create('card',{
            hidePostalCode: true,});
        card.mount('#card-element');

        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }