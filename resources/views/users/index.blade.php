<x-app-layout>
    <a href="{{ route('users.create') }}">Create User</a>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Estat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td><a href="mailto:{{ $value->email }}">{{ $value->email }}</a></td>
                    @if($value->active == '1')
                        <td>Actiu</td>
                    @else
                        <td>Inactiu</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
