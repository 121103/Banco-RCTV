console.log("funcinando auxiliar")

function mostrar(user){
    console.log("mostrar")
    document.getElementById("respuestaUsuario").innerHTML= ""
    let datos = new FormData() 

    datos.append("funcion", "mostrar")
    datos.append("auxiliar", user)

    fetch("../../php/soli_auxiliar.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("respuestaSolicitud").innerHTML= data
        document.getElementById("codigo").value = ""
    })
    return false;
}

function enviar(codigo, user){
    console.log("funciona enviar")
    console.log(user)
    document.getElementById("respuestaUsuario").innerHTML= ""
    document.getElementById("codigo").value = ""
    let datos = new FormData() 

    //console.log(arr[0])
    datos.append("funcion", "enviar")
    datos.append("auxiliar", user)
    datos.append("codigo_soli", codigo)

    fetch("../../php/soli_auxiliar.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("respuestaSolicitud").innerHTML= data
    })
    return false;
}

function rechazar(codigo, user){
    console.log("funciona r")
    document.getElementById("respuestaUsuario").innerHTML= ""
    document.getElementById("codigo").value = ""
    let datos = new FormData() 

    //console.log(arr[0])
    datos.append("codigo_soli", codigo)
    datos.append("auxiliar", user)
    datos.append("funcion", "rechazar")

    fetch("../../php/soli_auxiliar.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("respuestaSolicitud").innerHTML= data
    })
    return false;
}

function buscar(form){
    console.log("funciona buscar")
    let datos = new FormData() 
    let arr = Object.values(form)

    //console.log(arr[0].value)
    datos.append(arr[0].name, arr[0].value)
    datos.append("funcion", "buscar")
    
    fetch("../../php/soli_auxiliar.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("respuestaUsuario").innerHTML= data
        document.getElementById("codigo").value = ""
    })
    return false;
}

function estudiar(codigo, user){
    console.log("fb")
    let datos = new FormData() 
    document.getElementById("respuestaUsuario").innerHTML= ""
    document.getElementById("codigo").value = ""
    //console.log(arr[0].value)
    datos.append("codigo", codigo)
    datos.append("auxiliar", user)
    datos.append("funcion", "estudiar")
    
    fetch("../../php/soli_auxiliar.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("respuestaSolicitud").innerHTML= data
    })
    return false;
}

function servicio(form){
    console.log("serv")

    document.getElementById("cronograma").innerHTML = ""
    document.getElementById("codigo_serv").innerHTML = ""
    let datos = new FormData() 
    let arr = Object.values(form)

    datos.append(arr[0].name, arr[0].value)
    datos.append("funcion", "servicio")

    fetch("../../php/soli_auxiliar.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("resCliente").innerHTML= data[0]
        document.getElementById("resServicio").innerHTML= data[1]
    })
    return false;
}

function cronograma(codigo){
    console.log("cronogr")
    document.getElementById("codigo_serv").innerHTML = "<h6>Cronograma</h6>Codigo del servicio: "+codigo
    
    let datos = new FormData() 

    datos.append("codigo_soli", codigo)
    datos.append("funcion", "buscarCronograma")

    fetch("../../php/soli_auxiliar.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("cronograma").innerHTML = data
    })
    return false;
}

function pagoCuota(cronograma, cuota){
    console.log("pago")
    
    let datos = new FormData() 

    datos.append("cronograma", cronograma)
    datos.append("cuota", cuota)
    datos.append("funcion", "pagarCuota")

    fetch("../../php/soli_auxiliar.php", {
        method: "POST",
        body: datos
    })
    .then ( res => res.json())
    .then ( data => {
        document.getElementById("cronograma").innerHTML = data
    })
    return false;
}