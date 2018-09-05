

@include('attendees.form.form',[
    'method' => 'PUT',
    'url_form' => url("attendee/$attendee->id"),
    'title' => "Editar Asistente: " . ucfirst($attendee->first_name) . " " . ucfirst($attendee->last_name),
    $attendee
])