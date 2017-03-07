<?php

class ManageProfesor {
    
    const TABLA = 'profesor';
    private $db;

    function __construct() {
        $this->db = new DataBase();
    }

    function add(Profesor $objeto) {
        if($objeto->getAdmin() == null || $objeto->getAdmin() == ''){
            $objeto->setAdmin(0);
        }
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
    
    function getProfesoresBasico(){
        $this->db->getCursorParameters(self::TABLA);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new Profesor();
            $objeto->set($fila);
            $respuesta[] = $objeto->getBasic();
        }
        return $respuesta;
    }
    
    function getObjet($email) {
        $this->db->getCursorParameters(self::TABLA, '*', array('email' => $email));
        if ($fila = $this->db->getRow()) {
            $objeto = new Profesor();
            $objeto->set($fila);
            return $objeto;
        }
        $profesor = new Profesor();
        return $profesor;
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
    
        if($emailpk === null) {
            $emailpk = $objeto->getEmail();
        }
        
        $campos = $objeto->get();
        if($objeto->getContrasenia() === null || $objeto->getContrasenia() === ''){
            unset($campos['contrasenia']);
        }

        if ($objeto->getEmail() === null || $objeto->getEmail() === '') {
            unset($campos['email']);
        }
        
        if ( $objeto->getDepartamento() === null || $objeto->getDepartamento() === '' ||  $objeto->getDepartamento() === '-- selecciona una opción --') {
            unset($campos['departamento']);
        }
        
        if ( $objeto->getFoto() === null || $objeto->getFoto() === '') {
                unset($campos['foto']);
        }
        
        if ( $objeto->getAdmin() === null || $objeto->getAdmin() === '' || $objeto->getAdmin() === '-- selecciona una opción --') {
                unset($campos['admin']);
        }
        
        // if ( empty($objeto->getTipo()) ) {
        //     unset($campos['tipo']);
        // }

        
        return $this->db->updateParameters(self::TABLA, $campos, array('email' => $emailpk));
    }

}