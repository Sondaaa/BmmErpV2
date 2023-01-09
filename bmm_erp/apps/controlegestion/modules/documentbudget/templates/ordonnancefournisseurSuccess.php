<div id="sf_admin_container" >
    <h1 id="replacediv">Nouvelle fiche d'ordonnance de paiement</h1>
    <div id="sf_admin_content">
        <div class="col-sm-12" ng-controller="CtrlFormOrdonnanceFournisseur" ng-init="InialiserOrdonnance()">
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#home" ng-click="InialiserOrdonnance()">
                            <i class="green ace-icon fa fa-file-text-o bigger-120"></i>
                            Fiche Ordonnance de Paiement
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <fieldset>
                            <legend>Entête Ordonnance</legend>
                            <table>
                                <tbody>
                                    <tr class="disabledbutton">
                                        <td><label>Type</label></td>
                                        <td colspan="3">
                                            <?php echo $form['id_type']->renderError() ?>
                                            <?php echo $form['id_type'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Date Création</label></td>
                                        <td onmouseup="setMinMaxDate();">
                                            <?php echo $form['datecreation']->renderError() ?>
                                            <?php echo $form['datecreation'] ?>
                                        </td>
                                        <td><label>Numéro</label></td>
                                        <td class="disabledbutton">
                                            <?php echo $form['numero']->renderError() ?>
                                            <?php
                                            if ($form->getObject()->isNew())
                                                echo $form['numero']->render(array('value' => $form->getObject()->NumeroSeqDocumentAchat(2)));
                                            else
                                                echo $form['numero']->render(array('value' => $form->getObject()->getNumerodocachat()));
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </fieldset>
                        <fieldset>
                            <legend>Pièces Jointes</legend>
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="width: 20%;">Fournisseur :</td>
                                        <td style="width: 80%;">
                                            <?php echo $form_achat['id_frs']->renderError() ?>
                                            <?php echo $form_achat['id_frs'] ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table>
                                <thead>
                                    <tr>
                                        <!--<th></th>-->
                                        <th>Numéro Engagement</th>
                                        <th>Numéro Document</th>
                                        <th>Type</th>
                                        <th>Mnt TTC NET</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="document in listesdocuments">
                                        <!--<td><input id="cheked_id{{document.idpi}}" type="checkbox" ng-click="Valider(document.idpi, document.numero)"></td>-->
                                        <td style="text-align: center;">{{document.numero_engagement}}</td>
                                        <td style="text-align: center;">{{document.prefixetype}}{{document.numero}}</td>
                                        <td>{{document.libelle}}</td>
                                        <td style="text-align: right;">{{document.mntttc| currency : "" : 3}}</td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-sm btn-success" ng-click="goToDetailsFacture(document.iddocachat)" style="padding: 3px 10px;">
                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                <span class="bigger-110 no-text-shadow">Détails & Valider</span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </fieldset>
<!--                        <fieldset style="width: 30%">
                            <legend>Action</legend>
                            <button class="btn btn-sm btn-success" ng-click="AjouterOrdonnance()" style="padding: 4px 10px;">
                                <i class="ace-icon fa fa-save bigger-110"></i>
                                <span class="bigger-110 no-text-shadow">Ajouter Ordonnance</span>
                            </button>
                        </fieldset>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">

    function setMinMaxDate() {
        var annee_exercice = '<?php echo $_SESSION['exercice_budget']; ?>';
        var min_date = annee_exercice + '-01-01';
        var max_date = annee_exercice + '-12-31';
        $('#documentbudget_datecreation').attr('min', min_date);
        $('#documentbudget_datecreation').attr('max', max_date);
    }

</script>

<style>

    .align_right{text-align: right !important;}

</style>