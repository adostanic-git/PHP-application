<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Zatvori meni">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item" style="margin-top: 30px;"><b>Kategorije</b></h4>
  <?php include "kategorije.php" ?>
</nav>

<!-- Overlay effect for sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="Zatvori meni" id="myOverlay"></div>

<!-- Main content: shift to the right by 250px when sidebar is visible -->
<div class="w3-main" style="margin-left:250px; padding: 20px;">