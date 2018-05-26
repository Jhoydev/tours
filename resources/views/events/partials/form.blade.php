{!! Form::open(['url' => $url_form,'method' => $method,'enctype'=>'multipart/form-data']) !!}
	@csrf
	<input type="hidden" name="created_by" value="{{ $event->created_by ? $event->created_by : Auth::user()->id }}">
	<div class="card">
		<div class="card-body">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="">Titulo</label>
					<input type="text" class="form-control" name="title" placeholder="titulo" value="{{ $event->title }}">
				</div>
				<div class="form-group col-md-6">
					<label for="">Lugar</label>
					<input type="text" class="form-control" name="location" placeholder="Lugar" value="{{ $event->location }}">
				</div>
				<div class="form-group col-md-6">
					<label for="">Fecha inicio</label>
                    <input type="text" class="form-control" name="start_date" placeholder="Fecha final" value="{{ $event->start_date }}" required>
                </div>
				<div class="form-group col-md-6">
					<label for="">Fecha final</label>
					<input type="text" class="form-control" name="end_date" placeholder="Fecha final" value="{{ $event->end_date }}" required>
				</div>
				<div class="form-group col-md-4">
					<label for="event_type_id">Tipo de viaje</label>
					{{ Form::select('event_type_id', $event_types, null , ['class' => "form-control",'required' => true]) }}
				</div>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="">Descripción</label>
    				<textarea class="form-control" name="description" rows="10">{{ $event->description }}</textarea>
				</div>
			</div>
		</div>
	</div>
	<button type="submit" class="btn btn-primary">Crear</button>
{!! Form::close() !!}