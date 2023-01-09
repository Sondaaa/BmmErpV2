<div id="sf_admin_container">
    <h1 id="replacediv">Fiche d'ordonnance de paiement</h1>
    <div id="sf_admin_content">
        <div class="col-sm-12" ng-controller="CtrlFormOrdonnance" ng-init="InialiserOrdonnance()">

            <div class="row">
                <div class="col-sm-6">
                    <div class="tab-content">

                        <i class="green ace-icon fa fa-user bigger-120"></i>
                        Imputation Budgetaire
                        <hr />

                        <table class="table table-striped">
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
                                    <td onmouseup="setMinMaxDate();" colspan="5">
                                        <?php echo $form['datecreation']->renderError() ?>
                                        <?php echo $form['datecreation'] ?>
                                    </td>

                                </tr>
                                <tr>
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
                                    <td>Exercice</td>
                                    <td colspan="5">
                                        <?php
                                        $date = $_SESSION['exercice_budget'];
                                        echo $date;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Budget</td>
                                    <td colspan="5">
                                        <?php
                                        $annees = $_SESSION['exercice_budget'];
                                        $budgets = Doctrine_Query::create()
                                            ->select("*")
                                            ->from('titrebudjet')
                                            ->where("Etatbudget=2")
                                            ->andwhere("trim(typebudget) not like trim('Prototype') ")
                                            ->andwhere("trim(typebudget) like trim('Exercice:" . $annees . "')")
                                            ->orderBy('id asc')
                                            ->execute();
                                        ?>

                                        <select id="budget">
                                            <option value="0">Sélectionnez</option>
                                            <?php foreach ($budgets as $budget) { ?>
                                                <option value="<?php echo $budget->getId() ?>" <?php
                                                                                                if (!$form->getObject()->isNew()) :
                                                                                                    if ($documentbudget->getLigprotitrub()->getIdTitre() == $budget->getId()) {
                                                                                                ?> selected="selected" <?php }
                                                                                                                endif; ?>>
                                                    <?php echo $budget->getLibelle() ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Rubrique</td>
                                    <td colspan="5">
                                        <div id="div_select"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Sous Rubrique</td>
                                    <td colspan="3">
                                        <input type="hidden" id="numeroengaement" >
                                        <input type="text" class="form-control" readonly="true" id="rubrique" value="" ng-change="ChargerListesengagement()">
                                    </td>
                                   
                                </tr>
                                <tr class="disabledbutton">

                                    <td colspan="2">
                                        <div class="bg bg-info">
                                            <h4>Mnt débloquer</h4>
                                        </div>
                                        <ul>
                                            <li> <input type="text" class="form-control" value="" id="mnt"></li>

                                        </ul>
                                        <div class="bg bg-danger">
                                            <h4>Mnt consommer</h4>
                                        </div>
                                        <ul>

                                            <li> <input type="text" class="form-control" value="" id="credit"></li>

                                        </ul>
                                    </td>



                                    <td colspan="2">
                                        <div class="bg bg-warning">
                                            <h4>Reliquat</h4>
                                        </div>

                                        <ul>
                                            <li><input type="text" class="form-control" value="" id="reliq"></li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>




                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="tab-content">
                        <i class="green ace-icon fa fa-file bigger-120"></i> Pièces Jointes
                        <hr />
                        <table class="table table-striped">
                            <thead>
                                <tr>

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

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<script type="text/javascript">
    function setMinMaxDate() {
        var annee_exercice = '<?php echo $_SESSION['exercice_budget']; ?>';
        var min_date = annee_exercice + '-01-01';
        var max_date = annee_exercice + '-12-31';
        $('#documentbudget_datecreation').attr('min', min_date);
        $('#documentbudget_datecreation').attr('max', max_date);
    }
</script>

<style>
    .align_right {
        text-align: right !important;
    }
</style>
