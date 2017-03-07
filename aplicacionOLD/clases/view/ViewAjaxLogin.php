<?php

class ViewAjaxLogin extends View {
    
    function render() {
        return json_encode( $this->getModel()->getData() );
    }
    
}