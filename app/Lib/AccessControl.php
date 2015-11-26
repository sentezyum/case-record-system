<?php

App::uses('FileDatabase', 'Lib');

class AccessControl
{

  // Db
  private $db = null;

  private $_userGroups = array(
    'user' => array('User.is_admin' => false, 'User.is_system_admin' => false),
    'system_admin' => array('User.is_admin' => true, 'User.is_system_admin' => true),
    'admin' => array('User.is_admin' => true, 'User.is_system_admin' => false)
  );

  private $_defaultUserGroup = 'user';

  private $_userGroupNames = array(
    'user' => 'Kullanıcı',
    'system_admin' => 'Sistem Yöneticisi',
    'admin' => 'Yönetici'
  );

  public function userGroup($user)
  {
    $this->_defaultUserGroup;
    foreach ($this->_userGroups as $groupName => $filter)
    {
      if ($this->memberOf($user, $filter)) return $groupName;
    }
    return $this->_defaultUserGroup;
  }

  public function memberOf($user, $filter)
  {
    $isGroupMember = false;
    foreach ($filter as $key => $value)
    {
      if (!empty(Hash::get($user, $key)) && Hash::get($user, $key) == $value)
      {
        $isGroupMember = true;
        break;
      }
    }
    return $isGroupMember;
  }

  public function hasAccess($user, $scope, $action)
  {
    $hasAccess = false;
    if (empty($mail = Hash::get($user, 'User.mail')) || empty($userGroup = $this->userGroup($user))) return $hasAccess;
    $rawAcl = $this->db->read();
    $controlList = array("*.*", $scope . ".*", $scope . "." . $action);
    foreach ($rawAcl as $aclLine)
    {
      if (empty($aclLine) || preg_match('/^#/', $aclLine) || count($acl = preg_split("/\s+/", $aclLine)) < 4) continue;
      if ((($acl[1] == "USER" && ($acl[2] == "*" || $acl[2] == $mail)) || ($acl[1] == "GROUP" && ($acl[2] == "*" || $acl[2] == $userGroup))) && in_array($acl[3], $controlList))
      {
        if ($acl[0] == "ALLOW") return true;
        if ($acl[0] == "DENY") return false;
      }
    }
    return $hasAccess;
  }

  // Initialize
  public function __construct()
  {
    // Db
    $this->db = new FileDatabase(ROOT . DS . APP_DIR . DS . 'Lib' . DS . 'acl.dat');

  }

  // Terminate
  public function __destruct()
  {
    if (!is_null($this->db)) unset($this->db);
  }


}
