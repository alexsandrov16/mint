<?php
defined('PLUME') || die;

function clean($file)
{
    return str_replace(ABS_PATH, '..' . DS, $file);
}

function randomStr()
{
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    return substr(str_shuffle($str), 0, 5);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="shortcut icon" href="<?= env('base_url') ?>/src/assets/plume.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= env('base_url') ?>/src/assets/style.css">
    <link rel="stylesheet" href="<?= env('base_url') ?>/src/assets/debug.css">
</head>

<body>
    <div class="header container">
        <h1><?= $title ?></h1>
        <p onclick="search()" title="Buscar en Google"><?= $message ?></p>
        <script>
            function search() {
                let url = "https://www.google.com/search?q=<?= str_replace(' ', '+', $message) ?>";
                window.open(url, '_blank')
            }
        </script>
    </div>
    <div class="container" style="margin-bottom: 3em;">
        <h3>Tracers</h3>
        <ul>
            <li>
                <div class="title active" id="<?= $random = randomStr() ?>" onclick="i(this)">
                    <span>
                        <?= clean($file), '[', $line, ']' ?>
                    </span>
                </div>
                <div class="source active" data-id="<?= $random ?>">
                    <?= source($file, $line) ?>
                </div>
            </li>
            <li>
                <?php
                foreach ($traces as $row) :
                    if (isset($row['file']) && is_file($row['file'])) : ?>
                        <div class="title" id="<?= $random = randomStr() ?>" onclick="i(this)">
                            <span>
                                <?= clean($row['file']), '[', $row['line'], ']' ?>
                            </span>
                        </div>
                        <div class="source" data-id="<?= $random ?>">
                            <?= source($row['file'], $row['line']) ?>
                        </div>
                <?php endif;
                endforeach ?>
            </li>
        </ul>
    </div>

    <script>
        let sources = document.querySelectorAll('.source')

        function i(e) {
            document.querySelector('.title.active').classList.remove('active')

            sources.forEach(s => {
                s.classList.remove('active')

                if (s.dataset.id == e.id) {
                    s.classList.add('active')
                    e.classList.add('active')
                }
            });
        }
    </script>
</body>

</html>