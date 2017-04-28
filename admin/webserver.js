const http = require('http');
const fs = require('fs');
const loadScript = require('./loadscript');


function onRequest(request, response){
	console.log(request.url);
	console.log(request.method);
	if(request.url=='/favicon.ico');
	else if(request.url=='/'){
		response.write(fs.readFileSync('index.html','utf-8'));
	}
	else{
			switch(request.method){
				case 'GET':
					var fileName = request.url.slice(request.url.lastIndexOf('/')+1,request.url.length);
					loadScript.loadScript(fileName);
					setTimeout(function(){
					var filetype = fileName.slice(fileName.indexOf('.')+1,fileName.length);
						try{
							var page = fs.readFileSync(fileName,'utf-8');
							switch(filetype){
								case 'html':
									response.writeHead(200,{"Context-Type": "text/html"});
									response.write(page,'utf-8');
								break;
								case 'css':
									response.writeHead(200,{"Context-Type": "text/css"});
									response.write(page,'utf-8');
								break;
								case 'html':
									response.writeHead(200,{"Context-Type": "text/javascript"});
									response.write(page,'utf-8');
								break;
							}
						}catch(err){
							response.writeHead(404,{"Context-Type":"text/html"});
							response.write(fs.readFileSync("404.html",'utf-8'));
						}
					},2000);
				break;

				case 'POST':
				break;
			}
	}	
	setTimeout(function(){response.end()},3000)
}

http.createServer(onRequest).listen(8080);
console.log("server is running...");