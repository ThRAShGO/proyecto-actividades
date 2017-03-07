<div class="nodest-wrapper">
    <div class="col-lg-12"><a class="postnodestacado" href="<?php the_permalink()?>"><h3 class="page-title"><?php the_title(); ?></h3></a></div>
    <div class="col-lg-3">
        <?php
            the_post_thumbnail('thumbnail', array('class' => 'responsive-img'));
        ?>
    </div>
    <div class="col-lg-9">
        <?php
               
                the_excerpt();
                ?> 
        <span class="fa fa-comment"></span>
            <?php comments_number(' No hay comentarios',' 1 comentario', ' % comentarios'); ?>
    </div>
</div>