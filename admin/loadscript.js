const tutorpage = require('./tutorpage');
const customerpage = require('./customerpage');
exports.loadScript = function(reqPage){
	if(reqPage=='tutors.html' || reqPage=='pendingTutors.html'){
		tutorpage.createTutorsPage(reqPage);
		console.log('Created the page');
	}

	else if(reqPage=='customers.html' || reqPage=='pendingCustomers.html'){
		customerpage.createCustomersPage(reqPage);
		console.log('Created the page');
	}
}