@include('role.form.form',[
    'method' => 'PUT',
    'url_form' => url("role/$role->id"),
    'title' => "Editar Rol: " . ucfirst($role->name),
    $role
])