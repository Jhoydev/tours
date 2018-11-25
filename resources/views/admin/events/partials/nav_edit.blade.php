<div class="row">
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills nav-pills-primary justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is("admin/events/$event->id/edit") ? 'active' : '' }}" href="{{ route('admin.events.edit',['event' => $event->id]) }}"><i class="fa fa-list" aria-hidden="true"></i> General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is("admin/events/$event->id/settings/page") ? 'active' : '' }}" href="{{ route('admin.events.page',['event' => $event->id]) }}"><i class="fa fa-globe" aria-hidden="true"></i> Pagina del Evento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is("admin/events/$event->id/settings/order-description") ? 'active' : '' }}" href="{{ route('admin.events.order_description',['event' => $event->id]) }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Formulario de Orden</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is("admin/events/$event->id/settings/memory-certificate") ? 'active' : '' }}" href="{{ route('admin.events.memory_certificate',['event' => $event->id]) }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> Memorias & Certificados</a>
                    </li>
                    {{--<li class="nav-item">
                        <a class="nav-link {{ request()->is("events/$event->id/edit/taxes") ? 'active' : '' }}" href="{{ url("events/$event->id/edit/taxes") }}"><i class="fa fa-usd" aria-hidden="true"></i> Impuesto de Servicios</a>
                    </li>--}}
                </ul>
            </div>
        </div>
    </div>
</div>