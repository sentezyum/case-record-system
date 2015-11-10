<?php

App::uses('AppModel', 'Model');

class Customer extends AppModel
{
  public $useTable = 'customers';

  // Has many CaseRecord
  public $hasMany = array(
    'DefendantCaseRecord' => array(
      'className' => 'CaseRecord',
      'foreignKey' => 'defendant_id'
    ),
    'ClaimantCaseRecord' => array(
      'className' => 'CaseRecord',
      'foreignKey' => 'claimant_id'
    )
  );

  //Validate
  public $validate = array(
    'name' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'message' => 'Boş bırakılamaz',
        'required' => true
      ),
      'unique' => array(
        'rule' => 'isUnique',
        'message' => 'Bu isimde kululuş var'
      )
    )
  );

  // After Save change all related data
  public function afterSave($created, $options = array())
  {
    // Get saved data
    $customerName = Hash::get($this->data, 'Customer.name');
    $customerId = Hash::get($this->data, 'Customer.id');

    // If change related data
    if ($customerName && $customerId)
    {
      $db = $this->getDataSource();
      $customerName = $db->value($customerName, 'string');

      $this->ClaimantCaseRecord->updateAll(
        array('ClaimantCaseRecord.claimant_name' => $customerName),
        array('ClaimantCaseRecord.claimant_id' => $customerId)
      );
      $this->DefendantCaseRecord->updateAll(
        array('DefendantCaseRecord.defendant_name' => $customerName),
        array('DefendantCaseRecord.defendant_id' => $customerId)
      );
    }
  }
}
