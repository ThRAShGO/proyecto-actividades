<div class="col-xs-12 col-md-8 col-lg-8">
<?php if ($result): ?>
    <h5>Obtenidos <?php echo count($result); ?> resultados.</h5>
    <div class="list-group">
     <?php global $post; ?>
     <?php foreach ($result as $post): ?>
     <?php setup_postdata($post); ?>
         <div class="item-list" id="post-<?php the_ID(); ?>">
             <h4>
                 <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                 <?php the_title(); ?></a> 
                 <br>
                 <small class="pull-right"><?php the_author() ?> || <?php the_time('F jS, Y') ?> </small>
             </h4>
         </div>
     <?php endforeach; ?>
    </div>
     <?php else : ?>
        <div class="col-lg-12">
            <div class=" empty">
            <h3 class="text-center">¿No has encontrado lo que buscabas?</h3>
            <p class="text-center">Vuelve a intentarlo con otros criterios de búsqueda</p>
            </div>
            <div class="formuavanzado">
              <?php get_template_part("search", "advanced"); ?>   
            </div>
           
        </div>
<?php endif; 
    wp_reset_query();
?>
</div>
<div class="col-md-4" id="side">
            <?php get_sidebar(); ?>
        </div>