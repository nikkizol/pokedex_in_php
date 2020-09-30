<?php
declare(strict_types=1);

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);


if (isset ($_GET["name"])) {
    $idName = $_GET["name"];
    $pokemon = @file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $idName);
    $data = json_decode($pokemon, true);
    if ($data['name'] !== NULL) {
        $name = $data['name'];
        $img = $data['sprites']["front_default"];
        $randArr = [];
        $moves = [];


        for ($x = 0; $x < 4; $x++) {
            array_push($randArr, rand(0, count($data['moves'])));
        }
//echo var_dump($randArr);
        for ($x = 0; $x < 4; $x++) {
            array_push($moves, $data['moves'][$randArr[$x]]["move"]["name"]);
        }
//echo var_dump($moves);
        $pokemonSpices = @file_get_contents('https://pokeapi.co/api/v2/pokemon-species/' . $idName);
        $dataSpices = json_decode($pokemonSpices, true);
//echo var_dump($dataSpices);
        if ($dataSpices["evolves_from_species"] !== NULL) {
            $pokemonSpicesFrom = $dataSpices["evolves_from_species"]["url"];
            $dataSpicesFrom = json_decode($pokemonSpicesFrom, true);
//echo var_dump($pokemonSpicesFrom);
            $dataPrevEvo = @file_get_contents($pokemonSpicesFrom);
            $prevEvo = json_decode($dataPrevEvo, true);
            $prevImg = @file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $prevEvo["name"]);
            $data2 = json_decode($prevImg, true);
            if ($data2['sprites'] !== NULL) {
                $imgPrev = $data2['sprites']["front_default"];
            } else {
                $imgPrev = "";
            }
            $namePrev = $prevEvo["name"];
        } else {
            $dataSpices["evolves_from_species"] = "";
        }
    }
}


?>

<html>
<body>

<form action="index.php" method="GET">
    Name or id: <input type="text" name="name"/>
    <input type="submit"/>
</form>
<ol class="Pokemon">
    <h4 class="title">
        <p class="name"><?php if (isset ($name)) {
                echo $name;
            } else {
                $name = "";
            } ?></p>
        <p class="id"><?php if (isset ($id)) {
                echo $id;
            } else {
                $id = "";
            } ?></p>
    </h4>
    <img class="img" src="<?php if (isset ($img)) {
        echo $img;
    } else {
        $img = "";
    } ?>">
    <p class="moves"></p>
    <p id="moves"><?php if (isset ($moves)) {
            echo "moves: ", implode(" ", $moves);
        } else {

        } ?></p>
    <p class="evo"><?php if (isset ($namePrev)) {
            echo "prev evo: ", $namePrev;
        } else {
            echo "";
        } ?></p>
    <p class="id_prev"></p>
    <img class="img_prev" src="<?php if (isset ($imgPrev)) {
        echo $imgPrev;
    } else {
        echo "";
    } ?>">
</ol>

</body>
</html>
