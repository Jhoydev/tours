{!! Form::open(['url' => $page_form['url'],'method' => $page_form['method'],'enctype'=>'multipart/form-data','id' => 'form_page']) !!}
<div class="row">
    <div class="col-md-12">
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        <div class="form-group">
            <div class="form-check form-check-success">
                <label class="form-check-label" for="is_live">
                    {!! Form::checkbox('is_live',null,$page->is_live,['id' => 'is_live','class' => 'form-check-input']) !!}
                    Web del evento visible
                </label>
            </div>
        </div>
        <hr>
        @include('events.partials.gallery')
        <div class="form-group">
            <label for=""><i class="fa fa-pencil"></i> Color de texto</label>
            <input class="rounded" type="color" id="color_text" name="color_text" value="{{ $page->color_text }}">
        </div>
        <hr>
        <div class="form-group">
            @if ( $page->slug )
                <a href="{{ url('evento/'. $page->slug ) }}" target="_blank" class="btn btn-light border-secondary btn-sm rounded"><i class="fa fa-external-link" aria-hidden="true"></i> Ver pagina</a>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <iframe id="iframe_page" style="width: 100%;height: 100vh;pointer-events: none;" src="{{ ($page->id) ? url('evento/' . $page->slug ) : "" }}" frameborder="0"></iframe>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="form-group col-12 text-right">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
    </div>
</div>
{!! Form::close() !!}
@push('scripts')
<script type="text/javascript">
    function savePage(){
        var $form = $("#form_page");
        var url = $form.attr('action'); 
        var data = $form.serialize();
        $.post(url,data).done((res)=>{
            if (res.status){
                showAlertSuccess("Guardado correctamente");
                var iframe = document.querySelector("#iframe_page");
                iframe.src = res.url;
            }
        }).fail((res)=>{
            if (res.responseJSON.errors){
                var errors = res.responseJSON.errors;
                showAlertError(errors);
            }
        });
    }
</script>
@endpush