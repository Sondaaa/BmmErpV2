<?php

require_once dirname(__FILE__) . '/../lib/ligavisdocGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/ligavisdocGeneratorHelper.class.php';

/**
 * ligavisdoc actions.
 *
 * @package    Bmm
 * @subpackage ligavisdoc
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ligavisdocActions extends autoLigavisdocActions {

    public function executeBciRubrique(sfWebRequest $request) {
        
    }
   
    public function executeGoPageRubrique(sfWebRequest $request) {
        $pager = $this->paginate($request);
        return $this->renderPartial("liste_bci_rubrique", array("pager" => $pager));
    }
    
    public function paginate(sfWebRequest $request) {
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $id_rubrique = $request->getParameter('id_rubrique', '');
        $page = $request->getParameter('page', '');

        $pager = new sfDoctrinePager('Documentachat', 10);
        $pager->setQuery(DocumentachatTable::getInstance()->findAllByRubrique($date_debut, $date_fin, $id_rubrique));
        $pager->setPage($page);
        $pager->init();

        return $pager;
    }

    public function executeBciPourVisa(sfWebRequest $request) {
        $this->id_typedoc = $request->getParameter('id_typedoc', '6');
        $this->datedebut=date('Y-m-d',strtotime(date('Y-m-1')));
        $this->datefin=date("Y-m-d", mktime(0, 0, 0, date('m') +1, 0, date('Y')));
    }
    
    public function executeGoPage(sfWebRequest $request) {
        $id_typedoc = $request->getParameter('id_typedoc', '6');
        $date_debut = $request->getParameter('date_debut', '');
        $date_fin = $request->getParameter('date_fin', '');
        $documents = DocumentachatTable::getInstance()->findAllForVisa($date_debut, $date_fin, $id_typedoc);
        return $this->renderPartial("liste_bci", array("documents" => $documents, "date_debut" => $date_debut, "date_fin" => $date_fin, "id_typedoc" => $id_typedoc));
    }

}
