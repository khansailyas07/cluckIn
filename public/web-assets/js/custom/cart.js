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
            order_amount: order_amount
        },
        method: 'post',
        success: function (response) {
            $("#preload").hide();
            if (response.status == 1) 
            {
                $('#useroption').modal('show');
            } 
            else if (response.status == 2) 
            {
                toastr.error(response.message);
            } 
            else if(response.status == 3)
            {
                holduser()
            }
            else 
            {
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
function deletecartitem(id, deleteurl) {
    "use strict";
    swalWithBootstrapButtons.fire({
        icon: 'warning',
        title: are_you_sure,
        showCancelButton: true,
        confirmButtonText: yes,
        cancelButtonText: no,
        reverseButtons: true,
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: deleteurl,
                    data: { id: id },
                    method: 'POST',
                    success: function (response) {
                        if (response == 1) {
                            location.reload();
                        } else {
                            swal_cancelled()
                        }
                    },
                    error: function (e) {
                        swal_cancelled()
                    }
                });
            });
        },
    }).then((result) => {
        if (!result.isConfirmed) {
            result.dismiss === Swal.DismissReason.cancel
        }
    })
}
function qtyupdate(id, type, qtyurl) {
    "use strict";
    $('#preload').show();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: qtyurl,
        data: {
            id: id,
            type: type
        },
        method: 'POST',
        success: function (response) {
            if (response.status == 1) {
                location.reload();
            } else if (response.status == 2) {
                $('#preload').hide();
                toastr.error(response.message);
            } else {
                $('#preload').hide();
                $('.err' + id).html(response.message);
                return false;
            }
        },
        error: function (e) {
            $('#preload').hide();
            $('.err' + id).html(e.message);
            return false;
        }
    });
}
function holduser() {
    "use strict";
    var order_type = $("input:radio[name=order_type]:checked").val();
    if (order_type == null) {
        $('.holderror').removeClass('d-none');
        return false;
    } else {
        $('.holderror').addClass('d-none');
        $('#preload').show();
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: $('#data').attr('data-url'),
        data: {
            order_type: order_type
        },
        method: 'POST',
        success: function (response) {
            if (response.status == 1) {
                location.href = $('#data').attr('data-next-url');
            } else {
                $('#preload').hide();
                $('.holderror').removeClass('d-none').html(response.message);
                return false;
            }
        },
        error: function (e) {
            $('#preload').hide();
            $('.holderror').removeClass('d-none').html(e.message);
            return false;
        }
    });
}
function getoffercode(code) {
    "use strict";
    $('#offer_code').val(code);
}
function showaddons(name,price){
    "use strict";
    $('#modal_selected_addons').find('.list-group-flush').html('<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>');
    var response = '';
    $.each( name.split(',') , function( key, value ) {
        response += '<li class="list-group-item"> <b> ' + value + ' </b> <p class="mb-0">' + currency_format(price.split(',')[key]) + '</p> </li>';
    });
    $('#modal_selected_addons').find('.list-group-flush').html(response);
}

function showlogin()
{
    "use strict";
    window.location.href = "login";
}