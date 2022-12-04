<?php

session_start();
//mysqli_report(MYSQLI_REPORT_OFF); // żeby nie sypało fatal errorami
mysqli_report(MYSQLI_REPORT_STRICT);

// Zakaz przechodzenia na podstonę
if (!isset($_POST['email']))
	{
		header('Location: register.php');
		exit();
	}

//define variables and set to empty values
$name = $email = $pass1 = $pass2 = "";

if (isset($_POST['email'])) {
    $_SESSION['auto_name'] = $name = test_input($_POST['name']);
    $_SESSION['auto_email'] = $email = test_input($_POST['email']);
    $pass1 = test_input($_POST['pass1']);
    $pass2 = test_input($_POST['pass2']);

    $walidacja = true; // poprawne dane rejestracji
    
    //Sprawdzenie długości nazwy
    if(strlen($name) < 3 || strlen($name) > 30) {
        // die("Nazwa powinna składać się z 3-30 znaków!");
        $walidacja = false;
        $_SESSION['e_username'] = "Nazwa użytkownika powinna składać się z 3-30 znaków!";
        header('Location: register.php');
    }
    
    if (ctype_alnum($name)==false)
    {
        $walidacja=false;
        $_SESSION['e_username'] = "Nazwa użytkownika może składać się tylko z liter i cyfr (bez polskich znaków)";
        header('Location: register.php');
    }

    // Email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // die("Email jest wymagany!");
        $walidacja=false;
        $_SESSION['e_email'] = "Podaj poprawny adres e-mail!";
        header('Location: register.php');
    }
    
    // HASŁO
    //  poszukaj w haśle literki od a do z | i = no case sensitive
    if((!preg_match("/[a-z]/i", $pass1)) || (!preg_match("/[0-9]/", $pass1)) || (!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $pass1))){
        $walidacja=false;
        $_SESSION['e_haslo1'] = "Hasło musi zawierać co najmniej 1 znak specjalny, 1 literę, 1 cyfrę!";
        header('Location: register.php');
    }

    if((strlen($pass1) < 8) || (strlen($pass1)>32)) {
        // die("Hasło musi się składać z co najmniej 8 znaków");
        $walidacja=false;
        $_SESSION['e_haslo1'] = "Hasło musi się składać z co najmniej 8 znaków! (MAX 32 znaki!)";
        header('Location: register.php');
    }

    if ($pass1!=$pass2)
    {
        // die("Hasła nie są identyczne!");
        $walidacja=false;
        $_SESSION['e_haslo2']="Podane hasła nie są identyczne!";
        header('Location: register.php');
    }	

    // HASHOWANIE HASŁA
    $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
    
    //Czy zaakceptowano regulamin?
    if (!isset($_POST['reg']))
    {
        $walidacja=false;
        $_SESSION['e_reg']="Potwierdź akceptację regulaminu!";
        header('Location: register.php');
    }				
    
    // Weryfikacja Captcha
    $sekret = "6LfwLh8jAAAAAMZ9nAWgtjXJEZ8bkixORpy2adle";

    $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);

    $odp = json_decode($sprawdz);

    if($odp -> success==false){
        $walidacja=false;
        $_SESSION['e_bot'] = "Wypełnij CAPTCHA!";
        header('Location: register.php');
        //die("bot");
    }

    try{
        require_once('./connect.php');

        if ($conn -> connect_errno != 0) {
            throw new Exception("Błąd serwera. Przepraszamy za problemy. Spróbuj później.");
        }
        else{
            // Czy istnieje już taki email w bazie?
            $res = $conn -> query("SELECT id FROM users WHERE email='$email'");

            if(!$res) throw new Exception($conn -> error);

            if($res -> num_rows > 0){
                $walidacja = false;
                $_SESSION['e_email'] = "E-mail zajęty!";
                header('Location: register.php');
            }

            // Czy jest już taki użytkownik w bazie?
            $res = $conn -> query("SELECT id FROM users WHERE user='$name'");

            if(!$res) throw new Exception($conn -> error);

            if($res -> num_rows > 0){
                $walidacja = false;
                $_SESSION['e_username'] = "Nazwa zajęta!";
                header('Location: register.php');
            }

            if($walidacja){
                $sql = "INSERT INTO users (user,pass,email,actor)
                VALUES (?,?,?,?)";

                // Wykonuje funkcje incjalizującą na bazie danych - tworzy obiekt
                $stmt = $conn -> stmt_init();
            
                // Jeśli błąd przy wykonywaniu polecenia sql to zakończ
                if(!$stmt -> prepare($sql)) {
                    //die("Błąd SQL: ". $conn -> error);
                    throw new Exception($conn -> error);
                }
                //$today = date('Y-m-d');
                $actor = "user"; // domyślnie rejestrującym jest zawsze użytkownik - przeciętny zjadacz chleba
                // Zamiast ? podstaw te dane w zapytaniu
                $stmt -> bind_param("ssss", $name, $pass_hash,$email, $actor);

                if($stmt -> execute()) {
                    $_SESSION['udanarejestracja']=true;
                    header('Location: signup-success.php');
                }
                else{
                    throw new Exception($conn -> error);
                }
            }    
            $conn -> close();
        }
    }
    catch(Exception $e) {
        // $_SESSION['e'] = $e->getMessage();
        $_SESSION['e'] = "<h2 style='color:red; text-align:center; padding-top:20px'>Błąd serwera. Przepraszamy za problemy. Spróbuj później.</h2>";
        // $_SESSION['e'] = '<script>alert("Błąd serwera. Przepraszamy za problemy. Spróbuj później.")</script>';
        header('Location: register.php');
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>