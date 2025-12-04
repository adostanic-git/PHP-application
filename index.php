<?php require_once "db.php"; ?>
<?php include "modul/head.php"; ?>

<?php
$product = $pdo->query(
  "SELECT products.id, products.naziv, products.cena, products.slika 
  FROM products
  WHERE products.istaknuto = 1"
)->fetchAll();
?>

<h1 class="w3-text-teal" style="margin-top: 50px;">Izdvajamo iz ponude</h1> <br>

<div class="w3-row-padding" style="margin-top: 30px;">
    <?php foreach($product as $index => $p) { ?>
        <div class="w3-col l4 m6 s12 w3-margin-bottom">
            <div class="w3-card w3-white w3-padding w3-center w3-round-large" style="box-shadow: 0px 4px 10px rgba(0,0,0,0.1); padding-bottom: 20px;">
                <h4 class="w3-text-black"><b><?= htmlspecialchars($p['naziv']) ?></b></h4>
                
                <!-- Slika proizvoda -->
                <img src="data:image/jpeg;base64,<?= base64_encode($p['slika']) ?>" 
                     alt="<?= htmlspecialchars($p['naziv']) ?>" 
                     class="w3-image w3-round-large" 
                     style="width:100%; height:320px; object-fit:cover;">
                
                <!-- Cena proizvoda sa razmakom ispod slike -->
                <p class="w3-text-black" style="margin-top: 15px;">
                    Cena: <?= htmlspecialchars($p['cena']) ?> RSD
                </p>

                <a href="product.php?id=<?= $p['id'] ?>" class="w3-button w3-teal w3-round-large w3-hover-dark-gray">Opširnije</a>
            </div>
        </div>
    <?php } ?>
</div>

<?php include "modul/foot.php"; ?>






<script>
var mySidebar = document.getElementById("mySidebar");

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
