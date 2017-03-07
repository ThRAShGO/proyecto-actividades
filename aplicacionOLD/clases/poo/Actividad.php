<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Actividades
 *
 * @author usuario
 */
class Actividad {
    //put your code here
    private $idActividades, $titulo, $descripcion, $fechaInicio, $fechaFin, $email, $idGrupo, $foto;
    
    function __construct($idActividades = null, $titulo = null, $descripcion = null, $fechaInicio = null, $fechaFin = null, $email = null, $idGrupo = null, $foto = null) {
        $this->idActividades = $idActividades;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->email = $email;
        $this->idGrupo = $idGrupo;
        $this->foto = $foto;
    }

    function getIdActividades() {
        return $this->idActividades;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getFechaInicio() {
        return $this->fechaInicio;
    }

    function getFechaFin() {
        return $this->fechaFin;
    }

    function getEmail() {
        return $this->email;
    }

    function getIdGrupo() {
        return $this->idGrupo;
    }

    function getFoto() {
        return $this->foto;
    }
    function setIdActividades($idActividades) {
        $this->idActividades = $idActividades;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setIdGrupo($idGrupo) {
        $this->idGrupo = $idGrupo;
    }

    function setFoto($foto) {
        $this->foto = $foto;
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
        $this->idActividades = $array[0 + $inicio];
        $this->titulo = $array[1 + $inicio];
        $this->descripcion = $array[2 + $inicio];
        $this->fechaInicio = $array[3 + $inicio];
        $this->fechaFin = $array[4 + $inicio];
        $this->email = $array[5 + $inicio];
        $this->idGrupo = $array[6 + $inicio];
        $this->foto = $array[7 + $inicio];
    }
    
    function json() {
        return json_encode($this->get());
    }
    
}