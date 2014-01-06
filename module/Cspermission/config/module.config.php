<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'permisiondeny' => 'Cspermission\Controller\IndexController',
        ),
    ),
    'controller_plugins' => array(
    'invokables' => array(
        'Permission' => 'Cspermission\Controller\Plugin\Permission'
        )
    ),     
    'router' => array(
        'routes' => array(
            'permisiondeny' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/deny',
                    'defaults' => array(
                        'controller' => 'permisiondeny',
                        'action'     => 'deny',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(                  
                ),
            ),
        ),
    ),
);