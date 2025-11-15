
function cerrarVentana1() {
  document.getElementById('contenido-ventana').style.display = 'none';
  document.getElementById('formulario-reserva').style.display='none';
  document.getElementById('contenido').style.display='none';
};
console.log("funciona");
console.log("funciona");
var url="reservar.php";



function abrirFormulario(){
  document.getElementById('contenido').style.display='flex';
  document.getElementById('contenido-ventana').style.display='flex';
  document.getElementById('formulario-reserva').style.display='flex';

};

function cancelarReserva(){
  document.getElementById('cancelar-reserva').style.display='flex';
  document.getElementById('contenedor-cancelar').style.display='flex';
}


function confirmarCancelacion(){
  event.preventDefault();
  let idReserva = document.getElementById('idReserva').value;
  console.log(idReserva); 
  var params ='idReserva='+idReserva;
  var url = "/Includes/funciones.php"
  fetch(url,{
    method: 'POST' ,
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: params
  }).then(function(response){

    return response.text();
  }).then(function(textData){

    document.querySelector('.mensaje-reservas').innerHTML=textData;
    document.querySelector('form').style.display='none';
    location.reload();
  })
}
function cerrarVentana(){
  document.getElementById('cancelar-reserva').style.display = 'none';
  document.getElementById('contenedor-cancelar').style.display='none';
}






