@extends('layouts.template.melody')
@push('sidebar')
@include('events.sidebar')
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <p class="text-center display-3">{{ $event->title }}</p>
                    @if (count($orders))
                        <p class="h1">Atención</p>
                        <p>Ya se han registrado compras de tiquetes para este evento. El sistema enviara automaticamente un correo informando a los asistentes que el evento será cancelado.</p>
                    @else
                        <p>No se ha realizado compras de tiquetes para este evento.</p>
                    @endif
                    <div class="row">
                        <div class="col-12">
                            <label for="confirm-delete">Escribe el nombre del evento para confirmar: <strong>{{ $event->title }}</strong></label>
                            <input type="text" id="confirm-delete" class="form-control" data-title="{{ $event->title }}">
                        </div>
                    </div>
                    {!! Form::open(['url' => url ("events/$event->id"), 'method' => 'DELETE', 'id' => 'form-delete-event' ,'class' => 'mt-3']) !!}
                    <button  type="submit" class="btn btn-outline-danger" disabled>Eliminar evento</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $("#confirm-delete").keyup(function (){
        var input = $(this);
        var form = $('#form-delete-event').find('button');
        if (input.val() === input.data('title')) {
            form.prop('disabled',false);
            input.addClass('is-valid');
        }else{
            form.prop('disabled',true);
            input.removeClass('is-valid');
        }
    });
</script>

@endpush