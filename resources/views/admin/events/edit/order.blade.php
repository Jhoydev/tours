@extends('admin.events.edit')
@section('content-event-edit')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['url' => route("admin.events.order_description.put",['event' => $event->id]),'method' => 'PUT']) !!}
            <div class="form-row">
                <div class="col-12">
                    <h4>Ajustes de la Pagina de Ordenes</h4>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <p>Mensaje que se mostrara a los asistentes antes de completar la orden.</p>
                    <textarea name="pre_order_display_message" class="form-control rounded" rows="5">{{ $event->pre_order_display_message }}</textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <p>Mensaje que se mostrara a los asistentes despues de completar la orden.</p>
                    <textarea name="post_order_display_message" class="form-control rounded" rows="5">{{ $event->post_order_display_message }}</textarea>
                    <small>Este mensaje se mostrar a los asistentes una vez se haga el pago exitosamente.</small>
                </div>
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group col-12">
                    <h4>Ajustes de Pagos Fuera de Linea</h4>
                </div>
                <div class="form-group col-12">
                    <div class="form-check form-check-success">
                        <label class="form-check-label" for="enable_offline_payments">
                            <input class="form-check-input" type="checkbox" id="enable_offline_payments" name="enable_offline_payments" {{ ($event->enable_offline_payments)? 'checked':'' }}>
                            Activar Pagos Fuera de Linea
                        </label>
                    </div>
                </div>
                <div id="content-offline_payment_instructions" class="form-group col-12 {{ ($event->enable_offline_payments)? '':' fade d-none' }}">
                    <p>Instrucciones de pago en efectivo</p>
                    <textarea name="offline_payment_instructions" class="form-control rounded" rows="5">{{ $event->offline_payment_instructions }}</textarea>
                </div>
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-12 text-right">
                    <button type="submit" class="btn btn-sm btn-success rounded">Guardar</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.querySelector('#enable_offline_payments').addEventListener('change',function(){
            let content = document.querySelector('#content-offline_payment_instructions');
            content.classList.toggle("d-none");
            content.classList.toggle("show");
        })
    </script>
@endpush