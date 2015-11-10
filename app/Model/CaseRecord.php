<?php

App::uses('AppModel', 'Model');

class CaseRecord extends AppModel
{
  public $useTable = 'cases';

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
      ),
      'numeric' => array(
        'rule' => 'numeric',
        'message' => 'Yanlızca rakam giriniz.'
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
}
