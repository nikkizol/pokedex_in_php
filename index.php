<?php

declare(strict_types=1);
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);


if (isset ($_GET["name"])) {
    $idName = lcfirst($_GET["name"]);
    if ($pokemon = @file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $idName) === FALSE) {
        echo "Please enter a correct name or id!!!";
    } else {
        $pokemon = @file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $idName);
        $data = json_decode($pokemon, true);
        if (!empty ($data['name'])) {
            $name = $data['name'];
            $id = $data['id'];
            $img = $data['sprites']["front_default"];

//------------------------RANDOM MOVES------------------------
            $randArr = [];
            $moves = [];
            for ($x = 0; $x < 4; $x++) {
                array_push($randArr, rand(0, count($data['moves']) - 1));
            }
            for ($x = 0; $x < 4; $x++) {
                array_push($moves, $data['moves'][$randArr[$x]]["move"]["name"]);
            }
            $uniqueMoves = array_unique($moves);


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
                    $idPrev = $data2['id'];
                    $namePrev = $prevEvo["name"];

                }
            } else if ($pokemonSpicesTo = $dataSpices["evolution_chain"]["url"] !== NULL) {
                $pokemonSpicesTo = $dataSpices["evolution_chain"]["url"];
                $dataSpicesTo = json_decode($pokemonSpicesTo, true);
                $dataNextEvo = @file_get_contents($pokemonSpicesTo);
                $nextEvo = json_decode($dataNextEvo, true);
                if (!empty($nameNextEvo = $nextEvo['chain']['evolves_to'])) {
                    $nameNextEvo = $nextEvo['chain']['evolves_to'][0]['species']['name'];
                    $data3 = @file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $nameNextEvo);
                    $dataNext = json_decode($data3, true);
                    $imgForNext = $dataNext['sprites']["front_default"];
                }


            }
        }
    }
}

?>
<!--------------------------HTML-------------------------->

<html>
<body>
<form action="index.php" method="GET">
    Name or id: <input type="text" name="name"/>
    <input type="submit"/>
</form>
<ol class="Pokemon">
    <h4 class="title">
        <p class="name"><?php if (isset ($name)) {
                echo "Name: ", ucfirst($name);
            } ?></p>

        <p class="id"><?php if (isset ($id)) {
                echo "Id#: ", $id;
            } ?></p>
    </h4>

    <img class="img" src="<?php if (isset ($img)) {
        echo $img;
    } ?>">
    <p class="moves"></p>
    <p id="moves"><?php if (isset ($uniqueMoves)) {
            echo "Moves: ", implode(", ", $uniqueMoves);
        } ?></p>
    <h4 class="evo"><?php if (isset ($namePrev)) {
            echo "Prev evo: ", ucfirst($namePrev);
        } else if (!empty ($nameNextEvo)) {
            echo "It's a baby, next evo is: ", ucfirst($nameNextEvo);
        } else {
            echo "";
        } ?></h4>
    <h4 class="id_prev"> <?php if (isset ($idPrev)) {
            echo "Id#: ", $idPrev;
        } ?></h4>
    <img class="img_prev" src="<?php if (isset ($imgPrev)) {
        echo $imgPrev;
    } else if (isset ($imgForNext)) {
        echo $imgForNext;
    } ?>">
</ol>
</body>
</html>
