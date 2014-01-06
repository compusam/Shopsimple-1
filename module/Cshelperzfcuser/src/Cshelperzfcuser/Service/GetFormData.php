<?php

namespace Cshelperzfcuser\Service;

class GetFormData{
    
    public function __construct($sm) {
        $this->sm = $sm ;
    }
    public function setData(array $form_data, $user_id){
        // user table
        $form_data['user'] = $user_table = $this->sm->get('Cshelperzfcuser\Model\UserTable')
                    ->fetchOneById(array(
                        'where'=>array('id'=>$user_id),
                        'order'=>'id ASC'
                    ));
        
        // receptor table
        $form_data['receptor'] =  $receptor_table = $this->sm->get('Cshelperzfcuser\Model\ReceptorTable')
                    ->fetchOneById(array(
                        'where'=>array('cscore_user_id'=>$user_id),
                        'order'=>'id ASC'
                    ));
       
        // receptor_envio table
        if(count($form_data['receptor'])){
            $form_data['receptor_envio'] = $this->sm->get('Cshelperzfcuser\Model\ReceptorenvioTable')
            ->fetchOneById(array(
                'where'=>array('receptor_id'=>$form_data['receptor']['id']),
                'order'=>'id ASC'
            ));
        }

        
        return $form_data;
    }
}
