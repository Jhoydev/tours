{!! Form::open(['url' => $url_form,'method' => $method,'enctype'=>'multipart/form-data']) !!}

<div class="card">
    <div class="card-header">
        <h3>{{ $title }}</h3>
    </div>
    <div class="card-body">
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        <div class="form-group">
            <label for="">Fondo</label>
            <input class="form-control" type="text" name="background" value="{{ $page->background }}">
        </div>
        <div class="form-group">
            <label for="">Color de texto</label>
            <input class="form-control" type="text" name="color_text" value="{{ $page->color_text }}">
        </div>
        <div class="form-group">
            <input class="btn btn-primary rounded" type="submit" value="{{ $btn_title }}">
        </div>
        <div class="form-group">
            @if ( $page->id )
                <a href="{{ url('tour/' . Auth::user()->company->key_app . '/' . $page->id ) }}" class="btn btn-light border-secondary rounded">Ver pagina</a>
            @endif
        </div>
    </div>
</div>

{!! Form::close() !!}