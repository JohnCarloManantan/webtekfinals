const query = require('./query');

query.queryRegistration('tutor',function(result)
	{
		var cust = result;
		console.log(cust);
	});

