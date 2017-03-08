<?php get_header() ?>
<?php get_template_part('nav'); ?>
<section id="sub-header">
        <div class="container">
        	<div class="row">
        		<div class="col-md-10 col-md-offset-1 text-center">
        			<h1>
        			    <?php
            			    if(is_category()){
                                    printf(__('Categoria: %s', 'shape'), '<span>' . single_cat_title('', false) . '</span>');
                                } else if(is_tag()){
                                    printf(__('Tag: %s', 'shape'), '<span>' . single_tag_title('', false) . '</span>');
                                } else if(is_author()){
                                    the_post();
                                    printf(__('Autor: %s', 'shape'), '<span>' . the_author() . '</span>');
                                    rewind_posts();
                                } else if(is_day()){
                                    printf(__('Diarios: %s', 'shape'), '<span>' . get_the_date() . '</span>');
                                } else if (is_month()){
                                    printf(__('Mensuales: %s', 'shape'), '<span>' . get_the_date('F Y') . '</span>');
                                } else if(is_year()){
                                    printf(__('Anuales: %s', 'shape'), '<span>' . get_the_date('Y') . '</span>');
                                } else{
                                    _e('Archivos', 'shape');
                                }
                        ?>
        			</h1>
        			<!--<p class="lead boxed ">Ex utamur fierent tacimates duis choro an</p>-->
        			<p class="lead boxed">
        			    <?php 
            				if(have_posts()){
                                $total_results = $wp_the_query->post_count;
                                if(total_results > 1){
                                    echo $total_results . " POSTS ENCONTRADOS";
                                } else {
                                    echo $total_results . " POST ENCONTRADOS";
                                }
                            } 
                        ?>
        			</p>
        		</div>
        	</div><!-- End row -->
        </div><!-- End container -->
        <div class="divider_top"></div>
        </section><!-- End sub-header -->
<section id="main_content">

<div class="container">

<?php include (TEMPLATEPATH  . '/breadcrumbs.php'); ?>

<?php
?>
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
					$autorlink = get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ));
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
								'<div class="post-right"><i class="icon-comment"></i> '. $comentarios . ' ' . $palabra .'</div>'.
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
     </div><!-- End col-md-8-->   
	
  </div>  <!-- End row-->    
</div><!-- End container -->
</section><!-- End main_content-->



       
<!-- Footer -->      
<?php get_footer(); ?>	