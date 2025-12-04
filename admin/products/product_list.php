<?php 

$title = "Lista proizvoda";
require_once "../db.php";
include "admin_moduls/head.php";
include "admin_moduls/mainnav.php";


$products = $pdo->query(
    "select products.*, categories.naziv as `category`
    from products
    join categories on
    categories.id = products.categories_id
    "
    )->fetchAll();

?>

<div class="row">
    <div class="col-md-10">
        <h1>Lista Proizvoda</h1> <br>
    </div>
    <div class="col-md-2">
        <a style="margin-top: 30px;" href="products/product_create.php" class="btn btn-primary">Dodaj proizvod</a>
    </div>
</div>

<table class="table">

    <thead>

        <tr>

            <th>Naziv proizvoda</th>
            <th>Cena</th>
            <th>Kategorija</th>
            <th>Kolicina</th>
            <th colspan="2">Opcije</th>

        </tr>

    </thead>

    <tbody>
        <?php foreach($products as $product) { ?>
            <tr>
                <td><?= $product['naziv'] ?></td>
                <td><?= $product['cena'] ?></td>
                <td><?= $product['category'] ?></td>
                <td><?= $product['kolicina'] ?></td>
                <td>
                    <a href="products/product_delete.php?id=<?= $product['id'] ?>" class="btn btn-danger">Obrisi</a>
                </td>
                <td>
                    <a href="products/product_edit.php?id=<?= $product['id'] ?>" class="btn btn-default">Izmeni</a>
                </td>
                
            </tr>
        <?php } ?>
    </tbody>


</table>



<?php include "admin_moduls/foot.php"; ?>