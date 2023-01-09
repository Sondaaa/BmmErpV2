<?php

/**
 * Lots
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    BmmErpTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Lots extends BaseLots
{

    public function getTtc()
    {
        return number_format($this->getTtcnet(), 3, ".", ",");
    }

    public function MisajourDelaiArretJustfier($ordre)
    {
        $delai_arret = 0;

        if ($this->getPeriodejustifier() && $this->getPeriodejustifier() != "") {
            $delai_arret = intval($this->getPeriodejustifier());
        }

        $osarret = Doctrine_Core::getTable('ordredeservice')
            ->createQuery('a')
            ->where('id_benificaire=' . $this->getId())
            ->andwhere('id_type=4')
            ->orderBy('id asc')->execute();
        if (count($osarret) > 0) {
            $date_arret = $osarret[count($osarret) - 1]->getDateios();
            $osdate = Doctrine_Query::create()
                ->select("to_char(dateios::timestamp without time zone - '" . $date_arret . "'::timestamp without time zone, 'dd') as periode")
                ->from('ordredeservice a')
                ->where('id=' . $ordre->getId())->execute();
            $delai_arret += intval($osdate[0]['periode']);
            $lot = new Lots();
            $ben = Doctrine_Core::getTable('lots')->findOneById($this->getId());
            $lot = $ben;
            $lot->setPeriodejustifier($delai_arret);

            if ($delai_arret) {
                $date_max_reponse = floor(($lot->getDatemaxreponse() + strtotime($delai_arret)) / 31556926);
                $lot->setDatemaxreponse($date_max_reponse);
            }
            $lot->save();
        }
    }

    public function ReadHtmlDecomptes($id)
    {

        $lot = LotsTable::getInstance()->find($id);
        $detais = Doctrine_Core::getTable('detailprix')->findOneByIdLotsAndIdTypedetailprix($id, 3);
        $listesDecompltes = Doctrine_Core::getTable('detailprix')->findByIdLotsAndIdTypedetailprix($id, 4);
        $marche = Doctrine_Core::getTable('marches')->findOneById($lot->getIdMarche());

        $html = '<div class="titre"><h3 style="font-size:18px;">Détails Décompte(s) Marchés ' . $lot->getMarches() . '<br>Fournisseur : ' . $lot->getFournisseur() . '</h3></div>&nbsp;<br>';

        $html .= '<h4>Fiche Bénéficiaire</h4>
                <h5>Information Bénéficiaire : ' . $lot->getFournisseur() . '</h5>
                <table class="tableligne" style="width:100%; font-size:12px;">
                    <tbody>
                        <tr>
                            <td style="width: 20%; text-align:left; background-color:#DEDEDE;"><b>N°Ordre</b></td>
                            <td style="width: 16%">' . $lot->getNordre() . '</td>
                            <td style="width: 13%; text-align:left; background-color:#DEDEDE;"><b>Marchés</b></td>
                            <td style="width: 16%">' . $lot->getMarches() . '</td>
                            <td style="width: 10%; text-align:left; background-color:#DEDEDE;"><b>Fournisseur</b></td>
                            <td style="width: 25%">' . $lot->getFournisseur() . '</td>
                        </tr>
                        <tr>
                            <td style="text-align:left; background-color:#DEDEDE;"><b>TOTAL GENERAL HTVA</b></td>
                            <td>' . $lot->getTotalht() . '</td>
                            <td style="text-align:left; background-color:#DEDEDE;"><b>TVA</b></td>
                            <td>' . $lot->getTva() . '</td>
                            <td style="text-align:left; background-color:#DEDEDE;"><b>RABAIS</b></td>
                            <td>' . $lot->getRrr() . '</td>
                        </tr>
                        <tr>
                            <td style="text-align:left; background-color:#DEDEDE;"><b>T. G. HTVA APRES RABAIS</b></td>
                            <td>' . $lot->getTotalapresrrr() . '</td>
                            <td style="text-align:left; background-color:#DEDEDE;"><b>Net à payer TTC</b></td>
                            <td>' . $lot->getTtcnet() . '</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; height: 50px; background-color:#DEDEDE;"><b>Objet</b></td>
                            <td style="text-align:justify;" colspan="5">' . $lot->getObjet() . '</td>
                        </tr>
                    </tbody>
                </table>&nbsp;<br>';

        $html .= '<div>
            <h4>Décompte 1 : Avance</h4>
            <h5>CERTIFICAT DE PAIEMENT :</h5>
                <table class="tableligne" style="width:100%;">
                        <tr style="background-color:#DEDEDE;">
                            <th style="width: 45%">Indication des ouvrages</th>
                            <th style="width: 20%">Montant du marché</th>
                            <th style="width: 15%">Taux de l\'avance</th>
                            <th style="width: 20%">Montant de l\'avance</th>
                        </tr>
                    <tbody>
                        <tr>
                            <td style="width: 45%; text-align:justify;">Conformément à l\'article 15 du CCAP une avance de ' . number_format($marche->getAvance(), 2) . ' % du montant du marché sera accordée à l\'Entrepreneur</td>
                            <td style="width: 20%">' . number_format($lot->getTtcnet(), 3, ".", ",") . ' DT</td>
                            <td style="width: 15%">' . number_format($marche->getAvance(), 2) . ' %</td>
                            <td style="width: 20%">';

        $avaance = number_format($marche->getAvance(), 2);
        if (!$detais) {
            $avance = $lot->getTtcnet() * ($avaance / 100);
            $html .= number_format($avance, 3, ".", ",");
        } else {
            $html .= number_format($detais->getNetapayer(), 3, ".", ",");
        }

        $html .= ' DT';
        $html .= '</td>
                                    </tr>
                                </tbody>
                            </table></div>&nbsp;<br>';

        $i = 2;
        $array = array("1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre");
        foreach ($listesDecompltes as $detailprix) {
            $html .= '<div>
            <h4>Décompte ' . $i . ' : ' . $array[intval(date('m', strtotime($detailprix->getDatecreation())))] . '-' . date('Y', strtotime($detailprix->getDatecreation())) . '</h4>
            <table class="tableligne" style="width:100%;font-size:10px;">
                <tr style="background-color:#DEDEDE;">
                    <th style="width:50px;" rowspan="2">N° du prix</th>
                    <th style="width:205px;" rowspan="2">DESIGNATION DES TRAVAUX</th>
                    <th style="width:100px;" rowspan="2">UNITE</th>
                    <th style="width:90px;" rowspan="2">Quantité</th>
                    <th style="width:250px;" colspan="3">Quantité</th>
                    <th style="width:120px;" rowspan="2">Prix unitaire<br>HTVA</th>
                    <th style="width:120px;" rowspan="2">Prix Total<br>HTVA</th>
                </tr>
                <tr style="background-color:#DEDEDE;">
                    <th>Antérieur</th>
                    <th>Du Mois</th>
                    <th>Cumulé</th>
                </tr>
                <tbody>';

            $liste_sous_detail_prix = Doctrine_Core::getTable('sousdetailprix')
                ->createQuery('a')->where('id_detail=' . $detailprix->getId())
                ->orderBy('id asc')->execute();
            foreach ($liste_sous_detail_prix as $sous_detail_prix) {
                $html .= '<tr>
                        <td style="text-align:center;">' . $sous_detail_prix->getNordre() . '</td>
                        <td style="text-align:left;">' . $sous_detail_prix->getDesignation() . '</td>
                        <td style="text-align:left;">' . $sous_detail_prix->getUnitemarche() . '</td>
                        <td style="text-align:center;">' . $sous_detail_prix->getQuetiteant() . '</td>';

                if ($sous_detail_prix->getQuetiteant() > 0):
                    $html .= '<td style="text-align:center;">' . $detailprix->getMntAntirieur($detailprix->getIdLots(), $sous_detail_prix->getNordre()) . '</td>
		                            <td style="text-align:center;">' . $sous_detail_prix->getQteDuMois() . '</td>
		                            <td style="text-align:center;">' . $sous_detail_prix->getAncienQteDuMois($sous_detail_prix->getNordre()) . '</td>';
                else:
                    $html .= '<td style="text-align:center;"></td>
		                            <td style="text-align:center;"></td>
		                            <td style="text-align:center;"></td>';
                endif;

                $html .= '<td>' . $sous_detail_prix->getPrixunitaire() . '</td>';

                if ($sous_detail_prix->getQuetiteant() > 0):
                    $html .= '<td style="text-align:center;">' . number_format($sous_detail_prix->getAncienQteDuMois($sous_detail_prix->getNordre()) * $sous_detail_prix->getPrixunitaire(), 3, ".", ",") . '</td>';
                else:
                    $html .= '<td style="text-align:center;"></td>';
                endif;

                $html .= '</tr>';
            }

            $html .= '</tbody>
                </table>
                </div>';

            $montant_tva = $detailprix->getNetapayer() - $detailprix->getHtva();
            $html .= '<table class="tableligne" style="font-size:10px;">
                        <tr>
                            <td style="width:25%; text-align:left;"><b>TOTAL GENERAL</b> ' . $detailprix->getTotalgeneral() . '</td>
                            <td style="width:30%; text-align:left;">' . $lot->getRrr() . ' <b>Rabais, Remises ou Ristourne:</b> ' . $lot->getRrr() . ' : ' . $detailprix->getRrr() . '</td>
                            <td style="width:30%; text-align:left;"><b>TOTAL GENERAL HTVA APRES RABAIS</b> ' . $detailprix->getTotalapresremise() . '</td>
                            <td style="width:14%; text-align:left;"><b>T.V.A</b> ' . $lot->getTva() . '</td>
                        </tr>
                        <tr>
                            <td style="text-align:left;"><b>TOTAL T.T.C</b> ' . $detailprix->getTotal() . '</td>
                            <td style="text-align:left;"><b>Avance</b> ' . number_format($lot->getMarches()->getAvance()) . '% <b>sur le montant des travaux</b> ' . $detailprix->getMntavance() . '</td>
                            <td style="text-align:left;"><b>RETENUE DE GARANTIE</b> ' . number_format($lot->getMarches()->getRetenuegaraentie()) . '% : ' . $detailprix->getMntretenue() . '</td>
                            <td style="text-align:left;"><b>TOTAL</b> ' . $detailprix->getNetapayer() . '</td>
                        </tr>
                        <tr>
                            <td style="text-align:left;"><b>DEPENSES ANTERIEURES</b> ' . $detailprix->getDeponse_Antirieur($detailprix->getIdLots()) . '</td>
                            <td style="text-align:left;"><b>Net à payer TTC</b> ' . $detailprix->getNetapayer() . '</td>
                            <td style="text-align:left;"><b>HTVA</b> ' . $detailprix->getHtva() . '</td>
                            <td style="text-align:left;"><b>TVA</b> ' . $lot->getTva() . ' : ' . $montant_tva . '</td>
                        </tr>
                    </table>';

            $i++;
        }

        return $html;
    }

    public function ReadHtmlFiche($id)
    {

        $lot = LotsTable::getInstance()->find($id);

        $listesDecompltes = Doctrine_Core::getTable('detailprix')->findByIdLotsAndIdTypedetailprix($id, 1);
        if ($listesDecompltes->count() == 0) {
            $listesDecompltes = Doctrine_Core::getTable('detailprix')->findByIdLotsAndIdTypedetailprix($id, 2);
        }

        $marche = Doctrine_Core::getTable('marches')->findOneById($lot->getIdMarche());

        $html = '<div class="titre"><h3 style="font-size:18px;">Fiche Bénéficiaire : ' . $lot->getFournisseur() . '<br>Marchés : ' . $lot->getMarches() . ' - Projet : ' . $marche->getProjet() . '</h3></div>&nbsp;<br>';

        $html .= '<h4><span style="color:#000; font-size:16px;">Fiche Bénéficiaire :</span></h4>
                <h5 style="font-size:14px;">Information Bénéficiaire : ' . $lot->getFournisseur() . '</h5>
                <table class="tableligne" style="width:100%; font-size:12px;">
                    <tbody>
                        <tr>
                            <td style="width: 20%; text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>N°Ordre</b></span></td>
                            <td style="width: 16%"><span style="color:#000">' . $lot->getNordre() . '</span></td>
                            <td style="width: 13%; text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>Marchés</b></span></td>
                            <td style="width: 16%"><span style="color:#000">' . $lot->getMarches() . '</span></td>
                            <td style="width: 10%; text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>Fournisseur</b></span></td>
                            <td style="width: 25%">' . $lot->getFournisseur() . '</td>
                        </tr>
                        <tr>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>TOTAL GENERAL HTVA</b></span></td>
                            <td><span style="color:#000">' . number_format($lot->getTotalht(), 3, ".", ",") . '</span></td>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>TVA</b></span></td>
                            <td><span style="color:#000">' . $lot->getTva() . '</span></td>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>RABAIS</b></span></td>
                            <td><span style="color:#000">' . $lot->getRrr() . '</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>T. G. HTVA APRES RABAIS</b></span></td>
                            <td><span style="color:#000">' . number_format($lot->getTotalapresrrr(), 3, ".", ",") . '</span></td>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>Net à payer TTC</b></span></td>
                            <td><span style="color:#000">' . number_format($lot->getTtcnet(), 3, ".", ",") . '</span></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; height: 50px; background-color:#DEDEDE;"><span style="color:#000"><b>Objet</b></span></td>
                            <td style="text-align:justify;" colspan="5"><span style="color:#000">' . $lot->getObjet() . '</span></td>
                        </tr>
                    </tbody>
                </table>&nbsp;<br>';

        if ($listesDecompltes->count() > 0) {
            $detail_prix = $listesDecompltes->getFirst();

            $totalht = 0;
            $totalapresrrr = 0;
            $rrr = $lot->getRrr();
            $tauxtva = $lot->getTva()->getValeurtva();
            $ttcnet = 0;

            $liste_sous_detail_prix = Doctrine_Core::getTable('sousdetailprix')
                ->createQuery('a')->where('id_detail=' . $detail_prix->getId())
                ->orderBy('id asc')->execute();
            foreach ($liste_sous_detail_prix as $sous_detail_prix) {
                $totalht = $totalht + $sous_detail_prix->getPrixthtva();
            }

            $totalapresrrr = $totalht * (1 - ($rrr / 100));
            $ttcnet = $totalht * (1 + ($tauxtva / 100));

            $restehtax = $lot->getTotalapresrrr();
            $restettc = $lot->getTtcnet();

            $restettc = $restettc - $ttcnet;
            $restehtax = $restettc / (1 + ($tauxtva / 100));
        }

        $html .= '<div>
                    <h5><span style="color:#000; font-size:14px;">Délai & Période :</span></h5>
                    <table class="tableligne" style="width:100%;">
                            <tr>
                                <td style="width:15%;text-align:left;background-color:#DEDEDE;"><span style="color:#000"><b>Date ordre de service :</b></span></td>';
        if ($lot->getDateoservice()):
            $html .= '<td style="width:11%;"><span style="color:#000">' . date('d/m/Y', strtotime($lot->getDateoservice())) . '</span></td>';
        else:
            $html .= '<td style="width:11%;"></td>';
        endif;
        $html .= '<td style = "width:15%;text-align:left;background-color:#DEDEDE;"><span style = "color:#000"><b>Date réception provisoire :</b></span></td>
        <td style = "width:12%"><span style = "color:#000">' . $lot->getDatereceptionprevesoire() . '</span></td>
        <td style = "width:12%;text-align:left;background-color:#DEDEDE;"><span style = "color:#000"><b>Délai d\'exécution :</b></span></td>
                                <td style="width:12%"><span style="color:#000">' . $lot->getDelaidexucution() . '</span></td>
                                <td style="width:12%;text-align:left;background-color:#DEDEDE;"><span style="color:#000"><b>Période d\'arrêt justifié :</b></span></td>
                                <td style="width:11%"><span style="color:#000">' . $lot->getPeriodejustifier() . '</span></td>
                            </tr>
                        <tbody>
                            <tr>
                                <td style="text-align:left;background-color:#DEDEDE;"><span style="color:#000"><b>Délai contractuelle :</b></span></td>
                                <td><span style="color:#000">';
        //if un seul lot donc le delai du contractuelle du lots == delai du marche
        if ($marche->getNbrelot() == 1 || !$marche->getNbrelot()) {
            if (!$lot->getDelaicontractuelle()) {
                $html .= $marche->getDelai();
            }

        } else {
            $html .= $lot->getDelaicontractuelle();
        }

        $html .= '</span></td>
                                <td style="text-align:left;background-color:#DEDEDE;"><span style="color:#000"><b>Période réelle d\'exécution :</b></span></td>
                                <td><span style="color:#000">' . $lot->getPireodereelexecution() . '</span></td>
                                <td style="text-align:left;background-color:#DEDEDE;"><span style="color:#000"><b>Période de retard :</b></span></td>
                                <td><span style="color:#000">' . $lot->getPirioderetard() . '</span></td>
                                <td style="text-align:left;background-color:#DEDEDE;"><span style="color:#000"><b>Pénalité de retard :</b></span></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>&nbsp;<br>';

        foreach ($listesDecompltes as $detailprix) {
            $html .= '<div>
            <h4><span style="color:#000; font-size:16px;">Sous Détail du Prix :</span></h4>';

            $html .= '<table class="tableligne" style="font-size:10px;">
                        <tr>
                            <td style="width:25%; text-align:left;"><span style="color:#000"><b>TOTAL H.TVA :</b> ' . number_format($totalht, 3, ".", ",") . '</span></td>
                            <td style="width:30%; text-align:left;"><span style="color:#000"><b>Rabais, Remises ou Ristourne :</b> ' . $lot->getRrr() . '</span></td>
                            <td style="width:30%; text-align:left;"><span style="color:#000"><b>TOTAL H.TVA APRES RRR :</b> ' . number_format($totalapresrrr, 3, ".", ",") . '</span></td>
                            <td style="width:14%; text-align:left;"><span style="color:#000"><b>T.V.A :</b> ' . $lot->getTva() . '</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:left;"><span style="color:#000"><b>TOTAL T.T.C :</b> ' . number_format($ttcnet, 3, ".", ",") . '</span></td>
                            <td style="text-align:left;"><span style="color:#000"><b>Reste T.T.C :</b> ' . number_format($restettc, 3, ".", ",") . '</span></td>
                            <td style="text-align:left;" colspan="2"><span style="color:#000"><b>Reste H.TAX :</b> ' . number_format($restehtax, 3, ".", ",") . '</span></td>
                        </tr>
                    </table>&nbsp;<br>';

            $html .= '<table class="tableligne" style="width:100%;font-size:10px;">
                <tr style="background-color:#DEDEDE;">
                    <th style="width:172px;"></th>
                    <th style="width:65px;">N° du prix</th>
                    <th style="width:230px;">DESIGNATION DES TRAVAUX</th>
                    <th style="width:120px;">UNITE</th>
                    <th style="width:95px;">Quantité.</th>
                    <th style="width:122px;">Prix unitaire<br>HTVA</th>
                    <th style="width:132px;">Prix Total<br>HTVA</th>
                </tr>
                <tbody>';

            $liste_sous_detail_prix = Doctrine_Core::getTable('sousdetailprix')
                ->createQuery('a')->where('id_detail=' . $detailprix->getId())
                ->orderBy('id asc')->execute();
            foreach ($liste_sous_detail_prix as $sous_detail_prix) {
                $html .= '<tr>
                        <td style="text-align:center;"><span style="color:#000">' . Ucfirst(trim($sous_detail_prix->getTypeavenant())) . '</span></td>
                        <td style="text-align:center;"><span style="color:#000">' . $sous_detail_prix->getNordre() . '</span></td>
                        <td style="text-align:left;"><span style="color:#000">' . $sous_detail_prix->getDesignation() . '</span></td>
                        <td style="text-align:left;"><span style="color:#000">' . $sous_detail_prix->getUnitemarche() . '</span></td>
                        <td style="text-align:center;"><span style="color:#000">' . $sous_detail_prix->getQuetiteant() . '</span></td>
                        <td><span style="color:#000">' . $sous_detail_prix->getPrixunitaire() . '</span></td>';

                if ($sous_detail_prix->getQuetiteant() > 0):
                    $html .= '<td style="text-align:center;"><span style="color:#000">' . number_format($sous_detail_prix->getQuetiteant() * $sous_detail_prix->getPrixunitaire(), 3, ".", ",") . '</span></td>';
                else:
                    $html .= '<td style="text-align:center;"></td>';
                endif;

                $html .= '</tr>';
            }

            $html .= '</tbody>
                </table>
                </div>';
        }

        return $html;
    }

    public function ReadHtmlTableOs($id)
    {

        $lot = LotsTable::getInstance()->find($id);
        $marche = Doctrine_Core::getTable('marches')->findOneById($lot->getIdMarche());

        $html = '<div class="titre"><h3 style="font-size:18px;">Liste des O.S - Bénéficiaire : ' . $lot->getFournisseur() . '<br>Marchés : ' . $lot->getMarches() . ' - Projet : ' . $marche->getProjet() . '</h3></div>&nbsp;<br>';

        $html .= '<h4><span style="color:#000; font-size:16px;">Fiche Bénéficiaire :</span></h4>
                <h5><span style="color:#000; font-size:14px;">Information Bénéficiaire : ' . $lot->getFournisseur() . '</span></h5>
                <table class="tableligne" style="width:100%; font-size:12px;">
                    <tbody>
                        <tr>
                            <td style="width: 20%; text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>N°Ordre</b></span></td>
                            <td style="width: 16%"><span style="color:#000">' . $lot->getNordre() . '</span></td>
                            <td style="width: 13%; text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>Marchés</b></span></td>
                            <td style="width: 16%"><span style="color:#000">' . $lot->getMarches() . '</span></td>
                            <td style="width: 10%; text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>Fournisseur</b></span></td>
                            <td style="width: 25%"><span style="color:#000">' . $lot->getFournisseur() . '</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>TOTAL GENERAL HTVA</b></span></td>
                            <td><span style="color:#000">' . number_format($lot->getTotalht(), 3, ".", ",") . '</span></td>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>TVA</b></span></td>
                            <td><span style="color:#000">' . $lot->getTva() . '</span></td>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>RABAIS</b></span></td>
                            <td><span style="color:#000">' . $lot->getRrr() . '</span></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>T. G. HTVA APRES RABAIS</b></span></td>
                            <td><span style="color:#000">' . number_format($lot->getTotalapresrrr(), 3, ".", ",") . '</span></td>
                            <td style="text-align:left; background-color:#DEDEDE;"><span style="color:#000"><b>Net à payer TTC</b></span></td>
                            <td><span style="color:#000">' . number_format($lot->getTtcnet(), 3, ".", ",") . '</span></td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; height: 50px; background-color:#DEDEDE;"><span style="color:#000"><b>Objet</b></span></td>
                            <td style="text-align:justify;" colspan="5"><span style="color:#000">' . $lot->getObjet() . '</span></td>
                        </tr>
                    </tbody>
                </table>';

        $html .= '<div>
            <h4><span style="color:#000; font-size:16px;">Liste des O.S :</span></h4>';
        $html .= '<table class="tableligne" style="width:100%;font-size:10px;">
                <tr style="background-color:#DEDEDE;">
                    <th style="width:65px;">N°</th>
                    <th style="width:200px;">Type OS</th>
                    <th style="width:181px;">Date Commencement</th>
                    <th style="width:500px;">Objet</th>
                </tr>
                <tbody>';

        $OSS = Doctrine_Core::getTable('ordredeservice')
            ->createQuery('a')->where('id_benificaire=' . $lot->getId())
            ->andwhere('id_type in (1,4,5,6)')
            ->orderBy('id asc')->execute();

        $ordres = new Ordredeservice();
        $i = 0;
        foreach ($OSS as $odsss) {
            $ordres = $odsss;
            $i++;
            $dateaction = "";
            $color = "";
            if ($ordres->getIdType() == "1") {
                $dateaction = "Commencement";
                $color = "#000";
            } elseif ($ordres->getIdType() == "4") {
                $dateaction = "Arrêt";
                $color = "red";
            } elseif ($ordres->getIdType() == "5") {
                $dateaction = "Reprise";
                $color = "green";
            } elseif ($ordres->getIdType() == "6") {
                $dateaction = 'Divers';
                $color = "blue";
            }
            $html .= '<tr>
                            <td style="text-align:center;"><span style="color:#000">' . $i . '</span></td>
                            <td style="text-align:center;"><span style="color:#000">' . $ordres->getTypeios() . '</span></td>
                            <td style="text-align:center;"><span style="color:' . $color . '">' . $dateaction . ' : ' . date('d/m/Y', strtotime($ordres->getDateios())) . '</span></td>
                            <td style="text-align:left;"><span style="color:#000">' . $ordres->getObject() . '</span></td>
                        </tr>';
        }

        $html .= '</tbody>
                </table>
                </div>';

        return $html;
    }

    public function ReadHtmlSeulDecompte($id)
    {

        $detailprix = DetailprixTable::getInstance()->find($id);
        $lot = $detailprix->getLots();
        $array = array("1" => "Janvier", "2" => "Février", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin", "7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Nouvembre", "12" => "Décembre");

        $html = '<div class="titre">
                    <h3 style="font-size:18px;">Détails Décompte ' . $detailprix->getNumero() . ' : ' . $array[intval(date('m', strtotime($detailprix->getDatecreation())))] . '-' . date('Y', strtotime($detailprix->getDatecreation())) . '</h3>
                    <h4 style="text-align: center;">Marchés ' . $lot->getMarches() . '<br>Fournisseur : ' . $lot->getFournisseur() . '</h4>
                </div>&nbsp;<br>';

        $html .= '<div>
            <table class="tableligne" style="width:100%;font-size:10px;">
                <tr style="background-color:#DEDEDE;">
                    <th style="width:50px;" rowspan="2">N° du prix</th>
                    <th style="width:205px;" rowspan="2">DESIGNATION DES TRAVAUX</th>
                    <th style="width:100px;" rowspan="2">UNITE</th>
                    <th style="width:90px;" rowspan="2">Quantité</th>
                    <th style="width:250px;" colspan="3">Quantité</th>
                    <th style="width:120px;" rowspan="2">Prix unitaire<br>HTVA</th>
                    <th style="width:120px;" rowspan="2">Prix Total<br>HTVA</th>
                </tr>
                <tr style="background-color:#DEDEDE;">
                    <th>Antérieur</th>
                    <th>Du Mois</th>
                    <th>Cumulé</th>
                </tr>
                <tbody>';

        $liste_sous_detail_prix = Doctrine_Core::getTable('sousdetailprix')
            ->createQuery('a')->where('id_detail=' . $detailprix->getId())
            ->orderBy('id asc')->execute();
        foreach ($liste_sous_detail_prix as $sous_detail_prix) {
            $html .= '<tr>
                        <td style="text-align:center;">' . $sous_detail_prix->getNordre() . '</td>
                        <td style="text-align:left;">' . $sous_detail_prix->getDesignation() . '</td>
                        <td style="text-align:left;">' . $sous_detail_prix->getUnitemarche() . '</td>
                        <td style="text-align:center;">' . $sous_detail_prix->getQuetiteant() . '</td>';

            if ($sous_detail_prix->getQuetiteant() > 0):
                $html .= '<td style="text-align:center;">' . $detailprix->getMntAntirieur($detailprix->getIdLots(), $sous_detail_prix->getNordre()) . '</td>
		                            <td style="text-align:center;">' . $sous_detail_prix->getQteDuMois() . '</td>
		                            <td style="text-align:center;">' . $sous_detail_prix->getAncienQteDuMois($sous_detail_prix->getNordre()) . '</td>';
            else:
                $html .= '<td style="text-align:center;"></td>
		                            <td style="text-align:center;"></td>
		                            <td style="text-align:center;"></td>';
            endif;

            $html .= '<td>' . $sous_detail_prix->getPrixunitaire() . '</td>';

            if ($sous_detail_prix->getQuetiteant() > 0):
                $html .= '<td style="text-align:center;">' . number_format($sous_detail_prix->getAncienQteDuMois($sous_detail_prix->getNordre()) * $sous_detail_prix->getPrixunitaire(), 3, ".", ",") . '</td>';
            else:
                $html .= '<td style="text-align:center;"></td>';
            endif;

            $html .= '</tr>';
        }

        $html .= '</tbody>
                </table>&nbsp;<br>';

        $montant_tva = $detailprix->getNetapayer() - $detailprix->getHtva();
        $html .= '<table class="tableligne" style="font-size:10px;">
                        <tr>
                            <td style="width:25%; text-align:left;"><b>TOTAL GENERAL</b> ' . $detailprix->getTotalgeneral() . '</td>
                            <td style="width:30%; text-align:left;">' . $lot->getRrr() . ' <b>Rabais, Remises ou Ristourne:</b> ' . $lot->getRrr() . ' : ' . $detailprix->getRrr() . '</td>
                            <td style="width:31.5%; text-align:left;"><b>TOTAL GENERAL HTVA APRES RABAIS</b> ' . $detailprix->getTotalapresremise() . '</td>
                            <td style="width:14%; text-align:left;"><b>T.V.A</b> ' . $lot->getTva() . '</td>
                        </tr>
                        <tr>
                            <td style="text-align:left;"><b>TOTAL T.T.C</b> ' . $detailprix->getTotal() . '</td>
                            <td style="text-align:left;"><b>Avance</b> ' . number_format($lot->getMarches()->getAvance()) . '% <b>sur le montant des travaux</b> ' . $detailprix->getMntavance() . '</td>
                            <td style="text-align:left;"><b>RETENUE DE GARANTIE</b> ' . number_format($lot->getMarches()->getRetenuegaraentie()) . '% : ' . $detailprix->getMntretenue() . '</td>
                            <td style="text-align:left;"><b>TOTAL</b> ' . $detailprix->getNetapayer() . '</td>
                        </tr>
                        <tr>
                            <td style="text-align:left;"><b>DEPENSES ANTERIEURES</b> ' . $detailprix->getDeponse_Antirieur($detailprix->getIdLots()) . '</td>
                            <td style="text-align:left;"><b>Net à payer TTC</b> ' . $detailprix->getNetapayer() . '</td>
                            <td style="text-align:left;"><b>HTVA</b> ' . $detailprix->getHtva() . '</td>
                            <td style="text-align:left;"><b>TVA</b> ' . $lot->getTva() . ' : ' . $montant_tva . '</td>
                        </tr>
                    </table></div>';

        return $html;
    }

}