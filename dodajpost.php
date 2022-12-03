<?php
  require './connect.php';
?>

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
    <title>Panel Użytkownika</title>
</head>
<body>
  <?php include('./navbar.php')?>

  <?php  if((!isset($_SESSION['zalogowany']))) {
    header('Location: ./index.php');
    exit(); // koniec - nie wykonuj dalszej części kodu
  }?>

<?php   if(isset($_POST['dodaj_post']))
  {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $catid = $_POST['catid'];

    $userid = $_SESSION['userid'];

    $query = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$title', '$desc', '$catid', '$userid', current_timestamp())";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header("Location: mojeposty.php");
        exit(0);
    }
    else
    {
        header("Location: mojeposty.php");
        exit(0);
    }
  }?>

  <div class="w-50" style="margin-top: 2.5%; margin-left:auto; margin-right:auto;">
      <h1>Dodawanie Postu</h1>
    <form action="./dodajpost.php" method="post">
      <div class="form-group">
          <label for="exampleInputEmail1">Tytuł</label>
          <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
          <label for="exampleFormControlTextarea1">Treść postu...</label>
          <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
      </div>
      <div class="form-group">
        <select class="form-select" aria-label="Default select example" id="catid" name="catid">
        <?php 
              $sql = "SELECT * FROM `kategorie`";

              $result = mysqli_query($conn, $sql) or trigger_error(mysqli_error($conn));
              while($row = mysqli_fetch_assoc($result)){
                echo '<option value="'.$row['category_id'].'" id="catid" name="catid">'.$row['category_name'].'</option>';
              }
            ?>
        </select>
      </div>
      <button type="submit" name="dodaj_post" class="btn btn-primary">Dodaj post </button>
    </form>
  </div>
  <?php include ('./footer.php')?>

</body>
</html>