<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>forms update</title>
</head>
<body>
    <div>
        <form action="/forms/{{ $forms['id'] }}" method="POST">
            @method('PUT')
            @csrf

            <div>
                <label for="nameForms">Nom</label>
                <input name="name" id="nameForms" value="{{ $forms['name'] }}">
            </div>
            <div>
                <label for="descripcioForms">Descripció</label>
                <br>
                <textarea name="description" id="descripcioForms" cols="30" rows="10">{{ $forms['description'] }}</textarea>
            </div>
            <div>
                <label for="activesection">Estat</label>
                @if($forms['active'] == 1)
                    <select name="active" id="activesection">
                        <option value="1" selected>Si</option>
                        <option value="0">No</option>
                    </select>
                @else
                    <select name="active" id="activesection">
                        <option value="1">Si</option>
                        <option value="0" selected>No</option>
                    </select>
                @endif
            </div>
            <div>
                <input type="submit" value="Actualitzar">
            </div>
        </form>
    </div>
</body>
</html>
