<?php
namespace Cshelperzfcuser\Form;

use Zend\Form\Form;
use Zend\Form\Element;
class Perfil extends Form{ 

    public function __construct($name = null)
    {
        parent::__construct('frm_perfil');
        $this->setAttribute('method', 'post'); 
        
       //informacion basica 
        $this->add(array( 
            'name' => 'username', 
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'username',
                'placeholder'=>'Usuario',
                'readOnly'=>true,
                'class'=>'form-control'
            ), 
            'options' => array( 
                'label' => 'Nombre de Concurso',
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
                'id' => 'display_name',
                'placeholder'=>'Nombre',
                'required' => 'required', 
                'class'=>'form-control'
            ), 
            'options' => array( 
                'label' => 'Nombre de Concurso',
            ),             
        ));
        
        $this->add(array( 
            'name' => 'passwordactual', 
            'type' => 'password', 
            'attributes' => array( 
                'id' => 'passwordactual',
                'placeholder'=>'Contraseña actual',
                'required' => 'required', 
                'class'=>'form-control'
            ), 
            'options' => array( 
                'label' => 'Contraseña actual',
            ),             
        ));
 
        $this->add(array( 
            'name' => 'passwordnew', 
            'type' => 'password', 
            'attributes' => array( 
                'id' => 'passwordnew',
                'placeholder'=>'Contraseña nueva',
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
            'name' => 'btn_miperfil',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Guadar Cambios',
                'id' => 'btn_miperfil',
                'class'=>'btn btn-success'
            ),
        ));        
        
        
        
        
        
    }
}