@include('admin.user.form.form',[
    'method' => 'PUT',
    'url_form' => route("admin.user.update",['user' => $user->id]),
    'title' => "Editar Usuario: <strong>$user->full_name </strong>"
])