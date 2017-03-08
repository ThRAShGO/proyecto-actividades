<?php get_header(); ?>
<?php get_template_part('nav'); ?>
<?php
    $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
// si tiene nombre lo uso, si no uso la cuenta de login
?>

<section id="sub-header">
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<h1><?php echo $curauth->user_nicename; ?></h1>
			<p class="lead">Conocelo todo a cerca de el</p>
		</div>
	</div><!-- End row -->
</div><!-- End container -->
<div class="divider_top"></div>
</section><!-- End sub-header -->

<div class="container">
    <hr>
    <?php include (TEMPLATEPATH  . '/breadcrumbs.php'); ?>
    <hr>
      <div class="row">
     <aside class="col-md-4">
     	<div class=" box_style_1 profile">
     	<?php
     	    if(has_gravatar($curauth->user_email)){
               $foto = get_avatar_url($curauth->user_email, array('size' => '512'));
            } else {
                $foto = "/wp-content/themes/demaqui/img/default.jpg";
            }
     	?>
		<p class="text-center"><img src="<?php echo $foto ?>" alt="Teacher" class="img-circle styled img-responsive"></p>
        		  <ul class="social_teacher">
                    <li><a href="#"><i class="icon-facebook"></i></a></li>
                    <li><a href="#"><i class="icon-twitter"></i></a></li>
                    <li><a href="#"><i class=" icon-google"></i></a></li>
                </ul>   
                 <ul>
                     <li>Nombre <strong class="pull-right"><?php echo $curauth->nickname; ?></strong> </li>
                     <li>Email <strong class="pull-right"><?php echo $curauth->user_email; ?></strong></li>
                     <li>Fecha de registro <strong class="pull-right"><?php echo $curauth->user_registered; ?></strong></li>
                </ul>
              
			</div><!-- End box-sidebar -->
     </aside><!-- End aside -->
     
     <div class="col-md-8">
     
     			<!--  Tabs -->   
                    <ul class="nav nav-tabs" id="mytabs">
                        <li class="active"><a href="#profile_teacher" data-toggle="tab">Profile</a></li>
                    </ul>
                    
                     <div class="tab-content">
                    
                        <div class="tab-pane fade in active" id="profile_teacher">
                        <h3>Biografia:</h3>
                        <p><?php echo $curauth->description ?></p>
                     	<h4>Ultimo post:</h4>
						<div class="row">
                        	<div class="col-md-12">
                            	<?php
            $argumentos = array(
                            'author' => $curauth->user_name,
                            'post_count' => '1',
			                'orderby' => 'date',
			                'post_type'=> array( 'post'),
			                'nopaging' => true,
			                );
            $custom_query = new WP_Query($argumentos);
			if($custom_query->have_posts()) {
					$custom_query->the_post();
					
					// $post_thumbnail = get_the_post_thumbnail();
					$thumbnail_url = getUrlThumbnail($post->ID,'full');
					$autor = get_the_author();
					$autorlink = get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) );
					$fecha = get_the_time('j F, Y');
					$permalinkTitulo =  get_the_permalink();
					$titulo = get_the_title();
					$resumen = get_the_excerpt();
					$categories = get_the_category();
					$output = '';
					if ( ! empty( $categories ) ) {
	    				foreach( $categories as $category ) {
	        				$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'Ver todos los post en %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . ' ';
						}
					}
					$comentarios = get_comments_number();
    				$palabra = 'Comentario';
    				if($comentarios != 1){
        				$palabra .= 's';
    				}
					
					$salida ='<div class="post">'.
							'<a href="blog_post.html" title="single_post.html"><img src="'. $thumbnail_url .'" alt="" class="img-responsive index-thumbnail-blog"></a>'.
							'<div class="post_info clearfix">'.
								'<div class="post-left">'.
									'<ul>'.
										'<li><i class="icon-calendar-empty"></i>En <span>'. $fecha .'</span></li>'.
										'<li><i class="icon-user"></i>Por<a href="'. $autorlink .'"> '. $autor .'</a></li>'.
										'<li><i class="icon-tags"></i>Categorias '. $output .'</li>'.
									'</ul>'.
								'</div>'.
								'<div class="post-right"><i class="icon-comment"></i>'.$comentarios . ' ' . $palabra .'</div>'.
							'</div>'.
							'<h2><a href="'. $permalinkTitulo .'" title="'. $permalinkTitulo .'">'. $titulo .'</a></h2>'.
							$resumen .
						'</div><!-- end post -->';
					echo $salida;
			} else {
				echo 'No hay posts disponibles';
			}
			wp_reset_query();
		?>
                            </div>
                        </div> <!-- End row--> 
                       </div><!-- End tab-pane --> 
                  </div>   <!-- End content-->              
		
     </div><!-- End col-md-8-->   	
  </div><!-- End row-->   
</div><!-- End container -->
</section><!-- End main_content-->

<?php get_footer() ?>