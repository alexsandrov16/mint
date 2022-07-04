<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="<?= env('charset') ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <?=
    $page->css('pico.min.css')
        ->css('style.css')
        ->favicon()
    ?>
</head>