<?php 
include "admin_moduls/head.php";
require_once "../db.php";

$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Username i password su obavezni!";
    } else {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["username" => $username]);
        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                session_start(); 
                $_SESSION['user'] = $user;
                if ($user['role_id'] == 1) {
                    header("Location: index.php");
                } else {
                    header("Location: ../index.php");
                }
                exit();
            } else {
                $error = "Pogrešna šifra!";
            }
        } else {
            $error = "Nepostojeći username!";
        }
    }
}
?>

<div class="row">
    <div class="col-md-6">
        <h1 style="margin-top: 50px;">Login</h1>
    </div>
</div>

<?php if (!empty($error)) : ?>
    <span class="text-danger"><?= $error ?></span>
<?php endif; ?>

<div class="row">
    <div class="col-md-6">
        <form action="" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="adostanic3823IT" autocomplete="username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="current-password">
        </div>
            <button class="btn btn-primary">Login</button>
        </form>
    </div>
</div>

<?php include "admin_moduls/foot.php" ?>
