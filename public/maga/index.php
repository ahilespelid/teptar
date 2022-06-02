<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Teptar</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="description" content="Шаблон индексной страницы">
        <meta name="keywords" content="Шаблон индексной страницы">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="blocks/styles.css">
        <link rel="stylesheet" type="text/css" href="blocks/browsers.css">
        <link rel="stylesheet" type="text/css" href="blocks/fonts.css">

        <base href="/maga">
    </head>

    <body>

        <?php include 'blocks/navbar/navbar.html' ?>

        <div class="container">

            <div class="main">
                <?php include 'blocks/start/start.html';?>
                <?php include 'blocks/districts/districts.html';?>
                <?php include 'blocks/rating/rating.html';?>
                <?php include 'blocks/comparison/comparison.html';?>
                <?php include 'blocks/actions/actions.html';?>
            </div>

        </div>

    </body>

    <script type="text/javascript" src="blocks/scripts.js"></script>
    <script type="text/javascript" src="blocks/comparison/comparison.js"></script>

</html>
