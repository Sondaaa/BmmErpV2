<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php
$msg = "";
if (isset($_GET['msg'])) {
    if ($_GET['meth'] == 1)
        $msg = "Votre Mise à jour de l'immobilisation: " . $_GET['msg'] . "<br> a été efféctuée avec succès";
    else {
        $msg = "Votre Mise à jour de l'immobilisation: " . $_GET['msg'] . "<br> a été efféctuée avec succès";
        $msg .= "<br>Ajouter d'autre immobilisation!!!";
    }
}
if ($msg != "") {
    ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $msg; ?>
    </div>
<?php } ?>
<style>
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }
    legend.scheduler-border {
        width:inherit; /* Or auto */
        padding:0 10px; /* To give a bit of padding on the left and right */
        border-bottom:none;
    }

</style>
<style>
    ul li {
        cursor: pointer;
    }

    .testul ul {
        margin: 0 auto;
        padding: 0;
        max-height: 150px;
        position: absolute;
        overflow-y: auto;
        border: 1px solid rgba(0, 0, 0, 0.5);
        padding: 5px 5px 0 5px;
        border-left: 1px solid rgba(0, 0, 0, 0.5);
        border-right: 1px solid rgba(0, 0, 0, 0.5);
        background-color: white;
        position: absolute;
    }

    .testul li {
        list-style: none;
        width: 100%;

    }

</style>
<form ng-app="myApp" ng-controller="myCtrl" action="<?php echo url_for('Immob/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <fieldset id="noscript">
        <legend></legend>
        <table>
            <tbody>
                <tr>
                    <td><label>Numéro</label></td>
                    <td>
                        <?php echo $form['numero']->renderError() ?>
                        <?php echo $form['numero'] ?>
                    </td>
                    <td>
                        <label>Date de création </label>
                    </td>
                    <td>
                        <?php echo $form['datecreation']->renderError() ?>
                        <?php echo $form['datecreation'] ?>
                    </td>
                </tr>
                <tr>
                    <td><label>Date De Mise En Service</label></td>
                    <td>
                        <?php echo $form['datemiseenservice']->renderError() ?>
                        <?php echo $form['datemiseenservice'] ?>
                    </td>
                    <td>
                        <label>Date De Mise En Rebut</label>
                    </td>
                    <td>
                        <?php echo $form['datemiseenrebut']->renderError() ?>
                        <?php echo $form['datemiseenrebut'] ?>
                    </td>
                </tr>
                <tr>
                    <td><label>Numéro Pièce</label></td>
                    <td>
                        <?php echo $form['numeropiece']->renderError() ?>
                        <?php echo $form['numeropiece'] ?>
                    </td>
                    <td>
                        <label>Type Pièce</label>
                    </td>
                    <td>
                        <?php echo $form['typepiece']->renderError() ?>
                        <?php echo $form['typepiece'] ?>
                    </td>
                </tr>
                <tr>
                    <td><label>Emetteur</label></td>
                    <td>
                        <?php echo $form['id_user']->renderError() ?>
                        <?php echo $form['id_user'] ?>
                    </td>
                    <td>
                        <label>Date de MAJ </label>
                    </td>
                    <td>
                        <?php echo $form['datemisajour']->renderError() ?>
                        <?php echo $form['datemisajour'] ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
    <fieldset id="noscript1" >
        <legend>DONNEES DE BASE</legend>
        <table>
            <tbody>
                <tr>
                    <td><label>Code Immo.</label></td>
                    <td>
                        <?php echo $form['reference']->renderError() ?>
                        <?php echo $form['reference'] ?>
                    </td>
                    <td>
                        <label>Désignation</label>
                    </td>
                    <td>
                        <?php echo $form['designation']->renderError() ?>
                        <?php echo $form['designation'] ?>

                        <div class="testul">
                            <ul style="display: none" id="sltdesc" ng-model="desc">
                                <li ng-repeat="d in descs| filter : filterdesc"  ng-mousedown="selectedDesc(d.nom, d.famille, d.sousfamille, d.categorie)">
                                    {{d.nom}}
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><label>Fournisseur</label></td>
                    <td colspan="4">
                        <table>
                            <tr>
                                <td>
                                    <?php echo $form['id_fournisseur']->renderError() ?>
                                    <?php echo $form['id_fournisseur'] ?>
                                    <input type="hidden" id="idfrs" name="idfrs" value="-1">
                                </td>
                                <td>
                                    <input type="button" class="btn btn-outline btn-info" ng-click="AjouterFournisseur()" value="+Ajouter Fournisseur">
                                </td>
                            </tr>
                            <tr id="frmfournisseur" style="display: none" >
                                <td colspan="2">
                                    <div  class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <div id="msgfrs"></div>
                                    </div>
                                    <table>
                                        <tr>
                                            <td>Nom</td>
                                            <td><input class="form-control" type="text" ng-model="txt_nomf"></td>
                                            <td>Prénom</td>
                                            <td><input class="form-control" type="text" ng-model="txt_prenomf"></td>
                                        </tr>
                                        <tr>
                                            <td>Référence</td>
                                            <td><input class="form-control" type="text" ng-model="txt_reff"></td>
                                            <td>RS</td>
                                            <td><input class="form-control" type="text" ng-model="txt_rsf"></td>
                                        </tr>
                                        <tr>
                                            <td>Mail</td>
                                            <td><input class="form-control" type="text" ng-model="txt_mailf"></td>
                                            <td>Tel</td>
                                            <td><input class="form-control" type="text" ng-model="txt_telf"></td>
                                        </tr>
                                        <tr>
                                            <td>Gsm</td>
                                            <td><input class="form-control" type="text" id="txt_gsmf"></td>
                                            <td colspan="2"><input class="btn btn-outline btn-warning" ng-click="ValiderFrs()" type="button" value="Ajouter"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Fabricant</label>
                    </td>
                    <td colspan="4">
                        <?php echo $form['id_fabricant']->renderError() ?>
                        <?php echo $form['id_fabricant'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Nature de l'immobilisation</label>
                    </td>
                    <td colspan="4">
                        <?php echo $form['id_nature']->renderError() ?>
                        <?php echo $form['id_nature'] ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
    <fieldset id="noscript4" >
        <legend>DONNEES DE CLASSIFICATION</legend>
        <table>
            <tbody>
                <tr>
                    <td><label>Catégorie</label></td>
                    <td>
                        <?php echo $form['id_categorie']->renderError() ?>
                        <?php echo $form['id_categorie'] ?>
                    </td>
                    <td>
                        <label>Famille</label>
                    </td>
                    <td>
                        <?php echo $form['id_famille']->renderError() ?>
                        <?php echo $form['id_famille'] ?>
                    </td>
                </tr>
                <tr>
                    <td><label>Sous Famille</label></td>
                    <td colspan="3">
                        <?php echo $form['id_sousfamille']->renderError() ?>
                        <?php echo $form['id_sousfamille'] ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
    <fieldset id="noscript2" >
        <legend>DONNEES D'AFFECTATION</legend>
        <table>
            <tbody>
                <tr>
                    <td><label>Pays</label></td>
                    <td>
                        <?php echo $form['id_pays']->renderError() ?>
                        <?php echo $form['id_pays'] ?>
                    </td>
                    <td>
                        <label>Gouvernorat </label>
                    </td>
                    <td>
                        <?php echo $form['id_gouvernera']->renderError() ?>
                        <?php echo $form['id_gouvernera'] ?>
                    </td>
                </tr>
                <tr>
                    <td><label>Site</label></td>
                    <td>
                        <?php echo $form['id_site']->renderError() ?>
                        <?php echo $form['id_site'] ?>
                    </td>
                    <td>
                        <label>Emplacement</label>
                    </td>
                    <td>
                        <?php echo $form['id_etage']->renderError() ?>
                        <?php echo $form['id_etage'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Bureau</label>
                    </td>
                    <td colspan="3">
                        <?php echo $form['id_bureaux']->renderError() ?>
                        <?php echo $form['id_bureaux'] ?>
                    </td>
                </tr>
                <tr>
                    <td><label>Utilisateur</label></td>
                    <td>
                        <?php echo $form['id_agent']->renderError() ?>
                        <?php echo $form['id_agent'] ?>
                    </td>
                    <td>
                        <label>Adresse</label>
                    </td>
                    <td>
                        <?php echo $form['adresse']->renderError() ?>
                        <?php echo $form['adresse'] ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <?php if (!$form->getObject()->isNew()) { ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th colspan="2">Gestion des Transferts</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <label>Affectation Emplacement</label>
                                        </td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <?php
                                                    $emplacments = Doctrine_Core::getTable('emplacement')->findByIdImmo($form->getObject()->getId());
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
                                                                    <td><?php
                                                                        if ($emplacment->getIdBureau()) {
                                                                            $buureau = Doctrine_Core::getTable('bureaux')->findOneById($emplacment->getIdBureau());
                                                                            if ($buureau)
                                                                                echo $buureau;
                                                                        }
                                                                        ?></td>
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
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td><label>Valider Transfert</label></td>
                    <td colspan="3"><input type="checkbox" name="check" > </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
    <fieldset id="noscript3" >
        <legend>DONNEES COMPTABLES</legend>
        <table>
            <tbody>
                <tr>
                    <td><label>Date d'acquisition</label></td>
                    <td>
                        <?php echo $form['dateacquisition']->renderError() ?>
                        <?php echo $form['dateacquisition'] ?>
                    </td>
                    <td>
                        <label>Compte Comptable</label>
                    </td>
                    <td>
                        <?php echo $form['comptecomptabel']->renderError() ?>
                        <?php echo $form['comptecomptabel'] ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Prix d'acquisition</label>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <label>MT HTVA </label>
                                </td>
                                <td>
                                    <?php echo $form['prixhtva']->renderError() ?>
                                    <?php echo $form['prixhtva'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>TVA </label>
                                </td>
                                <td>
                                    <?php echo $form['tva']->renderError() ?>
                                    <?php echo $form['tva'] ?>%
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>MT TTC </label>
                                </td>
                                <td>
                                    <?php echo $form['mntttc']->renderError() ?>
                                    <?php echo $form['mntttc'] ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    <label>
                                        Mode d'amortisement
                                    </label>
                                </td>
                                <td>
                                    <?php echo $form['modeamortisement']->renderError() ?>
                                    <?php echo $form['modeamortisement'] ?>
                                </td>
                            </tr>
                            <tr  id="id_tauxammortisment1">
                                <td>
                                    <label>Taux d'amortisement</label>
                                </td>
                                <td>
                                    <?php echo $form['tauxammortisement']->renderError() ?>
                                    <?php echo $form['tauxammortisement'] ?>
                                </td>
                            </tr>
                            <tr style="display: none" id="id_tauxammortisment2">
                                <td>
                                    <label>Taux d'amortisement</label>
                                </td>
                                <td>
                                    <?php echo $form['tauxammor2']->renderError() ?>
                                    <?php echo $form['tauxammor2'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Source de Financement</label>
                                </td>
                                <td>
                                    <input type="text" name="sourcefinancement" ng-model="sourcefinancement" value="" class="form-control" ng-change="ChangerSourcefin();">
                                    <div class="testul">
                                        <ul style="display: none" id="ulsource" ng-model="ulsource">
                                            <li ng-repeat="ls in listedessource"  >
                                                {{ls.source}}
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
    <fieldset id="noscript5" >
        <legend>DONNEES DAF</legend>
        <table>
            <?php if (!$form->getObject()->isnew()) { ?>
                <tr>
                    <td><label>Durée D'utilisation</label></td>
                    <td>
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

                        $immo = $form->getObject();
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
            <?php } ?>
            <tr>
                <td><label>Validation Fiche</label></td>
                <td>
                    <?php echo $form['etat']->renderError() ?>
                    <?php echo $form['etat'] ?>
                </td>
            </tr>
        </table>
    </fieldset>
    <table>
        <tfoot>
            <tr>
                <td colspan="2">
                    &nbsp;<a class="btn btn-white btn-primary" href="<?php echo url_for('immobilisation/index') ?>">Liste d'immob.</a>
                    &nbsp;<a class="btn btn-white btn-warning" href="<?php echo url_for('Immob/show?id=' . $form->getObject()->getId() . "&page=immp") ?>">Impprimer</a>
                    <input class="btn btn-white btn-success" type="submit" value="Valider" />
                </td>
            </tr>
        </tfoot>
        <tbody>

        </tbody>
    </table>
</form>

<script  type="text/javascript">
    var selectmode = document.getElementById('immobilisation_modeamortisement');
    modeamortisment = selectmode.options[selectmode.selectedIndex].value;

    // alert(modeamortisment);
    if (modeamortisment == 4) {
        document.getElementById('id_tauxammortisment1').style.display = "none";
        document.getElementById('id_tauxammortisment2').style.display = "";
        document.getElementById('immobilisation_tauxammor2').value = "100%";
        document.getElementById('immobilisation_tauxammor2').disabled = "disabled";
    }
    function getXMLHttpRequest() {
        var xhr = null;

        if (window.XMLHttpRequest || window.ActiveXObject) {
            if (window.ActiveXObject) {
                try {
                    xhr = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
            } else {
                xhr = new XMLHttpRequest();
            }
        } else {
            alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
            return null;
        }

        return xhr;
    }
    function ChargerTauxammortisement() {

        var xhr = getXMLHttpRequest();
        mode = $("#immobilisation_modeamortisement").val();

        idimmobilisation =<?php
                    if (!$form->getObject()->isnew())
                        echo $form->getObject()->getId();
                    else
                        echo "0"
                        ?>;

        if (idimmobilisation > 0) {
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                    result = xhr.responseText;

                    document.getElementById('id_tauxammortisment1').style = "display:none";
                    document.getElementById('id_tauxammortisment2').style = "display:none";
                    document.getElementById('immobilisation_tauxammor2').value = "";
                    if (result == "ok") {
                        document.getElementById('id_tauxammortisment1').style.display = "";

                    } else {
                        document.getElementById('id_tauxammortisment2').style.display = "";
                        document.getElementById('immobilisation_tauxammor2').value = result;
                    }
                }
            };

            xhr.open("POST", "<?php echo url_for('Immob/ChargerTaux') ?>", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("mode=" + mode + "&idimmobilisation=" + idimmobilisation);
        } else {
            if (mode != 4) {
                document.getElementById('id_tauxammortisment1').style.display = "";
                document.getElementById('id_tauxammortisment2').style.display = "none";
            } else {
                document.getElementById('id_tauxammortisment1').style.display = "none";
                document.getElementById('id_tauxammortisment2').style.display = "";
                document.getElementById('immobilisation_tauxammor2').value = "100%";
                document.getElementById('immobilisation_tauxammor2').disabled = "disabled";
            }
        }
    }
    function ChargerVerifmode() {

        var xhr = getXMLHttpRequest();
        taux = $("#immobilisation_tauxammortisement").val();
        idimmobilisation =<?php
                    if (!$form->getObject()->isnew())
                        echo $form->getObject()->getId();
                    else
                        echo "0"
                        ?>;

        if (idimmobilisation > 0) {
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                    result = xhr.responseText;//alert(result);
                    if (result == "erreur")
                    {
                        alert('Votre taux ne correspond a cette mode d\'ammortisement');
                        document.location.href = "<?php echo url_for('immobilisation/edit?id=' . $form->getObject()->getId()) ?>";
                    }
                }
            };

            xhr.open("POST", "<?php echo url_for('Immob/ChargerTaux') ?>", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("taux=" + taux + "&idimmobilisation=" + idimmobilisation);
        } else {
            if (taux == 2) {
                $("#immobilisation_modeamortisement").val(4);
                document.getElementById('id_tauxammortisment1').style.display = "none";
                document.getElementById('id_tauxammortisment2').style.display = "";
                document.getElementById('immobilisation_tauxammor2').value = "100%";
                document.getElementById('immobilisation_tauxammor2').disabled = "disabled";
            }
        }
    }

</script>
<?php if (!$form->getObject()->isnew()) { ?>

    <script  type="text/javascript">

        document.getElementById("immobilisation_numero").readOnly = "readOnly ";
        document.getElementById("immobilisation_reference").readOnly = "readOnly ";
    <?php if (date("Y", strtotime($form->getObject()->getDatecreation())) != "1970") { ?>
            document.getElementById("immobilisation_datecreation").readOnly = "readOnly ";
    <?php } ?>
        document.getElementById("immobilisation_numero").value = "<?php echo $form->getObject()->getnumerocode(0) ?>";
        document.getElementById("immobilisation_reference").value = "<?php echo $form->getObject()->getCodebarre(0) ?>";
        //immobilisation_datemisajour
        document.getElementById("immobilisation_datemisajour").readOnly = "readOnly ";
    </script>

    <script  type="text/javascript">

        var app = angular.module('myApp', []);
        app.controller('myCtrl', function ($scope, $http) {
            $scope.filterdesc = "<?php echo $form->getObject()->getDesignation() ?>";
            $("#immobilisation_id_bureaux").val(<?php if ($form->getObject()->getIdBureaux()) echo $form->getObject()->getIdBureaux() ?>);
            $('#immobilisation_id_bureaux').selectpicker('refresh');

            $scope.mntht = '<?php echo $form->getObject()->getPrixhtva() ?>';
            $scope.tva = '<?php echo $form->getObject()->getTva() ?>';
            $scope.mntttc = '<?php echo $form->getObject()->getMntttc() ?>';
            $scope.sourcefinancement = "<?php if ($form->getObject()->getSourcefinancement()) echo $form->getObject()->getSourcesfinancemment(); ?>";
            var idfournisseur =<?php
    if ($form->getObject()->getIdFournisseur())
        echo $form->getObject()->getIdFournisseur();
    else
        echo "";
    ?>;
            if (idfournisseur != "") {
                $('#idfrs').val(idfournisseur);
                $("#immobilisation_id_fournisseur").val(idfournisseur);
                $('#immobilisation_id_fournisseur').selectpicker('render');
            }
            $scope.ChangerIdFrs = function () {
                $('#idfrs').val($('#immobilisation_id_fournisseur').val());
                //  alert($('#immobilisation_id_fournisseur').val());
            };
            $scope.ChangerSourcefin = function () {
                var url_envoi = "<?php echo sfconfig::get('sf_appdir') ?>immobilisation.php/Immob/Listesourcef";
                // document.location.href=url_envoi;
                $http({
                    method: "GET",
                    url: url_envoi
                }).then(function mySucces(response) {
                    //                       document.getElementById('ulsource').style.display="";
                    //                       alert("gg");
                    $scope.listedessource = response.data.entities;

                }, function myError(response) {

                });
            };
            $scope.selectDesc = function () {
                $http({
                    method: "GET",
                    url: "<?php echo sfconfig::get('sf_appdir') ?>immobilisation.php/immob/ListeDes/desc/" + $scope.filterdesc
                }).then(function mySucces(response) {
                    document.getElementById("sltdesc").style.display = "";
                    $scope.descs = response.data.entities;
                    $('#immobilisation_id_famille').val(0);
                    $('#immobilisation_id_categorie').val(0);
                    $('#immobilisation_id_sousfamille').val(0);
                    if ($scope.descs.length > 0) {
                        $('#immobilisation_id_famille').val($scope.descs[0].famille);
                        $('#immobilisation_id_categorie').val($scope.descs[0].categorie);
                        $('#immobilisation_id_sousfamille').val($scope.descs[0].sousfamille);
                    }
                }, function myError(response) {

                });

            };
            $scope.AjouterFournisseur = function () {

                if (document.getElementById('frmfournisseur').style.display == "none") {
                    document.getElementById('frmfournisseur').style.display = "";
                } else {
                    document.getElementById('frmfournisseur').style.display = "none";
                }

            };
            $scope.ValiderFrs = function () {

                var nom = "";
                if ($scope.txt_nomf)
                    nom = $scope.txt_nomf;
                var prenom = "";
                if ($scope.txt_prenomf)
                    prenom = $scope.txt_prenomf;
                var rs = "";
                if ($scope.txt_rsf)
                    rs = $scope.txt_rsf;
                var ref = "";
                if ($scope.txt_reff)
                    ref = $scope.txt_reff;
                var mailf = "";
                if ($scope.txt_mailf)
                    mailf = $scope.txt_mailf;
                var gsmf = "";
                if ($scope.txt_gsmf)
                    gsmf = $scope.txt_gsmf;
                var tel = "";
                if ($scope.txt_telf)
                    tel = $scope.txt_telf;
                var urlvalider = "<?php echo sfconfig::get('sf_appdir') ?>immobilisation.php/fournisseur/ajouter";
                urlvalider += "/nom/" + nom;
                urlvalider += "/prenom/" + prenom;
                urlvalider += "/rs/" + rs;
                urlvalider += "/ref/" + ref;
                urlvalider += "/mail/" + mailf;
                urlvalider += "/gsm/" + gsmf;
                urlvalider += "/tel/" + tel;
                // document.location.href=url;
                $http({
                    method: "GET",
                    url: urlvalider
                }).then(function mySucces(response) {
                    //alert(response.data);
                    $scope.frs = response.data.entities;
                    $('#msgfrs').html($scope.frs[$scope.frs.length - 1].msg);
                    var select = document.getElementById("immobilisation_id_fournisseur");
                    var newOption = new Option($scope.frs[$scope.frs.length - 1].frs, $scope.frs[$scope.frs.length - 1].id);
                    select.options.add(newOption);
                    select.options[select.options.length - 1].selected = "selected";
                    //alert($scope.frs[$scope.frs.length - 1].id+'hhh');
                    $('#idfrs').val($scope.frs[$scope.frs.length - 1].id);
                    $("#immobilisation_id_fournisseur").val($scope.frs[$scope.frs.length - 1].id);
                    $('#immobilisation_id_fournisseur').selectpicker('render');
                    // alert($("#immobilisation_id_fournisseur").val()+"hh");
                }, function myError(response) {

                });

            };
            $scope.selectedDesc = function (namefrs, famille, sousfamille, categorie) {
                $scope.filterdesc = namefrs;
                document.getElementById("sltdesc").style.display = "none";

                $('#immobilisation_id_famille').val(famille);
                $('#immobilisation_id_categorie').val(categorie);
                $('#immobilisation_id_sousfamille').val(sousfamille);
            };
            $scope.CalculMnt = function () {
                if ($scope.mntht && $scope.tva) {
                    $scope.mntttc = $scope.mntht * (1 + ($scope.tva / 100));
                }
                if ($scope.mntht && !$scope.tva) {
                    $scope.mntttc = $scope.mntht;
                }
                $scope.mntttc = parseFloat($scope.mntttc).toFixed(3);
            };
            $scope.Completeremplacement = function () {

                var urlrech = "<?php echo sfconfig::get('sf_appdir') ?>immobilisation.php/Immob/Rechercheb/idb/";
                if ($("#immobilisation_id_bureaux").val())
                    urlrech += $("#immobilisation_id_bureaux").val();
                //               alert('ggg');
                //               document.location.href=urlrech;
                $http({
                    method: "GET",
                    url: urlrech
                }).then(function mySucces(response) {
                    $scope.donnees = response.data.entities;
                    $("#immobilisation_id_bureaux").val($scope.donnees[$scope.donnees.length - 1].idb);
                    $('#immobilisation_id_bureaux').selectpicker('refresh');
                    //immobilisation_id_pays
                    $("#immobilisation_id_pays").val($scope.donnees[$scope.donnees.length - 1].idp);
                    $('#immobilisation_id_pays').selectpicker('refresh');
                    //immobilisation_id_agent
                    $("#immobilisation_id_agent").val($scope.donnees[$scope.donnees.length - 1].idu);
                    $('#immobilisation_id_agent').selectpicker('refresh');
                    //immobilisation_id_site
                    $("#immobilisation_id_site").val($scope.donnees[$scope.donnees.length - 1].ids);
                    $('#immobilisation_id_site').selectpicker('refresh');
                    //immobilisation_id_gouvernera
                    $("#immobilisation_id_gouvernera").val($scope.donnees[$scope.donnees.length - 1].idg);
                    $('#immobilisation_id_gouvernera').selectpicker('refresh');
                    //immobilisation_id_etage
                    $("#immobilisation_id_etage").val($scope.donnees[$scope.donnees.length - 1].ide);
                    $('#immobilisation_id_etage').selectpicker('refresh');
                    //adr immobilisation_adresse
                    // alert($scope.donnees[$scope.donnees.length - 1].adr);
                    // $("#immobilisation_adresse").text($scope.donnees[$scope.donnees.length - 1].adr);
                    $("#immobilisation_adresse").html($scope.donnees[$scope.donnees.length - 1].adr);
                }, function myError(response) {
                    alert('hh');
                });
            };
        });

    </script>

<?php }if ($form->getObject()->isnew()) { ?>
    <script  type="text/javascript">

        document.getElementById("immobilisation_numero").readOnly = "readOnly ";
        document.getElementById("immobilisation_reference").readOnly = "readOnly ";
        document.getElementById("immobilisation_datecreation").value = "readOnly";
        document.getElementById("immobilisation_numero").value = "<?php echo $form->getObject()->getnumerocode(1) ?>";
        document.getElementById("immobilisation_reference").value = "<?php echo $form->getObject()->getCodebarre(1) ?>";
        document.getElementById("immobilisation_datemisajour").readOnly = "readOnly ";

    </script>


    <script  type="text/javascript">

        var app = angular.module('myApp', []);
        app.controller('myCtrl', function ($scope, $http) {

            $scope.selectDesc = function () {
                $http({
                    method: "GET",
                    url: "<?php echo sfconfig::get('sf_appdir') ?>immobilisation.php/immob/ListeDes/desc/" + $scope.filterdesc
                }).then(function mySucces(response) {
                    document.getElementById("sltdesc").style.display = "";
                    $scope.descs = response.data.entities;
                    $('#immobilisation_id_famille').val(0);
                    $('#immobilisation_id_categorie').val(0);
                    $('#immobilisation_id_sousfamille').val(0);
                    if ($scope.descs.length > 0) {
                        $('#immobilisation_id_famille').val($scope.descs[$scope.descs.length - 1].famille);
                        $('#immobilisation_id_categorie').val($scope.descs[$scope.descs.length - 1].categorie);
                        $('#immobilisation_id_sousfamille').val($scope.descs[$scope.descs.length - 1].sousfamille);
                    }
                }, function myError(response) {

                });

            };
            $scope.ChangerIdFrs = function () {
                $('#idfrs').val($('#immobilisation_id_fournisseur').val());
                //  alert($('#immobilisation_id_fournisseur').val());
            };
            $scope.selectedDesc = function (namefrs, famille, sousfamille, categorie) {
                $scope.filterdesc = namefrs;
                document.getElementById("sltdesc").style.display = "none";

                $('#immobilisation_id_famille').val(famille);
                $('#immobilisation_id_categorie').val(categorie);
                $('#immobilisation_id_sousfamille').val(sousfamille);
            };
            $scope.AjouterFournisseur = function () {

                if (document.getElementById('frmfournisseur').style.display == "none") {
                    document.getElementById('frmfournisseur').style.display = "";
                } else {
                    document.getElementById('frmfournisseur').style.display = "none";
                }
            };
            $scope.ValiderFrs = function () {

                var nom = "0";
                if ($scope.txt_nomf)
                    nom = $scope.txt_nomf;
                var prenom = "0";
                if ($scope.txt_prenomf)
                    prenom = $scope.txt_prenomf;
                var rs = "0";
                if ($scope.txt_rsf)
                    rs = $scope.txt_rsf;
                var ref = "0";
                if ($scope.txt_reff)
                    ref = $scope.txt_reff;
                var mailf = "0";
                if ($scope.txt_mailf)
                    mailf = $scope.txt_mailf;
                var gsmf = "0";
                if ($scope.txt_gsmf)
                    gsmf = $scope.txt_gsmf;
                var tel = "0";
                if ($scope.txt_telf)
                    tel = $scope.txt_telf;
                var urlvalider = "<?php echo sfconfig::get('sf_appdir') ?>immobilisation.php/fournisseur/ajouter";
                urlvalider += "/nom/" + nom;
                urlvalider += "/prenom/" + prenom;
                urlvalider += "/rs/" + rs;
                urlvalider += "/ref/" + ref;
                urlvalider += "/mail/" + mailf;
                urlvalider += "/gsm/" + gsmf;
                urlvalider += "/tel/" + tel;
                // document.location.href=url;
                $http({
                    method: "GET",
                    url: urlvalider
                }).then(function mySucces(response) {
                    //alert(response.data);
                    $scope.frs = response.data.entities;
                    $('#msgfrs').html($scope.frs[$scope.frs.length - 1].msg);
                    var select = document.getElementById("immobilisation_id_fournisseur");
                    var newOption = new Option($scope.frs[$scope.frs.length - 1].frs, $scope.frs[$scope.frs.length - 1].id);
                    select.options.add(newOption);
                    select.options[select.options.length - 1].selected = "selected";
                    $('#idfrs').val($scope.frs[$scope.frs.length - 1].id);
                    $("#immobilisation_id_fournisseur").val($scope.frs[$scope.frs.length - 1].id);
                    $('#immobilisation_id_fournisseur').selectpicker('render');
                }, function myError(response) {

                });
            };
            $scope.CalculMnt = function () {
                if ($scope.mntht && $scope.tva) {
                    $scope.mntttc = $scope.mntht * (1 + ($scope.tva / 100));
                }
                if ($scope.mntht && !$scope.tva) {
                    $scope.mntttc = $scope.mntht;
                }
                $scope.mntttc = parseFloat($scope.mntttc).toFixed(3);
            };
        });

    </script>
<?php } ?>