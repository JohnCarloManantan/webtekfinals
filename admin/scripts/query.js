const mysql = require('mysql');
const prototype = require('./prototype');
const dbconnect = require('./dbconnect')


exports.queryRegistration = function(tablename,callback){
	var registrations = [];
	dbconnect.connection.query(`Select * from ${tablename} where status='registered' order by timestamp`, 
		function(err, rows){
			if (err){
				console.log(err);				
				return;
			}
			rows.forEach(function(result){
				if(tablename == 'customer'){
					var cust = new prototype.Customer(result.custid,result.email,result.name,result.address,result.cnumber,result.gender,result.birthday,result.status,result.timestamp,result.password,result.photo);
					registrations.push(cust);
				}
				else if(tablename == 'tutor'){
					var tutor = new prototype.Tutor(result.tutorid,result.email,result.name,result.address,result.gender,result.birthday,result.status,result.timestamp,result.password,result.photo);
					registrations.push(tutor);
				}
			})	
			callback(registrations);
		}
	);
}

exports.queryPendingRegistration = function(tablename,callback){
	var registrations = [];
	dbconnect.connection.query(`Select * from ${tablename} where status='pending' order by timestamp desc`, 
		function(err, rows){
			if (err){
				console.log(err);				
				return;
			}
			rows.forEach(function(result){
				if(tablename == 'customer'){
					var cust = new prototype.Customer(result.custid,result.email,result.name,result.address,result.cnumber,result.gender,result.birthday,result.status,result.timestamp,result.password,result.photo);
					registrations.push(cust);
				}
				else if(tablename == 'tutor'){
					var tutor = new prototype.Tutor(result.tutorid,result.email,result.name,result.address,result.gender,result.birthday,result.status,result.timestamp,result.password,result.photo);
					registrations.push(tutor);
				}
			})
			callback(registrations);
		}
	);
}

exports.deleteRegistration = function(idlabel,tablename,id){
	dbconnect.connection.query(`delete from ${tablename} where ${idlabel}='${id}'`, 
		function(err, rows){
			if (err){
				console.log(err);				
				return;
			}
			else
				console.log(`successfully deleted in ${tablename}`);
	});
}

exports.setToRegistered = function(idlabel,tablename,id){
	dbconnect.connection.query(`update ${tablename} set status='registered' where ${idlabel}='${id}'`, 
		function(err, rows){
			if (err){
				console.log(err);				
				return;
			}
			else
				console.log(`successfully added in ${tablename}`);
	});
}

exports.queryFeedback = function(callback){
	var feedbacks = [];
	dbconnect.connection.query(`select postid,custid,customer.name as 'custName',tutorid,tutor.name as 'tutorName',feedback.timestamp,feedback,rating from customer join feedback using(custid) join tutor using(tutorid) order by feedback.timestamp desc`,

		function(err, rows){
			if (err){
				console.log(err);				
				return;
			}
			rows.forEach(function(result){
				var feedback = new prototype.Feedback(result.postid,result.feedback,result.timestamp,result.custid,result.custName,result.tutorid,result.tutorName,result.rating);
				feedbacks.push(feedback);
			});
		callback(feedbacks);
		}
	);
}

exports.queryCustomerSessions = function(id,callback){
	var customerSessions = [];
	dbconnect.connection.query(`select program.name 'program',sessionNum,maxSession,date,time_start,time_fin,tutor.name 'tutor',transactid from transaction join program using(programid) join tutor using(tutorid) join session using(transactid) where custid = ${id}`,
		function(err, rows){
			if (err){
				console.log(err);				
				return;
			}
			rows.forEach(function(result){
				var session = new prototype.CustomerSession(result.program,result.sessionNum,result.maxSession,result.date.toLocaleDateString(),result.time_start,result.time_fin,result.tutor,result.transactid);
				customerSessions.push(session);
			})
		callback(customerSessions);		
	});	
}

exports.queryCustomerPayments = function(id,callback){
	var customerPayments = [];
	dbconnect.connection.query(`Select program.name 'program',tutor.name 'tutor',invoiceid,amount,payment.timestamp 'paymentdate',transactid from program join transaction using(programid) join tutor using (tutorid) join payment using(transactid) where custid = ${id}`,
		function(err, rows){
			if (err){
				console.log(err);				
				return;
			}
			rows.forEach(function(result){
				var payment = new prototype.CustomerPayment(result.program,result.tutor,result.invoiceid,result.amount,result.paymentdate.toLocaleString(),result.transactid);
				customerPayments.push(payment);
			})
			callback(customerPayments);	
	});	
}

exports.queryCustomerTransactions = function(id,callback){
	var customerTransacts = [];
	dbconnect.connection.query(`Select program.name 'program',tutor.name 'tutor', transaction.timestamp 'transacdate', transaction.status 'transacstat' from tutor join transaction using(tutorid) join program using(programid) where custid = ${id}`,
		function(err, rows){
			if (err){
				console.log(err);				
				return;
			}
			rows.forEach(function(result){
				var transaction = new prototype.CustomerTransaction(result.program,result.tutor,result.transacdate.toLocaleString(),result.transacstat);
				customerTransacts.push(transaction);
			})
			callback(customerTransacts);	
	});	
}

exports.queryCustomer = function(id,callback){
	var customer;
	dbconnect.connection.query(`Select * from customer where custid=${id}`, 
		function(err, rows){
			if (err){
				console.log(err);				
				return;
			}
			rows.forEach(function(result){
				customer = new prototype.Customer(result.custid,result.email,result.name,result.address,result.cnumber,result.gender,result.birthday.toLocaleDateString(),result.status,result.timestamp.toLocaleString(),result.password,result.photo);
					
			})	
			callback(customer);
		}
	);
}

exports.queryTutorSessions = function(id,callback){
	var tutorSessions = [];
	dbconnect.connection.query(`select program.name 'program',sessionNum,maxSession,date,time_start,time_fin,customer.name 'customer',transactid from transaction join program using(programid) join customer using(custid) join session using(transactid) where tutorid = ${id}`,
		function(err, rows){
			if (err){
				console.log(err);				
				return;
			}
			rows.forEach(function(result){
				var session = new prototype.CustomerSession(result.program,result.sessionNum,result.maxSession,result.date.toLocaleDateString(),result.time_start,result.time_fin,result.customer,result.transactid);
				tutorSessions.push(session);
			})
		callback(tutorSessions);		
	});	
}

exports.queryTutorPayments = function(id,callback){
	var tutorPayments = [];
	dbconnect.connection.query(`Select program.name 'program',customer.name 'customer',invoiceid,amount,payment.timestamp 'paymentdate',transactid from program join transaction using(programid) join customer using (custid) join payment using(transactid) where tutorid = ${id}`,
		function(err, rows){
			if (err){
				console.log(err);				
				return;
			}
			rows.forEach(function(result){
				var payment = new prototype.TutorPayment(result.program,result.customer,result.invoiceid,result.amount,result.paymentdate.toLocaleString(),result.transactid);
				tutorPayments.push(payment);
			})
			callback(tutorPayments);	
	});	
}

exports.queryTutorTransactions = function(id,callback){
	var tutorTransacts = [];
	dbconnect.connection.query(`Select program.name 'program',customer.name 'customer', transaction.timestamp 'transacdate', transaction.status 'transacstat' from customer join transaction using(custid) join program using(programid) where tutorid = ${id}`,
		function(err, rows){
			if (err){
				console.log(err);				
				return;
			}
			rows.forEach(function(result){
				var transaction = new prototype.TutorTransaction(result.program,result.customer,result.transacdate.toLocaleString(),result.transacstat);
				tutorTransacts.push(transaction);
			})
			callback(tutorTransacts);	
	});	
}

exports.queryTutor = function(id,callback){
	var tutor;
	dbconnect.connection.query(`Select * from tutor where tutorid=${id}`, 
		function(err, rows){
			if (err){
				console.log(err);				
				return;
			}
			rows.forEach(function(result){
				tutor = new prototype.Tutor(result.tutorid,result.email,result.name,result.address,result.gender,result.birthday.toLocaleDateString(),result.status,result.timestamp.toLocaleString(),result.password,result.photo);
					
			})	
			callback(tutor);
		}
	);
}

exports.insertToCustomer = function(email,name,address,cnumber,gender,birthday,password){
	dbconnect.connection.query(`INSERT INTO customer (email, name, address, cnumber, gender, birthday,password) VALUES ('${email}', '${name}', '${address}', '${cnumber}', '${gender}', '${birthday}', '${password}')`,
			function(err,rows){
				if(err){
					console.log(err);
					return;
				}
			}
	);
}

exports.insertToTutor = function(email,name,address,gender,birthday,password){
	dbconnect.connection.query(`INSERT INTO tutor (email, name, address, gender, birthday,password) VALUES ('${email}', '${name}', '${address}', '${gender}', '${birthday}', '${password}')`,
			function(err,rows){
				if(err){
					console.log(err);
					return;
				}
			}
	);
}