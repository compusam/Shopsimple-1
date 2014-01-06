<?php
/**
 * CookieShop - Class for Entities.
 * @category   Model
 * @package    Cshelperzfcuser\Model\Entity
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 * @author Ing. Eduardo Ortiz <eduardooa1980@gmail.com>
 */
namespace Cshelperzfcuser\Model\Entity;

class Receptor{
    /**
     *
     * @var int 
     */
    protected $_id;
    /**
     *
     * @var int 
     */
    protected $_cscoreuserid;
    /**
     *
     * @var string 
     */
    protected $_rfc;
    /**
     *
     * @var string 
     */
    protected $_nombre;
    /**
     *
     * @var string 
     */
    protected $_calle;
    /**
     *
     * @var int 
     */
    protected $_noexterior;
    /**
     *
     * @var string 
     */
    protected $_nointerior;
    /**
     *
     * @var int 
     */
    protected $_codigopostal;
    /**
     *
     * @var string 
     */
    protected $_colonia;
    /**
     *
     * @var string 
     */
    protected $_estado;
    /**
     *
     * @var string 
     */
    protected $_municipio;
    /**
     *
     * @var string 
     */
    protected $_pais;
    /**
     *
     * @var int 
     */
    protected $_lastupdate;
    /**
     *
     * @var int 
     */
    protected $_estatus;

    /**
     * 
     * @return int
     */
    public function getId(){
        return $this->_id;
    }

    /**
     * 
     * @param int $id
     * @return \Cshelperzfcuser
     */
    public function setId($id){
        $this->_id=(int)$id;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getCscoreuserid(){
        return $this->_cscoreuserid;
    }

    /**
     * 
     * @param int $cscoreuserid
     * @return \Cshelperzfcuser
     */
    public function setCscoreuserid($cscoreuserid){
        $this->_cscoreuserid=(int)$cscoreuserid;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getRfc(){
        return $this->_rfc;
    }

    /**
     * 
     * @param string $rfc
     * @return \Cshelperzfcuser
     */
    public function setRfc($rfc){
        $this->_rfc=(string)$rfc;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getNombre(){
        return $this->_nombre;
    }

    /**
     * 
     * @param string $nombre
     * @return \Cshelperzfcuser
     */
    public function setNombre($nombre){
        $this->_nombre=(string)$nombre;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getCalle(){
        return $this->_calle;
    }

    /**
     * 
     * @param string $calle
     * @return \Cshelperzfcuser
     */
    public function setCalle($calle){
        $this->_calle=(string)$calle;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getNoexterior(){
        return $this->_noexterior;
    }

    /**
     * 
     * @param int $noexterior
     * @return \Cshelperzfcuser
     */
    public function setNoexterior($noexterior){
        $this->_noexterior=(int)$noexterior;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getNointerior(){
        return $this->_nointerior;
    }

    /**
     * 
     * @param string $nointerior
     * @return \Cshelperzfcuser
     */
    public function setNointerior($nointerior){
        $this->_nointerior=(string)$nointerior;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getCodigopostal(){
        return $this->_codigopostal;
    }

    /**
     * 
     * @param int $codigopostal
     * @return \Cshelperzfcuser
     */
    public function setCodigopostal($codigopostal){
        $this->_codigopostal=(int)$codigopostal;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getColonia(){
        return $this->_colonia;
    }

    /**
     * 
     * @param string $colonia
     * @return \Cshelperzfcuser
     */
    public function setColonia($colonia){
        $this->_colonia=(string)$colonia;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getEstado(){
        return $this->_estado;
    }

    /**
     * 
     * @param string $estado
     * @return \Cshelperzfcuser
     */
    public function setEstado($estado){
        $this->_estado=(string)$estado;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getMunicipio(){
        return $this->_municipio;
    }

    /**
     * 
     * @param string $municipio
     * @return \Cshelperzfcuser
     */
    public function setMunicipio($municipio){
        $this->_municipio=(string)$municipio;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getPais(){
        return $this->_pais;
    }

    /**
     * 
     * @param string $pais
     * @return \Cshelperzfcuser
     */
    public function setPais($pais){
        $this->_pais=(string)$pais;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getLastupdate(){
        return $this->_lastupdate;
    }

    /**
     * 
     * @param int $lastupdate
     * @return \Cshelperzfcuser
     */
    public function setLastupdate($lastupdate){
        $this->_lastupdate=(int)$lastupdate;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getEstatus(){
        return $this->_estatus;
    }

    /**
     * 
     * @param int $estatus
     * @return \Cshelperzfcuser
     */
    public function setEstatus($estatus){
        $this->_estatus=(int)$estatus;
        return $this;
    }

}
