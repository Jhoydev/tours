
function showAlertError(errors) {
    var texto = '';
    $.each(errors, function (key, value) {
        texto += '<li>' + value + '</li>';
    });
    var alert = '\n    <div id="alert-ajax" class="modal" tabindex="-1" role="dialog">\n      <div class="modal-dialog" role="document">\n        <div class="modal-content bg-danger">\n          <div class="modal-body">\n            <p>' + texto + '</p>\n          </div>\n        </div>\n      </div>\n    </div>    \n    ';
    $("#alert-ajax").remove();
    $('main > .container-fluid').prepend(alert);
    $('#alert-ajax').modal('show');
}
function showAlertSuccess(mensaje) {
    var alert = '\n    <div id="alert-ajax" class="modal" tabindex="-1" role="dialog">\n      <div class="modal-dialog" role="document">\n        <div class="modal-content bg-success">\n          <div class="modal-body text-center">\n            <p>' + mensaje + '</p>\n          </div>\n        </div>\n      </div>\n    </div>\n    ';
    $("#alert-ajax").remove();
    $('main > .container-fluid').prepend(alert);
    $('#alert-ajax').modal('show');
}

$('.submit_form_button').click(function (e) {
    e.preventDefault();
    document.getElementById("submit_form").submit();
});

$("#inp_country").change(function () {
    var id = this.value;
    var url = $('#url_states').val() + "/" + id;
    var text = "";
    var sel = $('#state_id');
    $.get(url, function (res) {
        sel.html(text);
        text += '<option value=""></option>';
        $(res).each(function (index, val) {
            text += '<option value="' + val.id + '">' + val.name + '</option>';
        });
        sel.html(text);
        $('#city_id').html('');
    });
});

$("#state_id").change(function () {
    var id = this.value;
    var url = $('#url_cities').val() + "/" + id;
    var text = "";
    var sel = $('#city_id');
    $.get(url, function (res) {
        sel.html(text);
        text += '<option value=""></option>';
        $(res).each(function (index, val) {
            text += '<option value="' + val.id + '">' + val.name + '</option>';
        });
        sel.html(text);
    });
});

function getSates() {
    var country_id = $("#inp_country").val();
    var url = $('#url_states').val() + "/" + country_id;
    var id = $('#value_state_id').val();
    var text = "";
    var sel = $('#state_id');
    $.get(url, function (res) {
        var selected = "";
        $(res).each(function (index, val) {
            if (val.id == id) {
                selected = "selected";
            }
            text += '<option value="' + val.id + '" ' + selected + '>' + val.name + '</option>';
            selected = "";
        });
        sel.html(text);
        getCities();
    });
}
function getCities() {
    var state_id = $("#state_id").val();
    var url = $('#url_cities').val() + "/" + state_id;
    var id = $('#value_city_id').val();
    var text = "";
    var sel = $('#city_id');
    $.get(url, function (res) {
        var selected = "";
        $(res).each(function (index, val) {
            if (val.id == id) {
                selected = "selected";
            }
            text += '<option value="' + val.id + '" ' + selected + '>' + val.name + '</option>';
            selected = "";
        });
        sel.html(text);
    });
}