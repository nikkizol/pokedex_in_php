<?php
declare(strict_types=1);

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);


if (isset ($_GET["name"])) {
    $idName = $_GET["name"];

} else {
    $idName = "3";
}
$pokemon = file_get_contents('https://pokeapi.co/api/v2/pokemon/'.$idName);
$data = json_decode($pokemon, true);
$id =  $data['id'];
$name =  $data['name'];
$img = $data['sprites']["front_default"];
$randArr = [];
$moves = [];

for ($x = 0; $x < 4; $x++) {
    array_push($randArr, rand(0, count($data['moves'])));
}
echo var_dump($randArr);
for ($x = 0; $x < 4; $x++) {
    array_push($moves, $data['moves'][$randArr[$x]]["move"]["name"]);
}
echo var_dump($moves);

$pokemonSpices = file_get_contents('https://pokeapi.co/api/v2/pokemon-species/'.$idName);
$dataSpices = json_decode($pokemonSpices, true);
//echo var_dump($dataSpices);
$pokemonSpicesFrom = $dataSpices["evolves_from_species"]["url"];
if (isset ($pokemonSpicesFrom)) {
    $dataSpicesFrom = json_decode($pokemonSpicesFrom, true);
//echo var_dump($pokemonSpicesFrom);
    $dataPrevEvo = file_get_contents("$pokemonSpicesFrom");
    $prevEvo = json_decode($dataPrevEvo, true);
    echo var_dump($prevEvo["name"]);
} else {

}

?>

<html>
<body>

<form action = "index.php" method = "GET">
    Name or id: <input type = "text" name = "name" />
    <input type = "submit" />
</form>
<ol class="Pokemon">
    <h4 class="title">
        <p class="name"><?php if (isset ($name)) {
                echo $name;
            } else {
                $name = "";
            }?></p>
        <p class="id"><?php if (isset ($id)) {
                echo $id;
            } else {
                $id = "";
            }?></p>
    </h4>
    <img class="img" src="<?php if (isset ($img)) {
        echo $img;
    } else {
        $img = "";
    }?>">
    <p class="moves"></p>
    <p id="moves"><?php echo  implode(" ",$moves); ?></p>
    <p class="evo"><?php if (isset ($prevEvo["name"])) {
            echo "prev evo: ", $prevEvo["name"];
        } else {
            echo "prev evo: no prev evo";
        }?></p>
    <p class="id_prev"></p>
    <img class="img_prev" src="">
</ol>

</body>
</html>
