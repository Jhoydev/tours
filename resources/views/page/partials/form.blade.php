{!! Form::open(['url' => url("page/$page->id"),'method' => 'PUT','enctype'=>'multipart/form-data']) !!}
<div class="row">
    <div class="col-md-4">
        <input type="hidden" name="event_id" value="{{ $event->id }}">
        <div class="form-group">
            <label for="">Fondo</label>
            <input class="form-control" type="text" id="background" name="background" value="{{ $page->background }}" readonly>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary btn-sm rounded" onclick="openGallery()">
                Ver galeria
            </button>
        </div>
        <div class="form-group">
            <label for="">Color de texto</label>
            <input class="rounded" type="color" id="color_text" name="color_text" value="{{ $page->color_text }}">
        </div>
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

<div class="modal fade" id="modalGallery" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="content_gallery" class="d-flex flex-wrap justify-content-center">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="saveImageSelected()">Guardar</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>

        function thumbnailClick(e) {
            images.forEach((element) => element.classList.remove('selected'));
            this.classList.add('selected');
        }
        function saveImageSelected(){
            var thumbnail = document.querySelector("#content_gallery > img.img-thumbnail.m-2.selected").src;
            var img = thumbnail.replace(/\/thumbs/gi,'');
            document.querySelector('#background').value = img;

            $("#modalGallery").modal('hide');
        }
        function openGallery(){
            let modal = $("#modalGallery");
            var content =  document.querySelector("#content_gallery");
            $(content).html(`<i class="fa fa-spinner fa-pulse fa-3x fa-fw text-secondary" style="font-size: 3em"></i><span class="sr-only">Loading...</span>`);
            axios.get("http://tour.local/asset/page/public/backgrounds").then(response => {
                var text = "";
                for (image of response.data){
                    text += `<img src="${image}" class="img-thumbnail m-2" style="height: 100px;width: 120px">`;
                }
                $(content).html(text);
                window.images = document.querySelectorAll('.img-thumbnail');
                images.forEach((element) => element.addEventListener('click', thumbnailClick));
            }).catch(function (error) {
                console.log(error);
            });
            modal.modal('toggle');
        }
    </script>
@endpush