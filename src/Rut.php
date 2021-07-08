<?php namespace DavidVegaCl\LaravelChile;

/**
 * Rut
 * Utiles para manejar RUT/RUN Chileno
 * @package Davidvegacl\LaravelChile
 * @author: David Vega <david@izarus.cl>
 */
class Rut
{
    /**
     * Formato para RUT/RUN completo. Ej: 12.345.678-9
     */
    const FORMATO_COMPLETO = 1;

    /**
     * Formato para RUT/RUN solo con guión. Ej: 12345678-9
     */
    const FORMATO_SIMPLE = 2;

    /**
     * Formato solo para número, sin digito verificador. Ej: 12345678
     */
    const FORMATO_RUT = 3;

    /**
     * Número de RUT/RUN
     * @var string
     */
    protected $rut = null;

    /**
     * Digito verificador de RUT/RUN (0-9) o K/k
     * @var string
     */
    protected $dv = null;

    /**
     * Constructor
     * @param string $rut
     * @param string $dv
     */
    public function __construct($rut = null, $dv = null)
    {
        if(empty($dv)) {
            list($this->rut, $this->dv) = self::separar($rut);
        } else {
            $this->rut = $rut;
            $this->dv = $dv;   
        }
    }

    /** GETTERS / SETTERS */
    public function getRut()
    {
        return $this->rut;
    }

    public function setRut($rut = null)
    {
        $this->rut = $rut;
    }

    public function getDv()
    {
        return $this->dv;
    }

    public function setDv($dv = null)
    {
        $this->dv = $dv;
    }

    /**
     * Valida el RUT/RUN actual
     * @return boolean
     */
    public function isValid()
    {
        return self::validar($this->rut,$this->dv);
    }

    /**
     * return $this->isValid()
     */
    public function validate()
    {
        return $this->isValid();
    }

    /**
     * Formatea y devuelve RUT/RUN según formato elegido
     * @param integer $formato Formato seleccionado
     * @return string RUT/RUN formateado
     */
    public function formateado($formato = self::FORMATO_COMPLETO)
    {
        switch ($formato) {
            case static::FORMATO_SIMPLE:
                return $this->rut."-".$this->dv;
                break;
            case static::FORMATO_RUT:
                return $this->rut;
                break;
            case static::FORMATO_COMPLETO:
            default:
                return number_format((int)$this->rut, 0, null, ".")."-".$this->dv;
                break;
        }
    }

    /**
     * Devuelve RUT actual en un string según formato
     * @return string
     * @throws InvalidFormatException
     */
    public function __toString()
    {
        return $this->formateado();
    }

    /**
     * Devuelve RUT actual en array
     * @return array
     */
    public function toArray()
    {
        return [$this->rut, $this->dv];
    }


    /**
     * UTILES
     */

    /**
     * Carga y devuelve objeto Rut desde string
     * @param string $rut RUT con digito verificador (cualquier formato)
     * @return Rut
     */
    public static function parse($rut)
    {
        return (new self($rut));
    }

    
    /**
     * Separa un RUT completo en un array de RUT/RUN y digito verificador
     * Asume que el último caracter es el digito verificador
     * @param string $rut
     * @return array [$rut,$dv]
     */
    public static function separar($rut)
    {
        $rut = self::limpiar($rut);
        $rut = str_replace('-','',$rut); 
        return [substr($rut, 0, -1),(substr($rut, -1))];
    }

    /**
     * Elimina caracteres fuera de los permitidos por un RUT/RUN
     * @param string $string 
     * @return string RUT/RUN limpio
     */
    public static function limpiar($rut)
    {
        return preg_replace('/[^0-9Kk\-]/','',$rut);
    }

    /**
     * Calcula y devuelve el digito verificador de un RUT/RUN sin DV
     * @param string RUT/RUN sin digito verificador
     * @return string digito verificador
     */
    public static function calcularVerificador($rut)
    {
        $rut = preg_replace('/[^0-9]/','',$rut);
        $s=1;
        for ($m=0; $rut != 0; $rut /= 10) {
            $s=($s+$rut % 10 * (9-$m++%6))%11;
        }
        return chr($s?$s+47:75);
    }


    /**
     * Valida un RUT con digito verificador (junto o separado)
     * @param string  $rut  RUT con o sin verificador
     * @param null|string  $dv   digito verificador (si es null, se obtiene del parametro $rut)
     * @return boolean true si el RUT/RUN es valido
     */
    public static function validar($rut, $dv = null)
    {
        if ($dv===null) {
            list($rut, $dv) = self::separar($rut);
        }
        if (!is_numeric($rut)) {
            return false;
        }
        return ($dv == self::calcularVerificador($rut));
    }

}
