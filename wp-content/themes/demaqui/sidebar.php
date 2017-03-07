<div class=" box_style_1">
	<?php get_search_form(); ?>
    
	<div class="widget">
		<h4>Calendario</h4>
		 <?php get_calendar(); ?>
	</div><!-- End widget -->
   
    
	<div class="widget">
	    <h4>Post Recientes</h4>
        <ul class="recent_post">
            <?php
            	$args = array( 'numberposts' => '5' );
            	$recent_posts = wp_get_recent_posts( $args );
            	foreach( $recent_posts as $recent ){
            ?>
            		<li>
            			<i class="icon-calendar-empty"><?php the_time('l F j, Y', strtotime($recent_posts['post_date'])); ?></i>
            <?php
        				echo'<div>
        					<a class="recent" href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"] . '</a>
        				</div>
        			</li>';
            	}
            	wp_reset_query();
            ?>
        </ul>
	</div><!-- End widget -->
    
	<div class="widget tags add_bottom_30">
		<h4>Tags</h4>
         <?php wp_tag_cloud($args); ?>
	</div><!-- End widget -->
	
	
	<div class="widget">
	    <h4>Categorias</h4>
            <ul class="pag_aside">
            <?php wp_list_categories('title_li'); ?>
            </ul>
	</div><!-- End widget -->
	
		<div class="widget">
	    <h4>Comentarios</h4>
            <ul class="pag_aside">
            <?php dp_recent_comments(4); ?>
            </ul>
	</div><!-- End widget -->
                
</div><!-- End box-sidebar -->



<!---------------------------------- FIN ------------------------------------------->
