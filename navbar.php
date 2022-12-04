  <nav class="navbar navbar-expand-lg navbar-light bg-light text-light" id="maincolor">

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            	<a class="nav-link" href="./index.php"> 
                	<img src="./img/paw.svg" alt="logo image">
            	<span class="sr-only">(current)</span></a>
          </li>
          <!-- DLA UZYTKOWNIKA WYGENERUJ ODOPWIEDNIE ZAKŁADKI -->
          <?php if(isset($_SESSION['zalogowany'])) {
            if($_SESSION['accountrole']=="user") {
                echo '<li class="nav-item">
                <a class="nav-link" href="./mojeposty.php">Moje Posty</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./dodajpost.php">Dodaj Post</a>
          </li>';
          // <!-- DLA ADMINISTRATORA WYGENERUJ ODOPWIEDNIE ZAKŁADKI -->
            } else if ($_SESSION['accountrole']=="admin") {
                echo'<li class="nav-item">
                <a class="nav-link" href="./wszystkiekategorie.php">Kategorie</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="./dodajkategorie.php">Dodaj Kategorie</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="./posty.php">Posty</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./dodajpost.php">Dodaj Post</a>
          </li>';
            }
          }?>
          
      </ul>
      <?php if(isset($_SESSION['zalogowany'])) {
        echo '<a href="./logout.php"<div class="mx-2"><button class="btn btn-primary btn-nav ml-2">Wyloguj się</button>
        </div></a>';
        }
      else {
        echo '<div class="mx-2">
        <a href="./login.php"><button class="btn btn-primary btn-nav ml-2">Zaloguj się</button></a>
        <a href="./register.php"><button class="btn btn-primary btn-nav mx-2">Zarejestruj się</button></a>
        </div>';
      } ?>
  </div>
  </nav>