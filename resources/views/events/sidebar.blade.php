<li class="nav-title">Evento</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url("events/$event->id") }}"><i class="fa fa-home"></i> Tablero</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('event.customers',['id' => $event->id]) }}"><i class="fa fa-users"></i> Asistentes</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url("events/$event->id/tickets") }}"><i class="fa fa-ticket"></i> Tiquetes</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url("events/$event->id/courtesy") }}"><i class="fa fa-ticket"></i> Tiquetes de Cortesía</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('event.orders',['id' => $event->id]) }}"><i class="fa fa-shopping-cart"></i> Ordenes</a>
</li>
@if ( $event->page)
<li class="nav-item">
    <a class="nav-link" href="{{ url('evento/' . $event->id . '/' . $event->page->id ) }}" target="_blank"><i class="fa fa-globe"></i> Web</a>
</li>
@endif
<li class="nav-item">
    <a class="nav-link" href="{{ url("events/$event->id/edit") }}"><i class="fa fa-cog"></i> Administrar</a>
</li>