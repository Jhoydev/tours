<div class="row">
    <input type="hidden" name="event_id" value="{{ $event->id }}">
    <div class="form-group col-12">
        <label for="">Nombre</label>
        <input type="text" class="form-control" name="name" value="{{ $courtesy->name }}">
    </div>
    <div class="form-group col-lg-4">
        <label for="">Cantidad</label>
        <input type="text" class="form-control" name="quantity_available" value="{{ $courtesy->quantity_available }}">
    </div>
    <div class="form-group col-12">
        <label for="description">Descripción</label>
        <textarea name="description" class="form-control" id="description" name="description" cols="30" rows="10">{{ $courtesy->description }}</textarea>
    </div>
    <div class="form-group col-12">
        <button class="btn btn-success btn-block" type="submit"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
    </div>
</div>