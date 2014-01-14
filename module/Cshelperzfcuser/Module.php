<?php
namespace Cshelperzfcuser;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig(){
        return array(
            'factories' => array(
                'Cshelperzfcuser\Model\UserTable'=>  function($sm){
                    $dbAdapter = $sm->get('db');
                    $table = new Model\UserTable($dbAdapter);
                    return $table;                    
                },
                'cshelperzfcuser_service_datauser'=> function($sm){
                    $datauser = new \Cshelperzfcuser\Service\DatauserService;
                    $datauser->setServiceManager($sm);
                    return $datauser;
                },                        
           )    
        );
    }     
   
}
