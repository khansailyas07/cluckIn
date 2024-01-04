function initMap() {
    "use strict";
    create_map(parseFloat($('#lat').val()), parseFloat($('#lang').val()));
    var input = document.getElementById('address');
    var autocomplete = new google.maps.places.Autocomplete(input);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        $('#lat').val(place.geometry.location.lat());
        $('#lang').val(place.geometry.location.lng());
        create_map(place.geometry.location.lat(), place.geometry.location.lng());
    });
}
function create_map(lat, lang) {
    "use strict";
    var center = new google.maps.LatLng(lat, lang);
    var map = new google.maps.Map(document.getElementById('mymap'), {
        zoom: 16,
        center: center,
    });
    var myMarker = new google.maps.Marker({
        position: center,
        draggable: true,
        map: map
    });
    google.maps.event.addListener(myMarker, 'dragend', function () {
        map.setCenter(this.getPosition());
        $('#lat').val(this.getPosition().lat());
        $('#lang').val(this.getPosition().lng());
    });
    google.maps.event.addListener(map, 'dragend', function () {
        myMarker.setPosition(this.getCenter());
        $('#lat').val(this.getCenter().lat());
        $('#lang').val(this.getCenter().lng());
    });
}
$(document).ready(function () {
    "use strict";
    setTimeout(function () {
        $('#address').prop('disabled', false);
    }, 1000);
});
function show_feature_icon(x) {
    "use strict";
    $(x).next().html($(x).val())
}
var id = 1;
function add_features(icon, title, description) {
    "use strict";
    var html = '<div class="row remove' + id + '"><div class="col-md-3 form-group"><div class="input-group"><input type="text" class="form-control feature_icon" onkeyup="show_feature_icon(this)" name="feature_icon[]" placeholder="' + icon + '" required><p class="input-group-text"></p></div></div><div class="col-md-3 form-group"><input type="text" class="form-control" name="feature_title[]" placeholder="' + title + '" required></div><div class="col-md-5 form-group"><input type="text" class="form-control" name="feature_description[]" placeholder="' + description + '" required></div><div class="col-md-1 form-group"><button class="btn btn-danger" type="button" onclick="remove_features(' + id + ')"><i class="fa-sharp fa-solid fa-xmark"></i></button></div></div>';
    $('.extra_footer_features').append(html);
    $(".feature_required").prop('required', true);
    id++;
}
function remove_features(id) {
    "use strict";
    $('.remove' + id).remove();
    if ($('.extra_footer_features .row').length == 0) {
        $(".feature_required").prop('required', false);
    }
}
function delete_features(nexturl) {
    "use strict";
    swalWithBootstrapButtons.fire({
        icon: 'warning',
        title: are_you_sure,
        showCancelButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        confirmButtonText: yes,
        cancelButtonText: no,
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = nexturl;
        } else {
            result.dismiss === Swal.DismissReason.cancel
        }
    })
}

function statusupdate(statusurl) 
{
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
                    method: 'GET',
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
