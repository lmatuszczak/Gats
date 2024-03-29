<?php
session_start();

// Zakaz przechodzenia na podstonę
if ((!isset($_SESSION['zalogowany'])) || ($_SESSION['accountrole'] != "admin")) {
	header('Location: ./index.php');
	exit(); // koniec - nie wykonuj dalszej części kodu
}

$per_page_record = 15;
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="navbar-style.css">
	<link rel="stylesheet" href="Pagination.css">
	<style>
		#maincolor {
			background-color: #4E5975 !important;
		}
	</style>

	<title>Panel Administratora</title>
</head>

<body>
	<?php
	include_once('./navbar.php');

	try {
		require_once('./connect.php');

		if (isset($_POST['delete_category'])) {
			$category_id = mysqli_real_escape_string($conn, $_POST['delete_category']);

			$query = "DELETE FROM kategorie WHERE category_id='$category_id' ";
			$query_run = $conn->query($query);

			if ($query_run) {
				header("Location: ./wszystkiekategorie.php");
				exit();
			} else {
				throw new Exception();
			}
		}
	} catch (Exception $e) {
		$_SESSION['e'] = "<h2 style='color:red; text-align:center; padding-top:20px'>Błąd serwera. Przepraszamy za problemy. Spróbuj później.</h2>";
	}
	?>


	<div class="w-50" style="margin-top: 2.5%; margin-left:auto; margin-right:auto;">

		<?php
		$query = "SELECT * FROM kategorie LIMIT " . $start_from . " , " . $per_page_record;
		$query_run = $conn->query($query);

		if ($query_run->num_rows > 0) {
		?>
			<table class="table">
				<thead>
					<tr>
						<th>Nazwa</th>
						<th>Akcje</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($query_run as $category) {
					?>
						<tr>
							<td><?= $category['category_name']; ?></td>
							<td>
								<form action="./wszystkiekategorie.php" method="POST">
									<button class="btn btn-danger" type="submit" name="delete_category" value="<?= $category['category_id']; ?>">Usuń</button>
								</form>
							</td>
						</tr>
				<?php
					}
				} else {
					echo "<h2>Nie znaleziono żadnych kategorii</h2>";
				}
				?>
				</tbody>
			</table>
			<?php
			$sql = "SELECT COUNT(*) FROM `kategorie`";
			$rs_result = $conn->query($sql);
			$row = $rs_result->fetch_row(); //OBIEKTOWO
			$total_records = $row[0];
			echo "</br>";
			$total_pages = ceil($total_records / $per_page_record);
			$pagLink = "";
			echo "<div class='pagination'>";
			if ($page >= 2) {
				echo "<a href='wszystkiekategorie.php?page=" . ($page - 1) . "'>  Prev </a>";
			}

			for ($i = 1; $i <= $total_pages; $i++) {
				if ($i == $page) {
					$pagLink .= "<a class = 'active' href='wszystkiekategorie.php?page="
						. $i . "'>" . $i . " </a>";
				} else {
					$pagLink .= "<a href='wszystkiekategorie.php?page=" . $i . "'>
					" . $i . " </a>";
				}
			};
			echo $pagLink;

			if ($page < $total_pages) {
				echo "<a href='wszystkiekategorie.php?page=" . ($page + 1) . "'>  Next </a>";
			}
			echo "</div>";
			$conn->close();

			?>
	</div>
	<?php include_once('./footer.php') ?>
</body>

</html>