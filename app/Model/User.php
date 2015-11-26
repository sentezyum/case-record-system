<?php

App::uses('Security', 'Utility');
App::uses('AppModel', 'Model');

class User extends AppModel
{

  // HasOne Customer
  public $belongsTo = array('Customer');

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
        'message' => 'Mail adresi boş bırakılamaz'
      ),
      'email' => array(
        'rule' => 'email',
        'require' => true,
        'message' => 'Geçerli mail adresi giriniz'
      ),
      'isUnique' => array(
        'rule' => 'isUnique',
        'require' => true,
        'message' => 'Bu mail adresi ile kayıtlı kullanıcı var'
      )
    ),
    'password' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'require' => true,
        'message' => 'Şifre boş bırakılamaz'
      ),
      'minLength' => array(
        'rule' => array('minLength', 6),
        'require' => true,
        'message' => 'Şifre en az 6 karakter olmalı'
      ),
      'maxLength' => array(
        'rule' => array('maxLength', 15),
        'require' => true,
        'message' => 'Şifre en çok 15 karakter olmalı'
      )
    )
  );

  public function beforeValidate($options = array())
  {
    if (isset($this->data[$this->name]['is_admin']) && $this->data[$this->name]['is_admin'] == false)
    {
      $this->validate['customer_name'] = $this->validate['customer_id'] = array(
        'notBlank' => array(
          'rule' => 'notBlank',
          'require' => true,
          'message' => 'Kuruluş boş olamaz'
        )
      );
    }
    elseif (isset($this->data[$this->name]['is_admin']) && $this->data[$this->name]['is_admin'] == true)
    {
      $this->data[$this->name]['customer_id'] = null;
      unset($this->data[$this->name]['customer_name']);
    }
    return true;
  }

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
      return $this->save(array('User' => array('id' => Hash::get($user, 'User.id'), 'password' => $newPassword)));
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

  public function beforeSave($options = array())
  {
    if (isset($this->data[$this->name]['password']) && !empty($this->data[$this->name]['password']))
    {
      $this->data[$this->name]['password'] = Security::hash($this->data[$this->name]['password'], 'md5');
    }
    return true;
  }

  public function afterFind($results, $primary = false)
  {
    if (isset($results[0]))
    {
      foreach ($results as $key => $user)
      {
        if (isset($user['User']['password'])) unset($results[$key]['User']['password']);
        if (isset($user['Customer']['name'])) $results[$key]['User']['customer_name'] = $user['Customer']['name'];
      }
    }
    return $results;
  }

}
