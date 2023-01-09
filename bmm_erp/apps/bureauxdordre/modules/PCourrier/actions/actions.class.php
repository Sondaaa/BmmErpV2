<?php

/**
 * PCourrier actions.
 *
 * @package    Bmm
 * @subpackage PCourrier
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PCourrierActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->parcourcouriers = Doctrine_Core::getTable('parcourcourier')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->parcourcourier = Doctrine_Core::getTable('parcourcourier')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->parcourcourier);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new parcourcourierForm();
    }

    public function executeCreate(sfWebRequest $request) {
       

        $this->form = new parcourcourierForm();
      
        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($parcourcourier = Doctrine_Core::getTable('parcourcourier')->find(array($request->getParameter('id'))), sprintf('Object parcourcourier does not exist (%s).', $request->getParameter('id')));
        $this->form = new parcourcourierForm($parcourcourier);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($parcourcourier = Doctrine_Core::getTable('parcourcourier')->find(array($request->getParameter('id'))), sprintf('Object parcourcourier does not exist (%s).', $request->getParameter('id')));
        $this->form = new parcourcourierForm($parcourcourier);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($parcourcourier = Doctrine_Core::getTable('parcourcourier')->find(array($request->getParameter('id'))), sprintf('Object parcourcourier does not exist (%s).', $request->getParameter('id')));
        $parcourcourier->delete();

        $this->redirect('PCourrier/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        //die('bien');
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
             
            $parcourcourier = $form->save();
            $parcourcourier->setIdUser( $this->getUser()->getAttribute('userB2m')->getId());
            $parcourcourier->save();
        
            $this->redirect('courrier/edit?id=' . $parcourcourier->getIdCourier() . '&idtype=' . $parcourcourier->getCourrier()->getIdType() . '&panel=1');
        }
    }

}
