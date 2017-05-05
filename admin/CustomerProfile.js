const querystring = require('querystring');
const query = require('./scripts/query');
const fs = require('fs')

module.exports.getCustomerProfile = function(id,req,res){
	res.writeHead(200,{"Content-Type":"text/html"});
	res.write(fs.readFileSync("./webpages/header.html"));
	query.queryCustomer(id,function(customer){
		res.write(
			`
			<h1>Customer Profile</h1>
			<p>
			ID: ${customer.custid}<br/>
			Name: ${customer.name}<br/>
			Email: ${customer.email}<br/>
			Address: ${customer.address}<br/>
			Contact Number: ${customer.cnumber}</br>
			Gender: ${customer.gender}<br/>
			Birth Date: ${customer.birthday}<br/>
			Date of Registration: ${customer.timestamp}<br/> 
			</p>
			`)
	})


	var transactions;
	var sessions;
	var payments;

		query.queryCustomerTransactions(id,function(results){
			transactions = results;
		})
		query.queryCustomerSessions(id,function(results){
			sessions = results;
		})
		query.queryCustomerPayments(id,function(results){
			payments = results;
		})

		setTimeout(function(){
			if(transactions.length > 0){
				res.write(
					`<h3>Transactions</h3>
					<table>
					<tr><th>Program</th><th>Tutor</th><th>Date</th><th>Status</th></tr>
				`)
				transactions.forEach(function(t){
					res.write(
						`<tr><td>${t.program}</td><td>${t.tutor}</td><td>${t.date}</td><td>${t.status}</td></tr>
						`)
				});
				res.write("</table>");
				if(sessions.length > 0){
					res.write(
						`<h3>Sessions</h3>
						<table>
							<tr><th>Program</th><th>Session Number</th><th>Applied Number of Sessions</th><th>Date</th><th>Tutor</th></th></tr>
					`)
					sessions.forEach(function(s){
						res.write(
							`<tr><td>${s.program}</td><td>${s.sessionnum}</td><td>${s.maxsession}</td><td>${s.date}</td><td>${s.tutor}</td>
						`)
					});
					res.write("</table>");
					if(payments.length > 0){
						res.write(
							`<h3>Payments</h3>
							<table>
								<tr><th>Program</th><th>Tutor</th><th>Amount</th><th>Date</th></tr>
						`)
						payments.forEach(function(p){
							res.write(
								`<tr><td>${p.program}</td><td>${p.tutor}</td><td>${p.amount}</td><td>${p.paymentdate}</td>
							`)
						});
						res.write("</table>");
					}
					else
						res.write("This customer hasn't yet made payments.");
				}
				else
					res.write("This customer hasn't yet started any sessions");
			}else
				res.write("This customer hasn't yet made any transactions");
		},1000);
}
