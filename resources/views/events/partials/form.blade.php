
<div class="card">
    <div class="card-body">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">General</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Pagina del evento</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Formulario de orden</a>
                <a class="nav-item nav-link" id="nav-memorias-certificados-tab" data-toggle="tab" href="#nav-memorias-certificados" role="tab" aria-controls="nav-memorias-certificados" aria-selected="false">Memorias & Certificados</a>
                <a class="nav-item nav-link" id="nav-impuestos-tab" data-toggle="tab" href="#nav-impuestos" role="tab" aria-controls="nav-impuestos" aria-selected="false">Impuesto de servicios</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                {!! Form::open(['url' => url("events/$event->id"),'method' => 'PUT', 'id' => 'form_create_event','enctype'=>'multipart/form-data']) !!}
                @include('events.partials.general')
                {!! Form::close() !!}
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                @include('page.partials.form')
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                @include('events.partials.orden')
            </div>
            <div class="tab-pane fade" id="nav-memorias-certificados" role="tabpanel" aria-labelledby="nav-contact-tab">
                @include('events.partials.memorias_certificados')
            </div>
            <div class="tab-pane fade" id="nav-impuestos" role="tabpanel" aria-labelledby="nav-contact-tab">
                @include('events.partials.impuesto')
            </div>
        </div>
    </div>
</div>
@push ('scripts')
    <script>
        $(document).ready(function(){
            let seccion = location.hash;
            $(seccion).tab('show');
        })
    </script>
@endpush
