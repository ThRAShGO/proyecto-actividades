/* global $ */

(function() {
    
    var insert = false;
    var page = 1;
    var user = null;
    var objetoTabla;
    var objetoTablaAUX;
    var objetoTablaActividades;
    var objetoTablaActividadesAUX;
    var usuarioBorrar;
    var actividadBorrar;
    var userActivo;
    /* código inmediatamente ejecutado */    
    // $('#divLogout').hide();
    $('#contenedor_perfiles').hide();
    $('#divRowPage').hide();
    $('#login_bg').show();
    $(".filters th input").prop("disabled", "true");
    
    
    
    $.ajax({
            url: 'index.php',
            data: {
                ruta: 'ajaxlogin',
                accion: 'islogin'
            },
            type: 'GET',
            dataType: 'json'
        }).done(function(objetoJson) {
            login(objetoJson);
        });
        
        
    $.ajax({
            url: 'index.php',
            data: {
                ruta: 'ajaxlogin',
                accion: 'getuseractivo',
            },
            type: 'GET',
            dataType: 'json'
        }).done(function(objetoJson) {
            if(objetoJson.login == -2){
                // "No hacemos nada"
            }else{
               actualizarPerfil(objetoJson);  
            }
           
        });
    
    //$("#ayudaUsuario").hide();
    //$("#ayudaContrasenia").hide();
    
     /* eventos inmediatamente asignados ACADEMIA */
     
     
        $('#btLogin').on('click', function() {
          //var email = $('#usuarioLogin').val();
          var contrasenia = $('#contraseniaLogin').val();
          userActivo = $('#usuarioLogin').val()
    
          //$('#pleaseWaitDialog').modal();
         /* Consulta de Logueo y volcado de profesores*/
        $.ajax({
            url: 'index.php',
            data: {
                ruta: 'ajaxlogin',
                accion: 'login',
                email: userActivo,
                contrasenia: contrasenia
            },
            type: 'GET',
            dataType: 'json'
        }).done(function(objetoJson) {
            login(objetoJson);
        });
    
        
    });
    
    $('#mytabs li:last-child').on('click', function(){
        $('#tablaActividad').removeClass('dtr-inline');
        if($('#tablaActividad').hasClass('dtr-inline-collapsed')){
        $('#tablaActividad').removeClass('dtr-inline-collapsed');   
        }
       
    });
    
    $('#btEnviarOut').on('click', function(){
        $.ajax({
            url: 'index.php',
            data: {
                ruta: 'ajax',
                accion: 'logout'
            },
            type: 'GET',
            dataType: 'json'
        }).done(function(objetoJson) {
            logout();
        });
    });
    
    $('#btSiModal').on('click', function() {
        $.ajax({
            url:'index.php', 
            data: {
                ruta: 'ajaxlogin', 
                accion: 'deleteuser', 
                email: usuarioBorrar
            },
            type: 'GET',
            dataType: 'json'
        }).done(function (json) {
            $('#pleaseWaitDialogDelete').modal();
            objetoTabla.destroy();
            if(json.r > 0) {
                funcionTimer = setTimeout(function (){
                    $('#pleaseWaitDialogDelete').modal('hide');
                }, 3500);
                actualizarProfesores(json, userActivo);
                $('#modal-delete').modal('hide');
            }
        });
    });
    
    $('#btSiModalActividades').on('click', function() {
        $.ajax({
            url:'index.php', 
            data: {
                ruta: 'ajaxactividades', 
                accion: 'deleteactividad', 
                idActividad: idActividadBorrar
            },
            type: 'GET',
            dataType: 'json'
        }).done(function (json) {
            $('#pleaseWaitDialogDelete').modal();
            objetoTabla.destroy();
            if(json.r > 0) {
                funcionTimer = setTimeout(function (){
                    $('#pleaseWaitDialogDelete').modal('hide');
                }, 3500);
                actualizarProfesores(json, userActivo);
                $('#modal-delete-actividades').modal('hide');
            }
        });
    });

    // $('#btEditUser').on('click', function() {
    //     var email = $('#editemail').val();
    //     var pkemail = $('#pkeditemail').val();
    //     var password = $('#editpassword').val();
    //     ajax('index.php', {ruta: 'ajax', accion: 'edituser', email: email, pkemail: pkemail, password: password}, function (json) {
    //         if(json.r > 0) {
    //             actualizar(json);
    //             $('#modal-edit').modal('hide');
    //         }
    //     });
    // });

    // $('#btEnviar').on('click', function() {
    //     $('#pleaseWaitDialog').modal();
    //     ajax('index.php', {ruta: 'ajax', accion: 'login', email: $('#iptEmail').val(), password: $('#iptPassword').val()}, function (json) {
    //         login(json);
    //     });
    // });

    // $('#btEnviarOut').on('click', function() {
    //     ajax('index.php', {ruta: 'ajax', accion: 'logout'}, function (json) {
    //         logout();
    //     });
    // });

    // $('#btInsertUser').on('click', function() {
    //     var email = $('#email').val();
    //     var password = $('#password').val();
    //     if(canInsert && isCorreo(email) && isPassword(password)) {
    //         ajax('index.php', {ruta: 'ajax', accion: 'insertuser', email: email, password: password}, function (json) {
    //             if(json.r > 0){
    //                 actualizar(json);
    //                 $('#modal-insert').modal('hide');
    //             }
    //         });
    //     }
    // });

    /* funciones */

    function actualizarProfesores (objetoJson, email){
        $('#cuerpoTabla').empty();
        $('.profile').empty();
        for(var i = 0; i < objetoJson.users.length; ++i){
            if(objetoJson.users[i].email != email){
                $('#cuerpoTabla').append(getTextTablaProfesores(objetoJson.users[i]));
            }else{
                $('.profile').append(getTextProfesores(objetoJson.users[i]));
            }
        }
        addEventToDeleteUserLink();
        objetoTabla = $('#tablaProfesores').DataTable();
        objetoTablaAUX = $('#tablaProfesores');
        $('#tablaProfesores_wrapper div').first().hide();
        
    }
    
    function actualizarPerfil (objetoJson){
       $('.profile').append(getTextProfesores(objetoJson.usuarioactivo));
    }
    
    function actualizarActividades (objetoJson){
        $('#cuerpoTabla2').empty();
        for(var i = 0; i < objetoJson.actividades.length; ++i){
                $('#cuerpoTabla2').append(getTextTablaActividades(objetoJson.actividades[i]));
            }
        addEventToDeleteActividadLink();
        objetoTablaActividades = $('#tablaActividades').DataTable();
        objetoTablaActividadesAUX = $('#tablaActividades');
        $('#tablaActividades_wrapper div').first().hide();

    }
    
    function addEventToPagesLinks(){
        $('.page-link').on('click', function(){
            var pagina = $(this).data('page');
            if(pagina == 'p+1') {
                page++;
            } else if(pagina == 'p-1') {
                page--;
            } else {
                page = pagina;
            }
            if(page<1) {
                page = 1;
            }
        });
    }
    
    function getPagination(page, pages){
        var s = '';
        for( var i = 1; i <= pages; ++i){
            s+= '<li class="page-item pagina-borrar"><a class="page-link" href="#" data-page="'+i+'">'+i+'</a></li>';
        }
        return s;
    }
    
    function getTextProfesores(user){
        var foto;
        if(user.foto === null){
            foto = 'profile_default.jpg';
        }else{
            foto = user.foto;
        }
        
        var s = 
		'<p class="text-center"><img id ="picprofile" src="img/profesores/'+foto+'" alt="Teacher" class="img-circle styled"></p>' +
                 '<ul>'+
                     '<li>Email <strong class="pull-right">'+user.email+'</strong> </li>'+
                     '<li>Departamento <strong class="pull-right">'+user.departamento+'</strong></li>'+
                     '<li>Telephone  <strong class="pull-right">+34 004238423</strong></li>'+
                     '<li>Students <strong class="pull-right">42</strong></li>'+
                     '<li>Lessons <strong class="pull-right">12</strong></li>'+
                     '<li>Courses <strong class="pull-right">15</strong></li>'+
                '</ul>';
         return s;
    }
    
    function getTextTablaProfesores(usuario){
        var foto;
        if(usuario.foto === null){
            foto = 'profile_default.jpg';
        }else{
            foto = usuario.foto;
        }
        var s =
        '<tr>'+
        '<td class = "centerdata">'+usuario.email+'</td>'+
        '<td class = "centerdata" class="department">'+usuario.departamento+'</td>'+
        '<td class = "centerdata"><p id = "pe_raro" class="text-center"><img class="img-circle styled" src="img/profesores/'+foto+'" id ="picprofilemin"></p></td>'+
        '<td class = "centerdata">'+
            '<a href="#" class="button_top hidden-xs edit btEditarUsuario" href="#" data-user="'+ usuario.email +'" data-toggle="modal" data-target="#modal-edit" role="button"> &nbsp; Editar  &nbsp;</a>'+
            '<a href="#" class="button_top hidden-xs delete btBorrarUsuario" href="#" data-user="'+ usuario.email +'" data-toggle="modal" data-target="#modal-delete" role="button">Borrar</a>'+
        '</td>'+
        '</tr>';
        return s;
    }
    
    
    function getTextTablaActividades(actividad){
        var fechatruncada = jQuery.trim(actividad.fechaFin).substring(10, actividad.fechaFin.length );
        var s =
        '<tr>'+
        '<td class = "centerdata" class="tittle">'+actividad.titulo+'</td>'+
        '<td class = "centerdata">'+actividad.email+'</td>'+
        '<td class = "centerdata malditoGrupo">'+actividad.idGrupo+'</td>'+
        '<td class = "centerdata">'+actividad.fechaInicio + " / " + fechatruncada +'</td>'+
        '<td class = "centerdata">'+
            '<a href="#" class="button_top hidden-xs edit btEditarActividad" href="#" data-idactividad="' + actividad.idActividades + '" data-actividad="'+ actividad.titulo +'" data-toggle="modal" data-target="#modal-edit" role="button"> &nbsp;Editar &nbsp;</a>'+
            '<a href="#" class="button_top hidden-xs deleteActividad btBorrarActividad" href="#" data-idactividad="' + actividad.idActividades + '" data-actividad="'+ actividad.titulo +'" data-toggle="modal" data-target="#modal-delete-actividades" role="button">Borrar</a>'+
        '</td>'+
        // '<td class = "centerdata">'+actividad.fechaFin+'</td>'+
        '</tr>';
        return s;
    }
    
    // function getText(user){
    //     var s = 
    //     '<div class="col-md-4">'+
    //         '<h2>'+ user.email +'</h2>'+
    //         '<p>'+user.password+'</p>'+
    //         '<p><a class="btn btn-default edit" href="#" data-user="'+ user.email +'" data-toggle="modal" data-target="#modal-edit" role="button">Editar &raquo;</a></p>'+
    //         '<p><a class="btn btn-default" href="#" role="button">Editar &raquo;</a></p>'+
    //         '<p><a class="btn btn-default delete" href="#" data-user="'+ user.email +'" data-toggle="modal" data-target="#modal-delete" role="button">Borrar &raquo;</a></p>'+
    //      '</div>';
    //      return s;
    // }

    function login(objetoJson){
        // console.log(objetoJson);
        if(objetoJson.login == "1"){
            // $("#ayudaUsuario").hide();
            // $("#ayudaContrasenia").hide();
            successLogin();
            $('#pleaseWaitDialog').modal();
            // $('#divLogin').css('display','none');
            // $('#divLogin').hide();
            $('#login_bg').hide();
            $('#contenedor_perfiles').show();
            $('#rellenadorLogin').html(objetoJson.logueo)
            // $('#divLogout').show();
            // $('#divUser').text(objetoJson.info.nombre);
            // $('#divOcultar').hide();
            // $('#previous').after(getPagination(objetoJson.page, objetoJson.pages));
            actualizarProfesores(objetoJson, userActivo);
                 /* Consulta de actividades y volcado de las mismas*/
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'ajaxactividades',
                    accion: 'pediractividades'
                },
                type: 'GET',
                dataType: 'json'
            }).done(function(objetoJson) {
                procesarActividades(objetoJson);
                $('#pleaseWaitDialog').modal('hide');
            });
        } else if(objetoJson.login == "0") {
            successLogin();
            showErrorUsuario();
        } else if (objetoJson.login == "-1"){
            successLogin();
            showErrorContrasenia();
        } //else {
            
        //}
    }
    
    function procesarActividades(objetoJson){
            // $('#divLogin').css('display','none');
            // $('#divLogin').hide();
            // $('#divLogout').show();
            // $('#divUser').text(objetoJson.info.nombre);
            // $('#divOcultar').hide();
            // $('#previous').after(getPagination(objetoJson.page, objetoJson.pages));
            actualizarActividades(objetoJson);
    }

    function logout(){
        $('#divLogin').show();
        $('#divLogout').hide();
        $('#divOcultar').show();
        $('#divRowPage').hide();
        $('#divRowUsuarios').hide();
        $('#divRowUsuarios').empty();
        $('.pagina-borrar').remove();
        $('#divUser').empty();
    }
    
    function addEventToDeleteUserLink() {
        $('.delete').on('click', function() {
            usuarioBorrar = $(this).data('user');
            $('#nombreDelete').text(usuarioBorrar);
        });
    }
    
    
    function addEventToDeleteActividadLink() {
        $('.deleteActividad').on('click', function() {
            actividadBorrar = $(this).data('actividad');
            $('#nombreDelete').text(actividadBorrar);
            idActividadBorrar = $(this).data('idactividad');
        });
    }
    
    ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////
    ///////////////// Filtrado de Tablas//////////////////////////


   /* global objetoTabla */
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
            objetoTabla.destroy();
            objetoTablaActividades.destroy();
            objetoTabla = $('#tablaProfesores').DataTable( {
                "ordering": false
            } );
            objetoTablaActividades = $('#tablaActividades').DataTable( {
                "ordering": false
            } );
            $('#tablaProfesores_wrapper div').first().hide();
            $('#tablaActividades_wrapper div').first().hide();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
            objetoTabla.destroy();
            objetoTablaActividades.destroy();
            objetoTabla = $('#tablaProfesores').DataTable( {
                "ordering": true
            } );
             objetoTablaActividades = $('#tablaActividades').DataTable( {
                "ordering": true
            } );
            $('#tablaProfesores_wrapper div').first().hide();
            $('#tablaActividades_wrapper div').first().hide();
    }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
    
    /* === ARREGLO CSS TABLA RESPONSIVE MEDIANTE JQUERY === */
    $('#mytabs li:last-child').on('click', function() {
        $('#profile_teacher').removeClass("visible");
    });
    
    var cont = 0;
    var funcionTimer;
    $('#mytabs li:first-child').on('click', function() {
        $('#pleaseWaitDialog').modal();
        objetoTablaActividades.destroy();
        objetoTablaActividades = $('#tablaActividades').DataTable( {
            "ordering": false
        });
        $('#tablaActividades_wrapper div').first().hide();
        if(cont <= 1){
            cont++;
            funcionTimer = setTimeout(function (){
                objetoTablaActividades.destroy();
                objetoTablaActividades = $('#tablaActividades').DataTable( {
                    "ordering": false
                });
                $('#tablaActividades_wrapper div').first().hide();
                $('#mytabs li:first-child').click();   
            }, 500);
        }else {
            clearTimeout(funcionTimer);
            cont = 0;
             $('#pleaseWaitDialog').modal('hide');
        }
            
    });
    
    ////////////////////////////////////////////////////////////////
    ///////////////////Efectos Panel Errores///////////////////////
    
    

        

}());