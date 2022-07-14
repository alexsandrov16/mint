<?php include _THEMES.'adm/partial/header.php'?>
<body>
    <main class="container">
        <center><img src="<?= env('base_url') ?>/content/media/logo.png" alt="Mint" max-width="400"></center>

        <form method="POST" class="login">
            <input type="text" id="firstname" name="user" placeholder="Usuario" required autocomplete="off">
            <input type="password" id="lastname" name="pass" placeholder="Contraseña" required>
            <!-- Button -->
            <button type="submit">Iniciar sesión</button>
        </form>

        <br>

        <center>
            <a href="<?= base() ?>">Volver al inicio</a>
        </center>
    </main>

</body>

</html>