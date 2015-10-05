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
        'message' => 'Boş bırakılamaz'
      )
    ),
    'no' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'message' => 'Boş bırakılamaz.'
      ),
      'numeric' => array(
        'rule' => 'numeric',
        'message' => 'Yanlızca rakam giriniz.'
      )
    ),
    'claimant_name' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'message' => 'Boş bırakılamaz.'
      )
    ),
    'defendant_name' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'message' => 'Boş bırakılamaz.'
      )
    )
  );
}
