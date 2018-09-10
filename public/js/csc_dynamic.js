function changeCountry(prefix = "") {
    var country_id = $('select[id="' + prefix + 'country_id"]').find(':selected').val();
    $.ajax({
        type: 'POST',
        data: {
            country_id: function () {
                return country_id;
            }
        },
        url: admin_url + "myajax/get_states",
        success: function (data, textStatus, jqXHR) {
            response = JSON.parse(data);
            cb = '<option value="" data-stateid=""></option>';
            $.each(response, function (i, data) {
                cb += '<option value="' + data.name + '" data-key="' + data.state_id + '">' + data.name + '</option>';
            });
            $('select[id="' + prefix + 'state_id"]').html(cb);
            var s_select = $('select[id="' + prefix + 'state_id"]');
            s_select.selectpicker('refresh');
        }
    }).fail(function (error) {
        alert_float('danger', 'Error loading states');
    });
}

function changeState(prefix = "") {
    var state_id = $('select[id="' + prefix + 'state_id"]').find(':selected').attr('data-key');
    $.ajax({
        type: 'POST',
        data: {
            state_id: function () {
                return state_id;
            }
        },
        url: admin_url + "myajax/get_cities",
        success: function (data, textStatus, jqXHR) {
            response = JSON.parse(data);
            cb = '<option value="" data-cityid=""></option>';
            $.each(response, function (i, data) {
                cb += '<option value="' + data.name + '" data-key="' + data.city_id + '">' + data.name + '</option>';
            });
            $('select[id="' + prefix + 'city_id"]').html(cb);
            var s_select = $('select[id="' + prefix + 'city_id"]');
            s_select.selectpicker('refresh');
        }
    }).fail(function (error) {
        alert_float('danger', 'Error loading cities');
    });
}