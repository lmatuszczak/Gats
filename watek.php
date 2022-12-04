<?php
session_start();
?>

<!doctype html>
<html lang="pl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="navbar-style.css">
    <link rel="stylesheet" href="Pagination.css">
    <title>Forum - sekcja postów</title>

    <style>
        #maincolor {
            background-color: #4E5975 !important;
        }
    </style>
</head>

<body>
    <?php
    include_once('./navbar.php');

    $per_page_record = 3;
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
    $start_from = ($page - 1) * $per_page_record;

    if (isset($_SESSION['e'])) {
        echo $_SESSION['e'];
        unset($_SESSION['e']);
    }

    try {
        require_once('./connect.php');

        $id = $_GET['catid'];
        $categoryId = $id;
        $sql = "SELECT * FROM `kategorie` WHERE category_id=$id";

        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $catname = $row['category_name'];
            $catdesc = $row['category_description'];
        }
    } catch (Exception $e) {
        $_SESSION['e'] = "<h2 style='color:red; text-align:center; padding-top:20px'>Błąd serwera. Przepraszamy za problemy. Spróbuj później.</h2>";
    }

    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">To jest forum o tematyce <?php echo $catname; ?></h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
        </div>
    </div>

    <div class="container">
        <h1 class="py-2">Przeglądaj posty</h1>

        <?php
        try {
            //$id = $_GET['catid'];
            $sql2 = "SELECT * FROM `threads` WHERE thread_cat_id=$id LIMIT " . $start_from . " , " . $per_page_record;

            $result2 = $conn->query($sql2);

            $noResult = true;
            foreach ($result2 as $row) {
                $noResult = false;
                $id = $row['threads_id'];
                $title = $row['thread_title'];
                $desc = $row['thread_description'];

                $post_time = $row['timestamp'];


                echo '<div class="media my-3">
                        <div class="media-body">
                            <h5 class="mt-0"> <a class="text-dark" href="watek2.php?threadsid='  . $id .  '">' . $title . ' | ' .  $post_time . '</a>' . '</h5>
                            ' . substr($desc, 0, 50) . '...
                        </div>
                    </div>
                    <hr class="my-4">';
            }
            // echo var_dump($noResult);
            if ($noResult) {
                echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                      <h1 class="display-4">Brak dyskusji</h1>
                      <p class="lead">Dodaj pierwszy post.</p>
                    </div>
                  </div>';
            }
        } catch (Exception $e) {
            $_SESSION['e'] = "<h2 style='color:red; text-align:center; padding-top:20px'>Błąd serwera. Przepraszamy za problemy. Spróbuj później.</h2>";
            //$_SESSION['e'] = $e->getMessage();
        }

        $sql = "SELECT COUNT(*) FROM `threads`";
        $rs_result = $conn->query($sql);
        $row = $rs_result -> fetch_row();
        $total_records = $row[0];
        echo "</br>";
        $total_pages = ceil($total_records / $per_page_record);
        $pagLink = "";
        echo "<div class='pagination'>";
        if ($page >= 2) {
            echo "<a href='watek.php?page=" . ($page - 1) . "&catid=" . $categoryId ."'>  Prev </a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                $pagLink .= "<a class = 'active' href='watek.php?page=" . $i . "&catid=" . $categoryId ."'>" . $i . " </a>";
            } else {
                $pagLink .= "<a href='watek.php?page=" . $i . "&catid=" . $categoryId ."'>
                " . $i . " </a>";
            }
        };
        echo $pagLink;

        if ($page < $total_pages) {
            echo "<a href='watek.php?page=" . ($page + 1) . "&catid=" . $categoryId ."'>  Next </a>";
        }
        echo "</div>";
        $conn->close(); // po wykonaniu pracy zamknij bazę
        ?>



    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
    <?php include_once('./footer.php') ?>
</body>

</html>