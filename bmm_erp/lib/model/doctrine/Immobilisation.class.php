<?php

/**
 * Immobilisation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    InventaireTest
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Immobilisation extends BaseImmobilisation {

    public function __toString() {
        return "" . $this->getReference() . " " . $this->getDesignation();
    }

    public function getEmplacement() {
        $donees = "";
        $donees .= "<p><span style='color:#9f191f'>Code Bureaux: </span>" . $this->getBureaux()->getCode() . '<br>';
        $donees .= "<span style='color:#9f191f'>Bureaux: </span>" . $this->getBureaux()->getBureau() . '<br>';
        $donees .= "<span style='color:#9f191f'>Etage:</span> " . $this->getEtage() . " </p>";
        $donees .= "<p><span style='color:#9f191f'>Site:</span> " . $this->getSite() . '<br>';
        $donees .= "<span style='color:#9f191f'>Gouvernorat: </span>" . $this->getGouvernera() . "<br>";
        $donees .= "<span style='color:#9f191f'>Pays:</span> " . $this->getPays() . " <br>";
        $donees .= "<span style='color:#9f191f'>Utilisateur:</span> " . $this->getAgents() . " <br>";
        echo $donees;
    }

    public function getClassificationcomptable() {
        $donees = "";
        $donees .= "<p><span style='color:#ff0084'>Famille:</span> " . $this->getFamille() . '<br>';
        $donees .= "<span style='color:#ff0084'>Sous Famille:</span> " . $this->getSousfamille() . "</p>";
        $donees .= "<p><span style='color:#ff0084'>Date d'acquisation:</span> " . $this->getDateacquisition() . '<br>';
        $donees .= "<span style='color:#ff0084'>Prix d'acquisation:</span> " . $this->getMntttc() . " DT <br>";
        if ($this->getDateacquisition())
            $donees .= "<span style='color:#ff0084'>Année d'acquisation:</span> " . date('Y', strtotime($this->getDateacquisition())) . "<br>";
        else
            $donees .= "<span style='color:#ff0084'>Année d'acquisation:</span><br>";
        $donees .= "<span style='color:#ff0084'>Compte Comptable:</span> " . $this->getPlancomptable()->getNumerocompte() . "<br>";
        echo $donees;
    }

    public function getMntttc1() {
        if ($this->getMntttc())
            return "" . $this->getMntttc() . " DT";
        else
            return "0.000 DT";
    }

    public function getDateacquisition1() {
        return date("d-m-Y", strtotime($this->getDateacquisition()));
    }

    public function getCodebarre($new) {

        if ($new == 0)
            return $this->getReference();
        else {
            $listeimmobilisations = Doctrine_Core::getTable('immobilisation')->findAll();
            $chdate = date("y");
            $chaine = $chdate . count($listeimmobilisations) + 1;
            $listeimmobilisationsfilter = Doctrine_Core::getTable('immobilisation')->findByReference($chaine);
            if (count($listeimmobilisationsfilter) > 0) {
                $chdate = date("y") . date('m') . date('d');
                $chaine = $chdate . count($listeimmobilisations) + 1;
            }
            return $chaine;
        }
    }

    public function getnumerocode($new) {
        if ($new == 0)
            return $this->getnumero();
        else {
            $listeimmobilisations = Doctrine_Core::getTable('immobilisation')->getLastImmobilisation();
            if ($listeimmobilisations != null)
                $chaine = $listeimmobilisations->getId() + 1;
            else
                $chaine = 1;
//            $chaine = $listeimmobilisations[count($listeimmobilisations) - 1]->getId() + 1;
            return $chaine;
        }
    }

    public function CalculeNombreImmob($des, $idb) {
        $listeimmobilisations = Doctrine_Core::getTable('immobilisation')->findByDesignationAndIdBureaux($des, $idb);
        return count($listeimmobilisations);
    }

    public function ReadHtmlFiche($id) {
        $societe = Doctrine_Core::getTable('societe')->findOneById(1);
        $immo = Doctrine_Core::getTable('immobilisation')->findOneById($id);
        $emplacments = EmplacementTable::getInstance()->findByIdImmo($immo->getId());

        $emplacments_html = '';
        foreach ($emplacments as $emplacment):
            $buureau = '';
            if ($emplacment->getIdBureau())
                $buureau = Doctrine_Core::getTable('bureaux')->findOneById($emplacment->getIdBureau());
            $user = '';
            if ($emplacment->getIdUser())
                $user = Doctrine_Core::getTable('agents')->findOneById($emplacment->getIdUser());
            $emplacments_html.='<tr><td>
                                        <table>
                                            <tr><td style="width:26%"><b>Type :</b></td><td style="width:74%">' . $emplacment->getAdresse() . '</td></tr>
                                            <tr><td style="width:26%"><b>Date Affectation :</b></td><td style="width:74%">' . date('d/m/Y', strtotime($emplacment->getDateaffectation())) . '</td></tr>
                                            <tr><td style="width:26%"><b>Bureau :</b></td><td style="width:74%">' . $buureau . '</td></tr>
                                            <tr><td style="width:26%"><b>Utilisateur :</b></td><td style="width:74%">' . $user . '</td></tr>
                                            <tr><td style="width:26%"><b>Référence :</b></td><td style="width:74%">' . $emplacment->getReference() . '</td></tr>
                                        </table>
                                </td></tr>';
        endforeach;

        $date_creation = '';
        if ($immo->getDatecreation())
            $date_creation = date('d/m/Y', strtotime($immo->getDatecreation()));
        $date_service = '';
        if ($immo->getDatemiseenservice())
            $date_service = date('d/m/Y', strtotime($immo->getDatemiseenservice()));
        $date_rebut = '';
        if ($immo->getDatemiseenrebut())
            $date_rebut = date('d/m/Y', strtotime($immo->getDatemiseenrebut()));
        $date_maj = '';
        if ($immo->getDatemisajour())
            $date_maj = date('d/m/Y', strtotime($immo->getDatemisajour()));

        $etat_fiche = '';
        if ($immo->getEtat() == "0")
            $etat_fiche = "Non Valide";
        else
            $etat_fiche = "Valide";

        $duree_utilisation = '';

        date_default_timezone_set("UTC");

        // Time format is UNIX timestamp or
        // PHP strtotime compatible strings

        function dateDiff($time1, $time2, $precision = 6) {
            // If not numeric then convert texts to unix timestamps
            if (!is_int($time1)) {
                $time1 = strtotime($time1);
            }
            if (!is_int($time2)) {
                $time2 = strtotime($time2);
            }

            // If time1 is bigger than time2
            // Then swap time1 and time2
            if ($time1 > $time2) {
                $ttime = $time1;
                $time1 = $time2;
                $time2 = $ttime;
            }

            // Set up intervals and diffs arrays
            $intervals = array('year', 'month', 'day', 'hour', 'minute', 'second');

            $diffs = array();

            // Loop thru all intervals
            foreach ($intervals as $interval) {
                // Set default diff to 0
                $diffs[$interval] = 0;
                // Create temp time from time1 and interval
                $ttime = strtotime("+1 " . $interval, $time1);
                // Loop until temp time is smaller than time2
                while ($time2 >= $ttime) {
                    $time1 = $ttime;
                    $diffs[$interval] ++;
                    // Create new temp time from time1 and interval
                    $ttime = strtotime("+1 " . $interval, $time1);
                }
            }

            $count = 0;
            $times = array();
            // Loop thru all diffs
            foreach ($diffs as $interval => $value) {
                // Break if we have needed precission
                if ($count >= $precision) {
                    break;
                }
                // Add value and interval
                // if value is bigger than 0
                if ($value > 0) {
                    // Add s if value is not 1
                    if ($value != 1) {
                        $interval .= "s";
                    }
                    // Add value and interval to times array
                    $intervals_no['second'] = 'seconde';
                    $intervals_no['seconds'] = 'secondes';

                    $intervals_no['minute'] = 'minute';
                    $intervals_no['minutes'] = 'minutes';

                    $intervals_no['hour'] = 'heure';
                    $intervals_no['hours'] = 'heures';

                    $intervals_no['day'] = 'jour';
                    $intervals_no['days'] = 'jours';

                    $intervals_no['month'] = 'mois';
                    $intervals_no['months'] = 'mois';

                    $intervals_no['year'] = 'an';
                    $intervals_no['years'] = 'ans';

                    $times[] = $value . " " . $intervals_no[$interval];

                    $count++;
                }
            }

            // Return string with times
            return implode(", ", $times);
        }

        $today = date('Y-m-d H:i:s');
        if ($immo->getDatemiseenservice()) {
            $date = $immo->getDatemiseenservice();
            $immo->setDuree(dateDiff($today, $date));
            $immo->save();
            $duree_utilisation = $immo->getDuree();
        } else
            $duree_utilisation = "0 Jour";

        $html = '<h3 style="font-size:18px;">' . $societe->getRs() . '<br>FICHE D\'IMMOBILISATION</h3>
            &nbsp;<br>
            <table>
                <tbody>
                    <tr>
                        <td style="width: 21%; border-right: 1px solide #000;"><h4>FICHE<br>D\'IMMOBILISATION</h4><hr width="96%"></td>
                        <td style="width: 79%;">
                            <table boder="1">
                                <tr>
                                    <td style="width: 16%; height: 25px;"><b>Numéro :</b></td>
                                    <td style="width: 35%;">' . $immo->getNumero() . '</td>
                                    <td style="width: 34%;"><b>Date de création :</b></td>
                                    <td style="width: 15%;">' . $date_creation . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 36%; height: 25px;"><b>Date de mise en service :</b></td>
                                    <td style="width: 15%;">' . $date_service . '</td>
                                    <td style="width: 34%;"><b>Date de mise en rebut :</b></td>
                                    <td style="width: 15%;">' . $date_rebut . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 22%; height: 25px;"><b>Numéro Pièce :</b></td>
                                    <td style="width: 29%;">' . $immo->getNumeropiece() . '</td>
                                    <td style="width: 19%;"><b>Type Pièce :</b></td>
                                    <td style="width: 30%;">' . $immo->getTypepiece() . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 16%; height: 20px;"><b>Emetteur :</b></td>
                                    <td style="width: 49%;">' . $immo->getUtilisateur() . '</td>
                                    <td style="width: 20%;"><b>Date de MAJ :</b></td>
                                    <td style="width: 15%;">' . $date_maj . '</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <tbody>
            </table>&nbsp;<br>&nbsp;<br>
            <table>
                <tbody>
                    <tr>
                        <td style="width: 21%; border-right: 1px solide #000;"><h4>DONNEES DE BASE</h4><hr width="96%"></td>
                        <td style="width: 79%;">
                            <table boder="1">
                                <tr>
                                    <td style="width: 13%; height: 38px;"><b>Code Immo. :</b></td>
                                    <td style="width: 18%;">' . $immo->getReference() . '</td>
                                    <td style="width: 19%;"><b>Désignation :</b></td>
                                    <td style="width: 50%;">' . $immo->getDesignation() . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height: 20px;"><b>Fournisseur :</b></td>
                                    <td style="width: 30%;">' . $immo->getFournisseur() . '</td>
                                    <td style="width: 20%;"><b>Fabriquant :</b></td>
                                    <td style="width: 30%;">' . $immo->getFabricant() . '</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <tbody>
            </table>&nbsp;<br>&nbsp;<br>
            <table>
                <tbody>
                    <tr>
                        <td style="width: 21%; border-right: 1px solide #000;"><h4>DONNEES DE<br>CLASSIFICATION</h4><hr width="96%"></td>
                        <td style="width: 79%;">
                            <table boder="1">
                                <tr>
                                    <td style="width: 20%; height: 25px;"><b>Catégorie :</b></td>
                                    <td style="width: 80%;">' . $immo->getCategoerie() . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height: 25px;"><b>Famille :</b></td>
                                    <td style="width: 80%;">' . $immo->getFamille() . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%; height: 20px;"><b>Sous Famille :</b></td>
                                    <td style="width: 80%;">' . $immo->getSousfamille() . '</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <tbody>
            </table>&nbsp;<br>&nbsp;<br>
            <table>
                <tbody>
                    <tr>
                        <td style="width: 21%; border-right: 1px solide #000;"><h4>DONNEES<br>D\'AFFECTATION</h4><hr width="96%"></td>
                        <td style="width: 79%;">
                            <table boder="1">
                                <tr>
                                    <td style="width: 11%; height: 25px;"><b>Pays :</b></td>
                                    <td style="width: 37%;">' . $immo->getPays() . '</td>
                                    <td style="width: 21%;"><b>Gouvernorat :</b></td>
                                    <td style="width: 31%;">' . $immo->getGouvernera() . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 11%; height: 25px;"><b>Site :</b></td>
                                    <td style="width: 37%;">' . $immo->getSite() . '</td>
                                    <td style="width: 21%;"><b>Emplacement :</b></td>
                                    <td style="width: 31%;">' . $immo->getEtage() . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 17%; height: 25px;"><b>Bureau :</b></td>
                                    <td style="width: 83%;">' . $immo->getBureaux() . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 17%; height: 25px;"><b>Utilisateur :</b></td>
                                    <td style="width: 83%;">' . $immo->getAgents() . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 17%; height: 25px;"><b>Adresse :</b></td>
                                    <td style="width: 83%;">' . $immo->getAdresse() . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%; height: 30px;"><b>Type Affectation :</b></td>
                                    <td style="width: 75%;">' . $immo->getTypeaffectationimmo() . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 100%;">
                                        <table border="1" cellpadding="3">
                                            <tr><td style="text-align:center;background-color:#DEDEDE;">Affectation Emplacement</td></tr>
                                            ' . $emplacments_html . '
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <tbody>
            </table>&nbsp;<br>&nbsp;<br>
            <table>
                <tbody>
                    <tr>
                        <td style="width: 21%; border-right: 1px solide #000;"><h4>DONNEES<br>COMPTABLES</h4><hr width="96%"></td>
                        <td style="width: 79%;">
                            <table boder="1">
                                <tr>
                                    <td style="width: 28%; height: 25px;"><b>Date d\'acquisition :</b></td>
                                    <td style="width: 23%;">' . date('d/m/Y', strtotime($immo->getDateacquisition())) . '</td>
                                    <td style="width: 30%;"><b>Compte Comptable :</b></td>
                                    <td style="width: 19%;">' . $immo->getPlancomptable()->getNumerocompte() . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 36%; height: 25px;"><b>Date de mise en service :</b></td>
                                    <td style="width: 15%;">' . $date_service . '</td>
                                    <td style="width: 34%;"><b>Date de mise en rebut :</b></td>
                                    <td style="width: 15%;">' . $date_rebut . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 16%; height: 30px;"><b>Emetteur :</b></td>
                                    <td style="width: 49%;">' . $immo->getUtilisateur() . '</td>
                                    <td style="width: 20%;"><b>Date de MAJ :</b></td>
                                    <td style="width: 15%;">' . $date_maj . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 100%;">
                                        <table border="1" cellpadding="3">
                                            <tr><td style="text-align:center;background-color:#DEDEDE;">Prix d\'acquisition</td></tr>
                                            <tr>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td style="width: 15%; height: 43px;"><b>MT HTVA :</b></td>
                                                            <td style="width: 17%; text-align:right;">' . $immo->getPrixhtva() . '</td>
                                                            <td style="width: 2%;"></td>
                                                            <td style="width: 28%;"><b>Taux d\'amortisement :</b></td>
                                                            <td style="width: 38%;">' . $immo->getTauxammortisement() . '</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 15%; height: 43px;"><b>TVA :</b></td>
                                                            <td style="width: 17%; text-align:right;">' . $immo->getTva() . '%</td>
                                                            <td style="width: 2%;"></td>
                                                            <td style="width: 28%;"><b>Mode d\'amortisement :</b></td>
                                                            <td style="width: 38%;">' . $immo->getModeammortisement() . '</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 15%; height: 43px;"><b>MT TTC :</b></td>
                                                            <td style="width: 17%; text-align:right;">' . $immo->getMntttc() . '</td>
                                                            <td style="width: 2%;"></td>
                                                            <td style="width: 28%;"><b>Source de Financement :</b></td>
                                                            <td style="width: 38%;">' . $immo->getSourcefinancement() . '</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>&nbsp;<br>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 45%; height: 25px;"><b>Nature de l\'immobilisation :</b></td>
                                    <td style="width: 55%;">' . $immo->getNature() . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%; height: 25px;"><b>Durée d\'utilisation :</b></td>
                                    <td style="width: 70%;">' . $duree_utilisation . '</td>
                                </tr>
                                <tr>
                                    <td style="width: 18%; height: 20px;"><b>Etat Fiche :</b></td>
                                    <td style="width: 82%;">' . $etat_fiche . '</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <tbody>
            </table>&nbsp;<br>&nbsp;<br>';

        return $html;
    }

    public function ReadHtmlListeBarcode($id) {
        $bureau = Doctrine_Core::getTable('bureaux')->findOneById($id);
        $immobilisations = ImmobilisationTable::getInstance()->findByIdBureaux($id);

        $html = '<h3 style="font-size:18px;">FICHE D\'IMMOBILISATION / ' . $bureau . '</h3>
            &nbsp;<br>';

        $html.='<table border="1" cellspace="0" cellpadding="3">
                    <tr style="background-color:#ECECEC;">
                        <td style="width:30%;height:25px;text-align:center;"><b>Emplacement</b></td>
                        <td style="width:30%;text-align:center;"><b>Immob.</b></td>
                        <td style="width:15%;text-align:center;"><b>Réference</b></td>
                        <td style="width:25%;text-align:center;"><b>Code à barre</b></td>
                    </tr>';

        if ($immobilisations->count() != 0):
            foreach ($immobilisations as $immobilisation):
                if ($immobilisation->getDatemiseenrebut() == "" || $immobilisation->getDatemiseenrebut() == "0000-00-00") {
                    $emplacment_codebarre = EmplacementTable::getInstance()->findOneByIdBureauAndIdImmo($immobilisation->getIdBureaux(), $immobilisation->getId());
                    $cheminfile = sfconfig::get('codebarre') . "/";

                    if ($emplacment_codebarre){
                           $html.='<tr style="font-size:10px;">
                                <td style="height:25px;">' . $emplacment_codebarre . '<br>' . $immobilisation->getReference() . '</td>
                                <td>' . $immobilisation->getDesignation() . '</td>
                                <td style="text-align:center;">' . $emplacment_codebarre->getReference() . '</td>
                                <td style="text-align:center;"><h5 style="font-size:4px;">&nbsp;</h5>';
                    if (file_exists($cheminfile . $emplacment_codebarre->getReference() . ".png")) {
                        $html.=' <img src="' . sfconfig::get('sf_appdir') . 'codebarre/' . $emplacment_codebarre->getReference() . '.png" width="150" height="150"></td>';
                      
                        
                    }
                    }
                     

                    $html .= ' </tr>';
                }
            endforeach;
        else:
            $html.='<tr>
                        <td style="width:100%;height:20px;text-align:center;">Pas d\'articles</td>
                    </tr>';
        endif;

        $html.='</table>';
       return $html;
    }

    public function ReadHtmlListeType($id) {
        $type = TypeaffectationimmoTable::getInstance()->find($id);
        $conn = Doctrine_Manager::getInstance()->getCurrentConnection();
        $query = "SELECT immobilisation.id, numero, designation, dateacquisition, mntttc, famille.famille, sousfamille.sousfamille"
                . " FROM immobilisation, famille, sousfamille "
                . " WHERE id_typeaffectationimmo = " . $id . " "
                . " AND immobilisation.id_famille = famille.id "
                . " AND immobilisation.id_sousfamille = sousfamille.id "
                . " ORDER BY designation, numero";
        $immobilisations = $conn->fetchAssoc($query);

        $html = '<h3 style="font-size:18px;">Liste des Immobilisation<br><span style="font-size:16px;">Type Affectation : ' . $type . '</span></h3>
            &nbsp;<br>';

        $html.='<table border="1" cellspace="0" cellpadding="3">
                    <tr style="background-color:#ECECEC;">
                        <td style="width:4%;height:25px;text-align:center;"><b>#</b></td>
                        <td style="width:7%;text-align:center;"><b>Numéro</b></td>
                        <td style="width:26%;text-align:center;"><b>Immobilisation</b></td>
                        <td style="width:9%;text-align:center;"><b>Date<br>Acquisition</b></td>
                        <td style="width:9%;text-align:center;"><b>Prix<br>Acquisition</b></td>
                        <td style="width:25%;text-align:center;"><b>Famille</b></td>
                        <td style="width:20%;text-align:center;"><b>Sous Famille</b></td>
                    </tr>';

        if (sizeof($immobilisations) != 0):
            $k = 0;
            for ($i = 0; $i < sizeof($immobilisations); $i++):
                $date_aquisition = '';
                if ($immobilisations[$i]['dateacquisition'] != null)
                    $date_aquisition = date('d/m/Y', strtotime($immobilisations[$i]['dateacquisition']));
                $k = $i + 1;
                $html.='<tr style="font-size:10px;">
                                <td style="text-align:center;height:25px;">' . $k . '</td>
                                <td style="text-align:center;">' . $immobilisations[$i]['numero'] . '</td>
                                <td>' . $immobilisations[$i]['designation'] . '</td>
                                <td style="text-align:center;">' . $date_aquisition . '</td>
                                <td style="text-align:right;">' . number_format($immobilisations[$i]['mntttc'], 3, '.', ' ') . '</td>
                                <td>' . $immobilisations[$i]['famille'] . '</td>
                                <td>' . $immobilisations[$i]['sousfamille'] . '</td>
                        </tr>';
            endfor;
        else:
            $html.='<tr>
                        <td style="width:100%;height:20px;text-align:center;">Pas d\'immobilisations</td>
                    </tr>';
        endif;

        $html.='</table>';
        return $html;
    }

}
