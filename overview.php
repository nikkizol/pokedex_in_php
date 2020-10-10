<?php
function getAllData($x)
{
    $data = @file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $x);
    $dataDecode = json_decode($data, true);
    var_dump($dataDecode['name']);
    var_dump($dataDecode['id']);
    var_dump($dataDecode['sprites']["front_default"]);
    $typesLength = count($dataDecode['types']);
    for ($i = 0; $i < $typesLength; $i++) {
        var_dump($dataDecode['types'][$i]['type']['name']);
    }
}


if (isset($_GET['poke'])) {
        for ($i = 0; $i < 21; $i++) {
            if ($_GET['poke'] == $i) {
                getAllData($i);
            }
        }

}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pokedex</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/97e98690fe.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<h1>Overview</h1>
</body>
</html>