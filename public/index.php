<?php
require '../src/Validator.php';
$val = new Validator; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Input validate</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="text-center">
    <div class="row">


        <?php if (!empty($_POST)) : ?>
            <div class="col-12">
                <?php

                if (Validator::is_email($_POST['email'])) {
                    echo 'Емайл верный: ' . $_POST['email'];
                }

                if (Validator::is_IPv4($_POST['ip'])) {
                    echo 'ip верный: ' . $_POST['ip'];
                }
                

                $val->name('email')->value($_POST['email'])->pattern('email')->required();
                $val->name('tel')->value($_POST['tel'])->pattern('tel');
                $val->name('ip')->value($_POST['ip'])->pattern('ip');
                $val->name('message')->value($_POST['message'])->required();

                if ($val->isSuccess()) : ?>
                    <div class="alert alert-success" role="alert">
                        Validation ok!
                    </div>
                <? else : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $val->displayErrors() ?>
                    </div>
                <? endif; ?>
            </div>
        <? endif ?>

        <div class="col-12">
            <form action="" method="POST" class="form-signin">
                <h1 class="h3 mb-3 font-weight-normal">Enter data </h1>
                <input type="email" class="form-control" name="email" placeholder="Email address">
                <!-- <input type="password" name="password" pattern="<?= $val->patterns['password']['expression']; ?>" title='<?= $val->patterns['password']['title']; ?>' placeholder="password" class="form-control"> -->

                <input type="text" name="tel" required pattern="<?= $val->patterns['tel']['expression']; ?>" title='<?= $val->patterns['tel']['title']; ?>' placeholder="8 777 777 77 77" class="form-control">
                <br>
                <input type="text" name="ip" required pattern="<?= $val->patterns['ip']['expression']; ?>" title='<?= $val->patterns['ip']['title']; ?>' placeholder="0.0.0.0" class="form-control">
                <br>
                <textarea name="message" id="" class="form-control"></textarea>
                <br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Verify</button>
            </form>
        </div>

    </div>
</body>

</html>