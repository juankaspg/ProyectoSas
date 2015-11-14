<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UploadFileArchivos
 *
 * @author Juanka
 */

class UploadFileArchivos {
    private $parametrosOrdenados,$cantidadArchivos=0;
    //probamos po para que solo me de el nombre del archivo
    //parametros ordenados son lo único que quiero de mi archivo (nombre,tipo)
    private $destino = '../../../../SAS/', $nombre, $tamaño = 1000000000000,
            $extension,$usuario="";
    //es el conjuntos de archivos ->Coger con un $_FILE
    private $parametro;
    private $archivosUsuario = Array();
    /*Usuario va a ser único para cada tipo*/
    /*$parametro es el name*/
    const CONSERVAR = 1,REMPLAZAR = 2, RENOMBRAR = 3;//politica de subida de archivos
    //estas variables son siempre staticas y publicas
    /*tipo de arvhivos se controlara despues*/
    private $error = true, $politica = self::RENOMBRAR,$subido=false;
    private $arrayDeTipos = Array(
        "mp3" =>1,
        "JPG"=>1,
        "jpg"=>1
    );
    function __construct($parametro, $usuario) {
        $this->parametro = $parametro;
        $this->usuario = $usuario;
        $miArray = Array();
        if (isset($parametro)) {
            $this->parametrosOrdenados = Ordenar::reconstruirArchivo
                            ($parametro, $miArray);
            foreach ($this->parametrosOrdenados as $indice => $valor) {
                if ($valor["name"] !== "") {
                    $this->cantidadArchivos++;
                    $this->archivosUsuario[$indice]["nombre"] = pathinfo($valor["name"])["filename"];
                    $this->archivosUsuario[$indice]["extension"] = pathinfo($valor["name"])["extension"];
                    $this->archivosUsuario[$indice]["tamaño"] = $valor["size"];
                    $this->archivosUsuario[$indice]["destino"] = 
                            $this->destino.$usuario.'/';
                    $this->archivosUsuario[$indice]["destinoTemporal"] = $valor["tmp_name"];
                    $this->archivosUsuario[$indice]["subido"] = false;
                    $this->archivosUsuario[$indice]["error"] = false;
                }else{
                    $this->archivosUsuario[$indice]["error"] = true;
                }
            }
        }
    }
    function getCantidadArchivos() {
        return $this->cantidadArchivos;
    }

    function setCantidadArchivos($cantidadArchivos) {
        $this->cantidadArchivos = $cantidadArchivos;
    }

        function getParametrosOrdenados() {
        return $this->parametrosOrdenados;
    }
    function getArchivosUsuario() {
        return $this->archivosUsuario;
    }

    function setArchivosUsuario($archivosUsuario) {
        $this->archivosUsuario = $archivosUsuario;
    }

    function getDestino() {
        return $this->destino;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTamaño() {
        return $this->tamaño;
    }

    function getParametro() {
        return $this->parametro;
    }

    function getExtension() {
        return $this->extension;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getError() {
        return $this->error;
    }

    function getPolitica() {
        return $this->politica;
    }

    function getSubido() {
        return $this->subido;
    }

    function getArrayDeTipos() {
        return $this->arrayDeTipos;
    }

    function setParametrosOrdenados($parametrosOrdenados) {
        $this->parametrosOrdenados = $parametrosOrdenados;
    }

    function setDestino($destino) {
        $this->destino = $destino;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTamaño($tamaño) {
        $this->tamaño = $tamaño;
    }

    function setParametro($parametro) {
        $this->parametro = $parametro;
    }

    function setExtension($extension) {
        $this->extension = $extension;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setError($error) {
        $this->error = $error;
    }

    function setPolitica($politica) {
        $this->politica = $politica;
    }

    function setSubido($subido) {
        $this->subido = $subido;
    }

    function setArrayDeTipos($arrayDeTipos) {
        $this->arrayDeTipos = $arrayDeTipos;
    }
    
    public function upload(){
        foreach ($this->archivosUsuario as $indice => $valor) {
            if ($valor["subido"])
                return false;;
            if ($valor["error"] != UPLOAD_ERR_OK)
                return false;
            if ($valor["tamaño"] > $this->tamaño)
                return false;
            if (!$this->isTipo($valor["extension"]))
                return false;
            if (!(is_dir($valor["destino"]) && substr($valor["destino"], -1) === "/"))
                return false;
            if ($this->politica === self::RENOMBRAR && file_exists($valor["destino"] . $valor["nombre"] . "." . $valor["extension"]))
                $valor["nombre"] = $this->remplazar($indice, $valor["nombre"]);
            if (move_uploaded_file($valor["destinoTemporal"], $valor["destino"] . $valor["nombre"] . "." . $valor["extension"])) {
                $this->archivosUsuario[$indice]["subido"] = true;
            var_dump($valor["nombre"]);
            } else {
                $this->archivosUsuario[$indice]["subido"] = false;
            }
        }
    }

    private function remplazar($indice, $nombre){
        $i = 1;
        while(file_exists($this->archivosUsuario[$indice]["destino"] . 
                $nombre . "_" . $i . "." . 
                $this->archivosUsuario[$indice]["extension"])){
            $i++;
        }
        return $nombre."_".$i;
    }

    public function isTipo($tipo){
        return isset($this->arrayDeTipos[$tipo]);
    }
    public function addTipo($tipo){
        if(!$this->isTipo($tipo)){
            $this->arrayDeTipos[$tipo]=1;
            return true;
        }
        return false;
    }
    
    public function removeTipo($tipo){
        if($this->isTipo($tipo)){
            unset($this->arrayDeTipos[$tipo]);
            return true;
        }
        return false;
    }
    public function getNumeroSubidos() {
        $subidos = 0;
        foreach ($this->myArray as $indice => $valor) {
            if($valor["subido"])
                $subidos++;
        }
        return $subidos;
    }
    
}
