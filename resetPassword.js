document.getElementById("rpswd").addEventListener("click", resetPassword)
document.getElementById("repassword").addEventListener("change", checkPassword)
document.getElementById("password").addEventListener("change", checkPasswordValidation)

function resetPassword() {
    $.ajax({
        type: "POST",
        url: "./controller/resetPassword.php",
        data: {username: document.getElementById("username").value,
            sword: document.getElementById("sword").value,
            password: document.getElementById("password").value},
        success: function(response) {
            if(response != "Query fail") {
                document.location.href = "./login.html"
            } else {
                document.getElementById("wordmsg").innerHTML = "Security word is wrong!" 
                document.getElementById("wordmsg").style.color = "red";
            }
        }
    })
}

function checkPassword() {
    var pass = document.getElementById("password").value
    var repass = document.getElementById("repassword").value

    if(pass != repass) {
        document.getElementById("passmsg").innerHTML = "Passwords do not match. Please check!"
        document.getElementById("passmsg").style.color = "red";
        pass_match = false
    } else {
        document.getElementById("passmsg").innerHTML = "Passwords match."
        document.getElementById("passmsg").style.color = "green";
        pass_match = true
    }
}

function checkPasswordValidation() {
    if(!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(document.getElementById("password").value))) {
        document.getElementById("validpassmsg").innerHTML = "Please enter atleast 8 characters and atleast one uppercase and lowercase letter and one number!"
        document.getElementById("validpassmsg").style.color = "red";
        pass_valid = false
    } else {
        document.getElementById("validpassmsg").innerHTML = ""
        pass_valid = true
    }
}