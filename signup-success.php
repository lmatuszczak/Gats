<?php

session_start();

// Zakaz przechodzenia na podstonę
if (!isset($_SESSION['udanarejestracja'])) {
    header('Location: register.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja sukces</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav>
        <div id="wrapperNav">
            <div id="navContainer">
                <div id="nav-col-1">
                    <a href="index.php">
                        LOGO
                    </a>
                </div>
                <div id="navLink">
                    <div><a href="#">Rasy</a></div>
                    <div><a href="#">Kategorie</a></div>
                    <div><a href="#">Zadaj Pytanie</a></div>
                </div>
            </div>
            <div id="nav-col-5">
                <a href="login.php">
                    <img src="img/paw.svg" alt="imageLogin">
                </a>
            </div>
        </div>
    </nav>

    <main id="mainA">
        <div class="content">
            <div class="success">
                <img src="img/correct.png" alt="Znak check" width="80" height="80">
                <br>
                <br>SUKCES
            </div>
            <div class="success1">
                Rejestracja przebiegła pomyślnie,<br>
                Twoje konto zostało utworzone!
                <a href="login.php" class="link-log">
                    <input type="submit" value="Zaloguj się" id="submit">
                </a>
            </div>
        </div>
    </main>

    <?php include_once('./footer.php') ?>

</body>

</html>