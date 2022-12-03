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

    <title>Forum do czegoś</title>

    <style>
    #maincolor {
        background-color: #4E5975 !important;
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
</head>

<body>
    <?php include('./navbar.php')?>


    <?php 
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `kategorie` WHERE category_id=$id";

        $result = mysqli_query($conn, $sql) or trigger_error(mysqli_error($conn));
        while($row = mysqli_fetch_assoc($result)){
            $catname = $row['category_name'];
            $catdesc = $row['category_description'];
        }
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">To jest forum o tematyce <?php echo $catname;?></h1>
            <p class="lead"><?php echo $catdesc;?></p>
            <hr class="my-4">
        </div>
    </div>

    <div class="container">
        <h1 class="py-2">Przeglądaj posty</h1>

        <?php 
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "forum";

        $conn = mysqli_connect($servername, $username, $password, $database);
        $result = mysqli_query($conn, $sql) or trigger_error(mysqli_error($conn));
        $noResult = true;
        foreach($result as $row){
            $noResult = false;
            $id = $row['threads_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_description'];

            $post_time = $row['timestamp'];
            
     
            echo '<div class="media my-3">
                <div class="media-body">
                    <h5 class="mt-0"> <a class="text-dark" href="watek2.php?threadsid='  . $id.  '">'. $title. ' ' .  $post_time .'</a>'. '</h5>
                    '. substr($desc, 0, 50) .'...
                </div>
            </div>
            <hr class="my-4">';

        }
        // echo var_dump($noResult);
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">Brak dyskusji</h1>
              <p class="lead">Dodaj pierwszy post.</p>
            </div>
          </div>';
        }
    ?>



    </div>
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

    <?php include ('./footer.php')?>
</body>

</html>