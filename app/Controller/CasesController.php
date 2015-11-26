<?php

App::uses('AppController', 'Controller');
App::uses('File', 'Utility');

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

  // view case record
  public function view($id = null)
  {
    $id = !empty($id) ? $id : Hash::get($this->request->data, 'CaseRecord.id');
    if (empty($id)) throw new BadRequestException('CaseRecordId missing');
    if (empty($caseRecord = $this->CaseRecord->findById($id))) throw new NotFoundException("CaseRecord not found");

    if ($this->request->isAjax())
    {
      $this->autoRender = false;
      echo json_encode($caseRecord);
      return;
    }

    $this->set(compact('caseRecord'));
  }

  // delete file
  public function delete_file($id = null)
  {
    if (empty($id) || empty($file = $this->CaseRecord->CaseRecordFile->findById($id))) throw new NotFoundException('Not Found');

    if ($this->CaseRecord->CaseRecordFile->delete($id))
    {
      $this->Flash->set('Dosya silindi<br/>', array('params' => array('class' => 'success')));
    }
    else
    {
      $this->Flash->set('Dosya silinemedi<br/>', array('params' => array('class' => 'error')));
    }

    $this->redirect(array('action' => 'edit', Hash::get($file, 'CaseRecordFile.case_record_id')));
  }

  // delete file
  public function delete($id = null)
  {
    if (empty($id) || empty($file = $this->CaseRecord->findById($id))) throw new NotFoundException('Not Found');

    if ($this->CaseRecord->delete($id) && $this->CaseRecord->CaseRecordFile->deleteAll(array('CaseRecordFile.case_record_id' => $id), false))
    {
      $this->Flash->set('Dava silindi<br/>', array('params' => array('class' => 'success')));
      return $this->redirect(array('action' => 'index'));
    }
    else
    {
      $this->Flash->set('Dava silinemedi<br/>', array('params' => array('class' => 'error')));
    }

    $this->redirect(array('action' => 'edit', $id));
  }

  // edit case
  public function edit($id)
  {
    $this->set('caseRecordFiles', $this->CaseRecord->CaseRecordFile->find('all', array('conditions' => array('CaseRecordFile.case_record_id' => $id))));
    $this->CaseRecord->recursive = -1;

    if (!empty($this->request->data))
    {
      if (isset($this->request->data['CaseRecordFile']))
      {
        if ($this->CaseRecord->CaseRecordFile->save($this->request->data))
        {
          $this->Flash->set('Dosya eklendi', array('params' => array('class' => 'success')));
          $this->redirect(array('action' => 'edit', $id));
        }
        else
          $this->Flash->set('Dosya eklenemedi<br/><small>Girdiğiniz bilgilieri kontrol edip tekrar deneyiniz</small>', array('params' => array('class' => 'error')));

        $this->request->data += $this->CaseRecord->findById($id);
        return;
      }

      if ($this->CaseRecord->save($this->request->data))
      {
        $this->Flash->set('Dava güncellendi', array('params' => array('class' => 'success')));
        $this->redirect(array('action' => 'edit', $id));
      }
      else
        $this->Flash->set('Dava kaydedilemedi<br/><small>Girdiğiniz bilgilieri kontrol edip tekrar deneyiniz</small>', array('params' => array('class' => 'error')));
    }
    else
    {
      if (empty($this->request->data = $this->CaseRecord->findById($id))) throw new NotFoundException("CaseRecord not found");
    }
  }
}
