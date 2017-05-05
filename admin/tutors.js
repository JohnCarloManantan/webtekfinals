var fs = require('fs');
const query = require('./scripts/query')
module.exports.getTutors = function(req,res,status){
	res.writeHead(200,{"Content-Type":"text/html"});
	res.write(fs.readFileSync("./webpages/header.html"));

	res.write(`<a href="/">Home</a>
		<h1>Tutors</h1>
		<table>
		<tr><th>Tutor ID</th><th>Email</th><th>Name</th><th>Address</th><th>Gender</th><th>Birth Date</th><th>Status</th><th>Registration Date</th></tr>`);

	var toHTMLTable = function(id,email,name,address,gender,bday,status,timestamp){
		if (status == 'registered')
			return `
		<tr><td>${id}</td><td>${email}</td><td><a href='/TutorProfile?id=${id}'>${name}</a></td><td>${address}</td><td>${gender}</td><td>${bday}</td><td>${status}</td><td>${timestamp}</td></tr>`;
		else if (status == 'pending')
			return `
		<tr><td>${id}</td><td>${email}</td><td>${name}</td><td>${address}</td><td>${gender}</td><td>${bday}</td><td>${status}</td><td>${timestamp}</td><td><form method='POST' action="/updateStatus"><button type="submit" value="tutor ${id} Accept" name="value">Accept</button><button type="submit" value="tutor ${id} Reject" name="value">Reject</button></form></td></tr>`;
	};
	
	tutors = [];

	if(status=='registered'){
		query.queryRegistration('tutor',function(result){
			tutors = result;
		});
	}

	else if(status=='pending'){
		query.queryPendingRegistration('tutor',function(result){
			tutors = result;
		});
	}
	
	setTimeout(function(){
		tutors.forEach(function(t){
			var detailsInTable = toHTMLTable(t.tutorid,t.email,t.name,t.address,t.gender,t.birthday.toLocaleDateString(),t.status,t.timestamp.toLocaleString());
			res.write(detailsInTable);
		})
	},500);

	setTimeout(function(){
		res.write(`
			</table>
			`);
		res.write(fs.readFileSync("webpages/footer.html",'utf-8'))
	},600);
}