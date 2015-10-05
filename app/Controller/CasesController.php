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
      $this->Paginator->settings = array(
        'fields' => array('CaseRecord.id', 'CaseRecord.name', 'CaseRecord.defendant_name', 'CaseRecord.defendant_id', 'CaseRecord.claimant_name', 'CaseRecord.claimant_id', 'CaseRecord.is_active'),
        'limit' => 20,
        'order' => array(
            'CaseRecord.name' => 'asc'
        )
      );

      if (!empty($this->request->data))
      {
        if (isset($this->request->data['order'])) $this->Paginator->settings['order'] = $this->request->data['order'];
      }

      $cases = $this->Paginator->paginate('CaseRecord');
      echo json_encode(array('data' => $cases, 'header' => $this->request->params['paging']['CaseRecord']));
      return;
    }
  }

  // create new case
  public function add()
  {
    if (!empty($this->request->data))
    {
      if ($this->CaseRecord->save($this->request->data))
      {
        $this->Flash->set('Dava oluşturuldu', array('params' => array('class' => 'success')));
        $this->redirect(array('action' => 'edit', $this->CaseRecord->id));
      }
      else
      {
        $this->Flash->set('Dava oluşturamadı<br/><small>Girdiğiniz bilgilieri kontrol edip tekrar deneyiniz</small>', array('params' => array('class' => 'danger')));
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
        $this->Flash->set('Dava kaydedilemedi<br/><small>Girdiğiniz bilgilieri kontrol edip tekrar deneyiniz</small>', array('params' => array('class' => 'danger')));
    }
    else
    {
      $this->request->data = $this->CaseRecord->findById($id);
    }
  }
}
