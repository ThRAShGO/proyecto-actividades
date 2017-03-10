<?php

/* Template Name: actividades */

get_header();
get_template_part('nav');
?>

    <section id="sub-header">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <h1>ACTIVIDADES</h1>
               	<p class="lead boxed ">Echa un vistazo a las actividades de Logia</p>
                <p class="lead">
                    Si estás interesado en ampliar tus conocimientos de forma más activa esta es nuestra oferta de actividades a las que puedes suscribirte.
                </p>
            </div>
        </div>
    </div>
    <div class="divider_top"></div>
    </section>
    
    
    <section id="main_content">
    	<div class="container">
        
        <?php include (TEMPLATEPATH  . '/breadcrumbs.php'); ?>
        
        <div class="row">
        
        <aside class="col-lg-3 col-md-4 col-sm-4" id="activities-aside" id="activities-aside">
            <div class="box_style_1">
            </div<div class="box_style_1">
            	<h4>Categorias</h4>
            <ul class="submenu-col">
                <li><a href="#" id="active">Todos los cursos</a></li>
                <li><a href="#">Informática (5)</a></li>
                <li><a href="#">Corte y confección (3)</a></li>
                <li><a href="#">Música (2)</li>
            </ul>
            
            <hr>
            
            <h5>Próximos cursos</h5>
            <p>Visita nuestro apartado de próximos cursos para estar al dia de todo lo que ofrecemos.</p>
            </div>
        </aside>
                        
         <hr>
            <div class="col-lg-9 col-md-8 col-sm-8" id="activities-pannel">
               <div class="row" id="actividades-grid">
                  <!-- CONTENIDO GENERADO POR SCRIPT -->
               </div>
            </div>
            	
        </div>
        
      <!--<div class="modal fade" id="modal-actividad" role="dialog">-->
      <!--   <div class="modal-body" height="70%">-->
            <!--<div id="actividad-individual">-->
            <!--   <img src=""></img>-->
            <!--   <h2 id="titulo-actividad"></h2>-->
            <!--   <h4><span id="departamento-actividad"></span><span id="grupo-actividad"></span></h4>-->
            <!--   <p id="descripcion-actividad"></p>-->
            <!--</div>-->
      <!--   </div>-->
      <!--</div>	-->
      
      <div class="modal fade" id="modal-actividad" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" id="contenidodelcontenido">
          <div class="modal-content" id="contenidomodal">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 id="modal-title"></span></h4>
            </div>
            <div class="modal-body" id="bodymodal">
               <div id="divizq"><img src="" alt="foto" id="foto-actividad"></div>
               <div id="divder">
                  <div>
                     <span class="spanmodal">Descripción:</span>
                     <p id="descripcion-actividad"></p>
                  </div>
                  <div>
                     <span class="spanmodal">Fecha de la Actividad:</span>
                     <p id="fechatruncada-actividad"></p>
                  </div>
                  <div>
                     <span class="spanmodal">Email del Profesor:</span>
                     <p id="profesor-actividad"></p>
                  </div>
                  <div>
                     <span class="spanmodal">Grupo</span>
                     <p id="grupo-actividad"></p>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" id="btNoModalActividades" data-dismiss="modal">Volver</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </section>

<?php get_footer(); ?>

   <!--                     <div class="col-lg-4 col-md-6">-->
   <!--                         <div class="col-item">-->
   <!--                             <div class="photo">-->
   <!--                                 <a href="#"><img src="" alt="" /></a>-->
   <!--                                 <div class="cat_row"><a href="#">MATH</a><span class="pull-right"><i class=" icon-clock"></i>6 Days</span></div>-->
   <!--                             </div>-->
   <!--                             <div class="info">-->
   <!--                                 <div class="row">-->
   <!--                                     <div class="course_info col-md-12 col-sm-12">-->
   <!--                                         <h4>12 Principles</h4>-->
   <!--                                         <p > Lorem ipsum dolor sit amet, no sit sonet corpora indoctum, quo ad fierent insolens. Duo aeterno ancillae ei. </p>-->
   <!--                                         <div class="rating">-->
   <!--                                         <i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class=" icon-star-empty"></i>-->
   <!--                                     </div>-->
   <!--                                     <div class="price pull-right">199$</div>-->
   <!--                                     </div>-->
   <!--                                 </div>-->
   <!--                                 <div class="separator clearfix">-->
   <!--                                     <p class="btn-add"> <a href="apply_2.html"><i class="icon-export-4"></i> Subscribe</a></p>-->
   <!--                                     <p class="btn-details"> <a href="course_details_1.html"><i class=" icon-list"></i> Details</a></p>-->
   <!--                                 </div>-->
   <!--                             </div>-->
   <!--                         </div>-->
   <!--                     </div>-->
   <!--    		</div><!-- End row -->

<script type="text/javascript">
   var ajaxProfesores;
   var ajaxGrupos;
   
   $.ajax({
        url: '/aplicacion/index.php',
        data: {
           ruta: 'ajaxgrupos',
            accion: 'pedirgrupos'
        },
        type: 'GET',
        dataType: 'json',
    }).done(function (objetoJson){
         ajaxGrupos = objetoJson;
    });
    
    $.ajax({
        url: '/aplicacion/index.php',
        data: {
           ruta: 'ajaxlogin',
            accion: 'pedirprofesores'
        },
        type: 'GET',
        dataType: 'json',
    }).done(function (objetoJson){;
         ajaxProfesores = objetoJson;
    });
   
   $.ajax({
        url: '/aplicacion/index.php',
        data: {
           ruta: 'ajaxactividades',
            accion: 'pediractividades'
        },
        type: 'GET',
        dataType: 'json',
    }).done(function (objetoJson){
        actualizarActividades(objetoJson, ajaxGrupos, ajaxProfesores);
    });
    
    function actualizarActividades (objetoJson, ajaxGrupos, ajaxProfesores){
       var departamento;
       var nivel;
      for(var i = 0; i < objetoJson.actividades.length; ++i){
         for(var j = 0; j < ajaxProfesores.profesores.length; ++j){
            if(ajaxProfesores.profesores[j].email == objetoJson.actividades[i].email){
               departamento = ajaxProfesores.profesores[j].departamento;
            }
         }
         for(var j = 0; j < ajaxGrupos.grupos.length; ++j){
            if(ajaxGrupos.grupos[j].idGrupo == objetoJson.actividades[i].idGrupo){
               nivel = ajaxGrupos.grupos[j].nivel;
            }
         }
         $('#actividades-grid').append(getTextTablaActividades(objetoJson.actividades[i], departamento, nivel));
      }
      addEventToMostrarActividadDetalles();
    }
    
    function getTextTablaActividades(actividad, departamento, nivel){
        var foto;
        if(actividad.foto === null || actividad.foto === ''){
            foto = 'default_actividad.jpg';
        }else{
            foto = actividad.foto;
        }
        var direccionFoto = '/aplicacion/img/actividades/'+ foto;
        var fechatruncada = jQuery.trim(actividad.fechaFin).substring(10, actividad.fechaFin.length );
        var fechafull = actividad.fechaInicio + '/' + fechatruncada;
        
         var s1 = '<div class="col-lg-4 col-md-6">' +
                     '<div class="col-item">' +
                       '<div class="photo">' +
                           '<a href="#"><img src="/aplicacion/img/actividades/'+ foto +'" alt="" /></a>' +
                           '<div class="cat_row"><a href="#">'+ departamento +'</a><span class="pull-right">'+ nivel +'</span></div>' +
                       '</div>' +
                       '<div class="info">'+
                           '<div class="row">'+
                               '<div class="course_info col-md-12 col-sm-12">'+
                                   '<h4>' +actividad.titulo+ '</h4>'+
                                   '<p ><a href="#" data-toggle="modal" data-target="#modal-actividad" role="button" data-foto="'+ direccionFoto +'" data-departamento="'+ departamento +'" data-nivel="'+ nivel +'" data-titulo="'+ actividad.titulo +'" data-fechatruncada="'+ fechafull +'" data-descripcion="'+actividad.descripcion+'" data-profesor="'+ actividad.email +'">Detalles</a></p>' +
                                   '<div class="price pull-left">Fecha: '+ actividad.fechaInicio + '/' + fechatruncada + '</div>'+
                               '</div>'+
                           '</div>'+
                           '<div class="separator clearfix">'+
                               '<p class="btn-add"> <a href="/wp-content/themes/demaqui/apply.html"><i class="icon-export-4"></i> Subscribe</a></p>'+
                               '<p class="btn-details"> <a class="enlace-modal" href="#" data-foto="'+ direccionFoto +'" data-departamento="'+ departamento +'" data-nivel="'+ nivel +'" data-titulo="'+ actividad.titulo +'" data-fechatruncada="'+ fechafull +'" data-descripcion="'+actividad.descripcion+'" data-profesor="'+ actividad.email + '"data-toggle="modal" data-target="#modal-actividad" role="button"><i class=" icon-list"></i> Detalles</a></p>'+
                           '</div>'+
                       '</div>'+
                     '</div>'+
                  '</div>';
        return s1;
    }
    
    function addEventToMostrarActividadDetalles() {
      $('.enlace-modal').on('click', function() {
         var foto = $(this).data('foto');
         $('#modal-title').text($(this).data('titulo'));
         $('#foto-actividad').attr('src', foto);
         $('#descripcion-actividad').text($(this).data('descripcion'));
         $('#fechatruncada-actividad').text($(this).data('fechatruncada'));
         $('#profesor-actividad').text($(this).data('profesor'));
         $('#grupo-actividad').text($(this).data('nivel'));
         
      });
   }
   
</script>