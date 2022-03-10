<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>questions</title>
</head>
<body>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Contingut</th>
                    <th>Secció</th>
                    <th>Estat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($question as $key => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->content }}</td>
                        <td>{{ $value->section_id }}</td>
                        @if($value->active == '1')
                            <td>Activa</td>
                        @else
                            <td>Inactiva</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
