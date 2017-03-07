<?php get_header(); ?>
<body id="page-top" class="index">
    <?php get_template_part('nav'); ?>

<?php
    $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
// si tiene nombre lo uso, si no uso la cuenta de login

    echo "Nicename:" . $curauth->user_nicename ."<br>";
    echo "Nombre: " . $curauth->nickname . "<br>";
    echo "Descripcion: " . $curauth->description . "<br>";
    echo "Fecha de registro: " . $curauth->user_registered . "<br>";
    if(has_gravatar($curauth->user_email)){
        echo "tiene gravatar <br>";
        echo get_avatar($curauth->ID);
    } else {
        echo "no tiene gravatar <br>";
    }

    echo $curauth->user_nicename;

    if(has_pic($curauth->nicename) != false){
        echo has_pic($curauth->user_nicename);
    } else {
        echo "no tiene foto";
    }

    echo '<br>';
    the_author_meta('twitter', $curauth->ID);
    echo '<br>';
    the_author_meta('facebook', $curauth->ID);
    echo '<br>';
    the_author_meta('nombrehabilidad1', $curauth->ID);
    the_author_meta('habilidad1', $curauth->ID);
    echo '<br>';
    the_author_meta('nombrehabilidad2', $curauth->ID);
    the_author_meta('habilidad2', $curauth->ID);
    echo '<br>';
    the_author_meta('nombrehabilidad3', $curauth->ID);
    the_author_meta('habilidad3', $curauth->ID);
    echo '<br>';
    the_author_meta('nombrehabilidad4', $curauth->ID);
    the_author_meta('habilidad4', $curauth->ID);

?>
    <div id="grafico" style="height: 400px"></div>
    
    <script>
        $(function () {
            Highcharts.chart('grafico', {
                chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 10,
                        beta: 25,
                        depth: 70
                    }
                },
                title: {
                    text: 'Habilidades del usuario'
                },
                subtitle: {
                    text: ''
                },
                plotOptions: {
                    column: {
                        depth: 25
                    }
                },
                xAxis: {
                    categories: Highcharts.getOptions().lang.shortMonths
                },
                yAxis: {
                    title: {
                        text: null
                    }
                },
                series: [{
                    name: 'Sales',
                    data: [2, 3, null, 4, 0, 5, 1, 4, 6, 3]
                }]
            });
        });
    </script>

<?php get_footer() ?>