<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 */

namespace Cscart\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Cscart\Form\Btncheckout;

class IndexController extends AbstractActionController
{    
    public function carritoAction(){
        $arrUSerinfo = $this->getBasicInfoService();
        $matches = $this->getEvent()->getRouteMatch();
        $idtask      = (int)$matches->getParam('idtask'); 
        $userid      = (int)$arrUSerinfo['id'];
        $productid      = (int)$this->getRequest()->getPost('product_id');
        $request = $this->getRequest();
        
        $formBtnCheckout = new Btncheckout();
        
        $core_service_cmf_cart= $this->getServiceLocator()
                ->get('core_service_cmf_cart');
        if ($request->isPost()&&$idtask===1){
            $core_service_cmf_cart->getCart()->deleteProduct($userid ,$productid);
        }
        elseif($request->isPost()&&$idtask===2){
            $quantity     = (int)$this->getRequest()->getPost('quantity');
            $price     = (int)$this->getRequest()->getPost('price');
            $quantity_total = $this->getServiceLocator()->get('Cscore\Model\CartTable')->findId(array('user_id='.$arrUSerinfo['id'].' AND product_id='.$productid));
            $params = array(
                'user_id'=>$userid,
                'product_id'=>$productid,
                'quantity'=>$quantity,
                'price'=>$price,
                'line_total'=>($price * (empty($quantity_total)? $quantity : $quantity_total['quantity'] + $quantity))
            );
            $core_service_cmf_cart->getCart()->addProduct($params);            
        }
        
        $allcart = array();

        if($userid){
            $allcart = $core_service_cmf_cart->getCart()->getAllCart($userid);

        }

        // obtener los creditos del ususario
        $credits = $this->getServiceLocator()->get('Cscore\Model\CreditsTable')->findId($arrUSerinfo['id']);

        return new ViewModel(
                array(
                    'allcart'=>$allcart, 
                    'credits'=>$credits,
                    'formBtnCheckout'=>$formBtnCheckout
                    )
                );
    }
    
   
    
    public function getBasicInfoService(){
        $core_service_cmf_user = $this->getServiceLocator()->get('core_service_cmf_user');
        $arrUSerinfo = $core_service_cmf_user->getUser()->getBasicInfo();
        return $arrUSerinfo;
    }
    

}
