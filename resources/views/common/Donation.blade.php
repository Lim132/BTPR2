@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Make a Donation</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <form action="{{ route('donation.post') }}" method="POST" 
                          class="require-validation" 
                          data-cc-on-file="false" 
                          data-stripe-publishable-key="{{ config('services.stripe.key') }}" 
                          id="payment-form">
                        @csrf

                        <div class="form-group mb-3">
                            <label>Donation Amount (RM)</label>
                            <input type="number" name="amount" class="form-control" required min="1" step="0.01">
                        </div>

                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" name="donor_email" class="form-control" required 
                                   value="{{ Auth::user()->email ?? '' }}">
                        </div>

                        <div class="form-group mb-3">
                            <label>Name (Optional)</label>
                            <input type="text" name="donor_name" class="form-control" 
                                   value="{{ Auth::user()->name ?? '' }}">
                        </div>

                        <div class="form-group mb-3">
                            <label>Message (Optional)</label>
                            <textarea name="message" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label>Name on Card</label>
                                            <input type="text" class="form-control" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Card Number</label>
                                            <input type="text" class="form-control card-number" required>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>CVC</label>
                                                    <input type="text" class="form-control card-cvc" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Expiration Month</label>
                                                    <input type="text" class="form-control card-expiry-month" placeholder="MM" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Expiration Year</label>
                                                    <input type="text" class="form-control card-expiry-year" placeholder="YYYY" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                Donate Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
$(function() {
    var $form = $(".require-validation");
    
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        
        $errorMessage.addClass('hide');
        $('.has-error').removeClass('has-error');
        
        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
        });
        
        if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }
    });
    
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
});
</script>
@endsection
