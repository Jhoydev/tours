@include('user.form.form',[
    'method' => 'PUT',
    'url_form' => url("user/$user->id"),
    'title' => "Editar Usuario: <strong>$user->full_name </strong>"
])