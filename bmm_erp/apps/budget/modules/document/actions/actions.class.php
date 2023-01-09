<?php

/**
 * document actions.
 *
 * @package    Bmm
 * @subpackage document
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class documentActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->piecejoints = Doctrine_Core::getTable('piecejoint')
                ->createQuery('a')
                ->execute();
    }
   public function executeDeletePiecejoint(sfWebRequest $request) {
        $request->checkCSRFProtection();
        $this->forward404Unless($piecejoint = Doctrine_Core::getTable('piecejoint')->find(array($request->getParameter('id'))), sprintf('Object piecejoint does not exist (%s).', $request->getParameter('id')));
        $idtransfert=$piecejoint->getIdTransfert();
        $piecejoint->delete();

        $this->redirect('transfertbudget/edit?id='.$idtransfert);
    }
    public function executeShow(sfWebRequest $request) {
        $this->piecejoint = Doctrine_Core::getTable('piecejoint')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->piecejoint);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new piecejointForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new piecejointForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($piecejoint = Doctrine_Core::getTable('piecejoint')->find(array($request->getParameter('id'))), sprintf('Object piecejoint does not exist (%s).', $request->getParameter('id')));
        $this->form = new piecejointForm($piecejoint);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($piecejoint = Doctrine_Core::getTable('piecejoint')->find(array($request->getParameter('id'))), sprintf('Object piecejoint does not exist (%s).', $request->getParameter('id')));
        $this->form = new piecejointForm($piecejoint);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($piecejoint = Doctrine_Core::getTable('piecejoint')->find(array($request->getParameter('id'))), sprintf('Object piecejoint does not exist (%s).', $request->getParameter('id')));
        $idtitre=$piecejoint->getIdTitrebudget();
        $piecejoint->delete();

        $this->redirect('titrebudjet/edit?id='.$idtitre.'&idtab='.$request->getParameter('idtab'));
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $piecejoint = $form->save();
            $this->redirect('courrier/edit?id=' . $piecejoint->getIdCourrier() . '&idtype=' . $piecejoint->getCourrier()->getIdType() . '&panel=2');
        }
    }

}
