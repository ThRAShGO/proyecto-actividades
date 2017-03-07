<?php get_header() ?>
<?php get_template_part('nav'); ?>
<?php 
    /* obtener el ID de la pagina -- estamos fuera del LOOP */
    /* si estuvieramos dentro del loop nos devolveria el id del post, no de la pagina */
    global $post;
    $ID_pag = $post->ID;
    $nComentarios = get_comments_number(' No hay comentarios', ' 1 comentario', ' % comentarios');
?>
    <section id="sub-header">
        <div class="container">
        	<div class="row">
        		<div class="col-md-10 col-md-offset-1 text-center">
        			<h1>Learn Blog</h1>
        			<p class="lead boxed ">Ex utamur fierent tacimates duis choro an</p>
        			<p class="lead">
        				Lorem ipsum dolor sit amet, ius minim gubergren ad. At mei sumo sonet audiam, ad mutat elitr platonem vix. Ne nisl idque fierent vix. 
        			</p>
        		</div>
        	</div><!-- End row -->
        </div><!-- End container -->
        <div class="divider_top"></div>
        </section><!-- End sub-header -->
        
        <section id="main_content">
        
        <div class="container">
        
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li class="active">Active page</li>
        </ol>
        
        	 <div class="row">
             <aside class="col-md-4">
        		<?php get_sidebar(); ?>
             </aside><!-- End aside -->
             
             <div class="col-md-8">
             		<div class="post">
        					<a href="blog_post.html" title="single_post.html"><img src="<?php echo getUrlThumbnail($ID_pag, 'full') ?>" alt="" class="img-responsive"></a>
        					<div class="post_info clearfix">
        						<div class="post-left">
        							<ul>
        								<li><i class="icon-calendar-empty"></i>Fecha <span><?php the_time('j F,Y'); ?></span></li>
        								<li><i class="icon-user"></i>Por <a href="#"><?php the_author(); ?></a></li>
        								<li><i class="icon-tags"></i>Tags <a href="#">Works</a> <a href="#">Personal</a></li>
        							</ul>
        						</div>
        						<div class="post-right"><i class="icon-comment"></i><a href="#">25 </a>Comments</div>
        					</div>
        					<h2><a href="single_post.html" title="single_post.html"><?php the_title() ?></a></h2>
        					<p>
        						<?php the_content() ?>
        					</p>
        				</div><!-- end post -->
                        
                        <hr>
                        
        				
        					<?php 
        					if(comments_open($ID_pag)){
        					    comments_template(); 
        					}
        					?>
                        
        				
                        
             </div><!-- End col-md-8-->   
          
        	
          </div>  <!-- End row-->    
        </div><!-- End container -->
        </section><!-- End main_content-->

<?php get_footer() ?>