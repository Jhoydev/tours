<div class="form-row mt-2">
    <input type="hidden" name="created_by" value="{{ $event->created_by ? $event->created_by : Auth::user()->id }}">
    <div class="form-group col-md-6">
        <label for="">Titulo</label>
        <input type="text" class="form-control rounded" name="title" placeholder="titulo" value="{{ $event_form->title }}">
    </div>
    <div class="form-group col-md-6">
        <label for="">Lugar</label>
        <input type="text" class="form-control rounded" name="location" placeholder="Lugar" value="{{ $event_form->location }}">
    </div>
    <div class="form-group col-md-4">
        <label for="">Ciudad</label>
        <input type="text" class="form-control rounded" name="location" placeholder="Lugar" value="{{ $event_form->location }}">
    </div>
    <div class="form-group col-md-3">
        <label for="">Codigo postal</label>
        <input type="text" class="form-control rounded" name="location" placeholder="Lugar" value="{{ $event_form->location }}">
    </div>
    <div class="form-group col-md-6">
        <label for="input_start">Fecha inicio</label>
        <div class="input-group date" id="input_start" data-target-input="nearest">
            <input type="text" class="form-control rounded-left datetimepicker-input" id="start_date" name="start_date"  data-target="#input_start" value="{{ $event_form->start_date }}"/>
            <div class="input-group-append" data-target="#input_start" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="input_end">Fecha final</label>
        <div class="input-group date" id="input_end" data-target-input="nearest">
            <input type="text" class="form-control rounded-left datetimepicker-input" name="end_date" data-target="#input_end"  value="{{ $event_form->end_date }}"/>
            <div class="input-group-append" data-target="#input_end" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-4">
        <label for="event_type_id">Tipo de evento</label>
        {{ Form::select('event_type_id', $event_types, $event_form->event_type_id , ['class' => "form-control rounded",'required' => true]) }}
    </div>



    <div class="col-md-12">
        @include('events.partials.gallery')
    </div>
    <div class="form-group col-md-12">
        <input type="hidden" id="descriptionHTML" name="description" value="{!! e($event_form->description) !!}">
        <div id="event_description" style="height: 150px">

        </div>
    </div>
    <div class="form-group col-md-12 text-right">
        <button type="button" onclick="saveEvent()" class="btn btn-sm btn-success rounded">Guardar</button>
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

        function saveEvent(){
            document.querySelector('#descriptionHTML').value = window.editor.root.innerHTML;
            document.querySelector('#form_create_event').submit();
        }
    </script>
@endpush