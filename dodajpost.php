<?php
	session_start();

    if((!isset($_SESSION['zalogowany']))) {
      header('Location: ./index.php');
      exit(); // koniec - nie wykonuj dalszej części kodu
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="navbar-style.css">
    <style>
      #maincolor{
        background-color:#4E5975 !important;
      }
    </style>
    <title>Panel Użytkownika</title>
</head>
<body>
	<?php 
		include_once('./navbar.php');

		
		if(isset($_SESSION['e'])){
            echo $_SESSION['e'];
            unset($_SESSION['e']);
        }

		try{
			require_once('connect.php');
		
			if ($conn -> connect_errno != 0) {
				throw new Exception("Błąd serwera. Przepraszamy za problemy. Spróbuj później.");
			}
			else{
				if(isset($_POST['dodaj_post'])){

					$title = $_POST['title'];
					$desc = $_POST['desc'];
					$catid = $_POST['catid'];
		
					$userid = $_SESSION['userid'];
		
					$query = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$title', '$desc', '$catid', '$userid', current_timestamp())";
					
					if($query_run = $conn -> query($query))
					{
						header("Location: mojeposty.php");
					}
					else
					{
						throw new Exception();
					}
				}
				//$conn -> close(); // po wykonaniu pracy zamknij bazę
			}
		}
		catch(Exception $e){
			$_SESSION['e'] = "<h2 style='color:red; text-align:center; padding-top:20px'>Błąd serwera. Przepraszamy za problemy. Spróbuj później.</h2>";
			exit();	// nie działa połączenie z bazą to zakończ wykonywanie skryptu tutaj i wyjdź
		}
		
	?>

  <div class="w-50" style="margin-top: 2.5%; margin-left:auto; margin-right:auto;">
      <h1>Dodawanie Postu</h1>
    <form action="./dodajpost.php" method="post">
      <div class="form-group">
          <label for="exampleInputEmail1">Tytuł</label>
          <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
          <label for="exampleFormControlTextarea1">Treść postu...</label>
          <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
      </div>
      <div class="form-group">
        <select class="form-select" aria-label="Default select example" id="catid" name="catid">
        <?php 
		
			try{
				
				$sql = "SELECT * FROM `kategorie`";
	
				if($result = $conn -> query($sql)){
					
					while($row = mysqli_fetch_assoc($result)){
					  echo '<option value="'.$row['category_id'].'" id="catid" name="catid">'.$row['category_name'].'</option>';
					}
					//$conn -> close(); // po wykonaniu pracy zamknij bazę
				}
				else throw new Exception();
			}
			catch(Exception $e){
                $_SESSION['e'] = "<h2 style='color:red; text-align:center; padding-top:20px'>Błąd serwera. Przepraszamy za problemy. Spróbuj później.</h2>";
                // $_SESSION['e'] = $e->getMessage();
			}
			$conn -> close();
            ?>
        </select>
      </div>
      <button type="submit" name="dodaj_post" class="btn btn-primary">Dodaj post </button>
    </form>
  </div>
  <?php include_once ('./footer.php')?>
</body>
</html>