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
}
