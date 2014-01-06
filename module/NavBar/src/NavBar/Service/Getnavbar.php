<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Getnavbar
 *
 * @author flavio
 */
namespace NavBar\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Navigation\Service\DefaultNavigationFactory;

class Getnavbar extends DefaultNavigationFactory {    
       protected function getPages(ServiceLocatorInterface $serviceLocator)
    {
        if (null === $this->pages) {
           
            $configuration['navigation']['default'] = array(
                array(
                    'label' => 'Inicio',
                    'route' => 'home',
                    'pages'=>array(
                        array(
                            'label'=>'Mecánica',
                            'route'=>'mecanica',
                            'pages'=>array(
                                array(
                                    'label'=>'Mecánica ADPRESS',
                                    'route'=>'mecanica'
                                ),
                                array(
                                    'label'=>'Promociones',
                                    'route'=>'promociones'
                                ),
                                array(
                                    'label'=>'Descarga de APPS',
                                    'route'=>'apps'
                                ),
                            )
                        ),
                        array(
                            'label'=>'Activa tu cuenta',
                            'route'=>'cshelperzfcuser/activate'
                        ),
                        array(
                            'label'=>'Mi Perfil',
                            'route'=>'cshelperzfcuser/miperfil'
                        ),
                        array(
                            'label'=>'Catálogos',
                            'route'=>'Cscategorycmf\Controller\Index'
                        ),
                        array(
                            'label'=>'Carrito',
                            'route'=>'cscart_controller_index'
                        ),
                        array(
                            'label'=>'Estado de Cuenta',
                            'route'=>'micuenta',
                            'pages'=>array(
                                array(
                                    'label'=>'Mi Cuenta',
                                    'route'=>'micuenta'
                                ),
                                array(
                                    'label'=>'Historial de Pedidos',
                                    'route'=>'pedidos'
                                ),
                            ),
                        ),
                        array(
                            'label'=>'Ayuda',
                            'route'=>'ayuda'
                        ),
                        array(
                            'label'=>'Aviso de Privacidad',
                            'route'=>'aviso'
                        ),
                    ),
                ),
                
            );
          
            if (!isset($configuration['navigation'])) {
                throw new Exception\InvalidArgumentException('Could not find navigation configuration key');
            }
            if (!isset($configuration['navigation'][$this->getName()])) {
                throw new Exception\InvalidArgumentException(sprintf(
                    'Failed to find a navigation container by the name "%s"',
                    $this->getName()
                ));
            }
 
            $application = $serviceLocator->get('Application');
            $routeMatch  = $application->getMvcEvent()->getRouteMatch();
            $router      = $application->getMvcEvent()->getRouter();
            $pages       = $this->getPagesFromConfig($configuration['navigation'][$this->getName()]);
 
            $this->pages = $this->injectComponents($pages, $routeMatch, $router);
        }
        return $this->pages;
    }
}

?>
