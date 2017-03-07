<?php

class ManageGrupo {
    
    const TABLA = 'grupo';
    private $db;

    function __construct() {
        $this->db = new DataBase();
    }

    function add(Grupo $objeto) {
        return $this->db->insertParameters(self::TABLA, $objeto->get(), false);
    }
    
    function arrayList() {
        $this->db->getCursorParameters(self::TABLA);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new Grupo();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        return $respuesta;
    }
    
    function arrayListCustom($email) {
        $this->db->getCursorParameters(self::TABLA, '*', array('email' => $email));
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new Grupo();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        return $respuesta;
    }
    
    function arrayListPage($pagina = 1, $parametros = array(), $orderby = '1',  $rpp = 3) {
        $desde = ($pagina - 1) * $rpp;
        $limit = 'limit ' . $desde . ', ' . $rpp;
        $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby, $limit);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new Grupo();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        return $respuesta;
    }
    
    function count($parametros = array()) {
        return $this->db->countParameters(self::TABLA, $parametros);
    }

    function delete($idGrupo) {
        return $this->db->deleteParameters(self::TABLA, array('idGrupo' => $idGrupo));
    }

    function get($idGrupo) {
        $this->db->getCursorParameters(self::TABLA, '*', array('idGrupo' => $idGrupo));
        if ($fila = $this->db->getRow()) {
            $objeto = new Grupo();
            $objeto->set($fila);
            return $objeto;
        }
        return new Grupo();
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
            $objeto = new Grupo();
            $objeto->set($fila);
            $respuesta[] = $objeto;
        }
        return $respuesta;
    }

    // function login(Actividad $Actividad){
    //     $ActividadDB = $this->get($Actividad->getidActividad());
    //     return $ActividadDB->getPassword() === $Actividad->getPassword();
    // }

    function save(Grupo $objeto, $id) {
        
        if($id === null) {
            $id = $objeto->getIdGrupo();
        }
        $campos = $objeto->get();
    
        if ($objeto->getNivel() === null || $objeto->getNivel() === '') {
            unset($campos['nivel']);
        }
        
        if ($objeto->getTitulacion() === null || $objeto->getTitulacion() === '') {
            unset($campos['titulacion']);
        }

        if ($objeto->getPromocion() === null || $objeto->getPromocion() === '') {
            unset($campos['promocion']);
        }
        
        var_dump($campos);
        var_dump($id);
        exit();
        
        return $this->db->updateParameters(self::TABLA, $campos, array('idGrupo' => $id));
    }

}