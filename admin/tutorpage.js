const fs = require('fs');
const query = require('./query');
const dbconnect = require('./dbconnect');

function createHeading(page){
	var header = fs.readFileSync('header.html','utf-8');
	var heading = '<h1>Tutors</h1>'
	var tableHeader = '<table><tr><th>Tutor ID</th><th>Email</th><th>Name</th><th>Address</th><th>Gender</th><th>Birth Date</th><th>Status</th><th>Registration Date</th></tr>'
	fs.writeFileSync(page,
		`${header}
		${heading}
		${tableHeader}
		`,'utf-8');
}

function createFooter(page){
	var footer = fs.readFileSync('footer.html','utf-8');
	fs.appendFileSync(page,
		`</table>
		${footer}`,'utf-8');
}

exports.createTutorsPage = function(page){
	createHeading(page);
	var toHTMLTable = function(id,email,name,address,gender,bday,status,timestamp){
		return `<tr><td>${id}</td><td>${email}</td><td>${name}</td><td>${address}</td><td>${gender}</td><td>${bday}</td><td>${status}</td><td>${timestamp}</td></tr>`;
	};
	
	tutors = [];

	if(page=='tutors.html'){
		query.queryRegistration('tutor',function(result){
			tutors = result;
			console.log(tutors);
		});
	}

	else if(page=='pendingTutors.html'){
		query.queryPendingRegistration('tutor',function(result){
			tutors = result;
			console.log(tutors);
		});
	}
	
	setTimeout(function(){
		tutors.forEach(function(t){
			var detailsInTable = toHTMLTable(t.tutorid,t.email,t.name,t.address,t.gender,t.birthday.toLocaleDateString(),t.status,t.timestamp.toLocaleString());
			fs.appendFileSync(page,detailsInTable,'utf-8');
			console.log(detailsInTable);
			console.log(page);
		})
	},500);

	setTimeout(function(){createFooter(page)},1000);
}
