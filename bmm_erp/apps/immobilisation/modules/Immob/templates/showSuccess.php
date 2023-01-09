<div class="col-lg-12" style="margin-top: 2%">
    <div style="margin-top: 5px">
        <div id="sf_admin_container" class="panel panel-green">
            <h1>FICHE D'IMMOBILISATION</h1>
            <div id="sf_admin_content">
                <?php
                $immo = new Immobilisation();
                $immo = $immobilisation;
                ?>
                <fieldset id="noscript">
                    <legend></legend>
                    <table>
                        <tbody>
                            <tr>
                                <td><label>Numéro</label></td>
                                <td><?php echo $immo->getNumero(); ?></td>
                                <td><label>Date de création </label></td>
                                <td><?php echo $immo->getDatecreation(); ?></td>
                            </tr>
                            <tr>
                                <td><label>Numéro Pièce</label></td>
                                <td><?php echo $immo->getNumeropiece(); ?></td>
                                <td><label>Type Pièce </label></td>
                                <td><?php echo $immo->getTypepiece(); ?></td>
                            </tr>
                            <tr>
                                <td><label>Emetteur</label></td>
                                <td><?php echo $immo->getUtilisateur(); ?></td>
                                <td><label>Date de MAJ </label></td>
                                <td><?php echo $immo->getDatemisajour(); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
                <fieldset id="noscript1">
                    <legend>DONNEES DE BASE</legend>
                    <table>
                        <tbody>
                            <tr>
                                <td><label>Code Immo</label></td>
                                <td><?php echo $immo->getReference(); ?></td>
                                <td><label>Désignation </label></td>
                                <td><?php echo $immo->getDesignation(); ?></td>
                            </tr>
                            <tr>
                                <td><label>Fournisseur</label></td>
                                <td><?php echo $immo->getFournisseur() ?></td>
                                <td><label>Fabricant </label></td>
                                <td><?php echo $immo->getFabricant() ?></td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
                <fieldset id="noscript4">
                    <legend>DONNEES DE CLASSIFICATION</legend>
                    <table>
                        <tbody>
                            <tr>
                                <td><label>Catégorie</label></td>
                                <td><?php echo $immo->getCategoerie() ?></td>
                                <td><label>Famille </label></td>
                                <td><?php echo $immo->getFamille(); ?></td>
                            </tr>
                            <tr>
                                <td><label>Sous Famille</label></td>
                                <td colspan="3"><?php echo $immo->getSousfamille() ?></td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
                <fieldset id="noscript2">
                    <legend>DONNEES DE D'AFFECTATION</legend>
                    <table>
                        <tbody>
                            <tr>
                                <td><label>Pays</label></td>
                                <td><?php echo $immo->getPays() ?></td>
                                <td><label>Gouvernorat </label></td>
                                <td><?php echo $immo->getGouvernera() ?></td>
                            </tr>
                            <tr>
                                <td><label>Site</label></td>
                                <td><?php echo $immo->getSite() ?></td>
                                <td><label>Etage </label></td>
                                <td><?php echo $immo->getEtage() ?></td>
                            </tr>
                            <tr>
                                <td><label>Bureau</label></td>
                                <td colspan="3"><?php echo $immo->getBureaux() ?></td>
                            </tr>
                            <tr>
                                <td><label>Utilisateur</label></td>
                                <td><?php echo $immo->getAgents() ?></td>
                                <td><label>Adresse </label></td>
                                <td><?php echo $immo->getAdresse() ?></td>
                            </tr>
                            <tr>
                                <td><label>Type Affectation</label></td>
                                <td><?php echo $immo->getTypeaffectationimmo() ?></td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table style="margin-bottom: 0px;">
                                        <thead>
                                            <tr><th colspan="2">Gestion des Transferts</th></tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><label>Affectation Emplacement</label></td>
                                                <td>
                                                    <?php
                                                    $emplacments = Doctrine_Core::getTable('emplacement')->findByIdImmo($immo->getId());
                                                    $emplacment = new Emplacement();
                                                    foreach ($emplacments as $empl) {
                                                        $emplacment = $empl;
                                                        ?>
                                                        <div class="col-md-3">
                                                            <table style="margin-bottom: 0px; margin-top: 10px;">
                                                                <tr>
                                                                    <td style="<?php if (trim($emplacment->getAdresse()) == 'Transfert'): ?>background-color: #E4F3FF;<?php else: ?>background-color: #c6f2d2;<?php endif; ?>"><?php echo $emplacment->getAdresse(); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><?php echo $emplacment->getDateaffectation(); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php
                                                                        if ($emplacment->getIdBureau()) {
                                                                            $buureau = Doctrine_Core::getTable('bureaux')->findOneById($emplacment->getIdBureau());
                                                                            if ($buureau)
                                                                                echo $buureau;
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php
                                                                        if ($emplacment->getIdUser()) {
                                                                            $user = Doctrine_Core::getTable('agents')->findOneById($emplacment->getIdUser());
                                                                            if ($user)
                                                                                echo $user;
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><?php echo $emplacment->getReference(); ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
                <fieldset id="noscript3">
                    <legend>DONNEES COMPTABLES</legend>
                    <table>
                        <tbody>
                            <tr>
                                <td><label>Date d'acquisition</label></td>
                                <td><?php echo $immo->getDateacquisition() ?></td>
                                <!--<td><label>Compte Comptable </label></td>-->
                                <!--<td><?php //if($immo->getPlancomptable() && $immo->getPlancomptable()->getNumerocompte() ) echo $immo->getPlancomptable()->getNumerocompte(); ?></td>-->
                            </tr>
                            <tr>
                                <td><label>Prix d'acquisition</label></td>
                                <td>
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td><label>MT HTVA </label></td>
                                            <td><?php echo $immo->getPrixhtva() ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>TVA </label></td>
                                            <td><?php echo $immo->getTva() ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>MT TTC </label></td>
                                            <td><?php echo $immo->getMntttc(); ?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td colspan="2">
                                    <table style="margin-bottom: 0px;">
                                        <tr>
                                            <td><label>Taux d'amortissement</label></td>
                                            <td><?php echo $immo->getTauxammortisement(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Mode d'amortissement</label></td>
                                            <td><?php echo $immo->getModeammortisement(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>Source de Financement</label></td>
                                            <td><?php echo $immo->getSourcefinancement() ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Nature de l'immobilisation </label></td>
                                <td colspan="3"><?php echo $immo->getNature() ?></td>
                            </tr>
                            <tr>
                                <td><label>Durée d'utilisation </label></td>
                                <td colspan="3">
                                    <?php
                                    // Set timezone
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

//  $time1=strtotime($immo->getDatecreation());
//  $time2=strtotime(date("Y-m-d h:i:s"));
//  echo date("Y-m-d h:i:s",$time1)."<br>".date('Y-m-d h:i:s',$time2)."<br>";
                                    $today = date('Y-m-d H:i:s');
                                    if ($immo->getDatemiseenservice()) {
                                        $date = $immo->getDatemiseenservice();
                                        $immo->setDuree(dateDiff($today, $date));
                                        $immo->save();
                                        echo $immo->getDuree();
                                    } else
                                        echo "0 Jour";
                                    // echo dateDiff($today, $date) . "\n";
                                    ?>

                                </td>
                            </tr>
                            <tr>
                                <td><label>Etat Fiche</label></td>
                                <td colspan="3">
                                    <?php
                                    if ($immo->getEtat() == "0")
                                        echo "Non Valide";
                                    else
                                        echo "Valide";
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
                <table>
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                &nbsp;<a class="btn btn-white btn-success" href="<?php echo url_for('immobilisation/index') ?>">Liste d'immob.</a>
                                &nbsp;<a class="btn btn-white btn-primary" href="<?php echo url_for('Immob/show?id=' . $immo->getId() . "&page=immp") ?>">Imprimer</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- /.panel -->
</div>