<?php

App::uses('User', 'Model');

class FirstData
{

  private $superAdminUser = array(
    'mail' => 'bdogan85@gmail.com',
    'password' => '3a9e8a740b5d5c0d19625bff90a9f92e',
    'is_admin' => true,
    'is_system_admin' => true,
    'is_active' => true,
    'customer_id' => null
  );

  private $order = array(
    'user' => array(
      'create' => array('users')
    )
  );

  // Main Create function
  public function create($event)
  {
    $result = true;
    foreach ($this->order as $method => $prop)
    {
      foreach ($prop as $eventName => $targetTable)
      {
        if (isset($event[$eventName]) && in_array($event[$eventName], $targetTable))
        {
          if (!$this->{$method}($event)) $result = false;
        }
      }
    }
    return $result;
  }

  // USer create function
  private function user($event)
  {
    $user = ClassRegistry::init('User');
    if (empty($user->find('all', array('conditions' => array('User.mail' => $this->superAdminUser['mail'], 'User.password' => $this->superAdminUser['password']), 'recursive' => -1))))
    {
      $user->create();
      return $user->save(array('User' => $this->superAdminUser), array('validate' => false, 'callbacks' => false));
    }
    return true;
  }

}
