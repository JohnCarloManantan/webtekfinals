var fs = require('fs');
const query = require('./scripts/query')

module.exports.getHome = function(req,res){
	res.writeHead(200,{"Content-Type":"text/html"});
	res.write(fs.readFileSync("webpages/header.html",'utf-8'));

	res.write(
		`<h1>Virtuoso</h1>
		`)

	query.queryPendingRegistration('customer', function(customers){
		if(customers.length>0)
			res.write(
				`<p>There are pending registations of customers <a href='pendingCustomers'>click here to view</a></p>
				`);
		});

	query.queryPendingRegistration('tutor', function(customers){
		if(customers.length>0)
			res.write(
				`<p>There are pending registations of tutors<a href='pendingTutors'> click here to view</a></p>
				`);
		});

	setTimeout(function(){
		res.write(
		`<navigation>
		<ul>
		<li><a href='registeredCustomers'>Full List of Customers</a></li>		
		<li><a href='registeredTutors'>Full List of Tutors</a></li>
		<li><a href='FeedbackSummary'>Feedbacks</a></li>
		</ul>
		`);
		res.write(fs.readFileSync("webpages/footer.html",'utf-8'));
	},300);
}