<x-app-layout>
    <a href="{{ route('roles.create') }}">Create role</a>

    <table>
        <thead>
            <tr>
                <td>id</td>
                <td>name</td>
                <td>active</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        @foreach ($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->active }}</td>
                <td>
                    <a href="{{ route('roles.edit', $role->id) }}">edit</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                        @csrf @method("DELETE")
                        <button type="submit">delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</x-app-layout>
