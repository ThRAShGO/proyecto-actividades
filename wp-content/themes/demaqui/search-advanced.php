
<div class="col-lg-12 col-md-12 col-xs-12 formadvance">    
    <h3 class="cabeceroform">Formulario de búsqueda avanzada</h3>
    <form role="search" method="get" class="form form-vertical" action="<?php echo home_url( '/' ); ?>">
        <div class="form-group">
            <label>Buscar por:</label><br><small> Si no se marca ninguna se buscará el los títulos y contenido de los posts</small><br><br>
        </div>
        <div class="form-group">
            <span><input class="" type="checkbox" name="author_name" value="author_name" /> Autor</span>
            <span><input class="" type="checkbox" name="tag" value="tag" /> Tag</span>
            <span><input class="" type="checkbox" name="category_name" value="category_name" /> Categoría</span>
        </div>
        <div class="form-group">
            <label>Modo de búsqueda:</label>
        </div>
        <div class="form-group">
            <span><input type="radio" name="operator" value="igual" /> Restrictivo</span><br><small> Sólo se mostrarán los post que coincidan exactamente con la palabra(s) buscada.</small><br><br> 
            <span><input type="radio" name="operator" value="LIKE" checked /> Universal</span><br><small> Se mostrarán los post que coincidan con alguna de las palabras buscadas o que  la contengan.</small><br><br>
        </div>
        <div class="form-group">
            <input type="search" class="form-control"
                value="<?php echo get_search_query() ?>" name="s"
                title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
        </div>        
        <div class="form-group">
            <input type="submit" class="btn-primary btn-lg btn-block" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
        </div>
    </form>
</div>