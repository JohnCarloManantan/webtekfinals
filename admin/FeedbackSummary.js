var fs = require('fs');
const query = require('./scripts/query')
module.exports.getFeedbacks = function(req,res){
	res.writeHead(200,{"Content-Type":"text/html"});
	res.write(fs.readFileSync("./webpages/header.html"));

	res.write('<h1>Feedback Summary</h1>');

	feedbacks = [];

	query.queryFeedback(function(results){
		feedbacks = results;
	});

	setTimeout(function(){
		feedbacks.forEach(function(f){
			res.write(
				`
				<p>Date: ${f.timestamp.toLocaleString()}<br/>
				Customer: <a href=CustomerProfile?id=${f.custid}>${f.custname}</a> Tutor: <a href=TutorProfile?id=${f.tutorid}>${f.tutorname}</a><br/>
				Rating: ${f.rating}</p>
				`);
			if(f.feedback!=null){
				res.write(
					`
					<p>Message:</p>
					<p>${f.feedback}
					`
			)}
		});
	},500);

	setTimeout(function(){
		res.write(fs.readFileSync("webpages/footer.html",'utf-8'))
	},600);
};