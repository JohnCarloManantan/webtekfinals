const querystring = require('querystring');
const query = require('./scripts/query');
const fs = require('fs')

module.exports.getTutorProfile = function(id,req,res){
	res.writeHead(200,{"Content-Type":"text/html"});
	res.write(fs.readFileSync("./webpages/header.html"));
	query.queryTutor(id,function(tutor){
		res.write(
			`
			<h1>Tutor Profile</h1>
			<p>
			ID: ${tutor.tutorid}<br/>
			Name: ${tutor.name}<br/>
			Email: ${tutor.email}<br/>
			Address: ${tutor.address}<br/>
			Gender: ${tutor.gender}<br/>
			Birth Date: ${tutor.birthday}<br/>
			Date of Registration: ${tutor.timestamp}<br/> 
			</p>
			`)
	})


	var transactions;
	var sessions;
	var payments;

		query.queryTutorTransactions(id,function(results){
			transactions = results;
		})
		query.queryTutorSessions(id,function(results){
			sessions = results;
		})
		query.queryTutorPayments(id,function(results){
			payments = results;
		})
	

		setTimeout(function(){
			if(transactions.length > 0){
				res.write(
					`<h3>Transactions</h3>
					<table>
					<tr><th>Program</th><th>Customer</th><th>Date</th><th>Status</th></tr>
				`)
				transactions.forEach(function(t){
					res.write(
						`<tr><td>${t.program}</td><td>${t.customer}</td><td>${t.date}</td><td>${t.status}</td></tr>
						`)
				});
				res.write("</table>");
				if(sessions.length > 0){
					res.write(
						`<h3>Sessions</h3>
						<table>
							<tr><th>Program</th><th>Session Number</th><th>Applied Number of Sessions</th><th>Date</th><th>Customer</th></th></tr>
					`)
					sessions.forEach(function(s){
						res.write(
							`<tr><td>${s.program}</td><td>${s.sessionnum}</td><td>${s.maxsession}</td><td>${s.date}</td><td>${s.customer}</td>
						`)
					});
					res.write("</table>");
					if(payments.length > 0){
						res.write(
							`<h3>Payments</h3>
							<table>
								<tr><th>Program</th><th>Customer</th><th>Amount</th><th>Date</th></tr>
						`)
						payments.forEach(function(p){
							res.write(
								`<tr><td>${p.program}</td><td>${p.customer}</td><td>${p.amount}</td><td>${p.paymentdate}</td>
							`)
						});
						res.write("</table>");
					}
					else
						res.write("This tutor hasn't receive any payments.");
				}
				else
					res.write("This tutor hasn't started any sessions yet.");
			}else
				res.write("This tutor hasn't have any transactions.");
		},1000);
}
