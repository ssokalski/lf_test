var validUsername=0;
var validEmail=0
var passwordsMatch=0;

function checkSubmitReady()
{
	// Make sure Username exists, Valid email and Passwords match
	if(validUsername && validEmail && passwordsMatch)
	{
		// Activate Submit Button
		document.getElementById("mySubmit").disabled = false
		return (true)
	}
	// Deactivate Submit Button (if something was modified after passing test)
	document.getElementById("mySubmit").disabled = true
	return (false)
}

function checkUsername()
{
	// Just make sure Username is not blank for now
	// Typically an API call would be made to check if Username is unique
	if(document.getElementById("Username").value.length > 0)
	{
		validUsername=1
		document.getElementById("status").innerHTML = ''
		checkSubmitReady()
                return (true)
	}
	validUsername=0
	// Deactivate Submit Button (if something was modified after passing test)
	checkSubmitReady()
	return (false)	
}

function checkEmail() 
{
	var email =  document.getElementById("Email").value

	// Allow up to 12 characters for tld
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,12})+$/.test(email))
	{
		validEmail=1
		document.getElementById("status").innerHTML = ''
		checkSubmitReady()
		return (true)
	}
	validEmail=0
        // Deactivate Submit Button (if something was modified after passing test)
        checkSubmitReady()
	document.getElementById("status").innerHTML = 'Bad Email Address Format'
	return (false)
}

function checkPasswords()
{
	// Check if passwords match and are not blank
	// Ideally password strenth should also be tested to includ upper & lower case, numbers and special characters
	if(document.getElementById("Password").value == document.getElementById("PasswordConf").value
		&& document.getElementById("Password").value.length != 0)
	{
		passwordsMatch=1
		document.getElementById("status").innerHTML=''
		checkSubmitReady()
		return (true)
	}
	passwordsMatch=0
        // Deactivate Submit Button (if something was modified after passing test)
        checkSubmitReady()
	document.getElementById("status").innerHTML = "Passwords Do Not Match"
	return (false)
}
