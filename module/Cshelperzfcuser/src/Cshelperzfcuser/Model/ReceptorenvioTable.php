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
use Cshelperzfcuser\Model\Entity\Receptorenvio as Receptorenvio;

class ReceptorenvioTable extends AbstractTableGateway{
    
    /**
     * name table 
     * @var type 
     */     
    protected $table  = 'receptor_envio';
    
    /**
     * Constructor
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    } 
    
    public function insertRow($params, $receptor_id){
        $values = array(
            'contacto' => $params['contacto'],
            'calle' => $params['calle'],
            'no_exterior' => $params['no_exterior'],
            'no_interior' => $params['no_interior'],
            'codigo_postal' => $params['codigo_postal'],
            'colonia'=> $params['colonia'],
            'estado' => $params['estado'],
            'municipio'=> $params['municipio'],
            'cruce_calles'=> $params['cruce_calles'],
            'telefono' => $params['telefono'],
            'last_update'=> $params['last_update'],
            'estatus' => $params['estatus'],
            'receptor_id' => $receptor_id
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
     * @return \Cshelperzfcuser\Model\Entity\Receptorenvio
     */
    public function setEntity($row){
	$entity = new Receptorenvio();
        $entity->setId($row->id);
        $entity->setReceptorid($row->receptor_id);
        $entity->setContacto($row->contacto);
        $entity->setCalle($row->calle);
        $entity->setNoexterior($row->no_exterior);
        $entity->setNointerior($row->no_interior);
        $entity->setCodigopostal($row->codigo_postal);
        $entity->setColonia($row->colonia);
        $entity->setEstado($row->estado);
        $entity->setMunicipio($row->municipio);
        $entity->setCrucecalles($row->cruce_calles);
        $entity->setTelefono($row->telefono);
        $entity->setLastupdate($row->last_update);
        $entity->setEstatus($row->estatus);
        return $entity;
    }

    /**
     * Getter type entity
     * 
     * @param \Cshelperzfcuser\Model\Entity\Receptorenvio $entity
     * @return type
     */
    public function getEntities(Receptorenvio $entity){
        $entities= array(
            'id' => $entity->getId(),
            'receptor_id' => $entity->getReceptorid(),
            'contacto' => $entity->getContacto(),
            'calle' => $entity->getCalle(),
            'no_exterior' => $entity->getNoexterior(),
            'no_interior' => $entity->getNointerior(),
            'codigo_postal' => $entity->getCodigopostal(),
            'colonia' => $entity->getColonia(),
            'estado' => $entity->getEstado(),
            'municipio' => $entity->getMunicipio(),
            'cruce_calles' => $entity->getCrucecalles(),
            'telefono' => $entity->getTelefono(),
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
    
    public function updateReceptorenvio($params, $id_receptor){
        $resultSet = $this->update($params, 'receptor_id='.$id_receptor);
        return $resultSet;
    }
}
