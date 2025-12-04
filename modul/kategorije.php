<?php 

$categories = $pdo->query("select * from categories")->fetchAll();

?>

<div class="panel-body">
    <?php foreach($categories as $category) { ?>
        <a class="w3-text-teal" href="kategorija.php?id=<?= $category['id'] ?>"><?= $category['naziv'] ?></a> <br>
    <?php } ?>
</div>





