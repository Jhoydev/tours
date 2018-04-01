@extends('layouts.main')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Compañia</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-text">
                        <p>{{ Auth::user()->company->name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Usuarios</div>
                <div class="card-body">
                    <div class="card-text">
                        <ul>
                            @foreach(Auth::user()->company->users as $user)
                                <li>{{ $user->first_name }} - {{ $user->company->name }}</li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Eventos</div>
                <div class="card-body">
                    <div class="card-text">
                        <ul>
                            @foreach(Auth::user()->company->events as $event)
                                <li>{{ $event->title }} - {{ $event->company->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Acciones</div>
                <div class="card-body">
                    <div class="card-text">
                        @if (Auth::user()->can('event.create'))
                            <button class="btn btn-default">Crear</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
