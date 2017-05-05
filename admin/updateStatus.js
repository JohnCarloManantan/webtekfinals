const querystring = require('querystring');
const query = require('./scripts/query');

module.exports.updateStatus = function(req,res,callback){
	var body = [];
	var string;
	var info;
	req.on('data', function(chunk) {
  		body.push(chunk);
	}).on('end', function() {
  		body = Buffer.concat(body).toString();
  		string = querystring.parse(body);
  		info = string.value;
	});

	setTimeout(function(){
		var table = info.slice(0,info.indexOf(" "));
		var id = info.slice(info.indexOf(" ")+1,info.lastIndexOf(" "));
		var status = info.slice(info.lastIndexOf(" ")+1,info.length);
		var idlabel;
			if (table == 'customer'){
				idlabel = 'custid';
			}
			else if(table == 'tutor'){
				idlabel = 'tutorid';
			}
		setTimeout(function(){
			if(status=='Accept')
				query.setToRegistered(idlabel,table,id);
			else if(status=='Reject')
				query.deleteRegistration(idlabel,table,id);
			console.log(table);
			callback(table);
		})
	},300);
}
