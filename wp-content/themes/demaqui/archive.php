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
			if(have_posts()) {
				while (have_posts()){
					the_post();
					
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
			} else {
				echo 'No hay posts';
			}
			wp_reset_query();
		?>
	
		<hr>
                
	    <div class="text-center">
	    	Espacio paginacion
	        <ul class="pagination">
	            <?php
                	echo get_paginate_page_links(); 
                ?>
	        </ul>
	    </div>
     </div><!-- End col-md-8-->   
	
  </div>  <!-- End row-->    
</div><!-- End container -->
</section><!-- End main_content-->



       
<!-- Footer -->      
<?php get_footer(); ?>	