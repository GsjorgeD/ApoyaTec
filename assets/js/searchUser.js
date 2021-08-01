$(buscar_datos());

function buscar_usuario(consulta){
    $.ajax({
        type: "POST",
        url: 'pagesBD/buscar.php',
        data: {consulta: consulta},
        dataType: "html",
    })
    .done(function(respuesta) {
        $("#datos").html(respuesta);
    })
    .fail(function() {
        console.log("Error");
    })
}