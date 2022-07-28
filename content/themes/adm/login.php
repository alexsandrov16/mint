<?php include _THEMES . 'adm/partial/header.php' ?>

<body>
    <main class="wrapper-login">
        <article>
            <center>
                <h1 style="margin-bottom:.75em">Inicia Sesión</h1>
            </center>
            <form method="POST" style="margin:0;">
                <input type="text" id="firstname" name="user" placeholder="Usuario" required autocomplete="off">
                <input type="password" id="lastname" name="pass" placeholder="Contraseña" required>
                <!-- Button -->
                <button type="submit" style="margin:0;">Acceder</button>
            </form>

            <br>

            <center>
                <a href="<?= base() ?>">Volver al inicio</a>
            </center>
        </article>
    </main>

    <?php include _THEMES . 'adm/partial/alert.php' ?>
</body>

</html>