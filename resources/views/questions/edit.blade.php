<x-app-layout>
    <a href="{{ route('questions.index') }}">Back</a>
    
    <form method="POST"  action="{{ route('questions.update', $question->id) }}">
        @csrf @method("PUT")
        
        <label for="name">Name</label>
        <input name="name" type="text" value="{{ $question->name }}">

        <label for="content">Content</label>
        <textarea name="content">{{ $question->content }}</textarea>

        <label for="active">Active</label>
        <select name="active">
            <option selected disabled></option>
            <option value="1" {{ $question->active == 1 ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ $question->active == 0 ? 'selected' : '' }}>No</option>
        </select>

        <button type="submit">Update</button>
    </form>
</x-app-layout>
