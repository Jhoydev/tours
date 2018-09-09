{{ "YA ESTAS AUTENTICADO EN OTRA CUENTA POR FAVOR VUELVE CERRA SESION Y VUELVE A ENTRAR" }}

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<a class="dropdown-item" href="{{ route('logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fa fa-sign-out"></i> Salir
</a>