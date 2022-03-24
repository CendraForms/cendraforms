<x-app-layout>
    <p>Hello</p>
    <a href="{{ route('answers.index') }}">Back</a>
    
    <form method="POST"  action="{{ route('answers.update', $answer->id) }}">
        @csrf @method("PUT")  
        <label for="content">Content</label>
        <input name="content" type="text" value="{{ $answer->content }}">

        <label for="active">Active</label>

        <select name="active">
            <option selected disabled></option>
            <option value="1" {{ $answer->active == 1 ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ $answer->active == 0 ? 'selected' : '' }}>No</option>
        </select>

        <button type="submit">Update</button>
    </form>
</x-app-layout>
