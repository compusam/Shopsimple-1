<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetnavbarFactory
 *
 * @author flavio
 */
namespace NavBar\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use NavBar\Service\Getnavbar;

class GetnavbarFactory implements FactoryInterface{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $navigation = new Getnavbar();
        return $navigation->createService($serviceLocator);
    }
}

?>
