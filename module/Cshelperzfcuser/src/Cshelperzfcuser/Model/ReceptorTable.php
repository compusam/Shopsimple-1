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
use Cshelperzfcuser\Model\Entity\Receptor as Receptor;

class ReceptorTable extends AbstractTableGateway{
    
    /**
     * name table 
     * @var type 
     */     
    protected $table  = 'receptor';
    
    /**
     * Constructor
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    } 
    
    
    public function insertRow($params, $user_id){
        $values = array(
            'cscore_user_id' => $user_id,
            'rfc' => $params['rfc'],
            'nombre' => $params['nombre'],
            'calle' => $params['calle'],
            'no_exterior' => $params['no_exterior'],
            'no_interior'=> $params['no_interior'],
            'codigo_postal' => $params['codigo_postal'],
            'colonia'=> $params['colonia'],
            'estado'=> $params['estado'],
            'municipio' => $params['municipio'],
            'pais'=> $params['pais'],
            'last_update' => $params['last_update'],
            'estatus' => $params['estatus']
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
     * @return \Cshelperzfcuser\Model\Entity\Receptor
     */
    public function setEntity($row){
	$entity = new Receptor();
        $entity->setId($row->id);
        $entity->setCscoreuserid($row->cscore_user_id);
        $entity->setRfc($row->rfc);
        $entity->setNombre($row->nombre);
        $entity->setCalle($row->calle);
        $entity->setNoexterior($row->no_exterior);
        $entity->setNointerior($row->no_interior);
        $entity->setCodigopostal($row->codigo_postal);
        $entity->setColonia($row->colonia);
        $entity->setEstado($row->estado);
        $entity->setMunicipio($row->municipio);
        $entity->setPais($row->pais);
        $entity->setLastupdate($row->last_update);
        $entity->setEstatus($row->estatus);
        return $entity;
    }

    /**
     * Getter type entity
     * 
     * @param \Cshelperzfcuser\Model\Entity\Receptor $entity
     * @return type
     */
    public function getEntities(Receptor $entity){
        $entities= array(
            'id' => $entity->getId(),
            'cscore_user_id' => $entity->getCscoreuserid(),
            'rfc' => $entity->getRfc(),
            'nombre' => $entity->getNombre(),
            'calle' => $entity->getCalle(),
            'no_exterior' => $entity->getNoexterior(),
            'no_interior' => $entity->getNointerior(),
            'codigo_postal' => $entity->getCodigopostal(),
            'colonia' => $entity->getColonia(),
            'estado' => $entity->getEstado(),
            'municipio' => $entity->getMunicipio(),
            'pais' => $entity->getPais(),
            'last_update' => $entity->getLastupdate(),
            'estatus' => $entity->getEstatus(),
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
    
    public function updateReceptor($params, $id_user){
        $resultSet = $this->update($params, 'cscore_user_id='.$id_user);
        return $resultSet;
    }
}
