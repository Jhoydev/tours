<div class="form-row mt-2">
    <input type="hidden" name="created_by" value="{{ $event->created_by ? $event->created_by : Auth::user()->id }}">

    <div class="form-group col-md-12">
        <label for="title"><i class="fa fa-align-left" aria-hidden="true"></i> Titulo</label>
        <input type="text" class="form-control rounded"  id="title" name="title" placeholder="titulo" value="{{ $event_form->title }}" required>
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
    <div class="form-group col-md-2">
        <label for=""><i class="fa fa-map-marker" aria-hidden="true"></i> Codigo postal</label>
        <input type="text" class="form-control rounded" name="cp" placeholder="Codigo postal" value="{{ $event_form->cp }}">
    </div>
    <div class="col-12">
        <hr>
    </div>
    <div class="form-group col-md-2">
        <label for="event_type_id"><i class="fa fa-filter" aria-hidden="true"></i> Tipo de evento</label>
        {{ Form::select('event_type_id', $event_types, $event_form->event_type_id , ['class' => "form-control form-control-lg",'required' => true]) }}
    </div>
    <div class="col-12 w-100"></div>

    <div class="form-group col-md-6">
        <label for="start_date"><i class="fa fa-calendar" aria-hidden="true"></i> Fecha inicio</label>
        <input type="text" data-inputmask="'alias': 'datetime'" class="form-control rounded-left input-mask-date" id="start_date" name="start_date" value="{{ ($event_form->start_date)?$event_form->start_date->format('d-m-Y H:i:s'):'' }}" required />
    </div>
    <div class="form-group col-md-6">
        <label for="end_date"><i class="fa fa-calendar" aria-hidden="true"></i> Fecha final</label>
        <input type="text" data-inputmask="'alias': 'datetime'" class="form-control rounded-left input-mask-date" id="end_date" name="end_date" value="{{  ($event_form->end_date) ? $event_form->end_date->format('d-m-Y H:i:s'):'' }}" required />
    </div>
    <div class="col-12 w-100"></div>
    <div class="form-group col-md-3">
        <p class="h5">Imagen de evento <small>Flyer o grafica etc.</small></p>
        <input type="file" id="flyer" name="flyer" onchange="previewFile()"><br>
        <img id="preview_flyer" src="{{ ($event->flyer) ? url($event->flyer) : "" }}" class="img-fluid img-thumbnail mb-3" style="min-width: 100%; min-height:150px"  alt="">
        <div class="form-check">
            <label for="delete_flyer" class="form-check-label">
                ¿Eliminar flyer?
                <input class="form-check-input" type="checkbox" name="delete_flyer" id="delete_flyer" value="true">
            </label>
        </div>
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

        $('.input-mask-date').blur(checkDateRange);

        function checkDateRange () {
            let res = true;
            let end = $("#end_date");
            let start = $("#start_date");
            let f = moment(start.val(),"DD/MM/YYYY HH:mm:ss").format("DD/MM/YYYY HH:mm:ss");
            start.val(f);
            f = moment(end.val(),"DD/MM/YYYY HH:mm:ss").format("DD/MM/YYYY HH:mm:ss");
            end.val(f);
            if (end.val()){
                let a = moment(start.val(),"DD/MM/YYYY HH:mm:ss");
                let b = moment(end.val(),"DD/MM/YYYY HH:mm:ss");
                if (a.diff(b) > 0){
                    end.addClass('is-invalid');
                    end.focus();
                    end.next('label').removeClass('invisible');
                    res = false;
                }else{
                    end.removeClass('is-invalid');
                }
            }
            return res;
        }

        $('#form_create_event').on('submit', function(ev){
            document.querySelector('#descriptionHTML').value = editor.root.innerHTML;
            if (!$("#end_date").val()){
                ev.preventDefault();
            }
            if (!checkDateRange()){
                ev.preventDefault();
            }
        });
    </script>
@endpush