const querystring = require('querystring');
const query = require('./scripts/query');


module.exports.addToCustomers = function(req,res){
	var body = [];
	req.on('data', function(chunk) {
  		body.push(chunk);
	}).on('end', function() {
  		body = Buffer.concat(body).toString();
  		var reg = querystring.parse(body);
  		query.insertToCustomer(reg.email,reg.name,reg.address,reg.phone,reg.gender,reg.birthday,reg.pwd)
	});
	
}

module.exports.addToTutors = function(req,res){
	var body = [];
	var reg;
	req.on('data', function(chunk) {
  		body.push(chunk);
	}).on('end', function() {
  		body = Buffer.concat(body).toString();
  		reg = querystring.parse(body);
  		query.insertToTutor(reg.email,reg.name,reg.address,reg.gender,reg.birthday,reg.pwd)
	});
}
