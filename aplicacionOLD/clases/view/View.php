<?php

class View {

    private $model;
    
    function __construct(Model $model) {
        $this->model = $model;
    }
    
    function getModel(){
        return $this->model;
    }
    
    
    function render() {
        $plantilla = 'templates';
        
        $archivos = $this->getModel()->getFiles();
        foreach($archivos as $indice => $archivo) {
            $this->getModel()->addData($indice, Util::renderFile($plantilla . '/' . $archivo, $this->getModel()->getData()));
        }
        return Util::renderFile($plantilla . '/login.html', $this->getModel()->getData());
    }
    
    // function render() {
    //   return Util::renderFile('templates/login.html', $this->getModel()->getData());
    // }
    
}