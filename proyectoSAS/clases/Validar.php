<?php

class Validar {
    
    static function isDate($valor){
        $fecha = explode($valor, "/");
        if(!($this->isLength($fecha[0], 4, 4) && $this->isLength($fecha[1], 2, 2) && $this->isLength($fecha[2], 2, 2)))
            return false;
        if(!$this->isValueEntre($fecha[0], (int) date("Y",$_SERVER["REQUEST_TIME"]), 0))
            return false;
        if(!$this->isValueEntre($fecha[1], 12, 1))
            return false;
        if(!$this->isValueEntre($fecha[2], 31, 1))
            return false;
        return true;
    }

    static function isString($valor){
        return is_string($valor);
    }

    static function isRequired($valor){
        return $valor !== null;
    }

    static function isBoolean($valor){
        return is_bool($valor);
    }

    static function isIp($valor){
        return filter_var($valor, FILTER_VALIDATE_IP);
    }
    
    static function isFormatUrl($valor){
        return filter_var($valor, FILTER_VALIDATE_URL);
    }
    
    static function isFormatEmail($valor,$longitud = null){
        return filter_var($valor, FILTER_VALIDATE_EMAIL);
    }
    
    static function isLength($valor, $lengthMax = null, $lengthMin = null){
        if(isset($lengthMax) && strlen($valor)>$lengthMax)
            return false;
        if(isset($lengthMin) && strlen($valor)<$lengthMin)
            return false;
        return true;
    }
    
//    static function isLengthMin($valor, $length){
//        return strlen($valor) >= $length;
//    }
//    
//    static function isLengthMax($valor, $length){
//        return strlen($valor) <= $length;
//    }
    
    static function isValueEntre($valor, $maximo = null, $minimo = null){
        if($maximo !== null && $minimo!==null)
            return ($valor<$maximo && $valor>$minimo);
        if($maximo !== null)
            return $valor<$maximo;
        if($minimo !== null)
            return $valor>$minimo;
    }
    
    static function isNumber($valor, $entero = false){
        if($entero)
            return $this->isInt ($valor);
        return $this->isFloat($valor);
    }
    
    private static function isInt($valor){
        return filter_var($valor, FILTER_VALIDATE_INT);
    }
    
    private static function isFloat($valor){
        return filter_var($valor, FILTER_VALIDATE_FLOAT);
    }
    
    static function isLogin($valor){
        return preg_match("/^[A-Za-z][A-Za-z0-9]{5,9}$/", $valor);
    }
    
}
