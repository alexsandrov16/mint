<?php include _THEMES . 'adm/partial/header.php' ?>

<body>
    <?php include _THEMES . 'adm/partial/sidenav.php' ?>

    <?php include _THEMES . 'adm/partial/navbar.php' ?>

    <main class="container">
        <article>
            <form action="" method="post">

                <div class="grid">
                    <label for=""> Nombre del sitio *
                        <input type="text" name="" id="" value="<?= env('site_name') ?>" required>
                        <small>Utilice este campo para nombrar su sitio, aparecerá en la parte superior de cada página de su sitio.</small>
                    </label>

                    <label for=""> Descripción del sitio *
                        <input type="text" name="" id="" value="<?= env('site_description') ?>" required>
                        <small>Puede agregar una descripción del sitio para proporcionar una breve biografía o descripción de su sitio.</small>
                    </label>
                </div>

                <div class="grid">
                    <label for=""> URL del sitio *
                        <input type="text" name="" id="" value="<?= env('base_url') ?>" required>
                        <small>URL completa de su sitio. Completa con el protocolo http o https (sólo si has habilitado SSL en tu servidor).</small>
                    </label>

                    
                    <label for="debug"> 
                        <p>Visualizar errores </p>
                        <input type="checkbox" id="debug" name="debug" role="switch" <?= !env('debug') ?: 'checked'?>>
                        Modo de depuración
                    </label>
                </div>

                <div class="grid">
                    <label for=""> Zona horaria
                        <select name="" id="">
                            <option value="<?=env('timezone')?>"><?=env('timezone')?></option>
                        </select>
                        <small>Seleccione la zona horaria para una correcta visualización de las fechas.</small>
                    </label>

                    
                    <label for=""> Codificación de caracteres 
                        <input type="text" name="" id="" value="<?=env('charset')?>">
                        <small></small>
                    </label>
                </div>

                <div class="grid">
                    <label for=""> Nombre de sesión
                        <input type="text" name="" id="" value="<?=env('session_name')?>">
                        <small></small>
                    </label>

                    
                    <label for=""> Tiempo de sesión
                        <input type="number" name="" id="" value="<?=env('session_timeout')?>" min="0">
                        <small></small>
                    </label>
                </div>

                <div class="grid">
                    <label for=""> Cambiar contraseña
                        <input type="password" name="" id="">
                    </label>

                    
                    <label for="user"> 
                        <p> </p>
                        <input type="checkbox" id="user" name="user" role="switch" <?= !env('root') ?: 'checked'?>>
                        Activar super usuario
                    </label>
                </div>

                <br>
                <button type="submit" class="btn-lg">Guardar</button>
            </form>
        </article>
    </main>

    <?= $page->js('script.js') ?>
</body>

</html>