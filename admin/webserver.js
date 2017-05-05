const http = require('http');
const home = require('./home');
const registration = require('./registration');
const customers = require('./customers');
const tutors = require('./tutors');
const status = require('./updateStatus');
const fs = require('fs');
const FeedbackSummary = require('./FeedbackSummary');
const CustomerProfile = require('./CustomerProfile');
const TutorProfile = require('./TutorProfile');


http.createServer(onRequest).listen(8087);
console.log("server is running");

function onRequest(request,response){
	var url = request.url;
	if(url.slice(url.indexOf('.')+1,url.length)=='css'){
		response.writeHead(200,{"Content-Type":"text/css"});
		response.write(fs.readFileSync("./css"+url.slice(url.lastIndexOf('/'),url.length),'utf-8'));
	}
	if(url.slice(url.indexOf('.')+1,url.length)=='.js'){
		response.writeHead(200,{"Content-Type":"text/javascript"});
		response.write(fs.readFileSync("./scripts"+url),'utf-8');
	}
	switch(url){
		case '/virtuoso':
			response.writeHead(200,{"Content-Type":"text/html"});
			response.write(fs.readFileSync("webpages/signup.html"),'utf-8');
		break;
		case '/virtuoso/customerregistration':
			registration.addToCustomers(request,response);
			response.writeHead(200,{"Content-Type":"text/html"});
			response.write(fs.readFileSync("webpages/registrationrecognition.html"),'utf-8');
		break;
		case '/virtuoso/tutorregistration':
			registration.addToTutors(request,response);
		break;
		case '/admin-login':
			response.writeHead(200,{"Content-Type":"text/html"});
			response.write(fs.readFileSync("webpages/admin-login.html"),'utf-8');
		break;
		case 'verfiy-login':
			home.getHome(request, response);
		break;
		case '/admin':
			home.getHome(request, response);
		break;
		case '/pendingCustomers':
			customers.getCustomers(request,response,'pending');
		break;
		case '/registeredCustomers':
			customers.getCustomers(request,response,'registered');
		break;
		case '/pendingTutors':
			tutors.getTutors(request,response,'pending');
		break;
		case '/registeredTutors':
			tutors.getTutors(request,response,'registered');
		break;
		case '/updateStatus':
			status.updateStatus(request,response,function(table){
				if (table =='tutor')
					tutors.getTutors(request,response,'pending');
				else if (table == 'customer')
					customers.getCustomers(request,response,'pending');
			});
		break;
		case `/TutorProfile?id=${url.slice(url.indexOf('=')+1,url.length)}`:
			var id = url.slice(url.indexOf('=')+1,url.length);
			TutorProfile.getTutorProfile(id,request,response);
		break;
		case `/CustomerProfile?id=${url.slice(url.indexOf('=')+1,url.length)}`:
			var id = url.slice(url.indexOf('=')+1,url.length);
			CustomerProfile.getCustomerProfile(id,request,response);	
		break;
		case '/FeedbackSummary':
			FeedbackSummary.getFeedbacks(request,response);
		break;
	}

	setTimeout(function(){response.end()},1000);
}

