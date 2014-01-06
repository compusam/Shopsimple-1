<?php

namespace Cshelperzfcuser\Controller;

use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\Parameters;
use Zend\View\Model\ViewModel;
use ZfcUser\Service\User as UserService;
use ZfcUser\Options\UserControllerOptionsInterface;
use Cshelperzfcuser\Model\RegisterFilter;
use Cshelperzfcuser\Model\PerfilFilter;
use Zend\Crypt\Password\Bcrypt;
use Cshelperzfcuser\Form\Validate as Validate;
use Zend\Db\Sql\Where;

class UserController extends AbstractActionController
{
    const ROUTE_CHANGEPASSWD = 'cshelperzfcuser/changepassword';
    const ROUTE_LOGIN        = 'cshelperzfcuser/login';
    const ROUTE_REGISTER     = 'cshelperzfcuser/register';
    const ROUTE_CHANGEEMAIL  = 'cshelperzfcuser/changeemail';

    const CONTROLLER_NAME    = 'cshelperzfcuser';

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var Form
     */
    protected $loginForm;

    /**
     * @var Form
     */
    protected $registerForm;

    /**
     * @var Form
     */
    protected $changePasswordForm;

    /**
     * @var Form
     */
    protected $changeEmailForm;

    /**
     * @todo Make this dynamic / translation-friendly
     * @var string
     */
    protected $failedLoginMessage = 'Authentication failed. Please try again.';

    /**
     * @var UserControllerOptionsInterface
     */
    protected $options;

    /**
     * User page
     */
    public function indexAction()
    {
                
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute(static::ROUTE_LOGIN);
        }
        return new ViewModel();
    }

    /**
     * Login form
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $form    = $this->getLoginForm();

        if ($this->getOptions()->getUseRedirectParameterIfPresent() && $request->getQuery()->get('redirect')) {
            $redirect = $request->getQuery()->get('redirect');
        } else {
            $redirect = false;
        }
        if (!$request->isPost()) {
            return array(
                'loginForm' => $form,
                'redirect'  => $redirect,
                'enableRegistration' => $this->getOptions()->getEnableRegistration(),
            );
        }

        $form->setData($request->getPost());
        
        if (!$form->isValid()) {
            $this->flashMessenger()->setNamespace('zfcuser-login-form')->addMessage($this->failedLoginMessage);
            return $this->redirect()->toUrl($this->url()->fromRoute(static::ROUTE_LOGIN).($redirect ? '?redirect='.$redirect : ''));
        }

        // clear adapters
        $this->zfcUserAuthentication()->getAuthAdapter()->resetAdapters();
        $this->zfcUserAuthentication()->getAuthService()->clearIdentity();

        return $this->forward()->dispatch(static::CONTROLLER_NAME, array('action' => 'authenticate'));
    }

    /**
     * Logout and clear the identity
     */
    public function logoutAction()
    {
        $this->zfcUserAuthentication()->getAuthAdapter()->resetAdapters();
        $this->zfcUserAuthentication()->getAuthAdapter()->logoutAdapters();
        $this->zfcUserAuthentication()->getAuthService()->clearIdentity();

        $redirect = $this->params()->fromPost('redirect', $this->params()->fromQuery('redirect', false));

        if ($this->getOptions()->getUseRedirectParameterIfPresent() && $redirect) {
            return $this->redirect()->toUrl($redirect);
        }

        return $this->redirect()->toRoute($this->getOptions()->getLogoutRedirectRoute());
    }

    /**
     * General-purpose authentication action
     */
    public function authenticateAction()
    {
        if ($this->zfcUserAuthentication()->getAuthService()->hasIdentity()) {
            return $this->redirect()->toRoute($this->getOptions()->getLoginRedirectRoute());
        }
        $adapter = $this->zfcUserAuthentication()->getAuthAdapter();
        $redirect = $this->params()->fromPost('redirect', $this->params()->fromQuery('redirect', false));

        $result = $adapter->prepareForAuthentication($this->getRequest());

        // Return early if an adapter returned a response
        if ($result instanceof Response){
            return $result;
        }

        $auth = $this->zfcUserAuthentication()->getAuthService()->authenticate($adapter);

        if (!$auth->isValid()) {
            $this->flashMessenger()->setNamespace('zfcuser-login-form')->addMessage($this->failedLoginMessage);
            $adapter->resetAdapters();
            return $this->redirect()->toUrl($this->url()->fromRoute(static::ROUTE_LOGIN)
                . ($redirect ? '?redirect='.$redirect : ''));
        }

        if ($this->getOptions()->getUseRedirectParameterIfPresent() && $redirect) {
            return $this->redirect()->toUrl($redirect);
        }

        return $this->redirect()->toRoute($this->getOptions()->getLoginRedirectRoute());
    }

    /**
     * Register new user
     */
    public function registerAction()
    {
        // if the user is logged in, we don't need to register
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            // redirect to the login redirect route
            return $this->redirect()->toRoute($this->getOptions()->getLoginRedirectRoute());
        }
        // if registration is disabled
        if (!$this->getOptions()->getEnableRegistration()) {
            return array('enableRegistration' => false);
        }
        
        $request = $this->getRequest();
        $service = $this->getUserService();
        
        $form = $this->getRegisterForm();
        $form  = $this->getServiceLocator()->get('Cshelperzfcuser\Service\CreateExtraFields')->addExtraFields($form);
        

        // obtener la lista de estados
        $estados_table = $this->getServiceLocator()->get('Cshelperzfcuser\Model\EstadosTable');
        $estados = $estados_table->fetchAll();
        
        // llenar el select de estados
        $es = array();
        $es[''] = '---Selecciona---';
        foreach($estados as $estado){
            $es[$estado['id']] = $estado['nombre'];
        }
        $form->get('receptor_estado')->setValueOptions($es);
        $form->get('envio_estado')->setValueOptions($es);
        
        if ($this->getOptions()->getUseRedirectParameterIfPresent() && $request->getQuery()->get('redirect')) {
            $redirect = $request->getQuery()->get('redirect');
        } else {
            $redirect = false;
        }

        $redirectUrl = $this->url()->fromRoute(static::ROUTE_REGISTER)
            . ($redirect ? '?redirect=' . $redirect : '');
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg === false) {
            return array(
                'registerForm' => $form,
                'enableRegistration' => $this->getOptions()->getEnableRegistration(),
                'redirect' => $redirect,
            );
        }

        $post = $prg;
        
        $is_valid = $this->getServiceLocator()->get('Cshelperzfcuser\Form\RegisterValidator')->validateForm($post);
        if(!$is_valid){
            return array(
                'registerForm' => $form,
                'enableRegistration' => $this->getOptions()->getEnableRegistration(),
                'redirect' => $redirect,
            );
        }
        //para recibir los 3 formularios
        $regpost =  new RegisterFilter($post);
        $envio= $regpost->getEnvio();
        $receptor = $regpost->getReceptor();
        $post = $regpost->getUser();
        
        // encriptar password
        $bcrypt = new Bcrypt();
        $securePass = $bcrypt->create($post['password']);
        $post['password'] = $securePass;
        
        $user = $this->getServiceLocator()->get('Cshelperzfcuser\Model\UserTable')->insertRow($post);
        //$user = $service->register($post);
        
        if (!$user) {
            return array(
                'registerForm' => $form,
                'enableRegistration' => $this->getOptions()->getEnableRegistration(),
                'redirect' => $redirect,
            );
        }
        
        $UserTable = $this->getServiceLocator()
                ->get('Cshelperzfcuser\Model\UserTable');
        $ReceptorTable = $this->getServiceLocator()
                ->get('Cshelperzfcuser\Model\ReceptorTable');
        $ReceptorenvioTable = $this->getServiceLocator()
                ->get('Cshelperzfcuser\Model\ReceptorenvioTable');
        
        $user = $UserTable->fetchOneById(array(
            'where'=>array('username'=>$post['username']),
            'order'=>'id ASC'
        ));
        
        $receptor['cscore_user_id']=$user['id'];
        $ReceptorTable->insert($receptor);
        $envio['receptor_id']=$ReceptorTable->lastInsertValue;
        $ReceptorenvioTable->insert($envio);
        
        
        $redirect = isset($prg['redirect']) ? $prg['redirect'] : null;

      
        if ($service->getOptions()->getLoginAfterRegistration()){
            $identityFields = $service->getOptions()->getAuthIdentityFields();
            if (in_array('email', $identityFields)) {
                $post['identity'] = $user->getEmail();
            } elseif (in_array('username', $identityFields)) {
                $post['identity'] = $post['username'];
            }
            $post['credential'] = $post['password'];
            $request->setPost(new Parameters($post));
            return $this->forward()->dispatch(static::CONTROLLER_NAME, array('action' => 'authenticate'));
        }

        // TODO: Add the redirect parameter here...
        return $this->redirect()->toRoute('cshelperzfcuser/activate');
    }
    
    /**
     * Actualizar datos de usuario
     * @return \Zend\View\Model\ViewModel
     */
    public function miperfilAction(){  
        $form = $this->getServiceLocator()->get('Cshelperzfcuser\Form\BasicUserInfo');
        $form = $this->getServiceLocator()->get('Cshelperzfcuser\Service\CreateExtraFields')->addExtraFields($form);
        
        // obtener la lista de estados
        $estados_table = $this->getServiceLocator()->get('Cshelperzfcuser\Model\EstadosTable');
        $estados = $estados_table->fetchAll();
        
        // llenar el select de estados
        $es = array();
        foreach($estados as $estado){
            $es[$estado['id']] = $estado['nombre'];
        }
        $form->get('receptor_estado')->setValueOptions($es);
        $form->get('envio_estado')->setValueOptions($es);
        
        // obtener info del usuario logeado
        $user = $this->getServiceLocator()->get('core_service_cmf_user')->getUser()->getBasicInfo();
        
        // obtener los valores para poner en el formulario
        $form_data = array();
        $form_data = $this->getServiceLocator()->get('Cshelperzfcuser\Service\GetFormData')->setData($form_data, $user['id']);
        
        $request = $this->getRequest();
        if($request->isPost()){
            $post = $this->params()->fromPost();
            // verificar si el password coincide con el password ingresado
            $bcrypt = new Bcrypt();
            $password_input = $post['password_actual'];
            if(!$bcrypt->verify($password_input, $form_data['user']['password'])){
                // mander mensaje de error 
                return new ViewModel(array('form'=>$form, 'form_data'=>$form_data));
            }else{
                $is_valid = $this->getServiceLocator()->get('Cshelperzfcuser\Form\PerfilValidator')->validateForm($post);
                if(!$is_valid){
                    //para recibir los 3 formularios
                    $regpost =  new PerfilFilter($post);
                    $envio= $regpost->getEnvio();
                    $receptor = $regpost->getReceptor();
                    $usuario = $regpost->getUser();
                   
                    // actualizar tabla user
                    $this->getServiceLocator()->get('Cshelperzfcuser\Model\UserTable')
                                        ->updateUser($usuario, $user['id']);
                    
                    // actualizar tabla receptor
                    $receptor_table = $this->getServiceLocator()->get('Cshelperzfcuser\Model\ReceptorTable');
                    if(!$receptor_table->updateReceptor($receptor, $user['id'])){
                        $re = $receptor_table->fetchOneById(array(
                            'where'=>array('cscore_user_id'=>$user['id']),
                            'order'=>'id ASC'
                        ));
                        if(empty($re)){
                            // si no se encuentra el registro, insertarlo
                            $receptor_table->insertRow($receptor, $user['id']);
                        }   
                    }
                   
                    $receptor_data =$receptor_table->fetchOneById(array('where'=>array('cscore_user_id'=>$user['id']),'order'=>'id ASC'));
                    
                    // actualizar table receptor_evio
                    $receptor_envio_table = $this->getServiceLocator()->get('Cshelperzfcuser\Model\ReceptorenvioTable');
                    if(!$receptor_envio_table->updateReceptorenvio($envio, $receptor_data['id'])){
                        // si no se pudo actualizar verificar que exista el registro, si no, insertarlo
                        $re = $receptor_envio_table->fetchOneById(array(
                            'where'=>array('receptor_id'=>$receptor_data['id']),
                            'order'=>'id ASC'
                        ));
                        if(empty($re)){
                            // si no se encuentra el registro, insertarlo
                            $receptor_envio_table->insertRow($envio, $receptor_data['id']);
                        }
                    }
                    
                    
                    // verificar si se requiere actualizar el password 
                    if($post['password_new'] != '' && $post['password_new_verify'] == $post['password_new']){
                        $bcrypt = new Bcrypt();
                        $securePass = $bcrypt->create($post['password_new']);
                        $this->getServiceLocator()->get('Cshelperzfcuser\Model\UserTable')
                                        ->updateUser(array('password'=>$securePass), $user['id']);
                    }
                    // obtener los valores para poner en el formulario
                    $form_data = $this->getServiceLocator()->get('Cshelperzfcuser\Service\GetFormData')->setData($form_data, $user['id']);
                    
                    return new ViewModel(array('form'=>$form, 'form_data'=>$form_data));
                }
            }       
        }
               
        return new ViewModel(array('form'=>$form, 'form_data'=>$form_data));
    }
    
    
    public function getpoblacionesAction(){
        $estado = $this->params()->fromRoute('estado');
        $poblacion_table = $this->getServiceLocator()->get('Cshelperzfcuser\Model\PoblacionTable');
        $poblaciones = $poblacion_table->findAllById(array(
            'where'=>array('estado_id'=>$estado),
            'order'=>'id ASC'
        ));
       
        $response = new \Zend\Http\Response();
        
        $poblaciones_json = \Zend\Json\Json::encode($poblaciones, \Zend\Json\Json::TYPE_OBJECT);
        
        $response->setContent($poblaciones_json);
        $response->getHeaders()->addHeaders(array(
            'Content-Type' => 'application/json',
        ));
        return $response;
    }
    
    public function verifypasswordAction(){
        $user = $this->getServiceLocator()->get('core_service_cmf_user')->getUser()->getBasicInfo();
        $user_table = $this->getServiceLocator()->get('Cshelperzfcuser\Model\UserTable')
                    ->fetchOneById(array(
                        'where'=>array('id'=>$user['id']),
                        'order'=>'id ASC'
                    ));
        $post = $this->params()->fromPost();
        // verificar si el password coincide con el password ingresado
        $bcrypt = new Bcrypt();
        $password_actual = $post['password_actual'];
        
        $response = new \Zend\Http\Response();
        if(!$bcrypt->verify($password_actual, $user_table['password'])){
            $response->setContent(false);
        }else{
            $response->setContent(true);
        }
        
        return $response;
    }
    
    
    /**
     * Change the users password
     */
    public function changepasswordAction()
    {
        // if the user isn't logged in, we can't change password
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            // redirect to the login redirect route
            return $this->redirect()->toRoute($this->getOptions()->getLoginRedirectRoute());
        }

        $form = $this->getChangePasswordForm();
        $prg = $this->prg(static::ROUTE_CHANGEPASSWD);

        $fm = $this->flashMessenger()->setNamespace('change-password')->getMessages();
        if (isset($fm[0])) {
            $status = $fm[0];
        } else {
            $status = null;
        }

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg === false) {
            return array(
                'status' => $status,
                'changePasswordForm' => $form,
            );
        }

        $form->setData($prg);

        if (!$form->isValid()) {
            return array(
                'status' => false,
                'changePasswordForm' => $form,
            );
        }

        if (!$this->getUserService()->changePassword($form->getData())) {
            return array(
                'status' => false,
                'changePasswordForm' => $form,
            );
        }

        $this->flashMessenger()->setNamespace('change-password')->addMessage(true);
        return $this->redirect()->toRoute(static::ROUTE_CHANGEPASSWD);
    }

    public function changeEmailAction()
    {
        // if the user isn't logged in, we can't change email
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            // redirect to the login redirect route
            return $this->redirect()->toRoute($this->getOptions()->getLoginRedirectRoute());
        }

        $form = $this->getChangeEmailForm();
        $request = $this->getRequest();
        $request->getPost()->set('identity', $this->getUserService()->getAuthService()->getIdentity()->getEmail());

        $fm = $this->flashMessenger()->setNamespace('change-email')->getMessages();
        if (isset($fm[0])) {
            $status = $fm[0];
        } else {
            $status = null;
        }

        $prg = $this->prg(static::ROUTE_CHANGEEMAIL);
        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg === false) {
            return array(
                'status' => $status,
                'changeEmailForm' => $form,
            );
        }

        $form->setData($prg);

        if (!$form->isValid()) {
            return array(
                'status' => false,
                'changeEmailForm' => $form,
            );
        }

        $change = $this->getUserService()->changeEmail($prg);

        if (!$change) {
            $this->flashMessenger()->setNamespace('change-email')->addMessage(false);
            return array(
                'status' => false,
                'changeEmailForm' => $form,
            );
        }

        $this->flashMessenger()->setNamespace('change-email')->addMessage(true);
        return $this->redirect()->toRoute(static::ROUTE_CHANGEEMAIL);
    }
    
    public function denyAction(){
        $basePath = $this->getRequest()->getBasePath();
        echo '<h1>Access Denied</h1><br/><a href="'.$basePath.'">Home</a>';
        return $this->response;
    }

    /**
     * Getters/setters for DI stuff
     */

    public function getUserService()
    {
        if (!$this->userService) {
            $this->userService = $this->getServiceLocator()->get('zfcuser_user_service');
        }
        return $this->userService;
    }

    public function setUserService(UserService $userService)
    {
        $this->userService = $userService;
        return $this;
    }

    public function getRegisterForm()
    {
        if (!$this->registerForm) {
            $this->setRegisterForm($this->getServiceLocator()->get('zfcuser_register_form'));
        }
        return $this->registerForm;
    }

    public function setRegisterForm(Form $registerForm)
    {
        $this->registerForm = $registerForm;
    }

    public function getLoginForm()
    {
        if (!$this->loginForm) {
            $this->setLoginForm($this->getServiceLocator()->get('zfcuser_login_form'));
        }
        return $this->loginForm;
    }

    public function setLoginForm(Form $loginForm)
    {
        $this->loginForm = $loginForm;
        $fm = $this->flashMessenger()->setNamespace('zfcuser-login-form')->getMessages();
        if (isset($fm[0])) {
            $this->loginForm->setMessages(
                array('identity' => array($fm[0]))
            );
        }
        return $this;
    }

    public function getChangePasswordForm()
    {
        if (!$this->changePasswordForm) {
            $this->setChangePasswordForm($this->getServiceLocator()->get('zfcuser_change_password_form'));
        }
        return $this->changePasswordForm;
    }

    public function setChangePasswordForm(Form $changePasswordForm)
    {
        $this->changePasswordForm = $changePasswordForm;
        return $this;
    }

    /**
     * set options
     *
     * @param UserControllerOptionsInterface $options
     * @return UserController
     */
    public function setOptions(UserControllerOptionsInterface $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * get options
     *
     * @return UserControllerOptionsInterface
     */
    public function getOptions()
    {
        if (!$this->options instanceof UserControllerOptionsInterface) {
            $this->setOptions($this->getServiceLocator()->get('zfcuser_module_options'));
        }
        return $this->options;
    }

    /**
     * Get changeEmailForm.
     *
     * @return changeEmailForm.
     */
    public function getChangeEmailForm()
    {
        if (!$this->changeEmailForm) {
            $this->setChangeEmailForm($this->getServiceLocator()->get('zfcuser_change_email_form'));
        }
        return $this->changeEmailForm;
    }

    /**
     * Set changeEmailForm.
     *
     * @param changeEmailForm the value to set.
     */
    public function setChangeEmailForm($changeEmailForm)
    {
        $this->changeEmailForm = $changeEmailForm;
        return $this;
    }

    /**
     * Activar Ususario
     * 
     * @return \Zend\Http\Response
     */
    public function activateAction(){
        $form = new Validate();
        $request = $this->getRequest();
        $error_message = '';
        $success = false;
        if($request->isPost()){
            $params = $request->getPost()->exchangeArray(array());
            $codigo = $params['codigo_activa'];
            try{
                 $ActivacionesTable = $this->getServiceLocator()
                    ->get('Cshelperzfcuser\Model\ActivacionesTable');
                $where = new  Where();
                $where->like('codigo', $codigo);
                //$where->like('status', 1);
                $param = array(
                    'where'=>$where,
                    'order'=>'id ASC'
                );                 
                $result = $ActivacionesTable->fetchOneById($param);    
            }catch(Exception $e){
                $result = 0;    
            }
            
            if(count($result)>0){
                try{
                    $UserTable = $this->getServiceLocator()
                        ->get('Cshelperzfcuser\Model\UserTable');
                    $ActivacionesTable->update(
                            array('estatus'=>2),array('id'=>$result['id'])
                            );
                    $UserTable->updateUser(
                            array('state'=>1),
                            $result['cscore_user_id']
                            );
                    $success = true;
                }catch(Exception $e){
                    $error_message = 'No se ha podido activar al usuario';
                }
            }else{
                $error_message = 'Código de activación no válido';
            }
        }
        return new ViewModel(array('form'=>$form, 'error_message'=>$error_message, 'success'=>$success));      
    }
}

