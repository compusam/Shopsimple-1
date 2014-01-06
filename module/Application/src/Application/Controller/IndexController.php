<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Form;

class IndexController extends AbstractActionController
{    

    public function indexAction(){
        return new ViewModel();
    }
    
    public function miperfilAction(){

        return new ViewModel();
    }
    
    public function mecanicaAction(){
        return new ViewModel();
    }
    
    public function promocionesAction(){
        return new ViewModel();
    }
    
    public function appsAction(){
        return new ViewModel();
    }
    
    public function ayudaAction(){
        return new ViewModel();
    }
    
    public function avisoAction(){
        return new ViewModel();
    }
}
