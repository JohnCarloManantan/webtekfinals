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