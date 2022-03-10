<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>forms</title>
</head>
<body>
    <div>
        <table border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Descripció</th>
                    <th>Usuari</th>
                    <th>Estat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($forms as $key => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->description }}</td>
                        <td>{{ $value->user_id }}</td>
                        @if($value->active == '1')
                            <td>Actiu</td>
                        @else
                            <td>Inactiu</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
