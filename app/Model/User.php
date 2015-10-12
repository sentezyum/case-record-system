<?php

App::uses('Security', 'Utility');
App::uses('AppModel', 'Model');

class User extends AppModel
{

  // Login Validate
  public $login_validate = array(
    'mail' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'require' => true,
        'message' => 'Boş bırakılamaz'
      ),
      'email' => array(
        'rule' => 'email',
        'require' => true,
        'message' => 'Geçerli mail adresi giriniz'
      ),
      'validateMail' => array(
        'rule' => 'validateMail',
        'message' => 'Mail Adresi Yanlış'
      )
    ),
    'password' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'require' => true,
        'message' => 'Boş bırakılamaz'
      ),
      'validatePassword' => array(
        'rule' => 'validatePassword',
        'message' => 'Şifre yanlış'
      )
    )
  );

  // Login Validate
  public $validate = array(
    'mail' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'require' => true,
        'message' => 'Boş bırakılamaz'
      )
    ),
    'password' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'require' => true,
        'message' => 'Boş bırakılamaz'
      )
    )
  );

  // Authorize from array
  public function authorize($auth)
  {
    $this->set($auth);
    $oldValidate = $this->validate;
    $this->validate = $this->login_validate;
    if (!$this->validates())
    {
      $this->validate = $oldValidate;
      return false;
    }
    $this->validate = $oldValidate;
    return $this->getUserFromAuth($auth);
  }

  public function getUserFromAuth($auth = array())
  {
    $mail = Hash::get($auth, 'User.mail');
    $password = Hash::get($auth, 'User.password');
    $options = array();
    $options['recursive'] = 0;
    $options['conditions'] = array('User.mail' => $mail, 'User.password' => Security::hash($password, 'md5'));
    return $this->find('first', $options);
  }

  public function changePassword($user, $newPassword)
  {
    $user['User']['password'] = $newPassword;
    $this->set($user);
    if ($this->validates())
      return $this->save(array('User' => array('id' => Hash::get($user, 'User.id'), 'password' => Security::hash($newPassword, 'md5'))));
    return false;
  }

  // Mail Auth Validation
  public function validateMail($data = array())
  {
    $mail = Hash::get($this->data, 'User.mail');
    $options = array();
    $options['recursive'] = 0;
    $options['conditions'] = array('User.mail' => $mail);
    return !empty($this->find('first', $options));
  }

  // Mail Pass Validation
  public function validatePassword($data = array())
  {
    $password = Hash::get($this->data, 'User.password');
    $mail = Hash::get($this->data, 'User.mail');
    $options = array();
    $options['recursive'] = 0;
    $options['conditions'] = array('User.mail' => $mail, 'User.password' => Security::hash($password, 'md5'));
    return !empty($this->find('first', $options));
  }

}
