<?php defined('MINT') || die; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ups!</title>
    <?= (new Mint\Helper\Theme(''))->favicon() ?>
</head>
<style>
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        color: #333;
    }
    body{height: 100vh;display: flex;justify-content: center;align-items: center;background-color: rgb(190, 212, 203, .3);}
    main{text-align: center;}
    h1{font-size: 8em}
    h2{font-size: 2em}
</style>
<body>
    <main>
        <h1>500</h1>
        <h2>Internar Server Error</h2>
    </main>
</body>

</html>