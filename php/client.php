<?php 


require dirname(__FILE__).'/vendor/autoload.php';
@include_once dirname(__FILE__).'/Books/BookServiceClient.php';
@include_once dirname(__FILE__).'/Books/Book.php';
@include_once dirname(__FILE__).'/Books/BookList.php';
@include_once dirname(__FILE__).'/Books/BookIdRequest.php';
@include_once dirname(__FILE__).'/Books/PBEmpty.php';
@include_once dirname(__FILE__).'/GPBMetadata/Books.php';

$client = new Books\BookServiceClient('localhost:50051', [
	'credentials' => Grpc\ChannelCredentials::createInsecure(),
]);


function listBooks() {
	global $client;
	$argu = new Books\PBEmpty();
	list($books, $status) = $client->listbook($argu)->wait();	
	if($status->code === 0) {
		foreach($books->getBooks() as $book){
			$id = $book->getId();
			$title = $book->getTitle();
			$author = $book->getAuthor();

			$booklist[] = [
				'id' => $id,
				'title' => $title,
				'author' => $author
			];	
		}
		return $booklist;

	}else{
		print_r("Error code => ".$status->code."\n");
		print_r("Error Details => ".$status->details."\n");
	}
}

function insertBook($id, $title, $author) {
	global $client;
	$book_request = new Books\Book();
	$book_request->setId(intval($id)); 
	$book_request->setTitle($title);
	$book_request->setAuthor($author);
	list($books, $status) = $client->insert($book_request)->wait();
	if($status->code === 0) {
		return $status;
	}else{
		print_r("Error code => ".$status->code."\n");
		print_r("Error Details => ".$status->details."\n");
	}
}

function getBook($id) {
	global $client;
	$book_request = new Books\BookIdRequest();
	$book_request->setId(intval($id)); 
	list($books, $status) = $client->get($book_request)->wait();
	
	if($status->code === 0) {
		$books = array(
			'id' => $books->getId(),
			'title' => $books->getTitle(),
			'author' => $books->getAuthor()
		);	
		print_r($books);
	}else{

		print_r("Error code => ".$status->code."\n");
		print_r("Error Details => ".$status->details."\n");
	}
}

function deleteBook($id) {
	global $client;
	$book_request = new Books\BookIdRequest();
	$book_request->setId(intval($id)); 
	list($books, $status) = $client->delete($book_request)->wait();
	
	if($status->code === 0) {
		print_r("Book Deleted sucessfully !!! \n");
	}else{

		print_r("Error code => ".$status->code."\n");
		print_r("Error Details => ".$status->details."\n");
	}
}


if(isset($argv) && !empty($argv[1])) {
	$command = $argv[1];
	
	if($command == 'list') {
		listBooks();
	}else if($command == 'insert') {
		insertBook($argv[2], $argv[3], $argv[4]);
	}else if($command == 'get') {
		getBook($argv[2]);
	}else if($command == 'delete') {
		deleteBook($argv[2]);
	}
}else{
	echo "Please set argument";
}


?>