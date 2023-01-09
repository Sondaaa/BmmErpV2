<?php

require_once dirname(__FILE__) . '/../lib/ligneoperationcaisseGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/ligneoperationcaisseGeneratorHelper.class.php';

/**
 * ligneoperationcaisse actions.
 *
 * @package    Bmm
 * @subpackage ligneoperationcaisse
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ligneoperationcaisseActions extends autoLigneoperationcaisseActions {

    public $type = "1";

    public function executeIndex(sfWebRequest $request) {
        // sorting
        if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
            $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
        }

        // pager
        if ($request->getParameter('page')) {
            $this->setPage($request->getParameter('page'));
        }
        if ($request->getParameter('categorie'))
            $this->type = $request->getParameter('categorie');
        $this->pager = $this->getPager();
        $this->sort = $this->getSort();
    }

    protected function buildQuery() {
        $tableMethod = $this->configuration->getTableMethod();
        if (null === $this->filters) {
            $this->filters = $this->configuration->getFilterForm($this->getFilters());
        }

        $this->filters->setTableMethod($tableMethod);

        $query = $this->filters->buildQuery($this->getFilters());

        $this->addSortQuery($query);

        $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
        $query = $event->getReturnValue();
        $query = $query->OrderBy('id desc');
        return $query;
    }

    public function executeFilter(sfWebRequest $request) {
        $this->setPage(1);

        if ($request->hasParameter('_reset')) {
            $this->setFilters($this->configuration->getFilterDefaults());

            $this->redirect('@ligneoperationcaisse');
        }

        $this->filters = $this->configuration->getFilterForm($this->getFilters());
       
        $this->filters->bind($request->getParameter($this->filters->getName()));
        if ($this->filters->isValid()) {
            $this->setFilters($this->filters->getValues());

            $this->redirect('@ligneoperationcaisse');
        }

        $this->pager = $this->getPager();
        $this->sort = $this->getSort();

        $this->setTemplate('index');
    }
    
    public function executeStatistiqueCaisse(sfWebRequest $request) {
        
    }
    
    public function executeAfficherStatCaisse(sfWebRequest $request) {
        $annee = $request->getParameter('annee');
        $mois = $request->getParameter('mois');
        
        $this->caisses = CaissesbanquesTable::getInstance()->getAllCaisse();

        $annee = $request->getParameter('annee');
        $mois = $request->getParameter('mois');

        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query = "SELECT ligneoperationcaisse.id_caisse as id_caisse, COALESCE(SUM(COALESCE(ligneoperationcaisse.mntoperation, 0)), 0) as total, "
                . " caissesbanques.libelle as libellecaisse"
                . " FROM  ligneoperationcaisse, caissesbanques "
                . " WHERE (TO_CHAR(ligneoperationcaisse.dateoperation, 'yyyy-mm'))= '" . $annee . "-" . $mois . "'"
                . " AND ligneoperationcaisse.id_caisse IN (select caissesbanques.id from caissesbanques where caissesbanques.id_typecb = 1)"
                . " AND ligneoperationcaisse.id_caisse = caissesbanques.id"
                . " GROUP BY ligneoperationcaisse.id_caisse, caissesbanques.libelle"
                . " ORDER BY ligneoperationcaisse.id_caisse";

        $total_caisses = $conn->fetchAssoc($query);

        $query_rubriques = "SELECT ligneoperationcaisse.id_caisse as id_caisse, COALESCE(SUM(COALESCE(ligneoperationcaisse.mntoperation, 0)), 0) as total, "
                . " rubrique.libelle as libellerubrique"
                . " FROM  ligneoperationcaisse, ligprotitrub, rubrique "
                . " WHERE (TO_CHAR(ligneoperationcaisse.dateoperation, 'yyyy-mm'))= '" . $annee . "-" . $mois . "'"
                . " AND ligneoperationcaisse.id_caisse IN (select caissesbanques.id from caissesbanques where caissesbanques.id_typecb = 1)"
                . " AND ligneoperationcaisse.id_budget = ligprotitrub.id"
                . " AND ligprotitrub.id_rubrique = rubrique.id"
                . " GROUP BY ligneoperationcaisse.id_caisse, rubrique.libelle"
                . " ORDER BY ligneoperationcaisse.id_caisse";

        $this->rubriques = $conn->fetchAssoc($query_rubriques);

        $this->total_tous = 0;
        $this->liste = array();
        for ($j = 0; $j < sizeof($total_caisses); $j++) {
            $this->liste[$total_caisses[$j]['id_banque']]['total'] = $total_caisses[$j]['total'];
            $this->liste[$total_caisses[$j]['id_banque']]['libellecaisse'] = $total_caisses[$j]['libellecaisse'];
            $this->total_tous = $this->total_tous + $total_caisses[$j]['total'];
        }

        $this->mois = $mois;
        $this->annee = $annee;
    }

}
