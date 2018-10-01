<li class="nav-title">Evento</li>
<li class="nav-item">
    <a class="nav-link" href="#"><i class="fa fa-home"></i> Tablero</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#"><i class="fa fa-shopping-cart"></i> Ordenes</a>
</li>
@if ( $event->page)
<li class="nav-item">
    <a class="nav-link" href="{{ url('evento/' . $event->id . '/' . $event->page->id ) }}" target="_blank"><i class="fa fa-globe"></i> Web</a>
</li>
@endif