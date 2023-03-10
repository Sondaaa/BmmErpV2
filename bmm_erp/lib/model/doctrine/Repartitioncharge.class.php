<?php

/**
 * Repartitioncharge
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Repartitioncharge extends BaseRepartitioncharge {

    public function ReadHtmlRapport(sfWebRequest $request) {
        $id = $request->getParameter('id', '');

        $repartition = RepartitionchargeTable::getInstance()->find($id);
        $charge_directe = FraisgenerauxTable::getInstance()->findOneByAnnee($repartition->getAnnee());
        $societe = SocieteTable::getInstance()->findAll()->getFirst();

        $html = '<div border="1">
                    <table cellspacing="0" cellpadding="3">
                        <tr align="center">
                            <td style="font-weight:bold;font-size:18px;width:100%;">' . $societe->getRs() . '</td>
                        </tr>
                        <tr align="center">
                            <td style="font-weight:bold;font-size:14px;width:100%;">Tableau de Répartition des Charges par Unité<br>' . $repartition->getAnnee() . '</td>
                        </tr>
                    </table>
                </div>&nbsp;<br>';

        $html.= '<table cellspacing="0">
                <tr>
                    <td style="width:47%;">
                        <table cellspacing="0" cellpadding="5" border="1">
                            <tr>
                                <td style="font-size:12px;width:35%;background-color:#DADADA;"><b>Année :</b></td>
                                <td style="font-size:12px;width:65%;"><b>' . $repartition->getAnnee() . '</b></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;width:35%;background-color:#DADADA;"><b>Total Montants :</b></td>
                                <td style="font-size:12px;width:65%;"><b>' . number_format($repartition->getMontant(), 3, '.', ' ') . ' TND</b></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;width:35%;background-color:#DADADA;"><b>Total Fraix Généraux :</b></td>
                                <td style="font-size:12px;width:65%;"><b>' . number_format($charge_directe->getMontant(), 3, '.', ' ') . ' TND</b></td>
                            </tr>
                        </table>
                    </td>
                    <td style="width:53%;">
                        <ul><b>Informations :</b>
                            <li>Le coefficient choisi pour la répartition des frais généraux est le jours MOD</li>
                            <li>Frais Généraux = Total Fraix Généraux X Coefficient</li>
                            <li>Total = MOD + Intrants + Mécanisation - Frais Généraux</li>
                        </ul>
                    </td>
                </tr>
                </table>&nbsp;<br>';


        $html.= '<table cellspacing="0" cellpadding="5" border="1">
                    <thead>
                        <tr style="background-color: #D0D0D0; font-weight: bold;">
                            <th style="width: 18%;">Unité</th>
                            <th style="width: 7%; text-align: center;">Jour MOD</th>
                            <th style="width: 9%; text-align: center;">Coefficient</th>
                            <th style="width: 10.5%; text-align: center;">MOD</th>
                            <th style="width: 10.5%; text-align: center;">Intrants</th>
                            <th style="width: 11.5%; text-align: center;">Mécanisation</th>
                            <th style="width: 10.5%; text-align: center;">Frais Généraux</th>
                            <th style="width: 10%; text-align: center;">Total</th>
                            <th style="width: 13%; text-align: center;">Comptes Appropriés</th>
                        </tr>
                    </thead>
                <tbody>';

        $lignes = LigneuniterepartitionTable::getInstance()->getByRepartition($repartition->getId());
        foreach ($lignes as $ligne):
            $html.='<tr style="font-size: 11px;">
                        <td style="width: 18%;">' . $ligne->getUniterepartitioncharge()->getLibelle() . '</td>
                        <td style="width: 7%; text-align: right; background-color: #ffefef;">' . $ligne->getJourmod() . '</td>
                        <td style="width: 9%; text-align: center;">' . $ligne->getCoefficient() . ' %</td>
                        <td style="width: 10.5%; text-align: right; background-color: #e9f0ff;">' . number_format($ligne->getMontantmod(), 3, '.', ' ') . '</td>
                        <td style="width: 10.5%; text-align: right; background-color: #e9fbe1;">' . number_format($ligne->getIntrant(), 3, '.', ' ') . '</td>
                        <td style="width: 11.5%; text-align: right; background-color: #fffbe5;">' . number_format($ligne->getMecanisation(), 3, '.', ' ') . '</td>
                        <td style="width: 10.5%; text-align: right;">' . number_format($ligne->getFraisgeneraux(), 3, '.', ' ') . '</td>
                        <td style="width: 10%; text-align: right;">' . number_format($ligne->getTotal(), 3, '.', ' ') . '</td>
                        <td style="width: 13%;">' . $ligne->getCompteapproprie() . '</td>
                    </tr>';
        endforeach;
        
        $html.='<tr style="background-color: #F0F0F0; font-size: 11px; font-weight: bold;">
                        <td style="width: 18%;">TOTAL</td>
                        <td style="width: 7%; text-align: right; background-color: #ffefef;">' . $repartition->getJour() . '</td>
                        <td style="width: 9%; text-align: center;">100 %</td>
                        <td style="width: 10.5%; text-align: right; background-color: #e9f0ff;">' . number_format($repartition->getMain(), 3, '.', ' ') . '</td>
                        <td style="width: 10.5%; text-align: right; background-color: #e9fbe1;">' . number_format($repartition->getIntrant(), 3, '.', ' ') . '</td>
                        <td style="width: 11.5%; text-align: right; background-color: #fffbe5;">' . number_format($repartition->getMecanisation(), 3, '.', ' ') . '</td>
                        <td style="width: 10.5%; text-align: right;">' . number_format($repartition->getMontant() - $charge_directe->getMontant(), 3, '.', ' ') . '</td>
                        <td style="width: 10%; text-align: right;">' . number_format($charge_directe->getMontant(), 3, '.', ' ') . '</td>
                        <td style="width: 13%;"></td>
                    </tr>';

        $html.='</tbody>
            </table>';

        return $html;
    }

}
