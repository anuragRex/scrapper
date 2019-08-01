<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Scrapper</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
	<center><h3>Rexweb Super-Scraper</h3></center>
	<form method="POST" action="test.php">
		<div class="form-group">
			<input type="text" class="form-control" name="url" placeholder="Enter url" required>
		</div>
		<div class="form-group">
			<input type="submit" name="submit" class="btn btn-primary" value="GO">
			<!-- <input type="button"  class="btn btn-success" name="" value="CSV"> -->
		</div>
	</form>
<?php
	if ($_SESSION['download_message']) {
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">'.$_SESSION['download_message'].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
	session_unset($_SESSION['download_message']);
	unset($_SESSION['download_message']); 
	}
	if (($_SESSION['agency_names']) && ($_SESSION['all_address']) ) {
		// print_r($_SESSION['agency_names']);
		// print_r($_SESSION['all_address']);
		echo '<form method="POST" action="downloadcsv.php">
			<input type="submit"  class="btn btn-success" name="submit_csv" value="CSV">
			</form>';
		echo '<table border="1">';
		for($j=0;$j<count($_SESSION['agency_names']);$j++) {
		  echo('<tr>');
		  echo('<td>' . $_SESSION['agency_names'][$j] . '</td>');
		  // echo('<td>' . $_SESSION['phones'][$j]. '</td>');
		  echo('<td>' . $_SESSION['all_address'][$j]. '</td>');

		  echo('</tr>');
		}
		echo '</table>';

		// remove all session variables
		//session_unset(); 

		// destroy the session 
		//session_destroy(); 
	}
?>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>