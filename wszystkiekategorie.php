<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
      #maincolor{
        background-color:#4E5975 !important;
        min-height: 9vh !important;

      }
      #footer {
        background-color: #4E5975;
        padding: 30px 10px 0px 10px;
        min-height:11vh;
        bottom: 0;
        width: 100%;
    }
    </style>

    <title>Panel użytkownika</title>
</head>
<body>
  <?php include('./navbar.php')?>
  <?php
  require './connect.php';

  if((!isset($_SESSION['zalogowany'])) && $_SESSION['accountrole'] != "admin") {
    header('Location: ./index.php');
    exit(); // koniec - nie wykonuj dalszej części kodu
  }

  if(isset($_POST['editview_post'])){
    $_SESSION["editpostid"] = $_POST['editview_post'];
    header("Location: ./edytujpost.php");
    exit(0);
  }

  if(isset($_POST['delete_category'])) {
    $category_id = mysqli_real_escape_string($conn, $_POST['delete_category']);

    $query = "DELETE FROM kategorie WHERE category_id='$category_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header("Location: ./wszystkiekategorie.php");
        exit(0);
    }
    else
    {
        header("Location: ./wszystkiekategorie.php");
        exit(0);
    }
  }
?>
  <div class="w-50" style="margin-top: 2.5%; margin-left:auto; margin-right:auto;">

      <?php
        $query = "SELECT * FROM kategorie";
        $query_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($query_run) > 0) {
          ?>
            <table class="table">
            <thead>
              <tr>
                <th>Nazwa</th>
                <th>Akcje</th>
              </tr>
            </thead>
            <tbody>
          <?php
          foreach($query_run as $category)
          {
            ?>
            <tr>
              <td><?= $category['category_name'];?></td>
              <td>
              <form action="./wszystkiekategorie.php" method="POST">
                <button class="btn btn-danger" type="submit" name="delete_category" value="<?=$category['category_id'];?>">Usuń</button>
              </form>
              </td>
            </tr>
            <?php
          }
        }
        else {
          echo "<h2>Nie znaleziono żadnych kategorii</h2>";
        }
      ?>
      </tbody>
    </table>
  </div>

  <?php include ('./footer.php')?>

</body>
</html>