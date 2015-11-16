<?php

App::uses('AppController', 'Controller');

class CustomersController extends AppController
{

  // Uses Case
  public $uses = array('Customer');

  public $components = array('Paginator', 'RequestHandler');

  public function index()
  {
    if ($this->request->isAjax())
    {
      $this->autoRender = false;
      $this->Paginator->settings = array(
        'fields' => array('Customer.id', 'Customer.name'),
        'limit' => 25,
        'order' => array(
            'Customer.name' => 'asc'
        )
      );

      if (!empty($this->request->data))
      {
        if (isset($this->request->data['order'])) $this->Paginator->settings['order'] = $this->request->data['order'];
        if (isset($this->request->data['page'])) $this->Paginator->settings['page'] = $this->request->data['page'];
        if (isset($this->request->data['limit'])) $this->Paginator->settings['limit'] = $this->request->data['limit'];
        if (isset($this->request->data['conditions'])) $this->Paginator->settings['conditions'] = $this->request->data['conditions'];
      }

      try {
          $customers = $this->Paginator->paginate('Customer');
          echo json_encode(array('data' => $customers, 'header' => $this->request->params['paging']['Customer']));
      } catch (NotFoundException $e) {
          echo json_encode(array('data' => array(), 'header' => $this->request->params['paging']['Customer']));
      }

      return;
    }
  }

  // create new case
  public function add()
  {
    if (!empty($this->request->data))
    {
      if ($this->Customer->save($this->request->data))
      {
        if ($this->request->isAjax())
        {
          $this->autoRender = false;
          $this->Customer->recursive = 0;
          echo json_encode(array('success' => 'ok', 'data' => $this->Customer->findById($this->Customer->id)));
          return;
        }
        $this->Flash->set('Kuruluş oluşturuldu', array('params' => array('class' => 'success')));
        $this->redirect(array('action' => 'edit', $this->Customer->id));
      }
      else
      {
        if ($this->request->isAjax())
        {
          $this->autoRender = false;
          echo json_encode(array('success' => 'error', 'message' => Hash::get($this->Customer->validationErrors, 'name.0')));
          return;
        }
        $this->Flash->set('Kuruluş oluşturamadı<br/><small>Girdiğiniz bilgilieri kontrol edip tekrar deneyiniz</small>', array('params' => array('class' => 'danger')));
      }
    }
  }

  // get all customers
  public function all()
  {
    if ($this->request->isAjax())
    {
      $this->autoRender = false;
      $customers = $this->Customer->find('all', array('recursive' => -1));
      echo json_encode($customers);
      return;
    }
  }

  // edit case
  public function edit($id)
  {
    if (!empty($this->request->data))
    {
      if ($this->Customer->save($this->request->data))
        $this->Flash->set('Kuruluş güncellendi', array('params' => array('class' => 'success')));
      else
        $this->Flash->set('Kuruluş güncellenemedi<br/><small>Girdiğiniz bilgilieri kontrol edip tekrar deneyiniz</small>', array('params' => array('class' => 'danger')));
    }
    else
    {
      $this->Customer->recursive = 0;
      $this->request->data = $this->Customer->findById($id);
    }
  }

}
