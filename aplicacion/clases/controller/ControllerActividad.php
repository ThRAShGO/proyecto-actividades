<?php

class ControllerActividad extends Controller{

    function deleteactividad(){
        $actividad = Request::read('idactividades');
        $admin = Request::read('admin');
        $email = Request::read('usuarioactivo');
        $r = 0;
        $r = $this->getModel()->deleteActividad($actividad);
        $this->getModel()->setData('r', $r);
        if($admin == "1"){
            $actividades = $this->getModel()->getActividades();
            $this->getModel()->setData('actividades', $actividades);
        }else{
            $actividades = $this->getModel()->getActividadesCustom($email);
            $this->getModel()->setData('actividades', $actividades);  
        }
    }
    

    function doprueba(){
        $r = $this->getModel()->doPrueba();
        $this->getModel()->setData('info', $r);
        
    }
    
    
    
    function editactividad(){
        $id = Request::read('idActividades');
        $admin = Request::read('admin');
        $email = Request::read('usuarioactivo');
        $actividad = new Actividad();
        $actividad->read();
        $path = Request::read('foto');
        $r = 0;
        $img = new FileUpload($path);
        $img->setTarget("img/actividades");
        $re = $img->upload();
        
        $r = $this->getModel()->editActividad($actividad, $id);
        $this->getModel()->setData('r', $r);
        if($admin == "1"){
            $actividades = $this->getModel()->getActividades();
            $this->getModel()->setData('actividades', $actividades);
        }else{
            $actividades = $this->getModel()->getActividadesCustom($email);
            $this->getModel()->setData('actividades', $actividades);  
        }
        
    }
    
    
    
    function index(){
    }

    // private function getPageUsersAjax($pagina = 1) {
    //     $total = $this->getModel()->countUser();
    //     $controllerpage = new PageController($total, $pagina);
    //     $this->getSession()->set('pagina', $controllerpage->getPage());
    //     $users = $this->getModel()->getUsers($controllerpage->getPage());
    //     $this->getModel()->setData('users', $users);
    //     $this->getModel()->setData('page', $controllerpage->getPage());
    //     $this->getModel()->setData('pages', $controllerpage->getPages());
    // }
    
    function pediractividades() {
        $actividades = $this->getModel()->getActividades();
        $this->getModel()->setData('actividades', $actividades);
    }
    
    
    function pediractividadesusuario() {
        $email = Request::read('email');
        $actividades = $this->getModel()->getActividadesCustom($email);
       
        // $actividadesUnicas = array();
        // foreach($actividades as $key => $valor) {
        //     if($valor['email'] == $email){
        //       $actividadesUnicas[$key] = $valor; 
        //     }
        // }
        $this->getModel()->setData('actividades', $actividades);
    }
    


    function insertactividad(){
        $id = Request::read('idActividades');
        $actividad = new Actividad();
        $actividad->read();
        $path = Request::read('foto');
        $r = 0;
        $img = new FileUpload($path);
        $img->setTarget("img/actividades");
        $re = $img->upload();
       
        // if($this->getSession()->isLogged()){
         $r = $this->getModel()->insertActividad($actividad, $id);
        // }
        $this->getModel()->setData('r', $r);
        $actividades = $this->getModel()->getActividades();
        $this->getModel()->setData('actividades', $actividades);
        
    }
    
    function islogin(){
        $session = $this->getSession(); 
        $user = $session->getUser();
        if($user === null){
            $this->getModel()->setData('login', 0); 
        }else{
            $info = $session->get('info');
            $this->getModel()->setData('login', 1);
            $this->getModel()->setData('user', $user->get());
            $this->getModel()->setData('info', $info);
            $this->getPageUsersAjax();
        }
    }


    function login(){
        /*$this->getModel()->setData('login', '1');*/
        $user = new Profesor();
        $user->read();
        $info = $this->getModel()->doLogin($user);
        if($info === false){
            $this->getModel()->setData('login', 0);
        } else {
            $session = $this->getSession(); 
            $session->set('info', $info);
            $session->setUser($user);
            $this->getModel()->setData('login', 1);
            $this->getModel()->setData('user', $user->get());
            $this->getModel()->setData('info', $info);
            //$this->getPageUsersAjax($user, $info);
            $users = $this->getModel()->getUsers();
            $this->getModel()->setData('users', $users);
        }
    }
    
    
    
    // function userpage(){
    //     $pagina = Request::read('pagina');
    //     $this->getPageUsersAjax($pagina);
    // }
}