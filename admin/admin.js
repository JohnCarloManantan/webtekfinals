module.exports.showHelloWorld = function(request,response){
	if (request.url==='/'){
		response.writeHead(200,{"Content-Type":"text/html"});
		response.write("Hello World!");
		response.end();
	}
}