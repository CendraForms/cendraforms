<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Role {{ $role->name }}</title>
</head>
<body>
    <div>
        <form action="/api/answers" method="POST">
            <div>
                <label for="namerole">Content</label>
                <input type="text" name="name" id="namerole" value="">
            </div>
            <div>
                <div>
                    @if($role->active)
                        <input type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
                    @else
                        <input type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    @endif
                    <label for="flexSwitchCheckDefault"> Estat</label>
                </div>
            </div>
        </form>
    </div>
</body>
</html>