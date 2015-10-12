<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController
{
  // Uses User
  public $uses = array('User');

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
