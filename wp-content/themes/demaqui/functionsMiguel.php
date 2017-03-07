<?php

function wpbootstrap_scripts_with_jquery() {

 // Register the script like this for a theme:

 wp_register_script( 'custom-script', get_template_directory_uri() .
 '/js/bootstrap.min.js', array( 'jquery' ) );

 // For either a plugin or a theme, you can then enqueue the script:
 wp_enqueue_script( 'custom-script' );
 }


function wp_corenavi(){
    global $wp_query, $wp_rewrite;
    $pages = '';
    $max = $wp_query->max_num_pages;
    if(!$current = get_query_var('paged')){
        $current = 1;
    }
    $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
    $a['total'] = $max;
    $a['current'] = $current;
    
    $total = 1;
    $a['mid_size'] = 5;
    $a['end_size'] = 1;
    $a['prev_text'] = '<< Anterior';
    $a['next_text'] = 'Siguiente >>';
    
    if($max >1){
        echo '<div class="navigation">';
    }
    if($total == 1 && $max >1){
        $pages = '<span class="pages">Página ' .$current. ' de ' . $max . '</span>' . "\r\n";
        echo $pages . paginate_links ($a);        
    }    
    if($max > 1){
        echo '</div>';
    }    
    
}

function mis_widgets(){
    if(function_exists('register_sidebar'))
        register_sidebar(
        array(
        'name' => 'Sidebar index',
        'id' => 'sidebar_index',
            'before_widgets' => '<div %1$s>',
            'after_widgets' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );
    if(function_exists('register_sidebar'))
        register_sidebar(
        array(
        'name' => 'Sidebar post',
        'id' => 'sidebar_post',
            'before_widgets' => '<div %1$s>',
            'after_widgets' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );    
}

function unregister_default_wp_widgets(){
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Link');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
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







/* 
********************************************************************************
*********************** Búsqueda avanzada para wordpress ***********************
********************************************************************************
*/

function prepareArguments($query_string) {

    /* separamos los parametros del querystring */

    // operator: = like
    // s =search datas
    // f fields from
    // t taxonies



    $query_args = $_GET; //Uso get en lugar de query_string por problemas en los parametros de la vatiable
    //print_r($_GET);
    $result_array = [];
    if ($_GET['s'] == '')
        return $result_array; // Si no se ha introducido texto se para el proceso
    $result_array['operator'] = 'LIKE'; //Operador por defecto

    if ($query_args) {
        foreach ($query_args as $key => $string) {
            if ($key == 's' && $string != '') {
                $result_array['s'][] = $string;
                $words = explode(' ', $string);
                
                foreach ($words as $word) {
                    $result_array['s'][] = $word;
                }
            } else {
                if ($key == 'operator') {
                    $result_array['operator'] = ($string != 'LIKE') ? ' = ' : "LIKE";
                } else if ($key == 'author_name') {
                    $result_array['f'][] = "wp_users.user_nicename";
                } else if ($key == 'tag') {
                    if (!isset($result_array['f']) || !in_array("wp_terms.slug", $result_array['f'])) {
                        $result_array['f'][] = "wp_terms.slug";
                    }
                    $result_array['t'][] = "(wp_term_taxonomy.taxonomy = 'post_tag')";
                } else if ($key == 'category_name') {
                    if (!isset($result_array['f']) || !in_array("wp_terms.slug", $result_array['f'])) {
                        $result_array['f'][] = "wp_terms.slug";
                    }
                    $result_array['t'][] = "(wp_term_taxonomy.taxonomy = 'category')";
                }
            }
        }
    } else {
        return $search_array;
    }
    return $result_array;
}

function get_search_result($query_string) {
    $arguments = prepareArguments($query_string);
    if (!isset($arguments['s']))
        return $result; // Si no se ha introducido texto se para el proceso
        /* Varaiables de la consulta */

    $where = "";
    $defaultSearch = "";
    $tmpTax = "";
    $tmpFields = "";
    $result = [];
    $op = $arguments['operator'];
    /* Parametros a ingresar el prepare */
    $params = [];
    /* Construimos la consulta */
    if (isset($arguments['t'])) {
        $tmpTax = "(";
        foreach ($arguments['t'] as $key => $value) {
            $tmpTax .= ' ' . $value . ' OR ';
        }
        $tmpTax = substr($tmpTax, 0, -3) . ') AND ';
    }

    if (isset($arguments['f'])) {
        $tmpFields = "( ";
        if (is_array($arguments['f'])) {
            foreach ($arguments['f'] as $key => $field) {
                foreach ($arguments['s'] as $key2 => $value) {
                    $tmpFields .= "(" . $field . " " . $op . " %s ) OR ";
                    if ($op == "LIKE") {
                        $params[] = "%" . $value . "%";
                    } else {
                        $params[] = $value;
                    }
                }
            }
        }
        $tmpFields = substr($tmpFields, 0, -3) . ') AND ';
    }

    // busqueda si no he marcado autor, etiqueta o categoria
    if (!isset($arguments['t']) && !isset($arguments['f'])) {
        foreach ($arguments['s'] as $key => $value) {
            $defaultSearch .= " ((wp_posts.post_name " . $op . " %s) OR (wp_posts.post_content " . $op . " %s)) OR ";
            if ($op == "LIKE") {
                $params[] = "%" . $value . "%";
                $params[] = "%" . $value . "%";
            } else {
                $params[] = $value;
                $params[] = $value;
            }
        }
        $defaultSearch = substr($defaultSearch, 0, -3) . ' AND ';
    }

    $where = $tmpTax . $tmpFields . $defaultSearch;
    $where = ' WHERE (' . substr($where, 0, -4) . ') AND ';

    $joinsSelect = "SELECT distinct wp_posts.ID

                    FROM wp_term_taxonomy

                    LEFT OUTER JOIN wp_terms

                        ON wp_terms.term_id = wp_term_taxonomy.term_id

                    RIGHT OUTER JOIN wp_term_relationships

                        ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id

                    RIGHT OUTER JOIN wp_posts

                        ON wp_posts.ID = wp_term_relationships.object_id

                    LEFT OUTER JOIN wp_users

                        ON wp_users.ID = wp_posts.post_author ";

    //Tipo de busqueda y oreden se podria pasar como parametros tambien( mirara )
    $orderAndType = "   (wp_posts.post_type = 'post')

                        AND (wp_posts.post_status = 'publish') 

                        ORDER BY wp_posts.post_date DESC";

    $consulta = $joinsSelect . $where . $orderAndType;

    global $wpdb;
    //echo "SQL sin procesar" . $consulta;
    $sql = $wpdb->prepare($consulta, $params);
    //echo "params" . $params;
    $ids = $wpdb->get_results($sql);
    //echo "el ids vale " . $ids;
    //echo "SQL procesada" . $sql;

    foreach ($ids as $resultpost) {
        $result[] = get_post($resultpost->ID);
    }
    return $result;
}



function my_new_contactmethods( $contactmethods ) {
// Add Twitter
$contactmethods['twitter'] = 'Twitter';
//add Facebook
$contactmethods['facebook'] = 'Facebook';
//add Google
$contactmethods['google'] = 'Google';
 
return $contactmethods;
}





// Insertar Breadcrumb    
// Breadcrumbs
function custom_breadcrumbs() {
       
    // Settings
    $separator          = '&gt;';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Homepage';
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
           
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            // Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              
            } else {
                  
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
       
        echo '</ul>';
           
    }
       
} 

// fin breadcrumb





add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );
add_theme_support( 'post-thumbnails' );
add_action('init', 'mis_widgets');
//add_action('widgets_init', 'unregister_default_wp_widgets');
add_filter('user_contactmethods', 'perfil_usuario_personalizado');
add_theme_support('post-formats', array('aside', 'gallery', 'link', 'audio', 'video'));
add_filter('user_contactmethods','my_new_contactmethods',10,1);



?>