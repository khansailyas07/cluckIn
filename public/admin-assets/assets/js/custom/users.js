function StatusUpdate(id, status, statusurl) {
    "use strict";
    swalWithBootstrapButtons.fire({
        icon: 'warning',
        title: are_you_sure,
        showCancelButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        confirmButtonText: yes,
        cancelButtonText: no,
        reverseButtons: true,
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: statusurl,
                    data: { id: id, status: status },
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
$(document).on('click', '.add, .deduct', function () {
    "use strict";
    event.preventDefault();
    var type = $(this).attr('data-type');
    var myurl = $(this).attr('data-url');
    var id = $('#id').val();
    var money = $('#price').val();
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: myurl,
        data: { id: id, type: type, money: money },
        method: 'POST',
        success: function (data) {
            if (data.success == 0) {
                $('#money_error').show();
                $('#money_error').text(data.errors.id || data.errors.type || data.errors.money || data.errors.amount);
            } else {
                $('#price').val('');
                $('#money_error').hide();
                $('.my_wallet').text(data.wallet);
                toastr.success(data.message);
            }
        },
        error: function (response) {
            $('#money_error').show();
            $('#money_error').text(response.responseJSON.errors.id || response.responseJSON.errors.type || response.responseJSON.errors.money || response.responseJSON.errors.amount);
        }
    });
});