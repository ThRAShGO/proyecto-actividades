<?php

class ModelProfesor extends Model {
    
    private $data = array();
    private $files = array();

    function deleteUser($email){
       $manager = new ManageProfesor(); 
       return $manager->delete($email);
    }

    function doLogin(Profesor $user){
        $manager = new ManageProfesor();
        return $manager->get($user->getEmail());
    }

    function existUser($email){
        $manager = new ManageProfesor();
        $user = $manager->get($email);
        return ($email === $user->getEmail());
    }

    function getData(){
        return $this->data;
    }

    function getUsers($pagina = 1){
        $manager = new ManageProfesor();
        //return $manager->get($pagina);
        // return $manager->arrayListPage($pagina);
        return $manager->arrayList();
    }
    
    function getUserActivo($email){
        $manager = new ManageProfesor();
        //return $manager->get($pagina);
        // return $manager->arrayListPage($pagina);
        return $manager->get($email);
    }
    

    function insertUser(Profesor $user){
         $manager = new ManageProfesor(); 
       return $manager->add($user);
    }
    
    function editUser(Profesor $user, $emailpk){
        $manager = new ManageProfesor();
       return $manager->save($user, $emailpk);
    }
    
    function setData($name, $value){
        $this->data[$name] = $value;
    }
    
    function addFile($name, $file) {
        $this->data[$name] = $file;
    }

    function countUser(){
        $manager = new ManageProfesor();
        return $manager->count();
    }
}