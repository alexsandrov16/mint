<?php include _THEMES . 'adm/partial/header.php' ?>

<body>
    <?php include _THEMES . 'adm/partial/sidenav.php' ?>

    <?php include _THEMES . 'adm/partial/navbar.php' ?>

    <main class="container">

        <h3>Dashboard</h3>

        <article>

        <h4>Bienvenido 👋</h4>
        <p>¡Esperamos que estés progresando bien en tu proyecto! Siéntase libre de leer las últimas noticias sobre Mint. estamos haciendo todo lo posible para mejorar el producto en función de sus comentarios.</p>



            <h4>¡Bienvenido a Mint CMS! 👋</h4>
            <p>¡Mint esta listo para funcionar! Puede generar página, añadir temas, personalizar su sitio y mucho más utilizando este panel. A continuación hemos reunido algunos enlaces para que comiences.</p>

            <div class="grid">

                <ul>
                    <h4>Comenzar</h4>
                    <li><a class="open-modal" onclick="toggleModal(event)" data-target="new-page">Añadir una página nueva</a></li>
                    <li><a href="">Agregar Tema</a></li>
                    <li><a href="">Personalizar sitio</a></li>
                </ul>

                <ul>
                    <h4>Aprender más</h4>
                    <li><a href="">Documentación</a></li>
                    <li><a href="">Tutoriales</a></li>
                    <li><a href="">Documentacion</a></li>
                </ul>

                <ul>
                    <h4>Comunidad</h4>
                    <li><a href="https://github.com/alexsandrov16/mint" target="_blank">Github</a></li>
                    <li><a href="">Telegram</a></li>
                </ul>
            </div>
        </article>
    </main>

    <dialog class="modal" id="new-page">
        <article>
            <header>Añadir Página</header>

            <form id="addPage" method="POST">

                <label for="page">Título</label>
                <input type="text" id="page" name="page" placeholder="Email address" required>

                <label for="url">Url</label>
                <input type="text" id="url" name="url" placeholder="Disabled" value="" disabled>

                <label for=""></label>
            </form>

            <footer>
                <button type="reset" form="addPage" onclick="toggleModal(event)" class="secondary">Cancelar</button>
                <button type="submit" form="addPage">Continuar</button>
            </footer>
        </article>
    </dialog>

    <!--<article>
        <header>asdasd</header>
        <form action="" method="post">
            <label for="">asdasd</label>
            <input type="text" name="" id="">

            <label for="">asdasd</label>
            <input type="text" name="" id="">
        </form>

        <footer>
            <button type="reset">cancel</button>
            <button type="submit">confirm</button>
        </footer>
    </article>
-->

    <?=$page->js('script.js')?>
</body>

</html>