function Preguntas() {
  var pregunta = confirm("¿Desea eliminar el registro?");
  if (pregunta) {
    console.log("se elimino");
  } else {
    console.log("no se elimino");
  }
  return pregunta;

  
}

function Hola(id) {
  var idvalor = document.getElementById("id" + id).value;
  var nombre = document.getElementById("nombre" + id).value;
  var marca = document.getElementById("marca" + id).value;

  document.getElementById("nombre").value = nombre;
  document.getElementById("marca").value = marca;
    document.getElementById("id_arti").value = idvalor;

    
  console.log(idvalor, nombre, marca);
}

function Ocultar(){

  // guardo el valor de id en la variable miBoton
  const boton1 = document.getElementById("miBoton");
  // guardo el valor de id en la variable boton2
  const boton2 = document.getElementById("boton2");

  // si el boton1 es clickeado se oculta el boton2

  boton1.addEventListener("click", () => {
    boton2.style.display = "none";
    console.log("hola");
  });
  document.getElementById("boton2").style.display = "none";
  

}

$(function () {
  console.log("jquery");
});
