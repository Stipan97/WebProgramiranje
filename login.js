document.getElementById("login").addEventListener("click", login)

function login() {
    $.ajax({
        type: "POST",
        url: "./controller/login.php",
        data: {username: document.getElementById("username").value,
            password: document.getElementById("password").value},
        success: function(response) {
            if(response == "success") {
                document.location.href = "./index.php"
            } else {
                document.getElementById("wrongPass").innerHTML = "Wrong Password or Username!"
                document.getElementById("wrongPass").style.color = "red";
            }
            
        }
    })
}