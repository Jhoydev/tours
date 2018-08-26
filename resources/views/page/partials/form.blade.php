{!! Form::open(['url' => $page_form['url'],'method' => $page_form['method'],'enctype'=>'multipart/form-data','id' => 'form_page']) !!}
<div class="row">
    <div class="col-md-4">
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        <div class="form-group">
            {!! Form::checkbox('is_live',null,$page->is_live,['id' => 'is_live']); !!}
            <label class="form-check-label" for="is_live">
                Web del evento visible
            </label>
        </div>
        <hr>
        @include('events.partials.gallery')
        <div class="form-group">
            <label for=""><i class="fa fa-pencil"></i> Color de texto</label>
            <input class="rounded" type="color" id="color_text" name="color_text" value="{{ $page->color_text }}">
        </div>
        <hr>
        <div class="form-group">
            <label>Redes sociales</label>
        </div>
        <div class="form-group col-12 d-flex justify-content-between">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    <i class="fa fa-facebook-official" aria-hidden="true"></i>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                </label>
            </div>
        </div>        
        <hr>
        <div class="form-group">
            @if ( $page->id )
                <a href="{{ url('tour/' . Auth::user()->company->key_app . '/' . $page->id ) }}" class="btn btn-light border-secondary btn-sm rounded">Ver pagina</a>
            @endif
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <iframe id="iframe_page" style="width: 100%;height: 100vh;pointer-events: none;" src="{{ ($page->id) ? url('tour/' . Auth::user()->company->key_app . '/' . $page->id ) : "" }}" frameborder="0"></iframe>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="form-group col-12 text-right">
        <button class="btn btn-success btn-sm rounded" type="button" onclick="savePage()">Guardado</button>
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