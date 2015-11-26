<?php

App::uses('File', 'Utility');
App::uses('Hash', 'Utility');

class FileDatabase
{

  // Db File
  private $file = null;

  // Initialize
  public function __construct($dbFile)
  {
    try
    {
      $this->file = new File($dbFile, true, 0775);
    }
    catch (Exception $e)
    {
      throw new CakeException($e->getMessage());
    }
  }
  // Terminate
  public function __destruct()
  {
    if (!is_null($this->file)) unset($this->file);
  }
  // Data cache
  private $data = null;
  // Get data array
  private function __readFile()
  {
    if (!is_null($this->data)) return $this->data;
    if (($data = $this->file->read()) === false) throw new CakeException('Error occured while reading access control file');
    $this->data = preg_split ('/$\R?^/m', $data);
    return $this->data;
  }
  // read
  public function read()
  {
    return $this->__readFile();
  }

}
