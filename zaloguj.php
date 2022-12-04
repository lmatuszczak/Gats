<?php
session_start();
    mysqli_report(MYSQLI_REPORT_STRICT);

// Nie można przejsć do podstrony jeśli nie wprowadzono danych logowania
if((!isset($_POST['name'])) || (!isset($_POST['password']))) {
        header('Location: login.php');
        exit(); // koniec - nie wykonuj dalszej części kodu
}

if(isset($_POST['name'])){

    try{
        require_once('connect.php');
    
        if ($conn -> connect_errno != 0) {
            throw new Exception("Błąd serwera. Przepraszamy za problemy. Spróbuj później.");
        }
        else{
            $_SESSION['auto_name_L'] = $login = $_POST['name'];
            $password = $_POST['password'];
    
            $login = htmlentities($login, ENT_QUOTES, "utf-8"); // sanityzacja kodu, np. < = &lt;
    
            if($res = $conn -> query(
                sprintf("SELECT * FROM users WHERE user='%s'",
                mysqli_real_escape_string($conn, $login)))) //wbudowana funkcja, której używamy na ciągu znaków od uzytkownika - sanityzacja
            {
                // liczba kont > 0
                if($res -> num_rows > 0){
                    $row = $res -> fetch_assoc(); // indeks tablicy posiada nazwę zamiast numeru
                    if(password_verify($password, $row['pass'])){
                        $_SESSION['zalogowany'] = true;
                        $_SESSION['userLog']  = $row['user'];
                        $_SESSION['accountrole'] = $row['actor'];
                        $_SESSION['userid'] = $row['id'];
                        
                        unset($_SESSION['errorLog']); // udało się zalogować? tak = usuń, zmienna niepotrzebna
                        
                        $res -> free(); // czysczenie rezultatów zapytania, posiadamy je w zmiennych
                        header('Location: index.php'); // UDANE LOGOWANIE = PRZEJDŹ DO STRONY GŁOWNEJ
                    }
                    else{
                        $_SESSION['errorLog'] = '<p style="color:red; font-size:12px; margin:-20px 0 10px 0">Nieprawidłowy login lub hasło!</p>';
                        header('Location: login.php'); // wyrzuć błąd i przejdź do logowania       
                    }
                }
                else{
                    $_SESSION['errorLog'] = '<p style="color:red; font-size:12px; margin:-20px 0 10px 0">Nieprawidłowy login lub hasło!</p>';
                    header('Location: login.php'); // wyrzuć błąd i przejdź do logowania       
                }
            }
            else {
                throw new Exception("Błąd wykonywania SQL!");
            }
            $conn -> close(); // po wykonaniu pracy zamknij bazę
        }
    
    }
    catch(Exception $s)
    {
        //$_SESSION['e'] = $s->getMessage();
        $_SESSION['e'] = "<h2 style='color:red; text-align:center; padding-top:20px'>Błąd serwera. Przepraszamy za problemy. Spróbuj później.</h2>";
        header('Location: login.php');
    }
}
