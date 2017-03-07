<?php

class Router {

    private $rutas = array();

    function __construct() {
        $this->rutas['index'] = new Route('Model', 'View', 'Controller');
        //$this->rutas['ajax'] = new Route('Model', 'ViewAjax', 'ControllerAjax');
        $this->rutas['ajaxlogin'] = new Route('ModelProfesor', 'ViewAjaxLogin', 'ControllerProfesor');
        $this->rutas['ajaxactividades'] = new Route('ModelActividad', 'ViewAjax', 'ControllerActividad');
    }

    function getRoute($ruta) {
        if (!isset($this->rutas[$ruta])) {
            return $this->rutas['index'];
        }
        return $this->rutas[$ruta];
    }

}

