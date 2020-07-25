console.log("funcionando")
function Garantia(form)

{
form.tipo.disabled = false;
form.valorG.disabled = false;
form.ubicacionG.disabled= false;
form.cedulaF.disabled = true;

}

function Fiador(form)
{
form.tipo.disabled = true;
form.valorG.disabled = true;
form.ubicacionG.disabled= true;
form.cedulaF.disabled = false;
}