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
	
	$thumbnail_url = getUrlThumbnail($post->ID,'full');
	$autor = get_the_author();
	$autorlink = get_the_author_link();
	$fecha = get_the_time('j F, Y');
	$permalinkTitulo =  get_the_permalink();
	$titulo = get_the_title();
	$resumen = get_the_excerpt();
	$args = array('fields' => 'names');
    $categorias = wp_get_post_categories($post->ID, $args);
    $dos_categorias = getPrimerasCategorias($categorias);
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
									'<li><i class="icon-user"></i>Por<a href="'. $authorlink .'"> '. $autor .'</a></li>'.
									'<li><i class="icon-tags"></i>Tags '. $dos_categorias .'</li>'.
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
		global $paged;
			$args = array (
				'offset' => '1',
				'orderby' => 'date',
				'order' => 'DESC',
				'posts_per_page' => 2,
				'post_type' => array('post', 'jam_post')
				);
			$miQuery = new WP_Query($args);
			if($miQuery->have_posts()) {
				while ($miQuery->have_posts()){
					$miQuery->the_post();
					
					// $post_thumbnail = get_the_post_thumbnail();
					$thumbnail_url = getUrlThumbnail($post->ID,'full');
					$autor = get_the_author();
					$fecha = get_the_time('j F, Y');
					$permalinkTitulo =  get_the_permalink();
					$titulo = get_the_title();
					$resumen = get_the_excerpt();
					$categorias = get_the_category();
					$nComentarios = get_comments_number(' No hay comentarios', ' 1 comentario', ' % comentarios');
					
					$salida ='<div class="post">'.
							'<a href="blog_post.html" title="single_post.html"><img src="'. $thumbnail_url .'" alt="" class="img-responsive index-thumbnail-blog"></a>'.
							'<div class="post_info clearfix">'.
								'<div class="post-left">'.
									'<ul>'.
										'<li><i class="icon-calendar-empty"></i>En <span>'. $fecha .'</span></li>'.
										'<li><i class="icon-user"></i>Por '. $autor .'</li>'.
										'<li><i class="icon-tags"></i>Tags '. $categorias .'</li>'.
									'</ul>'.
								'</div>'.
								'<div class="post-right"><i class="icon-comment"></i>'. $nComentarios .'Comentarios</div>'.
							'</div>'.
							'<h2><a href="'. $permalinkTitulo .'" title="'. $permalinkTitulo .'">'. $titulo .'</a></h2>'.
							$resumen .
						'</div><!-- end post -->';
					echo $salida;
				}
				echo '<div class="text-center">';
				echo '<div id="paginacion">';
                echo controll_page(); 
                echo '</div>';
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
	    <!--        <?php-->
     <!--           	echo //get_paginate_page_links(); -->
     <!--           ?>-->
	    <!--    </ul>-->
	    <!--</div>-->
     <!--</div>-->
	
  </div>  <!-- End row-->    
</div><!-- End container -->
</section><!-- End main_content-->



       
<!-- Footer -->      
<?php get_footer(); ?>		