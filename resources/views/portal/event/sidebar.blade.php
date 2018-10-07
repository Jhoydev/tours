<li class="nav-title">Evento</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url("portal/event/$event->id") }}"><i class="fa fa-home"></i> Panel</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url("portal/customer/event/$event->id/details") }}"><i class="fa fa-shopping-cart"></i> Tiquetes</a>
</li>
@if ( $event->page)
<li class="nav-item">
    <a class="nav-link" href="{{ url('evento/' . $event->id . '/' . $event->page->id ) }}" target="_blank"><i class="fa fa-globe"></i> Web</a>
</li>
@endif