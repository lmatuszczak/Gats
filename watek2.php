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

    <!-- <?php include 'connect.php';?> -->
    <?php 
        $id = $_GET['threadsid'];
        $sql = "SELECT * FROM `threads` WHERE threads_id=$id";

        $result = mysqli_query($conn, $sql) or trigger_error(mysqli_error($conn));
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_description'];
            //$post_time = $row['timestamp'];
        }
    ?>

    <?php 
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        //dopisywaanie komentarza do bazy danych
        $comment = $_POST['comment'];
        $sql = "INSERT INTO `comments` (`comment_content`, `threads_id`, `comment_by`, `comment_time`) 
        VALUES ('$comment', '$id', '0', current_timestamp());
        ";
        $result = mysqli_query($conn, $sql) or trigger_error(mysqli_error($conn));
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Brawo!</strong> Twój komentarz został dodany.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
    }
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"> <?php echo $title;?></h1>
            <p class="lead"><?php echo $desc;?></p>
            <hr class="my-4">
        </div>
    </div>


    <div class="container">
        <h1 class="py-2">Skomentuj</h1>


        <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Treść komentarza...</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Dodaj komentarz </button>
        </form>

        <div class="container">
            <h1 class="py-2">Sekcja kometarzy</h1>

            <!-- SEKCJA KOMENTARZY DO ZROBIENIA -->
            <?php 
        $id = $_GET['threadsid'];
        $sql = "SELECT * FROM `comments` WHERE threads_id=$id";
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "forum";

       
        
        $conn = mysqli_connect($servername, $username, $password, $database);
        $result = mysqli_query($conn, $sql) or trigger_error(mysqli_error($conn));
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];

    echo '<div class="media my-3">
        <div class="media-body">
           <p class="font-weight-bold my-0"> o' . $comment_time . ' </p>
            '. $content .'
        </div>
       </div>
       <hr class="my-4">';

        }

        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">Brak dyskusji</h1>
              <p class="lead">Dodaj pierwszy komentarz.</p>
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