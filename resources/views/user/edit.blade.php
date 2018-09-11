@include('user.form.form',[
    'method' => 'PUT',
    'url_form' => url("user/$user->id"),
    'title' => 'Editar Usuario: ' . $user->first_name . " ". $user->last_name 
])