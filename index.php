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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="navbar-style.css">
    <link rel="stylesheet" href="Pagination.css">
    <style>
        #maincolor {
            background-color: #4E5975 !important;
        }
    </style>

    <title>Forum o zwierzaczkach</title>
</head>

<body>
<?php include_once('./navbar.php') ?>

<div class="container">
    <h2 class="text-center my-3">Forum - Kategorie</h2>
    <div class="row">

        <?php
        $per_page_record = 6;
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
            require_once('connect.php');

            if ($conn->connect_errno != 0) {
                throw new Exception("Błąd serwera. Przepraszamy za problemy. Spróbuj później.");
            } else {
                $sql = "SELECT * FROM `kategorie` LIMIT " . $start_from . " , " . $per_page_record;

                if ($result = $conn->query($sql)) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        //echo $row['category_id'];
                        //echo $row['category_name'];
                        $id = $row['category_id'];
                        $cat = $row['category_name'];
                        $desc = $row['category_description'];
                        echo '<div class="col-md-4 my-2">
										<div class="card" style="width: 18rem;">
										<div class="card-body">
											<h5 class="card-title"><a href="watek.php?catid=' . $id . '">' . $cat . '</a></h5>
											<p class="card-text">' . $desc . '</p>
											<a href="watek.php?catid=' . $id . '" class="btn btn-primary">Przeglądaj posty</a>
										</div>
										</div>
									</div>';
                    }
                } else {
                    throw new Exception();
                }
                $conn->close(); // po wykonaniu pracy zamknij bazę
            }
        } catch (Exception $e) {
            $_SESSION['e'] = "<h2 style='color:red; text-align:center; padding-top:20px'>Błąd serwera. Przepraszamy za problemy. Spróbuj później.</h2>";
            //$_SESSION['e'] = $e->getMessage();
        }
        ?>
    </div>
    <?php
    $conn = mysqli_connect($servername, $username, $password, $database);
    $sql = "SELECT COUNT(*) FROM `kategorie`";
    $rs_result = $conn->query($sql);
    $conn->close();
    $row = mysqli_fetch_row($rs_result);
    $total_records = $row[0];
    echo "</br>";
    $total_pages = ceil($total_records / $per_page_record);
    $pagLink = "";
    echo "<div class='pagination'>";
    if ($page >= 2) {
        echo "<a href='index.php?page=" . ($page - 1) . "'>  Prev </a>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            $pagLink .= "<a class = 'active' href='index.php?page="
                . $i . "'>" . $i . " </a>";
        } else {
            $pagLink .= "<a href='index.php?page=" . $i . "'>
                " . $i . " </a>";
        }
    };
    echo $pagLink;

    if ($page < $total_pages) {
        echo "<a href='index.php?page=" . ($page + 1) . "'>  Next </a>";
    }
    echo "</div>";
    ?>
</div>
<?php include_once('./footer.php') ?>
<!-- <footer>Copyright © 2022 <?php
//   if(isset($_SESSION['userLog'])) echo $_SESSION['userLog']
; ?></footer> -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
</script>
</body>
</html>