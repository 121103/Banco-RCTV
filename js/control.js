console.log("ccontrol")

function olvidePwd(){
    console.log("pddaaaas")
    let name = document.getElementsByName("usuarioIngreso")
    let datos = new FormData() 
    console.log(name[0].name)

    datos.append(name[0].name, name[0].value.toLowerCase())
    datos.append("funcion", "olvidePwd")

    fetch("php/user.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("respuesta").innerHTML= data
    })
    return false;
}

function actualizar(form, cedula){
    console.log("act")

    let datos = new FormData() 
    let arr = Object.values(form)

    datos.append(arr[0].name, arr[0].value)
    datos.append(arr[1].name, arr[1].value)
    datos.append("cedula", cedula)

    datos.append("funcion", "cambiarContraseña")

    fetch("../../php/user.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("respuesta").innerHTML= data
    })
    return false;
}