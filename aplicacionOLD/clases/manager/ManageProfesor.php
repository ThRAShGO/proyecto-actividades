<?php

class ManageProfesor {
    
    const TABLA = 'profesor';
    private $db;

    function __construct() {
        $this->db = new DataBase();
    }

    function add(Profesor $objeto) {
        return $this->db->insertParameters(self::TABLA, $objeto->get(), false);
    }
    
    function arrayList() {
        $this->db->getCursorParameters(self::TABLA);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new Profesor();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        return $respuesta;
    }
    
    function arrayListPage($pagina = 1, $parametros = array(), $orderby = '1',  $rpp = 5) {
        $desde = ($pagina - 1) * $rpp;
        $limit = 'limit ' . $desde . ', ' . $rpp;
        $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby, $limit);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new Profesor();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        return $respuesta;
    }
    
    function count($parametros = array()) {
        return $this->db->countParameters(self::TABLA, $parametros);
    }

    function delete($email) {
        return $this->db->deleteParameters(self::TABLA, array('email' => $email));
    }

    function get($email) {
        $this->db->getCursorParameters(self::TABLA, '*', array('email' => $email));
        if ($fila = $this->db->getRow()) {
            $objeto = new Profesor();
            $objeto->set($fila);
            return $objeto->get();
        }
        $profesor = new Profesor();
        return $profesor->get();
    }

    function getList() {
        $this->db->getCursorParameters(self::TABLA);
        return $this->getResultadoSelect();
    }

    function getPage($pagina = 1, $parametros = array(), $orderby = '1',  $rpp = 10) {
        $desde = ($pagina - 1) * $rpp;
        $limit = 'limit ' . $desde . ', ' . $rpp;
        $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby, $limit);
        return $this->getResultadoSelect();
    }

    private function getResultadoSelect() {
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new Profesor();
            $objeto->set($fila);
            $respuesta[] = $objeto;
        }
        return $respuesta;
    }

    function login(Profesor $user){
        $userDB = $this->get($user->getEmail());
        return $userDB->getPassword() === $user->getPassword();
    }

    function save(Profesor $objeto, $emailpk = null) {
        // var_dump($emailpk);
        // exit();
        if($emailpk === null) {
            $emailpk = $objeto->getEmail();
        }
        $campos = $objeto->get();
        if($objeto->getContrasenia() === null || $objeto->getContrasenia() === ''){
            unset($campos['contrasenia']);
        }

        if ( empty($objeto->getEmail()) ) {
            unset($campos['email']);
        }
        
        if ( empty($objeto->getDepartamento())) {
            unset($campos['departamento']);
        }
        
        if ( empty($objeto->getFoto())) {
            unset($campos['foto']);
        }
        
        // if ( empty($objeto->getTipo()) ) {
        //     unset($campos['tipo']);
        // }
        
        
        return $this->db->updateParameters(self::TABLA, $campos, array('email' => $emailpk));
    }

}