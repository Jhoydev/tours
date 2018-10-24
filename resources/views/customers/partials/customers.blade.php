<div class="card">
    <div class="card-body">
        <p class="display-4 text-center">Clientes</p>
        <hr>
        <table id="table_datatable" class="table dataTable">
            <thead class="bg-primary text-white">
            <tr>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Teléfono</th>
                <th>Celular</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td scope="row">{{ ucfirst($customer->first_name) }} {{ ucfirst($customer->last_name) }}</td>
                    <td scope="row">{{ $customer->email }}</td>
                    <td scope="row">{{ $customer->mobile }}</td>
                    <td scope="row">{{ $customer->phone }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
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

@push('scripts')
    @include('layouts.js.datatable')
@endpush