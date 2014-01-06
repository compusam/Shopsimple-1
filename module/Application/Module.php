<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)    {        
        $application = $e->getApplication();        
        $services    = $application->getServiceManager(); 
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        /* set variable from service to layout */
        $viewModel = $application->getMvcEvent()->getViewModel();
        $core_service_cmf_user = $services->get('core_service_cmf_user');
        $core_service_cmf_credits = $services->get('core_service_cmf_credits');
        if(count($core_service_cmf_user->getUser()->getBasicInfo())>0){
            $viewModel->barUser = $core_service_cmf_user->getUser()
                    ->getBasicInfo();
            $viewModel->barCredit=$core_service_cmf_credits->getCredits()
                    ->getCreditByIdUser($viewModel->barUser['id']);             
        } 
    }
    
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

}
