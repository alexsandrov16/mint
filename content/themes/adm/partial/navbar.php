<nav class="container-fluid navbar">
    <ul>
        <li>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" onclick="openNav()">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </li>
    </ul>

    <ul>
        <li>
            <details role="list" dir="rtl">
                <summary aria-haspopup="listbox" role="link" class="svg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="open-modal" onclick="toggleModal(event)" data-target="new-page" viewBox="0 0 16 16">
                        <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z" />
                        <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
                    </svg>
                </summary>
            </details>
        </li>
        <li>
            <details role="list" dir="rtl">
                <summary aria-haspopup="listbox" role="link" class="svg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                    </svg>
                </summary>
                <ul role="listbox">
                    <li><a href="<?= base('admin/off') ?>">Cerrar sesión</a></li>
                    <li><a class="open-modal" onclick="toggleModal(event)" data-target="user">Perfil de usuario</a></li>
                    <li><a>Acerca de</a></li>
                </ul>
            </details>
        </li>
    </ul>
</nav>