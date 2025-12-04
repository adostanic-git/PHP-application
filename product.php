<?php 

include "db.php";

$stmt = $pdo->prepare(
    "SELECT * FROM products WHERE id = :id"
);
$stmt->execute([
    "id" => $_GET['id']
]);

$product = $stmt->fetch();

include "modul/head_product.php";

?>

<div class="row">
    <!-- Naziv proizvoda -->
    <h1 class="text-center" style="margin-top: 100px;"><?= htmlspecialchars($product['naziv']) ?></h1> <br>

    <div class="col-md-12 text-center">
        <!-- Slika proizvoda -->
        <img src="data:image/jpeg;base64,<?= base64_encode($product['slika']) ?>" 
             alt="<?= htmlspecialchars($product['naziv']) ?>" 
             class="img-fluid"
             style="max-width: 80%; height: 500px; border-radius: 10px; margin-top: 20px;">
        
        <!-- Opis proizvoda -->
        <p style="margin: 30px 100px; font-size: 18px;"><?= nl2br(htmlspecialchars($product['opis'])) ?></p>

        <!-- Dugme za povratak -->
        <p>
            <a href="index.php?id=<?= $product['id'] ?>" class="btn btn-primary">
                Pogledaj sve proizvode
            </a>
        </p>
    </div>
</div>

<?php include "modul/foot.php"; ?>
