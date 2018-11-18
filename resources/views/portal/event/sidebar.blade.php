<hr>
<li class="nav-item">
    <a class="nav-link" href="{{ url("portal/event/$event->id") }}"><i class="menu-icon fa fa-home"></i> <span class="menu-title">Panel</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url("portal/customer/event/$event->id/details") }}"><i class="menu-icon fa fa-shopping-cart"></i> <span class="menu-title">Tiquetes</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url("portal/event/$event->id/orders") }}"><i class="menu-icon fa fa-shopping-cart"></i> <span class="menu-title">Ordenes</span></a>
</li>
@if ( $event->event_type_id == 2 && $event->isActive())
    <li class="nav-item">
        <a class="nav-link" href="{{ url("portal/event/$event->id/agenda") }}"><i class="menu-icon fa fa-users"></i> <span class="menu-title">Asistentes</span></a>
    </li>
@endif
@if ( $event->page && $event->page->slug)
<li class="nav-item">
    <a class="nav-link" href="{{ url('evento/' . $event->page->slug ) }}" target="_blank"><i class="menu-icon fa fa-globe"></i> <span class="menu-title">Web</span></a>
</li>
@endif