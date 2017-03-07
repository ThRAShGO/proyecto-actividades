<?php

class Controller {

    private $model, $session;
    
    function __construct(Model $model) {
        $this->model = $model;
        $this->session = Session::getInstance(Constants::SESSIONNAME);
        
        // $this->model->setData('login', Util::renderFile('templates/log_in.html', $this->getModel()->getData()));
        // $this->model->setData('logout', Util::renderFile('templates/log_out.html', $this->getModel()->getData()));

    }
    
    function getModel(){
        return $this->model;
    }
    function getSession(){
        return $this->session;
    }

    function index() {
        $this->getModel()->setData('pagina', 'index');
    }

}