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
                'Cshelperzfcuser\Model\ReceptorTable'=>  function($sm){
                    $dbAdapter = $sm->get('db1');
                    $table = new Model\ReceptorTable($dbAdapter);
                    return $table;                    
                },
                'Cshelperzfcuser\Model\ReceptorenvioTable'=>  function($sm){
                    $dbAdapter = $sm->get('db1');
                    $table = new Model\ReceptorenvioTable($dbAdapter);
                    return $table;                    
                },
                'Cshelperzfcuser\Model\UserTable'=>  function($sm){
                    $dbAdapter = $sm->get('db');
                    $table = new Model\UserTable($dbAdapter);
                    return $table;                    
                },    
                'Cshelperzfcuser\Model\EstadosTable'=>  function($sm){
                    $dbAdapter = $sm->get('db1');
                    $table = new Model\EstadosTable($dbAdapter);
                    return $table;                    
                },
                'Cshelperzfcuser\Model\PoblacionTable'=>  function($sm){
                    $dbAdapter = $sm->get('db1');
                    $table = new Model\PoblacionTable($dbAdapter);
                    return $table;                    
                },
                'Cshelperzfcuser\Model\ActivacionesTable'=>  function($sm){
                    $dbAdapter = $sm->get('db1');
                    $table = new Model\ActivacionesTable($dbAdapter);
                    return $table;                    
                },
                'Cshelperzfcuser\Service\CreateExtraFields'=>  function($sm){
                    $service = new \Cshelperzfcuser\Service\CreateExtraFields();
                    return $service;                    
                },
                'Cshelperzfcuser\Form\RegisterValidator'=>  function($sm){
                    $service = new \Cshelperzfcuser\Form\RegisterValidator();
                    return $service;                    
                },
                'Cshelperzfcuser\Form\PerfilValidator'=>  function($sm){
                    $service = new \Cshelperzfcuser\Form\PerfilValidator();
                    return $service;                    
                },
                'Cshelperzfcuser\Form\BasicUserInfo'=>  function($sm){
                    $form = new \Cshelperzfcuser\Form\BasicUserInfo();
                    return $form;                    
                },
                'Cshelperzfcuser\Service\GetFormData'=>  function($sm){
                    $service = new \Cshelperzfcuser\Service\GetFormData($sm);
                    return $service;                    
                },
           )    
        );
    }     
   
}
