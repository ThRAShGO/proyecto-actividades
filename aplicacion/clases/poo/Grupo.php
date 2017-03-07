<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Grupos
 *
 * @author usuario
 */
class Grupo {
    //put your code here
    private $idGrupo, $nivel, $titulacion, $promocion;
    
    function __construct($idGrupo = null, $nivel = null, $titulacion = null, $promocion = null) {
    $this->idGrupo = $idGrupo;
    $this->nivel = $nivel;
    $this->titulacion = $titulacion;
    $this->promocion = $promocion;
}
    

    function getIdGrupo() {
        return $this->idGrupo;
    }

    function getNivel() {
        return $this->nivel;
    }

    function getTitulacion() {
        return $this->titulacion;
    }

    function getPromocion() {
        return $this->promocion;
    }

    function setIdGrupo($idGrupo) {
        $this->idGrupo = $idGrupo;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    function setTitulacion($titulacion) {
        $this->titulacion = $titulacion;
    }

    function setPromocion($promocion) {
        $this->promocion = $promocion;
    }

    function __toString() {
        $r = '';
        foreach($this as $key => $valor) {
            $r .= "$key => $valor - ";
        }
        return $r;
    }
    
    function read(ObjectReader $reader = null){
        if($reader===null){
            $reader = 'Request';
        }
        foreach($this as $key => $valor) {
            $this->$key = $reader::read($key);
        }
    }
    
    function get(){
        $nuevoArray = array();
        foreach($this as $key => $valor) {
            $nuevoArray[$key] = $valor;
        }
        return $nuevoArray;
    }
    
    function set(array $array, $inicio = 0) {
        $this->idGrupo = $array[0 + $inicio];
        $this->nivel = $array[1 + $inicio];
        $this->titulacion = $array[2 + $inicio];
        $this->promocion = $array[3 + $inicio];
    }
        function json() {
        return json_encode($this->get());
    }

}