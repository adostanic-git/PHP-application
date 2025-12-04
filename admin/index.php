<?php 
include "admin_moduls/head.php"; 
include "admin_moduls/mainnav.php"; 
require_once "auth.php"; 
require_once "../db.php"; 

$stmt = $pdo->query("SELECT naziv, kolicina FROM products");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Proizvod', 'Količina (kg)'],
          <?php 
            foreach ($products as $product) {
                echo "['{$product['naziv']}', {$product['kolicina']}],";
            }
          ?>
        ]);

        var options = {
          title: 'Proizvodnja krušaka i prerađenih proizvoda',
          is3D: true,
          backgroundColor: '#f8f9fa'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
</head>
<body>
    <h2 style="text-align: center; margin-top:50px;">Statistika proizvodnje</h2>
    <div id="piechart" style="width: 700px; height: 400px; margin: auto;"></div>
</body>
</html>

<?php include "admin_moduls/foot.php"; ?>
