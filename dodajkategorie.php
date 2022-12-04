<?php
    session_start();

    if((!isset($_SESSION['zalogowany'])) || ($_SESSION['accountrole'] != "admin")) {
      header('Location: ./index.php');
      exit(); // koniec - nie wykonuj dalszej części kodu
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="navbar-style.css">
    <style>
      #maincolor{
        background-color:#4E5975 !important;
      }
    </style>
    <title>Panel Administratora</title>
</head>
<body>
    <?php 
        include_once('./navbar.php');
        //require_once ('./connect.php');

        if(isset($_SESSION['e'])){
            echo $_SESSION['e'];
            unset($_SESSION['e']);
        }

        if(isset($_POST['dodaj_kategorie']))
        {
            try{
                require_once('connect.php');
            
                if ($conn -> connect_errno != 0) {
                    throw new Exception("Błąd serwera. Przepraszamy za problemy. Spróbuj później.");
                }
                else{

                    $name = $_POST['catname'];
                    $desc = $_POST['catdesc'];
            
                    $query = "INSERT INTO `kategorie` (`category_name`, `category_description`) VALUES ('$name', '$desc')";
            
                    if($query_run = $conn -> query($query))
                    {
                        header("Location: index.php");
                    }
                    else
                    {
                        throw new Exception();
                    }
                    $conn -> close(); // po wykonaniu pracy zamknij bazę
                }
            }
            catch(Exception $e){
                $_SESSION['e'] = "<h2 style='color:red; text-align:center; padding-top:20px'>Błąd serwera. Przepraszamy za problemy. Spróbuj później.</h2>";
            }
        }
    ?>

  <div class="w-50" style="margin-top: 2.5%; margin-left:auto; margin-right:auto;">
      <h1>Dodawanie Kategorii</h1>
    <form action="./dodajkategorie.php" method="post">
      <div class="form-group">
          <label for="exampleInputEmail1">Nazwa kategorii</label>
          <input type="text" class="form-control" id="catname" name="catname" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
          <label for="exampleFormControlTextarea1">Opis kategorii</label>
          <textarea class="form-control" id="catdesc" name="catdesc" rows="3"></textarea>
      </div>
      <button type="submit" name="dodaj_kategorie" class="btn btn-primary">Dodaj kategorie</button>
    </form>
  </div>
  <?php include_once ('./footer.php')?>
</body>
</html>