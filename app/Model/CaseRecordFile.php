<?php

App::uses('AppModel', 'Model');

class CaseRecordFile extends AppModel
{

  // Set Uploader Plugin
  public $actsAs = array(
		'Uploader.Attachment' => array(
			'file_name' => array(
				'uploadDir' => UPLOAD_DIR,
				'overwrite' => false,
				'finalPath' => 'upload/',
				'nameCallback' => 'formatFileName',
        'metaColumns' => array(
          'ext' => 'extension',
          'type' => 'mime_type',
          'size' => 'size'
        )
			)
		),
		'Uploader.FileValidation' => array(
			'file_name' => array(
        'extension' => array(
          'value' => array(),
          'message' => 'Yanlış dosya tipi',
        ),
        'filesize' => array(
          'value' => '10MB',
          'message' => 'Dosya çok büyük; maximum boyut %s'
        ),
        'required' => array(
          'value' => true,
          'on' => 'create',
          'message' => 'Dosya gerekli',
          'required' => true
        )
			)
		)
	);

  // Case record
  public $belongsTo = array('CaseRecord');

  // CaseRecordFile Validate
  public $validate = array(
    'name' => array(
      'notBlank' => array(
        'rule' => 'notBlank',
        'require' => true,
        'message' => 'Evrak adı boş bırakılamaz'
      )
    )
  );

  public function formatFileName($name, $file)
  {
    return sprintf('case-record-file-%s-%s', $this->data[$this->name]['case_record_id'], str_replace('.', '', microtime(true)));
  }

  public function __construct($id = false, $table = null, $ds = null)
  {
    $this->actsAs['Uploader.FileValidation']['file_name']['extension']['value'] = Configure::read('Rule.FileExtensions');
    $this->actsAs['Uploader.FileValidation']['file_name']['filesize']['value'] = Configure::read('Rule.MaxFileSize') * 1024 * 1024;
    $this->actsAs['Uploader.FileValidation']['file_name']['filesize']['message'] = 'Dosya çok büyük; maximum boyut ' . Configure::read('Rule.MaxFileSize') . 'MB';
    parent::__construct($id, $table, $ds);
  }
}
