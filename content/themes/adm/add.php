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

    <!--Editor.JS-->
    <?= $page->js('editor/editor.js') ?>
    <!--Plugins Editor.JS-->
    <?= $page->js('editor/plugins/editorjs-columns@latest.js') ?>
    <?= $page->js('editor/plugins/header@latest.js') ?>
    <?= $page->js('editor/plugins/list@latest.js') ?>
    <?= $page->js('editor/plugins/quote@latest.js') ?>
    <?= $page->js('editor/plugins/editorjs-paragraph-with-alignment@3.0.js') ?>
    <?= $page->js('editor/plugins/image@2.3.js') ?>


    <script>
        let column_tools = {
            header: Header,
            list: List,
            quote: Quote,
            paragraph: {
                class: Paragraph,
                inlineToolbar: true,
            },
            image: {
                class: ImageTool,
                config: {
                    endpoints: {
                        byFile: 'http://localhost:8008/uploadFile', // Your backend file uploader endpoint
                        byUrl: 'http://localhost:8008/fetchUrl', // Your endpoint that provides uploading by Url
                    }
                }
            },
        };

        // next define the tools in the main block
        // Warning - Dont just use main_tools - you will probably generate a circular reference 
        let main_tools = {

            // Load Official Tools
            header: Header,
            list: List,
            quote: Quote,
            paragraph: {
                class: Paragraph,
                inlineToolbar: true,
            },
            image: {
                class: ImageTool,
                config: {
                    endpoints: {
                        byFile: 'http://localhost:8008/uploadFile', // Your backend file uploader endpoint
                        byUrl: 'http://localhost:8008/fetchUrl', // Your endpoint that provides uploading by Url
                    }
                }
            },

            columns: {
                class: editorjsColumns,
                config: {
                    tools: column_tools, // ref the column_tools
                    EditorJsLibrary: EditorJS
                }
            },
        };

        editor = new EditorJS({
            //readOnly: false,
            holder: 'editor',
            placeholder: 'Let`s write an awesome story!',
            tools: main_tools,
            //data: content,


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

        #editor input {
            padding: 0 !important;
            height: auto;
            margin: 0;
        }

        .ce-toolbar__actions {
            right: auto !important;
        }

        @media (min-width: 992px) {
            #editor {
                padding: 0 1.5em;
            }

            .ce-toolbar__actions {
                right: 100% !important;
            }
        }
    </style>
</body>

</html>