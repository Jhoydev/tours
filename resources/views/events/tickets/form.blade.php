<input type="hidden" name="event_id" id="event_id" value="{{ $event->id }}">
<input type="hidden" name="created_by" id="created_by" value="{{ $event->created_by }}">
<input type="hidden" name="edited_by" id="edited_by" value="{{ Auth::user()->id }}">
<input type="hidden" id="start_date_event" value="{{ $event->start_date }}">
<div class="form-group">
    <label for="">Tipo de Tiquete</label>
    <select class="form-control rounded" name="type" id="type">
        <option value="simple">Simple</option>
        <option value="courtesy">Cortesia</option>
        <option value="expositor">Expositor</option>
    </select>
</div>
<div class="form-group">
    <label for="title">Titulo</label>
    <input class="form-control rounded" type="text" id="title"  name="title" required>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="price">Precio</label>
        <input class="form-control rounded" type="number" id="price" name="price" required>
    </div>
    <div class="form-group col-md-6">
        <label for="quantity_available">Cantidad disponible</label>
        <input class="form-control rounded" type="number" id="quantity_available" name="quantity_available">
    </div>
</div>
<div class="form-group">
    <label for="">Descripción</label>
    <input class="form-control rounded" type="text" id="description" name="description" required>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="input_start">Inicio venta</label>
        <div class="input-group date" id="input_start">
            <input type="text" class="form-control rounded-left datetimepicker-input input-mask-date"  data-inputmask="'alias': 'datetime'"  id="start_date" name="start_sale_date" required/>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="end_date">Finalizar venta</label>
        <input data-inputmask="'alias': 'datetime'" type="text" class="form-control rounded-left datetimepicker-input input-mask-date" id="end_date" name="end_sale_date" required/>
        <label id="end_date-error" class="error mt-2 text-danger invisible" for="end_date">Debe de ser mayor al inicio de venta</label>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-6">
        <label for="min_per_person">Tiquete minimo por orden</label>
        <input class="form-control per-person" type="number" id="min_per_person" name="min_per_person" required>
    </div>
    <div class="form-group col-6">
        <label for="max_per_person">Tiquete maximo por orden</label>
        <input class="form-control per-person" type="number"  id="max_per_person" name="max_per_person" required>
        <label id="max_per_person-error" class="error mt-2 text-danger invisible" for="max_per_person">Debe de ser mayor al minimo por orden</label>
    </div>
</div>
<div class="form-row">
    <div class="col-12 form-group text-right">
        <button  type="button" class="btn btn-light btn-sm mr-3" data-dismiss="modal"><i class="fa fa-ban"></i> Cancelar</button>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Crear</button>
    </div>
</div>