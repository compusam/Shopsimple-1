<?php
return array(
    'router' => array(
        'routes' => array(
            'micuenta' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/micuenta',
                    'defaults' => array(
                        'controller' => 'EstadoCuenta\Controller\Index',
                        'action'     => 'micuenta',
                    ),
                ),
            ),
            'pedidos' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/pedidos[/:page]',
                    'defaults' => array(
                        'controller' => 'EstadoCuenta\Controller\Index',
                        'action'     => 'pedidos',
                        'page'=>1
                    ),
                ),
            ),
            'tickets_registrados' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/tickets_registrados[/:page]',
                    'defaults' => array(
                        'controller' => 'EstadoCuenta\Controller\Index',
                        'action'     => 'tickets',
                        'page'=>1
                    ),
                ),
            ),
        ),
    ),
    
    'controllers' => array(
        'invokables' => array(
            'EstadoCuenta\Controller\Index' => 'EstadoCuenta\Controller\IndexController'
        ),
    ),
   
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);