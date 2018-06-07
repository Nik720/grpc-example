# grpc-example
grpc example with node js server and client in node and php

#Node 
- To install dependencies open terminal and run below command
	- npm install

- server code is written in server.js to run server run below comman
	- node server.js

- now your server is working, open another terminal to run client
- run below listed command to run service

- node client.js list   			=> this will give you list of books
- node client.js get {bookid} 		=> this will give you specified book details
- node client.js insert {bookid} "{book title}" "{book author}" => this will add new book
- node client.js delete {bookid} 	=> this will delete book
- node client.js watch  			=> after running watch it will start response stream, when ever new book will insert it will notify.


# Create Client in php
- move to /php directory
- install dependencies via 
	-composer install

- generate gRPC client librery by compiling .proto file which is located in (/proto/books.proto). (make sure you have installed protoc compiler and set proper path of grpc_php_plugin)
- befor run below command modify shell script and set proper path of grpc_php_plugin (--plugin=protoc-gen-grpc=/grpc_php_plugin)

	-sh books_proto_gen.sh

- open booklist.php from your localhost you will see book list and you can add new book.





