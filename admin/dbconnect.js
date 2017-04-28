const mysql = require('mysql');

connection = mysql.createPool({
	host:'localhost',
	user:'root',
	password:'',
	database:'virtuoso',
	port: 3306
});

module.exports.connection = connection;