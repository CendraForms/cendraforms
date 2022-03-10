<x-app-layout>
    <a href="{{ route('/answers') }}">Back</a>

    <form method="POST" action="{{route('answer.create')}}">
        @csrf    
        <label for="name">Content</label>
        <input name="content" type="text">

        <label for="pregunta_id">Pregunta id</label>
        <input name="question_id" type="number">

        <label for="active">Active</label>

        <select name="active">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <button type="submit">Create</button>
    </form>
</x-app-layout>