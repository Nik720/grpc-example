var grpc = require('grpc');

var booksProto = grpc.load('protos/books.proto');

var client = new booksProto.books.BookService('127.0.0.1:50051', grpc.credentials.createInsecure());

function listBooks(){
	client.listbook({}, function(error, books) {
	  if (error)
	    console.log('Error: ', error);
	  else
	    console.log(books);
	});	
}

function insertBook(id, title, author){
	var book = {id: parseInt(id), title:title, author:author};
	client.insert(book, function(error,response){
		if (error)
		    console.log('Error: ', error);
		  else
		    console.log(response);
	});
}

function getBook(id){
	var book = {id: parseInt(id)};
	client.get(book, function(error,response){
		if (error){
			console.log('Error code: ', error.code);
		    console.log('Error metadata: ', error.metadata);
		    console.log('Error details: ', error.details);
		}else{
		    console.log(response);
		}
	});
}

function deleteBook(id){
	var book = {id: parseInt(id)};
	client.delete(book, function(error,response){
		if (error)
		    console.log('Error: ', error);
		  else
		    console.log(response);
	});
}
function watchBooks(){
	var call = client.watch({});
	call.on('data', function(book){
		console.log(book);
	});
}


var processName = process.argv.shift();
var scriptName = process.argv.shift();
var command = process.argv.shift();

if(command == 'list') 
	listBooks();
else if(command == 'insert') 
	insertBook(process.argv[0], process.argv[1], process.argv[2]);
else if(command == 'get') 
	getBook(process.argv[0]);
else if(command == 'delete') 
	deleteBook(process.argv[0]);
else if(command == 'watch') 
	watchBooks();

