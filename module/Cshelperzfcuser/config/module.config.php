<?php
return array(
    'view_manager' => array(
//        'template_map' => array(
//            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
//        ),        
        'template_path_stack' => array(
            'cshelperzfcuser' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'cshelperzfcuser' => 'Cshelperzfcuser\Controller\UserController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'cshelperzfcuser' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/usuarios',
                    'defaults' => array(
                        'controller' => 'cshelperzfcuser',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'login' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/login',
                            'defaults' => array(
                                'controller' => 'cshelperzfcuser',
                                'action'     => 'login',
                            ),
                        ),
                    ),
                    'authenticate' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/auth',
                            'defaults' => array(
                                'controller' => 'cshelperzfcuser',
                                'action'     => 'authenticate',
                            ),
                        ),
                    ),
                    'logout' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/logout',
                            'defaults' => array(
                                'controller' => 'cshelperzfcuser',
                                'action'     => 'logout',
                            ),
                        ),
                    ),
                    'register' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/registrar',
                            'defaults' => array(
                                'controller' => 'cshelperzfcuser',
                                'action'     => 'register',
                            ),
                        ),
                    ),
                    'changepassword' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/change-password',
                            'defaults' => array(
                                'controller' => 'cshelperzfcuser',
                                'action'     => 'changepassword',
                            ),
                        ),                        
                    ),
                    'changeemail' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/change-email',
                            'defaults' => array(
                                'controller' => 'cshelperzfcuser',
                                'action' => 'changeemail',
                            ),
                        ),                        
                    ),
                    'deny' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/deny',
                            'defaults' => array(
                                'controller' => 'cshelperzfcuser',
                                'action' => 'deny',
                            ),
                        ),                        
                    ),      
                    'miperfil' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/miperfil',
                            'defaults' => array(
                                'controller' => 'cshelperzfcuser',
                                'action' => 'miperfil',
                            ),
                        ),                        
                    ),      
                    'verifypassword' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/verifypassword',
                            'defaults' => array(
                                'controller' => 'cshelperzfcuser',
                                'action' => 'verifypassword',
                            ),
                        ),                        
                    ),
                    'getpoblaciones' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/getpoblaciones[/:estado]',
                            'defaults' => array(
                                'controller' => 'cshelperzfcuser',
                                'action' => 'getpoblaciones',
                            ),
                        ),                        
                    ),
                    'activate' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/activate',
                            'defaults' => array(
                                'controller' => 'cshelperzfcuser',
                                'action' => 'activate',
                            ),
                        ),                        
                    ),
                ),
            ),
        ),
    ),
);
