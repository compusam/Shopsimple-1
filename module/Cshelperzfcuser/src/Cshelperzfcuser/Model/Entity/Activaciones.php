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

class Activaciones{
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
    protected $_codigo;
    /**
     *
     * @var int 
     */
    protected $_fecha;
    /**
     *
     * @var int 
     */
    protected $_ip;
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
    public function getCodigo(){
        return $this->_codigo;
    }

    /**
     * 
     * @param string $codigo
     * @return \Cshelperzfcuser
     */
    public function setCodigo($codigo){
        $this->_codigo=(string)$codigo;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getFecha(){
        return $this->_fecha;
    }

    /**
     * 
     * @param int $fecha
     * @return \Cshelperzfcuser
     */
    public function setFecha($fecha){
        $this->_fecha=(int)$fecha;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getIp(){
        return $this->_ip;
    }

    /**
     * 
     * @param int $ip
     * @return \Cshelperzfcuser
     */
    public function setIp($ip){
        $this->_ip=(int)$ip;
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