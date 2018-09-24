<div class="row">
    <div class="col-12 mb-3">
        <ul class="nav nav-pills justify-content-center">
            <li class="nav-item">
                <a class="nav-link {{ request()->is("events/$event->id/edit") ? 'active' : '' }}" href="{{ url("events/$event->id/edit") }}"><i class="fa fa-list" aria-hidden="true"></i> General</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is("events/$event->id/edit/page") ? 'active' : '' }}" href="{{ url("events/$event->id/edit/page") }}"><i class="fa fa-globe" aria-hidden="true"></i> Pagina del Evento</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is("events/$event->id/edit/order_description") ? 'active' : '' }}" href="{{ url("events/$event->id/edit/order_description") }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Formulario de Orden</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is("events/$event->id/edit/memory-certificate") ? 'active' : '' }}" href="{{ url("events/$event->id/edit/memory-certificate") }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> Memorias & Certificados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is("events/$event->id/edit/taxes") ? 'active' : '' }}" href="{{ url("events/$event->id/edit/taxes") }}"><i class="fa fa-usd" aria-hidden="true"></i> Impuesto de Servicios</a>
            </li>
        </ul>
    </div>
</div>