<footer>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3>Suscríbete a nuestro Newsletter y ponte al día.</h3>
			<div id="message-newsletter">
			</div>
			<div id="remiendo">
			 <form method="post" action="assets/newsletter.php" name="newsletter" id="newsletter23" class="form-inline">
				
			</form> 
			</div>
			
			<form method="post" action="assets/newsletter.php" name="newsletter" id="newsletter" class="form-inline">
				<input name="email_newsletter" id="email_newsletter" type="email" value="" placeholder="Tu email" class="form-control">
				<button id="submit-newsletter" class=" button_outline"> Subscribe</button>
			</form>
		</div>
	</div>
</div>

<hr>

<div class="container" id="nav-footer">
	<div class="row text-left">
		<div class="col-md-3 col-sm-3">
			<h4>Navegación</h4>
			<ul>
				<li><a href="prices_plans.html">Precios</a></li>
				<li><a href="courses_grid.html">Cursos</a></li>
				<li><a href="blog.html">Blog</a></li>
				<li><a href="contacto">Contacto</a></li>
			</ul>
		</div><!-- End col-md-4 -->
		<div class="col-md-3 col-sm-3">
			<h4>Próximos Cursos</h4>
			<ul>
				<li><a href="course_details_1.html">Biología</a></li>
				<li><a href="course_details_2.html">Administración</a></li>
				<li><a href="course_details_2.html">Historia</a></li>
				<li><a href="course_details_3.html">Literatura</a></li>
			</ul>
		</div><!-- End col-md-4 -->
		<div class="col-md-3 col-sm-3">
			<h4>Sobre LOGIA</h4>
			<ul>
				<li><a href="about_us.html">Sobre Nosotros</a></li>
				<li><a href="apply_2.html">Solicitudes</a></li>
				<li><a href="#">Términos y condiciones</a></li>
				<li><a href="register.html">Registro</a></li>
			</ul>
		</div><!-- End col-md-4 -->
		<div class="col-md-3 col-sm-3">
			<ul id="follow_us">
				<li><a href="#"><i class="icon-facebook"></i></a></li>
				<li><a href="#"><i class="icon-twitter"></i></a></li>
				<li><a href="#"><i class=" icon-google"></i></a></li>
			</ul>
			<ul>
				<li><strong class="phone">+0034 91881 44</strong><br><small>Lu - Vi / 8.00AM - 10.00PM</small></li>
				<li>¿Alguna duda? <a href="#">info@academia.com</a></li>
			</ul>
		</div><!-- End col-md-4 -->
	</div><!-- End row -->
</div>
<div id="copy_right">© 1998-2017</div>
</footer>

<div id="toTop"></div>

<!-- JQUERY -->
<script src="<?php bloginfo('template_directory');?>/js/jquery-1.10.2.min.js"></script>

<!--Propios Ajax -->

<!-- jQuery REVOLUTION Slider  -->
<script type="text/javascript" src="<?php  bloginfo('template_directory');?>/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="<?php  bloginfo('template_directory');?>/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript">

		var revapi;

		jQuery(document).ready(function() {

			   revapi = jQuery('.tp-banner').revolution(
				{
					delay:9000,
					startwidth:1700,
					startheight:600,
					hideThumbs:true,
					navigationType:"none",
					fullWidth:"on",
					forceFullWidth:"on"
				});
				
    // Comprueba que el campo email no este vacio y tenga
    // el formato correcto.
    function validarEmail(nodo){
        
        var email = nodo.val();
        var correcto = true;
        
        nodo.next().next().text('');
        
        if ( email === '' ){
            correcto = false;
            nodo.next().next().text('El campo email no puede estar vacio.');
        } else {
            var expr = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
            
            if ( !expr.test( email ) ){
                correcto = false;
                nodo.next().next().text('Formato de email invalido.');
            }
        }
        return correcto;
    }
    
   $('#submit-newsletter').on('click', function(e){
        var email = $('#email_newsletter');
        if(!validarEmail(email)){
            shakeForm();
            e.preventDefault();
        }else{
        }
        
    });
    
    
    function shakeForm() {
       var l = 20;  
       for( var i = 0; i < 10; i++ )   
         $( "#newsletter" ).animate( { 
             'margin-left': "+=" + ( l = -l ) + 'px',
             'margin-right': "-=" + l + 'px'
          }, 50);  

     }
			

		});	//ready

	</script>

<!-- OTHER JS --> 
<script src="<?php  bloginfo('template_directory');?>/js/superfish.js"></script>
<script src="<?php  bloginfo('template_directory');?>/js/bootstrap.min.js"></script>
<script src="<?php  bloginfo('template_directory');?>/js/retina.min.js"></script>
<script src="<?php  bloginfo('template_directory');?>/assets/validate.js"></script>
<script src="<?php  bloginfo('template_directory');?>/js/jquery.placeholder.js"></script>
<script src="<?php  bloginfo('template_directory');?>/js/functions.js"></script>
<script src="<?php  bloginfo('template_directory');?>/js/classie.js"></script>
<script src="<?php  bloginfo('template_directory');?>/js/uisearch.js"></script>
<script>new UISearch( document.getElementById( 'sb-search' ) );</script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>


<!-- GOOGLE MAP -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsVHYmOWYy9WrBFNwC7kISgqNzu3fvRTM"></script>
<script type="text/javascript" src="<?php  bloginfo('template_directory');?>/js/mapmarker.jquery.js"></script>
<script type="text/javascript" src="<?php  bloginfo('template_directory');?>/js/mapmarker_func.jquery.js"></script>

  </body>
</html>