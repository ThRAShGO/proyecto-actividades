<?php

class ModelActividad extends Model {
    
    private $data = array();

    function deleteActividad($idActividad){
       $manager = new ManageActividad(); 
       return $manager->delete($idActividad);
    }
    
    function editActividad(Actividad $actividad, $id){
        $manager = new ManageActividad();
       return $manager->save($actividad, $id);
    }


    function getData(){
        return $this->data;
    }

    function getActividades(){
        $manager = new ManageActividad();
        return $manager->arrayList();
    }
    
    function getActividadesCustom($email){
        $manager = new ManageActividad();
        return $manager->arrayListCustom($email);
    }
    
    function insertActividad(Actividad $actividad){
        $manager = new ManageActividad(); 
       return $manager->add($actividad);
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