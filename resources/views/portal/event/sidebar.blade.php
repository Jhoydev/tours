<li class="nav-title">Evento</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url("portal/event/$event->id") }}"><i class="fa fa-home"></i> Panel</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url("portal/customer/event/$event->id/details") }}"><i class="fa fa-shopping-cart"></i> Tiquetes</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url("portal/event/$event->id/orders") }}"><i class="fa fa-shopping-cart"></i> Ordenes</a>
</li>
@if ( $event->event_type_id == 2)
    <li class="nav-item">
        <a class="nav-link" href="{{ url("portal/event/$event->id/agenda") }}"><i class="fa fa-users"></i> Asistentes</a>
    </li>
@endif
@if ( $event->page && $event->page->slug)
<li class="nav-item">
    <a class="nav-link" href="{{ url('evento/' . $event->page->slug ) }}" target="_blank"><i class="fa fa-globe"></i> Web</a>
</li>
@endif