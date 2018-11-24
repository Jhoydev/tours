
{!! Form::open(['url' => url("event/$event->id/import-csv"),'method' => 'POST', 'id' => 'form_create_event','enctype'=>'multipart/form-data']) !!}
<div class="form-group">
    <label for=""><i class="fa fa-file-excel-o" aria-hidden="true"></i> Archivo CSV</label>
    <input class="form-control" type="file" name="csv" id="">
</div>
<div class="form-group">
    <label for=""><i class="fa fa-ticket" aria-hidden="true"></i> Tiquetes</label>
    {{ Form::select('ticket_id', $tickets, null , ['class' => 'form-control rounded','required' => true]) }}
</div>
<div class="form-group text-right">
    <button class="btn btn-outline-primary rounded" type="submit"><i class="fa fa-download" aria-hidden="true"></i> Importar</button>
</div>
{!! Form::close() !!}