exports.Product = function(prodid,proddesc,price){
	this.prodid = prodid;
	this.proddesc = proddesc;
	this.price = price;
}

exports.Customer = function(custid,email,name,address,cnumber,gender,birthday,status,timestamp,password,photo){
	this.custid = custid;
	this.email = email;
	this.name = name;
	this.address = address;
	this.cnumber = cnumber;
	this.gender = gender;
	this.birthday = birthday;
	this.status = status;
	this.timestamp = timestamp;
	this.password = password;
	this.photo = photo;
}

exports.Tutor = function(tutorid,email,name,address,gender,birthday,status,timestamp,password,photo){
	this.tutorid = tutorid;
	this.email = email;
	this.name = name;
	this.address = address;
	this.gender = gender;
	this.birthday = birthday;
	this.status = status;
	this.timestamp = timestamp;
	this.password = password;
	this.photo = photo;
}

exports.Feedback = function(postid,feedback,timestamp,custid,custname,tutorid,tutorname,rating){
	this.postid = postid;
	this.feedback = feedback;
	this.timestamp = timestamp;
	this.custid = custid;
	this.custname = custname;
	this.tutorid = tutorid;
	this.tutorname = tutorname;
	this.rating = rating;
}

exports.CustomerTransaction = function(program,tutor,date,status){
	this.program = program;
	this.tutor = tutor;
	this.date = date;
	this.status = status;
}

exports.CustomerPayment = function(program,tutor,invoiceid,amount,paymentdate,transactid){
	this.program = program;
	this.tutor = tutor;
	this.invoiceid = invoiceid;
	this.amount = amount;
	this.paymentdate = paymentdate;
	this.transactid = transactid;
}

exports.CustomerSession = function(program,sessionnum,maxsession,date,start,end,tutor,transactid){
	this.program = program;
	this.sessionnum = sessionnum,
	this.maxsession = maxsession,
	this.start = start;
	this.end = end;
	this.date = date;
	this.tutor = tutor;
	this.transactid = transactid;
}

exports.TutorTransaction = function(program,customer,date,status){
	this.program = program;
	this.customer = customer;
	this.date = date;
	this.status = status;
}

exports.TutorPayment = function(program,customer,invoiceid,amount,paymentdate,transactid){
	this.program = program;
	this.customer = customer;
	this.invoiceid = invoiceid;
	this.amount = amount;
	this.paymentdate = paymentdate;
	this.transactid = transactid;
}

exports.TutorSession = function(program,sessionnum,maxsession,date,start,end,customer,transactid){
	this.program = program;
	this.sessionnum = sessionnum,
	this.maxsession = maxsession,
	this.start = start;
	this.end = end;
	this.date = date;
	this.customer = customer;
	this.transactid = transactid;
}

