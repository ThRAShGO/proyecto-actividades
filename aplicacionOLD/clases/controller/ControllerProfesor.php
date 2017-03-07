<?php

class ControllerProfesor extends Controller{

    function deleteuser(){
        $email = Request::read('email');
        $this->doDeleteUser($email);
    }
    
    function doDeleteUser($email){
        $r = 0;
        if($this->getSession()->isLogged()){
          $r = $this->getModel()->deleteUser($email);
        }
        $this->getModel()->setData('r', $r);
        $users = $this->getModel()->getUsers();
        $this->getModel()->setData('users', $users);
        
    }

    function doprueba(){
        $r = $this->getModel()->doPrueba();
        $this->getModel()->setData('info', $r);
        
    }
    
    function index(){
    }

    function insertuser(){
        $user = new Profesor();
        $user->read();
        $r = 0;
        $path = Request::read('foto');
        $img = new FileUpload($path);
        $img->setTarget("img/profesores");
        $re = $img->upload;
        if($this->getSession()->isLogged()){
          $r = $this->getModel()->insertUser($user);
        }
        $this->getModel()->setData('r', $r);
        $users = $this->getModel()->getUsers();
        $this->getModel()->setData('users', $users);
        
    }
    
    function edituser(){
        $emailpk = Request::read('emailpk');
        $user = new Profesor();
        $user->read();
        $path = Request::read('foto');
        $r = 0;
        $img = new FileUpload($path);
        $img->setTarget("img/profesores");
        $re = $img->upload();
        
        if($this->getSession()->isLogged()){
          $r = $this->getModel()->editUser($user, $emailpk);
        }
        $this->getModel()->setData('r', $r);
        $users = $this->getModel()->getUsers();
        $this->getModel()->setData('users', $users);
        
    }
    
    function islogin(){
        $session = $this->getSession(); 
        $user = $session->getUser();
        if($user === null){
            $this->getModel()->setData('login', -2);
            $this->getModel()->setData('logueo', Util::renderFile('templates/log_in.html', $this->getModel()->getData()));
        }else{
            $user = $session->get('info');
            $this->getModel()->setData('login', 1);
            $this->getModel()->setData('user', $user->get());
            $this->getModel()->setData('info', $user);
            $users = $this->getModel()->getUsers();
            $this->getModel()->setData('users', $users);
            $this->getModel()->setData('logueo', Util::renderFile('templates/log_out.html', $this->getModel()->getData()));
        }
    }
    
    function isrepeatedemail(){
        $email = Request::read('email');
        $info = $this->getModel()->existUser($email);
        if($info === true ){
            $this->getModel()->setData('r', 1);
        }else{
            $this->getModel()->setData('r', 0);
        }
        
    }

    function login(){
        $user = new Profesor();
        $user->read();
        $usuarioBD = $this->getModel()->doLogin($user);
        
        if($usuarioBD['email'] === null){
            $this->getModel()->setData('login', 0);
        } else {
            if(!in_array($user->getContrasenia(), $usuarioBD)){
                $this->getModel()->setData('login', -1);
            }else{
                $sesion = $this->getSession(); 
                $sesion->set('info', $user);
                $sesion->setUser($user);
                $this->getModel()->setData('login', 1);
                $this->getModel()->setData('user', $user->get());
                $this->getModel()->setData('info', $user);
                $users = $this->getModel()->getUsers();
                $this->getModel()->setData('users', $users);
                $this->getModel()->setData('logueo', Util::renderFile('templates/log_out.html', $this->getModel()->getData()));
            }
        }
    }
    function getUseractivo(){
        $session = $this->getSession(); 
        $user = $session->getUser();
        if($user === null){
            $this->getModel()->setData('login', -2); 
        }else{
            $email = $user->getEmail();
            $user = $session->get('info');
            $this->getModel()->setData('login', 1);
            $this->getModel()->setData('user', $user->get());
            $this->getModel()->setData('info', $user);
            $usuarioactivo = $this->getModel()->getUserActivo($email);
            $this->getModel()->setData('usuarioactivo', $usuarioactivo);
            
        }
    }
        
        
        //FIN LOGIN BUENO
        
        // if($info === false){
        //     $this->getModel()->setData('login', 0);
        // } else {
        //     $session = $this->getSession(); 
        //     $session->set('info', $info);
        //     $session->setUser($user);
        //     $this->getModel()->setData('login', 1);
        //     $this->getModel()->setData('user', $user->get());
        //     $this->getModel()->setData('info', $info);
        //     //$this->getPageUsersAjax($user, $info);
        //     $users = $this->getModel()->getUsers();
        //     $this->getModel()->setData('users', $users);
        // }
        
        function logout(){
            $session = $this->getSession(); 
            $session->destroy();
            header('Location:index.php');
        }
    
        function userpage(){
            $pagina = Request::read('pagina');
            $this->getPageUsersAjax($pagina);
        }
    
    // function loginactivo(){
    //     $user = new Profesor();
    //     $user->read();
    //     $info = $this->getModel()->doLogin($user);
    //     print_r($info);
    //     if($info === false){
    //         $this->getModel()->setData('login', 0);
    //     } else {
    //         $session = $this->getSession(); 
    //         $session->set('info', $info);
    //         $session->setUser($user);
    //         $this->getModel()->setData('login', 1);
    //         $this->getModel()->setData('user', $user->get());
    //         $this->getModel()->setData('info', $info);
    //     }
    // }
}