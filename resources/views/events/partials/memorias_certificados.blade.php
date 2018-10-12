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
		<small>Puedes añadir un enlace de descarga de tus memorias.</small>
	</div>
</div>
<hr>
<div class="form-row">
	<div class="form-group col-md-12 text-right">
		<button type="submit" class="btn btn-sm btn-success rounded">Guardar</button>
	</div>
</div>
{!! Form::close() !!}