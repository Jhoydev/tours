
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

$("#inp_country").change(function(){
    let id = this.value;
    let url = $('#url_states').val() + "/" + id;
    let text = "";
    let sel = $('#state_id');
    $.get(url,(res)=>{
        sel.html(text);
        text += `<option value=""></option>`;
        $(res).each(function(index,val) {
            text += `<option value="${val.id}">${val.name}</option>`;
        });
        sel.html(text);
        $('#city_id').html('');
    })
});

$("#state_id").change(function(){
    let id = this.value;
    let url = $('#url_cities').val() + "/" + id;
    let text = "";
    let sel = $('#city_id');
    $.get(url,(res)=>{
        sel.html(text);
        text += `<option value=""></option>`;
        $(res).each(function(index,val) {
            text += `<option value="${val.id}">${val.name}</option>`;
        });
        sel.html(text);
    })
});

function getSates(){
    let country_id = $("#inp_country").val();
    let url = $('#url_states').val() + "/" + country_id;
    let id = $('#value_state_id').val();
    let text = "";
    let sel = $('#state_id');
    $.get(url,(res)=>{
        let selected = "";
        $(res).each(function(index,val) {
            if (val.id == id){
                selected = "selected";
            }
            text += `<option value="${val.id}" ${selected}>${val.name}</option>`;
            selected = "";
        });
        sel.html(text);
        getCities();
    })
}
function getCities(){
    let state_id = $("#state_id").val();
    let url = $('#url_cities').val() + "/" + state_id;
    let id = $('#value_city_id').val();
    let text = "";
    let sel = $('#city_id');
    $.get(url,(res)=>{
        let selected = "";
        $(res).each(function(index,val) {
            if (val.id == id){
                selected = "selected";
            }
            text += `<option value="${val.id}" ${selected}>${val.name}</option>`;
            selected = "";
        });
        sel.html(text);
    })
}