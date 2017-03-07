/* global $ */
(function() {
     $.ajax({
        url: '../actividades/index.php',
        data: {
           ruta: 'ajaxactividades',
            accion: 'pediractividades'
        },
        type: 'GET',
        dataType: 'json',
    }).done(function (objetoJson){
         console.log(objetoJson);
    });
    
    function procesarActividades(objetoJson){
        actualizarActividades(objetoJson);
    }
    
    function actualizarActividades (objetoJson){
        $('#cuerpoTabla2').empty();
        for(var i = 0; i < objetoJson.actividades.length; ++i){
                $('#cuerpoTabla2').append(getTextTablaActividades(objetoJson.actividades[i]));
            }
        addEventToDeleteActividadLink();
        addEventToEditActividadLink();
        addEventToEditNormalUserLink();
        addEventToInsertActividadNormalUserLink();
        addEventToEditAdminUserLink();
        objetoTablaActividades = $('#tablaActividades').DataTable();
        objetoTablaActividadesAUX = $('#tablaActividades');
        $('#tablaActividades_wrapper div').first().hide();
    }
    
}());