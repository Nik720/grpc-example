<?php 

require dirname(__FILE__).'/client.php';

if(isset($_POST['submit'])) {
	$id = $_POST['bookid'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	
	$res = insertBook($id, $title, $author);
	if($res->code == 0){
		header('Location: ./booklist.php');
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Book listing</title>
	<script
			  src="https://code.jquery.com/jquery-2.2.4.min.js"
			  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
			  crossorigin="anonymous"></script>
</head>
<body>

	<nav>
		<a href="booklist.php">Book list</a>
		<a href="addbook.php">Add Book</a>
	</nav>

	<br><br>

	<section>

		<form method="post">
			<input type="text" name="bookid"><br><br>
			<input type="text" name="title"><br><br>
			<input type="text" name="author"><br><br>
			<input type="submit" name='submit' value="Add Book" ><br><br>
		</form>

		
	</section>


</body>
</html>