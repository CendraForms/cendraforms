<x-app-layout>
    <a href="{{ route('forms.create') }}">Create Form</a>

    <table>
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
</x-app-layout>
