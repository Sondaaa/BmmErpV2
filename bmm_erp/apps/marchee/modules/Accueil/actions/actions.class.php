<?php

/**
 * Accueil actions.
 *
 * @package    Bmm
 * @subpackage Accueil
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AccueilActions extends sfActions
{

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeGlobal(sfWebRequest $request)
    {
        //$this->forward('default', 'module');
    }

    public function executeProfil(sfWebRequest $request)
    {

    }

    public function executeSaveProfil(sfWebRequest $request)
    {
        $id = $request->getParameter('id');
        $nom = $request->getParameter('nom');
        $prenom = $request->getParameter('prenom');
        $mail = $request->getParameter('mail');
        $gsm = $request->getParameter('gsm');
        $login = $request->getParameter('login');
        $password = $request->getParameter('password');

        $user = $this->getUser()->getAttribute('userB2m');
        $agent = $user->getAgents();
        $agent->setNomcomplet($nom);
        $agent->setPrenom($prenom);
        $agent->setGsm($gsm);
        $agent->setMail($mail);
        $agent->save();

        $user->setLogin($login);
        if ($password != '') {
            $user->setPwd($password);
        }

        $user->save();

        die("OK");
    }

    public function executeImport(sfWebRequest $request)
    {
        if ($request->getParameter('imp')) {
            if ($request->getParameter('imp') == "beneficiaire") {
                $this->importBeneficiaire();
            }
            if ($request->getParameter('imp') == "details") {
                $this->importDetailPrix();
            }
            if ($request->getParameter('imp') == "decompte") {
                $this->importDecompte();
            }
        }
    }

    public function executeTableauBord(sfWebRequest $request)
    {
        $this->marche_courants = $this->getAllMarcheEnCours($request);
        $this->bci_without_visa = $this->getAllBciWithoutVisa($request);
        $this->bci_not_affected = $this->getAllBciNotAffected($request);
        $this->beneficiaire_courant = $this->getAllBeneficiaireEnCours($request);
        $this->bci_annule = $this->getAllBciAnnule($request);
        $this->reclamations = $this->getAllReclamation($request);
        $this->bci_courant = $this->getAllBciCourant($request);
        $this->decomptes = $this->getAllDecompteCourant($request);
        $this->bci_cloture = $this->getAllBciCloture($request);
    }

    public function getAllMarcheEnCours(sfWebRequest $request)
    {
        $pager = new sfDoctrinePager('Marches', 5);
        $pager->setQuery(MarchesTable::getInstance()->getAllMarcheEnCours());
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeGoPageMarcheCourant(sfWebRequest $request)
    {
        $marche_courants = $this->getAllMarcheEnCours($request);
        return $this->renderPartial("listMarcheCourant", array("marche_courants" => $marche_courants));
    }

    public function getAllBciWithoutVisa(sfWebRequest $request)
    {
        $pager = new sfDoctrinePager('Documentachat', 5);
        $pager->setQuery(DocumentachatTable::getInstance()->getAllBciWithoutVisa());
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeGoPageBciWithoutVisa(sfWebRequest $request)
    {
        $bci_without_visa = $this->getAllBciWithoutVisa($request);
        return $this->renderPartial("listBciWithoutVisa", array("bci_without_visa" => $bci_without_visa));
    }

    public function getAllBciNotAffected(sfWebRequest $request)
    {
        $pager = new sfDoctrinePager('Documentachat', 5);
        $pager->setQuery(DocumentachatTable::getInstance()->getAllBciNotAffected());
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeGoPageBciNotAffected(sfWebRequest $request)
    {
        $bci_not_affected = $this->getAllBciNotAffected($request);
        return $this->renderPartial("listBciNotAffected", array("bci_not_affected" => $bci_not_affected));
    }

    public function getAllBeneficiaireEnCours(sfWebRequest $request)
    {
        $pager = new sfDoctrinePager('Lots', 5);
        $pager->setQuery(LotsTable::getInstance()->getAllBeneficiaireEnCours());
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeGoPageBeneficiaireCourant(sfWebRequest $request)
    {
        $beneficiaire_courant = $this->getAllBeneficiaireEnCours($request);
        return $this->renderPartial("listBeneficiaireCourant", array("beneficiaire_courant" => $beneficiaire_courant));
    }

    public function getAllBciCourant(sfWebRequest $request)
    {
        $pager = new sfDoctrinePager('Documentachat', 5);
        $pager->setQuery(DocumentachatTable::getInstance()->getAllBciCourant());
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeGoPageBciCourant(sfWebRequest $request)
    {
        $bci_courant = $this->getAllBciCourant($request);
        return $this->renderPartial("listBciCourant", array("bci_courant" => $bci_courant));
    }

    public function getAllDecompteCourant(sfWebRequest $request)
    {
        $pager = new sfDoctrinePager('Detailprix', 5);
        $pager->setQuery(DetailprixTable::getInstance()->getAllDecompteCourant());
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeGoPageDecompte(sfWebRequest $request)
    {
        $decomptes = $this->getAllDecompteCourant($request);
        return $this->renderPartial("listDecompte", array("decomptes" => $decomptes));
    }

    public function getAllBciAnnule(sfWebRequest $request)
    {
        $pager = new sfDoctrinePager('Documentachat', 5);
        $pager->setQuery(DocumentachatTable::getInstance()->getAllBciAnnule());
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeGoPageBciAnnule(sfWebRequest $request)
    {
        $bci_annule = $this->getAllBciAnnule($request);
        return $this->renderPartial("listBciAnnule", array("bci_annule" => $bci_annule));
    }

    public function getAllBciCloture(sfWebRequest $request)
    {
        $pager = new sfDoctrinePager('Documentachat', 5);
        $pager->setQuery(DocumentachatTable::getInstance()->getAllBciCloture());
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeGoPageBciCloture(sfWebRequest $request)
    {
        $bci_cloture = $this->getAllBciCloture($request);
        return $this->renderPartial("listBciCloture", array("bci_cloture" => $bci_cloture));
    }

    public function getAllReclamation(sfWebRequest $request)
    {
        $pager = new sfDoctrinePager('Reclamationfrs', 5);
        $pager->setQuery(ReclamationfrsTable::getInstance()->getAllReclamation());
        $pager->setPage($request->getParameter('page', 1));
        $pager->init();

        return $pager;
    }

    public function executeGoPageReclamation(sfWebRequest $request)
    {
        $reclamations = $this->getAllReclamation($request);
        return $this->renderPartial("listReclamation", array("reclamations" => $reclamations));
    }

    public function executeDrawChart(sfWebRequest $request)
    {
        $this->id = $request->getParameter('id');
    }
    public function executeDrawChart1(sfWebRequest $request)
    {
        $this->id = $request->getParameter('id');
    }

    public function executeStatistiquemarche(sfWebRequest $request)
    {

    }

    public function executeGetMarche(sfWebRequest $request)
    {
        if ($request->getParameter('id') != 0) {
            $marche = MarchesTable::getInstance()->find($request->getParameter('id'));
            $id_marche = $marche->getId();
            $this->marche = $marche;

            foreach ($marche->getLots() as $lot):
                $name = $lot->getFournisseur()->getRs();
                $montant = 0;
                foreach ($lot->getDetailprix() as $details):
                    if ($details->getIdTypedetailprix() == 3 || $details->getIdTypedetailprix() == 4):
                        $montant = $montant + $details->getNetapayer();
                        $value = date('Y', strtotime($details->getDatecreation()));
                    endif;
                endforeach;
            endforeach;
            $this->marche = array();
            $this->marche['montant'] = $value;
            // for ($i = 0; $i < 12; $i++) {
            //     $this->presences[$i]['mois'] = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
            //     $value = '';
            //     for ($j = 0; $j < sizeof($presences); $j++) {
            //         if (str_pad($i + 1, 2, '0', STR_PAD_LEFT) == $presences[$j]['mois']) {
            //             $value = $presences[$j]['nbpresence'];
            //         }

            //     }
            //     if ($value != '') {
            //         $this->presences[$i]['nbpresence'] = $value;
            //     } else {
            //         $this->presences[$i]['nbpresence'] = 0;
            //     }
            // }

        }
        $this->id = $request->getParameter('id');

    }

}
