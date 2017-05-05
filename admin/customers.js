var fs = require('fs');
const query = require('./scripts/query')
module.exports.getCustomers = function(req,res,status){
	res.writeHead(200,{"Content-Type":"text/html"});
	res.write(fs.readFileSync("./webpages/header.html"));
	res.write(`<a href="/">Home</a>
		<h1>Customers</h1>
		<table>
		<tr><th>Customer ID</th><th>Email</th><th>Name</th><th>Address</th><th>Contact Number</th><th>Gender</th><th>Birth Date</th><th>Status</th><th>Registration Date</th></tr>`);

	var toHTMLTable = function(id,email,name,address,cnumber,gender,bday,status,timestamp){
		if (status == 'registered')
			return `
		<tr><td>${id}</td><td>${email}</td><td><a href="/CustomerProfile?id=${id}">${name}</a></td><td>${address}</td><td>${cnumber}</td><td>${gender}</td><td>${bday}</td><td>${status}</td><td>${timestamp}</td></tr>`;
		else if (status == 'pending')
			return `
		<tr><td>${id}</td><td>${email}</td><td>${name}</td><td>${address}</td><td>${cnumber}</td><td>${gender}</td><td>${bday}</td><td>${status}</td><td>${timestamp}</td><td><form method='POST' action="/updateStatus"><button type="submit" value="customer ${id} Accept" name="value">Accept</button><button type="submit" value="customer ${id} Reject" name="value">Reject</button></form></td></tr>`;
	};
	
	customers = [];

	if(status=='registered'){
		query.queryRegistration('customer',function(result){
			customers = result;
		});
	}

	else if(status=='pending'){
		query.queryPendingRegistration('customer',function(result){
			customers = result;
		});
	}
	
	setTimeout(function(){
		customers.forEach(function(t){
			var detailsInTable = toHTMLTable(t.custid,t.email,t.name,t.address,t.cnumber,t.gender,t.birthday.toLocaleDateString(),t.status,t.timestamp.toLocaleString());
			res.write(detailsInTable);
		})
	},500);

	setTimeout(function(){
		res.write(`
			</table>
			`);
		res.write(fs.readFileSync("webpages/footer.html",'utf-8'));
	},600);
}