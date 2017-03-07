<?php

/* Template Name: contacto */


?>

<?php get_header(); ?>

    <?php get_template_part('nav'); ?>
    <img id="imagenIcono" src="<?php bloginfo('template_directory') ?>/img/map-marker2.png"></img>
  <section id="map"></section><!-- end map-->
  <section id="directions">
  	<div class="container">
    	<div class="row">
        <div class="col-md-8 col-md-offset-2">
       <form action="https://maps.google.com/maps" method="get" target="_blank">
				<div class="input-group">
					<input type="text" name="saddr" placeholder="Introduce tu punto de salida" class="form-control style-2" />
					<input type="hidden" name="daddr" value="Zaidin Vergeles Granada"/><!-- Write here your end point -->
					<span class="input-group-btn">
					<button class="btn" type="submit" value="Get directions" style="margin-left:0;">Encuéntranos</button>
					</span>
				</div><!-- /input-group -->
			</form>
          </div>
        </div>
    </div>
  </section>
  
<section id="main_content" >
<div class="container">
<div class="row">
	<div class="col-md-4">
		<h3>Dirección</h3>
		<ul id="contact-info">
			<li><i class="icon-home"></i> 14 Calle Primavera - Granada, ESPAÑA</li>
			<li><i class="icon-phone"></i> + 34 (958) 123 456 / + 34 (958) 812 556</li>
			<li><i class=" icon-email"></i> <a href="#">info@domain.com</a></li>
		</ul>
		<hr>
		<h3>Síguenos</h3>
		<p>
			Si lo prefieres, puedes encontrarnos en las siguientes redes sociales. Anímete y síguenos.
		</p>
		<ul id="follow_us_contacts">
			<li><a href="#"><i class="icon-facebook"></i>fb.com/zaidin.vergeles</a></li>
			<li><a href="#"><i class="icon-twitter"></i>twitter.com/#zaidin.vergeles</a></li>
			<li><a href="#"><i class=" icon-google"></i>googleplus.com/zaidin.vergeles</a></li>
		</ul>
        <hr>
		<h3>Registrate en un curso</h3>
        <p>
			¿Quieres pontenciar tus habilidades en alguna materia? Logia te ayuda a superar cualquier obstaculo y perfeccionar tus conocimientos en cualquier materia.
		</p>
        <a href="#" class="button_medium_outline">Envio</a>
	</div>
	<div class="col-md-8">
		<div class=" box_style_2">
			<span class="tape"></span>
			<div class="row">
				<div class="col-md-12">
					<h3>¿Alguna duda?</h3>
				</div>
			</div>
			<div id="message-contact"></div>
			<form method="post" action="assets/contact.php" id="contactform">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="text" class="form-control style_2" id="name_contact" name="name_contact" placeholder="Nombre">
                            <span class="input-icon"><i class="icon-user"></i></span>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="text" class="form-control style_2" id="lastname_contact" name="lastname_contact" placeholder="Apellidos">
                            <span class="input-icon"><i class="icon-user"></i></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="email" id="email_contact" name="email_contact" class="form-control style_2" placeholder="Correo electrónico">
                            <span class="input-icon"><i class="icon-email"></i></span>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="text" id="phone_contact" name="phone_contact" class="form-control style_2" placeholder="Número de teléfono">
                            <span class="input-icon"><i class="icon-phone"></i></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<textarea rows="5" id="message_contact" name="message_contact" class="form-control" placeholder="Escribe tu mensaje" style="height:200px;"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<input type="text" id="verify_contact" class=" form-control" placeholder="¿Eres humano? 3 + 1 =">
						<input type="submit" value="Submit" class=" button_medium" id="submit-contact"/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</section>

<?php get_footer(); ?>