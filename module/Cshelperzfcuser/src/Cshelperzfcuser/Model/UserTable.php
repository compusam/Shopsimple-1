<?php
/**
 * CookieShop - Class for Mapper SQL.
 * @category   Model
 * @package    Cshelperzfcuser\Model
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 * @author Ing. Eduardo Ortiz <eduardooa1980@gmail.com>
 */
namespace Cshelperzfcuser\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select as Select;
use Cshelperzfcuser\Model\Entity\User as User;

class UserTable extends AbstractTableGateway{
    
    /**
     * name table 
     * @var type 
     */     
    protected $table  = 'user';
    
    /**
     * Constructor
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    } 
    
    public function insertRow($params){
        $values = array(
            'username' => $params['username'],
            'email' => $params['email'],
            'display_name' => $params['display_name'],
            'password' => $params['password'],
            'state' => $params['state'],
            'gid'=> $params['gid'],
        );
        
        $resultSet = $this->insert($values);
        return $resultSet;
    }
    
    /**
     * List All Items
     * 
     * @return type
     */
    public function fetchAll() {
        $resultSet = $this->select();
        $entities = array();
        foreach ($resultSet as $row) { 
            $entity = $this->setEntity($row);
            $entities[] = $this->getEntities($entity);
        }
        return $entities;
    }

    /**
     * List all Items by ID
     * Ex.	
     * $param = array(
     *       	     'where'=>array('id'=>$id),
     *               'order'=>'id ASC'
     *          );
     * @param type $id
     * @return type
     */
    public function findAllById($param) {
        $resultSet = $this->select(function (Select $select) use($param){
                    $select->where($param['where']);
                    $select->order($param['order']);
                });
        $entities = array();
        foreach ($resultSet as $row) { 
            $entity = $this->setEntity($row);
            $entities[] = $this->getEntities($entity);
        }
        return $entities;
    }  

    /**
     * List One a Item by ID
     * Ex.	
     * $param = array(
     *       	     'where'=>array('id'=>$id),
     *               'order'=>'id ASC'
     *          );
     * @param type $id
     * @return type
     */
    public function fetchOneById($param) {
        $resultSet = $this->select(function (Select $select) use($param){
                    $select->where($param['where']);
                    $select->order($param['order']);
                });
        $entities = array();
        if(count($resultSet)===1){
            $row = $resultSet->current();
            $entity = $this->setEntity($row);
            $entities = $this->getEntities($entity);             
        }
        return $entities;
    }

    /**
     * Setter Entities
     * 
     * @param type $row
     * @return \Cshelperzfcuser\Model\Entity\User
     */
    public function setEntity($row){
	$entity = new User();
        $entity->setId($row->id);
        $entity->setUsername($row->username);
        $entity->setEmail($row->email);
        $entity->setDisplayname($row->display_name);
        $entity->setPassword($row->password);
        $entity->setState($row->state);
        $entity->setGid($row->gid);
        return $entity;
    }

    /**
     * Getter type entity
     * 
     * @param \Cshelperzfcuser\Model\Entity\User $entity
     * @return type
     */
    public function getEntities(User $entity){
        $entities= array(
            'id' => $entity->getId(),
            'username' => $entity->getUsername(),
            'email' => $entity->getEmail(),
            'display_name' => $entity->getDisplayname(),
            'password' => $entity->getPassword(),
            'state' => $entity->getState(),
            'gid' => $entity->getGid(),
        ); 
        return $entities;
    }

    /**
     * List Items Paginator
     * 
     * @return type
     */
    public function fetchAllPages(){
        $resultSet = $this->select();
        $resultSet->buffer();
        $resultSet->next();        
        return $resultSet;
    }

    /**
     * List all Items by ID
     * Ex.	
     * $param = array(
     *       	     'where'=>array('id'=>$id),
     *               'order'=>'id ASC'
     *          );
     * @param type $id
     * @return type
     */
    public function findAllByIdPages($param) {
        $resultSet = $this->select(function (Select $select) use($param){
                    $select->where($param['where']);
                    $select->order($param['order']);
                });
        $resultSet->buffer();
        $resultSet->next();
        return $resultSet;
    } 
    
    public function updateUser($params, $user_id){
        $resultSet = $this->update($params, 'id='.$user_id);
        return $resultSet;
    }
}
