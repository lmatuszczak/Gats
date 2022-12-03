<?php
    if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true))
    {
        header('Location: ./index.php');
        exit();
    }
?>



<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie - Forum</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <style>
      #maincolor{
        background-color:#4E5975 !important;
      }

    </style>
</head>
<body>

<?php include('./navbar.php')?>

<?php if(isset($_SESSION['e'])){
    echo $_SESSION['e'];
    unset($_SESSION['e']);
    }
?>

    <main id="mainA">
        <div class="content">
            
            <h1>Zaloguj się</h1>
                <form action="zaloguj.php" method="POST">
                    <div class="txt_field">
                        <input type="text" id="nick" name="name" value="<?php //autouzupełnianie danych po błedzie
                            if(isset($_SESSION['auto_name_L'])){
                                echo $_SESSION['auto_name_L'];
                                unset($_SESSION['auto_name_L']);
                            }
                        ?>">
                        <span></span>
                        <label for="nick">Nazwa użytkownika</label>
                    </div>
                    <div class="txt_field">
                        <input type="password" id="pass1" name="password">
                        <span></span>
                        <label for="pass1">Hasło</label>
                    </div>

                    <?php
                            if(isset($_SESSION['errorLog'])){
                                echo $_SESSION['errorLog']; // jeżeli zmienna isnieje to ją pokaż
                                unset($_SESSION['errorLog']); // po odswiezeniu/zmianie usun
                            } 
                    ?>
                    <!-- LOGOWANIE FB, TW, Instagram -->
                    
                    <div style="text-align: left; font-size:14px;"">
                        <a href="forgot-password.php" class="link-log" style="margin-top: 10px;">Nie pamiętasz hasła?</a>
                    </div>

                    <input type="submit" value="Zaloguj się" id="submit">
                </form>
        </div>
            <p class="lastbox">Nie masz konta? <a href="register.php" class="link-log">Zarejestruj się</a></p>
    </main>


<footer>Copyright © 2022</footer>

</body>
</html>