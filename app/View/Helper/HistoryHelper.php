<?php

App::uses('AppHelper', 'View/Helper');

class HistoryHelper extends AppHelper
{
    public $helpers = array('Html');

    // Get Back
    public function goBack($title, $options, $state = 0)
    {
      $history = CakeSession::read('History');
      $history = is_array($history) ? $history : array();
      $target = array_slice($history, $state - 1, 1);
      $target = count($target) > 0 ? $target[0] : $this->webroot;
      return $this->Html->link($title, $target, $options);
    }
}
