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
        if($this->getSession()->isLogged()){
          $r = $this->getModel()->insertUser($user);
        }
        $this->getModel()->setData('r', $r);
        $users = $this->getModel()->getUsers();
        $this->getModel()->setData('users', $users);
    }
    
     function insertuserlogin(){
        $user = new Profesor();
        $user->read();
        $r = 0;
        $r = $this->getModel()->insertUser($user);
        $this->getModel()->setData('r', $r);
        //$this->getModel()->setData('foto', $path);
    }
    
    function edituser(){
        $emailpk = Request::read('emailpk');
        $user = new Profesor();
        $user->read();
        $r = 0;
        $session = $this->getSession();
        $userSession = $session->getUser();
        
        if($this->getSession()->isLogged()){
            if($emailpk == $userSession->getEmail()){
                $r = $this->getModel()->editUser($user, $emailpk);
                $this->getModel()->setData('exit', 'yes');
            }else{
                $r = $this->getModel()->editUser($user, $emailpk);   
            }
         
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
            $user = $user->get();
            $this->getModel()->setData('login', 1);
            $users = $this->getModel()->getUsers();
            $this->getModel()->setData('users', $users);
            $this->getModel()->setData('user', $user);
            $this->getModel()->setData('logueo', Util::renderFile('templates/log_out.html', $this->getModel()->getData()));
            if($user['admin'] == 1){
                $this->getModel()->setData('parrafo', Util::renderFile('templates/textoAdmin.html', $this->getModel()->getData()));
            }else{
                $this->getModel()->setData('parrafo', Util::renderFile('templates/textoUserNormal.html', $this->getModel()->getData()));
            }
            
            
            // $this->getModel()->setData('buttons_changed_admin', Util::renderFile('templates/buttons_admin.html', $this->getModel()->getData()));
            // $this->getModel()->setData('buttons_changed_user', Util::renderFile('templates/buttons_user.html', $this->getModel()->getData()));
        }
    }
    
    // function isrepeatedemail(){
    //     $email = Request::read('email');
    //     $info = $this->getModel()->existUser($email);
    //     if($info === true ){
    //         $this->getModel()->setData('r', 1);
    //     }else{
    //         $this->getModel()->setData('r', 0);
    //     }
        
    // }

    function login(){
        $user = new Profesor();
        $user->read();
        $usuarioBD = $this->getModel()->doLogin($user);
        $usuarioSesion = $this->getModel()->getUserSession($user->getEmail());
        if($usuarioBD['email'] === null){
            $this->getModel()->setData('login', 0);
        } else {
            if(!in_array($user->getContrasenia(), $usuarioBD)){
                $this->getModel()->setData('login', -1);
            }else{
                if($usuarioBD['admin'] == "1"){
                    $sesion = $this->getSession(); 
                    $sesion->set('info', $user);
                    $sesion->setUser($usuarioSesion);
                    $this->getModel()->setData('login', 1);
                    $users = $this->getModel()->getUsers();
                    $this->getModel()->setData('users', $users);
                    $usuario = $this->getModel()->getUserActivo($user->getEmail());
                    $this->getModel()->setData('user', $usuario);
                    $this->getModel()->setData('admin', $usuarioBD['admin']);
                    $this->getModel()->setData('logueo', Util::renderFile('templates/log_out.html', $this->getModel()->getData()));
                    $this->getModel()->setData('parrafo', Util::renderFile('templates/textoAdmin.html', $this->getModel()->getData()));
                    // $this->getModel()->setData('buttons_changed_admin', Util::renderFile('templates/buttons_admin.html', $this->getModel()->getData()));
                    
                } else {
                    $sesion = $this->getSession(); 
                    $sesion->set('info', $user);
                    $sesion->setUser($usuarioSesion);
                    $this->getModel()->setData('login', 1);
                    $usuario = $this->getModel()->getUserActivo($user->getEmail());
                    $this->getModel()->setData('user', $usuario);
                    $this->getModel()->setData('admin', $usuarioBD['admin']);
                    $this->getModel()->setData('logueo', Util::renderFile('templates/log_out.html', $this->getModel()->getData()));
                    $this->getModel()->setData('parrafo', Util::renderFile('templates/textoUserNormal.html', $this->getModel()->getData()));
                    // $this->getModel()->setData('buttons_changed_user', Util::renderFile('templates/buttons_user.html', $this->getModel()->getData()));
                }
            }
        }
    }
    
    
    function pedirprofesores(){
        $profesores = $this->getModel()->getProfesoresCustom();
        $this->getModel()->setData('profesores', $profesores);
    }

        
    function logout(){
        $session = $this->getSession(); 
        $session->destroy();
        header('Location:index.php');
    }
    

}