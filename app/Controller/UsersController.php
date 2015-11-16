<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController
{
  // Uses User
  public $uses = array('User');

  public $components = array('Paginator', 'RequestHandler');

  // Users index
  public function index()
  {
    if ($this->request->isAjax())
    {
      $this->autoRender = false;
      $this->Paginator->settings = array(
        'fields' => array('User.created', 'User.customer_id', 'User.id', 'User.is_active', 'User.is_admin', 'User.is_system_admin', 'User.mail', 'Customer.id', 'Customer.name'),
        'limit' => 25,
        'conditions' => array(
          'User.is_system_admin !=' => true
        ),
        'order' => array(
            'User.mail' => 'asc'
        )
      );

      if (!empty($this->request->data))
      {
        if (isset($this->request->data['order'])) $this->Paginator->settings['order'] = $this->request->data['order'];
        if (isset($this->request->data['page'])) $this->Paginator->settings['page'] = $this->request->data['page'];
        if (isset($this->request->data['limit'])) $this->Paginator->settings['limit'] = $this->request->data['limit'];
        if (isset($this->request->data['conditions'])) $this->Paginator->settings['conditions'] = array_merge($this->request->data['conditions'], $this->Paginator->settings['conditions']);
      }

      try {
          $users = $this->Paginator->paginate('User');
          echo json_encode(array('data' => $users, 'header' => $this->request->params['paging']['User']));
      } catch (NotFoundException $e) {
          echo json_encode(array('data' => array(), 'header' => $this->request->params['paging']['User']));
      }

      return;
    }
  }

  // edit user
  public function edit($id)
  {
    if (!empty($this->request->data))
    {
      if ($this->User->save($this->request->data))
      {
        $this->Flash->set('Kullanıcı güncellendi', array('params' => array('class' => 'success')));
        $this->User->recursive = 0;
        $this->request->data = $this->User->findById($id);
      }
      else
        $this->Flash->set('Kullanıcı güncellenemedi<br/><small>Girdiğiniz bilgilieri kontrol edip tekrar deneyiniz</small>', array('params' => array('class' => 'danger')));
    }
    else
    {
      $this->User->recursive = 0;
      $this->request->data = $this->User->findById($id);
    }
  }

  // create new user
  public function add()
  {
    if (!empty($this->request->data))
    {
      if ($this->User->save($this->request->data))
      {
        if ($this->request->isAjax())
        {
          $this->autoRender = false;
          $this->User->recursive = 0;
          echo json_encode(array('success' => 'ok', 'data' => $this->User->findById($this->User->id)));
          return;
        }
        $this->Flash->set('Kullanıcı oluşturuldu', array('params' => array('class' => 'success')));
        $this->redirect(array('action' => 'edit', $this->User->id));
      }
      else
      {
        if ($this->request->isAjax())
        {
          $this->autoRender = false;
          echo json_encode(array('success' => 'error', 'message' => implode(", ", Hash::extract($this->User->validationErrors, '{s}.0'))));
          return;
        }
        $this->Flash->set('Kullanıcı oluşturamadı<br/><small>Girdiğiniz bilgilieri kontrol edip tekrar deneyiniz</small>', array('params' => array('class' => 'danger')));
      }
    }
    else
    {
      $this->request->data['User']['is_active'] = true;
    }
  }

  // Login Page
  public function login()
  {
    // Set layout as login page
    $this->layout = "login";

    // Check user
    if (!empty($this->request->data))
      if (($user = $this->User->authorize($this->request->data)) !== false)
      {
        $this->CaseRecordSystem->setLoggedUser($user);
        $this->redirect('/');
      }
  }

  // Logout Page
  public function logout()
  {
    $this->CaseRecordSystem->deleteLoggedUser();
    $this->redirect('/');
  }

  // Logout Page
  public function change_password()
  {
    // Check user
    if (!empty($this->request->data))
    {
      // Get Logged User
      $user = $this->CaseRecordSystem->getLoggedUser();
      $mail = Hash::get($user, 'User.mail');
      $oldPassword = Hash::get($this->request->data, 'User.password');
      $newPassword = Hash::get($this->request->data, 'User.password_new');
      if (($user = $this->User->authorize(array('User' => array('mail' => $mail, 'password' => $oldPassword)))) !== false)
      {
        if ($this->User->changePassword($user, $newPassword))
        {
          $this->Flash->set('Şifre başarıyla değiştirildi', array('params' => array('class' => 'success')));
          $this->redirect('/');
          return;
        }
      }
      $this->Flash->set('Şifre değiştirilemedi<br/><small>Girdiğiniz bilgilieri kontrol edip tekrar deneyiniz</small>', array('params' => array('class' => 'danger')));
    }
  }
}
