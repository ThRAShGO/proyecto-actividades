<div class="col-sm-12 nodest-wrapper">
    <div class="post-header">
        <a href="<?php the_permalink() ?>"><h3><?php echo get_the_title() ?></h3></a>
    </div>
    <div class="post-body">
        <?php echo get_the_content(); ?>
    </div>
    <div class="post-footer">
        <span class="fa fa-comment"></span>
            <?php comments_number(' No hay comentarios',' 1 comentario', ' % comentarios'); ?>
    </div>
</div>