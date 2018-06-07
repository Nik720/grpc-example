var grpc = require('grpc');

var booksProto = grpc.load('protos/books.proto');

var books = [
	{ id: 123, title: 'Testing book', author: 'Testing book demo'}
];

var events = require('events');
var bookStream = new events.EventEmitter();

var server = new grpc.Server();
server.addService(booksProto.books.BookService.service, {
    listbook: function(call, callback) {
        callback(null, books);
    },
    insert: function(call, callback){
    	var book = call.request;
    	books.push(book);
    	bookStream.emit('new_book',book);
    	callback(null, {});
    },
    get: function(call, callback){
    	for(var i = 0; i < books.length; i++) {
    		if(books[i].id == call.request.id)
    			return callback(null, books[i]);

    	}
    	callback({code: grpc.status.NOT_FOUND, details: 'NOT FOUND'});
    },
    delete: function(call, callback){
    	for(var i = 0; i < books.length; i++) {
    		if(books[i].id == call.request.id){
    			books.splice(i, 1);
    			return callback(null, {});
    		}
    	}
    	callback({code: grpc.status.NOT_FOUND, details: 'NOT FOUND'});
    },
    watch: function(stream) {
    	bookStream.on('new_book', function(book){
    		stream.write(book);
    	})
    }

    
});

server.bind('0.0.0.0:50051', grpc.ServerCredentials.createInsecure());
console.log("Server runing !");
server.start();