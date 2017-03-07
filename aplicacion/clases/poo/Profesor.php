<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profesores
 *
 * @author usuario
 */
class Profesor {
    //put your code here
    private $email, $contrasenia, $departamento, $foto;
    
    function __construct($email  = null, $contrasenia  = null, $departamento  = null, $foto  = null, $admin = null) {
        $this->email = $email;
        $this->contrasenia = $contrasenia;
        $this->departamento = $departamento;
        $this->foto = $foto;
        $this->admin = $admin;
    }

    function getEmail() {
        return $this->email;
    }

    function getContrasenia() {
        return $this->contrasenia;
    }

    function getDepartamento() {
        return $this->departamento;
    }

    function getFoto() {
        return $this->foto;
    }
    
     function getAdmin() {
        return $this->admin;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setContrasenia($contrasenia) {
        $this->contrasenia = $contrasenia;
    }

    function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }
    
     function setAdmin($admin) {
        $this->admin = $admin;
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
    
    function getBasic(){
        $nuevoArray = array();
        $email = $this->getEmail();
        $departamento = $this->getDepartamento();
        $nuevoArray['email'] = $email;
        $nuevoArray['departamento'] = $departamento;
        return $nuevoArray;
    }
    
    function set(array $array, $inicio = 0) {
        $this->email = $array[0 + $inicio];
        $this->contrasenia = $array[1 + $inicio];
        $this->departamento = $array[2 + $inicio];
        $this->foto = $array[3 + $inicio];
        $this->admin = $array[4 + $inicio];
    }
    
    function json() {
        return json_encode($this->get());
    }
}
