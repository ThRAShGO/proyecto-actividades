/* global $ */
(function() {

    var insert = false;
    var page = 1;
    var user = null;

    /* código inmediatamente ejecutado */    
    // $('#divLogout').hide();
    // $('#divRowPage').hide();
    // $('#divRowUsuarios').hide();
    $.ajax({
        url: 'index.php',
        data: {
            ruta: 'ajaxActividades',
            accion: 'getPageActividadAjax'
        },
        type: 'GET',
        dataType: 'json',
    }).done(function (objetoJson){
        //login(objetoJson);
        // metaDatos(objetoJson);
         mostrarActividades(objetoJson);
    });

    /* eventos inmediatamente asignados */

    $('#btDeleteUser').on('click', function() {
        $.ajax({
            url: 'index.php',
            data: {
                ruta: 'ajax',
                accion: 'deleteuser',
                email: user
            },
            type: 'GET',
            dataType: 'json'
        }).done(function(objetoJson) {
            if(objetoJson.r > 0){
                actualizar(objetoJson);
                $('#divRowUsuarios').empty();
                $('#modal-delete').modal('hide');
            }
        });
    });

    $('#btEnviar').on('click', function() {
        $.ajax({
            url: 'index.php',
            data: {
                ruta: 'ajax',
                accion: 'login',
                email: $('#iptEmail').val(),
                password: $('#iptPassword').val()
            },
            type: 'GET',
            dataType: 'json'
        }).done(function(objetoJson) {
            login(objetoJson);
        });
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

    $('#btInsertUser').on('click', function(){
        var email = $('#email').val();
        var password = $('#password').val();
        if(insert && isCorreo(email) && isPassword(password)){
            $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'ajax',
                    accion: 'insertuser',
                    email: email,
                    password: password
                },
                type: "GET",
                dataType: "json"
            }).done(function(objetoJson) {
                if(objetoJson.r > 0){
                    $('#divRowUsuarios').empty();
                    $('#modal-insert').modal('hide');
                    actualizar(objetoJson);
                }
            });
        }
    });

    $('#email').on('blur', function() {
        insert = false;
        $.ajax({
                url: 'index.php',
                data: {
                    ruta: 'ajax',
                    accion: 'isrepeatedemail',
                    email: $(this).val()
                },
                type: 'GET',
                dataType: "json"
            }).done(function(objetoJson) {
                if(objetoJson.r === 1){
                    alert('El email ya esta en la base de datos');
                }else{
                    insert = true;
                }
        });
    });

    $('#modal-insert').on('hidden.bs.modal', function () {
        $('#email').val('');
        $('#password').val('');
    });

    /* funciones */    

    function actualizar (objetoJson){
        for(var i = 0; i < objetoJson.users.length; ++i){
            $('#divRowUsuarios').append(getText(objetoJson.users[i]));
        }
        addEventToPagesLinks();
        addEventToDeleteUserLink();
    }
    
    function mostrarActividades (objetoJson){
        for(var i = 0; i < objetoJson.actividades.length; ++i){
            $('#divRowUsuarios').append(getText(objetoJson.actividades[i]));
        }
        addEventToPagesLinks();
    }

    function addEventToDeleteUserLink(){
        $('.delete').on('click', function(){
            var userDel = $(this).data('user');
            $('#nombreDelete').text(userDel);
            user = userDel;
        });
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
            $.ajax({
                url: 'actividades.php',
                data: {
                    ruta: 'ajaxActividades',
                    accion: 'getPageActividadAjax',
                    pagina: page
     
                },
                type: "GET",
                dataType: "json"
            }).done(function(objetoJson) {
                $('#divRowUsuarios').empty();
                for(var i = 0; i < objetoJson.actividades.length; ++i){
                    $('#divRowUsuarios').append(getText(objetoJson.actividades[i]));
                }
                page = objetoJson.page;
            });
            
        });
    }
    
    function getPagination(page, pages){
        var s = '';
        for( var i = 1; i <= pages; ++i){
            s+= '<li class="page-item pagina-borrar"><a class="page-link" href="#" data-page="'+i+'">'+i+'</a></li>';
        }
        return s;
    }
    
    function getText(user){
        var s = 
        '<div class="col-md-4">'+
            '<h2>'+ user.email +'</h2>'+
            '<p>'+user.password+'</p>'+
            '<p><a class="btn btn-default" href="#" role="button">Editar &raquo;</a></p>'+
            '<p><a class="btn btn-default delete" href="#" data-user="'+ user.email +'" data-toggle="modal" data-target="#modal-delete" role="button">Borrar &raquo;</a></p>'+
         '</div>';
         return s;
    }
    
    function isCorreo(c){
        return true;
    }
    
    function isPassword(p){
        return true;
    }

    function login(objetoJson){
        if(objetoJson.login == "1"){
            // $('#divLogin').css('display','none');
            $('#divLogin').hide();
            $('#divLogout').show();
            $('#divUser').text(objetoJson.info.nombre);
            $('#divOcultar').hide();
            $('#divRowPage').show();
            $('#divRowUsuarios').show();
            $('#previous').after(getPagination(objetoJson.page, objetoJson.pages));
            actualizar(objetoJson);
            metaDatos(objetoJson);
        }
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
    
    // function metaDatos(json){
    //     if(json.user){
    //         getMetaDatosTable(json.users);
    //     }
    // }
    
    /*function getMetaDatos(datos){
        var propiedades = [], propiedad;
        var dato = datos[0];
        for(propiedad in dato){
            console.log(propiedad);
            propiedades.push(propiedad);
        }
        for(var i=0; i < datos.length; i++) {
            dato = datos[i];
            for(var j=0; j < propiedades.length; j++) {
                propiedad = propiedades[j];
                console.log(dato[propiedad]);
            }
        }
    }*/

    // function getMetaDatosTable(datos){
    //     var dato, propiedad;
    //     var strTh, strTr;
    //     for(var i=0; i < datos.length; i++) {
    //         dato = datos[i];
    //         strTh='';
    //         strTr='';
    //         for(propiedad in dato) {
    //             if(i==0){
    //                 strTh += propiedad + " | ";
    //             }
    //             strTr += dato[propiedad] + " | ";
    //         }
    //         if(i==0){
    //             console.log(strTh);
    //         }
    //         console.log(strTr);
    //     }
    // }
    
    /*function addEventToDeleteUser(){
        $('.delete').on('click', function(){
            var user = $(this).data('user');
            $('#nombreDelete').text(user);
            
        });
    }*/

}());