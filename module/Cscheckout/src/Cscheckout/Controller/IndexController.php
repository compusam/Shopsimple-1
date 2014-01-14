<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 */

namespace Cscheckout\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Cscart\Form\Btncheckout;
class IndexController extends AbstractActionController
{    
    
    public function checkoutAction(){
        $request = $this->getRequest();
        $response = $this->getResponse();
        $date = new \DateTime('now', new \DateTimeZone('America/Mexico_City')); 
        $now = (int) $date->getTimestamp();
        
        //validando csrf
        $formBtnCheckout = new Btncheckout();
        $formBtnCheckout->setData($request->getPost());
        $viewModel  = new ViewModel();
        if(!$formBtnCheckout->isValid()){
            $response->setStatusCode(403); 
            $viewModel->setTemplate('cscheckout/index/403.phtml'); 
            return $viewModel;
        }
        //se maneja un try por que los fondos insuficientes genera una
        //excepcion
        try{
            //Llamando metodos de Cscore
            $core_service_cmf_credits = $this->getServiceLocator()
                    ->get('core_service_cmf_credits');
            $arrUSerinfo = $this->getBasicInfoService();
            $core_service_cmf_cart= $this->getServiceLocator()
                    ->get('core_service_cmf_cart');     
            $allCart = $core_service_cmf_cart->getCart()
                    ->getAllCart($arrUSerinfo['id']);
            $cscheckout_service = $this->getServiceLocator()
                    ->get('core_service_cmf_checkout');
            $wallet  = $core_service_cmf_credits->getCredits()
                    ->getCreditByIdUser($arrUSerinfo['id']);        
            $paramsOrder = $cscheckout_service->getCheckout()
                                        ->setOrder($allCart,$wallet['credit']);
            
            //Verifica si se genero la orden para pagarla
            if(((int)$paramsOrder['order'])>0){
                $core_service_cmf_credits->getCredits()->setCreditsPaid(
                        $arrUSerinfo['id'],((int)$paramsOrder['total']));
            }
            //setea valiables de vista
            $viewModel->setVariable('paramsOrder', array(
                'order'=>$paramsOrder['order'],
                'date'=>$paramsOrder['order_date'],
                'usename'=>$arrUSerinfo['displayName'],
                'allCart'=>$allCart
            ));
            $viewModel->setVariable('user', $arrUSerinfo);
            
        }  catch (\Exception $e){
               $arrUSerinfo = $this->getBasicInfoService();
               $viewModel->setVariable('paramsOrder', array(
                    'order'=>0,
                    'date'=>$now,
                    'usename'=>$e->getMessage(),
                    'allCart'=>array()
                ));
               $viewModel->setVariable('user', $arrUSerinfo);
        }
        return $viewModel;
    }
    
    public function getBasicInfoService(){
        $core_service_cmf_user = $this->getServiceLocator()
                ->get('core_service_cmf_user');
        $arrUSerinfo = $core_service_cmf_user->getUser()->getBasicInfo();
        return $arrUSerinfo;
    }
    

}
