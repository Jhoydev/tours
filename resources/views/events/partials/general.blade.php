<div class="form-row mt-2">
    <input type="hidden" name="created_by" value="{{ $event->created_by ? $event->created_by : Auth::user()->id }}">

    <div class="form-group col-md-12">
        <label for="title"><i class="fa fa-align-left" aria-hidden="true"></i> Titulo</label>
        <input type="text" class="form-control rounded"  id="title" name="title" placeholder="titulo" value="{{ $event_form->title }}">
    </div>
    <div class="form-group col-md-12">
        <input type="hidden" id="descriptionHTML" name="description" value="{!! e($event_form->description) !!}">
        <div id="event_description" style="height: 150px"></div>
    </div>
    <div class="col-12">
        <hr>
    </div>
    @include('layouts.partials.forms.inputs_location',['input' => $event_form])
    <div class="form-group col-md-6">
        <label for=""><i class="fa fa-map-marker" aria-hidden="true"></i> Direccion</label>
        <input type="text" class="form-control rounded" name="address" placeholder="Lugar" value="{{ $event_form->address }}">
    </div>
    <div class="form-group col-md-3">
        <label for=""><i class="fa fa-map-marker" aria-hidden="true"></i> Codigo postal</label>
        <input type="text" class="form-control rounded" name="cp" placeholder="Codigo postal" value="{{ $event_form->cp }}">
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="form-group col-md-4">
        <label for="event_type_id"><i class="fa fa-filter" aria-hidden="true"></i> Tipo de evento</label>
        {{ Form::select('event_type_id', $event_types, $event_form->event_type_id , ['class' => "form-control rounded",'required' => true]) }}
    </div>
    <div class="col-12 w-100"></div>

    <div class="form-group col-md-6">
        <label for="start_date"><i class="fa fa-calendar" aria-hidden="true"></i> Fecha inicio</label>
        <input type="text" data-inputmask="'alias': 'datetime'" class="form-control rounded-left input-mask-date" id="start_date" name="start_date" value="{{ ($event_form->start_date)?$event_form->start_date->format('d-m-Y H:i:s'):'' }}"/>
    </div>
    <div class="form-group col-md-6">
        <label for="end_date"><i class="fa fa-calendar" aria-hidden="true"></i> Fecha final</label>
        <input type="text" data-inputmask="'alias': 'datetime'" class="form-control rounded-left input-mask-date" id="end_date" name="end_date" value="{{  ($event_form->end_date) ? $event_form->end_date->format('d-m-Y H:i:s'):'' }}"/>
    </div>
    <div class="col-12 w-100"></div>
    <div class="form-group col-md-3">
        <p class="h5">Imagen de evento <small>Flyer o grafica etc.</small></p>
        <input type="file" class="form-control-file" id="flyer" name="flyer" onchange="previewFile()"><br>
        <img id="preview_flyer" src="{{ ($event->flyer) ? url($event->flyer) : "" }}" class="img-fluid img-thumbnail" style="min-width: 100%; min-height:150px"  alt="">
        <input type="checkbox" name="delete_flyer" id="delete_flyer" value="true">
        <label for="delete_flyer">¿Eliminar flyer?</label>
    </div>
    <div class="form-group col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Guardar</button>
    </div>
</div>

@push('scripts')
    <script>
        editor = new Quill('#event_description', {
            theme: 'snow'
        });

        editor.root.innerHTML = document.querySelector('#descriptionHTML').value;

        $('.input-mask-date').blur(function () {
            this.value = moment(this.value,"DD/MM/YYYY HH:mm:ss").format("DD/MM/YYYY HH:mm:ss");
            if ($("#end_date").val()){
                let a = moment($("#start_date").val(),"DD/MM/YYYY HH:mm:ss");
                let b = moment($("#end_date").val(),"DD/MM/YYYY HH:mm:ss");
                if (a.diff(b) > 0){
                    $("#end_date").addClass('is-invalid');
                    $("#end_date").focus();
                }else{
                    $("#end_date").removeClass('is-invalid');
                }
            }
        });

        function previewFile() {
            const preview = document.querySelector('#preview_flyer');
            const file    = document.querySelector('input[type=file]').files[0];
            const reader  = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }else {
                preview.src = "";
            }
        }

        $('#delete_flyer').on('change',function (e) {
            var preview_flyer = $("#preview_flyer");
            if (preview_flyer.attr('src')){
                preview_flyer.toggleClass('filter-grayscale');
            }else{
                $(this).prop('checked',false);
                alert('sube primero un flyer');
            }
        });

        $('#form_create_event').on('submit', function(){
            document.querySelector('#descriptionHTML').value = editor.root.innerHTML;
            $("#start_date").val(moment($("#start_date").val(),"DD/MM/YYYY HH:mm:ss").format("DD/MM/YYYY HH:mm:ss"));
            $("#end_date").val(moment($("#end_date").val(),"DD/MM/YYYY HH:mm:ss").format("DD/MM/YYYY HH:mm:ss"));

        });
    </script>
@endpush