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
<th>Content</th>
<th>Pregunta</th>
<th>Usuari</th>
<th>Estat</th>
</tr>
<tr>
    <td>{{ $answer->id }}</td>
    <td>{{ $answer->content }}</td>
    <td>{{ $answer->question_id }}</td>
    <td>{{ $answer->user_id }}</td>
    <td>{{ $answer->active}}</td>
</tr>
</table>
    </body>
</html>