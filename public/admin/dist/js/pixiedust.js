var hostname = $(location).attr('origin') + "/pixiedust";

// Only Number check
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

// Image extension validation

function imageExtValidation(image_id) {
    var formData = new FormData();
    var file = document.getElementById(image_id).files[0];
    formData.append("Filedata", file);
    var t = file.type.split('/').pop().toLowerCase();
    if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        document.getElementById(image_id).value = '';
        return false;
    }
}

$(document).ready(function () {
    $('#ship-update').submit(function (e) {
        e.preventDefault(); //**** to prevent normal form submission and page reload
        var formData = $("#ship-update").serialize();
        if (($("#order_status").val() != "") && $("#shipping_url").val() != "" && $("#tracking_id").val() != "") {
            $("#ajax_loader_admin").show();
            $("#order_status,#shipping_url,#tracking_id,#updt_btn").attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: hostname + "/update-shipping",
                data: formData,
                success: function (result) {
                    $("#ajax_loader_admin").hide();
                    $("#succ_msg").delay(3000).fadeOut().html(result.msg).show();
                    $("#order_status,#shipping_url,#tracking_id,#updt_btn").attr('disabled', 'disabled');
                },
                error: function (xhr, ajaxOptions, thrownError) {

                }
            });
        }
        return false;
    });

});

