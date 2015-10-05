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
}
