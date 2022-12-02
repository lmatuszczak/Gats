<?php
    require './connect.php';
?>

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
      #maincolor{
        background-color:#4E5975 !important;
      }
    </style>


  
    <title>Forum do czegoś</title>
</head>

<body>
    <?php include('./navbar.php')?>

    <div class="container">
        <h2 class="text-center my-3">Forum - Kategorie</h2>
        <div class="row">

        <?php 
          $sql = "SELECT * FROM `kategorie`";

          $result = mysqli_query($conn, $sql) or trigger_error(mysqli_error($conn));
          while($row = mysqli_fetch_assoc($result)){
            //echo $row['category_id'];
            //echo $row['category_name'];
            $id = $row['category_id'];
            $cat = $row['category_name'];
            $desc = $row['category_description'];
            echo '<div class="col-md-4 my-2">
            <div class="card" style="width: 18rem;">
                  <div class="card-body">
                      <h5 class="card-title"><a href="watek.php?catid='  . $id .  '">'  . $cat .  '</a></h5>
                      <p class="card-text">'  . $desc .  '</p>
                      <a href="watek.php?catid='  . $id .  '" class="btn btn-primary">Przeglądaj posty</a>
                  </div>
              </div>
            </div>';

          }
         ?>
  <footer>Copyright © 2022 <?php if(isset($_SESSION['userLog'])) echo $_SESSION['userLog']; ?></footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>
</html>