if ( document.getElementById('stripekey') && $('#stripekey').val() !== "") {
    var stripe = Stripe($('#stripekey').val());
    var card = stripe.elements().create('card', {
        style: {
            base: {
                // Add your base input styles here. For example:
                fontSize: '16px',
                color: '#32325d',
            },
        }
    });
    card.mount('#card-element');
    $('.__PrivateStripeElement iframe').removeAttr('style');
}
// TO-HIDE-PAYMENT-TYPE-ERROR
$('input:radio[name=transaction_type]').on('click', function (event) {
    "use strict";
    validate_transaction_type($(this).val())
});
setTimeout(function () {
    "use strict";
    $('input:radio[name=transaction_type]:checked').on('click', function (event) {
        "use strict";
        validate_transaction_type($(this).val())
    }).click();
}, 2000);
function validate_transaction_type(type) {
    "use strict";
    $('.paymenterror').addClass('d-none');
    if (type == 4) {
        $('#payment-form').removeClass('d-none');
    } else {
        $('#payment-form').addClass('d-none');
    }
}
function addmoney() {
    "use strict";
    // common-variables

    var mercadopagourl = $('#mercadopagourl').val();
    var myfatoorahurl = $('#myfatoorahurl').val();
    var toyyibpayurl = $('#toyyibpayurl').val();
    var paypalurl = $('#paypalurl').val();


    var order_notes = $('#order_notes').val();
    var walleturl = $('#walleturl').val();
    var successurl = $('#successurl').val();
    var addsuccessurl = $('#addsuccessurl').val();
    var addfailurl = $('#addfailurl').val();

    var user_name = $('#user_name').val();
    var user_email = $('#user_email').val();
    var user_mobile = $('#user_mobile').val();
    var amount = $('#amount').val();
    var transaction_type = $("input:radio[name=transaction_type]:checked").val();
    var transaction_currency = $("input:radio[name=transaction_type]:checked").attr('data-currency');
    // TO-CHECK-PAYMENT-TYPE-IS-SELECTED-OR-NOT
    if (amount == null || amount <= 0) {
        $('.amounterror').removeClass('d-none');
        return false;
    } else {
        $('.amounterror').addClass('d-none');
    }
    // TO-CHECK-PAYMENT-TYPE-IS-SELECTED-OR-NOT
    if (transaction_type == null) {
        $('.paymenterror').removeClass('d-none');
        return false;
    } else {
        $('.paymenterror').addClass('d-none');
        $('.walleterror').addClass('d-none');
    }
    $("#preload").show();
    //Razorpay
    if (transaction_type == 3) {
        var options = {
            "key": $('#razorpaykey').val(),
            "amount": parseInt(amount * 100),
            "name": "SingleRestaurant",
            "description": "Razorpay Order payment",
            "image": 'https://badges.razorpay.com/badge-light.png',
            "handler": function (response) {
                $('#preload').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: walleturl,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        amount: amount,
                        transaction_type: transaction_type,
                        transaction_id: response.razorpay_payment_id,
                    },
                    success: function (response) {
                        if (response.status == 1) {
                            window.location.href = successurl;
                        } else {
                            $('#preload').hide();
                            $('.paymenterror').removeClass('d-none').html(response.message);
                            setTimeout(function () {
                                $(".paymenterror").addClass('d-none');
                            }, 50000);
                        }
                    },
                    error: function (error) {
                        $('#preload').hide();
                        $('.paymenterror').removeClass('d-none').html(error);
                        setTimeout(function () {
                            $(".paymenterror").addClass('d-none');
                        }, 50000);
                    }
                });
            },
            "modal": {
                "ondismiss": function(){
                    location.reload();
                }
            },
            "prefill": {
                "name": user_name,
                "email": user_email,
                "contact": user_mobile,
            },
            "theme": {
                "color": "#366ed4"
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
    }
    // stripe
    if (transaction_type == 4) {
        var form = document.getElementById('payment-form');
        stripe.createToken(card).then(function (result) {
            if (result.error) {
                toastr.error(result.error.message);
                return false;
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: walleturl,
                    data: {
                        amount: amount,
                        transaction_type: transaction_type,
                        transaction_id: result.token.id,
                    },
                    method: 'POST',
                    success: function (response) {
                        if (response.status == 1) {
                            window.location.href = successurl;
                        } else {
                            $('#preload').hide();
                            $('.paymenterror').removeClass('d-none').html(response.message);
                            setTimeout(function () {
                                $(".paymenterror").addClass('d-none');
                            }, 50000);
                            return false;
                        }
                    },
                    error: function (error) {
                        $('#preload').hide();
                        $('.paymenterror').removeClass('d-none').html(error);
                        setTimeout(function () {
                            $(".paymenterror").addClass('d-none');
                        }, 50000);
                        return false;
                    }
                });
            }
        });
    }
    //Flutterwave
    if (transaction_type == 5) {
        FlutterwaveCheckout({
            public_key: $('#flutterwavekey').val(),
            tx_ref: user_name,
            amount: amount,
            currency: transaction_currency,
            payment_options: "",
            customer: {
                name: user_name,
                email: user_email,
                phone_number: user_mobile,
            },
            callback: function (data) {
                $('#preload').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: walleturl,
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        amount: amount,
                        transaction_type: transaction_type,
                        transaction_id: data.flw_ref,
                    },
                    success: function (response) {
                        if (response.status == 1) {
                            window.location.href = successurl;
                        } else {
                            $('#preload').hide();
                            $('.paymenterror').removeClass('d-none').html(response.message);
                            setTimeout(function () {
                                $(".paymenterror").addClass('d-none');
                            }, 50000);
                        }
                    },
                    error: function (error) {
                        $('#preload').hide();
                        $('.paymenterror').removeClass('d-none').html(error);
                        setTimeout(function () {
                            $(".paymenterror").addClass('d-none');
                        }, 50000);
                    }
                });
            },
            onclose: function () {
                location.reload();
            },
            customizations: {
                title: "SingleRestaurant",
                description: 'Flutterwave Order payment',
                logo: "https://flutterwave.com/images/logo/logo-mark/full.svg",
            },
        });
    }
    //Paystack
    if (transaction_type == 6) {
        let handler = PaystackPop.setup({
            key: $('#paystackkey').val(),
            email: user_email,
            amount: amount * 100,
            currency: transaction_currency, // Use GHS for Ghana Cedis or USD for US Dollars
            ref: 'trx_' + Math.random().toString(16).slice(2),
            label: "Paystack Order payment",
            onClose: function () {
                location.reload();
            },
            callback: function (response) {
                $('#preload').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: walleturl,
                    data: {
                        amount: amount,
                        transaction_type: transaction_type,
                        transaction_id: response.trxref,
                    },
                    method: 'POST',
                    success: function (response) {
                        if (response.status == 1) {
                            window.location.href = successurl;
                        } else {
                            $('#preload').hide();
                            $('.paymenterror').removeClass('d-none').html(response.message);
                            setTimeout(function () {
                                $(".paymenterror").addClass('d-none');
                            }, 50000);
                            return false;
                        }
                    },
                    error: function (error) {
                        $('#preload').hide();
                        $('.paymenterror').removeClass('d-none').html(error);
                        setTimeout(function () {
                            $(".paymenterror").addClass('d-none');
                        }, 50000);
                        return false;
                    }
                });
            }
        });
        handler.openIframe();
    }


     //MercadoPago

     if (transaction_type == 7)
     {
         $("#preload").show();
         $.ajax({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             url: mercadopagourl,
             data: { 
                 grand_total: amount,
                 transaction_type: transaction_type,
                 name: user_name,
                 mobile: user_mobile,
                 email: user_email,
                 successurl : addsuccessurl,
                 failurl : addfailurl,
             },
             method: 'POST',
             success: function (response) {
                 if (response.status == 1) {
                      window.location.href = response.redirecturl;
                 } else {
                     toastr.error(response.message);
                     $("#preload").hide();
                     return false;
                 }
             },
             error: function (error) {
                 $('#preload').hide();
                 $('.paymenterror').removeClass('d-none').html(error);
                 setTimeout(function () {
                     $(".paymenterror").addClass('d-none');
                 }, 5000);
                 return false;
             }
         });
     }
     //myfatoorah
 
     if (transaction_type == 8)
     {
         $("#preload").show();
         $.ajax({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             url: myfatoorahurl,
             data: {
                 grand_total: amount,
                 transaction_type: transaction_type,
                 name: user_name,
                 mobile: user_mobile,
                 email: user_email,
                 successurl : addsuccessurl,
                 failurl : addfailurl,
             },
             method: 'POST',
             success: function (response) {
                 if (response.status == 1) {
                      window.location.href = response.nexturl;
                 } else {   
                     toastr.error(response.message);
                     $("#preload").hide();
                     return false;
                 }
             },
             error: function (error) {
          
                 $('.paymenterror').removeClass('d-none').html(error);
                 setTimeout(function () {
                     $(".paymenterror").addClass('d-none');
                 }, 5000);
                 return false;
             }
         });
     }
 
      //paypal
 
      if (transaction_type == 9)
      {
         $("#preload").show();
         $.ajax({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             url: paypalurl,
             data: {
                 grand_total: amount,
                 transaction_type: transaction_type,
                 name: user_name,
                 mobile: user_mobile,
                 email: user_email,
                 successurl : addsuccessurl,
                 failurl : addfailurl,
                 return: '1',
             },
             method: 'POST',
             success: function (response) {
                 if (response.status == 1) {
                    $('#preloader').hide();
                    $(".callpaypal").trigger("click")
                    //  window.location.href = response.redirecturl;
                 } else {
                     
                     toastr.error(response.message);
                     $("#preload").hide();
                     return false;
                 }
             },
             error: function (error) {
                 $('#preload').hide();
                 $('.paymenterror').removeClass('d-none').html(error);
                 setTimeout(function () {
                     $(".paymenterror").addClass('d-none');
                 }, 5000);
                 return false;
             }
         });
      } 
 
      //toyyibpay
 
     if (transaction_type == 10)
     {
         $("#preload").show();
         $.ajax({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             url: toyyibpayurl,
             data: {
                 grand_total: amount,
                 transaction_type: transaction_type,
                 name: user_name,
                 mobile: user_mobile,
                 email: user_email,
                 successurl : addsuccessurl,
                 failurl : addfailurl,
             },
             method: 'POST',
             success: function (response) {
                 if (response.status == 1) {
                      window.location.href = response.redirecturl;
                 } else {   
                     toastr.error(response.message);
                     $("#preload").hide();
                     return false;
                 }
             },
             error: function (error) {
          
                 $('.paymenterror').removeClass('d-none').html(error);
                 setTimeout(function () {
                     $(".paymenterror").addClass('d-none');
                 }, 5000);
                 return false;
             }
         });
     }
}