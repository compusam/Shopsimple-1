<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Csproductcmf\Form;

use Zend\Form\Form; 
 
class Producto extends Form{
   public function __construct($name = null){ 
        parent::__construct('frm_products'); 
        
        $this->setAttribute('method', 'post'); 
        $this->setAttribute('class', 'frm_product'); 
        $this->add(array( 
            'name' => 'user_id', 
            'type' => 'hidden', 
            'attributes' => array( 
                'id' => 'user_id', 
                'required' => 'required', 
            ), 
            'options' => array( 
            ),             
        )); 
        $this->add(array( 
            'name' => 'product_id', 
            'type' => 'hidden', 
            'attributes' => array( 
                'id' => 'product_id', 
                'required' => 'required', 
            ), 
            'options' => array( 
            ),             
        )); 
        $this->add(array( 
            'name' => 'quantity', 
            'type' => 'Zend\Form\Element\Select', 
            'attributes' => array( 
                'id' => 'quantity', 
                'required' => 'required', 
                'class'=>'form-control',
                'style'=>'width:50%'
                 
            ), 
            'options' => array(
                     'label' => '',
                     'value_options' => array(
                             '1' => '1',
                             '2' => '2',
                             '3' => '3',
                             '4' => '4',
                             '5' => '5',
                     ),
             )           
        )); 
        $this->add(array( 
            'name' => 'price', 
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'price', 
                'required' => 'required', 
            ), 
            'options' => array( 
            ),             
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
            'options' => array(
                    'csrf_options' => array(
                            'timeout' => 600
                    )
            )
        ));
        
         $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Añadir',
                'id' => 'ticket_form_soriana_submit',
                'class'=>'btn btn-primary'
            ),
        ));
         
//        $this->add(array( 
//            'name' => 'csrf', 
//            'type' => 'Zend\Form\Element\Csrf', 
//        ));        
    }     
}
