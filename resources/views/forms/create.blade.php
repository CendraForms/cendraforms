<x-app-layout>
    <a href="{{ route('forms.index') }}">Back</a>

    <form method="POST" action="{{ route('forms.store') }}">
        @csrf
        <label for="name">Name</label>
        <input name="name" type="text">

        <label for="description">Description</label>
        <input name="description" type="text">

        <label for="active">Active</label>

        <!-- <input type="checkbox" name="active"> -->

        <select name="active">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <button type="submit">Create</button>
    </form>
</x-app-layout>
