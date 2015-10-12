<?php

App::uses('AppModel', 'Model');

class Customer extends AppModel
{
  public $useTable = 'customers';

  //Validate
  public $validate = array(
    'name' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'message' => 'Boş bırakılamaz'
      ),
      'unique' => array(
        'rule' => 'isUnique',
        'message' => 'Bu isimde kululuş var'
      )
    )
  );
}
