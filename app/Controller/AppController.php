<?php

App::uses('Controller', 'Controller');

class AppController extends Controller
{

  public $components = array('CaseRecordSystem', 'Session', 'Flash');

  // Check User logged
  public function beforeFilter()
  {
    // Check If Error Page
    if ($this->name == 'CakeError') return;

  }

  // Make paginator settings
  public function PaginatorSettings($settings)
  {
    if (!in_array('Paginator', array_keys($this->components))) return;

    // Merge the system
    if (!empty($this->request->data) && is_array($this->request->data))
    {
      $availableOptionFields = array('order', 'page', 'limit', 'merge' => 'conditions');
      foreach ($availableOptionFields as $key => $value) {
        if (!isset($this->request->data[$value])) continue;
        if (!isset($settings[$value])) $settings[$value] = null;
        if ($key === "merge")
          $settings[$value] = Set::merge($settings[$value], $this->request->data[$value]);
        else
          $settings[$value] = $this->request->data[$value];
      }
    }
    
    $this->Paginator->settings = $settings;
  }
}
