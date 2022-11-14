<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie - Forum</title>
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
            <!-- <div class="form"><a href="login.php">Log in</a></div> -->
            <!-- <div class="form"><a href="register.php">Sign Up</a></div> -->

    
    <main id="mainA">
        <div class="content">
            
            <h1>Zaloguj się</h1>
                <form action="">
                    <div class="txt_field">
                        <input type="text" id="nick" required>
                        <span></span>
                        <label for="nick">Nazwa użytkownika</label>
                    </div>
                    <div class="txt_field">
                        <input type="password" id="pass1" required>
                        <span></span>
                        <label for="pass1">Hasło</label>
                    </div>

                    <!-- LOGOWANIE FB, TW, Instagram -->
                    
                    <div style="text-align: left; font-size:14px;"">
                        <a href="#" class="link-log" style="margin-top: 10px;">Nie pamiętasz hasła?</a>
                    </div>

                    <input type="submit" value="Zaloguj się" id="submit">
                </form>
        </div>
            <p class="lastbox">Nie masz konta? <a href="register.php" class="link-log">Zarejestruj się</a></p>
    </main>


<footer>Copyright © 2022</footer>

</body>
</html>