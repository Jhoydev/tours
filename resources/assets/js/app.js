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
    $('.main-panel').prepend(alert);
    $('#alert-ajax').modal('show')
}

function showAlertSuccess(mensaje) {
    var alert = `
    <div id="alert-ajax" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content text-success">
          <div class="modal-body text-center">
            <p class="h3"><i class="fas fa-check"></i> ${mensaje}</p>
          </div>
        </div>
      </div>
    </div>
    `;
    $("#alert-ajax").remove();
    $('.main-panel').prepend(alert);
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
    if (id){
        blockInputsLocation(true);
        $.get(url,(res)=>{
            sel.html(text);
            text += `<option value=""></option>`;
            $(res).each(function(index,val) {
                text += `<option value="${val.id}">${val.name}</option>`;
            });
            sel.html(text);
            blockInputsLocation(false);
            $('#city_id').html('');
        })
    }

});

$("#state_id").change(function(){
    let id = this.value;
    let url = $('#url_cities').val() + "/" + id;
    let text = "";
    let sel = $('#city_id');
    if (id){
        blockInputsLocation(true);
    }
    $.get(url,(res)=>{
        sel.html(text);
        text += `<option value=""></option>`;
        $(res).each(function(index,val) {
            text += `<option value="${val.id}">${val.name}</option>`;
        });
        sel.html(text);
        blockInputsLocation(false);
    })
});

function getSates(){
    let country_id = $("#inp_country").val();
    let url = $('#url_states').val() + "/" + country_id;
    let id = $('#value_state_id').val();
    let text = "";
    let sel = $('#state_id');
    blockInputsLocation(true);
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
        blockInputsLocation(false);
        getCities();
    })
}

function getCities(){
    let state_id = $("#state_id").val();
    let url = $('#url_cities').val() + "/" + state_id;
    let id = $('#value_city_id').val();
    let text = "";
    let sel = $('#city_id');
    blockInputsLocation(true);
    $.get(url,(res)=>{
        let selected = "";
        $(res).each(function(index,val) {
            if (val.id == id){
                selected = "selected";
            }
            text += `<option value="${val.id}" ${selected}>${val.name}</option>`;
            selected = "";
        });
        blockInputsLocation(false);
        sel.html(text);
    })
}

function blockInputsLocation(block){
    let country = document.querySelector('#inp_country');
    let state = document.querySelector('#state_id');
    let city = document.querySelector('#city_id');

    country.disabled = block;
    state.disabled = block;
    city.disabled = block;

    cambiaIcon(country,block);
    cambiaIcon(state,block);
    cambiaIcon(city,block);

}

function cambiaIcon(el,block) {
    let label = el.labels[0];
    let text = label.textContent;
    if (block){
        label.innerHTML = `<i class="fa fa-spinner fa-spin fa-fw"></i> ${text}`;
    }else{
        label.innerHTML = `<i class="fa fa-map-marker" aria-hidden="true"></i> ${text}`;
    }
}

function validarBirth() {
    let birth = $('#birth');
    birth.removeClass('is-invalid');
    let birthError = $('#birth-error');
    birthError.addClass('invisible');
    if  (birth.val().length > 0 && !birth.inputmask("isComplete")){
        birth.focus();
        birth.addClass('is-invalid');
        birthError.removeClass('invisible');
        return false;
    }
    return true;
}