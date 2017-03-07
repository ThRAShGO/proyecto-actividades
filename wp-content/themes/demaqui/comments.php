<?php

    $comentarios = get_comments_number();
    $palabra = 'comentario';
    if($comentarios != 1){
        $palabra .= 's';
    }
    _e('<h4> '. $comentarios . ' ' . $palabra . ' en "' . get_the_title() . '"</h4>');
?>
    <ol id="comments">
        <?php 
        wp_list_comments( array( 
            'style' => 'ol',
            'avatar_size' => 96,
        ) ); 
        ?>
    </ol>
<?php
    //nos saca el formulario por defecto de wordpress para los comentarios
    comment_form();

    /* si el post actual está protegido con una password y el usuario no la ha introducido simplementes nos vamos de la plantilla y no se visualia nada */
    if(post_password_required()){
        return;
    }

    ?>