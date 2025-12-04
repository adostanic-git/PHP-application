<?php require_once "db.php" ?>
<?php include "modul/head.php" ?>


<?php 

$products = $pdo->query(
    "select products.*, categories.naziv as `category`
    from products
    join categories on
    categories.id = products.categories_id
    "
    )->fetchAll();


?>

<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<h1 class="w3-text-teal" style="display: flex; align-items: center; margin-top: 50px; margin-left: 100px;">Katalog</h1> <br>

<div class="row">


    <div class="col-sm-9">

        <table class="table" style="margin-top: 0px; margin-left:100px;">

            <thead>
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
                        <td><?= $product['cena'] ?></td>
                        <td><?= $product['category'] ?></td>
                        <td>
                            <a href="product.php?id=<?= $product['id'] ?>">Opširnije...</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>

    </div>

</div>


<?php include "modul/foot.php" ?>


</div>

<script>

var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>






