<?php

require_once dirname(__FILE__) . '/../lib/rubriqueGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/rubriqueGeneratorHelper.class.php';

/**
 * rubrique actions.
 *
 * @package    Bmm
 * @subpackage rubrique
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class rubriqueActions extends autoRubriqueActions {

    public function executeStatistique(sfWebRequest $request) {
//        $listes = Doctrine_Core::getTable('ligprotitrub')
//                        ->createQuery('a')
//                        ->where('id_titre=' . $this->getId())
//                        ->OrderBy('LENGTH(nordre),nordre asc')->execute();
    }

    public function executeAfficherRubrique(sfWebRequest $request) {
//        $mois = $request->getParameter('mois');
        $exercice = $request->getParameter('exercice');
        $id_rubrique = $request->getParameter('id_rubrique');
        $this->rubrique = LigprotitrubTable::getInstance()->find($id_rubrique);
        $this->exercice = $exercice;
//        $this->mois = $mois;
        $q = Doctrine_Core::getTable('Ligprotitrub')
                ->createQuery('l')
                ->select("l.id, to_char(d.datecreation, 'YYYY-MM') as mois, SUM(d.mntnet) as total")
                ->leftJoin('l.Documentbudget d')
                ->where('d.id_budget=' . $id_rubrique)
                ->andWhere('d.id_type=1')
                ->andWhere('d.annule=false')
                ->andWhere("to_char(d.datecreation, 'YYYY')='" . $exercice . "'");
//        if ($mois != '' && $mois != 0) {
//            $mois = sprintf("%02d", $mois);
//            $date = $exercice . '-' . $mois;
//            $q->where("to_char(d.datecreation, 'YYYY-MM')='" . $date . "'");
//            $q->groupBy("l.id,to_char(d.datecreation, 'YYYY-MM')");
//        } else {
        $q->groupBy("l.id,to_char(d.datecreation, 'YYYY-MM')");
//        }
//        if ($mois != '' && $mois != 0) {
//            $this->listes = $q->execute();
//        } else {
        $listes = $q->execute();
        $this->listes = array();
        for ($i = 0; $i < 12; $i++) {
            $this->listes[$i]['mois'] = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
            $value_total = 0;
            for ($j = 0; $j < sizeof($listes); $j++) {
                $periode = $exercice . '-' . str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                if ($periode == $listes[$j]['mois'])
                    $value_total = $listes[$j]['total'];
                $value_mnt = $listes[$j]['mnt'];
            }

            $this->listes[$i]['total'] = $value_total;
        }
//        }
    }

    public function executeStatistiqueFournisseur(sfWebRequest $request) {
        $this->fournisseurs = FournisseurTable::getInstance()->getAllOrderByRaisonSociale();
    }

    public function executeAfficherRubriqueFournisseur(sfWebRequest $request) {
        $exercice = $request->getParameter('exercice');
        $id_fournisseur = $request->getParameter('id_fournisseur');
        $this->fournisseur = FournisseurTable::getInstance()->find($id_fournisseur);
        $this->exercice = $exercice;
        $q = Doctrine_Core::getTable('Ligprotitrub')
                ->createQuery('l')
                ->select("l.*, SUM(db.mntnet) as total")
                ->leftJoin('l.Documentbudget db')
                ->leftJoin('db.Piecejointbudget pj')
                ->leftJoin('pj.Documentachat da')
                ->where('da.id_frs=' . $id_fournisseur)
                ->andWhere('db.id_type=1')
                ->andWhere('db.annule=false')
                ->andWhere("to_char(db.datecreation, 'YYYY')='" . $exercice . "'")
                ->groupBy("l.id");
        $this->listes = $q->execute();
    }

}
