const mysql = require('mysql');
const prototype = require('./prototype');
const dbconnect = require('./dbconnect')


exports 
exports.queryRegistration = function(tablename,callback){
	var registrations = [];
	dbconnect.connection.query(`Select * from ${tablename} order by timestamp desc`, 
		function(err, rows){
			if (err){
				console.log(err);				
				return;
			}
			rows.forEach(function(result){
				console.log(result);
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
				console.log(result);
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
