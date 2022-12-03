<?php
if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true))
    {
        header('Location: index.php');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja - Forum</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script type="text/javascript">
      var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '6LfwLh8jAAAAAEJ9_Uomt8EGPnEiFjUBsXV2yE3e'
        });
      };
    </script>
    <style>
        .error{
            color: red;
            margin:-20px 0 10px 0;
            font-size: 11px;
        }
    </style>

<style>
      #maincolor{
        background-color:#4E5975 !important;
        min-height: 9vh !important;

      }
    </style>
</head>
<body>


<?php if(isset($_SESSION['e'])){
    echo $_SESSION['e'];
    unset($_SESSION['e']);
    }
?>
  <?php include('./navbar.php')?>


<main id="mainA">
    <div class="content">
        <h1>Załóż konto</h1>
        <form action="process-register.php" method="post">
            <div class="txt_field">
                <input type="text" id="nick" name="name" value="<?php 
                    if(isset($_SESSION['auto_name'])){
                        echo $_SESSION['auto_name'];
                        unset($_SESSION['auto_name']);
                    }
                ?>">
                <span></span>
                <label for="nick">Nazwa użytkownika</label>
                <span class="error"></span>
            </div>

            <?php
                // if(isset($_SESSION['e_username'])) echo $_SESSION['e_username']; // jeżeli zmienna isnieje to ją pokaż
                if(isset($_SESSION['e_username'])){
                    echo '<p class="error">'.$_SESSION['e_username'].'</p>';
                    unset($_SESSION['e_username']);
                }
            ?>

            <div class="txt_field">
                <input type="email" id="mail" name="email" value="<?php
                if(isset($_SESSION['auto_email'])){
                    echo $_SESSION['auto_email'];
                    unset($_SESSION['auto_email']);
                }
                ?>">
                <span></span>
                <label for="mail">E-mail</label>
            </div>

            <?php
                // if(isset($_SESSION['e_username'])) echo $_SESSION['e_username']; // jeżeli zmienna isnieje to ją pokaż
                if(isset($_SESSION['e_email'])){
                    echo '<p class="error">'.$_SESSION['e_email'].'</p>';
                    unset($_SESSION['e_email']);
                }
            ?>

            <div class="txt_field">
                <input type="password" id="pass1" name="pass1">
                <span></span>
                <label for="pass1">Hasło</label>
            </div>

            <?php
                // if(isset($_SESSION['e_username'])) echo $_SESSION['e_username']; // jeżeli zmienna isnieje to ją pokaż
                if(isset($_SESSION['e_haslo1'])){
                    echo '<p class="error">'.$_SESSION['e_haslo1'].'</p>';
                    unset($_SESSION['e_haslo1']);
                }
            ?>

            <div class="txt_field">
                <input type="password" id="pass2" name="pass2">
                <span></span>
                <label for="pass2">Potwierdź hasło</label>
            </div>

            <?php
                // if(isset($_SESSION['e_username'])) echo $_SESSION['e_username']; // jeżeli zmienna isnieje to ją pokaż
                if(isset($_SESSION['e_haslo2'])){
                    echo '<p class="error">'.$_SESSION['e_haslo2'].'</p>';
                    unset($_SESSION['e_haslo2']);
                }
            ?>

            <div class="reg">
                <label>
                    <input type="checkbox" name="reg" id=""> Wyrażam zgodę na przetwarzanie danych,
                    <a href="#" class="link-log"> akceptuję Regulamin</a> oraz <a href="#" class="link-log">Politykę Prywatności.</a>
                </label>
            </div>

            <?php
                // if(isset($_SESSION['e_username'])) echo $_SESSION['e_username']; // jeżeli zmienna isnieje to ją pokaż
                if(isset($_SESSION['e_reg'])){
                    echo '<p style="margin-top:5px; color:red; font-size:12px;">'.$_SESSION['e_reg'].'</p>';
                    unset($_SESSION['e_reg']);
                }
            ?>
            
            <!-- CAPTCHA -->
            <div id="html_element" style="margin-top: 10px;"></div>

            <?php
                // if(isset($_SESSION['e_username'])) echo $_SESSION['e_username']; // jeżeli zmienna isnieje to ją pokaż
                if(isset($_SESSION['e_bot'])){
                    echo '<p style="margin-top:5px; color:red; font-size:12px;"">'.$_SESSION['e_bot'].'</p>';
                    unset($_SESSION['e_bot']);
                }
            ?>
            
            <input type="submit" value="Załóż konto" id="submit">
            
            
        </form>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>  
    </div>
    <div class="lastbox">
        Masz już konto? <a href="login.php" class="link-log">Zaloguj się</a>
    </div>
</main>

<footer>Copyright © 2022</footer>
    
</body>
</html>