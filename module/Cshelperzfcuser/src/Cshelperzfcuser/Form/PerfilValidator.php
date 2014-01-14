<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Cshelperzfcuser\Form;

use Zend\InputFilter\Factory as InputFactory; 
use Zend\InputFilter\InputFilter; 
use Zend\InputFilter\InputFilterAwareInterface; 
use Zend\InputFilter\InputFilterInterface; 

class PerfilValidator  implements InputFilterAwareInterface{
    protected $inputFilter; 
    
    public function setInputFilter(InputFilterInterface $inputFilter){ 
        throw new \Exception("Not used"); 
    }     

    public function getInputFilter() 
    {        
        if (!$this->inputFilter){ 
            $inputFilter = new InputFilter(); 
            $factory = new InputFactory(); 
            
        
            $inputFilter->add($factory->createInput(array(
                'name'     => 'email',
                'required' => true,
                'validators' => array(
                    array(
                        'name'    => 'EmailAddress',
                    ),
                ),
            ))); 
 
            $inputFilter->add($factory->createInput(array(
                'name'     => 'displayname',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 5,
                            'max'      => 255,
                        ),
                    ),
                ),
            )));  
            
            
            $inputFilter->add(array(
                'name'       => 'passwordactual',
                'required'   => true,
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'min' => 6,
                        ),
                    ),
                ),
                'filters'   => array(
                    array('name' => 'StringTrim'),
                ),
            ));            
            
            $inputFilter->add(array(
                'name'       => 'passwordnew',
                'required'   => false,
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'min' => 6,
                        ),
                    ),
                ),
                'filters'   => array(
                    array('name' => 'StringTrim'),
                ),
            ));

            $inputFilter->add(array(
                'name'       => 'passwordnewverify',
                'required'   => false,
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'min' => 6,
                        ),
                    ),
                    array(
                        'name' => 'identical',
                        'options' => array(
                            'token' => 'passwordnew'
                        )
                    ),
                ),
                'filters'   => array(
                    array('name' => 'StringTrim'),
                ),
            ));
        
                     
          $this->inputFilter = $inputFilter;  
        } 
        return $this->inputFilter;
    }     
}
