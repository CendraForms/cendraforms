<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>sections</title>
</head>
<body>
    <div>
        <form action="" method="POST">
            @csrf

            <div>
                <label for="formsection">Fomulari</label>
                <select name="form_id" id="formsection">
                    <option value="1">1</option>
                </select>
            </div>
            <div>
                <label for="activesection">Estat</label>
                <select name="active" id="activesection">
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </div>
        </form>
    </div>
</body>
</html>
