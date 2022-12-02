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
      }
    </style>

    <title>Panel użytkownika</title>
</head>
<body>
  <?php include('./navbar.php')?>
  <?php  if((!isset($_SESSION['zalogowany']))) {
    header('Location: ./index.php');
    exit(); // koniec - nie wykonuj dalszej części kodu
  }?>

<?php
  require './connect.php';

  if(isset($_POST['editview_post'])){
    $_SESSION["editpostid"] = $_POST['editview_post'];
    header("Location: ./edytujpost.php");
    exit(0);
  }

  if(isset($_POST['delete_post'])) {
    $post_id = mysqli_real_escape_string($conn, $_POST['delete_post']);

    $query = "DELETE FROM threads WHERE threads_id='$post_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header("Location: ./mojeposty.php");
        exit(0);
    }
    else
    {
        header("Location: ./mojeposty.php");
        exit(0);
    }
  }
?>
  <div class="w-50" style="margin-top: 2.5%; margin-left:auto; margin-right:auto;">

      <?php
        $userid = $_SESSION['userid'];
      
        $query = "SELECT * FROM threads WHERE thread_user_id='$userid'";
        $query_run = mysqli_query($conn, $query);
        if(mysqli_num_rows($query_run) > 0) {
          ?>
                <table class="table">
        <thead>
          <tr>
            <th>Tytuł</th>
            <th>Kategoria</th>
            <th>Akcje</th>
          </tr>
        </thead>
      <tbody>
        <?php
          foreach($query_run as $post)
          {
            $catid = $post['thread_cat_id'];

            $cats = mysqli_query($conn, "SELECT * FROM kategorie WHERE category_id='$catid'");

            foreach($cats as $cat) {
              $catname = $cat['category_name'];
            }
            ?>

            <tr>
              <td><a href="watek2.php?threadsid=<?=$post['threads_id']?>"><?= $post['thread_title'];?></a></td>
              <td><?= $catname;?></td>
              <td>
              <form action="./mojeposty.php" method="POST">
                <button class="btn btn-secondary" type="submit" name="editview_post" value="<?=$post['threads_id'];?>">Edytuj</button>
                <button class="btn btn-danger" type="submit" name="delete_post" value="<?=$post['threads_id'];?>">Usuń</button>
              </form>
              </td>
            </tr>
            <?php
          }
        }
        else {
          echo "<h2>Nie znaleziono żadnych postów</h2>";
        }
      ?>
      </tbody>
    </table>
  </div>
</body>
</html>