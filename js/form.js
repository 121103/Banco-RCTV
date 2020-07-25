
var record = document.getElementById("registrar");
var response = document.getElementById("respuesta");
var input = document.getElementsByTagName("input");

record.addEventListener("submit", function(e){
    e.preventDefault();

    var datas = new FormData(record);
    
    fetch("/rctv/php/registar_php_js.php", {
        method: "POST",
        body: datas
    }).then ( res => res.json())
    .then ( data => {
        response.innerHTML = data;
        for (var i = 0; i < input.length; i++){
            input[i].value = "";
        }
    });
});

//{data = ?.. response.innerHTML = "...";