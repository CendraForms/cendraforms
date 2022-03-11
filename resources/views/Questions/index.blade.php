<x-app-layout>
    <a href="{{ route('questions.create') }}">Create questions</a>

    <table>
        <thead>
            <tr>
                <td>id</td>
                <td>name</td>
                <td>content</td>
                <td>active</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        @foreach ($questions as $questions)
            <tr>
                <td>{{ $questions->id }}</td>
                <td>{{ $questions->name }}</td>
                <td>{{ $questions->content }}</td>
                <td>{{ $questions->active }}</td>
                <td>
                    <a href="{{ route('questions.edit', $questions->id) }}">edit</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('questions.destroy', $questions->id) }}">
                        @csrf @method("DELETE")
                        <button type="submit">delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</x-app-layout>
