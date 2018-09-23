{!! Form::open(['url' => route("event.memory_certificate.put",['event' => $event->id]),'method' => 'PUT']) !!}
<div class="form-row">
	<div class="form-group col-12">
		<h4>Memorias & Certificados</h4>
	</div>
</div>
<div class="form-row">
	<div class="form-group col-12">
		<label for="memories_url">ENLACE DE DESCARGA DE MEMORIAS</label>
		<input id="memories_url" type="text" name="memories_url" class="form-control rounded" value="{{ $event->memories_url }}">
		<small>Puedes añadir un enlace de descarga de tus memorias en caso que el archivo sea demasiado pesado.</small>
	</div>
</div>
<div class="form-row">
	<div class="form-group col-12">
		<label>SUBIR ARCHIVO DE MEMORIAS</label>
		<input type="file" class="form-control rounded">
		<small>Aqui se subira el archivo de memorias que pueden descargar los asistentes</small>
	</div>
</div>
<div class="form-row">
	<div class="form-group col-12">
		<label>SUBIR ARCHIVO BASE DE CERTIFICADO</label>
		<input type="file" class="form-control rounded">
		<small>Aqui se subira el archivo base para generar el certificado</small>
	</div>
</div>
<div class="form-row">
	<div class="form-group col-12">
		<label>COORDENADAS DEL NOMBRE PARA EL CERTIFICADO</label>
		<input type="text" class="form-control rounded">
		<small>Las coordenadas deben ser en formato X,Y por ejemplo '20.5,10.5' (posicion en milimetros)</small>
	</div>
</div>
<div class="form-row">
	<div class="form-group col-12">
		<label>COORDENADAS DEL DOCUMENTO PARA EL CERTIFICADO</label>
		<input type="text" class="form-control rounded">
		<small>Las coordenadas deben ser en formato X,Y por ejemplo '20.5,10.5' (posicion en milimetros)</small>
	</div>
</div>
<div class="form-row">
	<div class="form-group col-12">
		<label>ANCHO IMPRIMIBLE</label>
		<input type="text" class="form-control rounded">
		<small>Ancho del PDF Imprimble en milimetros</small>
	</div>
</div>
<hr>
<div class="form-row">
	<div class="form-group col-md-12 text-right">
		<button type="submit" class="btn btn-sm btn-success rounded">Guardar</button>
	</div>
</div>
{!! Form::close() !!}