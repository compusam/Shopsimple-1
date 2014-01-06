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

class Receptorenvio{
    /**
     *
     * @var int 
     */
    protected $_id;
    /**
     *
     * @var int 
     */
    protected $_receptorid;
    /**
     *
     * @var string 
     */
    protected $_contacto;
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
    protected $_crucecalles;
    /**
     *
     * @var int 
     */
    protected $_telefono;
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
    public function getReceptorid(){
        return $this->_receptorid;
    }

    /**
     * 
     * @param int $receptorid
     * @return \Cshelperzfcuser
     */
    public function setReceptorid($receptorid){
        $this->_receptorid=(int)$receptorid;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getContacto(){
        return $this->_contacto;
    }

    /**
     * 
     * @param string $contacto
     * @return \Cshelperzfcuser
     */
    public function setContacto($contacto){
        $this->_contacto=(string)$contacto;
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
    public function getCrucecalles(){
        return $this->_crucecalles;
    }

    /**
     * 
     * @param string $crucecalles
     * @return \Cshelperzfcuser
     */
    public function setCrucecalles($crucecalles){
        $this->_crucecalles=(string)$crucecalles;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getTelefono(){
        return $this->_telefono;
    }

    /**
     * 
     * @param int $telefono
     * @return \Cshelperzfcuser
     */
    public function setTelefono($telefono){
        $this->_telefono=(int)$telefono;
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
