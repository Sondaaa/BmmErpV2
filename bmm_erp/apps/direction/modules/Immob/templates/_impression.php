<?php
if (($sf_user->getAttribute('userB2m'))) {
    ?>
    <script  type="text/javascript">
        document.location.href = "<?php echo url_for('@deconnect') ?>";
    </script>

<?php } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />

        <style>
            @page{
                size: portrait;
            }
        </style>

    </head>
    <body>
        <div id="wrapper">
            <div>
                <?php $societe = Doctrine_Core::getTable('societe')->findOneById(1); ?>
                <h4><?php echo $societe->getRs(); ?> FICHE D'IMMOBILISATION</h4>
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
                                    <td><label>Date de mise en service</label></td>
                                    <td><?php echo $immo->getDatemiseenservice(); ?></td>
                                    <td><label>Date de mise en rebut </label></td>
                                    <td><?php echo $immo->getDatemiseenrebut(); ?></td>
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
                                    <td><label>Fabriquant </label></td>
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
                        <legend>DONNEES D'AFFECTATION</legend>
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
                                    <td><label>Emplacement </label></td>
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
                                    <td colspan="4">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th colspan="2">Gestion des Transferts</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><label>Affectation Emplacement</label></td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <?php
                                                                $emplacments = Doctrine_Core::getTable('emplacement')->findByIdImmo($immo->getId());
                                                                $emplacment = new Emplacement();
                                                                foreach ($emplacments as $empl) {
                                                                    $emplacment = $empl;
                                                                    ?>
                                                                    <td>
                                                                        <table>
                                                                            <tr>
                                                                                <td><?php echo $emplacment->getAdresse(); ?></td>
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
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>

                                                        </table>
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
                                    <td height="20"><label>Date d'acquisition</label></td>
                                    <td height="20"><?php echo $immo->getDateacquisition() ?></td>
                                    <td height="20"><label>Compte Comptable </label></td>
                                    <td height="20"><?php echo $immo->getPlancomptable()->getNumerocompte(); ?></td>
                                </tr>
                                <tr>
                                    <td><label>Prix d'acquisition</label></td>
                                    <td>
                                        <table>
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
                                        <table>
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
                        <div align="right" style="margin-top: -10px">
                            <?php echo date('Y-m-d H:i', time()); ?>
                        </div>
                    </fieldset>
                </div>

                <script src="<?php echo sfconfig::get('sf_appdir') ?>bower_components/jquery/dist/jquery.min.js"></script>
                <script  type="text/javascript">

        window.print();

        var myVar = setInterval(function () {
            chargement();
        }, 1);

        var x = 1;
        function chargement() {
            if (document.readyState == "complete") {
                if (x == 1) {
                    document.location = "<?php echo url_for(array('module' => 'immobilisation', 'action' => 'index')) ?>";
                }
                x++;
            }
        }

                </script>
            </div>
            <!-- /.panel -->
            <!-- /.col-lg-12 -->
        </div>
        <!-- jQuery -->
    </body>
</html>