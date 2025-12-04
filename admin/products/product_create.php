<?php
require_once "../auth.php";
include "../../db.php"; 
include "../admin_moduls/head.php";

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naziv = trim($_POST['naziv']);
    $cena = trim($_POST['cena']);
    $kolicina = trim($_POST['kolicina']); // Dodata količina
    $categories_id = $_POST['categories_id'];
    $opis = trim($_POST['opis']);

    // Validacija polja
    if (empty($naziv) || empty($cena) || empty($kolicina) || empty($categories_id) || empty($opis)) {
        $error = "Sva polja moraju biti popunjena!";
    } elseif (!is_numeric($cena) || $cena <= 0) {
        $error = "Cena mora biti pozitivan broj!";
    } elseif (!is_numeric($kolicina) || $kolicina < 0) {
        $error = "Količina mora biti broj i ne može biti negativna!";
    } else {
        // Ubacivanje u bazu
        $stmt = $pdo->prepare(
            "INSERT INTO products (naziv, cena, kolicina, categories_id, opis)
            VALUES (:naziv, :cena, :kolicina, :categories_id, :opis)"
        );

        $stmt->execute([
            "naziv" => $naziv,
            "cena" => $cena,
            "kolicina" => $kolicina,
            "categories_id" => $categories_id,
            "opis" => $opis
        ]);

        header("Location: ../proizvodi.php");
        exit();
    }
}
?>

<h1 style="margin-top: 50px; margin-bottom: 20px;">Dodavanje Proizvoda</h1>

<?php if ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form action="" method="POST">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="naziv">Unesite naziv proizvoda</label>
                    <input type="text" class="form-control" name="naziv" placeholder="Rakija Viljamovka">
                </div>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cena">Unesite cenu</label>
                    <input type="text" class="form-control" name="cena" placeholder="1000">
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="kolicina">Unesite količinu</label>
                    <input type="number" class="form-control" name="kolicina" placeholder="100">
                </div>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="categories_id">Izaberite kategoriju proizvoda</label>
                    <select name="categories_id" class="form-control">
                        <?php
                        $stmt = $pdo->prepare("SELECT * FROM categories");
                        $stmt->execute();
                        $categories = $stmt->fetchAll();

                        foreach ($categories as $category) { ?>
                            <option value="<?= $category['id'] ?>"><?= $category['naziv'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
       
        <div class="col-md-12">
            <div class="col-md-10">
                <div class="form-group">
                    <label for="opis">Unesite opis</label>
                    <textarea class="form-control" name="opis" id="opis" rows="4" placeholder="Ovo je..."></textarea>
                </div>
            </div>
        </div>
        
    </div>

    <div class="col-md-12">
        <button class="btn btn-primary">Dodajte proizvod</button>
        <a href="../proizvodi.php" class="btn btn-danger">Odustani od dodavanja</a>
    </div>
    
</form>
