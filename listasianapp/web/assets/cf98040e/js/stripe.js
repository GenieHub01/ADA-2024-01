/**
 * Created by k on 03.03.16.
 */
$(function() {
    $('#payment-form').submit(function(event) {
        var $form = $(this);

        // Disable the submit button to prevent repeated clicks
        $form.find('.submit-payment').prop('disabled', true);

        Stripe.card.createToken($form, stripeResponseHandler);

        // Prevent the form from submitting with the default action
        return false;
    });
});

function stripeResponseHandler(status, response) {
    var $form = $('#payment-form');

    if (response.error) {
        // Show the errors on the form
        $form.find('.payment-errors').text(response.error.message);
        $form.find('.submit-payment').prop('disabled', false);
        $.post('payTracking', {url: location.href});
    } else {
        // response contains id and card, which contains additional card details
        var token = response.id;
        // Insert the token into the form so it gets submitted to the server
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        // and submit
        $form.get(0).submit();
    }
};