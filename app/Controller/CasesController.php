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
        'limit' => 25,
        'order' => array(
            'CaseRecord.name' => 'asc'
        )
      );

      if (!empty($this->request->data))
      {
        if (isset($this->request->data['order'])) $this->Paginator->settings['order'] = $this->request->data['order'];
        if (isset($this->request->data['page'])) $this->Paginator->settings['page'] = $this->request->data['page'];
        if (isset($this->request->data['limit'])) $this->Paginator->settings['limit'] = $this->request->data['limit'];
        if (isset($this->request->data['conditions'])) $this->Paginator->settings['conditions'] = array_merge($this->request->data['conditions'], $this->Paginator->settings['conditions']);
      }

      try {
          $cases = $this->Paginator->paginate('CaseRecord');
          echo json_encode(array('data' => $cases, 'header' => $this->request->params['paging']['CaseRecord']));
      } catch (NotFoundException $e) {
          echo json_encode(array('data' => array(), 'header' => $this->request->params['paging']['CaseRecord']));
      }

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
        $this->CaseRecordSystem->removeHistory(0);
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
