</div> <!-- Kraj w3-main -->

<footer id="myFooter" class="w3-container w3-theme-l2 w3-padding-32">
    <h4 class="text-center">Andrej Dostanic 38/23 IT</h4>
</footer>

</body>
</html>


<script>
// Sidebar funkcionalnost
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

<style>

html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

.w3-main {
    flex: 1;
}

footer {
    width: 100%;
    position: relative;
    bottom: 0;
}

</style>

</body>
</html>
