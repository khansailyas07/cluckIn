if ($('#stripekey').val() !== "") {
    var stripe = Stripe($('#stripekey').val());
    var card = stripe.elements().create('card', {
        style: {
            base: {
                // Add your base input styles here. For example:
                fontSize: '16px',
                color: '#32325D',
            },
        }
    });
    card.mount('#card-element');
    $('.__PrivateStripeElement iframe').removeAttr('style');
}

// common-variables
var user_name = $('#user_name').val();
var user_email = $('#user_email').val();
var user_mobile = $('#user_mobile').val();
var orderurl = $('#orderurl').val();
var mercadopagourl = $('#mercadopagourl').val();
var myfatoorahurl = $('#myfatoorahurl').val();
var toyyibpayurl = $('#toyyibpayurl').val();
var paypalurl = $('#paypalurl').val();
var successurl = $('#successurl').val();
var paymentsuccess = $('#paymentsuccess').val();
var paymentfail = $('#paymentfail').val();
var continueurl = $('#continueurl').val();
var failurl1 = $('#failurl1').val();
var rest_lat = parseFloat($('#rest_lat').val());
var rest_lang = parseFloat($('#rest_lang').val());
var delivery_charge_per_km = parseFloat($('#delivery_charge_per_km').val());
var order_type = $('#order_type').val();
var delivery_charge = parseFloat($('#delivery_charge').val());
var sub_total = parseFloat($('#sub_total').val());
var grand_total = parseFloat($('#grand_total').val());
var tax_amount = parseFloat($('#totaltaxamount').val());
var address_type = "";
var address = "";
var house_no = "";
var authcheck = $('#authcheck').val();
var lat = "";
var lang = "";



// TO-HIDE-ADDRESS-ERROR
$('input:radio[name=myaddress]').click(function (event) {
    "use strict";
    validate_myaddress();
});
$('input:radio[name=myaddress]:checked').click(function (event) {
    "use strict";
    validate_myaddress();
}).click();
function validate_myaddress() {
    "use strict";
    $('.addresserror').addClass('d-none');
    address_type = $("input:radio[name=myaddress]:checked").attr('data-address-type');
    address = $("input:radio[name=myaddress]:checked").attr('address');
    house_no = $("input:radio[name=myaddress]:checked").attr('house_no');
    lat = parseFloat($("input:radio[name=myaddress]:checked").attr('lat'));
    lang = parseFloat($("input:radio[name=myaddress]:checked").attr('lang'));

        $("#preload").show();
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: $("input:radio[name=myaddress]:checked").attr('data-url'),
            data: { lat: lat, lang: lang },
            method: 'post',
            success: function (response) {
                $("#preload").hide();
                if (response.status == 1) {
                    $('#grand_total').val(parseFloat(grand_total) + parseFloat(response.delivery_charge));
                    $('.grand_total').html(currency_format(parseFloat(grand_total) + parseFloat(response.delivery_charge)));
                    $('#delivery_charge').val(response.delivery_charge);
                    $('.delivery_charge').html(currency_format(response.delivery_charge));
                   
                } else if (response.status == 2) {
                    $("input:radio[name=myaddress]:checked").prop('checked', false);
                    toastr.error(response.message);
                    return false;
                } else {
                    $("input:radio[name=myaddress]:checked").prop('checked', false);
                    toastr.error(wrong);
                    return false;
                }
            },
            error: function (e) {
                $("#preload").hide();
                toastr.error(wrong);
                return false;
            }
        });
    
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
    $('.walleterror').addClass('d-none');
    if (type == 4) {
        $('#payment-form').removeClass('d-none');
    } else {
        $('#payment-form').addClass('d-none');
    }
}
function isopenclose(opencloseurl, qty, order_amount) {
    "use strict";
    $("#preload").show();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: opencloseurl,
        data: {
            qty: qty,
            order_amount: order_amount,
        },
        method: 'post',
        success: function (response) {
            $("#preload").hide();
            if (response.status == 1) {
                {
                    validatedata();
                }
                
            } else if (response.status == 2) {
                toastr.error(response.message);
            }else if(response.status == 3)
            {
                    validatedata();
            } 
            else {
                restaurantclosed();
                return false;
            }
        },
        error: function (e) {
            $("#preload").hide();
            toastr.error(wrong);
            return false;
        }
    });
}


function validatedata() {
    "use strict";
    // common-variables 
    var order_notes = $('#order_notes').val();
    var transaction_type = $("input:radio[name=transaction_type]:checked").val();
    var transaction_currency = $("input:radio[name=transaction_type]:checked").attr('data-currency');
    var delivery_charge = parseFloat($('#delivery_charge').val());
    var grand_total = parseFloat($('#grand_total').val());

    // TO-CHECK-ADDRESS-IS-SELECTED-OR-NOT

    if (order_type == 1) {

        if(authcheck == 1)
        {
            var address_type = $("input:radio[name=myaddress]:checked").val();
        
            if (address_type == null) {
                $('.addresserror').removeClass('d-none');
                return false;
            } else {
                $('.addresserror').addClass('d-none');
            }
        }
        else
        {
            address_type = "";
            address = $('#address').val();
            house_no = $('#house_no').val();
            lat = $('#lat').val();
            lang = $('#lang').val();
        }

        if(address == null || house_no == null || lat == null || lang == null)
        {
            toastr.error("Please Select Address");
           return false;
        }
    }
    else
    {
        if(authcheck == 0)
        {
        user_name = $('#name').val();
        user_email = $('#email').val();
        user_mobile = $('#mobile').val();
        }
        address = "";
        house_no = "";
        lat = "";
        lang = "";

        if(user_name == "" || user_email == "" || user_mobile == "")
        {
            toastr.error("User Information are Required");
            return false;
        }
    }

    
    // TO-CHECK-PAYMENT-TYPE-IS-SELECTED-OR-NOT
    if (transaction_type == null) {
        $('.paymenterror').removeClass('d-none');
        return false;
    } else {
        $('.paymenterror').addClass('d-none');
        $('.walleterror').addClass('d-none');
    }
    // COD || Wallet
    if (transaction_type == 1 || transaction_type == 2) {
        $("#preload").show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: orderurl,
            data: {
                order_type: order_type,
                delivery_charge: delivery_charge,
                grand_total: grand_total,
                sub_total: sub_total,
                tax_amount: tax_amount,
                address_type: address_type,
                address: address,
                house_no: house_no,
                lat: lat,
                lang: lang,
                order_notes: order_notes,
                transaction_type: transaction_type,
                name: user_name,
                mobile: user_mobile,
                email: user_email
            },
            method: 'POST',
            success: function (response) {
                $('#preload').hide();
                if (response.status == 1) {
                    ordersuccess(successurl, response.order_id, continueurl);
                } else {
                    $('.paymenterror').removeClass('d-none').html(response.message);
                    setTimeout(function () {
                        $(".paymenterror").addClass('d-none');
                    }, 5000);
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
    //Razorpay
    if (transaction_type == 3) {
        var options = {
            "key": $('#razorpaykey').val(),
            "amount": parseInt(grand_total * 100),
            "name": "SingleRestaurant",
            "description": "Razorpay Order payment",
            "image": 'https://badges.razorpay.com/badge-light.png',
            "handler": function (response) {
                $("#preload").show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: orderurl,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        order_type: order_type,
                        delivery_charge: delivery_charge,
                        grand_total: grand_total,
                        sub_total: sub_total,
                        tax_amount: tax_amount,
                        address_type: address_type,
                        address: address,
                        house_no: house_no,
                        lat: lat,
                        lang: lang,
                        order_notes: order_notes,
                        transaction_type: transaction_type,
                        transaction_id: response.razorpay_payment_id,
                        name: user_name,
                        mobile: user_mobile,
                        email: user_email
                    },
                    success: function (response) {
                        $('#preload').hide();
                        if (response.status == 1) {
                            ordersuccess(successurl, response.order_id, continueurl);
                        } else {
                            $('.paymenterror').removeClass('d-none').html(response.message);
                            setTimeout(function () {
                                $(".paymenterror").addClass('d-none');
                            }, 5000);
                        }
                    },
                    error: function (error) {
                        $('#preload').hide();
                        $('.paymenterror').removeClass('d-none').html(error);
                        setTimeout(function () {
                            $(".paymenterror").addClass('d-none');
                        }, 5000);
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
                $("#preload").show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: orderurl,
                    data: {
                        order_type: order_type,
                        delivery_charge: delivery_charge,
                        grand_total: grand_total,
                        sub_total: sub_total,
                        tax_amount: tax_amount,
                        address_type: address_type,
                        address: address,
                        house_no: house_no,
                        lat: lat,
                        lang: lang,
                        order_notes: order_notes,
                        transaction_type: transaction_type,
                        transaction_id: result.token.id,
                        name: user_name,
                        mobile: user_mobile,
                        email: user_email
                    },
                    method: 'POST',
                    success: function (response) {
                        $('#preload').hide();
                        if (response.status == 1) {
                            ordersuccess(successurl, response.order_id, continueurl);
                        } else {
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
            amount: grand_total,
            currency: transaction_currency,
            payment_options: "",
            customer: {
                name: user_name,
                email: user_email,
                phone_number: user_mobile,
            },
            callback: function (data) {
                $("#preload").show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: orderurl,
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        order_type: order_type,
                        delivery_charge: delivery_charge,
                        grand_total: grand_total,
                        sub_total: sub_total,
                        tax_amount: tax_amount,
                        address_type: address_type,
                        address: address,
                        house_no: house_no,
                        lat: lat,
                        lang: lang,
                        order_notes: order_notes,
                        transaction_type: transaction_type,
                        transaction_id: data.flw_ref,
                        name: user_name,
                        mobile: user_mobile,
                        email: user_email
                    },
                    success: function (response) {
                        $('#preload').hide();
                        if (response.status == 1) {
                            ordersuccess(successurl, response.order_id, continueurl);
                        } else {
                            $('.paymenterror').removeClass('d-none').html(response.message);
                            setTimeout(function () {
                                $(".paymenterror").addClass('d-none');
                            }, 5000);
                        }
                    },
                    error: function (error) {
                        $('#preload').hide();
                        $('.paymenterror').removeClass('d-none').html(error);
                        setTimeout(function () {
                            $(".paymenterror").addClass('d-none');
                        }, 5000);
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
            amount: parseInt(grand_total * 100),
            currency: transaction_currency, // Use USD for US Dollars OR GHS for Ghana Cedis
            ref: 'trx_' + Math.random().toString(16).slice(2),
            label: "Paystack Order payment",
            onClose: function () {
                location.reload();
            },
            callback: function (response) {
                
                $("#preload").show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: orderurl,
                    data: {
                        order_type: order_type,
                        delivery_charge: delivery_charge,
                        grand_total: grand_total,
                        sub_total: sub_total,
                        tax_amount: tax_amount,
                        address_type: address_type,
                        address: address,
                        house_no: house_no,
                        lat: lat,
                        lang: lang,
                        order_notes: order_notes,
                        transaction_type: transaction_type,
                        transaction_id: response.trxref,
                        name: user_name,
                        mobile: user_mobile,
                        email: user_email
                    },
                    method: 'POST',
                    success: function (response) {
                        $('#preload').hide();
                        if (response.status == 1) {
                            ordersuccess(successurl, response.order_id, continueurl);
                        } else {
                            $('.paymenterror').removeClass('d-none').html(response.message);
                            setTimeout(function () {
                                $(".paymenterror").addClass('d-none');
                            }, 5000);
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
        });
        handler.openIframe();
    }

    //mercadopago

    if (transaction_type == 7)
    {
        $("#preload").show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: mercadopagourl,
            data: {
                order_type: order_type,
                delivery_charge: delivery_charge,
                grand_total: grand_total,
                sub_total: sub_total,
                tax_amount: tax_amount,
                address_type: address_type,
                address: address,
                house_no: house_no,
                lat: lat,
                lang: lang,
                order_notes: order_notes,
                transaction_type: transaction_type,
                name: user_name,
                mobile: user_mobile,
                email: user_email,
                successurl : paymentsuccess,
                failurl : paymentfail,
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
                order_type: order_type,
                delivery_charge: delivery_charge,
                grand_total: grand_total,
                sub_total: sub_total,
                tax_amount: tax_amount,
                address_type: address_type,
                address: address,
                house_no: house_no,
                lat: lat,
                lang: lang,
                order_notes: order_notes,
                transaction_type: transaction_type,
                name: user_name,
                mobile: user_mobile,
                email: user_email,
                successurl : paymentsuccess,
                failurl : paymentfail,
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
                order_type: order_type,
                delivery_charge: delivery_charge,
                grand_total: grand_total,
                sub_total: sub_total,
                tax_amount: tax_amount,
                address_type: address_type,
                address: address,
                house_no: house_no,
                lat: lat,
                lang: lang,
                order_notes: order_notes,
                transaction_type: transaction_type,
                name: user_name,
                mobile: user_mobile,
                email: user_email,
                successurl : paymentsuccess,
                failurl : paymentfail,
                return: '1',
            },
            method: 'POST',
            success: function (response) {
                if (response.status == 1) {
                    $('#preloader').hide();
                    $(".callpaypal").trigger("click")
                    
                    // window.location.href = response.redirecturl;
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
                order_type: order_type,
                delivery_charge: delivery_charge,
                grand_total: grand_total,
                sub_total: sub_total,
                tax_amount: tax_amount,
                address_type: address_type,
                address: address,
                house_no: house_no,
                lat: lat,
                lang: lang,
                order_notes: order_notes,
                transaction_type: transaction_type,
                name: user_name,
                mobile: user_mobile,
                email: user_email,
                successurl : paymentsuccess,
                failurl : paymentfail,
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

