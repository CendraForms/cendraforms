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
<th>ID</th>
<th>Nom</th>
<th>Seccio</th>
<th>Estat</th>
</tr>
<tr>
    <td>{{ $question->id }}</td>
    <td>{{ $question->name}}</td>
    <td>{{ $question->section_id }}</td>
    <td>{{ $question->active }}</td>
</tr>
</table>
    </body>
</html> 