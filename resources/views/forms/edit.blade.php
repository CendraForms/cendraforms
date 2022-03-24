<x-app-layout>
    <a href="{{ route('forms.index') }}">Back</a>

    <form method="POST" action="{{ route('forms.update', $form->id) }}">
        @csrf
        @method('PUT')

        <label for="name">Name</label>
        <input name="name" type="text" value="{{ $form->name }}">

        <label for="description">Description</label>
        <input name="description" type="text" value="{{ $form->description }}">

        <label for="active">Active</label>

        <!-- <input type="checkbox" name="active"> -->

        <select name="active">
            <option selected disabled></option>
            <option value="1" {{ $form->active == 1 ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ $form->active == 0 ? 'selected' : '' }}>No</option>
        </select>

        <button type="submit">Update</button>
    </form>
</x-app-layout>
