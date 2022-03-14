<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Answer</title>
    </head>
    <body class="antialiased">
    <table class="default">
    <tr>
<th>Id</th>
<th>Nom</th>
<th>Descripcio</th>
<th>Usuari</th>
<th>Estat</th>
</tr>
<tr>
    <td>{{ $form->id }}</td>
    <td>{{ $form->name }}</td>
    <td>{{ $form->description }}</td>
    <td>{{ $form->user_id }}</td>
    <td>{{ $form->active}}</td>
</tr>
</table>
    </body>
</html> 