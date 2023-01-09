<?php

/**
 * exercice actions.
 *
 * @package    sw-commerciale
 * @subpackage exercice
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class exerciceActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    function getAllAnterieur(sfWebRequest $request) {
        $dossier = $request->getParameter('dossier', '');
        $exercice = $request->getParameter('exercice', '');
        $cloture = $request->getParameter('cloture', '');

        $pager = new sfDoctrinePager('Anterieur', 5);
        $pager->setQuery(DossierExerciceTable::getInstance()->load($dossier, $exercice, $cloture));
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeListeAnterieur(sfWebRequest $request) {
        $this->pager = $this->getAllAnterieur($request);
        $this->dossier = DossiercomptableTable::getInstance()->findAll()->getFirst();
        $this->exercices = ExerciceTable::getInstance()->getAll();
    }

    public function executeAjoutAnterieur(sfWebRequest $request) {
        $anterieur = DossierexerciceTable::getInstance()->findByIdDossierAndIdExercice($request->getParameter('dossier_save'), $request->getParameter('exercice_save'));
       
        if ($anterieur->count() != 0) {
            return $this->renderText('existe');
        } else {
            $anterieur = new Dossierexercice();
            $anterieur->setIdDossier($request->getParameter('dossier_save'));
            $anterieur->setIdExercice($request->getParameter('exercice_save'));
            $anterieur->setDate(date('Y-m-d'));
            $anterieur->save();
            /*
             * Ajouter plan dossier comptable Antireurs
             */
           
            $plan_dossier_comptable_new= PlandossiercomptableTable::getInstance()->findByIdDossierAndIdExercice($anterieur->getIdDossier(),$anterieur->getIdExercice());
         
            if(count($plan_dossier_comptable_new)==0){
                $Dossier_Exercice = DossierexerciceTable::getInstance()->findByIdDossier($anterieur->getIdDossier());
               $year_date_now=  intval(Date('Y'));
//               $string='';
               
                foreach ($Dossier_Exercice as $dossiere){
                    $Exercice= ExerciceTable::getInstance()->findOneById($dossiere->getIdExercice());
//                    $string.=$year_date_now.'-'.intval($Exercice->getLibelle());
                    if($year_date_now-intval($Exercice->getLibelle())==1){
                       // die('bien');
                         PlandossiercomptableTable::getInstance()->InsertQueryArrayStandart($anterieur->getIdDossier(),$anterieur->getIdExercice(),$Exercice->getId());
                         $journal_new= JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($anterieur->getIdDossier(),$anterieur->getIdExercice());
                         if(count($journal_new)==0){
                             $date_d= date('Y-m-d',  strtotime($year_date_now.'-01-01'));
                             $date_f= date('Y-m-d',  strtotime($year_date_now.'-12-31'));
                             JournalcomptableTable::getInstance()->InsertQueryArrayStandart($anterieur->getIdDossier(),$anterieur->getIdExercice(),$Exercice->getId(),  $date_d,$date_f);
                             JournalcentralisateurTable::getInstance();
                             $journal_old=  JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($anterieur->getIdDossier(),$Exercice->getId());
                             $journal_new= JournalcomptableTable::getInstance()->findByIdDossierAndIdExercice($anterieur->getIdDossier(),$anterieur->getIdExercice());
                             JournalcentralisateurTable::getInstance()->InsertJournalCentralisateur($journal_old, $journal_new);
                             NumeroseriejournalTable::getInstance()->InsertNumeroSerie($journal_old, $journal_new);
                        }                        
                        
                    }
                }
                
                
               // die($string);
               
            }
            

            $pager = $this->getAllAnterieur($request);
            return $this->renderPartial('exercice/laListeAnterieur', array('pager' => $pager));
        }
    }

    public function executeDeleteAnterieur(sfWebRequest $request) {
        $id = $request->getParameter('id');

        $anterieur = DossierexerciceTable::getInstance()->find($id);
        $anterieur->delete();

        $pager = $this->getAllAnterieur($request);

        return $this->renderPartial('exercice/laListeAnterieur', array('pager' => $pager));
    }

    public function executeGoPageAnterieur(sfWebRequest $request) {
        $pager = $this->getAllAnterieur($request);
        return $this->renderPartial('exercice/laListeAnterieur', array('pager' => $pager));
    }

}
