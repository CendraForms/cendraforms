<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>sections</title>
</head>
<body>
    <div>
        <table border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Form</th>
                    <th>User</th>
                    <th>Estat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sections as $key => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->form_id }}</td>
                        <td>{{ $value->user_id }}</td>
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
