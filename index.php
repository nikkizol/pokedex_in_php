<?php
declare(strict_types=1);

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

function getData($poke){
    $pokemon = file_get_contents("https://pokeapi.co/api/v2/pokemon/" . $poke);
    $data = json_decode($pokemon, true);
    return $data;
}
function getName($poke){
    return $namePok =  getData($poke)['name'];
}

function getImg($poke){
    return $imgPok =  getData($poke)['sprites']["front_default"];
}

function getId($poke){
    return $imgPok =  getData($poke)['id'];
}



if (isset ($_GET["name"])) {
    $id_Name = $_GET["name"];


//-----------------------RANDOM MOVES-----------------------
        $randArr = [];
        $moves = [];
        $maxMove = 4;
        for ($x = 0; $x < 4; $x++) {
            array_push($randArr, rand(0, count(getData($id_Name)['moves'])));
        }
        for ($x = 0; $x < 4; $x++) {
            array_push($moves, getData($id_Name)['moves'][$randArr[$x]]["move"]["name"]);
        }
        $uniqueMoves = array_unique($moves);






        $pokemonSpices = @file_get_contents('https://pokeapi.co/api/v2/pokemon-species/' . $id_Name);
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
            } else {
                $imgPrev = "";
                $idPrev = "";
            }
            $namePrev = $prevEvo["name"];
        } else {
        }
        }
//            $dataSpices["evolves_from_species"] = " ";
            $pokemonSpicesTo = $dataSpices["evolution_chain"]["url"];
            $dataSpicesTo = json_decode($pokemonSpicesTo, true);
            $dataNextEvo = @file_get_contents($pokemonSpicesTo);
            $nextEvo = json_decode($dataNextEvo, true);
            echo var_dump($nextEvo['chain']['evolves_to'][0]['species']['name']);
    echo var_dump($nextEvo['chain']['evolves_to'][0]['evolves_to'][0]['species']['name']);
            $nameNextEvo = $nextEvo['chain']['evolves_to'][0]['species']['name'];






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
        <p class="name"><?php if (getName($id_Name)) {
                echo ucfirst(getName($id_Name));
            } else {

            } ?></p>
        <p class="id"><?php if (getId($id_Name)) {
                echo getId($id_Name);
            } else {

            } ?></p>
    </h4>
    <img class="img" src="<?php if (getImg($id_Name)) {
        echo getImg($id_Name);
    } else {

    } ?>">
    <p class="moves"></p>
    <p id="moves"><?php if (isset ($uniqueMoves)) {
            echo "Moves: ", implode(" ", $uniqueMoves);
        } else {

        } ?></p>
    <h4 class="evo"><?php if (isset ($namePrev)) {
            echo "prev evo: ", ucfirst($namePrev);
        } else if (isset ($nameNextEvo)) {
            echo "It's a baby, next evo is: ", ucfirst($nameNextEvo);
        } ?></h4>
    <h4 class="id_prev"> <?php if (isset ($idPrev)) {
            echo "Id#: ", $idPrev;
        } else {

        } ?></h4>
    <img class="img_prev" src="<?php if (isset ($imgPrev)) {
        echo $imgPrev;
    } else {

    } ?>">
</ol>

</body>
</html>
