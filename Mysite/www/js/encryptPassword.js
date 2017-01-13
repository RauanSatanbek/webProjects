function encrypet(s){
	var pass = 1;
	for(var i = 0; i < s.length; i++){
		// console.log(s.charCodeAt(i));
		pass *= s.charCodeAt(i));
	}
	return pass;
}