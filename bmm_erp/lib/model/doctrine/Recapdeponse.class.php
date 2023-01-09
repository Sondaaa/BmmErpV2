<?php

/**
 * Recapdeponse
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Recapdeponse extends BaseRecapdeponse
{

    public function ReadHtmlRecap(sfWebRequest $request)
    {
        $mois = $request->getParameter('mois');
        $annee = $request->getParameter('annee');
        $titre = $request->getParameter('titre');
        $listes = RecapDeponseTable::getInstance()->getByAnneeAndMois($annee, $mois, $titre);
        $titre_budget = TitrebudjetTable::getInstance()->find($titre);

        $arretee_au = $annee . '-' . str_pad($mois, 2, 0, STR_PAD_LEFT) . '-01';
        $arretee_au = date('t/m/Y', strtotime($arretee_au));

        $html = '<h3 style="font-size:18px;">RECAP DES DEPENSES<br><b style="font-size:12px;">Arrêtée au : ' . $arretee_au . '</b></h3>';

        $html .= '&nbsp;<br><div>
                    <table>
                        <tr>
                            <td style="width:80%;"><b>Budget :</b> ' . $titre_budget . '</td>
                            <td style="width:20%;"><b>Jusqu\'au :</b> ' . str_pad($mois, 2, 0, STR_PAD_LEFT) . '/' . $annee . '</td>
                        </tr>
                    </table>
                </div>';

        $html .= '<table><tr><td style="text-align:right;width:100%;"><b>(en DT)</b></td></tr></table>
                <table border="1" cellpadding="3">
                    <tr style="font-size:10px;text-align:center;font-weight:bold;background-color:#E0E0E0;">
                        <td rowspan="2" style="width:35%;">&nbsp;<br>Rubriques</td>
                        <td colspan="3" style="width:39%;height:25px;">PAIEMENTS DES ENGAGEMENTS ' . $annee . '</td>
                        <td rowspan="2" style="width:13%;">Paiement des Engagements Antérieurs</td>
                        <td rowspan="2" style="width:13%;">&nbsp;<br>Total Général</td>
                    </tr>
                    <tr style="font-size:10px;text-align:center;font-weight:bold;background-color:#E0E0E0;">
                        <td style="width:13%;height:25px;">Par Caisse</td>
                        <td style="width:13%;">Par Banque</td>
                        <td style="width:13%;">Total</td>
                    </tr>';

        $mnt_caisse = 0;
        $mnt_banque = 0;
        $mnt_banque_rubrique = 0;
        $mnt_banque_sous_rubrique = 0;
        $mnt_ant_rubrique = 0;
        $mnt_ant_sous_rubrique = 0;
        $mnt_caisse_rubrique = 0;
        $mnt_caisse_sous_rubrique = 0;
        $mnt_total = 0;
        $mnt_ant = 0;
        $all_total = 0;
        $all_total_sous_rub = 0;
        $i = 0;
        $mnt_paiement_curant = 0;
        $mnt_paiement_curant_rubrique = 0;
        $mnt_caisse_rubri = 0;

        foreach ($listes as $liste) :
            $sous_listes = RecapDeponseTable::getInstance()->getSousByAnneeAndMois($annee, $mois, $titre, $liste->getIdRubrique());
            foreach ($sous_listes as $sous_liste) :
                $mnt_paiement_curant = $mnt_paiement_curant + $sous_liste->getMntCaisse() + $sous_liste->getMntBanque() + $sous_liste->getMntAnt();
                $mnt_banque_sous_rubrique = $mnt_banque_sous_rubrique + $sous_liste->getMntBanque();
                $mnt_caisse_sous_rubrique = $mnt_caisse_sous_rubrique + $sous_liste->getMntCaisse();
                $mnt_ant_sous_rubrique = $mnt_ant_sous_rubrique + $sous_liste->getMntAnt();
                $all_total_sous_rub = $all_total_sous_rub + $sous_liste->getMntCaisse() + $sous_liste->getMntBanque() + $sous_liste->getMntAnt();

            endforeach;
            if (count($sous_listes) == 0) {
                $mnt_paiement_curant_rubrique = $mnt_paiement_curant + ($liste->getMntCaisse() + $liste->getMntBanque() + $liste->getMntAnt());
                $mnt_banque_rubrique = $mnt_banque_sous_rubrique + $liste->getMntBanque();
                $mnt_caisse_rubrique = $mnt_caisse_sous_rubrique + $liste->getMntCaisse();

                $mnt_ant_rubrique = $mnt_ant_sous_rubrique + $liste->getMntAnt();
            } else {
                $mnt_paiement_curant_rubrique = $mnt_paiement_curant;
                $mnt_banque_rubrique = $mnt_banque_sous_rubrique;
                $mnt_caisse_rubrique = $mnt_caisse_sous_rubrique;
                $mnt_ant_rubrique = $mnt_ant_sous_rubrique;
            }
            $html .= '<tr style="font-size:10px;">
                        <td style="height:25px;">' . $liste->getRubrique() . '</td>
                        <td style="text-align:right;">' . number_format($mnt_caisse_rubrique, 3, '.', ' ') . '</td>
                        <td style="text-align:right;">' . number_format($mnt_banque_rubrique, 3, '.', ' ') . '</td>
                        <td style="text-align:right;"><b>' . number_format($mnt_caisse_rubrique + $mnt_banque_rubrique, 3, '.', ' ') . '</b></td>
                        <td style="text-align:right;">' . number_format($mnt_ant_rubrique, 3, '.', ' ') . '</td>
                        <td style="text-align:right;"><b>' . number_format($mnt_paiement_curant_rubrique, 3, '.', ' ') . '</b></td>
                </tr>';

            $mnt_caisse = $mnt_caisse + $mnt_caisse_rubrique;
            $mnt_banque = $mnt_banque + $mnt_banque_rubrique;
            $mnt_total = $mnt_total + $mnt_caisse_rubrique + $mnt_banque_rubrique;
            $mnt_ant = $mnt_ant + $mnt_ant_rubrique;
            if (count($sous_listes) == 0) {
                $all_total = $all_total_sous_rub + $liste->getMntCaisse() + $liste->getMntBanque() + $liste->getMntAnt();
            } else {
                $all_total = $all_total_sous_rub;
            }
            $i++;
            $sous_listes = RecapDeponseTable::getInstance()->getSousByAnneeAndMois($annee, $mois, $titre, $liste->getIdRubrique());
            foreach ($sous_listes as $sous_liste) :
                $html .= '<tr style="font-size:10px;background-color: #F1F1F1;">
                        <td style="height:25px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $sous_liste->getRubrique()->getLibelle() . '</td>
                        <td style="text-align: right;">' . number_format($sous_liste->getMntCaisse(), 3, '.', ' ') . '</td>
                        <td style="text-align: right;">' . number_format($sous_liste->getMntBanque(), 3, '.', ' ') . '</td>
                        <td style="text-align: right;"><b>' . number_format($sous_liste->getMntCaisse() + $sous_liste->getMntBanque(), 3, '.', ' ') . '</b></td>
                        <td style="text-align: right;">' . number_format($sous_liste->getMntAnt(), 3, '.', ' ') . '</td>
                        <td style="text-align: right;"><b>' . number_format($sous_liste->getMntCaisse() + $sous_liste->getMntBanque() + $sous_liste->getMntAnt(), 3, '.', ' ') . '</b></td>
                    </tr>';
            endforeach;
        endforeach;

        $html .= '<tr style="font-size:10px;font-weight:bold;background-color:#E0E0E0;">
                        <td style="text-align:center;height:25px;">Total</td>
                        <td style="text-align:right;">' . number_format($mnt_caisse, 3, '.', ' ') . '</td>
                        <td style="text-align:right;">' . number_format($mnt_banque, 3, '.', ' ') . '</td>
                        <td style="text-align:right;">' . number_format($mnt_total, 3, '.', ' ') . '</td>
                        <td style="text-align:right;">' . number_format($mnt_ant, 3, '.', ' ') . '</td>
                        <td style="text-align:right;">' . number_format($all_total, 3, '.', ' ') . '</td>
                </tr>';

        $html .= '</table>';

        return $html;
    }
    public function getMntCaisseByArryMois($array)
    {
        $Years = date('Y');
       
       $ligne=RecapdeponseTable::getInstance()->getMntCaisseByArray($Years,$this->id_titre,$this->id_rubrique,$array);
      
        return $ligne->getMntCaisse();
    }
    public function getMntBanqueByArryMois($array)
    {
        $Years = date('Y');
       
        $ligne=RecapdeponseTable::getInstance()->getMntBanqueByArray($Years,$this->id_titre,$this->id_rubrique,$array);
         
         return $ligne->getMntBanque();
    }
    public function getMntAntByArryMois($array)
    {
        $Years = date('Y');
       
        $ligne=RecapdeponseTable::getInstance()->getMntAntByArray($Years,$this->id_titre,$this->id_rubrique,$array);
         
         return $ligne->getMntAnt();
    }
}