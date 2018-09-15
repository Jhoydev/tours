<div class="row mt-2">
    @foreach($customers as $customer)
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">{{ ucfirst($customer->first_name) }} {{ ucfirst($customer->last_name) }}</h4>
                <hr>
                <div class="row">
                    <div class="col-md-5"><strong>Correo Electronico</strong></div>
                    <div class="col-md-7"><p class="text-secondary">{{ $customer->email }}</p></div>
                </div>
                <div class="row">
                    <div class="col-md-5"><strong>Telefono</strong></div>
                    <div class="col-md-7"><p class="text-secondary">{{ $customer->phone }}</p></div>
                </div>
                <div class="row">
                    <div class="col-md-5"><strong>Celular</strong></div>
                    <div class="col-md-7"><p class="text-secondary">{{ $customer->mobile }}</p></div>
                </div>
                <div class="row">
                    <div class="col-md-5"><strong>{{ $customer->document_type->name }}</strong></div>
                    <div class="col-md-7"><p class="text-secondary">{{ $customer->document }}</p></div>
                </div>
                <hr>
                <div class="d-flex justify-content-around">
                    <a href="{{ url("customer/$customer->id/edit") }}" class="btn btn-primary rounded btn-sm mr-2"><i class="fa fa-pencil"></i> Editar</a>
                    <button type="button" class="btn btn-outline-danger rounded btn-sm" data-toggle="modal" data-target="#deleteModal" data-customer_id="{{ $customer->id }}">
                        <i class="fa fa-eraser" aria-hidden="true"></i> Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" customer="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" customer="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Esta seguro de eliminar este asistente?
            </div>
            <div class="modal-footer">
                {!! Form::open([ 'id' => 'form_delete' ,'url' => '','method' => 'DELETE','class' => 'd-inline-block']) !!}
                {!! Form::submit('Eliminar',['class' => 'btn btn-outline-danger btn-sm rounded'])  !!}
                {!! Form::close() !!}
                <button type="button" class="btn btn-secondary btn-sm rounded text-light" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>