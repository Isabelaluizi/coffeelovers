<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="Coffee, review, lovers, share, opinions, reviewer">
        <meta name="description" content="A social media to share opinion about different coffees">
        <link rel="icon" href="images/Coffeeicon.png" type="image/gif" sizes="16x16">
        <meta name="author" content="Isabela">

        <title>Coffee Lovers</title>

        <!-- Fonts -->
        <link href="css/app.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Fredericka+the+Great&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <Root />
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/23224187c2.js" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
    </body>
</html>
