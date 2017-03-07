/* global $ */

(function() {
    
    var insert = false;
    var user = null;
    
    var objetoTabla;
    var objetoTablaAUX;
    var objetoTablaActividades;
    var objetoTablaActividadesAUX;
    var objetoTablaGrupos;
    var objetoTablaGruposAUX;
    
    var usuarioBorrar;
    var idActividadBorrar;
    var idGrupoBorrar;
    
    var userActivo;
    var adminProfesor;

    
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
            if(objetoJson.login == -2){
                login(objetoJson);
                $('#top_nav').html('<li><a href="about_us.html">Sobre Nosotros</a></li>'+
                '<li><a href="apply.html">Wizard Apply</a></li>'+
                '<li><a href="register.html">Registro</a></li>'
                );
            }else{
                $('#top_nav').html('<li class="myli"> Logueado como: <a class="identificador" href="#"> ' + ' ' + userActivo + '</a></li>');
                userActivo = objetoJson.user.email;
                adminProfesor = objetoJson.user.admin;
                actualizarPerfil(objetoJson);
                login(objetoJson);
            }
        });
        
        
  
    
     /* eventos inmediatamente asignados ACADEMIA */  /* eventos inmediatamente asignados ACADEMIA */
     /* eventos inmediatamente asignados ACADEMIA */  /* eventos inmediatamente asignados ACADEMIA */
        
        
        $('#submit-newsletter').on('click', function(e){
            var email = $('#email_newsletter');
            if(!validarEmail(email)){
                shakeForm();
                e.preventDefault();
            }else{
            }
        
        });
        
        /*Poner fechas de los datetime local*/
         $('#datetimeActIniInsert').on('click', function(e){
             var time = moment().format();
             var timeformated = time.substring(0, 16);
            $('#datetimeActIniInsert').val(timeformated);

        });
        
          $('#datetimeActFinInsert').on('click', function(e){
             var time = moment().format();
             var timeformated = time.substring(0, 16);
            $('#datetimeActFinInsert').val(timeformated);

        });
        $('#datetimeActIniEdit').on('click', function(e){
             var time = moment().format();
             var timeformated = time.substring(0, 16);
            $('#datetimeActIniEdit').val(timeformated);

        });
        
          $('#datetimeActFinEdit').on('click', function(e){
             var time = moment().format();
             var timeformated = time.substring(0, 16);
            $('#datetimeActFinEdit').val(timeformated);

        });
        $('#datetimeActIniNormalUserInsert').on('click', function(e){
             var time = moment().format();
             var timeformated = time.substring(0, 16);
            $('#datetimeActIniNormalUserInsert').val(timeformated);

        });
        
          $('#datetimeActFinNormalUserInsert').on('click', function(e){
             var time = moment().format();
             var timeformated = time.substring(0, 16);
            $('#datetimeActFinNormalUserInsert').val(timeformated);

        });
        $('#datetimeActIniNormalUser').on('click', function(e){
             var time = moment().format();
             var timeformated = time.substring(0, 16);
            $('#datetimeActIniNormalUser').val(timeformated);

        });
        
          $('#datetimeActFinNormalUser').on('click', function(e){
             var time = moment().format();
             var timeformated = time.substring(0, 16);
            $('#datetimeActFinNormalUser').val(timeformated);

        });
         /* FIN DE: Poner fechas de los datetime local*/
        
    
     
        $('#btLogin').on('click', function(e) {
            if(validar(e)){
                var contrasenia = $('#contraseniaLogin').val();
                userActivo = $('#usuarioLogin').val()
    
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
                    if(objetoJson.login == 1){
                      adminProfesor = objetoJson.user.admin;  
                    }
                    login(objetoJson);
                }); 
                    }
    });
    
    $('#mytabs li:last-child').on('click', function(){
        $('#tablaActividad').removeClass('dtr-inline');
        if($('#tablaActividad').hasClass('dtr-inline-collapsed')){
        $('#tablaActividad').removeClass('dtr-inline-collapsed');   
        }
       
    });
    
    $('#btModalCambios').on('click', function(){
        $('#modal-user-changed').modal('hide');
        window.location="https://actividades-thrashgo.c9users.io/aplicacion/index.php?ruta=ajaxlogin&accion=logout";
        
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
    
    
    // EDICION Y BORRADO DE USUARIOS // EDICION Y BORRADO DE USUARIOS
    // EDICION Y BORRADO DE USUARIOS // EDICION Y BORRADO DE USUARIOS
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
    
    $('#btEditarModal').on('click', function(e) {
        if(validarModalEditProfileAdmin(e)){
            var email = $('#editemail').val();
            var emailpk = $('#pkeditemail').val();
            var password = $('#editpassword').val();
            var foto = $('#file-7').val().replace(/C:\\fakepath\\/i, '');
            var departamento = $( "#editdepartamento option:selected" ).text();
            var admin = $( "#editadmin option:selected" ).val();
            var f = $('#formedituser');
            var formData = new FormData(f);
            var archivo = document.getElementById("file-7");
            formData.append('archivo', archivo.files[0]);
            
             $.ajax({
                url:'index.php', 
                data: {
                    ruta: 'ajaxlogin', 
                    accion: 'edituser', 
                    email: email,
                    contrasenia: password,
                    departamento: departamento,
                    foto: foto,
                    emailpk : emailpk,
                    admin: admin
                },
                type: 'GET',
                dataType: 'json'
            }).done(function (json) {
                $('#pleaseWaitDialog').modal();
                objetoTabla.destroy();
                if(json.r > 0) {
                    if(json.exit == 'yes'){
                        $('#modal-edit').modal('hide');
                        $('#pleaseWaitDialog').modal('hide');
                        actualizarProfesores(json, userActivo);
                        $.ajax({
                            url: 'upload_profesor.php',
                            data: formData,
                            type: 'POST',
                            contentType: false,
                            processData: false
                        });
                        $('#modal-user-changed').modal(
                            {
                                   backdrop: 'static',
                                   keyboard: false
                            });
                    }
                     $.ajax({
                            url: 'upload_profesor.php',
                            data: formData,
                            type: 'POST',
                            contentType: false,
                            processData: false
                        });
                        $('.textoimagen').text('');
                    actualizarProfesores(json, userActivo);
                    $('#modal-edit').modal('hide');
                    $('#pleaseWaitDialog').modal('hide');
                    
                }else{
                    
                }
    
            }); 
        }
    });
    
    $('#btEditarModalUser').on('click', function(e) {
        if(validarEditNormalUser(e)){
               var email = $('#editEmailNormalUser').val();
            var emailpk = $('#pkeditEmailNormalUser').val();
            var password = $('#editPasswordNormalUser').val();
            var foto = $('#file-7-normal-user').val().replace(/C:\\fakepath\\/i, '');
            var departamento = $( "#editDepartamentoNormalUser option:selected" ).text();
            var f = $('#forminsertusernormal');
            var formData = new FormData(f);
             var archivo = document.getElementById("file-7-normal-user");
            formData.append('archivo', archivo.files[0]);
            
             $.ajax({
                url:'index.php', 
                data: {
                    ruta: 'ajaxlogin', 
                    accion: 'edituser', 
                    email: email,
                    contrasenia: password,
                    departamento: departamento,
                    foto: foto,
                    emailpk : emailpk,
                },
                type: 'GET',
                dataType: 'json'
            }).done(function (json) {
                $('#pleaseWaitDialog').modal();
                //objetoTabla.destroy();
                if(json.r > 0) {
                    if(json.exit == 'yes'){
                        $('#modal-edit').modal('hide');
                        $('#pleaseWaitDialog').modal('hide');
                        //actualizarProfesores(json, userActivo);
                        $('#modal-user-changed').modal(
                            {
                                   backdrop: 'static',
                                   keyboard: false
                            });
                    }
                    $.ajax({
                        url: 'upload_profesor.php',
                        data: formData,
                        type: 'POST',
                        contentType: false,
                        processData: false
                    });
                    $('.textoimagen').text('');
                    actualizarProfesores(json, userActivo);
                    $('#modal-edit').modal('hide');
                    $('#pleaseWaitDialog').modal('hide');
                    
                }else{
                    
                }
    
            }); 
        }
        
    });
    
    $('#btInsertModal').on('click', function(e) {
        if(validarModalInsertAdmin(e)){
             var email = $('#insertemail').val();
            var emailpk = $('#pkinsertemail').val();
            var password = $('#insertpassword').val();
            var foto = $('#file-7-insert').val().replace(/C:\\fakepath\\/i, '');
            var departamento = $("#insertdepartamento option:selected" ).text();
            var f = $('#forminsertuser');
            var admin = $("#insertadmin option:selected" ).val();
            var formData = new FormData(f);
             var archivo = document.getElementById("file-7-insert");
            formData.append('archivo', archivo.files[0]);
            
             $.ajax({
                url:'index.php', 
                data: {
                    ruta: 'ajaxlogin', 
                    accion: 'insertuser', 
                    email: email,
                    contrasenia: password,
                    departamento: departamento,
                    foto: foto,
                    admin: admin,
                    emailpk : emailpk,
                },
                type: 'GET',
                dataType: 'json'
            }).done(function (json) {
                $('#pleaseWaitDialog').modal();
                objetoTabla.destroy();
                if(json.r > 0) {
                    $.ajax({
                        url: 'upload_profesor.php',
                        data: formData,
                        type: 'POST',
                        contentType: false,
                        processData: false
                    });
                    $('#insertemail').val('');
                    $('#pkinsertemail').val('');
                    $('#insertpassword').val('');
                    $('#file-7-insert').val('');
                    $('.textoimagen').text('');
                    $( "#insertdepartamento option:selected" ).text();
                    $('#modal-insert').modal('hide');
                    actualizarProfesores(json, userActivo);
                    $('#pleaseWaitDialog').modal('hide');
                    
                }else{
                    
                }
    
            });
        }
    });
    


    // EDICION Y BORRADO DE ACTIVIDADES // EDICION Y BORRADO DE ACTIVIDADES 
    // EDICION Y BORRADO DE ACTIVIDADES // EDICION Y BORRADO DE ACTIVIDADES 
    $('#btSiModalActividades').on('click', function() {
        $.ajax({
            url:'index.php', 
            data: {
                ruta: 'ajaxactividades', 
                accion: 'deleteactividad', 
                idactividades: idActividadBorrar,
                admin: adminProfesor,
                usuarioactivo: userActivo
            },
            type: 'GET',
            dataType: 'json'
        }).done(function (json) {
            $('#pleaseWaitDialogDelete').modal();
            objetoTablaActividades.destroy();
            if(json.r > 0) {
                funcionTimer = setTimeout(function (){
                    $('#pleaseWaitDialogDelete').modal('hide');
                }, 3500);
                actualizarActividades(json);
                $('#modal-delete-actividades').modal('hide');
            }
            
        });
    });
    
    
    $('#btEditarModalActividad').on('click', function(e) {
        if(validarModalEditActividadtAdmin(e)){
             var idactividad = $( "#idactividad").val();
            var titulo = $('#edittitulo').val();
            var descripcion = $('#editdescripcion').val();
            var fechainicio = $('#datetimeActIni').val();
            var fechafin = $('#datetimeActFin').val();
            var email = $('#editprof').val();
            var grupo = $('#editgrupo').val();
            var foto = $('#file-7-actividad').val().replace(/C:\\fakepath\\/i, '');
            var f = $('#formeditactividad');
            var formData = new FormData(f);
            var archivo = document.getElementById("file-7-actividad");
            formData.append('archivo', archivo.files[0]);
             $.ajax({
                url:'index.php', 
                data: {
                    ruta: 'ajaxactividades', 
                    accion: 'editactividad', 
                    idActividades: idactividad,
                    titulo: titulo,
                    descripcion: descripcion,
                    fechaInicio: fechainicio,
                    fechaFin: fechafin,
                    email: email,
                    idGrupo: grupo,
                    foto: foto,
                    admin: adminProfesor,
                    usuarioactivo: userActivo
                },
                type: 'GET',
                dataType: 'json'
            }).done(function (json) {
                $('#pleaseWaitDialog').modal();
                objetoTablaActividades.destroy();
                if(json.r > 0) {
                    $( "#idactividad").val('');
                    $('#edittitulo').val('');
                    $('#editdescripcion').val('');
                    $('#editfechainicio').val('');
                    $('#editfechafin').val('');
                    $('#editprof').val('');
                    $('#editgrupo').val('');
                    $('#editgrupo').val();
                    $('.textoimagen').text('');
                    $('#file-7-actividad').val().replace(/C:\\fakepath\\/i, '');
                    $('#modal-edit-actividades').modal('hide');
                    $.ajax({
                        url: 'upload_actividad.php',
                        data: formData,
                        type: 'POST',
                        contentType: false,
                        processData: false
                    });
                    actualizarActividades(json);
                    $('#pleaseWaitDialog').modal('hide');
                }else{
                    
                }
    
            });  
        }
        
    });
    
    
    
    
    $('#btInsertModalActividad').on('click', function(e) {
        if(validarModalInsetActividadtAdmin(e)){
            var idactividad = $( "#idactividadinsert").val();
            var titulo = $('#inserttitulo').val();
            var descripcion = $('#insertdescripcion').val();
            var fechainicio = $('#datetimeActIniInsert').val();
            var fechafin = $('#datetimeActFinInsert').val();
            var email = $('#insertprof').val();
            var grupo = $('#insertgrupo').val();
            var foto = $('#file-7-actividad-insert').val().replace(/C:\\fakepath\\/i, '');
            var f = $('#forminsertactividad');
            var formData = new FormData(f);
            var archivo = document.getElementById("file-7-actividad-insert");
            formData.append('archivo', archivo.files[0]);
            
            $.ajax({
                url:'index.php', 
                data: {
                    ruta: 'ajaxactividades', 
                    accion: 'insertactividad', 
                    idActividades: idactividad,
                    titulo: titulo,
                    descripcion: descripcion,
                    fechaInicio: fechainicio,
                    fechaFin: fechafin,
                    email: email,
                    idGrupo: grupo,
                    foto: foto
        
                },
                type: 'GET',
                dataType: 'json'
            }).done(function (json) {
                $('#pleaseWaitDialog').modal();
                objetoTablaActividades.destroy();
                if(json.r > 0) {
                    $( "#idactividadinsert").val();
                    $('#inserttitulo').val('');
                    $('#insertdescripcion').val('');
                    $('#insertfechainicio').val('');
                    $('#insertfechafin').val('');
                    $('#insertprof').val('');
                    $('#insertgrupo').val('');
                    $('.textoimagen').text('');
                    $('#file-7-actividad-insert').val('');
                     $.ajax({
                        url: 'upload_actividad.php',
                        data: formData,
                        type: 'POST',
                        contentType: false,
                        processData: false
                    });
                    actualizarActividades(json);
                    $('#pleaseWaitDialog').modal('hide');
                    $('#modal-insert-actividades').modal('hide');
                }else{
                    
                }
    
            }); 
            
        }
    });
    
    $('#btEditarModalActividadNormalUser').on('click', function(e) {
        if(validarEditActividadNormalUser(e)){
            var idactividad = $( "#idactividadunica").val();
            var titulo = $('#edittitulounico').val();
            var descripcion = $('#editdescripcionunico').val();
            var fechainicio = $('#datetimeActIniNormalUser').val();
            var fechafin = $('#datetimeActFinNormalUser').val();
            var email = $('#editemailunico').val();
            var grupo = $('#editgrupounico').val();
            var foto = $('#file-7-actividad-normal-user').val().replace(/C:\\fakepath\\/i, '');
            var f = $('#forminsertactividadnormauser');
            var formData = new FormData(f);
            var archivo = document.getElementById("file-7-actividad-normal-user");
            formData.append('archivo', archivo.files[0]);
             $.ajax({
                url:'index.php', 
                data: {
                    ruta: 'ajaxactividades', 
                    accion: 'editactividad', 
                    idActividades: idactividad,
                    titulo: titulo,
                    descripcion: descripcion,
                    fechaInicio: fechainicio,
                    fechaFin: fechafin,
                    email: email,
                    idGrupo: grupo,
                    foto: foto,
                    admin: adminProfesor,
                    usuarioactivo: userActivo
                },
                type: 'GET',
                dataType: 'json'
            }).done(function (json) {
                $('#pleaseWaitDialog').modal();
                objetoTablaActividades.destroy();
                if(json.r > 0) {
                    $( "#idactividadunica").val('');
                    $('#edittitulounico').val('');
                    $('#editdescripcionunico').val('');
                    $('#datetimeActIniNormalUser').val('');
                    $('#datetimeActFinNormalUser').val('');
                    $('#editemailunico').val('');
                    $('#editgrupounico').val('');
                    $('.textoimagen').text('');
                    $('#file-7-actividad-normal-user').val().replace(/C:\\fakepath\\/i, '');
                    $('#modal-edit-actividades-normaluser').modal('hide');
                    $.ajax({
                        url: 'upload_actividad.php',
                        data: formData,
                        type: 'POST',
                        contentType: false,
                        processData: false
                    });
                    actualizarActividades(json);
                    $('#pleaseWaitDialog').modal('hide');
                }else{
                    
                }
    
            });
        }
        
    });
    
    $('#btInsertModalActividadNormalUser').on('click', function(e) {
        if(validarInsertActividadNormalUser(e)){
            var titulo = $('#inserttituloNormalUser').val();
            var descripcion = $('#insertdescripcionNormalUser').val();
            var fechainicio = $('#datetimeActIniNormalUserInsert').val();
            var fechafin = $('#datetimeActFinNormalUserInsert').val();
            var email = $('#emailCurrentNormalUser').val();
            var grupo = $('#insertgrupoNormalUser').val();
            var foto = $('#file-7-actividad-insertnormal').val().replace(/C:\\fakepath\\/i, '');
            var f = $('#forminsertactividadnormaluser');
            var formData = new FormData(f);
            var archivo = document.getElementById("file-7-actividad-insertnormal");
            formData.append('archivo', archivo.files[0]);
            
             $.ajax({
                url:'index.php', 
                data: {
                    ruta: 'ajaxactividades', 
                    accion: 'insertactividad', 
                    titulo: titulo,
                    descripcion: descripcion,
                    fechaInicio: fechainicio,
                    fechaFin: fechafin,
                    email: email,
                    idGrupo: grupo,
                    foto: foto
        
                },
                type: 'GET',
                dataType: 'json'
            }).done(function (json) {
                $('#pleaseWaitDialog').modal();
                //objetoTablaActividades.destroy();
                if(json.r > 0) {
                    $.ajax({
                        url: 'upload_actividad.php',
                        data: formData,
                        type: 'POST',
                        contentType: false,
                        processData: false
                    });
                    $('#inserttituloNormalUser').val('');
                    $('#insertdescripcionNormalUser').val('');
                    $('#insertfechainicioNormalUser').val('');
                    $('#insertfechafinNormalUser').val('');
                    $('#insertprofNormalUser').val('');
                    $('#insertgrupoNormalUser').val('');
                    $('.textoimagen').text('');
                    $('#file-7-actividad-insertNormalUser').val('');
                    actualizarActividadesUnicas(json);
                    $('#pleaseWaitDialog').modal('hide');
                    $('#modal-insert-actividades-normaluser').modal('hide');
                }else{
                    
                }
    
            });  
        }
        
    });
    
    //EDICION Y BORRADO DE GRUPOS //EDICION Y BORRADO DE GRUPOS
    //EDICION Y BORRADO DE GRUPOS //EDICION Y BORRADO DE GRUPOS
    
    $('#btSiModalGrupos').on('click', function() {
        $.ajax({
            url:'index.php', 
            data: {
                ruta: 'ajaxgrupos', 
                accion: 'deletegrupo', 
                idgrupo: idGrupoBorrar
            },
            type: 'GET',
            dataType: 'json'
        }).done(function (json) {
            $('#pleaseWaitDialogDelete').modal();
            objetoTablaGrupos.destroy();
            if(json.r > 0) {
                funcionTimer = setTimeout(function (){
                    $('#pleaseWaitDialogDelete').modal('hide');
                }, 3500);
                actualizarGrupos(json);
                $('#modal-delete-grupos').modal('hide');
            }
            
        });
    });
    
    
    $('#btEditarModalGrupos').on('click', function(e) {
        if(validarModalEditGrupos(e)){
        var grupo = $( "#idgrupo").val();
        var nivel = $('#editnivel').val();
        var titulacion = $('#edittitulacion').val();
        var promocion = $('#editpromocion').val();
         $.ajax({
            url:'index.php', 
            data: {
                ruta: 'ajaxgrupos', 
                accion: 'editgrupo', 
                idGrupo: grupo,
                nivel: nivel,
                titulacion: titulacion,
                promocion: promocion
     
            },
            type: 'GET',
            dataType: 'json'
        }).done(function (json) {
            $('#pleaseWaitDialog').modal();
            objetoTablaGrupos.destroy();
            if(json.r > 0) {
                $( "#idgrupo").val('');
                $('#editnivel').val('');
                $('#edittitulacion').val('');
                $('#editpromocion').val('');
                $('#modal-edit-grupos').modal('hide');
                actualizarGrupos(json);
                $('#pleaseWaitDialog').modal('hide');
            }else{
                
            }

        }); 
        }
       
    });
    
    $('#btInsertModalGrupos').on('click', function(e) {
        if(validarInsertGruposAdmin(e)){
            var nivel = $('#insertnivel').val();
            var titulacion = $('#inserttitulacion').val();
            var promocion = $('#insertpromocion').val();
             $.ajax({
                url:'index.php', 
                data: {
                    ruta: 'ajaxgrupos', 
                    accion: 'insertgrupo',
                    nivel: nivel,
                    titulacion: titulacion,
                    promocion: promocion
                },
                type: 'GET',
                dataType: 'json'
            }).done(function (json) {
                $('#pleaseWaitDialog').modal();
                objetoTablaGrupos.destroy();
                if(json.r > 0) {
                    $('#insertnivel').val('');
                    $('#inserttitulacion').val('');
                    $('#insertpromocion').val('');
                    actualizarGrupos(json);
                    $('#pleaseWaitDialog').modal('hide');
                    $('#modal-insert-grupos').modal('hide');
                }else{
                    
                }
    
            }); 
        }
       
    });
    
    //REGISTRO USUARIOS //REGISTRO USUARIOS
    //REGISTRO USUARIOS //REGISTRO USUARIOS
    
    $('#brRegistroUser').on('click', function(e) {
        if(validarRegistro(e)){
            var email = $('#registromail').val();
            var password = $('#registropass').val();
            var foto = $('#file-7-registro').val().replace(/C:\\fakepath\\/i, '');
            var departamento = $( "#registrodepartamento option:selected" ).text();
            
             $.ajax({
                url:'index.php', 
                data: {
                    ruta: 'ajaxlogin', 
                    accion: 'insertuserlogin', 
                    email: email,
                    contrasenia: password,
                    departamento: departamento,
                    foto: foto,
                },
                type: 'GET',
                dataType: 'json'
            }).done(function (json) {
                if(json.r > 0) {
                        $('#modal-registro').modal('hide');
                        $('#modal-success').modal();
                        $('#usuarioLogin').val('');
                        $('#contraseniaLogin').val('');
                        //actualizarProfesores(json, userActivo);
                }
                
        });  
        }else{
            // alert ("error");
        }
        
    });

    $('.actividadesinput').on( 'keyup click', function () {
            filterColumn( $(this).parents('tr').attr('data-column'), objetoTablaActividades);
    });
        
        
    $('.profesoresinput').on( 'keyup click', function () {
            filterColumn2( $(this).parents('tr').attr('data-column'), objetoTabla);
    });
    
    
    $('.gruposinput').on( 'keyup click', function () {
            filterColumn3( $(this).parents('tr').attr('data-column'), objetoTablaGrupos);
    });


    /* funciones */

    function actualizarProfesores (objetoJson, email){
        $('#cuerpoTabla').empty();
        for(var i = 0; i < objetoJson.users.length; ++i){
            if(objetoJson.users[i].email != email){
                $('#cuerpoTabla').append(getTextTablaProfesores(objetoJson.users[i]));
            }else{
                $('.profile').empty();
                $('.box_style_button_admin').empty();
                $('.profile').append(getTextProfesores(objetoJson.users[i]));
                $('.box_style_button_admin').append(getTextButtons(objetoJson.users[i]));
            }
        }
        addEventToDeleteUserLink();
        addEventToEditUserLink();
        addEventToEditNormalUserLink();
        addEventToInsertActividadNormalUserLink();
        addEventToEditAdminUserLink();
        objetoTabla = $('#tablaProfesores').DataTable();
        objetoTablaAUX = $('#tablaProfesores');
        $('#tablaProfesores_wrapper div').first().hide();
    }
    
    function actualizarPerfil (objetoJson){
        $('.profile').empty();
        $('.box_style_button_admin').empty();
       $('.profile').append(getTextProfesores(objetoJson.user));
       $('.box_style_button_admin').append(getTextButtons(objetoJson.user));
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
    
    function actualizarActividadesUnicas (objetoJson){
        $('#cuerpoTabla2').empty();
        console.log(objetoJson)
        for(var i = 0; i < objetoJson.actividades.length; ++i){
            if(objetoJson.actividades[i].email == userActivo){
                $('#cuerpoTabla2').append(getTextTablaActividadesNormalUser(objetoJson.actividades[i]));
            }
            
        addEventToDeleteActividadLink();
        addEventToEditActividadLink();
        addEventToEditActividadUnicaLink();
        addEventToEditNormalUserLink();
        addEventToInsertActividadNormalUserLink();
        addEventToEditAdminUserLink();
        objetoTablaActividades = $('#tablaActividades').DataTable();
        console.log(objetoTablaActividades);
        objetoTablaActividadesAUX = $('#tablaActividades');
        $('#tablaActividades_wrapper div').first().hide();
        }

    }
    
    function actualizarGrupos (objetoJson){
        $('#cuerpoTabla3').empty();
        for(var i = 0; i < objetoJson.grupos.length; ++i){
                $('#cuerpoTabla3').append(getTextTablaGrupos(objetoJson.grupos[i]));
            }
        addEventToDeleteGrupoLink();
        // addEventToEditGrupoLink();
        // addEventToInsertGrupoLink();
        addEventToEdiGrupoLink();
        objetoTablaGrupos = $('#tablaGrupos').DataTable();
        objetoTablaGruposAUX = $('#tablaGrupos');
        $('#tablaGrupos_wrapper div').first().hide();
    }
    
    function actualizarGruposNormalUser (objetoJson){
        $('#cuerpoTabla3').empty();
        for(var i = 0; i < objetoJson.grupos.length; ++i){
                $('#cuerpoTabla3').append(getTextTablaGruposNormalUser(objetoJson.grupos[i]));
            }
        addEventToDeleteGrupoLink();
        // addEventToEditGrupoLink();
        // addEventToInsertGrupoLink();
        addEventToEdiGrupoLink();
        objetoTablaGrupos = $('#tablaGrupos').DataTable();
        objetoTablaGruposAUX = $('#tablaGrupos');
        $('#tablaGrupos_wrapper div').first().hide();
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
            foto = 'default.jpg';
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
    
    function getTextButtons(user){
         var s
        if(user.admin == 1){
           s = '<a href="#" class="button_top edit bteditmyprofile" data-toggle="modal" data-user="'+ user.email +'"  data-target="#modal-edit" role="button"> &nbsp;Editar mi perfil &nbsp;</a>'+
                '<a href="#" class="button_top edit btAniadirUsuario" data-toggle="modal" data-target="#modal-insert" role="button"> &nbsp;Nuevo Usuario &nbsp;</a>'+
                '<a href="#" class="button_top edit btAniadirActividad" data-toggle="modal" data-target="#modal-insert-actividades" role="button"> &nbsp;Nueva Actividad &nbsp;</a>'+
                '<a href="#" class="button_top edit btAniadirGrupo" data-toggle="modal" data-target="#modal-insert-grupos" role="button"> &nbsp;Nuevo Grupo &nbsp;</a>';
            return s;
        }else{
            
            s= '<a href="#" class="button_top edit bteditmyprofile" data-toggle="modal" data-user="'+ user.email +'" data-target="#modal-edit-normaluser" role="button"> &nbsp;Editar mi perfil &nbsp;</a>'+
            '<a href="#" class="button_top edit btAniadirActividadNormalUser" data-user="'+ user.email +'" data-toggle="modal" data-target="#modal-insert-actividades-normaluser" role="button"> &nbsp;Nueva Actividad &nbsp;</a>';
             
             return s;
        }
    }
    
    
    function getTextTablaProfesores(usuario){
        var foto;
        if(usuario.foto === null){
            foto = 'default.jpg';
        }else{
            foto = usuario.foto;
        }
        var s =
        '<tr>'+
        '<td class = "centerdata">'+usuario.email+'</td>'+
        '<td class = "centerdata" class="department">'+usuario.departamento+'</td>'+
        '<td class = "centerdata"><p id = "pe_raro" class="text-center"><img class="img-circle styled" src="img/profesores/'+foto+'" id ="picprofilemin"></p></td>'+
        '<td class = "centerdata">'+
            '<a href="#" class="button_top hidden-xs edit btEditarUsuario" href="#" data-user="'+ usuario.email +'"data-toggle="modal" data-target="#modal-edit" role="button"> &nbsp; Editar  &nbsp;</a>'+
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
        '<td class = "centerdata resizeGrupo">'+actividad.idGrupo+'</td>'+
        '<td class = "centerdata">'+actividad.fechaInicio + " / " + fechatruncada +'</td>'+
        '<td class = "centerdata">'+
            '<a href="#" class="button_top edit btEditarActividad" href="#" data-idactividad="' + actividad.idActividades + 
            '" data-actividad="'+ actividad.titulo +
            '" data-descripcion="'+ actividad.descripcion +
            '" data-fechaInicio="'+ actividad.fechaInicio +
            '" data-fechaFin="'+ actividad.fechaFin +
            '" data-profesor="'+ actividad.email +
            '" data-grupo="'+ actividad.idGrupo +
            '" data-toggle="modal" data-target="#modal-edit-actividades" role="button"> &nbsp;Editar &nbsp;</a>'+
            
            '<a href="#" class="button_top deleteActividad btBorrarActividad" href="#" data-idactividad="' + actividad.idActividades + '" data-actividad="'+ actividad.titulo +'" data-toggle="modal" data-target="#modal-delete-actividades" role="button">Borrar</a>'+
        '</td>'+
        // '<td class = "centerdata">'+actividad.fechaFin+'</td>'+
        '</tr>';
        return s;
    }
    
    
    function getTextTablaActividadesNormalUser(actividad){
        var fechatruncada = jQuery.trim(actividad.fechaFin).substring(10, actividad.fechaFin.length );
        var s =
        '<tr>'+
        '<td class = "centerdata" class="tittle">'+actividad.titulo+'</td>'+
        '<td class = "centerdata">'+actividad.email+'</td>'+
        '<td class = "centerdata resizeGrupo">'+actividad.idGrupo+'</td>'+
        '<td class = "centerdata">'+actividad.fechaInicio + " / " + fechatruncada +'</td>'+
        '<td class = "centerdata">'+
            '<a href="#" class="button_top edit btEditarActividadUnica" href="#" data-idactividad="' + actividad.idActividades + 
            '" data-actividad="'+ actividad.titulo +
            '" data-descripcion="'+ actividad.descripcion +
            '" data-fechaInicio="'+ actividad.fechaInicio +
            '" data-fechaFin="'+ actividad.fechaFin +
            '" data-profesor="'+ actividad.email +
            '" data-grupo="'+ actividad.idGrupo +
            '" data-toggle="modal" data-target="#modal-edit-actividades-normaluser" role="button"> &nbsp;Editar &nbsp;</a>'+
            
            '<a href="#" class="button_top deleteActividad btBorrarActividad" href="#" data-idactividad="' + actividad.idActividades + '" data-actividad="'+ actividad.titulo +'" data-toggle="modal" data-target="#modal-delete-actividades" role="button">Borrar</a>'+
        '</td>'+
        // '<td class = "centerdata">'+actividad.fechaFin+'</td>'+
        '</tr>';
        return s;
    }
    
    function getTextTablaGrupos(grupo){
        var s =
        '<tr>'+
        '<td class = "centerdata" class="tittle">'+grupo.nivel+'</td>'+
        '<td class = "centerdata">'+grupo.titulacion+'</td>'+
        '<td class = "centerdata">'+grupo.promocion+'</td>'+
        '<td class = "centerdata">'+
            '<a href="#" class="button_top edit btEditarGrupo" href="#" data-idgrupo="' + grupo.idGrupo + 
            '" data-nivel="'+ grupo.nivel +
            '" data-titulacion="'+ grupo.titulacion +
            '" data-promocion="'+ grupo.promocion +
            '" data-toggle="modal" data-target="#modal-edit-grupos" role="button"> &nbsp;Editar &nbsp;</a>'+
            
            '<a href="#" class="button_top deleteGrupo btBorrarGrupo" href="#" data-idgrupo="' + grupo.idGrupo + '" data-nivel="'+ grupo.nivel +'" data-toggle="modal" data-target="#modal-delete-grupos" role="button">Borrar</a>'+
        '</td>'+
        '</tr>';
        return s;
    }
    
    function getTextTablaGruposNormalUser(grupo){
        var s =
        '<tr>'+
        '<td class = "centerdata" class="tittle">'+grupo.nivel+'</td>'+
        '<td class = "centerdata">'+grupo.titulacion+'</td>'+
        '<td class = "centerdata">'+grupo.promocion+'</td>'+
        '<td class = "centerdata">'+
        '</td>'+
        '</tr>';
        return s;
    }
    
    
    
    

    function login(objetoJson){
        if(objetoJson.login == "1"){
            successLogin();
            $('#pleaseWaitDialog').modal();
            $('#login_bg').hide();
            $('#contenedor_perfiles').show();
            $('#rellenadorLogin').html(objetoJson.logueo)
            $('#top_nav').html('<li class="myli"> Logueado como: <a class="identificador" href="#"> ' + ' ' + userActivo + '</a></li>');
                 /* Consulta de actividades y volcado de las mismas*/
            if(objetoJson.user.admin == "1"){
                actualizarPerfil(objetoJson);
                actualizarProfesores(objetoJson, userActivo);
                $('#parrafocambiable').html(objetoJson.parrafo);
                $('#parrafocambiable2').html(objetoJson.parrafo);
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
                /////////////////////////////////////////////
                $.ajax({
                    url: 'index.php',
                    data: {
                        ruta: 'ajaxgrupos',
                        accion: 'pedirgrupos'
                    },
                    type: 'GET',
                    dataType: 'json'
                }).done(function(objetoJson) {
                    procesarGrupos(objetoJson);
                    $('#pleaseWaitDialog').modal('hide');
                });
            } else {
                actualizarPerfil(objetoJson);
                $('#parrafocambiable').html(objetoJson.parrafo);
                $('#parrafocambiable2').html(objetoJson.parrafo);
                $('#botonfiltro2').prop( "disabled", true );
                    $.ajax({
                    url: 'index.php',
                    data: {
                        ruta: 'ajaxactividades',
                        accion: 'pediractividadesusuario',
                        email: userActivo
                    },
                    type: 'GET',
                    dataType: 'json'
                }).done(function(oJson) {
                    console.log(oJson);
                    procesarActividadesUnicas(oJson);
                    
                    $('#pleaseWaitDialog').modal('hide');
                    // $('profile_teacher').hide();
                });
                $.ajax({
                    url: 'index.php',
                    data: {
                        ruta: 'ajaxgrupos',
                        accion: 'pedirgrupos'
                    },
                    type: 'GET',
                    dataType: 'json'
                }).done(function(objetoJson) {
                    procesarGruposNormalUser(objetoJson);
                    $('#pleaseWaitDialog').modal('hide');
                });
            }
            
            
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
            actualizarActividades(objetoJson);
    }
    
    function procesarActividadesUnicas(objetoJson){
            actualizarActividades(objetoJson);
    }
    
    function procesarGrupos(objetoJson){
            actualizarGrupos(objetoJson);
    }
    
     function procesarGruposNormalUser(objetoJson){
            actualizarGruposNormalUser(objetoJson);
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
    
    
    
    // EVENTOS ASOCIADOS A LOS BOTONES QUE ENVIAN A LAS DIFERENTES MODALES
    //DELETE
    function addEventToDeleteUserLink() {
        $('.delete').on('click', function() {
            usuarioBorrar = $(this).data('user');
            $('#nombreDelete').text(usuarioBorrar);
        });
    }
    
    function addEventToDeleteActividadLink() {
        $('.deleteActividad').on('click', function() {
            actividadBorrar = $(this).data('actividad');
            $('#actividadDelete').text(actividadBorrar);
            idActividadBorrar = $(this).data('idactividad');
        });
    }
    
    function addEventToDeleteGrupoLink(){
        $('.deleteGrupo').on('click', function(){
            grupoBorrar = $(this).data('grupo');
            $('#grupoDelete').text(grupoBorrar);
            idGrupoBorrar = $(this).data('idgrupo');
        });
    }
    
    //EDIT
    function addEventToEditUserLink() {
        $('.btEditarUsuario').on('click', function() {
            $('#editemail').val($(this).data('user'));
            $('#pkeditemail').val($(this).data('user'));
        });
    }
    
    function addEventToEditNormalUserLink() {
        $('.bteditmyprofile').on('click', function() {
            $('#editEmailNormalUser').val($(this).data('user'));
            $('#pkeditEmailNormalUser').val($(this).data('user'));
        });
    }
    
    function addEventToEditActividadLink() {
        $('.btEditarActividad').on('click', function() {
            $('#edittitulo').val($(this).data('actividad'));
            $('#editdescripcion').val($(this).data('descripcion'));
            $('#datetimeActIni').val($(this).data('fechaInicio'));
            $('#datetimeActFin').val($(this).data('fechaFin'));
            $('#editprof').val($(this).data('profesor'));
            $('#editgrupo').val($(this).data('grupo'));
            $('#idactividad').val($(this).data('idactividad'));
        });
    }
    
    function addEventToEditActividadUnicaLink(){
        $('.btEditarActividadUnica').on('click', function() {
            $('#edittitulounico').val($(this).data('actividad'));
            $('#editdescripcionunico').val($(this).data('descripcion'));
            $('#datetimeActIniNormalUser').val($(this).data('fechaInicio'));
            $('#datetimeActFinNormalUser').val($(this).data('fechaFin'));
            $('#editemailunico').val($(this).data('profesor'));
            $('#editgrupounico').val($(this).data('grupo'));
            $('#idactividadunica').val($(this).data('idactividad'));
        });
    }
    
    
     function addEventToEdiGrupoLink() {
        $('.btEditarGrupo').on('click', function() {
            $('#editnivel').val($(this).data('nivel'));
            $('#edittitulacion').val($(this).data('titulacion'));
            $('#editpromocion').val($(this).data('promocion'));
            $('#idgrupo').val($(this).data('idgrupo'));
        });
    }
    
    //INSERT
    function addEventToInsertActividadNormalUserLink() {
        $('.btAniadirActividadNormalUser').on('click', function() {
            $('#emailCurrentNormalUser').val($(this).data('user'));
            
        });
    }
    
    
    function addEventToEditAdminUserLink() {
        $('.bteditmyprofile').on('click', function() {
            usuarioProfile = $(this).data('user');
            $('#editemail').text(usuarioProfile);
            $('#pkeditemail').val($(this).data('user'));
            
        });
    }
    
    ////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////
    ///////////////// Filtrado de Tablas//////////////////////////


   /* global objetoTabla */
    $('#botonfiltro1').click(function(){
        $("#tablaencabezado1").slideToggle( "slow" );

    });
    
     $('#botonfiltro2').click(function(){
        $("#tablaencabezado2").slideToggle( "slow" );

    });
    
     $('#botonfiltro3').click(function(){
        $("#tablaencabezado3").slideToggle( "slow" );

    });

   
     
    function filterColumn (i, objetoDataTable) {
        objetoDataTable.column( i ).search(
            $('#col'+i+'_filter').val(),
            $('#col'+i+'_smart').prop('checked')
        ).draw();
    }
    
    function filterColumn2 (i, objetoDataTable) {
        objetoDataTable.column( i ).search(
            $('#col'+i+'_filter2').val(),
            $('#col'+i+'_smart2').prop('checked')
        ).draw();
    }
    
    function filterColumn3 (i, objetoDataTable) {
        objetoDataTable.column( i ).search(
            $('#col'+i+'_filter3').val(),
            $('#col'+i+'_smart3').prop('checked')
        ).draw();
    }
    
    
    
    /* === BUSQUEDA POR FILTRADO CASERO === */ 
        
// // #myInput is a <input type="text"> element
//     $('.input-custom').on( 'keyup', function () {
//     objetoTablaGrupos.search( this.value ).draw();
//     } );
    
    
    
    /* === ARREGLO CSS TABLA RESPONSIVE MEDIANTE JQUERY === */
    $('#mytabs li:nth-child(2)').on('click', function() {
        $('#profile_teacher').removeClass("visible");
    });
    
    
    $('#mytabs li:nth-child(3)').on('click', function() {
        $('#groups').removeClass("visible");
    });

    
    ///////////////////VALIDACIONES LOGIN Y REGISTRO////////////////////////////
    ///////////////////VALIDACIONES LOGIN Y REGISTRO////////////////////////////
    ///////////////////VALIDACIONES LOGIN Y REGISTRO////////////////////////////
    
    
    function validar(e){
        var erroremail =  $('.errorusername');
        var errorpassword = $('.errorpassword');
        var email_ok = validarEmail($('#usuarioLogin'), erroremail);
        var pass_ok = validarPassword($('#contraseniaLogin'), 4, errorpassword);
        
        if( !email_ok || !pass_ok){
            e.preventDefault();
            return false;
        }else{
            return true;
        }
    }
    
    function validarRegistro(e){
        e.preventDefault();
        var erroremail = $('.erroremail_registro');
        var errorpass1 = $('.errorpass_registro');
        var errorpass2 = $('.errorpass_registro2');
        var errorselect = $('.errorselect_registro');
        
        var email_ok = validarEmail($('#registromail'), erroremail);
        var pass_ok = validarPassword($('#registropass'), 4, errorpass1);
        var pass2_ok = validarVacio($('#registropass2'), errorpass2);
        var departamento_ok = validarSelect($('#registrodepartamento'), errorselect);
        var comparar_ok = validarComparar($('#registropass'), $('#registropass2'), errorpass2);
        
        if (email_ok && pass_ok && pass2_ok && comparar_ok && departamento_ok ){
            //$("#for_register").submit();
            return true;
        }
    }
    
    function validarModalEditAdmin(e){
        e.preventDefault();
        var erroremail = $('.erroremail_modal_edit');
        var errorpass1 = $('.errorpass_modal_edit');
        var errorselect = $('.errorselect_modal_edit');
        
        var email_ok = validarEmail($('#editemail'), erroremail);
        var pass_ok = validarPassword($('#editpassword'), 4, errorpass1);
        var departamento_ok = validarSelect($('#editdepartamento'), errorselect);
        
        if (email_ok && pass_ok  && departamento_ok ){
            //$("#for_register").submit();
            return true;
        }
    }
    
    
    function validarModalEditProfileAdmin(e){
        e.preventDefault();
        var erroremail = $('.erroremail_modal_edit');
        var errorpass1 = $('.errorpass_modal_edit');
        var errorselect = $('.errorselect_modal_edit');
        
        var email_ok = validarEmail($('#editemail'), erroremail);
        var pass_ok = validarPassword($('#editpassword'), 4, errorpass1);
        var departamento_ok = validarSelect($('#editdepartamento'), errorselect);
        
        if (email_ok && pass_ok  && departamento_ok ){
            //$("#for_register").submit();
            return true;
        }
    }
    
    
    function validarModalInsertAdmin(e){
        e.preventDefault();
        var erroremail = $('.erroremail_insert_modal');
        var errorpass1 = $('.errorpass_insert_modal');
        var errorselect = $('.errorselect_insert_modal');
        
        var email_ok = validarEmail($('#insertemail'), erroremail);
        var pass_ok = validarPassword($('#insertpassword'), 4, errorpass1);
        var departamento_ok = validarSelect($('#insertdepartamento'), errorselect);
        
        if (email_ok && pass_ok  && departamento_ok ){
            //$("#for_register").submit();
            return true;
        }
    }
    
     function validarModalInsetActividadtAdmin(e){
        e.preventDefault();
        var erroremail = $('.errorprofesor_insert_actividadesAdmin');
        var errortitulo = $('.errortitulo_insert_actividadesAdmin');
        var errorfechaini= $('.errorfechaini_insert_actividadesAdmin');
        var errorfechafin = $('.errorfechafin_insert_actividadesAdmin');
        var errordescripcion = $('.errordescripcion_insert_actividadesAdmin');
        var errorgrupo = $('.errorgrupo_insert_actividadesAdmin');
        
        var titulo_ok = validarVacio($('#inserttitulo'), errortitulo);
        var descripcion_ok = validarVacio($('#insertdescripcion'), errordescripcion);
        var fechaini_ok = validarFecha($('#datetimeActIni'), errorfechaini);
        var fechafin_ok = validarFecha($('#datetimeActFin'), errorfechafin);
        var profesor_ok = validarEmail($('#insertprof'), erroremail);
        var grupo_ok = validarVacioGrupo($('#insertgrupo'), errorgrupo);
        
        if (titulo_ok && descripcion_ok  && fechaini_ok && fechafin_ok  && profesor_ok && grupo_ok ){
            //$("#for_register").submit();
            return true;
        }
    }
    
    function validarModalEditActividadtAdmin(e){
        e.preventDefault();
        var erroremail = $('.errorprofesor_edit_actividadesAdmin');
        var errortitulo = $('.errortitulo_edit_actividadesAdmin');
        var errorfechaini= $('.errorfechaini_edit_actividadesAdmin');
        var errorfechafin = $('.errorfechafin_edit_actividadesAdmin');
        var errordescripcion = $('.errordescripcion_edit_actividadesAdmin');
        var errorgrupo = $('.errorgrupo_edit_actividadesAdmin');
        
        var titulo_ok = validarVacio($('#edittitulo'), errortitulo);
        var descripcion_ok = validarVacio($('#editdescripcion'), errordescripcion);
        var fechaini_ok = validarFecha($('#datetimeActIniEdit'), errorfechaini);
        var fechafin_ok = validarFecha($('#datetimeActFinEdit'), errorfechafin);
        var profesor_ok = validarEmail($('#editprof'), erroremail);
        var grupo_ok = validarVacioGrupo($('#editgrupo'), errorgrupo);
        
        if (titulo_ok && descripcion_ok  && fechaini_ok && fechafin_ok  && profesor_ok && grupo_ok ){
            //$("#for_register").submit();
            return true;
        }
    }
    
    
    function validarInsertGruposAdmin(e){
         e.preventDefault();
        var errorgrupo = $('.errornivel_insert_grupo');
        var errortitulo = $('.errortitulacion_insert_grupo');
        var errorpromocion= $('.errorpromocion_insert_grupo');

        var grupo_ok = validarVacioGrupo($('#insertnivel'), errorgrupo);
        var titulo_ok = validarVacio($('#inserttitulacion'), errortitulo);
        var promocion_ok = validarFecha($('#insertpromocion'), errorpromocion);
;
        
        if (grupo_ok && titulo_ok  && promocion_ok){
            //$("#for_register").submit();
            return true;
        }
    }
    
    
    function validarModalEditGrupos(e){
         e.preventDefault();
        var errorgrupo = $('.errornivel_edit_grupo');
        var errortitulo = $('.errortitulacion_edit_grupo');
        var errorpromocion= $('.errorpromocion_edit_grupo');

        var grupo_ok = validarVacioGrupo($('#editnivel'), errorgrupo);
        var titulo_ok = validarVacio($('#edittitulacion'), errortitulo);
        var promocion_ok = validarFecha($('#editpromocion'), errorpromocion);
;
        
        if (grupo_ok && titulo_ok  && promocion_ok){
            //$("#for_register").submit();
            return true;
        }
    }
    
    function validarEditNormalUser(e){
         e.preventDefault();
        var erroremail = $('.erroremail_edit_normaluser');
        var errorpass1 = $('.errorpass_edit_normaluser');
        var errorselect = $('.errorselect_edit_normaluser');
        
        var email_ok = validarEmail($('#editEmailNormalUser'), erroremail);
        var pass_ok = validarPassword($('#editPasswordNormalUser'), 4, errorpass1);
        var departamento_ok = validarSelect($('#editDepartamentoNormalUser'), errorselect);
        
        if (email_ok && pass_ok  && departamento_ok ){
            //$("#for_register").submit();
            return true;
        }
    }
    
    
    function validarEditActividadNormalUser(e){
        e.preventDefault();
        var errortitulo = $('.errortitulo_edit_actividadnormaluser');
        var errorfechaini= $('.errorfechaini_edit_actividadnormaluser');
        var errorfechafin = $('.errorfechafin_edit_actividadnormaluser');
        var errordescripcion = $('.errordescripcion_edit_actividadnormaluser');
        var errorgrupo = $('.errorgrupo_edit_actividadnormaluser');
        
        var titulo_ok = validarVacio($('#edittitulounico'), errortitulo);
        var descripcion_ok = validarVacio($('#editdescripcionunico'), errordescripcion);
        var fechaini_ok = validarFecha($('#datetimeActIniNormalUser'), errorfechaini);
        var fechafin_ok = validarFecha($('#datetimeActFinNormalUser'), errorfechafin);
        var grupo_ok = validarVacioGrupo($('#editgrupounico'), errorgrupo);
        if (titulo_ok && descripcion_ok  && fechaini_ok && fechafin_ok  && grupo_ok ){
            //$("#for_register").submit();
            return true;
        }
    }
    
    function validarInsertActividadNormalUser(e){
         e.preventDefault();
        var errortitulo = $('.errortitulo_insert_actividadnormaluser');
        var errorfechaini= $('.errorfechaini_insert_actividadnormaluser');
        var errorfechafin = $('.errorfechafin_insert_actividadnormaluser');
        var errordescripcion = $('.errordescripcion_insert_actividadnormaluser');
        var errorgrupo = $('.errorgrupo_insert_actividadnormaluser');
        
        var titulo_ok = validarVacio($('#inserttituloNormalUser'), errortitulo);
        var descripcion_ok = validarVacio($('#insertdescripcionNormalUser'), errordescripcion);
        var fechaini_ok = validarFecha($('#datetimeActIniNormalUserInsert'), errorfechaini);
        var fechafin_ok = validarFecha($('#datetimeActFinNormalUserInsert'), errorfechafin);
        var grupo_ok = validarVacioGrupo($('#insertgrupoNormalUser'), errorgrupo);
        
        if (titulo_ok && descripcion_ok  && fechaini_ok && fechafin_ok  && grupo_ok ){
            //$("#for_register").submit();
            return true;
        }
    }
    
    // Comprueba que el campo email no este vacio y tenga
    // el formato correcto.
    function validarEmail(nodo, errormail){
        
        var email = nodo.val();
        var correcto = true;
        
         errormail.text('');
        
        if ( email === '' ){
            correcto = false;
            errormail.text('El campo email no puede estar vacio.');
        } else {
            var expr = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
            
            if ( !expr.test( email ) || email.length > 255){
                correcto = false;
                errormail.text('Formato de email invalido.');
            }
        }
        return correcto;
    }
    
    function validarFecha(nodo, errorfecha){
        var fecha = nodo.val();
        var correcto = true;
        
        if(fecha == ""){
            correcto = false;
            errorfecha.text('El campo no puede estar vacio.');
        }
        return correcto;
    }

    
    // Comprueba que el campo password no este vacio y tenga
    // el formato correcto.
    function validarPassword(nodo, min, errorpassword){
        
        var pass = nodo.val();
        var correcto = true;
        
        errorpassword.text('');
        
        // Comprueba tamaño minimo.
        if ( pass.length < min ||  pass.length > 255 ){
            correcto = false;
            errorpassword.text('Debe contener al menos 4 caracteres');
        } else {
            // Comprueba que contenga letras
            if( !pass.match(/[A-z]/) ){
                correcto = false;
                errorpassword.text('Debe contener letras.');
            }
            
            // Comprueba que contenga mayusculas
            if(!pass.match(/[A-Z]/)){
                correcto = false;
                errorpassword.text('Debe contener al menos una mayuscula.');
            }
            
            // Comprueba que contenga numeros
            if(!pass.match(/\d/)){
                correcto = false;
                nodo.next().next().text('Debe contener al menos un numero.');
            }
        }
        return correcto;
    }
    
    // Comprueba que un campo no este vacio
    function validarVacio(nodo, error){
        var contenido = nodo.val();
        var correcto = true;
        
        error.text('');
        if( contenido === '' ){
            correcto = false;
            error.text('El campo no puede estar vacio.');
        }
        return correcto;
    }
    
    function validarVacioGrupo(nodo, errorpass2){
        var contenido = nodo.val();
        var correcto = true;
        
        errorpass2.text('');
        
        if( contenido === ''){
            correcto = false;
            errorpass2.text('El campo no puede estar vacio.');
        }
        
        if( contenido.length > 9){
            correcto = false;
            errorpass2.text('El grupo sólo admite 9 caracteres válidos');
        }
        return correcto;
    }
    
    
    // Comprueba que los dos password sean iguales
    function validarComparar(nodo1, nodo2, errorpass2 ){
        var pass1 = nodo1.val();
        var pass2 = nodo2.val();
        var correcto = true;
        
        nodo2.next().text('');
        
        if( pass1 != pass2 ){
            correcto = false;
           errorpass2.text('La confirmacion de contraseña no es valida.');
        }else{}
        return correcto;
    }
    
    
    function validarSelect(nodo, errorselect){
        var correcto = true
        if (nodo.prop('selectedIndex') == 0) {
            errorselect.text('Debe selecionar una opción.');
            correcto = false;
        }

         return correcto;
    }
    
    function shakeForm() {
       var l = 20;  
       for( var i = 0; i < 10; i++ )   
         $( "#newsletter" ).animate( { 
             'margin-left': "+=" + ( l = -l ) + 'px',
             'margin-right': "-=" + l + 'px'
          }, 50);  

     }
    
    $('.btCancelarModal').on('click', function() {
         $('.erroremail_registro').val('');
         $('.errorpass_registro').val('');
         $('.errorpass_registro2').val('');
         $('.errorselect_registro');
         $('.erroremail_modal_edit').val('');
         $('.errorpass_modal_edit').val('');
         $('.errorselect_modal_edit');
         $('.erroremail_modal_edit').val('');
         $('.errorpass_modal_edit').val('');
         $('.errorselect_modal_edit');
         $('.erroremail_insert_modal').val('');
         $('.errorpass_insert_modal').val('');
         $('.errorselect_insert_modal');
         $('.errornivel_insert_grupo').val('');
         $('.errortitulacion_insert_grupo').val('');
         $('.errorpromocion_insert_grupo').val('');
         $('.errornivel_edit_grupo').val('');
         $('.errortitulacion_edit_grupo').val('');
         $('.errorpromocion_edit_grupo').val('');
         $('.erroremail_edit_normaluser').val('');
         $('.errorpass_edit_normaluser').val('');
         $('.errorselect_edit_normaluser');
         $('.errorprofesor_edit_actividadesAdmin').val('');
         $('.errortitulo_edit_actividadesAdmin').val('');
         $('.errorfechaini_edit_actividadesAdmin').val('');
         $('.errorfechafin_edit_actividadesAdmin').val('');
         $('.errordescripcion_edit_actividadesAdmin').val('');
         $('.errorgrupo_edit_actividadesAdmin').val('');
         $('.errorprofesor_insert_actividadesAdmin').val('');
         $('.errortitulo_insert_actividadesAdmin').val('');
         $('.errorfechaini_insert_actividadesAdmin').val('');
         $('.errorfechafin_insert_actividadesAdmin').val('');
         $('.errordescripcion_insert_actividadesAdmin').val('');
         $('.errorgrupo_insert_actividadesAdmin').val('');
         $('.errortitulo_edit_actividadnormaluser').val('');
         $('.errorfechaini_edit_actividadnormaluser').val('');
         $('.errorfechafin_edit_actividadnormaluser').val('');
         $('.errordescripcion_edit_actividadnormaluser').val('');
         $('.errorgrupo_edit_actividadnormaluser').val('');
         $('.errortitulo_edit_actividadnormaluser').val('');
         $('.errorfechaini_edit_actividadnormaluser').val('');
         $('.errorfechafin_edit_actividadnormaluser').val('');
         $('.errordescripcion_edit_actividadnormaluser').val('');
         $('.errorgrupo_edit_actividadnormaluser');
        
    });
     
     
     /*=============Métodos alternativos no testados ================= */
     
     var cont = 0;
    var funcionTimer;
    // $('#mytabs li:nth-child(1)').on('click', function() {
    //     if(adminProfesor == 1){
    //         $('#pleaseWaitDialog').modal();
    //         objetoTablaActividades.destroy();
    //         objetoTablaActividades = $('#tablaActividades').DataTable( {
    //             "ordering": false
    //         });
    //         $('#tablaActividades_wrapper div').first().hide();
    //         if(cont <= 1){
    //             cont++;
    //             funcionTimer = setTimeout(function (){
    //                 objetoTablaActividades.destroy();
    //                 objetoTablaActividades = $('#tablaActividades').DataTable( {
    //                     "ordering": false
    //                 });
    //                 $('#tablaActividades_wrapper div').first().hide();
    //                 $('#mytabs li:first-child').click();   
    //             }, 500);
    //         }else {
    //             clearTimeout(funcionTimer);
    //             cont = 0;
    //              $('#pleaseWaitDialog').modal('hide');
    //         } 
    //     }else{
    //         $('#tablaActividades_wrapper div').first().hide();
    //     }
    // });
    
    
    // $('.filterable .btn-filter').click(function(){
    //         if(adminProfesor == 1){
    //             objetoTabla.destroy();
    //             objetoTabla = $('#tablaProfesores').DataTable();
    //             objetoTablaActividades.destroy();
    //             objetoTablaActividades = $('#tablaActividades').DataTable();
    //             objetoTablaGrupos.destroy();
    //             objetoTablaGrupos = $('#tablaGrupos').DataTable();
            
    //         }else{
    //             objetoTablaActividades = $('#tablaActividades').DataTable();
    //             objetoTablaActividades.destroy();
    //             objetoTablaActividades = $('#tablaActividades').DataTable();
    //             objetoTablaGrupos.destroy();
    //             objetoTablaGrupos = $('#tablaGrupos').DataTable( );
    //         }
            
    //         $('#tablaProfesores_wrapper div').first().hide();
    //         $('#tablaActividades_wrapper div').first().hide();
    //         $('#tablaGrupos_wrapper div').first().hide();
      
    // });
    
    
    
     // $('.filterable .filters input').keyup(function(e){
    //     /* Ignore tab key */
    //     var code = e.keyCode || e.which;
    //     if (code == '9') return;
    //     /* Useful DOM data and selectors */
    //     var $input = $(this),
    //     inputContent = $input.val().toLowerCase(),
    //     $panel = $input.parents('.filterable'),
    //     column = $panel.find('.filters th').index($input.parents('th')),
    //     $table = $panel.find('.table'),
    //     $rows = $table.find('tbody tr');
    //     /* Dirtiest filter function ever ;) */
    //     var $filteredRows = $rows.filter(function(){
    //         var value = $(this).find('td').eq(column).text().toLowerCase();
    //         return value.indexOf(inputContent) === -1;
    //     });
    //     /* Clean previous no-result if exist */
    //     $table.find('tbody .no-result').remove();
    //     /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
    //     $rows.show();
    //     $filteredRows.hide();
    //     /* Prepend no-result row if all rows are filtered */
    //     if ($filteredRows.length === $rows.length) {
    //         $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
    //     }
    // });

}());