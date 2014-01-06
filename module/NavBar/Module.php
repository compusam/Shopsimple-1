<?php
namespace NavBar;

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
    

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Navigation' => 'NavBar\Service\GetnavbarFactory'
            ),
            'initializers' => array(
                function ($instance, $sm) {
                    if ($instance instanceof \Zend\Db\Adapter\AdapterAwareInterface) {
                        $instance->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
                    }
                }
            ),
            'invokables' => array(
                 'menu' => 'ZendSkeletonModule\Model\MenuTable'
            ),
                    
        );         
    }
}
