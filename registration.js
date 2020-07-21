document.getElementById("register").addEventListener("click", register)
document.getElementById("repassword").addEventListener("change", checkPassword)
document.getElementById("password").addEventListener("change", checkPasswordValidation)
document.getElementById("email").addEventListener("change", checkEmail)

var pass_match = false
var pass_valid = false
var email_valid = false

function register() {
    if(pass_match && pass_valid && email_valid){
        $.ajax({
            type: "POST",
            url: "./controller/registration.php",
            data: {name: document.getElementById("name").value,
                surname: document.getElementById("surname").value,
                username: document.getElementById("username").value,
                email: document.getElementById("email").value,
                sex: document.getElementById("sex").value,
                password: document.getElementById("password").value,
                sword: document.getElementById("sword").value,
                dogName: document.getElementById("dogName").value},
            success: function(response) {
                if(response != "Query fail") {
                    document.location.href = "./login.html"
                } else {
                    document.getElementById("usernamemasg").innerHTML = "This username is already taken!" 
                    document.getElementById("usernamemasg").style.color = "red";
                }
            }
        })
    } else {
        document.getElementById("passmsg").innerHTML = "Please check all inputs!"
        document.getElementById("passmsg").style.color = "red";
    }
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

function checkEmail() {
    if(!(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-]+$/.test(document.getElementById("email").value))) {
        document.getElementById("emailmsg").innerHTML = "Please enter valid email!"
        document.getElementById("emailmsg").style.color = "red";
        email_valid = false
    } else {
        document.getElementById("emailmsg").innerHTML = ""
        email_valid = true
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
