<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreateExtraFields
 *
 * @author flavio
 */
namespace Cshelperzfcuser\Service;

use Zend\Form\Form;

class CreateExtraFields {
    public function addExtraFields(Form $form){
        //-------------------------Datos de Facturacion--------------------------------------------
        //.-----------------------------------------------------------------------------------
        $form->add(array(
            'name'=>'receptor_rfc',
            'options' => array(
                'label'=>'RFC *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"receptor_rfc",
                'type' => 'text'
            ),
        ));
        
        $form->add(array(
            'name'=>'receptor_nombre',
            'options' => array(
                'label'=>'Nombre *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"receptor_nombre",
                'type' => 'text'
            ),
        ));
        
        $form->add(array(
            'name'=>'receptor_calle',
            'options' => array(
                'label'=>'Calle *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"receptor_calle",
                'type' => 'text'
            ),
        ));
        
        $form->add(array(
            'name'=>'receptor_noexterior',
            'options' => array(
                'label'=>'# Exterior',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"receptor_noexterior",
                'type' => 'text'
            ),
        ));
        
        $form->add(array(
            'name'=>'receptor_nointerior',
            'options' => array(
                'label'=>'# Interior',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"receptor_nointerior",
                'type' => 'text'
            ),
        ));
        
        $form->add(array(
            'name'=>'receptor_codigopostal',
            'options' => array(
                'label'=>'Codigo Postal *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"receptor_codigopostal",
                'type' => 'text'
            ),
        ));
        
        $form->add(array(
            'name'=>'receptor_colonia',
            'options' => array(
                'label'=>'Colonia *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"receptor_colonia",
                'type' => 'text'
            ),
        ));
        
        $form->add(array(
            'name'=>'receptor_estado',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label'=>'Estado *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"receptor_estado",
            ),
        ));
        
        $form->add(array(
            'name'=>'receptor_municipio',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label'=>'Municipio *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"receptor_municipio",
            ),
        ));
        
        $form->add(array(
            'name'=>'receptor_pais',
            'type' => 'Zend\Form\Element\Hidden',
            'options' => array(
                'label'=>'Pais *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"receptor_pais",
                "value"=>"Mexico"
            ),
        ));
        
           
        //-------------------------Datos de Envío--------------------------------------------
        //.-----------------------------------------------------------------------------------
        
        $form->add(array(
            'name'=>'envio_contacto',
            'options' => array(
                'label'=>'Contacto *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"envio_contacto",
                'type' => 'text'
            ),
        ));
        
        $form->add(array(
            'name'=>'envio_calle',
            'options' => array(
                'label'=>'Calle *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"envio_calle",
                'type' => 'text'
            ),
        ));
        
        $form->add(array(
            'name'=>'envio_noexterior',
            'options' => array(
                'label'=>'# exterior *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"envio_noexterior",
                'type' => 'text'
            ),
        ));
        
        $form->add(array(
            'name'=>'envio_nointerior',
            'options' => array(
                'label'=>'# interior',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"envio_nointerior",
                'type' => 'text'
            ),
        ));
         
        $form->add(array(
            'name'=>'envio_codigopostal',
            'options' => array(
                'label'=>'Código postal *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"envio_codigopostal",
                'type' => 'text'
            ),
        ));
        
        $form->add(array(
            'name'=>'envio_colonia',
            'options' => array(
                'label'=>'Colonia *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"envio_colonia",
                'type' => 'text'
            ),
        ));
        
        $form->add(array(
            'name'=>'envio_estado',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label'=>'Estado *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"envio_estado",
            ),
        ));
        
        $form->add(array(
            'name'=>'envio_municipio',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label'=>'Municipio *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"envio_municipio",
            ),
        ));
        
        $form->add(array(
            'name'=>'envio_crucecalles',
            'options' => array(
                'label'=>'Cruce de calles *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"envio_crucecalles",
                'type' => 'text'
            ),
        ));
       
        $form->add(array(
            'name'=>'envio_telefono',
            'options' => array(
                'label'=>'Teléfono *',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"envio_telefono",
                'type' => 'text'
            ),
        ));
        
        $form->add(array(
            'name'=>'acceptTerms',
            'type'=>'Zend\Form\Element\Checkbox',
            'options' => array(
                'label'=>'Estoy de acuerdo con los términos y condiciones.',
            ),
            'attributes'=>array(
                'class'=>'required',
                "id"=>"acceptTerms"
            ),
        ));
        
         $form->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
            'options' => array(
                'csrf_options' => array(
                        'timeout' => 600
                )
            )
        ));
        
        return $form;
    }
}

?>
