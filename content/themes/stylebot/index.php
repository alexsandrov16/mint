<?php defined('MINT') || die; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php $page->metaTag($page_title, $page_description)
        ->css('reboot.min.css')
        ->css('stylebot.css');
    ?>
</head>

<body>
    <main>
        <nav>
            <a href="" class="logo">Mint</a>
            <ul>
                <li><a href="">Link</a></li>
                <li><a href="<?=base('admin')?>">Acceder</a></li>
            </ul>
        </nav>

        <h2 style="text-align: justify;margin-bottom: 1.5em;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos ullam a animi aspernatur illo quas optio fugiat blanditiis nesciunt, illum cupiditate distinctio necessitatibus asperiores placeat. At sint cumque voluptatem error.</h2>

        <div class="grid">
            <div class="column">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus beatae quos illum ex porro? Commodi debitis accusamus sit. Dolores magni eaque tempore iste sequi rerum ipsum eveniet in esse. Ipsam?</div>
            <div class="column">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus beatae quos illum ex porro? Commodi debitis accusamus sit. Dolores magni eaque tempore iste sequi rerum ipsum eveniet in esse. Ipsam?</div>
        </div>
        <div class="grid">
            <div class="column">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus beatae quos illum ex porro? Commodi debitis accusamus sit. Dolores magni eaque tempore iste sequi rerum ipsum eveniet in esse. Ipsam?</div>
            <div class="column">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus beatae quos illum ex porro? Commodi debitis accusamus sit. Dolores magni eaque tempore iste sequi rerum ipsum eveniet in esse. Ipsam?</div>
        </div>
        <div class="grid">
            <div class="column">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus beatae quos illum ex porro? Commodi debitis accusamus sit. Dolores magni eaque tempore iste sequi rerum ipsum eveniet in esse. Ipsam?</div>
            <div class="column">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus beatae quos illum ex porro? Commodi debitis accusamus sit. Dolores magni eaque tempore iste sequi rerum ipsum eveniet in esse. Ipsam?</div>
        </div>
        
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium similique tenetur culpa delectus doloremque laborum iusto magni at doloribus illum. Doloribus eum explicabo odio repellendus odit alias doloremque, amet possimus?</p>


    </main>
    <footer>&copy; 2022 Mint </footer>
</body>

</html>