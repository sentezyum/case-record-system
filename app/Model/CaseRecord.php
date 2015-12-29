<?php

App::uses('AppModel', 'Model');

class CaseRecord extends AppModel
{

  // Has many file
  public $hasMany = array(
    'CaseRecordFile' => array(
      'class_name' => 'CaseRecordFile',
      'order' => 'colour_id DESC'
    )
  );

  //Validate
  public $validate = array(
    'name' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'message' => 'Boş bırakılamaz',
        'required' => true
      )
    ),
    'no' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'message' => 'Boş bırakılamaz.',
        'required' => true
      )
    ),
    'claimant_name' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'message' => 'Boş bırakılamaz.',
        'required' => true
      )
    ),
    'claimant_id' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'message' => 'Boş bırakılamaz.',
        'required' => true
      )
    ),
    'defendant_name' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'message' => 'Boş bırakılamaz.',
        'required' => true
      )
    ),
    'defendant_id' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'message' => 'Boş bırakılamaz.',
        'required' => true
      )
    )
  );

  public function beforeFind($query = array())
  {
    if (!empty(CakeSession::read('Logged.User.customer_id')))
    {
      $customerId = CakeSession::read('Logged.User.customer_id');
      if (!isset($query['conditions'])) $query['conditions'] = array();
      $query['conditions'] = array_merge($query['conditions'], array('OR' => array('CaseRecord.defendant_id' => $customerId, 'CaseRecord.claimant_id' => $customerId)));
    }
    return $query;
  }
}
