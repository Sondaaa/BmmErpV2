<div id="sf_admin_container" >
    <h1 id="replacediv">Nouvelle fiche d'ordonnance de paiement</h1>
    <div id="sf_admin_content">
        <div class="col-sm-12" ng-controller="CtrlFormOrdonnance" ng-init="InialiserOrdonnance()">
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#home" ng-click="InialiserOrdonnance()">
                            <i class="green ace-icon fa fa-user bigger-120"></i>
                            Fiche Ordonnance de paiement
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <fieldset>
                            <legend>Imputation Budgetaire </legend>
                            <table>
                                <tbody>
                                    <tr class="disabledbutton">
                                        <td><label>Type</label></td>
                                        <td colspan="5">
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
                                        <td colspan="5" class="disabledbutton">
                                            <?php echo $form['numero']->renderError() ?>
                                            <?php
                                            if ($form->getObject()->isNew())
                                                echo $form['numero']->render(array('value' => $form->getObject()->NumeroSeqDocumentAchat(2)));
                                            else
                                                echo $form['numero']->render(array('value' => $form->getObject()->getNumerodocachat()));
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Exercice:</label>
                                            <?php
                                            $date = $_SESSION['exercice_budget'];
                                            if (!$form->getObject()->isNew() && $form->getObject()->getDatecreation()) {
                                                $date = date('Y', strtotime($form->getObject()->getDatecreation()));
                                            }
                                            echo $date;
                                            ?>
                                        </td>
                                        <td colspan="2">
                                            <label>Budget</label>
                                            <?php
                                            $ligne = new Ligprotitrub();
                                            $annees = $_SESSION['exercice_budget'];
                                            $budgets = Doctrine_Query::create()
                                                            ->select("*")
                                                            ->from('titrebudjet')
                                                            ->where("Etatbudget=2")
                                                            ->andwhere("trim(typebudget) not like trim('Prototype')  ")
                                                            ->andwhere("trim(typebudget) like trim('Exercice:" . $annees . "')  ")
                                                            ->orderBy('id asc')->execute();
                                            //Doctrine_Core::getTable('titrebudjet')->findByEtatbudget(2);
                                            if (!$form->getObject()->isNew() && $form->getObject()->getIdBudget()) {
                                                $l = Doctrine_Core::getTable('ligprotitrub')->findOneById($form->getObject()->getIdBudget());
                                                if ($l)
                                                    $ligne = $l;
                                            }
                                            ?>
                                            <select id="budget">
                                                <option value="0">Sélectionnez</option>
                                                <?php foreach ($budgets as $budget) { ?>
                                                    <option value="<?php echo $budget->getId() ?>" <?php if ($ligne && $ligne->getIdTitre() == $budget->getId()) echo 'selected="selected"' ?> >
                                                        <?php echo $budget->getLibelle() ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td colspan="3">
                                            <label>Rubrique / Sous Rubrique</label>
                                            <input type="hidden" id="id_budget" value="<?php if (!$form->getObject()->isNew() && $form->getObject()->getIdBudget()) echo $form->getObject()->getIdBudget(); ?>">
                                            <select id="numeroengaement" name="numeroengaement">

                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Rubrique</label></td>
                                        <td colspan="5">
                                            <input type="text" class="form-control" id="rubrique" value="<?php if ($ligne && $ligne->getIdTitre()) echo $ligne->getRubrique() ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Crédits alloués</label></td>
                                        <td>
                                            <input type="text" class="align_right" readonly="true" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format($ligne->getMnt(), 3, '.', ' '); ?>" id="mnt">
                                        </td>
                                        <td><label>Crédits consommés</label></td>
                                        <td>
                                            <input type="text" class="align_right" readonly="true" value="<?php if ($ligne && $ligne->getIdTitre() && $ligne->getMntdeponser()) echo number_format($ligne->getMntdeponser(), 3, '.', ' '); ?>" id="credit">
                                        </td>
                                        <td><label>Reliquat</label></td>
                                        <td>
                                            <?php
                                            $mntdeponser = 0;
                                            if ($ligne->getMntdeponser())
                                                $mntdeponser = $ligne->getMntdeponser();
                                            $relicat = $ligne->getMnt() - $mntdeponser;
                                            ?>
                                            <input type="text" class="align_right" readonly="true" value="<?php if ($ligne && $ligne->getIdTitre()) echo number_format($relicat, 3, '.', ' '); ?>" id="reliq">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </fieldset>
                        <fieldset>
                            <legend>Pièces Jointes</legend>
                            <table>
                                <thead>
                                    <tr>
                                        <!--<th></th>-->
                                        <th>Numéro Engagement</th>
                                        <th>Numéro Document</th>
                                        <th>Type</th>
                                        <th>Mnt TTC.NET</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="document in listesdocuments">
                                        <!--<td><input id="cheked_id{{document.idpi}}" type="checkbox" ng-click="Valider(document.idpi, document.numero)"></td>-->
                                        <td>{{document.numero_engagement}}</td>
                                        <td>{{document.prefixetype}}{{document.numero}}</td>
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
                            <legend >Action</legend>
                            <input type="button" value="Valider" ng-click="AjouterOrdonnace()">
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