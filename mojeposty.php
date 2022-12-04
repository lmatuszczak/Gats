<?php
session_start();

if ((!isset($_SESSION['zalogowany'])) || ($_SESSION['accountrole'] != "user")) {
    header('Location: ./index.php');
    exit(); // koniec - nie wykonuj dalszej części kodu
}

$per_page_record = 10;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $per_page_record;

?>

<!DOCTYPE html>
<html lang="pl">

<head>
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

    <title>Panel użytkownika</title>
</head>

<body>
<?php
include_once('./navbar.php');

if (isset($_SESSION['e'])) {
    echo $_SESSION['e'];
    unset($_SESSION['e']);
}

// Przejdz do edycji postu po kliknieciu EDYTUJ
if (isset($_POST['editview_post'])) {
    $_SESSION["editpostid"] = $_POST['editview_post'];
    header("Location: ./edytujpost.php");
    exit(); // chce edytowac post to koncze tutaj skrpyt i przechodze do edytujpost.php
}

try {
    require_once('connect.php');
} catch (Exception $e) {
    $_SESSION['e'] = "<h2 style='color:red; text-align:center; padding-top:20px'>Błąd serwera. Przepraszamy za problemy. Spróbuj później.</h2>";
    exit();
}


if (isset($_POST['delete_post'])) {
    try {

        $post_id = mysqli_real_escape_string($conn, $_POST['delete_post']);

        $query = "DELETE FROM threads WHERE threads_id='$post_id' ";
        $query_run = $conn->query($query);

        if ($query_run) {
            header("Location: ./mojeposty.php");
        } else {
            throw new Exception();
        }
    } catch (Exception $e) {
        $_SESSION['e'] = "<h2 style='color:red; text-align:center; padding-top:20px'>Błąd serwera. Przepraszamy za problemy. Spróbuj później.</h2>";
    }
}
?>
<div class="w-50" style="margin-top: 2.5%; margin-left:auto; margin-right:auto;">

    <?php
    // zalogowany uzytkownik
    $userid = $_SESSION['userid'];

    // Wyświetl posty zalogowanego użytkownika
    $query2 = "SELECT * FROM threads WHERE thread_user_id='$userid' LIMIT " . $start_from . " , " . $per_page_record;
    $query_run2 = $conn->query($query2);
    if ($query_run2->num_rows > 0) {
    ?> <!-- NA POCZATKU STWORZ TABELE -->
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
        // przypisz do zmiennych wartosci z tablicy $post
        foreach ($query_run2 as $post) {
            $catid = $post['thread_cat_id'];
            $sql = "SELECT * FROM kategorie WHERE category_id='$catid'";

            $cats = $conn->query($sql);

            foreach ($cats as $cat) {
                $catname = $cat['category_name'];
            }
            ?>
            <!-- DLA KAŻDEGO KOLEJNEGO WYNIKU TWORZ KOLEJNY WIERSZ -->
            <tr>
                <td>
                    <a href="watek2.php?threadsid=<?= $post['threads_id'] ?>"> <?= $post['thread_title']; ?> </a>
                </td>
                <td>
                    <?= $catname; ?>
                </td>
                <td>
                    <form action="./mojeposty.php" method="POST">
                        <button class="btn btn-secondary" type="submit" name="editview_post"
                                value="<?= $post['threads_id']; ?>">Edytuj
                        </button>
                        <button class="btn btn-danger" type="submit" name="delete_post"
                                value="<?= $post['threads_id']; ?>">Usuń
                        </button>
                    </form>
                </td>
            </tr>
            <?php
        }
        }
        else {
            echo "<h2>Nie znaleziono żadnych postów</h2>";
        }
        $conn->close();
        ?>
        </tbody>
    </table>
</div>
<?php
$conn = mysqli_connect($servername, $username, $password, $database);
$sql = "SELECT COUNT(*) FROM `threads`";
$rs_result = $conn->query($sql);
$conn->close();
$row = mysqli_fetch_row($rs_result);
$total_records = $row[0];
echo "</br>";
$total_pages = ceil($total_records / $per_page_record);
$pagLink = "";
echo "<div class='pagination'>";
if ($page >= 2) {
    echo "<a href='mojeposty.php?page=" . ($page - 1) . "'>  Prev </a>";
}

for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        $pagLink .= "<a class = 'active' href='mojeposty.php?page="
            . $i . "'>" . $i . " </a>";
    } else {
        $pagLink .= "<a href='mojeposty.php?page=" . $i . "'>
                " . $i . " </a>";
    }
};
echo $pagLink;

if ($page < $total_pages) {
    echo "<a href='mojeposty.php?page=" . ($page + 1) . "'>  Next </a>";
}
echo "</div>";
?>
</div>
</div>
<?php include_once('./footer.php') ?>
</body>

</html>