
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