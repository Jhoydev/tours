
function showAlertError(errors) {
    var texto = '';
    $.each(errors, function (key, value) {
        texto += `<li>${value}</li>`;
    });
    var alert = `
    <div id="alert-ajax" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content bg-danger">
          <div class="modal-body">
            <p>${texto}</p>
          </div>
        </div>
      </div>
    </div>    
    `;
    $("#alert-ajax").remove();
    $('main > .container-fluid').prepend(alert);
    $('#alert-ajax').modal('show')
}
function showAlertSuccess(mensaje) {
    var alert = `
    <div id="alert-ajax" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content bg-success">
          <div class="modal-body text-center">
            <p>${mensaje}</p>
          </div>
        </div>
      </div>
    </div>
    `;
    $("#alert-ajax").remove();
    $('main > .container-fluid').prepend(alert);
    $('#alert-ajax').modal('show')
}

$('.submit_form_button').click(function (e) {
    e.preventDefault();
    document.getElementById("submit_form").submit();
});