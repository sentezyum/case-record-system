<?php

App::uses('Component', 'Controller');
App::uses('Hash', 'Utility');

class CaseRecordSystemComponent extends Component
{
  // Load Core Components
  public $components = array('Session');

  // Holds Current Controller
  private $Controller = null;

  // Holds special pages
  private $pages = array(
    'user_login' => array('plugin' => null, 'controller' => 'users', 'action' => 'login'),
    'user_logout' => array('plugin' => null, 'controller' => 'users', 'action' => 'logout'),
    'main_page' => array('plugin' => null, 'controller' => 'main', 'action' => 'index')
  );

  // Check if user logged
  public function userLogged()
  {
    return !empty($this->getLoggedUser());
  }

  // Get logged user
  public function getLoggedUser()
  {
    return $this->Session->read('Logged');
  }

  // Set logged user
  public function setLoggedUser($user)
  {
    return $this->Session->write('Logged', $user);
  }

  // Delete logged user
  public function deleteLoggedUser($user)
  {
    return $this->Session->delete('Logged');
  }

  // Check user is admin
  public function userIsAdmin($user = array())
  {
    return Hash::get($user, 'User.is_admin') == true;
  }

  // Check logged user is admin
  public function loggedUserIsAdmin()
  {
    return $this->userIsAdmin($this->getLoggedUser());
  }

  // Is page
  private function isPage($params = array())
  {
    if (is_string($params) && isset($this->pages[$params])) $params = $this->pages[$params];
    return Router::url($this->Controller->request->params) == Router::url(array_merge($this->Controller->request->params, $params));
  }

  private function redirect($params = array())
  {
    if (is_string($params) && isset($this->pages[$params])) $params = $this->pages[$params];
    return $this->Controller->redirect($params);
  }

  // Before before_filter
  public function initialize(Controller $controller)
  {
    // Hold controller instance
    $this->Controller = $controller;

    // Check Controller If Error
    if ($this->Controller->name == 'CakeError') return;

    // Redirect login page if not loggin
    if (!$this->isPage('user_login') && !$this->isPage('user_logout') && !$this->userLogged()) $this->redirect('user_login');

  }

  // Before Render Page
  public function beforeRender(Controller $controller)
  {
    // Check Page is error
    if ($this->Controller->name == 'CakeError') return;

    // Set user
    $this->Controller->set('user', $this->getLoggedUser());
  }
}
