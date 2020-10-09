<?php

declare(strict_types=1);
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

$arrOfNames = array();
if ($pokemons = @file_get_contents('https://pokeapi.co/api/v2/pokemon/?offset=0&limit=20') === FALSE) {
    echo "";
} else {
    $pokemons = @file_get_contents('https://pokeapi.co/api/v2/pokemon/?offset=0&limit=20');
    $data_pokemons = json_decode($pokemons, true);
    foreach ($data_pokemons as $value) {
//        var_dump($names = $value);
        $names = $value;
    }
    foreach ($names as $value) {
        $dataEachPoke = @file_get_contents($value['url']);
        $allPoke = json_decode($dataEachPoke, true);
//        var_dump($allPoke['name']);
        array_push($arrOfNames, $allPoke);
        }
//    var_dump($arrOfNames);




//    foreach ($allPoke as $valueq) {
////        $cart = array();
////        array_push($cart, $allPoke['name']);
//        var_dump($valueq);
//    }
//    var_dump($cart);
//    var_dump($allPoke);

//    for ($x = 0; $x < 20; $x++) {
//        $dataEachPoke = @file_get_contents($names[$x]['url']);
//        $allPoke = json_decode($dataEachPoke, true);
//        $cart = array();
//        array_push($cart, $allPoke['name']);
//        var_dump($cart);
//    }

//    foreach ($allPoke as $value1) {
//        var_dump($value1['name']);
//    }


//            $name = $allPoke['name'];
//            $id = $allPoke['id'];
//            $img = $allPoke['sprites']["front_default"];


//        $dataPrevEvo = @file_get_contents($value1);
//        $prevEvo = json_decode($dataPrevEvo, true);
//        var_dump($prevEvo);
//        }
//    }

//    for ($x = 0; $x < 20; $x++) {
//        $pokemon = @file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $name);
//        $data = json_decode($pokemon, true);
//    }
//    var_dump($data);

//        if (!empty ($data['results']['name'])) {
//            $name = $data['results'][0]['name'];
//            $id = $data['id'];
//            $img = $data['sprites']["front_default"];
//            var_dump($name);

//------------------------RANDOM MOVES------------------------
//            $randArr = [];
//            $moves = [];
//            for ($x = 0; $x < 4; $x++) {
//                array_push($randArr, rand(0, count($data['moves']) - 1));
//            }
//            for ($x = 0; $x < 4; $x++) {
//                array_push($moves, $data['moves'][$randArr[$x]]["move"]["name"]);
//            }
//            $uniqueMoves = array_unique($moves);
//
//
////echo var_dump($moves);
//            $pokemonSpices = @file_get_contents('https://pokeapi.co/api/v2/pokemon-species/' . $idName);
//            $dataSpices = json_decode($pokemonSpices, true);
//
////echo var_dump($dataSpices);
//            if ($dataSpices["evolves_from_species"] !== NULL) {
//                $pokemonSpicesFrom = $dataSpices["evolves_from_species"]["url"];
//                $dataSpicesFrom = json_decode($pokemonSpicesFrom, true);
//
////echo var_dump($pokemonSpicesFrom);
//                $dataPrevEvo = @file_get_contents($pokemonSpicesFrom);
//                $prevEvo = json_decode($dataPrevEvo, true);
//                $prevImg = @file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $prevEvo["name"]);
//                $data2 = json_decode($prevImg, true);
//
//                if ($data2['sprites'] !== NULL) {
//                    $imgPrev = $data2['sprites']["front_default"];
//                    $idPrev = $data2['id'];
//                    $namePrev = $prevEvo["name"];
//
//                }
//            } else if ($pokemonSpicesTo = $dataSpices["evolution_chain"]["url"] !== NULL) {
//                $pokemonSpicesTo = $dataSpices["evolution_chain"]["url"];
//                $dataSpicesTo = json_decode($pokemonSpicesTo, true);
//                $dataNextEvo = @file_get_contents($pokemonSpicesTo);
//                $nextEvo = json_decode($dataNextEvo, true);
//                if (!empty($nameNextEvo = $nextEvo['chain']['evolves_to'])) {
//                    $nameNextEvo = $nextEvo['chain']['evolves_to'][0]['species']['name'];
//                    $data3 = @file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $nameNextEvo);
//                    $dataNext = json_decode($data3, true);
//                    $imgForNext = $dataNext['sprites']["front_default"];
//                }
//
//
//            }

}


require 'php-view.php';