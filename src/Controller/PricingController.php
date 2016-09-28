<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Pricing Controller
 *
 * @property \App\Model\Table\PricingTable $Pricing
 */
class PricingController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $pricing = $this->paginate($this->Pricing);

        $this->set(compact('pricing'));
        $this->set('_serialize', ['pricing']);
    }

    /**
     * View method
     *
     * @param string|null $id Pricing id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pricing = $this->Pricing->get($id, [
            'contain' => []
        ]);

        $this->set('pricing', $pricing);
        $this->set('_serialize', ['pricing']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pricing = $this->Pricing->newEntity();
        if ($this->request->is('post')) {
            $pricing = $this->Pricing->patchEntity($pricing, $this->request->data);
            if ($this->Pricing->save($pricing)) {
                $this->Flash->success(__('The pricing has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pricing could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('pricing'));
        $this->set('_serialize', ['pricing']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Pricing id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pricing = $this->Pricing->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pricing = $this->Pricing->patchEntity($pricing, $this->request->data);
            if ($this->Pricing->save($pricing)) {
                $this->Flash->success(__('The pricing has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The pricing could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('pricing'));
        $this->set('_serialize', ['pricing']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Pricing id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pricing = $this->Pricing->get($id);
        if ($this->Pricing->delete($pricing)) {
            $this->Flash->success(__('The pricing has been deleted.'));
        } else {
            $this->Flash->error(__('The pricing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
