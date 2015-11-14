<?php
/**
 * Description of Archivos
 *
 * @author DAVID
 */
class Archivos {
    private $archivo, $datosClientes = Array();
    
    function __construct($ruta) {
        //archivos de usuario de texto
        $this->archivo = fopen($ruta, "r");
        //fopen abre el archivo en la ruta
        // "r" r lectura, o mas cosas
        $i = 0;
        //feof comprueba que el puntero esta señalando un puntero
        
        while(!feof($this->archivo)){
            $this->datosClientes[$i] = explode(';', fgets($this->archivo));
            $i++;
        }
    }
    
    function getDatos(){
        return $this->datosClientes;
    }
    
    function validarContraseña($user,$password){
        $i = 0;
        while(isset($this->datosClientes[$i])){
            if($this->datosClientes[$i][0] == $user){
                return true;
            }
            $i++;
        }
        return false;
    }
    
}