<?php

/**
 * Recapbudget
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Recapbudget extends BaseRecapbudget {

    public function ReadHtmlRecap(sfWebRequest $request) {
        $mois = $request->getParameter('mois');
        $annee = $request->getParameter('annee');
        $titre = $request->getParameter('titre');
        $listes = RecapbudgetTable::getInstance()->getByAnneeAndMois($annee, $mois, $titre);
        $titre_budget = TitrebudjetTable::getInstance()->find($titre);

        $html = '<h3 style="font-size:18px;">RECAP DES ENGAGEMENTS BUDGETAIRES</h3>';

        $html .= '&nbsp;<br><div>
                    <table>
                        <tr>
                            <td style="width:70%;"><b>Budget :</b> ' . $titre_budget . '</td>
                            <td style="width:30%;"><b>Jusqu\'au :</b> ' . date('d/m/Y')
//                str_pad($mois, 2, 0, STR_PAD_LEFT) . '/' . $annee 
                . '</td>
                        </tr>
                    </table>
                </div>';

        $html .= '<table><tr><td style="text-align:right;width:100%;"><b>(en DT)</b></td></tr></table>
                <table border="1" cellpadding="3">
                    <tr style="font-size:10px;text-align:center;font-weight:bold;background-color:#E0E0E0;">
                        <td style="width:35%;height:25px;">Rubrique + Sous Rubrique</td>
                        <td style="width:13%;">C. Alloués</td>
                        <td style="width:13%;">Engagement</td>
                        <td style="width:13%;">Paiement</td>
                        <td style="width:13%;">R. Engag.</td>
                        <td style="width:13%;">R. Paiement</td>
                    </tr>';

        $mnt_alloue = 0;
        $mnt_engage = 0;
        $mnt_paiement = 0;
        $mnt_paiment_rubriquesanssousrubrique = 0;
        $relica_engage = 0;
        $relica_paiement = 0;
        $mnt_engagerrubrique = 0;
        $mnt_paiment_rubrique = 0;
        $reliquantengager_rubrique = 0;
        $reliquantpaiement_rubrique = 0;
        foreach ($listes as $liste) :
            $sous_listes = RecapbudgetTable::getInstance()->getSousByAnneeAndMois($annee, $mois, $titre, $liste->getIdRubrique());
            foreach ($sous_listes as $sous_liste) :
                $mnt_engagerrubrique = $mnt_engagerrubrique + $sous_liste->getMntEncager();
                $mnt_paiment_rubrique = $mnt_paiment_rubrique + $sous_liste->getMntMaiement();
                $reliquantengager_rubrique = $liste->getMntAllouer() - $mnt_engagerrubrique;
                $reliquantpaiement_rubrique = $reliquantpaiement_rubrique + $sous_liste->getRelicatPaiment();
            endforeach;
            if (count($sous_listes) == 0) {
                $mnt_engagerrubriquesanssousrubrique = $mnt_engagerrubrique + $liste->getMntEncager();
                $reliquantpaiement_rubrique_sansrub = $mnt_engagerrubriquesanssousrubrique + $liste->getRelicatPaiment();
                $mnt_paiment_rubriquesanssousrubrique = $mnt_paiment_rubrique + $liste->getMntMaiement();
            } else {
                $mnt_engagerrubriquesanssousrubrique = $mnt_engagerrubrique;
                $reliquantpaiement_rubrique_sansrub = $mnt_engagerrubriquesanssousrubrique;
                $mnt_paiment_rubriquesanssousrubrique = $mnt_paiment_rubrique;
            }

            $html .= '<tr style="font-size:10px;">
                        <td style="height:25px;"><b>' . $liste->getRubrique()->getCode() . ': ' . $liste->getRubrique()->getLibelle() . '</b></td>
                        <td style="text-align:right;"><b>' . number_format($liste->getMntAllouer(), 3, '.', ' ') . '</b></td>
                        <td style="text-align:right;"><b>' . number_format($mnt_engagerrubriquesanssousrubrique, 3, '.', ' ') . '</b></td>
                        <td style="text-align:right;"><b>' . number_format($mnt_paiment_rubriquesanssousrubrique, 3, '.', ' ') . '</b></td>
                        <td style="text-align:right;"><b>' . number_format($liste->getMntAllouer() - $mnt_engagerrubriquesanssousrubrique, 3, '.', ' ') . '</b></td>
                        <td style="text-align:right;"><b>' . number_format($mnt_engagerrubriquesanssousrubrique - $liste->getMntMaiement(), 3, '.', ' ') . '</b></td>
                </tr>';
            $sous_listes = RecapbudgetTable::getInstance()->getSousByAnneeAndMois($annee, $mois, $titre, $liste->getIdRubrique());
            foreach ($sous_listes as $sous_liste) :
                $html .= '<tr style="font-size:10px;background-color: #F1F1F1;">
                        <td style="height:25px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $sous_liste->getRubrique()->getCode() . ': ' . $sous_liste->getRubrique()->getLibelle() . '</td>
                        <td style="text-align: right;">' . number_format($sous_liste->getMntAllouer(), 3, '.', ' ') . '</td>
                        <td style="text-align: right;">' . number_format($sous_liste->getMntEncager(), 3, '.', ' ') . '</td>
                        <td style="text-align: right;">' . number_format($sous_liste->getMntMaiement(), 3, '.', ' ') . '</td>
                        <td style="text-align: right;">' . number_format($sous_liste->getMntAllouer() - $sous_liste->getMntEncager(), 3, '.', ' ') . '</td>
                        <td style="text-align: right;">' . number_format($sous_liste->getMntEncager() - $sous_liste->getMntMaiement(), 3, '.', ' ') . '</td>
                    </tr>';
            endforeach;
           $mnt_alloue = $mnt_alloue + $liste->getMntAllouer();
                $mnt_engage = $mnt_engage + $mnt_engagerrubriquesanssousrubrique;
                $mnt_paiement = $mnt_paiement + $mnt_paiment_rubriquesanssousrubrique;
                $relica_engage = $mnt_alloue - $mnt_engage;
                $relica_paiement = $mnt_alloue - $mnt_paiement;
        endforeach;

        $html .= '<tr style="font-size:10px;font-weight:bold;background-color:#E0E0E0;">
                        <td style="text-align:center;height:25px;">Total</td>
                        <td style="text-align:right;">' . number_format($mnt_alloue, 3, '.', ' ') . '</td>
                        <td style="text-align:right;">' . number_format($mnt_engage, 3, '.', ' ') . '</td>
                        <td style="text-align:right;">' . number_format($mnt_paiement, 3, '.', ' ') . '</td>
                        <td style="text-align:right;">' . number_format($relica_engage, 3, '.', ' ') . '</td>
                        <td style="text-align:right;">' . number_format($mnt_engage - $mnt_paiement, 3, '.', ' ') . '</td>
                </tr>';

        $html .= '</table>';

        return $html;
    }

}
