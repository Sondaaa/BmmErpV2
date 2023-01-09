<?php

/**
 * Rapporttravaux
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    Tes
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Rapporttravaux extends BaseRapporttravaux {

    public function ReadHtmlRapport(sfWebRequest $request) {
        $id = $request->getParameter('id', '');

        $rapport = RapporttravauxTable::getInstance()->find($id);
        $societe = SocieteTable::getInstance()->findAll()->getFirst();

        $html = '<div border="1">
                    <table cellspacing="0" cellpadding="3">
                        <tr align="center">
                            <td style="font-weight:bold;font-size:18px;width:100%;">' . $societe->getRs() . '</td>
                        </tr>
                        <tr align="center">
                            <td style="font-weight:bold;font-size:14px;width:100%;">' . $rapport->getLibelle() . ' <br> ' . $rapport->getTyperapport()->getLibelle() . ' ' . $rapport->getAnnee() . '</td>
                        </tr>
                    </table>
                </div>&nbsp;<br>';

        $html.= '<table cellspacing="0">
                <tr>
                    <td style="width:50%;">
                        <table cellspacing="0" cellpadding="5" border="1">
                            <tr>
                                <td style="font-size:12px;width:28%;background-color:#DADADA;"><b>Année :</b></td>
                                <td style="font-size:12px;width:72%;"><b>' . $rapport->getAnnee() . '</b></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;width:28%;background-color:#DADADA;"><b>Total :</b></td>
                                <td style="font-size:12px;width:72%;"><b>' . number_format($rapport->getMontant(), 3, '.', ' ') . ' TND</b></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </table>&nbsp;<br>';


        $html.= '<table cellspacing="0" cellpadding="5" border="1">
                <thead>
                    <tr style="font-weight: bold; background-color: #DADADA;">
                        <th style="width: 80%;">Travail</th>
                        <th style="text-align: center; width: 20%;">Montant</th>
                    </tr>
                    <tr style="font-weight: bold; background-color: #DADADA;">
                        <th style="width: 5%;"></th>
                        <th style="width: 55%;">Article</th>
                        <th style="text-align: center; width: 20%;">Montant Article</th>
                        <th style="width: 20%;"></th>
                    </tr>
                </thead>
                <tbody>';

        $travaux = TravailrapporttravauxTable::getInstance()->getByRapport($rapport->getId());
        foreach ($travaux as $travail):
            $html.='<tr style="background-color: #F0F0F0;">
                        <td style="width: 80%;">' . $travail->getLibelle() . '</td>
                        <td style="text-align: right; width: 20%; font-weight: bold;">' . number_format($travail->getMontant(), 3, '.', ' ') . '</td>
                    </tr>';

            $lignes = LignetravailrapportTable::getInstance()->getByTravail($travail->getId());
            foreach ($lignes as $ligne):
                $html.='<tr>
                            <td style="width: 5%;"></td>
                            <td style="width: 55%;">' . $ligne->getLibelle() . '</td>
                            <td style="text-align: right; width: 20%;">' . number_format($ligne->getMontant(), 3, '.', ' ') . '</td>
                            <td style="width: 20%;"></td>
                        </tr>';
            endforeach;
        endforeach;

        $html.='</tbody>
            </table>
            <table cellspacing="0" cellpadding="5" border="1">
                <tr style="background-color: #E7E7E7;">
                    <td style="width: 60%;"></td>
                    <td style="width: 20%; text-align: center; font-weight: bold;">Total : </td>
                    <td style="width: 20%; text-align: right; font-weight: bold;">' . number_format($rapport->getMontant(), 3, '.', ' ') . '</td>
                </tr>
            </table>';

        return $html;
    }

    public function ReadHtmlRapportArticle(sfWebRequest $request) {
        $id = $request->getParameter('id', '');

        $rapport = RapporttravauxTable::getInstance()->find($id);
        $societe = SocieteTable::getInstance()->findAll()->getFirst();

        $html = '<div border="1">
                    <table cellspacing="0" cellpadding="3">
                        <tr align="center">
                            <td style="font-weight:bold;font-size:18px;width:100%;">' . $societe->getRs() . '</td>
                        </tr>
                        <tr align="center">
                            <td style="font-weight:bold;font-size:14px;width:100%;">' . $rapport->getLibelle() . ' <br> ' . $rapport->getTyperapport()->getLibelle() . ' ' . $rapport->getAnnee() . '</td>
                        </tr>
                    </table>
                </div>&nbsp;<br>';

        $html.= '<table cellspacing="0">
                <tr>
                    <td style="width:50%;">
                        <table cellspacing="0" cellpadding="5" border="1">
                            <tr>
                                <td style="font-size:12px;width:28%;background-color:#DADADA;"><b>Année :</b></td>
                                <td style="font-size:12px;width:72%;"><b>' . $rapport->getAnnee() . '</b></td>
                            </tr>
                            <tr>
                                <td style="font-size:12px;width:28%;background-color:#DADADA;"><b>Total :</b></td>
                                <td style="font-size:12px;width:72%;"><b>' . number_format($rapport->getMontant(), 3, '.', ' ') . ' TND</b></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </table>&nbsp;<br>';


        $html.= '<table cellspacing="0" cellpadding="5" border="1">
                <thead>
                    <tr style="font-weight: bold; background-color: #DADADA;">
                        <th style="width: 40%; height: 30px;">Article</th>
                        <th style="text-align: center; width: 10%;">MRE</th>
                        <th style="text-align: center; width: 10%;">DPS</th>
                        <th style="text-align: center; width: 10%;">DTX MAINT</th>
                        <th style="text-align: center; width: 10%;">DTX BAT</th>
                        <th style="text-align: center; width: 10%;">DTS PLANT</th>
                        <th style="text-align: center; width: 10%;">T FRAIS</th>
                    </tr>
                </thead>
                <tbody>';

        $mre = 0;
        $dps = 0;
        $maint = 0;
        $bat = 0;
        $plant = 0;
        $articles = ArticlerapporttravauxTable::getInstance()->getByRapport($rapport->getId());
        foreach ($articles as $article):
            $html.='<tr style="background-color: #F0F0F0;">
                        <td style="width: 40%;">' . $article->getImmobilisation()->getDesignation() . '</td>
                        <td style="text-align: right; width: 10%;">' . str_replace('0.000', '', number_format($article->getMre(), 3, '.', ' ')) . '</td>
                        <td style="text-align: right; width: 10%;">' . str_replace('0.000', '', number_format($article->getDps(), 3, '.', ' ')) . '</td>
                        <td style="text-align: right; width: 10%;">' . str_replace('0.000', '', number_format($article->getMaint(), 3, '.', ' ')) . '</td>
                        <td style="text-align: right; width: 10%;">' . str_replace('0.000', '', number_format($article->getBat(), 3, '.', ' ')) . '</td>
                        <td style="text-align: right; width: 10%;">' . str_replace('0.000', '', number_format($article->getPlant(), 3, '.', ' ')) . '</td>
                        <td style="text-align: right; width: 10%; font-weight: bold;">' . number_format($article->getMontant(), 3, '.', ' ') . '</td>
                    </tr>';
            $mre = $mre + $article->getMre();
            $dps = $dps + $article->getDps();
            $maint = $maint + $article->getMaint();
            $bat = $bat + $article->getBat();
            $plant = $plant + $article->getPlant();
        endforeach;

        $html.='</tbody>
            </table>
            <table cellspacing="0" cellpadding="5" border="1">
                <tr style="background-color: #E7E7E7;">
                    <td style="width: 40%; text-align: right; font-weight: bold;">Total : </td>
                    <td style="width: 10%; text-align: right; font-weight: bold;">' . number_format($mre, 3, '.', ' ') . '</td>
                    <td style="width: 10%; text-align: right; font-weight: bold;">' . number_format($dps, 3, '.', ' ') . '</td>
                    <td style="width: 10%; text-align: right; font-weight: bold;">' . number_format($maint, 3, '.', ' ') . '</td>
                    <td style="width: 10%; text-align: right; font-weight: bold;">' . number_format($bat, 3, '.', ' ') . '</td>
                    <td style="width: 10%; text-align: right; font-weight: bold;">' . number_format($plant, 3, '.', ' ') . '</td>
                    <td style="width: 10%; text-align: right; font-weight: bold;">' . number_format($rapport->getMontant(), 3, '.', ' ') . '</td>
                </tr>
            </table>';

        return $html;
    }

    public function ReadHtmlRapportChargeDirecte(sfWebRequest $request) {
        $annee = $request->getParameter('annee');
        $repartition = RepartitionsalaireouvrierTable::getInstance()->findOneByAnnee($annee);
        $rapports = RapporttravauxTable::getInstance()->findByAnnee($annee);
        $societe = SocieteTable::getInstance()->findAll()->getFirst();

        $html = '<div border="1">
                    <table cellspacing="0" cellpadding="3">
                        <tr align="center">
                            <td style="font-weight:bold;font-size:18px;width:100%;">' . $societe->getRs() . '</td>
                        </tr>
                        <tr align="center">
                            <td style="font-weight:bold;font-size:14px;width:100%;">Charges Directes<br>' . $annee . '</td>
                        </tr>
                    </table>
                </div>&nbsp;<br>';

        $intrant = 0;
        $mecanisation = 0;
        $id_mecanisation = '';
        $label_mecanisation = '';
        foreach ($rapports as $rapport):
            if ($rapport->getIdType() != 2):
                $intrant = $intrant + $rapport->getMontant();
            else:
                $mecanisation = $mecanisation + $rapport->getMontant();
                $id_mecanisation = $rapport->getId();
                $label_mecanisation = $rapport->getLibelle();
            endif;
        endforeach;

        $label_intrant = '';
        $i = 1;
        foreach ($rapports as $rapport):
            if ($rapport->getIdType() != 2):
                if ($label_intrant != '')
                    $label_intrant.= ' | ' . 'R' . $i . '-' . $annee;
                else
                    $label_intrant.= 'R' . $i . '-' . $annee;
                $i++;
            endif;
        endforeach;

        $html.= '<table cellspacing="0" cellpadding="5" border="1">
                <thead>
                    <tr style="font-weight: bold; background-color: #DADADA;">
                        <th style="width: 70%;">Charges Directes</th>
                        <th style="text-align: center; width: 30%;">Montants</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 70%;"><table><tr><td>Main d\'œuvre</td><td style="text-align: right;"><span style="float: right;">Répartition ' . $annee . '</span></td></tr></table></td>
                        <td style="width: 30%; text-align: right; font-weight: bold;">' . number_format($repartition->getMontant(), 3, '.', ' ') . '</td>
                    </tr>
                    <tr>
                        <td style="width: 70%;">
                            <table>
                                <tr>
                                    <td style="width: 70%;">Répartition salaire (ouvrier)</td>
                                    <td style="width: 30%; text-align: right;">' . number_format($repartition->getMontant(), 3, '.', ' ') . '</td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 30%;"></td>
                    </tr>
                    <tr>
                        <td style="width: 70%;"><table><tr><td style="width:20%;">Intrant</td><td style="text-align: right;width:80%;"><span style="float: right;">' . $label_intrant . '</span></td></tr></table></td>
                        <td style="width: 30%; text-align: right; font-weight: bold;">' . number_format($intrant, 3, '.', ' ') . '</td>
                    </tr>
                    <tr>
                        <td style="width: 70%;">
                            <table>';
        $i = 1;
        $height = 50;
        foreach ($rapports as $rapport):
            if ($i == 5)
                $height = 35;
            if ($rapport->getIdType() != 2):
                $html.='<tr>
                    <td style="width: 70%; height: ' . $height . 'px;">' . $rapport->getLibelle() . ' - ' . $rapport->getTyperapport() . '</td>
                    <td style="width: 30%; text-align: right;">' . number_format($rapport->getMontant(), 3, '.', ' ') . '</td>
                </tr>';
                $i++;
            endif;
        endforeach;

        $html.='</table>
                        </td>
                        <td style="width: 30%;"></td>
                    </tr>
                    <tr>
                        <td style="width: 70%;"><table><tr><td>Mécanisation</td><td style="text-align: right;"><span style="float: right;">Rapport ' . $annee . '</span></td></tr></table></td>
                        <td style="width: 30%; text-align: right; font-weight: bold;">' . number_format($mecanisation, 3, '.', ' ') . '</td>
                    </tr>
                    <tr>
                        <td style="width: 70%;">
                            <table>
                                <tr>
                                    <td style="width: 70%;">' . $label_mecanisation . '</td>
                                    <td style="width: 30%; text-align: right;">' . number_format($mecanisation, 3, '.', ' ') . '</td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 30%;"></td>
                    </tr>
                </tbody>
            </table>
            <table cellspacing="0" cellpadding="5" border="1">
                <tr style="background-color: #E7E7E7;">
                    <td style="width: 70%; font-weight: bold;">Total : </td>
                    <td style="width: 30%; text-align: right; font-weight: bold;">' . number_format($repartition->getMontant() + $intrant + $mecanisation, 3, '.', ' ') . '</td>
                </tr>
            </table>';

        return $html;
    }

    public function ReadHtmlRapportToutCharge(sfWebRequest $request) {
        $annee = $request->getParameter('annee');
        $repartition = RepartitionsalaireouvrierTable::getInstance()->findOneByAnnee($annee);
        $rapports = RapporttravauxTable::getInstance()->findByAnnee($annee);
        $societe = SocieteTable::getInstance()->findAll()->getFirst();

        $html = '<div border="1">
                    <table cellspacing="0" cellpadding="3">
                        <tr align="center">
                            <td style="font-weight:bold;font-size:18px;width:100%;">' . $societe->getRs() . '</td>
                        </tr>
                        <tr align="center">
                            <td style="font-weight:bold;font-size:14px;width:100%;">Frais généraux<br>' . $annee . '</td>
                        </tr>
                    </table>
                </div>';

        $intrant = 0;
        $mecanisation = 0;
        $id_mecanisation = '';
        $label_mecanisation = '';
        foreach ($rapports as $rapport):
            if ($rapport->getIdType() != 2):
                $intrant = $intrant + $rapport->getMontant();
            else:
                $mecanisation = $mecanisation + $rapport->getMontant();
                $id_mecanisation = $rapport->getId();
                $label_mecanisation = $rapport->getLibelle();
            endif;
        endforeach;

        $label_intrant = '';
        $i = 1;
        foreach ($rapports as $rapport):
            if ($rapport->getIdType() != 2):
                if ($label_intrant != '')
                    $label_intrant.= ' | ' . 'R' . $i . '-' . $annee;
                else
                    $label_intrant.= 'R' . $i . '-' . $annee;
                $i++;
            endif;
        endforeach;
        
        $html.='<h4>Charges directes : </h4>';

        $html.= '<table cellspacing="0" cellpadding="5" border="1">
                <thead>
                    <tr style="font-weight: bold; background-color: #DADADA;">
                        <th style="width: 70%;">Charges Directes</th>
                        <th style="text-align: center; width: 30%;">Montants</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 70%;"><table><tr><td>Main d\'œuvre</td><td style="text-align: right;"><span style="float: right;">Répartition ' . $annee . '</span></td></tr></table></td>
                        <td style="width: 30%; text-align: right; font-weight: bold;">' . number_format($repartition->getMontant(), 3, '.', ' ') . '</td>
                    </tr>
                    <tr>
                        <td style="width: 70%;"><table><tr><td style="width:20%;">Intrant</td><td style="text-align: right;width:80%;"><span style="float: right;">' . $label_intrant . '</span></td></tr></table></td>
                        <td style="width: 30%; text-align: right; font-weight: bold;">' . number_format($intrant, 3, '.', ' ') . '</td>
                    </tr>
                    <tr>
                        <td style="width: 70%;"><table><tr><td>Mécanisation</td><td style="text-align: right;"><span style="float: right;">Rapport ' . $annee . '</span></td></tr></table></td>
                        <td style="width: 30%; text-align: right; font-weight: bold;">' . number_format($mecanisation, 3, '.', ' ') . '</td>
                    </tr>
                </tbody>
            </table>
            <table cellspacing="0" cellpadding="5" border="1">
                <tr style="background-color: #E7E7E7;">
                    <td style="width: 70%; font-weight: bold;">Total : </td>
                    <td style="width: 30%; text-align: right; font-weight: bold;">' . number_format($repartition->getMontant() + $intrant + $mecanisation, 3, '.', ' ') . '</td>
                </tr>
            </table>';

        $frais = FraisgenerauxTable::getInstance()->findOneByAnnee($annee);
        $html.='<h4>Charges à répartir : </h4>';
        
        $html.= '<table cellspacing="0" cellpadding="5" border="1">
                    <thead>
                        <tr style="font-weight: bold; background-color: #DADADA;">
                            <th style="width: 60%;">Compte Comptable</th>
                            <th style="text-align: center; width: 20%;">Solde Balance (S*)</th>
                            <th style="text-align: center; width: 20%;">Total</th>
                        </tr>
                    </thead>
                <tbody>';

        $charge_lignes = LignefraisgenerauxTable::getInstance()->getByRapportAndType($frais->getId(), '6');
        foreach ($charge_lignes as $ligne):
            $html.='<tr style="background-color: #F0F0F0;">
                        <td style="width: 5%; text-align: center;">' . $ligne->getPlandossiercomptable()->getNumerocompte() . '</td>
                        <td style="width: 55%; text-align: justify;">' . $ligne->getPlandossiercomptable()->getLibelle() . '</td>
                        <td style="text-align: right; width: 20%;">' . number_format($ligne->getMontant(), 3, '.', ' ') . '</td>
                        <td style="right; width: 20%;"></td>
                    </tr>';
        endforeach;

        $html.='<tr style="background-color: #D0D0D0;">
                    <td style="width: 80%; font-weight: bold;">TOTAL CHARGES</td>
                    <td style="text-align: right; width: 20%; font-weight: bold;">' . number_format($frais->getMontantcharge(), 3, '.', ' ') . '</td>
                </tr>';

        $produit_lignes = LignefraisgenerauxTable::getInstance()->getByRapportAndType($frais->getId(), '7');
        foreach ($produit_lignes as $ligne):
            $html.='<tr style="background-color: #F0F0F0;">
                        <td style="width: 5%; text-align: center;">' . $ligne->getPlandossiercomptable()->getNumerocompte() . '</td>
                        <td style="width: 55%; text-align: justify;">' . $ligne->getPlandossiercomptable()->getLibelle() . '</td>
                        <td style="text-align: right; width: 20%;">' . number_format($ligne->getMontant(), 3, '.', ' ') . '</td>
                        <td style="right; width: 20%;"></td>
                    </tr>';
        endforeach;

        $html.='<tr style="background-color: #D0D0D0;">
                    <td style="width: 80%; font-weight: bold;">TOTAL PRODUITS</td>
                    <td style="text-align: right; width: 20%; font-weight: bold;">' . number_format($frais->getMontantproduit(), 3, '.', ' ') . '</td>
                </tr>';

        $html.='</tbody>
            </table>
            <table cellspacing="0" cellpadding="5" border="1">
                <tr style="background-color: #E7E7E7;">
                    <td style="width: 80%; font-weight: bold;">TOTAL : </td>
                    <td style="width: 20%; text-align: right; font-weight: bold;">' . number_format($frais->getMontant(), 3, '.', ' ') . '</td>
                </tr>
            </table>';
        
        $Montant_frais = 0;
        if ($frais)
            $Montant_frais = $frais->getMontant();

        $html.='<h4>Détermination des frais généraux : </h4>';

        $html.= '<table cellspacing="0" cellpadding="5" border="1">
                <thead>
                    <tr><th style="width: 100%; font-weight: bold;">Frais généraux = Charges directes - Charges à répartir</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 70%;">Charges directes : </td>
                        <td style="width: 30%; text-align: right; font-weight: bold;">' . number_format($repartition->getMontant() + $intrant + $mecanisation, 3, '.', ' ') . '</td>
                    </tr>
                    <tr>
                        <td style="width: 70%;">Charges à répartir : </td>
                        <td style="width: 30%; text-align: right; font-weight: bold;">' . number_format($Montant_frais, 3, '.', ' ') . '</td>
                    </tr>
                    <tr style="background-color: #E7E7E7;">
                        <td style="width: 70%; font-weight: bold;">Frais généraux : </td>
                        <td style="width: 30%; text-align: right; font-weight: bold;">' . number_format($repartition->getMontant() + $intrant + $mecanisation - $Montant_frais, 3, '.', ' ') . '</td>
                    </tr>
                </tbody>
            </table>';

        return $html;
    }

}