<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja - Forum</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <div class="form"><a href="login.php">Log in</a></div>
            <div class="form"><a href="register.php">Sign Up</a></div>
        </header>
        <main>
            <div class="content">
                <h1>Załóż konto</h1>
                <form action="register.php" method="post">
                    <div class="txt_field">
                        <input type="text" id="nick" name="user" required>
                        <span></span>
                        <label for="nick">Nazwa użytkownika</label>
                    </div>
                    <div class="txt_field">
                        <input type="email" id="mail" name="email" required>
                        <span></span>
                        <label for="mail">E-mail</label>
                    </div>
                    <div class="txt_field">
                        <input type="password" id="pass1" name="pass1" required>
                        <span></span>
                        <label for="pass1">Hasło</label>
                    </div>
                    <div class="txt_field">
                        <input type="password" id="pass2" name="pass2" required>
                        <span></span>
                        <label for="pass2">Potwierdź hasło</label>
                    </div>
                    
                    <div class="reg">
                        <input type="checkbox" name="" id="" required> Wyrażam zgodę na przetwarzanie danych,
                        <a href="#" class="link-log"> akceptuję Regulamin</a> oraz <a href="#" class="link-log">Politykę Prywatności.</a>
                        <!-- CAPTCHA -->
                    </div>
                    
                    <input type="submit" value="Załóż konto" id="submit">
                    
                    
                </form>
                
            </div>
            <div class="lastbox">
                Masz już konto? <a href="login.php" class="link-log">Zaloguj się</a>
            </div>
        </main>
        <footer>
            <p>Elegancka strona logowania oraz rejestracji &dagger;</p>
        </footer>
    </div>
    
</body>
</html>