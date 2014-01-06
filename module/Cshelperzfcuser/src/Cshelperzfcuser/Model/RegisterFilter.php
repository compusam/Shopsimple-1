<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Cshelperzfcuser\Model;

class RegisterFilter{
    /**
     *
     * @var type 
     */
    protected $post;
    /**
     *
     * @var type 
     */
    protected $envio;
    /**
     *
     * @var type 
     */
    protected $receptor;
    /**
     *
     * @var type 
     */
    protected $user;
    /**
     * 
     * @param array $array
     */
    public function __construct(array $array) {
        if(is_array($array)){
            $this->post = $array;
        }
    }
    /**
     * 
     * @param type $envio
     */
    public function setEnvio($envio){
        $this->envio = $envio;
    }
    /**
     * 
     * @return type
     */
    public function getEnvio() {
        $date = new \DateTime('now',
                new \DateTimeZone('America/Mexico_City'));         
        $tmp = array();
        foreach ($this->post as $key=>$val) {
            if(stristr($key,'envio_')){
                $tmp[$key]=$val;
                unset($this->post[$key]);
            }
        }
        $data=array(
            'receptor_id'=>'',
            'contacto'=>$tmp['envio_contacto'],
            'calle'=>$tmp['envio_calle'],
            'no_exterior'=>$tmp['envio_noexterior'],
            'no_interior'=>$tmp['envio_nointerior'],
            'codigo_postal'=>$tmp['envio_codigopostal'],
            'colonia'=>$tmp['envio_colonia'],
            'estado'=>$tmp['envio_estado'],
            'municipio'=>$tmp['envio_municipio'],
            'cruce_calles'=>$tmp['envio_crucecalles'],
            'telefono'=>$tmp['envio_telefono'],
            'last_update'=>$date->getTimestamp(),
            'estatus'=>1
        );
        $this->setEnvio($data);        
        return $this->envio;
    }
    /**
     * 
     * @return type
     */
    public function getReceptor() {
        $date = new \DateTime('now',
                new \DateTimeZone('America/Mexico_City'));         
        $tmp = array();
        foreach ($this->post as $key=>$val) {
            if(stristr($key,'receptor_')){
                $tmp[$key]=$val;
                unset($this->post[$key]);
            }
        }  
        $data=array(
            'cscore_user_id'=>'',
            'rfc'=>$tmp['receptor_rfc'],
            'nombre'=>$tmp['receptor_nombre'],
            'calle'=>$tmp['receptor_calle'],
            'no_exterior'=>$tmp['receptor_noexterior'],
            'no_interior'=>$tmp['receptor_nointerior'],
            'codigo_postal'=>$tmp['receptor_codigopostal'],
            'colonia'=>$tmp['receptor_colonia'],
            'estado'=>$tmp['receptor_estado'],
            'municipio'=>$tmp['receptor_municipio'],
            'pais'=>$tmp['receptor_pais'],
            'last_update'=>$date->getTimestamp(),
            'estatus'=>1
        );
        $this->setReceptor($data);
        return $this->receptor;
    }
    /**
     * 
     * @param type $receptor
     */
    public function setReceptor($receptor) {
           $this->receptor = $receptor;
    }
    /**
     * 
     * @return type
     */
    public function getUser() {
        $tmp = array();
        foreach ($this->post as $key => $value) {
            if($key!=='submit'){
                $tmp[$key]=$value;
            }
        }
        
        $user = array();
        $user['username'] = $tmp['username'];
        $user['email'] = $tmp['email'];
        $user['display_name'] = $tmp['display_name'];
        $user['password'] = $tmp['password'];
        $user['state'] = 1;
        $user['gid'] = 1;
        
        $this->setUser($user);
        return $this->user;
    }
    /**
     * 
     * @param type $user
     */
    public function setUser($user) {
        $this->user = $user;
    }


}
