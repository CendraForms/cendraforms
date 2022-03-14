<x-app-layout>
    <a href="{{ route('users.index') }}">Back</a>

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <label for="name">Name</label>
        <input name="name" type="text" value="{{ $user->name }}">

        <label for="email">Email</label>
        <input name="email" type="email" value="{{ $user->email }}">

        <label for="active">Active</label>

        <!-- <input type="checkbox" name="active"> -->

        <select name="active">
            <option selected disabled></option>
            <option value="1" {{ $user->active == 1 ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ $user->active == 0 ? 'selected' : '' }}>No</option>
        </select>

        <button type="submit">Update</button>
    </form>
</x-app-layout>
