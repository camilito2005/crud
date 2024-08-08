// funcion de jquery para cargar el documento  y ejecutar la funcion
Listar(); //se manda a llamar a la funcion Listar


$(function () {
  //funcion de jquery

  

  $("#search").keyup(function () {
    //funcion de jquery para buscar en tiempo real

    if ($("#search").val()) {
      //si el campo de busqueda tiene algo

      let search = $("#search").val(); //se guarda en la variable search

      console.log(search); // se imprime en consola

      $.ajax({
        //funcion de jquery para hacer peticiones ajax

        url: "./articulos/articulos.php?accion=buscar", //se manda a llamar al archivo articulos.php

        type: "POST", //se manda a llamar al metodo post

        data: { search }, //se manda a llamar a la variable search

        success: function (response) {
          //si la peticion es exitosa se ejecuta la funcion
          console.log(response); //se imprime en consola la respuesta de la peticion

          let task = JSON.parse(response); //se guarda en la variable task la respuesta de la peticion

          console.log(task); //se imprime en consola la variable task

          let template = "";

          task.forEach((task) => {
            //se recorre el arreglo task
            template += `
            <tr> 
            <td>${task.id}
            <td>${task.nombre}
            <td>${task.marca}
            <td>
            <button id="eliminar" class="eliminar">Eliminar</button>
            <td id="id">
                      <button id="Boton" id="miBoton">modificar</button>
              </td>
            </td>
            </tr>
            `;

            $("#taks").html(template);
            //$("#result").show();
          });
        },
      });
    }
  });
});

$("#task-form").submit(function (e) {
  e.preventDefault(); //se cancela el evento

  const postData = {
    //se guarda en la variable postData
    //se manda a llamar al id_arti
    nombre: $("#nombre").val(), //se manda a llamar al nombre
    marca: $("#marca").val(), //se manda a llamar al marca
  };


  console.log(postData); //se imprime en consola la variable postData

  $.post(
    "./articulos/articulos.php?accion=guardar",
    postData,
    function (response) {
      Listar();
      //se manda a llamar al archivo articulos.php
      console.log(response); //se imprime en consola la respuesta de la peticion
      $("#task-form").trigger("reset"); //se limpia el formulario
    }
  );
  e.preventDefault(); //se cancela el evento
});

function Listar() {
  $.ajax({
    url: "./ver.php",
    type: "GET",
    success: function (response) {
      //llamo a la funcion success y le paso la variable response
      //console.log(response); //imprimo en consola la variable response
      var tasks = JSON.parse(response); //se guarda en la variable tasks la respuesta de la peticion
      console.log(tasks);
      let template = "";
      tasks.forEach((task) => {
        template += `
              <tr filasId="${task.id_arti}">
              <td >${task.id_arti}
              <td >${task.nombre}
              <td>${task.marca}
              <td>
              <button id="eliminar" class="eliminar" >Eliminar</button>
              <td id="$id">
                      <button class="modificar" id="Boton" id="miBoton">modificar</button>
              </td>
              </tr>
              `;
      });
      $("#taks").html(template);
    },
    error: function (xhr, status, error) {
      console.error("Error en la petición AJAX:", error);
    },
  });
}

$(document).on("click", ".eliminar", function () {
  if (confirm("¿estas seguro que desea elimar esa vaina?")) {
    // mi documento escuchamos el evento click solo de las clases que tengan la clase eliminar
    //console.log("click en eliminar"); //se imprime en consola
    let element = $(this)[0].parentElement.parentElement; //atraves de jquery selecciono el elemento clickeado
    //console.log(element); //se imprime en consola
    let id = $(element).attr("filasId"); //se elimina el elemento
    console.log(id);
    $.post("./eliminar.php?accion=eliminar", { id }, function (response) {
      console.log(response);
      Listar();
    });
  }
});

$(document).on("click", ".modificar", function () {
  //console.log("click en modificar");
  //$("#boton2").hide(); //se oculta el boton2

  let element = $(this)[0].parentElement.parentElement; //atraves de jquery selecciono el elemento clickeado

  //console.log(element); //se imprime en consola

  let id_arti = $(element).attr("filasId"); //se elimina el elemento

  console.log(id_arti); //se imprime en consola

  $.post("./modificar.php?accion=modificar", { id_arti }, function (response) {
    //console.log(response);
    let task = JSON.parse(response); //se guarda en la variable task la respuesta de la peticion
    console.log(task);
    $("#nombre").val(task.nombre); //se manda a llamar al nombre
    $("#marca").val(task.marca); //se manda a llamar al marca
    //$("#id_arti").val(task.id_arti); //se manda a llamar al id_arti

    edit = true; //se cambia la variable edit a true
  });
});
