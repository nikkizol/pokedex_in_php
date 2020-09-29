<?php
declare(strict_types=1);

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);


if (isset ($_GET["name"])) {
    $idName = $_GET["name"];

} else {
//    $idName = "1";
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
?>

<html>
<body>

<form action = "index.php" method = "GET">
    Name or id: <input type = "text" name = "name" />
    <input type = "submit" />
</form>
<ol class="Pokemon">
    <h4 class="title">
        <p class="name"><?php echo  $name;?></p>
        <p class="id"><?php echo  $id;?></p>
    </h4>
    <img class="img" src="<?php echo  $img;?>">
    <p class="moves"></p>
    <p id="moves"><?php echo  implode(", ",$moves); ?></p>
    <p class="evo"></p>
    <p class="id_prev"></p>
    <img class="img_prev" src="">
</ol>

</body>
</html>