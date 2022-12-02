

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
    <title>Panel Użytkownika</title>
</head>
<body>
  <?php include('./navbar.php')?>

  <?php
    if((!isset($_SESSION['zalogowany']) && $_)) {
      header('Location: ./index.php');
      exit(); // koniec - nie wykonuj dalszej części kodu
    } ?>

<?php
    require './connect.php';
    $postid = $_SESSION["editpostid"];

    $query = "SELECT * FROM threads WHERE threads_id=$postid";
    $query_run = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($query_run) > 0) {
      foreach($query_run as $post) {
        $title = $post['thread_title'];
        $desc = $post['thread_description'];
        $editcatid = $post['thread_cat_id'];

        if($post['thread_user_id'] != $_SESSION['userid']) {
          header('Location: ./index.php');
          exit(); // koniec - nie wykonuj dalszej części kodu
        }
      }
    }

    
  if(isset($_POST['edytuj_post']))
  {
    $post_id = mysqli_real_escape_string($conn, $_POST['edytuj_post']);

    $updatetitle = mysqli_real_escape_string($conn, $_POST['updatetitle']);
    $updatedesc = mysqli_real_escape_string($conn, $_POST['updatedesc']);
    $updatecat = mysqli_real_escape_string($conn, $_POST['updatecat']);

    $query = "UPDATE threads SET thread_title='$updatetitle', thread_description='$updatedesc', thread_cat_id='$updatecat' WHERE threads_id='$post_id' ";
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
  }
?>



  <div class="w-50" style="margin-top: 2.5%; margin-left:auto; margin-right:auto;">
      <h1>Edytowanie Postu</h1>
    <form action="./edytujpost.php" method="post">
      <div class="form-group">
          <label for="exampleInputEmail1">Tytuł</label>
          <input type="text" class="form-control" id="updatetitle" name="updatetitle" aria-describedby="emailHelp" value='<?=$title;?>'>
      </div>
      <div class="form-group">
          <label for="exampleFormControlTextarea1">Treść postu...</label>
          <textarea class="form-control" id="updatedesc" name="updatedesc" rows="3"><?=$desc;?></textarea>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Kategoria: </label>
        <select class="form-select" aria-label="Default select example" id="updatecat" name="updatecat">
        <?php 
              $sql = "SELECT * FROM `kategorie`";

              $result = mysqli_query($conn, $sql) or trigger_error(mysqli_error($conn));
              while($row = mysqli_fetch_assoc($result)){
                if($row['category_id'] == $editcatid) {
                  echo '<option value="'.$row['category_id'].'" id="updatecat" name="updatecat" selected>'.$row['category_name'].'</option>';
                } else {
                  echo '<option value="'.$row['category_id'].'" id="updatecat" name="updatecat">'.$row['category_name'].'</option>';
                }
              }
            ?>
        </select>
      </div>
      <button type="submit" name="edytuj_post" value='<?=$postid;?>' class="btn btn-primary">Edytuj post</button>
    </form>
  </div>

  
    
</body>
</html>