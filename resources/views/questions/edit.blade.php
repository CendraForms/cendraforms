<x-app-layout>
    <a href="{{ route('questions.index') }}">Back</a>
    
    <form method="POST"  action="{{ route('questions.update', $questions->id) }}">
        @csrf @method("PUT")  
        <label for="name">Name</label>
        <input name="name" type="text" value="{{ $questions->name }}">
        <label for="questions">Content</label>
        <input name="questions" type="text" value="{{ $questions->content }}">

        <label for="active">Active</label>
        <select name="active">
            <option selected disabled></option>
            <option value="1" {{ $questions->active == 1 ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ $questions->active == 0 ? 'selected' : '' }}>No</option>
        </select>

        <button type="submit">Update</button>
    </form>
</x-app-layout>
