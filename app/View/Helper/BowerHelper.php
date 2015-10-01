<?php

App::uses('AppHelper', 'View/Helper');

class BowerHelper extends AppHelper
{
    public $helpers = array('Html');

    public function component($type, $location)
    {
      $webroot = $this->webroot;
      if (substr($webroot, -1) == "/") $webroot = substr($webroot, 0, strlen($webroot) - 1);
      $location = $webroot . $location;
      switch ($type)
      {
        case 'js':
          return '<script src="' . $location . '"></script>';
          break;
        case 'css':
          return '<link rel="stylesheet" type="text/css" href="' . $location . '">';
          break;
      }

    }
}
