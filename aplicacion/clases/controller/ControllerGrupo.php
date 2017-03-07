<?php

class ControllerGrupo extends Controller{

    function deletegrupo(){
        $grupo = Request::read('idgrupo');
        $email = Request::read('usuarioactivo');
        $r = 0;
        $r = $this->getModel()->deleteGrupo($grupo);
        $this->getModel()->setData('r', $r);
        $grupos = $this->getModel()->getGrupos();
        $this->getModel()->setData('grupos', $grupos);
    }
    

    function doprueba(){
        $r = $this->getModel()->doPrueba();
        $this->getModel()->setData('info', $r);
        
    }
    
    
    
    function editgrupo(){
        $id = Request::read('idGrupo');
        $grupo = new Grupo();
        $grupo->read();
        
        $r = $this->getModel()->editGrupo($grupo, $id);
        $this->getModel()->setData('r', $r);
        $grupos = $this->getModel()->getGrupos();
        $this->getModel()->setData('grupos', $grupos);
    }
    
    
    
    function index(){
    }

    
    function pedirgrupos() {
        $grupos = $this->getModel()->getGrupos();
        $this->getModel()->setData('grupos', $grupos);
    }
    
    
    // function pedirgrupousuario() {
    //     $email = Request::read('email');
    //     $actividades = $this->getModel()->getActividadesCustom($email);
       
    //     // $actividadesUnicas = array();
    //     // foreach($actividades as $key => $valor) {
    //     //     if($valor['email'] == $email){
    //     //       $actividadesUnicas[$key] = $valor; 
    //     //     }
    //     // }
    //     $this->getModel()->setData('actividades', $actividades);
    // }
    


    function insertgrupo(){
        $id = Request::read('idGrupo');
        $grupo = new Grupo();
        $grupo->read();
        // if($this->getSession()->isLogged()){
         $r = $this->getModel()->insertGrupo($grupo, $id);
        // }
        $this->getModel()->setData('r', $r);
        $grupos = $this->getModel()->getGrupos();
        $this->getModel()->setData('grupos', $grupos);
        
    }
    
    
}