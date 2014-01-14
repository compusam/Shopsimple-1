<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Cscart\Form;

use Zend\Form\Form; 


class Btncheckout extends Form{
   public function __construct($name = null){ 
        parent::__construct('frm_btncheckout'); 
        
        $this->setAttribute('method', 'post');         
        
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
            'name' => 'btn_checkout',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Checkout',
                'id' => 'btn_checkout',
                'class'=>'btn btn-danger'
            ),
        ));
       
    }

}