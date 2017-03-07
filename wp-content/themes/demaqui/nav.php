<nav>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div id="mobnav-btn"></div>
			<ul class="sf-menu">
			    <?php
			    	$nav = wp_list_pages(array('title_li' => ''));
			    ?>
			</ul>
            
            <div class="col-md-3 pull-right hidden-sm hidden-xs">
                    <div id="sb-search" class="sb-search">
						<form  method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
							<input class="sb-search-input" placeholder0"Enter your search term..." type="text" value="<?php the_search_query(); ?>" title="<?php esc_attr_x('Search for:', 'label'); ?>" name="search" id="search">
							<input class="sb-search-submit" type="submit" value="">
							<span class="sb-icon-search"></span>
						</form>
					</div>
              </div><!-- End search -->
              
		</div>
	</div><!-- End row -->
</div><!-- End container -->
</nav>