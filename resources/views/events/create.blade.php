{!! Form::open(['url' => url("events"),'method' => 'POST','enctype'=>'multipart/form-data']) !!}
@csrf
<input type="hidden" name="created_by" value="{{ $event->created_by ? $event->created_by : Auth::user()->id }}">
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a href="#" class="nav-link active">General</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Página del evento</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Formulario de orden</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Social</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Afiliados</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Memorias & Certificados</a>
            </li>
        </ul>
        <div class="form-row">
            <div class="col-12 text-right">
                <button type="submit" class="btn btn-sm rounded btn-primary">{{ $btn_name }}</button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}