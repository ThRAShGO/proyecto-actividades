<?php

class Model {

    private $data = array();
    private $files = array();
    
    function getData(){
        return $this->data;
    }

    function setData($name, $value){
        $this->data[$name] = $value;
    }


    function addFile($name, $file) {
        $this->data[$name] = $file;
    }
    
    
     function getFiles() {
        return $this->files;
    }

}
