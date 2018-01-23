//验证手机号码格式是否正确
function validatePhone(str) {
	var patn1 = /^13\d{9}$/;
	var patn2 = /^14\d{9}$/;
	var patn3 = /^15\d{9}$/;
	var patn4 = /^17\d{9}$/;
	var patn5 = /^18\d{9}$/;
	if(patn1.test(str) || patn2.test(str) || patn3.test(str) || patn4.test(str) || patn5.test(str)) {
		return true;
	}
	return false;
}

//验证邮箱
function validateEmail(str){ 
	var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/; 
	return reg.test(str); 
} 

//验证手机动态码合法性
function validateCode(str) {
	var patn = /^[0-9]{6}$/;
	if(patn.test(str)) {
		return true;
	}
	return false;
}

//加密手机号码
function encryptPhone(num){
	var a = String(num).split('');
	for(var i = 3; i < 7; i++){
		a[i] = "*"
	}
	return a.join('');
}