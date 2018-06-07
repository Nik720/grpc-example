
# set grpc_php_plugin path to generate service Client
# --plugin=protoc-gen-grpc=/var/www/html/grpc/bins/opt/grpc_php_plugin


protoc 	--proto_path=../protos \
		--php_out=./ \
		--grpc_out=./ \
		--plugin=protoc-gen-grpc=/var/www/html/grpc/bins/opt/grpc_php_plugin ../protos/books.proto