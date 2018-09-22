<div class="form-group col-md-6">
    <label for="country_id"><span class="fa fa-map-marker"></span>   Pais</label>
    @include('viewComposers.input_country')
</div>
<div class="form-group col-md-6">
    <input type="hidden" id="url_states" value="{{ url('api/states') }}">
    <input type="hidden" id="value_state_id" value="{{ ($input->state_id) ? $input->state->id : '' }}">
    <label for="state_id"><span class="fa fa-map-marker"></span>   Estado/Departamento</label>
    {!!Form::select('state_id', ['' => ''], '', ['id' => 'state_id', 'class' => "form-control rounded"])!!}
</div>

<div class="form-group col-md-6">
    <input type="hidden" id="url_cities" value="{{ url('api/cities') }}">
    <input type="hidden" id="value_city_id" value="{{ $input->city_id }}">

    <label for="city_id"><span class="fa fa-map-marker"></span>   Ciudad</label>
    {!!Form::select('city_id', ['' => ''], '', ['id' => 'city_id', 'class' => "form-control rounded"])!!}

</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            getSates();
        });
    </script>
@endpush