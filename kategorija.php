<?php

$categories_id = $_GET['id'];

require_once "db.php";
include "modul/head.php";

$products = $pdo->query(
    "SELECT products.*, categories.naziv AS `category`
    FROM products
    JOIN categories ON categories.id = products.categories_id
    WHERE categories.id = $categories_id"
)->fetchAll();

$category_name = $pdo->query(
    "SELECT naziv FROM categories WHERE id = $categories_id"
)->fetchColumn();

?>

<div class="container d-flex justify-content-center" style="margin-top: 100px;">
    <div class="col-md-8 offset-md-2 text-center">
        
        <?php if (empty($products)) { ?>
            <h1>Nema proizvoda u toj kategoriji!</h1>
        <?php } else { ?>

        <h1><?= $category_name ?></h1>

        <table class="table table-bordered table-striped mt-5">
            <thead class="thead-dark">
                <tr>
                    <th>Naziv proizvoda</th>
                    <th>Cena</th>
                    <th>Kategorija</th>
                    <th>Opširnije</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product) { ?>
                    <tr>
                        <td><?= $product['naziv'] ?></td>
                        <td><?= $product['cena'] ?> RSD</td>
                        <td><?= $product['category'] ?></td>
                        <td>
                            <a href="product.php?id=<?= $product['id'] ?>">Opširnije...</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <?php } ?>
    </div>
</div>

<?php include "modul/foot.php"; ?>
