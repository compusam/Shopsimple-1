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

class Estados{
    /**
     *
     * @var int 
     */
    protected $_id;
    /**
     *
     * @var string 
     */
    protected $_nombre;

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

}
