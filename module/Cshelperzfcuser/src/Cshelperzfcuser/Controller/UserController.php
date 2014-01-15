<?php

namespace Cshelperzfcuser\Controller;

use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Crypt\Password\Bcrypt;
use Zend\View\Model\ViewModel;
use ZfcUser\Service\User as UserService;
use ZfcUser\Options\UserControllerOptionsInterface;
use Cshelperzfcuser\Form\Perfil;
use Cshelperzfcuser\Form\PerfilValidator;
use Cshelperzfcuser\Form\Registrar;
use Cshelperzfcuser\Form\RegistrarValidator;
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
        $form = new Registrar();        
        $message = null;
        $susses = null;
        if($request->isPost()){  
            $formValidator = new RegistrarValidator();
            $form->setInputFilter($formValidator->getInputFilter()); 
            $post = $request->getPost();
            $form->setData($post);
            if($form->isValid()){
                $UserTable = $this->getServiceLocator()
                        ->get('Cshelperzfcuser\Model\UserTable');
                $bcrypt = new Bcrypt();
                $zfcuser_module_options = $this->getServiceLocator()
                    ->get('zfcuser_module_options');
                $bcrypt->setCost($zfcuser_module_options->getPasswordCost()); 
                $password= $bcrypt->create($post->passwordnew);                
                $data = array(
                    'username'=>$post->username,
                    'email'=>$post->email,
                    'display_name'=>$post->displayname,
                    'password'=>$password,
                    'state'=>1,
                    'gid'=>1
                );

                $UserTable->insert($data);
                $susses = 'Se Guardo correctamente';
                $message = null;
            }else{
                $message = 'Los Datos no son los esperados';
            }
        } 
        
        return new ViewModel(
                    array(
                        'formRegistrar'=>$form,
                        'message'=>$message,
                        'susses'=>$susses
                        )
                    );
    }
    
    /**
     * Actualizar datos de usuario
     * @return \Zend\View\Model\ViewModel
     */
    public function miperfilAction(){  
        $request = $this->getRequest();
        $form = new Perfil();        
        $message = null;
        $susses = null;
        $user = $this->getServiceLocator()
                ->get('core_service_cmf_user')
                ->getUser()->getBasicInfo();

        $datauser = $this->getServiceLocator()
                ->get('cshelperzfcuser_service_datauser');
        $datauser->setForm($form); 
        $form = $datauser->getForm();
        if($request->isPost()){  
            $formValidator = new PerfilValidator();
            $form->setInputFilter($formValidator->getInputFilter()); 
            $post = $request->getPost();
            $form->setData($post);
            if($form->isValid()){
                if($datauser->verify($post->passwordactual)){
                    $datauser->saveUserTable($post);
                    $susses = 'Se Guardo correctamente';
                    $message = null;
                }else{
                    $message = 'Tiene que Ingresar una Contraseña correcta para '.
                            'Realizar Cambios';                   
                }
            }else{
                $message = 'Los Datos no son los esperados';
            }
        } 
        
        return new ViewModel(
                    array(
                        'formMiPerfil'=>$form,
                        'message'=>$message,
                        'susses'=>$susses
                        )
                    );
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

