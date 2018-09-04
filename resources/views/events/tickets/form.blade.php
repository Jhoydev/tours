<input type="hidden" name="event_id" id="event_id" value="{{ $event->id }}">
<input type="hidden" name="created_by" id="created_by" value="{{ $event->created_by }}">
<input type="hidden" name="edited_by" id="edited_by" value="{{ Auth::user()->id }}">
<div class="form-group">
    <label for="">Titulo</label>
    <input class="form-control rounded" type="text" id="title"  name="title">
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">Precio</label>
        <input class="form-control rounded" type="text" id="price" name="price">
    </div>
    <div class="form-group col-md-6">
        <label for="">Cantidad disponible</label>
        <input class="form-control rounded" type="text" id="quantity_available" name="quantity_available">
    </div>
</div>
<div class="form-group">
    <label for="">Descripción</label>
    <input class="form-control rounded" type="text" id="description" name="description" >
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="input_start">Inicio venta</label>
        <div class="input-group date" id="input_start" data-target-input="nearest">
            <input type="text" class="form-control rounded-left datetimepicker-input" id="start_date" name="start_sale_date"  data-target="#input_start"/>
            <div class="input-group-append" data-target="#input_start" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="input_start">Finalizar venta</label>
        <div class="input-group date" id="input_end" data-target-input="nearest">
            <input type="text" class="form-control rounded-left datetimepicker-input" id="end_sale_date" name="end_sale_date"  data-target="#input_end" />
            <div class="input-group-append" data-target="#input_end" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-6">
        <label for="">Tiquete minimo por orden</label>
        <input class="form-control rounded" type="number" id="min_per_person" name="min_per_person">
    </div>
    <div class="form-group col-6">
        <label for="">Tiquete maximo por orden</label>
        <input class="form-control rounded" type="number"  id="max_per_person" name="max_per_person" >
    </div>
</div>
<div class="form-row">
    <div class="col-md-6 form-group text-center">
        <button  type="button" class="btn btn-light btn-sm border border-secondary rounded" onclick="toggleFormTicket()">Cancelar</button>
    </div>
    <div class="col-md-6 form-group text-center">
        <button type="submit" class="btn btn-success btn-sm rounded">Guardar</button>
    </div>
</div>