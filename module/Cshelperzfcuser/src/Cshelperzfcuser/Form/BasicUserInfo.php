<?php
namespace Cshelperzfcuser\Form;

use Zend\Form\Form;
use Zend\Form\Element;
class BasicUserInfo extends Form{ 

    public function __construct()
    {
        parent::__construct();

       $this->add(array(
            'name' => 'username',
            'options' => array(
                'label' => 'Usuario *',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'options' => array(
                'label' => 'Email *',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));

        $this->add(array(
            'name' => 'display_name',
            'options' => array(
                'label' => 'Nombre *',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));
        
        $this->add(array(
            'name' => 'password_actual',
            'options' => array(
                'label' => 'Contraseña actual *',
            ),
            'attributes' => array(
                'id'=>'password_actual',
                'type' => 'password'
            ),
        ));
        
        $this->add(array(
            'name' => 'password_new',
            'options' => array(
                'label' => 'Contraseña nueva *',
            ),
            'attributes' => array(
                'id'=>'password_new',
                'type' => 'password'
            ),
        ));

        $this->add(array(
            'name' => 'password_new_verify',
            'options' => array(
                'label' => 'Confirmar contraseña *',
            ),
            'attributes' => array(
                'id'=>'password_new-varify',
                'type' => 'password'
            ),
        ));
        
        $submitElement = new Element\Button('submit');
        $submitElement
            ->setLabel('Submit')
            ->setAttributes(array(
                'type'  => 'submit',
            ));

        $this->add($submitElement, array(
            'priority' => -100,
        ));

    }
}