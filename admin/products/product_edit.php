<?php
require_once "../auth.php";
require_once "../../db.php";
$title = "Izmeni proizvod";
include "../admin_moduls/head.php";

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute(["id" => $_GET['id']]);
$product = $stmt->fetch();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $naziv = trim($_POST['naziv']);
    $cena = trim($_POST['cena']);
    $categories_id = $_POST['categories_id'];
    $opis = trim($_POST['opis']);
    $kolicina = trim($_POST['kolicina']);
    $istaknuto = trim($_POST['istaknuto']);

    if (empty($naziv)) {
        $errors[] = "Naziv proizvoda je obavezan.";
    }
    if (empty($cena) || !is_numeric($cena) || $cena <= 0) {
        $errors[] = "Cena mora biti pozitivan broj.";
    }
    if (empty($categories_id)) {
        $errors[] = "Kategorija je obavezna.";
    }
    if (empty($opis)) {
        $errors[] = "Opis je obavezan.";
    }
    if (empty($kolicina)) {
        $errors[] = "Kolicina je obavezana.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare(
            "UPDATE products
            SET naziv = :naziv, cena = :cena, categories_id = :categories_id, opis = :opis, kolicina = :kolicina, istaknuto = :istaknuto
            WHERE id = :id"
        );

        $stmt->execute([
            "naziv" => $naziv,
            "cena" => $cena,
            "categories_id" => $categories_id,
            "opis" => $opis,
            "id" => $_GET['id'],
            "kolicina" => $kolicina,
            "istaknuto" => $istaknuto
        ]);

        header("Location: ../proizvodi.php");
        exit();
    }
}
?>

<h1 style="margin-bottom: 20px; margin-top:50px;">Izmeni proizvod</h1> <br>

<?php if (!empty($errors)) { ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error) { ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>

<form action="" method="post">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="naziv">Izmenite naziv proizvoda</label>
                <input type="text" name="naziv" value="<?= htmlspecialchars($product['naziv']) ?>" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="cena">Izmenite cenu proizvoda</label>
                <input type="text" name="cena" value="<?= htmlspecialchars($product['cena']) ?>" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="categories_id">Izmenite kategoriju proizvoda</label>
                <select name="categories_id" class="form-control">
                    <?php 
                        $stmt = $pdo->prepare("SELECT * FROM categories");
                        $stmt->execute();
                        $categories = $stmt->fetchAll();

                        foreach ($categories as $category) { 
                            $selected = ($product['categories_id'] == $category['id']) ? "selected" : "";
                    ?>
                            <option <?= $selected ?> value="<?= $category['id'] ?>">
                                <?= htmlspecialchars($category['naziv']) ?>
                            </option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="kolicina">Izmenite kolicinu</label>
                <input type="text" name="kolicina" value="<?= htmlspecialchars($product['kolicina']) ?>" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
                <div class="form-group">
                    <label for="istaknuto">Izaberite istaknute proizvode</label>
                    <select class="form-control" name="istaknuto" id="">
                        <?php if($product['istaknuto'] == 1): ?>
                            <option  value="0">Neistaknuto</option>
                            <option selected  value="1">Istaknuto</option>
                        <?php else: ?>
                            <option  value="1">Istaknuto</option>
                            <option selected value="0">Neistaknuto</option>
                        <?php endif?>
                    </select>
                </div>
        </div>
            
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="opis">Izmenite opis proizvoda</label>
                <textarea name="opis" class="form-control" rows="4"> <?= htmlspecialchars($product['opis']) ?> </textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Izmeni proizvod</button>
            <a href="../proizvodi.php" class="btn btn-danger">Odustani od izmene</a>
        </div>
    </div>
</form>

<?php include "../admin_moduls/foot.php" ?>
