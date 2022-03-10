<x-app-layout>
    <a href="{{ route('roles.index') }}">Back</a>
    
    <form method="POST"  action="{{ route('roles.update', $role->id) }}">
        @csrf @method("PUT")  
        <label for="name">Name</label>
        <input name="name" type="text" value="{{ $role->name }}">

        <label for="active">Active</label>

        <select name="active">
            <option selected disabled></option>
            <option value="1" {{ $role->active == 1 ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ $role->active == 0 ? 'selected' : '' }}>No</option>
        </select>

        <button type="submit">Update</button>
    </form>
</x-app-layout>
