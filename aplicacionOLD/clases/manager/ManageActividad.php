<?php

class ManageActividad {
    
    const TABLA = 'actividades';
    private $db;

    function __construct() {
        $this->db = new DataBase();
    }

    function add(Actividad $objeto) {
        return $this->db->insertParameters(self::TABLA, $objeto->get(), false);
    }
    
    function arrayList() {
        $this->db->getCursorParameters(self::TABLA);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new Actividad();
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
            $objeto = new Actividad();
            $objeto->set($fila);
            $respuesta[] = $objeto->get();
        }
        return $respuesta;
    }
    
    function count($parametros = array()) {
        return $this->db->countParameters(self::TABLA, $parametros);
    }

    function delete($idActividad) {
        return $this->db->deleteParameters(self::TABLA, array('idActividades' => $idActividad));
    }

    function get($idActividad) {
        $this->db->getCursorParameters(self::TABLA, '*', array('idActividades' => $idActividad));
        if ($fila = $this->db->getRow()) {
            $objeto = new Actividad();
            $objeto->set($fila);
            return $objeto;
        }
        return new Actividad();
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
            $objeto = new Actividad();
            $objeto->set($fila);
            $respuesta[] = $objeto;
        }
        return $respuesta;
    }

    // function login(Actividad $Actividad){
    //     $ActividadDB = $this->get($Actividad->getidActividad());
    //     return $ActividadDB->getPassword() === $Actividad->getPassword();
    // }

    function save(Actividad $objeto, $id) {
        if($id === null) {
            $id = $objeto->getIdActividades();
        }
        $campos = $objeto->get();
        if (empty($objeto->getTitulo()) ) {
            unset($campos['titulo']);
        }
        
        if ( empty($objeto->getDescripcion())) {
            unset($campos['descripcion']);
        }

        if ( empty($objeto->getFechaInicio())) {
            unset($campos['fechaInicio']);
        }
        
        if ( empty($objeto->getFechaFin())) {
            unset($campos['fechaFin']);
        }
        
        if ( empty($objeto->getEmail())) {
            unset($campos['email']);
        }
        
        if ( empty($objeto->getIdGrupo())) {
            unset($campos['IdGrupo']);
        }
        
        if ( empty($objeto->getFoto())) {
            unset($campos['foto']);
        }

        return $this->db->updateParameters(self::TABLA, $campos, array('idActividades' => $id));
    }

}