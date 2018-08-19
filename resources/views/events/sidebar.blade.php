<li class="nav-title">Evento</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url("events/$event->id") }}"><i class="fa fa-home"></i> Tablero</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url("events/$event->id/prices") }}"><i class="fa fa-ticket"></i> Tiquetes</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#"><i class="fa fa-shopping-cart"></i> Ordenes</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#"><i class="fa fa-users"></i> Asistentes</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url("events/$event->id/edit") }}"><i class="fa fa-cog"></i> Administrar</a>
</li>