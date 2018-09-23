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
        <label for="input_start"><i class="fa fa-calendar" aria-hidden="true"></i> Fecha inicio</label>
        <div class="input-group date" id="input_start" data-target-input="nearest">
            <input type="text" class="form-control rounded-left datetimepicker-input" id="start_date" name="start_date"  data-target="#input_start" value="{{ $event_form->start_date }}"/>
            <div class="input-group-append" data-target="#input_start" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="input_end"><i class="fa fa-calendar" aria-hidden="true"></i> Fecha final</label>
        <div class="input-group date" id="input_end" data-target-input="nearest">
            <input type="text" class="form-control rounded-left datetimepicker-input" name="end_date" data-target="#input_end"  value="{{ $event_form->end_date }}"/>
            <div class="input-group-append" data-target="#input_end" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
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
        <button type="submit" class="btn btn-sm btn-success rounded"><i class="fa fa-save"></i> Guardar</button>
    </div>
</div>

@push('scripts')
    <script>
        editor = new Quill('#event_description', {
            theme: 'snow'
        });

        editor.root.innerHTML = document.querySelector('#descriptionHTML').value;

        $('#input_start').datetimepicker({
            format: "DD-MM-YYYY HH:mm:ss"
        });
        $('#input_end').datetimepicker({
            format: "DD-MM-YYYY HH:mm:ss"
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
            $("#form_create_event").submit();
        });
    </script>
@endpush