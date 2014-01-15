<?php
namespace Cshelperzfcuser\Form;

use Zend\Form\Form;

class Registrar extends Form{ 

    public function __construct($name = null)
    {
        parent::__construct('frm_registrar');
        $this->setAttribute('method', 'post'); 
        
       //informacion basica 
        $this->add(array( 
            'name' => 'username', 
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'username',
                'placeholder'=>'Usuario',
                'required' => 'required',
                'class'=>'form-control'
            ), 
            'options' => array( 
            ),             
        ));

        $this->add(array( 
            'name' => 'email', 
            'type' => 'email', 
            'attributes' => array( 
                'id' => 'email',
                'placeholder'=>'Email',
                'required' => 'required', 
                'class'=>'form-control'
            ), 
            'options' => array( 
                'label' => 'Email',
            ),             
        ));

        $this->add(array( 
            'name' => 'displayname', 
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'displayname',
                'placeholder'=>'Nombre',
                'required' => 'required', 
                'class'=>'form-control'
            ), 
            'options' => array( 
            ),             
        ));

 
        $this->add(array( 
            'name' => 'passwordnew', 
            'type' => 'password', 
            'attributes' => array( 
                'id' => 'passwordnew',
                'placeholder'=>'Contraseña nueva',
                'required' => 'required',
                'class'=>'form-control'
            ), 
            'options' => array( 
                'label' => 'Contraseña nueva',
            ),             
        ));
        
        $this->add(array( 
            'name' => 'passwordnewverify', 
            'type' => 'password', 
            'attributes' => array( 
                'id' => 'passwordnewverify',
                'placeholder'=>'Confirmar contraseña',
                'required' => 'required',
                'class'=>'form-control'
            ), 
            'options' => array( 
                'label' => 'Contraseña nueva',
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
            'name' => 'btn_registrar',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Guadar Cambios',
                'id' => 'btn_registrar',
                'class'=>'btn btn-success'
            ),
        ));        
        
        
        
        
        
    }
}