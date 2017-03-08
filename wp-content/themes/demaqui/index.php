<?php get_header(); ?>

<?php get_template_part('nav'); ?>
<!----- header ----->

<!--<section id="sub-header">-->
<!--<div class="container">-->
<!--	<div class="row">-->
<!--		<div class="col-md-10 col-md-offset-1 text-center">-->
<!--			<h1>Learn Blog</h1>-->
<!--			<p class="lead  ">Ex utamur fierent tacimates duis choro an</p>-->
<!--			<p class="lead">-->
<!--				Lorem ipsum dolor sit amet, ius minim gubergren ad. At mei sumo sonet audiam, ad mutat elitr platonem vix. Ne nisl idque fierent vix. -->
<!--			</p>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!--<div class="divider_top"></div>-->
<!--</section>-->

<?php
	$args = array ('post_count' => '1','nopaging' => true);
	$miQuery = new WP_Query($args);
	if($miQuery->have_posts()) {
	$miQuery->the_post();
	
	$idPostDestacado = $post->ID;
	$thumbnail_url = getUrlThumbnail($post->ID,'full');
	$autor = get_the_author();
	$autorlink = get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) );
	$fecha = get_the_time('j F, Y');
	$permalinkTitulo =  get_the_permalink();
	$titulo = get_the_title();
	$resumen = get_the_excerpt();
	$args = array('fields' => 'names');
    $categories = get_the_category();
	$output = '';
	if ( ! empty( $categories ) ) {
	    foreach( $categories as $category ) {
	        $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'Ver todos los post en %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . ' ';
	    }
	}
    // $dos_categorias = getPrimerasCategorias($categorias);
	$nComentarios = get_comments_number(' No hay comentarios', ' 1 comentario', ' % comentarios');
	
	$salida ='<section id="sub-header-custom" style="background-image: url('. $thumbnail_url .'); background-size: cover; background-repeat: no-repeat; background-position: center;">'.
				'<div class="container">'.
					'<div class="row">'.
						'<div class="col-md-10 col-md-offset-1 text-center post-destacado">'.
							'<h1><a href="'. $permalinkTitulo . '">' . $titulo .'</a></h1>'.
							'<p class="lead">'. $resumen .'</p>'.
							'<div class="post-left">'.
								'<ul>'.
									'<li><i class="icon-calendar-empty"></i>En <span>'. $fecha .'</span></li>'.
									'<li><i class="icon-user"></i>Por<a href="'. $autorlink .'"> '. $autor .'</a></li>'.
									'<li><i class="icon-tags"></i>Categorias '. $output .'</li>'.
								'</ul>'.
							'</div>'.
						'</div>'.
					'</div>'.
				'</div>'.
			'<div class="divider_top"></div>'.
			'</section>';
	echo $salida;
	} else {
	echo 'No hay posts';
	}
	wp_reset_query();
?>

<section id="main_content">

<div class="container">

<?php include (TEMPLATEPATH  . '/breadcrumbs.php'); ?>

	 <div class="row">
     <aside class="col-md-4">
        <?php get_sidebar(); ?>
     </aside><!-- End aside -->
     
     <div class="col-md-8">
		<?php
			$paged = get_query_var('paged') ? get_query_var('paged') : 1; 
            $argumentos = array(
			                'orderby' => 'date',
			                'post_type'=> array( 'post'),
			                'post__not_in' => array($idPostDestacado),
			                'nopaging' => false,
			                'paged' => $paged
			                );
            $custom_query = new WP_Query($argumentos);
			if($custom_query->have_posts()) {
				while ($custom_query->have_posts()){
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
				}
				echo '<div class="text-center">';
				echo '<ul class="pagination">';
                echo controll_page();
                echo '</ul>';
                echo '</div>';
			} else {
				echo 'No hay posts';
			}
			wp_reset_query();
		?>
       
	<!-- <div class="post">-->
	<!--	<a href="blog_post.html" title="single_post.html"><img src="<?php //bloginfo('template_directory'); ?>/img/blog-3.jpg" alt="" class="img-responsive"></a>-->
	<!--	<div class="post_info clearfix">-->
	<!--		<div class="post-left">-->
	<!--			<ul>-->
	<!--				<li><i class="icon-calendar-empty"></i>On <span>12 Nov 2020</span></li>-->
	<!--				<li><i class="icon-user"></i>By <a href="#">John Smith</a></li>-->
	<!--				<li><i class="icon-tags"></i>Tags <a href="#">Works</a> <a href="#">Personal</a></li>-->
	<!--			</ul>-->
	<!--		</div>-->
	<!--		<div class="post-right"><i class="icon-comment"></i><a href="#">25 </a>Comments</div>-->
	<!--	</div>-->
	<!--	<h2><a href="single_post.html" title="single_post.html">Duis aute irure dolor in reprehenderit</a></h2>-->
	<!--	<p>-->
	<!--		Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec, luctus a, lorem.....-->
	<!--	</p>-->
	<!--	<a href="single_post.html" class="button_medium" title="single_post.html">Read more</a>-->
	<!--</div>-->
	
		<!--<hr>-->
                
	    <!--<div class="text-center">-->
	    <!--	Espacio paginacion-->
	    <!--    <ul class="pagination">-->
	    <!--        
	    <!--    </ul>-->
	    <!--</div>-->
     <!--</div>-->
	
  </div>  <!-- End row-->    
</div><!-- End container -->
</section><!-- End main_content-->



       
<!-- Footer -->      
<?php get_footer(); ?>		