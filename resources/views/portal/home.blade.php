@extends('layouts.portal')
@section('content')
    {{ Auth::user('attendee')->first_name }}

    <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out"></i> Salir
    </a>
    <form id="logout-form" action="{{ url("portal/session->get('portal_key_app')/logout") }}" method="POST" style="display: none;">
        @csrf
    </form>

@endsection
