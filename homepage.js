function likeHandler() {
    console.log(event)
    if(event.srcElement.nodeName == "SPAN") {
        var idFromClass = event.path[3].childNodes[1].id
        idFromClass = idFromClass.replace('postImg', '');
    } else if(event.srcElement.nodeName == "BUTTON") {
        var idFromClass = event.path[2].childNodes[1].id
        idFromClass = idFromClass.replace('postImg', '');
    }
    console.log(idFromClass)

    if(document.getElementById(`btnText${idFromClass}`).innerHTML == "Like it") {
        document.getElementById(`btnText${idFromClass}`).innerHTML = "Unlike it"
        document.getElementById(`likeCounter${idFromClass}`).innerHTML = parseInt(document.getElementById(`likeCounter${idFromClass}`).innerHTML) + 1
    } else {
        document.getElementById(`btnText${idFromClass}`).innerHTML = "Like it"
        document.getElementById(`likeCounter${idFromClass}`).innerHTML = parseInt(document.getElementById(`likeCounter${idFromClass}`).innerHTML) - 1
    }

    $.ajax({
        type: "POST",
        url: "./controller/likesHandler.php",
        data: {likes: parseInt(document.getElementById(`likeCounter${idFromClass}`).innerHTML),
            id: idFromClass},
        success: function(response) {
            console.log(response)
        }
    })
}