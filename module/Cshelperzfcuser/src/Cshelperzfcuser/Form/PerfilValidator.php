<?php

namespace Cshelperzfcuser\Form;

use Zend\InputFilter\Factory;

class PerfilValidator{
    public function validateForm($post){
        $factory = new Factory();
       $inputFilter = $factory->createInputFilter(array(
            // Adding a single input
            'username'=> array(
                'name' => 'username',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 5
                        ),
                    ),
                ),
            ),

            'receptor_rfc'=> array(
                'name'=>'receptor_rfc',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 12
                        ),
                    ),
                ),
            ),

            'receptor_nombre' => array(
                'name'=>'receptor_nombre',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 4
                        ),
                    ),
                ),
            ),

            'receptor_calle'=>array(
                'name'=>'receptor_calle',
               'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 4
                        ),
                    ),
                ),
            ),

            'receptor_noexterior' =>array(
                'name'=>'receptor_noexterior',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'Int',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 1
                        ),
                    ),
                ),
            ),

            'receptor_nointerior'=> array(
                'name'=>'receptor_nointerior',
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 1
                        ),
                    ),
                ),
            ),

            'receptor_codigopostal'=> array(
                'name'=>'receptor_codigopostal',
                'required' => true,
                'validators' => array(
                    array(
                        'name'=>'Int'
                    ),
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 5
                        ),
                    ),
                ),
            ),

            'receptor_colonia'=>array(
                'name'=>'receptor_colonia',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 5
                        ),
                    ),
                ),
            ),

            'receptor_estado' => array(
                'name'=>'receptor_estado',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 2
                        ),
                    ),
                ),
            ),

            'receptor_municipio'=>array(
                'name'=>'receptor_municipio',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 4
                        ),
                    ),
                ),
            ),

            'receptor_pais'=>array(
                'name'=>'receptor_pais',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 2
                        ),
                    ),
                ),
                ),


            //-------------------------Datos de Envío--------------------------------------------
            //.-----------------------------------------------------------------------------------

            'envio_contacto' => array(
                'name'=>'envio_contacto',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 4
                        ),
                    ),
                ),
            ),

            'envio_calle' => array(
                'name'=>'envio_calle',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 3
                        ),
                    ),
                ),
            ),

            'envio_noexterior'=>array(
                'name'=>'envio_noexterior',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Int',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 1
                        ),
                    ),
                ),
            ),

            'envio_nointerior'=>array(
                'name'=>'envio_nointerior',
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 1
                        ),
                    ),
                ),
            ),

            'envio_codigopostal'=>array(
                'name'=>'envio_codigopostal',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Int',
                    ),
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 5
                        ),
                    ),
                ),
            ),

            'envio_colonia'=>array(
                'name'=>'envio_colonia',
               'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 4
                        ),
                    ),
                ),
            ),

            'envio_estado'=>array(
                'name'=>'envio_estado',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 2
                        ),
                    ),
                ),
            ),

           'envio_municipio'=> array(
                'name'=>'envio_municipio',
               'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 4
                        ),
                    ),
                ),
            ),

           'envio_crucecalles'=>array(
                'name'=>'envio_crucecalles',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 4
                        ),
                    ),
                ),
            ),

           'envio_telefono'=>array(
                'name'=>'envio_telefono',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'Int',
                    ),
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 3
                        ),
                    ),
                ),
            ),
           
           'password'=>array(
                'name'=>'password',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 5
                        ),
                    ),
                ),
            ),
           'password_new'=>array(
                'name'=>'password_new',
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 5
                        ),
                    ),
                ),
            ),
           'password_new_verify'=>array(
                'name'=>'password_new_verify',
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 5
                        ),
                    ),
                ),
            )
       ));
       
        
        $inputFilter->setData($post);
        return $inputFilter->isValid();
    }
}
