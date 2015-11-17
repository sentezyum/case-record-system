<?php

App::uses('AppController', 'Controller');

class CasesController extends AppController
{
  // Uses Case
  public $uses = array('CaseRecord');

  public $components = array('Paginator', 'RequestHandler');

  public function index()
  {
    if ($this->request->isAjax())
    {
      $this->autoRender = false;
      $this->PaginatorSettings(array(
        'fields' => array('CaseRecord.id', 'CaseRecord.name', 'CaseRecord.defendant_name', 'CaseRecord.defendant_id', 'CaseRecord.claimant_name', 'CaseRecord.claimant_id', 'CaseRecord.is_active'),
        'limit' => 25,
        'order' => array(
          'CaseRecord.name' => 'asc'
        )
      ));

      try
      {
        echo json_encode(array('data' => $this->Paginator->paginate('CaseRecord'), 'header' => $this->request->params['paging']['CaseRecord']));
      }
      catch (NotFoundException $e)
      {
        echo json_encode(array('data' => array(), 'header' => $this->request->params['paging']['CaseRecord']));
      }
    }
  }

  // create new case
  public function add()
  {
    if (!empty($this->request->data))
    {
      if ($this->CaseRecord->save($this->request->data))
      {
        $this->CaseRecordSystem->removeHistory(0);
        $this->Flash->set('Dava oluşturuldu', array('params' => array('class' => 'success')));
        $this->redirect(array('action' => 'edit', $this->CaseRecord->id));
      }
      else
      {
        $this->Flash->set('Dava oluşturamadı<br/><small>Girdiğiniz bilgilieri kontrol edip tekrar deneyiniz</small>', array('params' => array('class' => 'error')));
      }
    }
  }

  // edit case
  public function edit($id)
  {
    if (!empty($this->request->data))
    {
      if ($this->CaseRecord->save($this->request->data))
        $this->Flash->set('Dava güncellendi', array('params' => array('class' => 'success')));
      else
        $this->Flash->set('Dava kaydedilemedi<br/><small>Girdiğiniz bilgilieri kontrol edip tekrar deneyiniz</small>', array('params' => array('class' => 'error')));
    }
    else
    {
      $this->request->data = $this->CaseRecord->findById($id);
    }
  }
}
