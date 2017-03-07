<?php

/* funcion que añade un action hook*/
/*add_action('wp_head','show_template');
function show_template(){
    global $template;
    print_r($template);
}*/

/* Añadimos soporte para los post-thumbnails en el backend */
add_theme_support('post-thumbnails');

add_theme_support( 'post-formats' , array('image', 'gallery', 'video', 'audio', 'link', 'quote') );

// Funcion para obtener las dos primeras categorias para el post destacado
function getPrimerasCategorias ($categorias){
    $cadenaTratada = '';
    if(count($categorias) >= 2){
        $cadenaTratada = $categorias[0].' & '.$categorias[1];
    }elseif(count($categorias) == 1){
        $cadenaTratada = $categorias[0];
    }

    return $cadenaTratada;
}

//Obtine ruta de la img destacada del post
function getUrlThumbnail($id, $size = 'small'){
    return wp_get_attachment_image_src(get_post_thumbnail_id($id), $size)[0];
}

// hook parametros(como se llama la funcion,funcion que va a modificar)
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($more){
    global $post;
    return '<a class="more" href="' . get_permalink($post->ID). '"> Seguir Leyendo</a>';
}

function aniadirjqueryaltema (){
    //con esto quitamos los previos jquery que este cargando la pagina para que solo use el nuestro
    wp_deregister_script('jquery');
    //nombre que le damos a nuestra funcion, url de donde esta el script
    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js", false, null);
    wp_enqueue_script('jquery');
}

if(!is_admin()){
    add_action('wp_enqueue_scripts', 'aniadirjqueryaltema',11);
}

/* este filtro hook inserta un custom-class a clases de la etiqueta img en wp
* en este caso la clase img-responsive de bootstrap
*/
//add_filter('the_content', 'add_responsive_class');
//function add_responsive_class($content){
//    if($content){//convertimos el contenido a codificacion HTML en UTF8
//    $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
//    //
//    $document = new DOMDocument();
//    //deshabilitamos los errores xml y dejamos que los administre el usuario ya que no tenemos el codigo completo (puede faltar el <html><body> etc)
//    libxml_use_internal_errors(true);
//    //cargamos el contenido en el objeto dom
//    $document->loadHTML(utf8_decode($content));
//    //cogemos todos los img del dom y los guardamos en un array
//    $imgs = $document->getElementsByTagName('img');
//    //recorremos el array y le agregamos a cada elemento lqa clase
//    foreach($imgs as $img){
//        $img->setAttribute('class', 'img-responsive');
//    }
//    //salvamos los cambios
//    $html = $document->saveHTML();
//    
//    return $html;
//    }
//}

add_filter('the_content', 'add_responsive_class');
function add_responsive_class($content){
    if($content){//convertimos el contenido a codificacion HTML en UTF8
        $post_format  =get_post_format();
        switch($post_format){
            case 'quote':
                //añadimos la clase my_quote al primer parrafo del post tipo quote
                $newcontent = preg_replace('/<p([^>]+)?>/', '<p$1 class="my_quote">', $content, 1);
                //añadimos la clase my_quote_author al segundo parrafo del post tipo quoted_printable_decode
                return preg_replace('/<p([^>]+)?>/', '<p$1 class="my_quote_author">', $newcontent, 2);
                break;
            default:
                //convertimos el contenido en una codificacion html
                $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
                //representa al documento HTML
                $document = new DOMDocument();
                //deshabilitamos los errores xml y dejamos que los administre el usuario ya que no tenemos el codigo completo (puede faltar el <html><body> etc)
                libxml_use_internal_errors(true);
                //cargamos el contenido en el objeto dom
                $document->loadHTML(utf8_decode($content));
                //cogemos todos los img del dom y los guardamos en un array
                $imgs = $document->getElementsByTagName('img');
                //recorremos el array y le agregamos a cada elemento lqa clase
                foreach($imgs as $img){
                    $img->setAttribute('class', 'img-responsive');
                }
                //salvamos los cambios
                $html = $document->saveHTML();

                return $html;
        }
    }
}

function filter_get_pages($pages, $r){
    if(!is_admin()){
        
        //$pages es una variable global que contiene un array de objetos que son las paginas que hemos creado en el backend
        foreach($pages as $page){
            $link = get_page_link($page->ID); //es una funcion que devuelve una pagina
            if($page->post_title == 'portfolio'){
                echo '<li><a href="' . esc_url(home_url()) . '#portfolio">' . $page->post_title . '</a></li>';
            } else {
                //no queremos el link en el listado del menu principal. Lo manejaremos por separado
                if($page->post_title != 'Archivos'){
                    echo '<li><a href="' . $link . '">' . $page->post_title .'</a></li>';
                }
            }
        }
    } else {
        return $pages;
    }
}

add_filter('get_pages', 'filter_get_pages', 10, 2);

//Para activar los plugin/widgets
    add_action('widgets_init', 'active_plugins');
    function active_plugins(){
        register_sidebar(array( 'name' => __('Sidebar default'),
                                'id' => 'sidebar',
                                'description' => __('Sidebar por defecto personalizado'),
                                'before_widget' => '<div class="widget %2$s">',
                                'after_widget' => '</div>'
                            
        ));
        
        register_sidebar(array( 'name' => __('Sidebar menu'),
                                'id' => 'sidebarmenu',
                                'description' => __('Sidebar por defecto personalizado para el menu'),
                                'before_widget' => '<div class="widget widget-menu %2$s">',
                                'after_widget' => '</div>'
                            
        ));
    }

//funcion que comprueba si el usuario tiene gravatar devolviendo true si es afirmativo o false si es negativo
function has_gravatar($email){
    //ciframos la cuenta de email
    $hash = md5(strtolower(trim($email)));
    //generamos la supuesta uri del gravatar si existe
    $uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
    //recuperamos todas las cabeceras enviadas por el servidor en respuesta a una peticion html
    $headers = @get_headers($uri);
    //si tiene gravatar debe aparecer un 200 en la uri
    if(!preg_match("|200|", $headers[0])){
        $has_valid_avatar = FALSE;
    } else {
        $has_valid_avatar = TRUE;
    }
    return $has_valid_avatar;
}

//funcion que comprueba si el usuario tiene foto devolviendo true si tiene o false si no tiene
/*function has_pic($name){
    $result = false;
    $extensions = array('jpg', 'jpeg', 'png', 'gif');
    
    foreach($extensions as $extension){
        $file = get_template_directory_uri() . "/authorImage/" . $name . "." . $extension;
        if(file_exists($file)){
            return $file;
        } else {
            $file = '';
        }
    }
    return $result;
}*/

//Funcion que devuelve la url de la img del autor si la tiene o false (funcion de jaime que si opera)
    function has_pic($name){    
        
        $regex = '/http:\/\/localhost\/wp\//';
        $result = false;
        
        $formats = array ('.jpg', '.jpeg', '.png', '.svg', '.gif');
        
        foreach($formats as $val){
            $url_img = get_template_directory_uri() . '/authorImg/' . $name . $val;
            if(file_exists(preg_replace($regex, './', $url_img) ) ){
                $result = $url_img;
            }
        }
        return $result;
    }

function add_extra_profile_fields($user){
    ?>
    <h3>Perfiles extra</h3>
    <table class="form-table">
        <tr>
            <th><label for="twitter">Twitter</label></th>
            <td>
                <input type="text" id="twitter" name="twitter" class="regular-text" value="<?php echo esc_attr(get_the_author_meta('twitter', $user->ID)) ?>">
                <span class="description">Introduce tu usuario de Twitter.</span>
            </td>
        </tr>
        <tr>
            <th><label for="Facebook">Facebook</label></th>
            <td>
                <input type="text" id="facebook" name="facebook" class="regular-text" value="<?php echo esc_attr(get_the_author_meta('facebook', $user->ID)) ?>">
                <span class="description">Introduce tu usuario de Facebook.</span>
            </td>
        </tr>
    </table>
        
    <?php
}
add_action('show_user_profile', 'add_extra_profile_fields');
add_action('edit_user_profile', 'add_extra_profile_fields');

function save_extra_profile_fields($user_id){
    if(!current_user_can('edit_user', $user_id)){
        return false;
    }
    update_usermeta($user_id, 'twitter', $_POST['twitter']);
    update_usermeta($user_id, 'facebook', $_POST['facebook']);
}

add_action('personal_options_update', 'save_extra_profile_fields');
add_action('edit_user_profile_update', 'save_extra_profile_fields');

function add_skills($user){
    ?>
    <h3>Habilidades</h3>
    <table class="form-table">
        <tr>
            <th><label for="habilidad1">Habilidad 1</label></th>
            <td>
                <input type="text" id="nombrehabilidad1" name="nombrehabilidad1" class="regular-text" value="<?php echo esc_attr(get_the_author_meta('nombrehabilidad1', $user->ID)) ?>">
                <span class="description">Introduce el nombre de tu habilidad.</span><br>
                <input type="text" id="habilidad1" name="habilidad1" class="regular-text" value="<?php echo esc_attr(get_the_author_meta('habilidad1', $user->ID)) ?>">
                <span class="description">Introduce tu habilidad en porcentaje.</span>
            </td>
        </tr>
        <tr>
            <th><label for="habilidad2">Habilidad 2</label></th>
            <td>
                <input type="text" id="nombrehabilidad2" name="nombrehabilidad2" class="regular-text" value="<?php echo esc_attr(get_the_author_meta('nombrehabilidad2', $user->ID)) ?>">
                <span class="description">Introduce el nombre de tu habilidad.</span><br>
                <input type="text" id="habilidad2" name="habilidad2" class="regular-text" value="<?php echo esc_attr(get_the_author_meta('habilidad2', $user->ID)) ?>">
                <span class="description">Introduce tu habilidad en porcentaje.</span>
            </td>
        </tr>
        <tr>
            <th><label for="habilidad3">Habilidad 3</label></th>
            <td>
                <input type="text" id="nombrehabilidad3" name="nombrehabilidad3" class="regular-text" value="<?php echo esc_attr(get_the_author_meta('nombrehabilidad3', $user->ID)) ?>">
                <span class="description">Introduce el nombre de tu habilidad.</span><br>
                <input type="text" id="habilidad3" name="habilidad3" class="regular-text" value="<?php echo esc_attr(get_the_author_meta('habilidad3', $user->ID)) ?>">
                <span class="description">Introduce tu habilidad en porcentaje.</span>
            </td>
        </tr>
        <tr>
            <th><label for="habilidad4">Habilidad 4</label></th>
            <td>
                <input type="text" id="nombrehabilidad4" name="nombrehabilidad4" class="regular-text" value="<?php echo esc_attr(get_the_author_meta('nombrehabilidad4', $user->ID)) ?>">
                <span class="description">Introduce el nombre de tu habilidad.</span><br>
                <input type="text" id="habilidad4" name="habilidad4" class="regular-text" value="<?php echo esc_attr(get_the_author_meta('habilidad4', $user->ID)) ?>">
                <span class="description">Introduce tu habilidad en porcentaje.</span>
            </td>
        </tr>
    </table>
        
    <?php
}

add_action('show_user_profile', 'add_skills');
add_action('edit_user_profile', 'add_skills');

function save_skills($user_id){
    if(!current_user_can('edit_user', $user_id)){
        return false;
    }
    update_usermeta($user_id, 'nombrehabilidad1', $_POST['nombrehabilidad1']);
    update_usermeta($user_id, 'habilidad1', $_POST['habilidad1']);
    update_usermeta($user_id, 'nombrehabilidad2', $_POST['nombrehabilidad2']);
    update_usermeta($user_id, 'habilidad2', $_POST['habilidad2']);
    update_usermeta($user_id, 'nombrehabilidad3', $_POST['nombrehabilidad3']);
    update_usermeta($user_id, 'habilidad3', $_POST['habilidad3']);
    update_usermeta($user_id, 'nombrehabilidad4', $_POST['nombrehabilidad4']);
    update_usermeta($user_id, 'habilidad4', $_POST['habilidad4']);
}

add_action('personal_options_update', 'save_skills');
add_action('edit_user_profile_update', 'save_skills');

//agregamos post personalizados
// require_once('template-parts/custompost.php');

//require_once('template-parts/shortcodes.php');

    function controll_page($type = 'plain' , $endsize = 1 , $midsize=1){
        echo get_controll_page($type, $endsize, $midsize);
    }

    //Funcion para obtener los controles de la paginacion
    function get_controll_page($type = 'plain' , $endsize = 1 , $midsize=1){
        // debemos declarar la variable global wp_query para poder interactuar con ella
    // $wp_rewrite se usa para usar la función de los links
    global $wp_query, $wp_rewrite;
    
    $current = get_query_var('paged') > 1 ? get_query_var('paged') : 1;
    
    if(! in_array($type,array('plain', 'list', 'array'))){
        $type = 'plain';    
    } 
        
    // Ponemos los valores de$endsize y $midsize con un valor entero, para ello u
    $endsize = absint($endsize);
    $midsize = absint($midsize);
    
    $pagination = array(
        // El @ delante de la fucion
        'base' => @add_query_arg('paged', '%#%'), //esta @ elimina el echo de los warnings
        'format' => '', //formato de la url
        'total' => $wp_query->max_num_pages, //total de las páginas a mostrar
        'current' => $current, //página en la que estas situada
        'show_all' => false, //Muestra todas las páginas
        'end_size' => $endsize, //Cuantos números se mostrarán al principio y fin de la página
        'midsize' => $midsize, //Cuantos números mostrar en la página al principio y fin 
        'type' => $type, //tipo de estructura que va a devolver, los valores de los arrays
        'prev_text' => '&lt;&lt;', //lo que saldrá en las etiquetas de anterior
        'next_text' => '&gt;&gt;' //lo que saldrá en las etiquetas de siguiente
    );
    
    // Las funciones que tenemos en la parte de abajo son para evitar fallos en caso de que los permalinks 
    // Además buscamos si los resultados vienen del formulario de búsqueda
    
    if($wp_rewrite->using_permalinks()){
        $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))).'page/%#%', 'paged');
    }
    
    if(!empty($wp_query->query_vars['s'])){
        $pagination['add_args'] = array('s' => get_query_var('s'));
    }
    
    return paginate_links($pagination);
    }


    function dp_recent_comments($no_comments = 10, $comment_len = 35) {
        global $wpdb;
        
        $request = "SELECT * FROM $wpdb->comments";
        $request .= " JOIN $wpdb->posts ON ID = comment_post_ID";
        $request .= " WHERE comment_approved = '1' AND post_status = 'publish' AND post_password = ''";
        $request .= " ORDER BY comment_date DESC LIMIT $no_comments";
        $comments = $wpdb->get_results($request);
        
        if ($comments) {
            foreach ($comments as $comment) { //Guardamos los valores en comment para mostrarlos
                ob_start();
                ?>
                <li>
                <a href="<?php echo get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID; ?>">
                <?php echo dp_get_author($comment); ?>:
                </a>
                <?php echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len)); ?>
                </li>
                <?php
                ob_end_flush();
            }
        } else {
            echo '<li>' . __('No comments', 'banago') . '';
        }
    }
    
    function dp_get_author($comment){
        $author="";
        if(empty($comment->comment_author))
            $author = __('Anonymous', 'banago');
        else
            $author = $comment->comment_author;
        return $author;
    }
    
    
    function dp_get_popular_posts(){
        global $wpdb;
        $now= gmdate("Y-m-d H:i:s", time());
        $lastmonth = gmdate("Y-m-d H:i:s", gmmktime(date("H"), date("i"), date("s"), date("m")-12, date("d"), date("Y")));
        $popularposts= " SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS 'stammy' FROM $wpdb->posts, $wpdb->comments WHERE comment_approved = '1' AND $wpdn->posts.ID = $wpdb->comments.comment_post_ID AND post_status='publish' AND post_date <'$now' AND post_date > '$lastmonth' AND comment_status = 'opne' GROUP BY $wpdb->comments.comment_post_ID ORDER BY stammy DESC LIMIT 6";
        $posts = $wpdb->get_results($popularposts);
        $popular = '';
        
        if($posts){
            foreach($posts as $post){
                $post_title = stripslashes($post->post_title);
                $guid = get_permalink($post->ID);
                $popular .= '<li><a href="'. $guid . '" title ="' .$post_title.'">'. $post_title. '</a></li>';
                $i++;
            }
        }
        echo $popular;
        }
        
        // paginacion
            // function get_paginate_page_links( $type = 'list' , $endsize = 1 , $midsize = 1 ) {
            //     global $custom_query, $wp_rewrite;
             
            //     $current = get_query_var('paged') > 1 ? get_query_var('paged') : 1;
                
            //     if(! in_array($type, array('plain','list', 'array'))) $type = 'plain' ;
                
            //     $endsize = absint($endsize);
            //     $midsize = absint($midsize);
                
            //     $pagination = array(
            //                 'base' => @add_query_arg('paged' , '%#%'),
            //                 'format' => '',
            //                 'total' => $custom_query->max_num_pages,
            //                 'current' => $current,
            //                 'show_all' => false,
            //                 'end_size' => $endsize,
            //                 'mid_size' => $midsize,
            //                 'prev_next' => true,
            //                 'prev_text' => __('« Previous'),
            //                 'next_text' => __('Next »'),
            //                 'type' => $type 
            //     );
                
            //     //Re-construimos la url segun el tipo de pag
            //     if($wp_rewrite->using_permalinks()){
            //         $pagination['base'] = user_trailingslashit (trailingslashit( remove_query_arg('s', get_pagenum_link(1) ) ).'page/%#%/', paged);
            //     }
                
            //     if( ! empty ($custom_query->query_vars['s'])){
            //         $pagination['add_args'] = array ('s' => get_query_var);
            //     }
                
            //     return paginate_links($pagination);
            // }
?>