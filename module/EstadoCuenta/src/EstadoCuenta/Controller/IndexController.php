<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 */

namespace EstadoCuenta\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{        
    public function micuentaAction(){
        $user = $this->getServiceLocator()->get('core_service_cmf_user')->getUser()->getBasicInfo();
        
        $creadits_history_table = $this->getServiceLocator()->get('Cscore\Model\CreditshistoryTable');
        
        // obtener el historial de creditos
        $creditos = $creadits_history_table->findByIdCredits($user['id']);
        $credits = 0;
        $payments = 0;
        foreach($creditos as $value){
           $credits += $value['credits'];
           $payments += $value['payments'];
        };
        
        // obtener los creditos actuales
        $credits_actuales = $this->getServiceLocator()->get('Cscore\Model\CreditsTable')->findId($user['id']);
        
        
        // obtener informacion del receptor
        $param = array(
            'where'=>array('cscore_user_id'=>$user['id']),
            'order'=>'id ASC'
        );
        $receptor = $this->getServiceLocator()->get('Cshelperzfcuser\Model\ReceptorTable')->fetchOneById($param);
        
        return new ViewModel(
                array(
                    'credits'=>$credits,
                    'payments'=>$payments,
                    'actuales'=>$credits_actuales['credit'],
                    'user'=>$user,
                    'receptor'=>$receptor
                )
        );
    }
    
    public function pedidosAction(){
        $user = $this->getServiceLocator()->get('core_service_cmf_user')->getUser()->getBasicInfo();
        
        $param = array(
            'where'=>array('user_id'=>$user['id']),
            'order'=>'id ASC'
        );
        
        $order_check = $this->getServiceLocator()->get('EstadoCuenta\Model\Ordercheck')->findAllById($param);
        
        $pedidos = array();
        // obtener el nombre del producto del pedido
        $order_item_table = $this->getServiceLocator()->get('Cscore\Model\OrderitemTable');
        
        $i = 0;
        foreach($order_check as $order){
            $order_item = $order_item_table->findAllById($order['id']);
            if(count($order_item) > 0){
                foreach($order_item as $item){
                    //obtener info del producto
                    $producto = $this->getServiceLocator()
                            ->get('Cscore\Model\ProductTable')->findId($item['product_id']);

                    $pedidos[$i]['id'] = $order['id'];
                    $pedidos[$i]['user_id'] = $order['user_id'];
                    $pedidos[$i]['total'] = $order['total'];
                    $pedidos[$i]['order_date'] = $order['order_date'];
                    $pedidos[$i]['order_status'] = $order['order_status'];
                    $pedidos[$i]['articulo'] = $producto;
                    $pedidos[$i]['cantidad'] = $item['quantity'];
                    $i++;
                }
            }
        }
        
        // paginador
        $paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($pedidos));
        $paginator->setCurrentPageNumber($this->params()->fromRoute('page'));
        $paginator->setItemCountPerPage(10);
        
        return new ViewModel(array('pedidos'=>$pedidos, 'paginator'=>$paginator));
    }
    
    public function ticketsAction(){
        $user = $this->getServiceLocator()->get('core_service_cmf_user')->getUser()->getBasicInfo();
        // obtener el receptor
        $param = array(
            'where'=>array('cscore_user_id'=>$user['id']),
            'order'=>'id ASC'
        );
        $receptor = $this->getServiceLocator()->get('Tickets\Model\ReceptorTable')->fetchOneById($param);
        
        // obtener los tickes del receptor
        $param = array(
            'where'=>array('receptor_id'=>$receptor['id']),
            'order'=>'id ASC'
        );
        $tickes_soriana = $this->getServiceLocator()->get('Tickets\Model\SorianaTable')->findAllById($param);
        $tickes_walmart = $this->getServiceLocator()->get('Tickets\Model\WalmartTable')->findAllById($param);
        
        $tickets = array();
        foreach($tickes_soriana as $ticket){
            $ticket['tienda'] = 'Soriana';
            $ticket['tr'] = '';
            $tickets[] = $ticket;
        }
        
        foreach($tickes_walmart as $ticket){
            $ticket['tienda'] = 'Walmart';
            $ticket['ticket'] = $ticket['tc'];
            $tickets[] = $ticket;
        }

        // paginador
        $paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($tickets));
        $paginator->setCurrentPageNumber($this->params()->fromRoute('page'));
        $paginator->setItemCountPerPage(10);
        
        return new ViewModel(array('tickets_soriana'=>$tickes_soriana, 'tickets_walmart'=>$tickes_walmart, 'paginator'=>$paginator));
    }

}
