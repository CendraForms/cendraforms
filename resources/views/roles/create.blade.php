<x-app-layout>
    <a href="{{ route('roles.index') }}">Back</a>

    <form method="POST" action="{{ route('roles.store') }}">
        @csrf    
        <label for="name">Name</label>
        <input name="name" type="text">

        <label for="active">Active</label>

        <!-- <input type="checkbox" name="active"> -->

        <select name="active">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <button type="submit">Create</button>
    </form>
</x-app-layout>
