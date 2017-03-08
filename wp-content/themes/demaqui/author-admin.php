<?php get_header(); ?>
<?php get_template_part('nav'); ?>
<?php
    $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
// si tiene nombre lo uso, si no uso la cuenta de login
?>

<section id="sub-header">
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<h1><?php echo $curauth->user_nicename; ?></h1>
			<p class="lead">Conocelo todo a cerca de el</p>
		</div>
	</div><!-- End row -->
</div><!-- End container -->
<div class="divider_top"></div>
</section><!-- End sub-header -->

<div class="container">
    <hr>
    <?php include (TEMPLATEPATH  . '/breadcrumbs.php'); ?>
    <hr>
      <div class="row">
     <aside class="col-md-4">
     	<div class=" box_style_1 profile">
     	<?php
     	    if(has_gravatar($curauth->user_email)){
               $foto = get_avatar($curauth->ID);
            } else {
                $foto = "/wp-content/themes/demaqui/img/default.jpg";
            }
     	?>
		<p class="text-center"><img src="<?php echo $foto ?>" alt="Teacher" class="img-circle styled img-responsive"></p>
        		  <ul class="social_teacher">
                    <li><a href="#"><i class="icon-facebook"></i></a></li>
                    <li><a href="#"><i class="icon-twitter"></i></a></li>
                    <li><a href="#"><i class=" icon-google"></i></a></li>
                </ul>   
                 <ul>
                     <li>Nombre <strong class="pull-right"><?php echo $curauth->nickname; ?></strong> </li>
                     <li>Email <strong class="pull-right"><?php echo $curauth->user_email; ?></strong></li>
                     <li>Fecha de registro <strong class="pull-right"><?php echo $curauth->user_registered; ?></strong></li>
                </ul>
              
			</div><!-- End box-sidebar -->
     </aside><!-- End aside -->
     
     <div class="col-md-8">
     
     			<!--  Tabs -->   
                    <ul class="nav nav-tabs" id="mytabs">
                        <li class="active"><a href="#profile_teacher" data-toggle="tab">Profile</a></li>
                    </ul>
                    
                     <div class="tab-content">
                    
                        <div class="tab-pane fade in active" id="profile_teacher">
                        <h3>Biografia:</h3>
                        <p><?php echo $curauth->description ?></p>
                     	<!--<h4>Habilidades:</h4>
						<p></p>
						<div class="row">
                        	<div class="col-md-6">
                            	<ul class="list_3">
                                    <li><strong><?php the_author_meta('nombrehabilidad1', $curauth->ID); ?></strong><p><?php echo the_author_meta('habilidad1', $curauth->ID); ?></p></li>
                                    <li><strong><?php echo the_author_meta('nombrehabilidad2', $curauth->ID); ?></strong></strong><p><?php echo the_author_meta('habilidad2', $curauth->ID); ?></p></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                            	<ul class="list_3">
                                    <li><strong><?php echo the_author_meta('nombrehabilidad3', $curauth->ID); ?></strong><p><?php echo the_author_meta('habilidad3', $curauth->ID); ?></p></li>
                                    <li><strong><?php echo the_author_meta('nombrehabilidad4', $curauth->ID); ?></strong><p><?php echo the_author_meta('habilidad4', $curauth->ID); ?></p></li>
                                </ul>
                            </div>
                        </div> --> <!-- End row--> 
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
                                        categories: ['<?php echo $curauth->nombrehabilidad1 ?>', 
                                                '<?php echo $curauth->nombrehabilidad2?>', 
                                                '<?php echo $curauth->nombrehabilidad3 ?>', 
                                                '<?php echo $curauth->nombrehabilidad4 ?>' ]
                                    },
                                    yAxis: {
                                        title: {
                                            text: null
                                        },
                                        min: 0, 
                                        max: 100
                                    },
                                    series: [{
                                        name: '%',
                                        data: [<?php echo $curauth->habilidad1 ?>, 
                                                <?php echo $curauth->habilidad2?>, 
                                                <?php echo $curauth->habilidad3 ?>, 
                                                <?php echo $curauth->habilidad4 ?>]
                                    }]
                                });
                            });
                        </script>
                       </div><!-- End tab-pane --> 
                  </div>   <!-- End content-->              
		
     </div><!-- End col-md-8-->   	
  </div><!-- End row-->   
</div><!-- End container -->
</section><!-- End main_content-->

<?php get_footer() ?>