<?php

/*
 * Vamos a meter todos los datos del usuario
 */


class Usuario {
    private $dni,$ss,$directorio;
    
    function __construct($dni = null,$ss=null,$directorio=null) {
        $this->dni = $dni;
        $this->ss=$ss;
        $this->directorio = $directorio;
    }
    function getDni() {
        return $this->dni;
    }

    function getSs() {
        return $this->ss;
    }

    function getDirectorio() {
        return $this->directorio;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setSs($ss) {
        $this->ss = $ss;
    }

    function setDirectorio($directorio) {
        $this->directorio = $directorio;
    }
    public function __toString() {
        return $this->nombre;
    }


}
