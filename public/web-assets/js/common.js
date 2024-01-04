// for-page-loader
$(window).on('load', function() {
    "use strict";
    $("#preload").delay(600).fadeOut(500);
    $(".pre-loader").delay(600).fadeOut(500);
})

// for-header-sticky
$(window).scroll(function() {
    "use strict";
    if ($(this).scrollTop() > 80) {
        $('#header1').addClass('fixed-top');
    } else {
        $('#header1').removeClass('fixed-top');
    }
});
// for-disable-input-characters
$('#card_number, #card_cvc, #amount').keyup(function() {
    "use strict";
    var val = $(this).val();
    if(isNaN(val)){
        val = val.replace(/[^0-9\.]/g,'');
        if(val.split('.').length>2){
            val = val.replace(/\.+$/,"");
        }
    }
    $(this).val(val);
});

// Back to Top Button JS
$(window).scroll(function() {
    "use strict";
    if ($(window).scrollTop() > 300) {
        $('#back-to-top').addClass('show');
    } else {
        $('#back-to-top').removeClass('show');
    }
});
$('#back-to-top').on('click', function(e) {
    "use strict";
    e.preventDefault();
    $('html, body').animate({
        scrollTop: 0
    }, '300');
});

$("img[data-enlargable]").addClass("img-enlargable").click(function() {
    "use strict";
    var src = $(this).attr("src");
    $("<div>").css({
            background: "RGBA(0,0,0,.5) url(" + src + ") no-repeat center",
            backgroundSize: "contain",
            width: "100%",
            height: "100%",
            position: "fixed",
            zIndex: "10000",
            top: "0",
            left: "0",
            cursor: "zoom-out"
        })
        .click(function() {
            $(this).remove();
        })
        .appendTo("body");
});

function myFunction() {
    "use strict";
    toastr.error("This operation was not performed due to demo mode");
}

// For all sweet-alerts
const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success mx-1',
        cancelButton: 'btn btn-danger mx-1'
    },
    buttonsStyling: false
})
function swal_cancelled(issettitle) {
    "use strict";
    var title = wrong;
    if (issettitle) {
        title = "" + issettitle + "";
    }
    swalWithBootstrapButtons.fire('Cancelled', title, 'error')
};
function restaurantclosed() {
    "use strict";
    swalWithBootstrapButtons.fire({
        icon: 'error',
        title: restaurant_closed,
        showCancelButton: false,
        confirmButtonText: okay,
        reverseButtons: true
    }).then((result) => {
        result.dismiss === Swal.DismissReason.cancel
    })
}
function ordersuccess(trackurl,order_id,continueurl) {
    "use strict";
    window.location = continueurl+'/success-'+order_id;
    // swalWithBootstrapButtons.fire({
    //     icon: 'success',
    //     title: order_placed,
    //     text: order_placed_note,
    //     showCancelButton: true,
    //     confirmButtonText: track_order,
    //     cancelButtonText: continue_shopping,
    //     closeOnConfirm: false,
    //     closeOnCancel: false,
    //     allowOutsideClick: false,
    //     allowEscapeKey: false,
    //     reverseButtons: true,
    // }).then((result) => {
    //     if (result.isConfirmed) {
    //         window.location = trackurl+'-'+order_id;
    //     } else {
    //         window.location = continueurl;
    //     }
    // })
}
function removefromcart(nexturl,note,goto_cart) {
    "use strict";
    swalWithBootstrapButtons.fire({
        icon: "warning",
        title: are_you_sure,
        text: note,
        showCancelButton: true,
        confirmButtonText: goto_cart,
        cancelButtonText: no,
        closeOnConfirm: false,
        closeOnCancel: false,
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = nexturl;
        } else {
            result.dismiss === Swal.DismissReason.cancel
        }
    });
}
function logout(nexturl,are_you_sure_logout,logout) {
    "use strict";
    swalWithBootstrapButtons.fire({
        icon: "warning",
        title: are_you_sure_logout,
        showCancelButton: true,
        confirmButtonText: logout,
        cancelButtonText: no,
        closeOnConfirm: false,
        closeOnCancel: false,
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = nexturl;
        } else {
            result.dismiss === Swal.DismissReason.cancel
        }
    });
}

function managefavorite(slug, type, manageurl,url) {
    "use strict";
    
    $("#preload").show();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: manageurl,
        data: {
            slug: slug,
            type: type,
            favurl: manageurl,
            url : url,
        },
        method: 'POST',
        success: function(response) {
            if (window.location.href.includes("item-") || window.location.href.includes("favouritelist")) {
                location.reload();
            } else {
                $("#preload").hide();
                $('.set-fav-' + slug).html(response.data);
            }
        },
        error: function(e) {
            $("#preload").hide();
            return false;
        }
    });
}

function addtocart(addcarturl) {
    "use strict";
    var slug = $('#slug').val();
    var item_name = $('#item_name').val();
    var item_type = $('#item_type').val();
    var image_name = $('#image_name').val();
    var item_tax = $('#item_tax').val();
    var item_price = $('#item_price').val();
    var variation_id = $("input[name='variation']:checked").attr('data-variation-id');
    var variation_name = $("input[name='variation']:checked").attr('data-variation-name');
    var addons_id = $('.addons-checkbox:checked').map(function() {
        return $(this).attr('data-addons-id');
    }).get().join(',');
    var addons_name = ($('.addons-checkbox:checked').map(function() {
        return $(this).attr('data-addons-name');
    }).get().join(','));
    var addons_price = ($('.addons-checkbox:checked').map(function() {
        return $(this).attr('data-addons-price');
    }).get().join(','));
    calladdtocart(slug, item_name, item_type, image_name, item_tax, item_price, variation_id, variation_name,
        addons_id, addons_name, addons_price, addcarturl);
};

function calladdtocart(slug, item_name, item_type, image_name, item_tax, item_price, variation_id, variation_name,addons_id, addons_name, addons_price, addcarturl) {
    "use strict";
    $("#preload").show();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: addcarturl,
        data: {
            slug: slug,
            item_name: item_name,
            item_type: item_type,
            image_name: image_name,
            tax: item_tax,
            item_price: item_price,
            variation_id: variation_id,
            variation_name: variation_name,
            addons_id: addons_id,
            addons_name: addons_name,
            addons_price: addons_price,
        },
        method: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.total_item_count == 1) {
                location.reload();
            } else {
                $("#preload").hide();
                $('.cart-badge').html(response.data);
                $('.item-total-qty-' + slug).val(response.total_item_count);
                toastr.success(response.message);
                $("input:checkbox").prop('checked', false);
                $("#modalitemdetails").modal('hide');
            }
        },
        error: function(error) {
            $("#preload").hide();
            toastr.error(wrong);
            $("input:checkbox").prop('checked', false);
            $("#modalitemdetails").modal('hide');
        }
    })
}

function showitem(slug, showurl) {
    "use strict";
    $("#preload").show();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: showurl,
        data: {
            slug: slug
        },
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            $("#preload").hide();
            $("input:checkbox").prop('checked', false);
            $("#modalitemdetails").modal('show');
            $('#slug').val(response.itemdata.slug);
            $('#item_name').val(response.itemdata.item_name);
            $('#item_type').val(response.itemdata.item_type);
            $('#item_tax').val(response.itemdata.tax);
            $('#image_name').val(response.itemdata.image_name);
            $('.attribute').text(response.itemdata.attribute);
            $('.item_name').text(response.itemdata.item_name);
            $('#item_type_image').html("<img class='item-type-image mt-1' src=" + response.itemdata
                .item_type_image + ">");
            $('.varition-listing').html('');
            $('.addons-listing').html('');

            var sessionValue= $("#hdnsession").val();
            var classforview = "";
            if (sessionValue == "rtl") {
                var classforview = "d-flex";
                var classforcheckbox = "ms-0";
            }

            if (response.itemdata.addons != "") {
                $('#addons').show();
                let freehtml = '';
                for (let j in response.itemdata.addons) {
                    freehtml +=
                        '<div class="form-check '+classforview+'"><input class="form-check-input cursor-pointer addons-checkbox '+classforcheckbox+'" type="checkbox" value="' +
                        response.itemdata.addons[j].id + '" data-addons-id="' + response.itemdata
                        .addons[j].id + '" data-addons-price="' + response.itemdata.addons[j].price +
                        '" data-addons-name="' + response.itemdata.addons[j].name +
                        '" onclick="getaddons(this)" id="addons' + response.itemdata.addons[j].id +
                        '"><label class="form-check-label cursor-pointer me-2" for="addons' + response
                        .itemdata.addons[j].id + '">' + response.itemdata.addons[j].name + '</label><label class="form-check-label cursor-pointer me-2" for="addons' + response
                        .itemdata.addons[j].id + '"> : ' + currency_format(response.itemdata.addons[j].price) + '</label></div>';
                }
                $('.addons-listing').html(freehtml);
            } else {
                $('#addons').hide();
            }
            if (response.itemdata.has_variation == 2) {
                var itemprice = response.itemdata.price;
                $('#variation').hide();
            } else {
                $('#variation').show();
                let variationhtml = '';
                var itemprice = 0;
                for (let i in response.itemdata.variation) {
                    var select = "";
                    var variation_id = "";
                    var variation_name = "";
                    if (i == 0) {
                        select = "checked";
                        itemprice = response.itemdata.variation[i].product_price;
                        variation_id = response.itemdata.variation[i].id;
                        variation_name = response.itemdata.variation[i].variation;
                    }
                    variationhtml +=
                        '<div class="form-check '+classforview+'"><input class="form-check-input cursor-pointer '+classforcheckbox+'" type="radio" data-variation-id="' +
                        response.itemdata.variation[i].id + '" data-variation-name="' + response
                        .itemdata.variation[i].variation + '" data-variation-price="' + response
                        .itemdata.variation[i].product_price + '" name="variation" id="variation-' + i +
                        '-' + response.itemdata.variation[i].id + '" value="' + response.itemdata
                        .variation[i].variation + '" ' + select +
                        ' onchange="getvaraitions(this)"><label class="form-check-label cursor-pointer me-2" for="variation-' +
                        i + '-' + response.itemdata.variation[i].id + '">' + response.itemdata
                        .variation[i].variation + '</label> <label class="form-check-label cursor-pointer me-2" for="variation-' +
                        i + '-' + response.itemdata.variation[i].id + '"> : ' + currency_format(response.itemdata.variation[
                            i].product_price) + '</label></div>';
                }
                $('.varition-listing').html(variationhtml);
            }
            $('#item_price').val(itemprice);
            $('#subtotal').val(itemprice);
            $('.item_price').html(currency_format(itemprice)).addClass('mb-0');
            $('.subtotal').html(currency_format(itemprice));
        },
        error: function(error) {
            $("#preload").hide();
            toastr.error(wrong);
            return false;
        }
    })
}

function getaddons(x) {
    "use strict";
    var price = parseFloat($(x).attr('data-addons-price'));
    var addonstotal = parseFloat($('#addonstotal').val());
    var item_price = parseFloat($('#item_price').val());
    var subtotal = parseFloat($('#subtotal').val());
    if ($(x).is(':checked')) {
        addonstotal += price;
        subtotal = item_price + addonstotal;
    } else {
        addonstotal -= price;
        subtotal = item_price + addonstotal;
    }
    $('#addonstotal').val(addonstotal);
    $('#subtotal').val(subtotal);
    $('.subtotal').text(currency_format(subtotal));
}

function getvaraitions(x) {
    "use strict";
    var price = parseFloat($(x).attr('data-variation-price'));
    var addonstotal = parseFloat($('#addonstotal').val());
    $('#item_variants_name').val($(x).attr('data-variation-name'));
    $('#item_price').val(price);
    $('.item_price').html(currency_format(price));
    $('#subtotal').val(addonstotal + price);
    $('.subtotal').text(currency_format(addonstotal + price));
}