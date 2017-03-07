<?php

class ModelGrupo extends Model {
    
    private $data = array();

    function deleteGrupo($idGrupo){
       $manager = new ManageGrupo(); 
       return $manager->delete($idGrupo);
    }
    
    function editGrupo(Grupo $grupo, $id){
        $manager = new ManageGrupo();
       return $manager->save($grupo, $id);
    }


    function getData(){
        return $this->data;
    }

    function getGrupos(){
        $manager = new ManageGrupo();
        return $manager->arrayList();
    }
    
    // function getActividadesCustom($email){
    //     $manager = new ManageActividad();
    //     return $manager->arrayListCustom($email);
    // }
    
    function insertGrupo(Grupo $grupo){
        $manager = new ManageGrupo(); 
       return $manager->add($grupo);
    }
    

    // function insertUser(User $user){
    //      $manager = new ManageProfesor(); 
    //   return $manager->add($user);
    // }

    function setData($name, $value){
        $this->data[$name] = $value;
    }

    // function countUser(){
    //     $manager = new ManageProfesor();
    //     return $manager->count();
    // }
}