<?php
defined('MINT') || die;

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
    <link rel="shortcut icon" href="<?= base('content/media/favicon.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base('content/themes/errors/css/debug.css') ?>">
</head>

<body>
    <div class="header">
        <div class="container">

            <h1><?= $title ?></h1>
            <h4 onclick="search()" style="cursor: help;" title="Buscar en Google"><?= $message ?></h4>
            <script>
                function search() {
                    let url = "https://www.google.com/search?q=<?= str_replace(' ', '+', $message) ?>";
                    window.open(url, '_blank')
                }
            </script>
            <div class="theme">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"></svg>
            </div>
            <script>
                const modeLight = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches;
                let svg = document.querySelector('svg');
                let sun = '<path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>';
                let moon = '<path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z"/>';

                if (modeLight) {
                    svg.innerHTML = moon;
                } else {
                    svg.innerHTML = sun;
                }

                document.querySelector('.theme').addEventListener('click', () => {
                    if (document.body.dataset.theme == 'light' || modeLight) {
                        document.body.dataset.theme = 'dark';
                        svg.innerHTML = sun;
                    } else {
                        document.body.dataset.theme = 'light';
                        svg.innerHTML = moon;
                    }
                })
            </script>
        </div>
    </div>
    <div class="container" style="margin-bottom: 3em;">
        <h2>Tracers</h2>
        <div class="div"></div>
        <ul>
            <li class="active">
                <span>
                    <?= clean($file), '[', $line, ']' ?>
                </span>
                <div class="source">
                    <?= source($file, $line) ?>
                </div>
            </li>

            <?php
            foreach ($traces as $row) :
                if (isset($row['file']) && is_file($row['file'])) : ?>
                    <li>
                        <span>
                            <?= clean($row['file']), '[', $row['line'], ']' ?>
                        </span>
                        <div class="source">
                            <?= source($row['file'], $row['line']) ?>
                        </div>
                    </li>
            <?php endif;
            endforeach ?>

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