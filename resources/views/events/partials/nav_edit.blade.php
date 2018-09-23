<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is("events/$event->id/edit") ? 'active' : '' }}" href="{{ url("events/$event->id/edit") }}">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is("events/$event->id/edit/page") ? 'active' : '' }}" href="{{ url("events/$event->id/edit/page") }}">Pagina del Evento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is("events/$event->id/edit/order_description") ? 'active' : '' }}" href="{{ url("events/$event->id/edit/order_description") }}">Formulario de Orden</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is("events/$event->id/edit/memory-certificate") ? 'active' : '' }}" href="{{ url("events/$event->id/edit/memory-certificate") }}">Memorias & Certificados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('') ? 'active' : '' }}" href="#">Impuesto de Servicios</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>