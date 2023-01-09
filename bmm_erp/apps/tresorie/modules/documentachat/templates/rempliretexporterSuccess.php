
<div id="sf_admin_container">
    <h1>Fiche D.I. N° : <?php echo $documentachat->getNumerodocachat() ?></h1>
    <?php
    $societe = Doctrine_Core::getTable('societe')->findOneById(1);
    $aviss = Doctrine_Core::getTable('avis')
                    ->createQuery('a')->where('id_poste=5')
                    ->orderBy('id asc')->execute(); //Liste des avis par unité budget
    $visas = Doctrine_Core::getTable('visaachat')->findAll();
    ?>
    <div id="sf_admin_content" ng-controller="myCtrldocvisa">  
        <div style=" position: absolute;float: right;margin-left: 80%;margin-top: 1%;">
            <table>
                <thead>
                    <tr>
                        <th colspan="2" style="text-align: center; font-size: 16px;">Avis de l'unité budget</th>
                    </tr>
                </thead>
                <?php
                foreach ($aviss as $avis) {
                    $lgavis = Doctrine_Core::getTable('ligavisdoc')->findOneByIdDocAndIdAvis($documentachat->getId(), $avis->getId());
                    ?>
                    <tr>
                        <td>
                            <?php
                            if (strpos($avis->getLibelle(), ":") == 0)
                                echo $avis->getLibelle();
                            else
                                echo "<p style='color: red; margin: 0px;'>" . $avis->getLibelle() . "</p>";
                            ?>
                        </td>
                        <td>
                            <?php if (strpos($avis->getLibelle(), ":") == 0) { ?>
                                <input class="disabledbutton" <?php if ($lgavis) echo 'checked="true"' ?> type="checkbox">
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div style="padding: 1%; width: 80%; font-size: 16px">
            <table style="list-style: none; margin-bottom: 0px;">
                <tr style="background-color: #F0F0F0;">
                    <td style="width: 200px; vertical-align: middle; text-align: center;">
                        <p style="border-top: 1px solid silver; border-bottom: 1px solid silver; padding-top: 10px; padding-bottom: 10px;">
                            <strong><?php echo strtoupper($societe); ?></strong>
                        </p>
                    </td>
                    <td>
                        <table style="margin-bottom: 0px;">
                            <?php
                            $numero = strtoupper($documentachat->getTypedoc());
                            $numero = str_replace(array('à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'), array('À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'), $numero);
                            ?>
                            <tr>
                                <td colspan="2"><?php echo $numero; ?></td>
                            </tr>
                            <tr>
                                <td>N° : <?php echo $documentachat->getNumerodocachat() ?></td>
                                <td>Date création : <?php echo date('d/m/Y', strtotime($documentachat->getDatecreation())); ?></td>
                            </tr>
                            <tr>
                                <td>Nature</td>
                                <td><?php echo $documentachat->getObjectdocument(); ?></td>
                            </tr>
                            <tr>
                                <td>Montant Estimatif</td>
                                <td>
                                    <?php if ($documentachat->getMontantestimatif()): ?>
                                        <?php echo number_format($documentachat->getMontantestimatif(), 3, '.', ' '); ?> TND
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table> 
        </div>
        <fieldset style="width: 80%">
            <legend>Données de base</legend>
            <table>
                <tbody>
                    <tr>
                        <td style="width: 25%;">Nom et Prénom du demandeur</td>
                        <td style="width: 50%;"><?php echo $documentachat->getAgents(); ?></td>
                        <td style="width: 10%;">Référence</td>
                        <td style="width: 15%;"><?php echo $documentachat->getReference(); ?></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
        <fieldset id="zone_avis_budgetaire">
            <legend>Avis Budgétaire</legend>
            <?php $liste_avis = Doctrine_Core::getTable('ligavisdoc')->findByIdDoc($documentachat->getId()); ?>
            <table>
                <tbody>
                    <?php foreach ($liste_avis as $lgavis): ?>
                        <tr>
                            <td style="width: 13%; background: repeat-x #F2F2F2;">Avis Bugétaire</td>
                            <td style="width: 60%;"><?php echo $lgavis->getAvis(); ?></td>
                            <td style="width: 12%; background: repeat-x #F2F2F2;">Date Création</td>
                            <td style="width: 15%;"><?php echo date('d/m/Y', strtotime($lgavis->getDatecreation())); ?></td>
                        </tr>
                        <tr>
                            <td style="background: repeat-x #F2F2F2;">Budget</td>
                            <td colspan="3"><?php echo $lgavis->getLigprotitrub()->getTitrebudjet(); ?></td>
                        </tr>
                        <tr>
                            <td style="background: repeat-x #F2F2F2;">Rubrique</td>
                            <td colspan="3"><?php echo $lgavis->getLigprotitrub(); ?></td>
                        </tr>
                        <tr>
                            <td style="background: repeat-x #F2F2F2;">Reliquat</td>
                            <td colspan="3"><?php if ($lgavis->getMntdisponible()) echo number_format($lgavis->getMntdisponible(), 3, '.', ' ') . ' TND'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if ($documentachat->getEtatdocachat() != ''): ?>
                <?php $docachat_annulation = DocumentachatannulationTable::getInstance()->findOneByIdDocumentachat($documentachat->getId()); ?>
                <?php if ($docachat_annulation): ?>
                    <legend style="color: red;">D.I. Annulé</legend>
                    <table style="color: red;">
                        <tr>
                            <td>Le <?php echo date('d/m/Y', strtotime($docachat_annulation->getDateannulation())); ?></td>
                            <td>Motif : <?php echo $docachat_annulation->getMotifannulation(); ?></td>
                        </tr>
                    </table>
                <?php endif; ?>
            <?php endif; ?>
        </fieldset>
        <fieldset ng-init="ChargerVisa(<?php echo $documentachat->getId() ?>)">
            <legend>Liste des articles</legend>
            <table>
                <thead>
                    <tr>
                        <th>N°ordre</th>
                        <th>Code Article</th>
                        <th>Désignation</th>
                        <th>Qte.Demandée</th>
                        <th>Projet</th>
                        <th>Observation</th>
                        <th>P.E.</th>
                        <th>P.A.</th>
                        <?php if ($documentachat->getEtatdocachat() == ''): ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $lg = new Lignedocachat();
                    $str = "";
                    foreach ($listesdocuments as $lignedoc) {
                        $lg = $lignedoc;
                        $qtedemander = 0;
                        $qtees = 0;
                        $qteas = 0;
                        $qteep = 0;
                        $qteap = 0;
                        $qteea = 0;
                        $qteaa = 0;
                        $qteligne = Doctrine_Core::getTable('qtelignedoc')->findOneByIdLignedocachat($lg->getId());
                        if ($qteligne) {
                            $qtedemander = $qteligne->getQtedemander();
                            $qteas = $qteligne->getQteas();
                            $qtees = $qteligne->getQtees();
                            $qteap = $qteligne->getQteap();
                            $qteep = $qteligne->getQteep();
                            if ($qteligne->getQteaachat())
                                $qteaa = $qteligne->getQteaachat();
                            if ($qteligne->getQteeachat())
                                $qteea = $qteligne->getQteeachat();
                        }
                        $str.=$lg->getId() . "-" . $qtedemander . ";";
                        ?>
                        <tr>
                            <td style="text-align: center;"><?php echo sprintf('%02d', $lg->getNordre()); ?></td>
                            <td style="text-align: center;"><?php echo $lg->getCodearticle() ?></td>
                            <td><?php echo $lg->getDesignationarticle() ?></td>
                            <td style="text-align: center;"><?php echo $qtedemander ?></td>
                            <td><?php echo $lg->getProjet() ?></td>
                            <td><?php echo $lg->getObservation() ?></td>
                            <td><?php echo $qtees ?>|<?php echo $qteep ?><br>
                                <input class="input_quantite" type="text" <?php if ($documentachat->getEtatdocachat() != ''): ?>readonly="true"<?php endif; ?> id="input_qte_pe<?php echo $lg->getId() ?>" value="<?php echo $qteea ?>" onchange="verifierQte('input_qte_pe<?php echo $lg->getId() ?>', '<?php echo $qteea; ?>')">
                            </td>
                            <td>
                                <?php echo $qteas ?>|<?php echo $qteap ?> <br>
                                <input class="input_quantite" type="text" <?php if ($documentachat->getEtatdocachat() != ''): ?>readonly="true"<?php endif; ?> id="input_qte_pa<?php echo $lg->getId() ?>" value="<?php
                                if ($qteaa > 0)
                                    echo $qteaa;
                                else
                                    echo $qtedemander
                                    ?>" onchange="verifierQte('input_qte_pa<?php echo $lg->getId() ?>', '<?php echo $qtedemander; ?>')">
                            </td>
                            <?php if ($documentachat->getEtatdocachat() == ''): ?>
                                <td>
                                    <input type="button" ng-click="ValiderChoix(<?php echo $lignedoc->getId() ?>,<?php echo $qtedemander ?>)" value="Valider">
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php } ?>
                    <?php if ($documentachat->getEtatdocachat() == ''): ?>
                        <tr>
                            <td colspan="9" style="text-align: right;">
                                <input ng-click="ValiderTousChoix('<?php echo $str ?>')" type="button" value="Valider tous les quantités des articles">
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </fieldset>
        <fieldset style="margin-left: 50%;">
            <legend>Action Fiche D.I.</legend>
            <div>
                <a id="btn_ajout" class="btn btn-outline btn-success disabledbutton" href="<?php echo url_for('documentachat/validerqteachatetvisa?iddoc=') . $documentachat->getId() . '&btn=valider' ?>">
                    <i class="ace-icon fa fa-save bigger-110"></i> Enregistrer
                </a>
            </div>
        </fieldset>
        <fieldset>
            <table style="border: none !important;background: none !important">
                <tr style="border: none !important;background: none !important">
                    <td ng-repeat="visa in visadonnees" style="width: 123px;border: none !important;background: none !important">
                        <table style="width: 123px !important">
                          
                            <tr>
                                <td style="text-align: center;">{{visa.ag}}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;" ng-class="{etat_valide: {{visa.etatvalide}} == true, etat_non_valide: {{visa.etatvalide}} = = false}">{{visa.datevisa| date:'dd/MM/yyyy'}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
</div>

<script  type="text/javascript">

            function verifierQte(id, qte){
            if ($("#" + id).val() == '') {
            $("#" + id).val('0');
            } else {
            if (parseInt($("#" + id).val()) > parseInt(qte)) {
            bootbox.dialog({
            message: 'Vérifiez la quantité que vous avez saisie, la quantité maximale est : ' + qte,
                    buttons:
            {
            "button":
            {
            "label": "Ok",
                    "className": "btn-sm"
            }
            }
            });
                    $("#" + id).val(qte);
            }
            }
            }

</script>

<style>

    .etat_valide {background-color: #9f9;}
    .etat_non_valide {background-color: #ffa6a6;}
    .input_quantite{max-width: 80px; text-align: center;}


</style>