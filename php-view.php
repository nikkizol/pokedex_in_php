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
<h1>Pokemons</h1>
<div class="container">
    <div class="row">
        <?php foreach ($arrOfNames as $i =>  $name): ?>
        <div class="col-3">
            <div class="card mt-4">
                <img class="card-img-top" src="<?php echo $name['sprites']["front_default"];?>" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title"><?php echo ucfirst($name['name']) ?></h4>
                    <p class="card-text">
                    </p>
                    <a href="overview.php?poke=<?php echo $name['id'] ?>" type="submit" name="overview" class="btn btn-primary">Overview</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>



<!--<h1>Pokemons</h1>-->
<!--<div class="container">-->
<!--    <div class="row">-->
<!--        --><?php //foreach ($arrOfNames as  $name): ?>
<!--            <div class="col-2">-->
<!--                --><?php //echo ucfirst($name) ?>
<!--            </div>-->
<!--        --><?php //endforeach; ?>
<!--    </div>-->
<!--</div>-->
















<!--    <h4 class="title">-->
<!--        <p class="name">--><?php //if (isset ($name)) {
//                echo "Name: ", ucfirst($name);
//            } ?><!--</p>-->
<!---->
<!--        <p class="id">--><?php //if (isset ($id)) {
//                echo "Id#: ", $id;
//            } ?><!--</p>-->
<!--    </h4>-->
<!---->
<!--    <img class="img" src="--><?php //if (isset ($img)) {
//        echo $img;
//    } ?><!--">-->
<!--    <p class="moves"></p>-->
<!--    <p id="moves">--><?php //if (isset ($uniqueMoves)) {
//            echo "Moves: ", implode(", ", $uniqueMoves);
//        } ?><!--</p>-->
<!--    <h4 class="evo">--><?php //if (isset ($namePrev)) {
//            echo "Prev evo: ", ucfirst($namePrev);
//        } else if (!empty ($nameNextEvo)) {
//            echo "It's a baby, next evo is: ", ucfirst($nameNextEvo);
//        } else {
//            echo "";
//        } ?><!--</h4>-->
<!--    <h4 class="id_prev"> --><?php //if (isset ($idPrev)) {
//            echo "Id#: ", $idPrev;
//        } ?><!--</h4>-->
<!--    <img class="img_prev" src="--><?php //if (isset ($imgPrev)) {
//        echo $imgPrev;
//    } else if (isset ($imgForNext)) {
//        echo $imgForNext;
//    } ?><!--">-->
</body>
</html>
