<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Cscurrencypoints\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController{
    
    public function indexAction(){
        $arrUSerinfo = $this->getBasicInfoService();
        $core_service_cmf_credits = $this->getServiceLocator()
                ->get('core_service_cmf_credits');
        $creditsHistory = $core_service_cmf_credits->getCredits()
                ->getCreditHistoryByIdUser($arrUSerinfo['id']);        
        $i=0;
        foreach ($creditsHistory as $value) {            
            $name = $core_service_cmf_credits->getCredits()
                    ->getCreditsperiodsNameById($value['id_period']);
            $creditsHistory[$i]['name_period'] = $name;
            ++$i;
        }
        return new ViewModel(array('credit_history'=>$creditsHistory));        
    }

    public function getBasicInfoService(){
        $core_service_cmf_user = $this->getServiceLocator()->get('core_service_cmf_user');
        $arrUSerinfo = $core_service_cmf_user->getUser()->getBasicInfo();
        return $arrUSerinfo;
    }    
}