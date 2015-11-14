<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ordenar
 *
 * @author Juanka
 */
class Ordenar {
    function __construct() {
        
    }

    public static function reconstruirArchivo($archivo,$miArray) {
        foreach ($archivo as $indiceNombresFiles => $valorArray) {
            foreach ($valorArray as $indiceNumerico => $valor) {
                $miArray[$indiceNumerico][$indiceNombresFiles] = $valor;
            }
        }
        return $miArray;
    }
    public static function reconstruirArchivoSubir($archivo,$miArray) {
        $numeroDeArchivos = count($archivo['name']);
        for($i = 0; $i < $numeroDeArchivos; $i++){
            $n = $archivo['name'][$i];
            $miArray[$i]["nombre"] = substr($n,0,-4);
            $miArray[$i]["tipo"] = substr($n,-3);
        }
        return $miArray;
    }
}
