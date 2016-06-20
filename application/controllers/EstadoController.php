<?php

class EstadoController extends Blog_Controller_Action {

    public function indexAction() {
        $tab = new Application_Model_DbTable_Estado();
        $estados = $tab->fetchAll(null,'idEstado desc')->toArray();
        $this->view->estados = $estados;
    }

    public function createAction() {
        $frm = new Application_Form_Estado();
        
        if($this->getRequest()->isPost()){
            $params = $this->getAllParams();
            
            if($frm->isValid($params)){
                $params = $frm->getValues();
                
                $vo = new Application_Model_Vo_Estado();
                $vo->setSiglaEstado($params['sigla_estado']);
                $vo->setEstado($params['estado']);
                
                $model = new Application_Model_Estado();
                $model->salvar($vo);
                
                $flash = $this->_helper->FlashMessenger;
                $flash->addMessage('Registro salvo');
                
                $this->_helper->Redirector->gotoSimpleAndExit('index');
            }
        }
        
        $this->view->form = $frm;
    }

    public function deleteAction() {
        $idestado = (int) $this->getParam('idestado');
        $model = new Application_Model_Estado();
        $flash = $this->_helper->FlashMessenger;
        
        try {
            $model->apagar($idestado);
            $flash->addMessage('Estado apagado');
        } catch (Exception $exc) {
            $flash->addMessage($exc->getMessage());
        }
        
        $this->_helper->Redirector->gotoSimpleAndExit('index');
      }

    public function updateAction() {
        $idestado = (int) $this->getParam('idestado');
        $tab = new Application_Model_DbTable_Estado();
        $row = $tab->fetchRow('idestado = ' . $idestado);
        
        if($row === null){
            echo 'Estado inexistente';
            exit;
        }
        
        $frm = new Application_Form_Estado();
        
        if($this->getRequest()->isPost()){
            $params = $this->getAllParams();
            
            if($frm->isValid($params)){
                $params = $frm->getValues();
                
                $vo = new Application_Model_Vo_Estado();
                $vo->setSiglaEstado($params['sigla_estado']);
                $vo->setEstado($params['estado']);
                $vo->setIdestado($idestado);
                
                $model = new Application_Model_Estado();
                $model->atualizar($vo);
                
                $flash = $this->_helper->FlashMessenger;
                $flash->addMessage('Estado atualizado');
                
                $this->_helper->Redirector->gotoSimpleAndExit('index');
            }
        } else {
            $frm->populate(array(
               'estado' => $row->estado 
            ));
        }
        
        $this->view->form = $frm;
    }

}
