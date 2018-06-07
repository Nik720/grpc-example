<?php 

require dirname(__FILE__).'/client.php';

$bookLists = listBooks();
if(isset($_POST['submit'])) {
	$id = $_POST['bookid'];
	$res = deleteBook($id);
	header('Location: ./booklist.php');
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

		<table border="1" cellpadding="5" cellspacing="5">
			<tr>
				<th>id</th>
				<th>Book name</th>
				<th>Book author</th>
				<th>Delete</th>
			</tr>
			<?php  foreach ($bookLists as $book) { ?>
					<tr>
						<td><?php echo $book['id']; ?></td>
						<td><?php echo $book['title']; ?></td>
						<td><?php echo $book['author']; ?></td>
						<td>
							<form method="post">
								<input type="hidden" name="bookid" value="<?php echo $book["id"]; ?>">
								<input type="submit" name="submit" value="Delete">	
							</form>
							
						</td>
					</tr>
			<?php	} ?>
		</table>

		<ul>
			
		

		</ul>
	</section>

	<script type="text/javascript">
		
		function deleteBook(id) {
			$.ajax({
				url: "booklist.php?id="+id, 
				success: function(result){
		        	window.location.reload();
			    }
			});
		}

	</script>

</body>
</html>