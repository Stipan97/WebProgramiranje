function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader()
        
        reader.onload = function (e) {
            document.getElementById("imgPreview").style.backgroundImage = `url(${e.target.result})`
        }
        
        reader.readAsDataURL(input.files[0])
    }
}

$("#img").change(function(){
    readURL(this)
});