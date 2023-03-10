<?php

/**
 * Engagementantecedent
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Engagementantecedent extends BaseEngagementantecedent {

    public function ReadHtmlEtatAntecedent(sfWebRequest $request) {
        $id = $request->getParameter('id');
        $engagements = EngagementantecedentTable::getInstance()->getEngagementFirstDegreeByTitre($id);
        $titre_budget = TitrebudjetTable::getInstance()->find($id);

        $array_romain = array("1" => "I", "2" => "II", "3" => "III", "4" => "IV", "5" => "V",
            "6" => "VI", "7" => "VII", "8" => "VIII", "9" => "IX", "10" => "X",
            "11" => "XI", "12" => "XII", "13" => "XIII", "14" => "XIV", "15" => "XV",
            "16" => "XVI", "17" => "XVII", "18" => "XVIII", "19" => "XIX", "20" => "XX",
            "21" => "XXI", "22" => "XXII", "23" => "XXIII", "24" => "XXIV", "25" => "XXV",
            "26" => "XXVI", "27" => "XXVII", "28" => "XXVIII", "29" => "XXIX", "30" => "XXX"
        );

        $html = '<h3 style="font-size:18px;">' . $titre_budget->getLibelle() . '<br>DETAIL DES ENGAGEMENTS A PAYER - ' . $titre_budget->getTypebudget() . '</h3>';

        if ($engagements->count() != 0):
            $total = 0;
            $total_romain = 0;
            $total_rubrique = 0;
            $total_sous_rubrique = 0;
            $annee = 0;
            $id_lig = '';
            $id_rubrique_parent = '';

            $array_total = array();

            //Calcule des sommes

            foreach ($engagements as $engagement):
                if ($annee != $engagement->getAnnee()):
                    $array_total['total_' . $annee] = $total_romain;
                    $annee = $engagement->getAnnee();
                    $id_lig = '';
                    $total_romain = 0;
                endif;

                if ($engagement->getLigprotitrub()->getRubrique()->getIdRubrique() != null):
                    $ligprotitrub = LigprotitrubTable::getInstance()->findOneByIdTitreAndIdRubrique($engagement->getIdTitre(), $engagement->getLigprotitrub()->getRubrique()->getIdRubrique());
                    if ($id_rubrique_parent != $engagement->getLigprotitrub()->getRubrique()->getIdRubrique()):
                        $array_total["rubrique_parent_" . $id_rubrique_parent . "_" . $annee] = $total_sous_rubrique;
                        $id_rubrique_parent = $engagement->getLigprotitrub()->getRubrique()->getIdRubrique();
                        $total_sous_rubrique = 0;
                    endif;

                    if ($id_lig != $engagement->getLigprotitrub()->getId() && $id_lig != ''):
                        $array["rubrique_" . $id_lig . "_" . $annee] = $total_rubrique;
                        $id_lig = $engagement->getLigprotitrub()->getId();
                        $total_rubrique = 0;
                    endif;

                    $total = $total + $engagement->getMontant();
                    $total_romain = $total_romain + $engagement->getMontant();
                    $total_rubrique = $total_rubrique + $engagement->getMontant();
                    $total_sous_rubrique = $total_sous_rubrique + $engagement->getMontant();
                else:
                    if ($id_lig != $engagement->getLigprotitrub()->getId()):
                        $array["rubrique_" . $id_lig . "_" . $annee] = $total_rubrique;
                        $id_lig = $engagement->getLigprotitrub()->getId();
                        $total_rubrique = 0;
                    endif;

                    $total = $total + $engagement->getMontant();
                    $total_romain = $total_romain + $engagement->getMontant();
                    $total_rubrique = $total_rubrique + $engagement->getMontant();
                endif;

                $array_total['total_' . $annee] = $total_romain;
                $array["rubrique_" . $id_lig . "_" . $annee] = $total_rubrique;
                $array_total["rubrique_parent_" . $id_rubrique_parent . "_" . $annee] = $total_sous_rubrique;
            endforeach;

            //Fin calcule des sommes

            $ran_romain = 1;
            $annee = 0;
            $id_lig = '';
            $id_rubrique_parent = '';

            $html.='&nbsp;<br><table style="font-size:11px;">';
            foreach ($engagements as $engagement):
                if ($annee != $engagement->getAnnee()):

                    $annee = $engagement->getAnnee();
                    $id_lig = '';

                    $html.='<tr><td style="width: 70%; height:25px; font-weight: bold; font-size: 12px; height:30px;">' . $array_romain[$ran_romain] . ') ENGAGEMENTS DE ' . $engagement->getAnnee() . ' : </td><td style="width: 15%;"></td><td style="width: 15%; font-size: 12px; font-weight: bold; color: #40B33A; text-align: right;">' . number_format($array_total['total_' . $engagement->getAnnee()], 3, '.', ' ') . '</td></tr>';
                    $ran_romain++;
                endif;

                if ($engagement->getLigprotitrub()->getRubrique()->getIdRubrique() != null):
                    $ligprotitrub = LigprotitrubTable::getInstance()->findOneByIdTitreAndIdRubrique($engagement->getIdTitre(), $engagement->getLigprotitrub()->getRubrique()->getIdRubrique());
                    if ($id_rubrique_parent != $engagement->getLigprotitrub()->getRubrique()->getIdRubrique()):
                        $id_rubrique_parent = $engagement->getLigprotitrub()->getRubrique()->getIdRubrique();
                        $html.='<tr><td style="width: 70%; height:25px; font-weight: bold;">&nbsp;&nbsp;' . trim($ligprotitrub->getNordre()) . ') ' . $ligprotitrub->getRubrique() . '</td><td style="width: 15%; font-weight: bold; text-align: right; color: #3A7CB3; text-align: right;">' . number_format($array_total["rubrique_parent_" . $id_rubrique_parent . "_" . $annee], 3, '.', ' ') . '</td></tr>';
                    endif;

                    if ($id_lig != $engagement->getLigprotitrub()->getId() && $id_lig != ''):
                        $id_lig = $engagement->getLigprotitrub()->getId();
                        $html.='<tr><td style="width: 70%; height:25px; font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;' . trim($engagement->getLigprotitrub()->getNordre()) . ') ' . $engagement->getLigprotitrub()->getRubrique() . '</td><td style="width: 15%; font-weight: bold; text-align: right;">' . number_format($array["rubrique_" . $id_lig . "_" . $annee], 3, '.', ' ') . '</td></tr>';
                    endif;

                    $html.='<tr><td style="width: 70%; height:25px; font-weight: normal; height: 30px;">&nbsp;&nbsp;&nbsp;&nbsp;' . trim($engagement->getDescription()) . '</td><td style="width: 15%; font-weight: normal; text-align: right;">' . number_format($engagement->getMontant(), 3, '.', ' ') . '</td></tr>';
                else:
                    if ($id_lig != $engagement->getLigprotitrub()->getId()):
                        $id_lig = $engagement->getLigprotitrub()->getId();
                        $html.='<tr><td style="width: 70%; height:25px; font-weight: bold;">&nbsp;&nbsp;' . trim($engagement->getLigprotitrub()->getNordre()) . ') ' . $engagement->getLigprotitrub()->getRubrique() . '</td><td style="width: 15%; font-weight: bold; text-align: right; color: #3A7CB3;">' . number_format($array["rubrique_" . $id_lig . "_" . $annee], 3, '.', ' ') . '</td></tr>';
                    endif;

                    $html.='<tr><td style="width: 70%; height:25px; font-weight: normal; height: 30px;">&nbsp;&nbsp;' . trim($engagement->getDescription()) . '</td><td style="width: 15%; font-weight: normal; text-align: right;">' . number_format($engagement->getMontant(), 3, '.', ' ') . '</td></tr>';
                endif;
            endforeach;
            $html.='</table>&nbsp;<br>';
            $html.='<table style="width:100%"><tr><td style="width: 85%; height:25px; font-weight: bold; font-size: 14px; color: #CE6341;">Total des Engagements</td><td style="width: 15%; font-size: 12px; font-weight: bold; color: #CE6341; text-align: right;">' . number_format($total, 3, '.', ' ') . '</td></tr></table>';

        else:
            $html.='&nbsp;<br>&nbsp;<br><table style="width:100%"><tr><td style="width:100%; text-align:center;">Pas d\'engagement(s) ant??c??dents ?? payer pour ce titre de budget !</td></tr></table>';
        endif;

        return $html;
    }

}
