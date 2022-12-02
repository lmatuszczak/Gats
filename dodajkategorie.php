<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
      #maincolor{
        background-color:#4E5975 !important;
      }
    </style>
    <title>Panel Administratora</title>
</head>
<body>
  <?php include('./navbar.php')?>

  <?php
  require './connect.php';

    if((!isset($_SESSION['zalogowany'])) && $_SESSION['accountrole'] != "admin") {
    header('Location: ./index.php');
    exit(); // koniec - nie wykonuj dalszej części kodu
  }
  if(isset($_POST['dodaj_kategorie']))
  {
    $name = $_POST['catname'];
    $desc = $_POST['catdesc'];

    $query = "INSERT INTO `kategorie` (`category_name`, `category_description`) VALUES ('$name', '$desc')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header("Location: index.php");
        exit(0);
    }
    else
    {
        header("Location: index.php");
        exit(0);
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
</body>
</html>