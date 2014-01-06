<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Cshelperzfcuser\Form;

class Envio extends Form{
    
   public function __construct($name = null){ 
        parent::__construct('Envio'); 
        
        $this->setAttribute('method', 'post'); 
        
        $this->add(array( 
            'name' => 'soriana_ticket', 
            'type' => 'text', 
            'attributes' => array( 
                'class' => 'ClaseText', 
                'id' => 'soriana_ticket', 
                'placeholder' => 'Ticket', 
                'required' => 'required', 
            ), 
            'options' => array( 
                'label' => 'Ticket de Compra', 
            ),             
        )); 
        
         $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Registrar',
                'id' => 'ticket_form_soriana_submit',
            ),
        ));
         
//        $this->add(array( 
//            'name' => 'csrf', 
//            'type' => 'Zend\Form\Element\Csrf', 
//        ));        
    }    
}
