<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Section</title>
    </head>
    <body class="antialiased">
    <table class="default">
    <tr>
<th>Seccio</th>
<th>Id Formulari</th>
<th>Id Usuari</th>
<th>Estat</th>
</tr>
<tr>
    <td>{{ $section->id }}</td>
    <td>{{ $section->form_id }}</td>
    <td>{{ $section->user_id }}</td>
    <td>{{ $section->active }}</td>
</tr>
</table>
    </body>
</html>