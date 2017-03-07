<?php get_header(); ?>
<?php get_template_part('nav'); ?>
<?php
    global $query_string;
    $result = get_search_result($query_string);
?>


<div class="topbar animated fadeInLeftBig"></div>
<div class="container">
       <br>
    <br>
    <h4>Resultados de la búsqueda para: <?php echo $_GET['s']; ?></h4>
    <?php include (TEMPLATEPATH . "/search-result.php"); ?>
</div>
<?php get_footer(); ?>