<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Cshelperzfcuser\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Validate extends Form{
    
   public function __construct($name = null){ 
        parent::__construct('Validate'); 
        
        $this->setAttribute('method', 'post'); 
        
        $this->add(array( 
            'name' => 'codigo_activa', 
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'codigo_activa', 
                'placeholder' => 'Ingresa tu código de activación', 
                'required' => 'required', 
                'class'=>'form-control'
            ), 
            'options' => array( 
                'label' => 'Código de activación:', 
            ),             
        )); 
        
         $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Activar',
                'id' => 'codigo_activacion_submit',
                'class'=>'btn btn-primary',
            ),
        ));
         
        $this->add(array( 
            'name' => 'csrf', 
            'type' => 'Zend\Form\Element\Csrf', 
        ));        
    }    
}
