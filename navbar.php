<?php
  echo '<nav class="navbar navbar-expand-lg navbar-light bg-light text-light" id="maincolor">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
              <a class="nav-link" href="./index.php">Strona główna <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="./mojeposty.php">Moje Posty</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./dodajpost.php">Dodaj Post</a>
            </li>
          <li class="nav-item">
            <a class="nav-link" href="./mojedane.php">Moje Dane</a>
          </li>
          <li class="nav-item">
              <a class="nav-link " href="#" tabindex="-1">Kontakt</a>
          </li>
      </ul>
      <div class="mx-2">
          <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
          <button class="btn btn-primary ml-2">Zaloguj się</button>
          <button class="btn btn-primary mx-2">Zarejestruj się</button>
      </div>

  </div>
  </nav>';
?>