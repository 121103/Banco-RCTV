console.log("jefe decredito")

function mostrar(form){
    console.log("mostrar")
    document.getElementById("codigo_serv").innerHTML = ""
    document.getElementById("respuestaCronograma").innerHTML = ""
    document.getElementById("respuestaCliente").innerHTML= ""
    document.getElementById("respuestaSolCliente").innerHTML= ""
    document.getElementById("respuestaSolicitud").innerHTML= ""
    let datos = new FormData() 
    
    datos.append("funcion", "mostrar")

    fetch("../../php/jefecred.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("respuestaSolicitudes").innerHTML= data
        document.getElementById("id").value = ""
    })
    return false;
}

function aprobar(id){
    console.log("funciona aprobarr")
    document.getElementById("respuestaCliente").innerHTML= ""
    document.getElementById("respuestaSolCliente").innerHTML= ""
    document.getElementById("respuestaSolicitud").innerHTML= ""
    document.getElementById("codigo_serv").innerHTML = ""
    document.getElementById("respuestaCronograma").innerHTML = ""
    let datos = new FormData() 

    //console.log(arr[0])
    datos.append("codigo_soli",id)
    datos.append("funcion", "aprobar")

    fetch("../../php/jefecred.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("respuestaSolicitudes").innerHTML= data
    })
    return false;
}

function rechazar(id){
    console.log("funciona rechazar")
    document.getElementById("respuestaCliente").innerHTML= ""
    document.getElementById("respuestaSolCliente").innerHTML= ""
    document.getElementById("respuestaSolicitud").innerHTML= ""
    document.getElementById("codigo_serv").innerHTML = ""
    document.getElementById("respuestaCronograma").innerHTML = ""
    let datos = new FormData() 

    //console.log(arr[0])
    datos.append("codigo_soli",id)
    datos.append("funcion", "rechazar")

    fetch("../../php/jefecred.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("respuestaSolicitudes").innerHTML= data
    })
    return false;
}

function buscarCliente(form){
    console.log("funciona bC")
    document.getElementById("respuestaSolicitudes").innerHTML= ""
    document.getElementById("codigo_serv").innerHTML = ""
    document.getElementById("respuestaCronograma").innerHTML = ""
    let datos = new FormData() 
    let arr = Object.values(form)

    //console.log(arr[0])
    datos.append(arr[0].name, arr[0].value)

    datos.append("funcion", "buscarCliente")

    fetch("../../php/jefecred.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("respuestaCliente").innerHTML= data[0]
        document.getElementById("respuestaSolCliente").innerHTML= data[1]
    })
    return false;
}

function estudiar(codigo){
    console.log("funciona bs")
    document.getElementById("respuestaCliente").innerHTML= ""
    document.getElementById("respuestaSolCliente").innerHTML= ""
    document.getElementById("respuestaSolicitudes").innerHTML= ""
    document.getElementById("codigo_serv").innerHTML = ""
    document.getElementById("respuestaCronograma").innerHTML = ""
    let datos = new FormData() 

    //console.log(arr[0])
    datos.append("codigo_soli", codigo)
    datos.append("funcion", "buscarSolicitud")

    fetch("../../php/jefecred.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("respuestaSolicitud").innerHTML= data
    })
    return false;
}

function cronograma(codigo){
    console.log("crono")
    document.getElementById("codigo_serv").innerHTML = "<h6>Cronograma</h6>Codigo del servicio: "+codigo
    
    let datos = new FormData() 

    datos.append("codigo_soli", codigo)
    datos.append("funcion", "buscarCronograma")

    fetch("../../php/jefecred.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("respuestaCronograma").innerHTML = data
    })
    return false;
}
