console.log("admin")


function actualizar(){
    console.log("actualizar")
    let form = document.getElementById("update");

    var datos = new FormData(form);
    datos.append("funcion", "autorizarUsuario")

    fetch("/rctv/php/admin.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        respuesta.innerHTML = data;
        document.getElementById("cedula").value = "";
        document.getElementById("type").value = "";
    });
    return false;
}

function showAll(){
    console.log("showAll")
    let datos = new FormData();
    datos.append("funcion", "mostrarUsuarios")
    fetch("/rctv/php/admin.php",{
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("respuesta").innerHTML= data;
    })
    return false;
}

function actInfo(form){
    console.log("innffo")
    let datos = new FormData() 
    let arr = Object.values(form)

    datos.append("opcion", arr[0].value)
    datos.append("cedula", arr[1].value)
    datos.append("cmp1", arr[2].value)
    datos.append("cmp2", arr[3].value)

    datos.append("funcion", "actualizarInfo")

    fetch("../../php/admin.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("respuesta").innerHTML= data
    })
    return false
}