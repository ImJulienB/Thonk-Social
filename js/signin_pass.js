function checkPass() {
	//Store the password field objects into variables ...
	var pass1 = document.getElementById('pass1');
	var pass2 = document.getElementById('pass2');
	//Store the Confimation Message Object ...
	var message = document.getElementById('confirmMessage');
	//Set the colors we will be using ...
	var goodColor = "#fff";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value) {
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 		        
        pass2.style.backgroundColor = goodColor;
        message.innerHTML = "";
        document.getElementById("submit").disabled = false;
    } else {
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.innerHTML = "Passwords Do Not Match!";
        document.getElementById("submit").disabled = true;
    }
}