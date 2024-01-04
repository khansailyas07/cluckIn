// for add item
var variation_row = 1;
function variation_fields(variation, product_price, sale_price) {
    "use strict";
    variation_row++;
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group mb-0 removeclass" + variation_row);
    divtest.innerHTML = '<div class="row panel-body variations"><div class="col-sm-6"><div class="form-group"><label for="variation" class="col-form-label">' + variation + '<span class="text-danger">*</span></label><input type="text" class="form-control variation" name="variation[]" id="variation" placeholder="' + variation + '" required=""></div></div><div class="col-sm-5"><div class="form-group"><label for="product_price" class="col-form-label">' + product_price + '<span class="text-danger">*</span></label><input type="text" class="form-control product_price" id="product_price" name="product_price[]" placeholder="' + product_price + '" required=""></div></div><div class="col-sm-4 d-none"><div class="form-group"><label for="product_price" class="col-form-label">' + sale_price + '<span class="text-danger">*</span></label><input type="text" class="form-control sale_price" id="sale_price" name="sale_price[]" placeholder="' + sale_price + '" required="" value="0"></div></div><div class="col-sm-1 d-flex align-items-end"><div class="form-group"><button class="btn btn-danger" type="button" onclick="remove_variation_fields(' + variation_row + ');"><i class="fa-sharp fa-solid fa-xmark"></i></button></div></div></div>';
    $('#more_variation_fields').append(divtest)
}
function remove_variation_fields(rid) {
    "use strict";
    $('.removeclass' + rid).remove();
}
// for update item
$(document).ready(function () {
    "use strict";
    $('#addproduct').on('submit', function (event) {
        "use strict";
        event.preventDefault();
        var form_data = new FormData(this);
        form_data.append('file', $('#file')[0].files);
        $('#preloader').show();
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: $("#storeimagesurl").val(),
            method: "POST",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (result) {
                $('#preloader').hide();
                var msg = '';
                $('div.gallery').html('');
                if (result.error.length > 0) {
                    for (var count = 0; count < result.error.length; count++) {
                        msg += '<div class="alert alert-danger">' + result.error[count] + '</div>';
                    }
                    $('#iiemsg').html(msg);
                    setTimeout(function () {
                        $('#iiemsg').html('');
                    }, 5000);
                } else {
                    msg += '<div class="alert alert-success mt-1">' + result.success + '</div>';
                    $('#message').html(msg);
                    $("#AddProduct").modal('hide');
                    $("#addproduct")[0].reset();
                    location.reload();
                }
            },
        })
    });
    $('#editimg').on('submit', function (event) {
        "use strict";
        event.preventDefault();
        var form_data = new FormData(this);
        $('#preloader').show();
        $.ajax({
            url: $("#updateimageurl").val(),
            method: 'POST',
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (result) {
                $('#preloader').hide();
                var msg = '';
                if (result.error.length > 0) {
                    for (var count = 0; count < result.error.length; count++) {
                        msg += '<div class="alert alert-danger">' + result.error[count] + '</div>';
                    }
                    $('#emsg').html(msg);
                    setTimeout(function () {
                        $('#emsg').html('');
                    }, 5000);
                } else {
                    location.reload();
                }
            },
        });
    });
});


function updateItemImage(id, imageurl) {
    "use strict";
    $('#preloader').show();
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: imageurl,
        data: { id: id },
        method: 'POST',
        dataType: 'json',
        success: function (response) {
            $('#preloader').hide();
            jQuery("#EditImages").modal('show');
            $('#idd').val(response.ResponseData.id);
            $('.galleryim').html("<img src=" + response.ResponseData.img + " class='img-fluid rounded mx-h-200'>");
            $('#old_img').val(response.ResponseData.image);
        },
        error: function (error) {
            $('#preloader').hide();
        }
    })
}
function DeleteVariation(id, item_id, deleteurl) {
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
                    url: deleteurl,
                    data: { id: id, item_id: item_id, },
                    method: 'POST',
                    success: function (response) {
                        if (response == 1) {
                            location.reload();
                        } else if (response == 2) {
                            swal_cancelled(cannot_delete)
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
function deleteItemImage(id, item_id, deleteurl) {
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
                    url: deleteurl,
                    data: { id: id, item_id: item_id, },
                    method: 'POST',
                    success: function (response) {
                        if (response == 1) {
                            location.reload();
                        } else if (response == 2) {
                            swal_cancelled(last_image)
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
function edititem_fields(variation, product_price, sale_price) {
    "use strict";
    var counter = document.getElementById('counter');
    var editroom = counter.innerHTML;
    editroom++;
    var editdivtest = document.createElement("div");
    editdivtest.setAttribute("class", "form-group mb-0 editremoveclass" + editroom);
    editdivtest.innerHTML = '<input type="hidden" class="form-control" id="variation_id" name="variation_id[' + editroom + ']"><div class="row panel-body"><div class="col-sm-6"><div class="form-group"><label for="variation" class="col-form-label">' + variation + '<span class="text-danger">*</span></label><input type="text" class="form-control variation" name="variation[' + editroom + ']" id="variation" placeholder="' + enter_variation + '" required=""></div></div><div class="col-sm-5"><div class="form-group"><label for="product_price" class="col-form-label">' + product_price + '<span class="text-danger">*</span></label><input type="text" class="form-control product_price" id="product_price" name="product_price[' + editroom + ']" placeholder="' + enter_product_price + '" required=""></div></div><div class="col-sm-4 d-none"><div class="form-group"><label for="product_price" class="col-form-label">' + sale_price + '<span class="text-danger">*</span></label><input type="text" class="form-control sale_price" id="sale_price" name="sale_price[' + editroom + ']" placeholder="' + enter_sale_price + '" required="" value="0"></div></div><div class="col-sm-1"> <div class="form-group"> <div class="input-group"> <div class="input-group-btn pt-35"> <button class="btn btn-danger" type="button" onclick="remove_edit_fields(' + editroom + ');"><i class="fa-sharp fa-solid fa-xmark"></i></button></div></div></div></div>';
    counter.innerHTML = editroom;
    $('#edititem_fields').append(editdivtest)
}
function remove_edit_fields(rid) {
    "use strict";
    $('.editremoveclass' + rid).remove();
}
// common
$('.has_variation').on('change', function () {
    "use strict";
    check_variation_validation($(this).val())
});
$('.has_variation:checked').on('change', function () {
    "use strict";
    check_variation_validation($(this).val())
}).change();
function check_variation_validation(value) {
    "use strict";
    if (value == 1) {
        document.getElementById('price_row').style.display = 'none';
        if (location.href.includes("add") == true) {
            document.getElementById('variations').style.display = 'flex';
        } else {
            document.getElementById('variations').style.display = 'grid';
        }
        $('.variations').show();
        $('.btn-add-variations').show();
        $(".variation").prop('required', true);
        $(".attribute").prop('required', true);
        $(".product_price").prop('required', true);
        $(".sale_price").prop('required', true);
        $("#price").prop('required', false);
    } else {
        document.getElementById('price_row').style.display = 'flex';
        document.getElementById('variations').style.display = 'none';
        $('#edititem_fields').html('');
        $('.variations').hide();
        $('.btn-add-variations').hide();
        $(".variation").prop('required', false);
        $(".attribute").prop('required', false);
        $(".product_price").prop('required', false);
        $(".sale_price").prop('required', false);
        $("#price").prop('required', true);
        $('#extrarows').html('');
    }
}
$('#cat_id').on('change', function () {
    "use strict";
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: $(this).attr('data-url'),
        data: { id: $(this).val() },
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.status == 1) {
                var html = '<option value="" selected>' + select + '</option>';
                $.each(response.data, function (key, value) {
                    html += '<option value="' + value.id + '" data-cat-id="' + value.cat_id + '">' + value.subcategory_name + '</option>';
                });
                $('#subcat_id').html(html);
            } else {
                $('.emsg').html(wrong)
            }
        },
        error: function (e) {
            $('.emsg').html(wrong)
        }
    });
}).change();



$(document).ready(function () {
    "use strict";
    $('#image').on('change', function () {
        "use strict";
        if (this.files) {
            var filesAmount = this.files.length;
            $('div.gallery').html('');
            $('div.gallery').addClass('row px-3');
            var n = 0;
            for (var i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    $($.parseHTML('<div>')).attr('class', 'imgdiv col-lg-2 col-md-3 col-4 text-center pb-2').attr('id', 'img_' + n).html('<img src="' + event.target.result + '" class="img-fluid rounded">').appendTo('div.gallery');
                    n++;
                }
                reader.readAsDataURL(this.files[i]);
            }
        }
    });
});

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
function StatusFeatured(id, status, featuredurl) {
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
                    url: featuredurl,
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
// delete item
function Delete(id, deleteurl) {
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