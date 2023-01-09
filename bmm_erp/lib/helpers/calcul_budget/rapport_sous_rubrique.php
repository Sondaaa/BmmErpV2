<?php

class calculMontantRapportSousRubrique {

    public static function getMnt($rubriques_sous_lignes) {
        $total_provisoire = 0;
        $total_engagement = 0;
        $total_ordonnance = 0;
        $total_paye = 0;

        foreach ($rubriques_sous_lignes as $sous_rubrique) {
            $r_sous_lignes = LigprotitrubTable::getInstance()->getSousRubrique($sous_rubrique->getIdRubrique(), $sous_rubrique->getIdTitre());
            if ($r_sous_lignes->count() != 0):
                $sous_mnt_rapport = calculMontantRapportSousRubrique::getSousMnt($r_sous_lignes);
                $total_provisoire = $total_provisoire + $sous_mnt_rapport['provisoire'];
                $total_engagement = $total_engagement + $sous_mnt_rapport['engagement'];
                $total_ordonnance = $total_ordonnance + $sous_mnt_rapport['ordonnance'];
                $total_paye = $total_paye + $sous_mnt_rapport['paye'];
            else:
                $total_provisoire = $total_provisoire + DocumentbudgetTable::getInstance()->getMntTypeDocBudget($sous_rubrique->getId(), 3)->getMnt();
                $total_engagement = $total_engagement + DocumentbudgetTable::getInstance()->getMntTypeDocBudget($sous_rubrique->getId(), 1)->getMnt();
                $total_ordonnance = $total_ordonnance + DocumentbudgetTable::getInstance()->getMntTypeDocBudget($sous_rubrique->getId(), 2)->getMnt();
                $total_caisse = LigneoperationcaisseTable::getInstance()->getMntPaye($sous_rubrique->getId())->getMnt();
                $total_banque = MouvementbanciareTable::getInstance()->getMntPaye($sous_rubrique->getId())->getMnt();
                $total_paye = $total_paye + $total_caisse + $total_banque;
            endif;
        }

        $mnt_rapport = array();
        $mnt_rapport['provisoire'] = $total_provisoire;
        $mnt_rapport['engagement'] = $total_engagement;        
        if ($total_provisoire == 0 && $total_engagement > 0)
            $mnt_rapport['ecart'] = abs($total_provisoire - $total_engagement);
        else
            $mnt_rapport['ecart'] = $total_provisoire - $total_engagement;
        $mnt_rapport['ordonnance'] = $total_ordonnance;
        $mnt_rapport['paye'] = $total_paye;

        return $mnt_rapport;
    }

    public static function getSousMnt($rubriques_sous_lignes) {
        $total_provisoire = 0;
        $total_engagement = 0;
        $total_ordonnance = 0;
        $total_paye = 0;

        foreach ($rubriques_sous_lignes as $sous_rubrique) {
            $r_sous_lignes = LigprotitrubTable::getInstance()->getSousRubrique($sous_rubrique->getIdRubrique(), $sous_rubrique->getIdTitre());
            if ($r_sous_lignes->count() != 0):
                $sous_mnt_rapport = $this->getSousMnt($r_sous_lignes);
                $total_provisoire = $total_provisoire + $sous_mnt_rapport['provisoire'];
                $total_engagement = $total_engagement + $sous_mnt_rapport['engagement'];
                $total_ordonnance = $total_ordonnance + $sous_mnt_rapport['ordoannance'];
                $total_paye = $total_paye + $sous_mnt_rapport['paye'];
            else:
                $total_provisoire = $total_provisoire + DocumentbudgetTable::getInstance()->getMntTypeDocBudget($sous_rubrique->getId(), 3)->getMnt();
                $total_engagement = $total_engagement + DocumentbudgetTable::getInstance()->getMntTypeDocBudget($sous_rubrique->getId(), 1)->getMnt();
                $total_ordonnance = $total_ordonnance + DocumentbudgetTable::getInstance()->getMntTypeDocBudget($sous_rubrique->getId(), 2)->getMnt();
                $total_caisse = LigneoperationcaisseTable::getInstance()->getMntPaye($sous_rubrique->getId())->getMnt();
                $total_banque = MouvementbanciareTable::getInstance()->getMntPaye($sous_rubrique->getId())->getMnt();
                $total_paye = $total_paye + $total_caisse + $total_banque;
            endif;
        }

        $mnt_rapport = array();
        $mnt_rapport['provisoire'] = $total_provisoire;
        $mnt_rapport['engagement'] = $total_engagement;
        $mnt_rapport['ordonnance'] = $total_ordonnance;
        $mnt_rapport['paye'] = $total_paye;

        return $mnt_rapport;
    }

}

?>
