<?php include _THEMES . 'adm/partial/header.php' ?>

<body>
    <?php include _THEMES . 'adm/partial/sidenav.php' ?>

    <?php include _THEMES . 'adm/partial/navbar.php' ?>

    <main class="container">
        <div class="grid-row">
            <article>
                <h4>Bienvenido 👋</h4>
                <p>¡Esperamos que estés progresando en tu proyecto! Siéntase libre de leer las últimas noticias sobre Mint. Estamos haciendo todo lo posible para mejorar el producto en función de sus comentarios.</p>
                <a href="<?= base('admin/pages/add') ?>" role="button">Comenzar</a>
            </article>

            <article>
                <h4>Acerca de</h4>
                <table>
                    <tbody>
                        <tr>
                            <td><?= Mint\App::_name ?></td>
                            <td><?= Mint\App::_version ?></td>
                        </tr>
                        <tr>
                            <td>PHP</td>
                            <td><?= PHP_VERSION ?></td>
                        </tr>
                    </tbody>
                </table>
                <footer>
                    <span>&copy; 2022 <a href="http://github.com" target="_blank"><?= Mint\App::_name ?></a></span>
                </footer>
            </article>
        </div>
    </main>

    <?= $page->js('script.js') ?>
</body>

</html>