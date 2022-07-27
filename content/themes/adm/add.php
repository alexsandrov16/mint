<?php include _THEMES . 'adm/partial/header.php' ?>

<body>
    <?php include _THEMES . 'adm/partial/sidenav.php' ?>

    <?php include _THEMES . 'adm/partial/navbar.php' ?>

    <main class="container">
        <article>
            <form action="" method="post">
                <label for="">Título</label>
                <input type="text" name="" id="">

                <label for="">URl</label>
                <input type="text" name="" id="">
                <small>URL asociada al contenido.</small>
            </form>
            <div id="editor"></div>

            <button type="submit" form="">Publicar</button>
        </article>
    </main>

    <?= $page->js('script.js') ?>
    <?= $page->js('editor.js') ?>
    <script>
        const editor = new EditorJS({
            /**
             * Id of Element that should contain Editor instance
             */
            holder: 'editor',
        });
    </script>
    <style>
        #editor {
            border: 1px solid var(--form-element-border-color);
            border-radius: var(--border-radius);
            margin-bottom: 1.5em;
        }

        #editor:focus-within {
            border-color: var(--form-element-active-border-color);
        }

        #editor svg {
            height: auto !important;
            width: auto !important;
        }
    </style>
</body>

</html>