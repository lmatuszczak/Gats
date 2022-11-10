<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
      #kolor{
        background-color:#4E5975 !important;
      }
    </style>


  
    <title>Forum do czegoś</title>
</head>

<body>
    <?php include 'connect.php'?>

    <!-- navbar -->
    <nav class=" navbar navbar-expand-lg navbar-light bg-light " id="kolor">
        <a class="navbar-brand" href="/projekt">Forummm</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/projekt">Strona główna <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cośtam1</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Cośtam2
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
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
    </nav>



    <div class="container">
        <h2 class="text-center my-3">Forum - Kategorie</h2>
        <div class="row">

        <?php 
        
          $sql = "SELECT * FROM `kategorie`";
          $servername = "localhost";
          $username = "root";
          $password = "";
          $database = "php_forum";

          $conn = mysqli_connect($servername, $username, $password, $database);
          $result = mysqli_query($conn, $sql) or trigger_error(mysqli_error($conn));
          while($row = mysqli_fetch_assoc($result)){
            //echo $row['category_id'];
            //echo $row['category_name'];
            $id = $row['category_id'];
            $cat = $row['category_name'];
            $desc = $row['category_description'];
            echo '<div class="col-md-4 my-2">
            <div class="card" style="width: 18rem;">
                  <img src="images/card-' .$id. '.jpg"  class="card-img-top" alt="...">
                  <div class="card-body">
                      <h5 class="card-title"><a href="watek.php?catid='  . $id .  '">'  . $cat .  '</a></h5>
                      <p class="card-text">'  . $desc .  '</p>
                      <a href="watek.php?catid='  . $id .  '" class="btn btn-primary">Przeglądaj posty</a>
                  </div>
              </div>
            </div>';

          }
         ?>

            


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>

<?php


#include('connect.php');


?>