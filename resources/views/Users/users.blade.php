<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body class="antialiased">
    <table class="default">
    <tr>
<th>id</th>
<th>Nom</th>
<th>Email</th>
<th>Estat</th>
</tr>
    <?php 
foreach($user as $user){
  print "<tr><td>".$user['id']."</td><td>".$user['name']."</td><td>".$user['email']."</td><td>".$user['active']."</td></tr>";
}   
    ?>
</table>
    </body>
</html>
