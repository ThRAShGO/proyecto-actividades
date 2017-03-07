<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<div class="widget" style="margin-top:15px;">
		<div class="input-group">
		    
	    		<input type="text" class="form-control" placeholder="Search..." value="<?php the_search_query(); ?>" title="<?php esc_attr_x('Search for:', 'label'); ?>" name="s"
	    id="s" >
	    		<span class="input-group-btn">
	    		<button class="btn btn-default" type="submit" style="margin-left:0;"><i class="icon-search"></i></button>
	    		</span>
			
		</div><!-- /input-group -->
	</div><!-- End Search -->
</form>