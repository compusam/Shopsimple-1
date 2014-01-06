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

class User{
    /**
     *
     * @var int 
     */
    protected $_id;
    /**
     *
     * @var string 
     */
    protected $_username;
    /**
     *
     * @var string 
     */
    protected $_email;
    /**
     *
     * @var string 
     */
    protected $_displayname;
    /**
     *
     * @var string 
     */
    protected $_password;
    /**
     *
     * @var int 
     */
    protected $_state;
    /**
     *
     * @var int 
     */
    protected $_gid;

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
    public function getUsername(){
        return $this->_username;
    }

    /**
     * 
     * @param string $username
     * @return \Cshelperzfcuser
     */
    public function setUsername($username){
        $this->_username=(string)$username;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getEmail(){
        return $this->_email;
    }

    /**
     * 
     * @param string $email
     * @return \Cshelperzfcuser
     */
    public function setEmail($email){
        $this->_email=(string)$email;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getDisplayname(){
        return $this->_displayname;
    }

    /**
     * 
     * @param string $displayname
     * @return \Cshelperzfcuser
     */
    public function setDisplayname($displayname){
        $this->_displayname=(string)$displayname;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getPassword(){
        return $this->_password;
    }

    /**
     * 
     * @param string $password
     * @return \Cshelperzfcuser
     */
    public function setPassword($password){
        $this->_password=(string)$password;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getState(){
        return $this->_state;
    }

    /**
     * 
     * @param int $state
     * @return \Cshelperzfcuser
     */
    public function setState($state){
        $this->_state=(int)$state;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getGid(){
        return $this->_gid;
    }

    /**
     * 
     * @param int $gid
     * @return \Cshelperzfcuser
     */
    public function setGid($gid){
        $this->_gid=(int)$gid;
        return $this;
    }

}
