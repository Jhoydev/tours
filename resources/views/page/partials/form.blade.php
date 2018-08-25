{!! Form::open(['url' => $page_form['url'],'method' => $page_form['method'],'enctype'=>'multipart/form-data']) !!}
<div class="row">
    <div class="col-md-4">
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        @include('events.partials.gallery')
        <div class="form-group">
            <label for=""><i class="fa fa-pencil"></i> Color de texto</label>
            <input class="rounded" type="color" id="color_text" name="color_text" value="{{ $page->color_text }}">
        </div>
        <hr>
        <div class="form-group">
            <input class="btn btn-success btn-sm rounded" type="submit" value="Guardar">
        </div>
        <div class="form-group">
            @if ( $page->id )
                <a href="{{ url('tour/' . Auth::user()->company->key_app . '/' . $page->id ) }}" class="btn btn-light border-secondary rounded">Ver pagina</a>
            @endif
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            @if ( $page->id )
                <iframe style="width: 100%;height: 100vh;" src="{{ url('tour/' . Auth::user()->company->key_app . '/' . $page->id ) }}" frameborder="0"></iframe>
            @endif
        </div>
    </div>
</div>
{!! Form::close() !!}
