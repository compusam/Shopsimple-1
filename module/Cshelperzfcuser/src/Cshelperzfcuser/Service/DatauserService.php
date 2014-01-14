<?php

namespace Cshelperzfcuser\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Form\Form;
use Zend\Crypt\Password\Bcrypt;
use Zend\Stdlib\Parameters;
use ZfcUser\Options\UserControllerOptionsInterface;
class DatauserService implements ServiceManagerAwareInterface{
    protected $_form;
    
    protected $_usertable;
    
    /**
     * @var ServiceManager
     */
    protected $serviceManager;
    

    public function getForm() {
        $form = $this->_form;
        $this->setUsertable();
        $user = $this->getUsertable();
        $form->get('username')->setAttribute('value',$user['username']);
        $form->get('email')->setAttribute('value',$user['email']);
        $form->get('displayname')->setAttribute('value',$user['display_name']);
        return $form;
    }

    public function setForm(Form $form) {
        $this->_form = $form;
    }

    public function getUsertable() {
        return $this->_usertable;
    }

    public function setUsertable() {
        $user = $this->getServiceManager()
                ->get('core_service_cmf_user')
                ->getUser()->getBasicInfo();        
        $UserTable = $this->getServiceManager()
                ->get('Cshelperzfcuser\Model\UserTable');
        $resultUser = $UserTable->fetchOneById(array(
                'where'=>array('id'=>$user['id']),
                'order'=>'id ASC'
            ));        
        $this->_usertable = $resultUser;
    }

    /**
     * Obtiene Service Manager
     * 
     * @return type
     */
    public function getServiceManager(){
        return $this->serviceManager;
    }

    /**
     * Inyecta Service Manager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return \Cscore\Service\Cmf
     */
    public function setServiceManager(ServiceManager $serviceManager){
        $this->serviceManager = $serviceManager;
        return $this;
    } 

    public function verify($password){
        $userTable =$this->getUsertable();
        $bcrypt = new Bcrypt();
        $isCred = $bcrypt->verify($password, $userTable['password']);
        return $isCred;
    }
    

    
    public function saveUserTable(Parameters $post){
        $userinfo = $this->getServiceManager()->get('core_service_cmf_user')
                ->getUser()->getBasicInfo();
        $UserTable = $this->getServiceManager()
                ->get('Cshelperzfcuser\Model\UserTable');
        $data = array(
            'email'=>$post->email,
            'display_name'=>$post->displayname
        );
        if(!empty($post->passwordnew)){
            $zfcuser_module_options = $this->getServiceManager()
                    ->get('zfcuser_module_options');
            $bcrypt = new Bcrypt();
            $bcrypt->setCost($zfcuser_module_options->getPasswordCost()); 
            $data['password']= $bcrypt->create($post->passwordnew);
        }
        $UserTable->update($data,array('id'=>$userinfo['id']));
    }

 
}

